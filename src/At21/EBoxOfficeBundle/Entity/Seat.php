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
     * @var boolean
     *
     * @ORM\Column(name="isBusy", type="boolean")
     */
    private $isBusy;

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
     * @var Event
     *
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="seats", cascade={"persist", "remove"})
     */
    private $event;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="seats", cascade={"persist"})
     */
    private $user;

    /**
     * Construct
     *
     * @param boolean $isBusy
     * @param integer $rowNumber
     * @param integer $columnNumber
     */
    public function __construct($event, $isBusy, $rowNumber, $columnNumber)
    {
        $this->event = $event;
        $this->isBusy = $isBusy;
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
     * Get ColumnNumber
     *
     * @return int
     */
    public function getRowNumber()
    {
        return $this->rowNumber;
    }

    /**
     * Set RowNumber
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
     * Get ColumnNumber
     *
     * @return int
     */
    public function getColumnNumber()
    {
        return $this->columnNumber;
    }

    /**
     * Set ColumnNumber
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
     * Set Event
     *
     * @return Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set event
     *
     * @param Event $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
        $event->addSet($this);
    }

    /**
     * Set User
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
