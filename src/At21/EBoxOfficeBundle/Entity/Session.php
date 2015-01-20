<?php

namespace At21\EBoxOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Session
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="At21\EBoxOfficeBundle\Entity\SessionRepository")
 */
class Session
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
     * @ORM\Column(type="datetime")
     */
    private $version;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", unique=true)
     */
    private $date;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Seat", mappedBy="session", cascade={"persist", "remove"})
     */
    private $seats;

    /**
     * @var Theatre
     *
     * @ORM\ManyToOne(targetEntity="Play", inversedBy="sessions")
     */
    private $play;

    /**
     * @var double
     *
     * @ORM\Column(name="price", type="decimal", precision=6, scale=2)
     */
    private $price;

    /**
     * @var Theatre
     *
     * @ORM\ManyToOne(targetEntity="Theatre")
     */
    private $theatre;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->seats = new ArrayCollection();
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
     * @return Session
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Session
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set seats
     *
     * @param ArrayCollection $seats
     * @return Session
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;

        return $this;
    }

    /**
     * Get seats
     *
     * @return ArrayCollection
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * Add seat
     *
     * @param Seat $seat
     * @return Session
     */
    public function addSeat($seat)
    {
        $this->seats->add($seat);

        return $this;
    }

    /**
     * Initialize seats
     *
     * @return Session
     */
    public function initializeSeats()
    {
        for($i = 1; $i <= $this->theatre->getNumberOfRows(); $i++){
            for($j = 1; $j <= $this->theatre->getNumberOfSeatsPerRow(); $j++){
                $this->seats->add(new Seat($this, false, $i, $j));
            }
        }

        return $this;
    }

    /**
     * Get price
     *
     * @return double
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set price
     *
     * @param double $price
     * @return Play
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Set theatre
     *
     * @param Theatre $theatre
     * @return Session
     */
    public function setTheatre($theatre)
    {
        $this->theatre = $theatre;

        return $this;
    }

    /**
     * Get theatre
     *
     * @return \stdClass 
     */
    public function getTheatre()
    {
        return $this->theatre;
    }

    /**
     * Set play
     *
     * @param Play $play
     * @return Session
     */
    public function setPlay($play)
    {
        $this->play = $play;

        return $this;
    }

    /**
     * Get play
     *
     * @return Play
     */
    public function getPlay()
    {
        return $this->play;
    }
}
