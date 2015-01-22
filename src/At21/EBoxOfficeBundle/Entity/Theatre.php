<?php

namespace At21\EBoxOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Theatre
 *
 * @ORM\Table()
 * @ORM\Entity()
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
     * @ORM\Version
     * @ORM\Column(type="integer")
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

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
     * @return Theatre
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Theatre
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
