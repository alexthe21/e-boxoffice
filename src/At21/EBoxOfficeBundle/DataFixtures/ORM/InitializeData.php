<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20/01/15
 * Time: 11:27
 */

namespace At21\EBoxOfficeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use At21\EBoxOfficeBundle\Entity\Theatre;
use At21\EBoxOfficeBundle\Entity\Event;

class InitializeData implements FixtureInterface
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

        $event1 = new Event();
        $event1
            ->setTitle('The Bull')
            ->setDescription('A razor-sharp play about the fine line between office politics and playground bullying,
             Bull offers ringside seats as three employees fight to keep their jobs.
             Following his West End hit King Charles III, don\'t miss this London premiere from award-winning playwright
             Mike Bartlett, directed by Clare Lizzimore.')
            ->setPrice(25)
            ->setDate(new \DateTime('2015-01-30 19:45'))
            ->setTheatre($theatre1)
            ->initializeSeats();
        $event2 = new Event();
        $event2
            ->setTitle('How To Hold Your Breath')
            ->setDescription('Because we live in Europe. Because nothing really bad happens. The worst is a bit of an
            inconvenience. Perhaps not such a good mini break. But really in the grand scheme of life, not so bad.')
            ->setPrice(12.00)
            ->setDate(new \DateTime('2015-02-05 19:30'))
            ->setTheatre($theatre2)
            ->initializeSeats();
        $event3 = new Event();
        $event3
            ->setTitle('Taken At Midnight')
            ->setDescription('Penelope Wilton originates the role of Irmgard, the mother of celebrated lawyer Hans
            Litten who puts Hitler on the witness stand in 1930s Germany with devastating consequences.')
            ->setPrice(50.75)
            ->setDate(new \DateTime('2015-05-01 20:00'))
            ->setTheatre($theatre3)
            ->initializeSeats();
        $manager->persist($event1);
        $manager->persist($event2);
        $manager->persist($event3);
        $manager->flush();
    }
}