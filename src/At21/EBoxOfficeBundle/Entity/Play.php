<?php

namespace At21\EBoxOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Play
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="At21\EBoxOfficeBundle\Entity\PlayRepository")
 */
class Play
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
     * @var \DateTime
     *
     * @ORM\Column(name="fromDate", type="datetime")
     */
    private $fromDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="toDate", type="datetime")
     */
    private $toDate;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Session", mappedBy="play", cascade={"persist", "remove"})
     */
    private $sessions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessions = new ArrayCollection();
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
     * @return Play
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return  $this;
    }

    /**
     * Get fromDate
     *
     * @return \DateTime
     */
    public function getFromDate()
    {
        return $this->fromDate;
    }

    /**
     * Set fromDate
     *
     * @param \DateTime $fromDate
     * @return Play
     */
    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    /**
     * Get toDate
     *
     * @return \DateTime
     */
    public function getToDate()
    {
        return $this->toDate;
    }

    /**
     * Set toDate
     *
     * @param \DateTime $toDate
     * @return Play
     */
    public function setToDate($toDate)
    {
        $this->toDate = $toDate;

        return $this;
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
     * @return Play
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Play
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * Set sessions
     *
     * @param ArrayCollection $sessions
     * @return Play
     */
    public function setSessions($sessions)
    {
        $this->sessions = $sessions;

        return $this;
    }
}