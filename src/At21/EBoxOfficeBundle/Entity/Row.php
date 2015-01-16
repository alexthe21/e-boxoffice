<?php

namespace At21\EBoxOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Row
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Row
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
     * ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Seat", mappedBy="row")
     */
    private $seats;

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
     * Set seats
     *
     * @return ArrayCollection $seats
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * Set seats
     *
     * @param ArrayCollection $seats
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;
    }
}
