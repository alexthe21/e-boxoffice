<?php

namespace At21\EBoxOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seat
 *
 * @ORM\Table()
 * @ORM\Entity
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
     * @var boolean
     *
     * @ORM\Column(name="isBusy", type="binary")
     */
    private $isBusy;

    /**
     * @var Row
     *
     * @ORM\ManyToOne(targetEntity="Row", inversedBy="seats")
     */
    private $row;

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
     * Set isBusy
     *
     * @param boolean $isBusy
     * @return Seat
     */
    public function setIsBusy($isBusy)
    {
        $this->isBusy = $isBusy;

        return $this;
    }

    /**
     * Get isBusy
     *
     * @return boolean
     */
    public function getIsBusy()
    {
        return $this->isBusy;
    }

    /**
     * Set row
     *
     * @return Row
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * Get row
     *
     * @param Row $row
     */
    public function setRow($row)
    {
        $this->row = $row;
    }
}
