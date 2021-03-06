<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11/01/15
 * Time: 13:23
 */

namespace At21\EBoxOfficeBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Version
     * @ORM\Column(type="integer")
     */
    protected $version;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Seat", mappedBy="user", cascade={"persist", "remove"})
     */
    private $seats;

    public function __construct()
    {
        parent::__construct();
        // your own logic
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
     * @return User
     */
    public function setVersion($version)
    {
        $this->version = $version;

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
     * @return User
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;

        return $this;
    }


}