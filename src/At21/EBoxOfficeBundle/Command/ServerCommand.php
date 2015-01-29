<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 29/01/15
 * Time: 16:21
 */

namespace At21\EBoxOfficeBundle\Command;

use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Ratchet\Server\IoServer;

class ServerCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('at21:eboxoffice:server')
            ->setDescription('Start the BoxOffice server');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $chat = $this->getContainer()->get('at21_eboxoffice_boxoffice');
        $port = 8080;
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    $chat
                )
            ),
            $port
        );
        $output->writeln('');
        $output->writeln('E-BoxOffice Running and listening *:' . $port);
        $output->writeln('');
        $output->writeln('Quit the server with CONTROL + C');
        $server->run();
    }
}