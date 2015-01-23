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
use At21\EBoxOfficeBundle\Entity\Theatre;

class LoadTheatreData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $theatre1 = new Theatre();
        $theatre1
            ->setName('Young Vic')
            ->setNumberOfRows(30)
            ->setNumberOfSeatsPerRow(18);
        $theatre2 = new Theatre();
        $theatre2
            ->setName('The Royal Court Theatre')
            ->setNumberOfRows(30)
            ->setNumberOfSeatsPerRow(15);
        $theatre3 = new Theatre();
        $theatre3
            ->setName('Haymarket Theatre')
            ->setNumberOfRows(30)
            ->setNumberOfSeatsPerRow(30);

        $manager->persist($theatre1);
        $manager->persist($theatre2);
        $manager->persist($theatre3);
        $manager->flush();

        $this->addReference('theatre1', $theatre1);
        $this->addReference('theatre2', $theatre2);
        $this->addReference('theatre3', $theatre3);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 1;
    }
}