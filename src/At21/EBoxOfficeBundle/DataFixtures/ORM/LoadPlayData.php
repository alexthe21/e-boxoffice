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
use At21\EBoxOfficeBundle\Entity\Play;

class LoadPlayData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $play1 = new Play();
        $play1
            ->setTitle('The Bull')
            ->setDescription('A razor-sharp play about the fine line between office politics and playground bullying,
             Bull offers ringside seats as three employees fight to keep their jobs.
             Following his West End hit King Charles III, don\'t miss this London premiere from award-winning playwright
             Mike Bartlett, directed by Clare Lizzimore.')
            ->setFromDate(new \DateTime('2015-01-30'))
            ->setToDate(new \DateTime('2015-02-17'));

        $play2 = new Play();
        $play2
            ->setTitle('How To Hold Your Breath')
            ->setDescription('Because we live in Europe. Because nothing really bad happens. The worst is a bit of an
            inconvenience. Perhaps not such a good mini break. But really in the grand scheme of life, not so bad.')
            ->setFromDate(new \DateTime('2015-02-5'))
            ->setToDate(new \DateTime('2015-02-28'));

        $play3 = new Play();
        $play3
            ->setTitle('Taken At Midnight')
            ->setDescription('Penelope Wilton originates the role of Irmgard, the mother of celebrated lawyer Hans
            Litten who puts Hitler on the witness stand in 1930s Germany with devastating consequences.')
            ->setFromDate(new \DateTime('2015-05-01'))
            ->setToDate(new \DateTime('2015-05-17'));

        $manager->persist($play1);
        $manager->persist($play2);
        $manager->persist($play3);
        $manager->flush();

        $this->addReference('play1', $play1);
        $this->addReference('play2', $play2);
        $this->addReference('play3', $play3);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 2;
    }
}