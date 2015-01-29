<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 29/01/15
 * Time: 15:46
 */

namespace At21\EBoxOfficeBundle;


use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\OptimisticLockException;

class BoxOffice implements MessageComponentInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    protected $clients;

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function __construct($em)
    {
        $this->em = $em;
        $this->clients = new \SplObjectStorage;
    }

    // onOpen, onMessage, onClose, onError ...
    /**
     * When a new connection is opened it will be passed to this method
     *
     * @param  ConnectionInterface $conn The socket/connection that just connected to your application
     *
     * @throws \Exception
     */
    function onOpen(ConnectionInterface $conn)
    {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    /**
     * This is called before or after a socket is closed (depends on how it's closed).  SendMessage to $conn will not result in an error if it has already been closed.
     *
     * @param  ConnectionInterface $conn The socket/connection that is closing/closed
     *
     * @throws \Exception
     */
    function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    /**
     * If there is an error with one of the sockets, or somewhere in the application where an Exception is thrown,
     * the Exception is sent back down the stack, handled by the Server and bubbled back up the application through this method
     *
     * @param  ConnectionInterface $conn
     * @param  \Exception          $e
     *
     * @throws \Exception
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }

    /**
     * Triggered when a client sends data through the socket
     *
     * @param  \Ratchet\ConnectionInterface $from The socket/connection that sent the message to your application
     * @param  string                       $msg  The message received
     *
     * @throws \Exception
     */
    function onMessage(ConnectionInterface $from, $msg)
    {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        $seats = unserialize($msg);

            try {
                foreach($seats as $s){
                    $seat = $this->em->getRepository('At21EBoxOfficeBundle:Seat')->find($s['id']);
                    $user = $this->em->getRepository('At21EBoxOfficeBundle:User')->find($s['user']);
                    $seat->setUser($user);
                    $this->em->persist($seat);
                    $seat = $this->em->find('At21EBoxOfficeBundle:Seat', $s['id'], LockMode::OPTIMISTIC, $s['version']);
                    $user = $this->em->getRepository('At21EBoxOfficeBundle:User')->find($s['user']);
                    $seat->setUser($user);
                    $this->em->persist($seat);
                }
                $this->em->flush();
            } catch(OptimisticLockException $e) {
                echo "Sorry, but someone else has already changed this entity. Please apply the changes again!";
            }

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }
    }
}