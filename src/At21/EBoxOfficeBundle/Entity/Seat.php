<?php

namespace At21\EBoxOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seat
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="At21\EBoxOfficeBundle\Entity\SeatRepository")
 */
class Seat
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Version
     * @ORM\Column(type="integer")
     */
    private $version;

    /**
     * @var integer
     *
     * @ORM\Column(name="rowNumber", type="integer")
     */
    private $rowNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="columnNumber", type="integer")
     */
    private $columnNumber;

    /**
     * @var Session
     *
     * @ORM\ManyToOne(targetEntity="Session", inversedBy="seats")
     */
    private $session;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="seats")
     */
    private $user;

    /**
     * Construct
     *
     * @param Session $session
     * @param integer $rowNumber
     * @param integer $columnNumber
     */
    public function __construct($session, $rowNumber, $columnNumber)
    {
        $this->session = $session;
        $this->rowNumber = $rowNumber;
        $this->columnNumber = $columnNumber;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get version
     *
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set version
     *
     * @param mixed $version
     * @return Seat
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get columnNumber
     *
     * @return int
     */
    public function getRowNumber()
    {
        return $this->rowNumber;
    }

    /**
     * Set rowNumber
     *
     * @param int $rowNumber
     * @return Seat
     */
    public function setRowNumber($rowNumber)
    {
        $this->rowNumber = $rowNumber;

        return $this;
    }

    /**
     * Get columnNumber
     *
     * @return int
     */
    public function getColumnNumber()
    {
        return $this->columnNumber;
    }

    /**
     * Set columnNumber
     *
     * @param int $columnNumber
     * @return Seat
     */
    public function setColumnNumber($columnNumber)
    {
        $this->columnNumber = $columnNumber;

        return $this;
    }

    /**
     * Set session
     *
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set session
     *
     * @param Session $session
     * @return Seat
     */
    public function setSession($session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return Seat
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}