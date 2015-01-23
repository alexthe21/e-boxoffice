<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20/01/15
 * Time: 11:27
 */

namespace At21\EBoxOfficeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use At21\EBoxOfficeBundle\Entity\Session;

class LoadSessionData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $date = new \DateTime('today');
        $date2 = clone $date;
        $date2->add(new \DateInterval('PT5H'));
        $date3 = clone $date;
        $date3->add(new \DateInterval('PT10H'));
        $session1 = new Session();
        $session1
            ->setDate($date)
            ->setPlay($this->getReference('play1'))
            ->setTheatre($this->getReference('theatre1'))
            ->setPrice(25.60)
            ->initializeSeats();
        $session2 = new Session();
        $session2
            ->setDate($date2)
            ->setPlay($this->getReference('play1'))
            ->setTheatre($this->getReference('theatre1'))
            ->setPrice(25.60)
            ->initializeSeats();
        $session3 = new Session();
        $session3
            ->setDate($date3)
            ->setPlay($this->getReference('play1'))
            ->setTheatre($this->getReference('theatre1'))
            ->setPrice(25.60)
            ->initializeSeats();

        $session4 = new Session();
        $session4
            ->setDate($date)
            ->setPlay($this->getReference('play2'))
            ->setTheatre($this->getReference('theatre2'))
            ->setPrice(25.60)
            ->initializeSeats();
        $session5 = new Session();
        $session5
            ->setDate($date2)
            ->setPlay($this->getReference('play2'))
            ->setTheatre($this->getReference('theatre2'))
            ->setPrice(25.60)
            ->initializeSeats();
        $session6 = new Session();
        $session6
            ->setDate($date3)
            ->setPlay($this->getReference('play2'))
            ->setTheatre($this->getReference('theatre2'))
            ->setPrice(25.60)
            ->initializeSeats();

        $session7 = new Session();
        $session7
            ->setDate($date)
            ->setPlay($this->getReference('play3'))
            ->setTheatre($this->getReference('theatre3'))
            ->setPrice(25.60)
            ->initializeSeats();
        $session8 = new Session();
        $session8
            ->setDate($date2)
            ->setPlay($this->getReference('play3'))
            ->setTheatre($this->getReference('theatre3'))
            ->setPrice(25.60)
            ->initializeSeats();
        $session9 = new Session();
        $session9
            ->setDate($date3)
            ->setPlay($this->getReference('play3'))
            ->setTheatre($this->getReference('theatre3'))
            ->setPrice(25.60)
            ->initializeSeats();

        $manager->persist($session1);
        $manager->persist($session2);
        $manager->persist($session3);
        $manager->persist($session4);
        $manager->persist($session5);
        $manager->persist($session6);
        $manager->persist($session7);
        $manager->persist($session8);
        $manager->persist($session9);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 3;
    }
}