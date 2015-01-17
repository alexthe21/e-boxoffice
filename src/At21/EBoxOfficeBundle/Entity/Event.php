<?php

namespace At21\EBoxOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="At21\EBoxOfficeBundle\Entity\EventRepository")
 */
class Event
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @var Theatre
     *
     * @ORM\ManyToOne(targetEntity="Theatre")
     */
    private $theatre;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Seat", mappedBy="event", cascade={"persist"})
     */
    private $seats;

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->seats = new ArrayCollection();
        $this->date = new \DateTime();
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
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Event
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
     * Get Theatre
     *
     * @return Theatre
     */
    public function getTheatre()
    {
        return $this->theatre;
    }

    /**
     * Set Theatre
     *
     * @param Theatre $theatre
     * @return Event
     */
    public function setTheatre($theatre)
    {
        $this->theatre = $theatre;

        return $this;
    }

    /**
     * Initialize Seats
     *
     * @return Event
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
     * Get Seats
     *
     * @return ArrayCollection
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * Set Seats
     *
     * @param ArrayCollection $seats
     * @return Event
     */
    public function setSeats($seats)
    {
        $this->seats->add($seats);
        return $this;
    }

    /**
     * Add Seat
     *
     * @param Seat $seat
     * @return Event
     */
    public function addSeat($seat)
    {
        if ($this->seats->contains($seat)) {
            return;
        }
        $this->seats->add($seat);
        $seat->addEvent($this);
    }
}
