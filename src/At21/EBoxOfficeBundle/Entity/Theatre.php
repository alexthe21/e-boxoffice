<?php

namespace At21\EBoxOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Theatre
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Theatre
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
     * @var integer
     *
     * @ORM\Column(name="numberOfRows", type="integer")
     */
    private $numberOfRows;

    /**
     * @var integer
     *
     * @ORM\Column(name="numberOfSeatsPerRow", type="integer")
     */
    private $numberOfSeatsPerRow;


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
     * Set numberOfRows
     *
     * @param integer $numberOfRows
     * @return Theatre
     */
    public function setNumberOfRows($numberOfRows)
    {
        $this->numberOfRows = $numberOfRows;

        return $this;
    }

    /**
     * Get numberOfRows
     *
     * @return integer 
     */
    public function getNumberOfRows()
    {
        return $this->numberOfRows;
    }

    /**
     * Set numberOfSeatsPerRow
     *
     * @param integer $numberOfSeatsPerRow
     * @return Theatre
     */
    public function setNumberOfSeatsPerRow($numberOfSeatsPerRow)
    {
        $this->numberOfSeatsPerRow = $numberOfSeatsPerRow;

        return $this;
    }

    /**
     * Get numberOfSeatsPerRow
     *
     * @return integer 
     */
    public function getNumberOfSeatsPerRow()
    {
        return $this->numberOfSeatsPerRow;
    }
}
