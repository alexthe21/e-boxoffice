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
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class InitializeData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $theatre1 = $this->container->get('at21_eboxoffice_theatre');
        $theatre1
            ->setName('Young Vic')
            ->setNumberOfRows(30)
            ->setNumberOfSeatsPerRow(18);
        $theatre2 = $this->container->get('at21_eboxoffice_theatre');
        $theatre2
            ->setName('The Royal Court Theatre')
            ->setNumberOfRows(30)
            ->setNumberOfSeatsPerRow(15);
        $theatre3 = $this->container->get('at21_eboxoffice_theatre');
        $theatre3
            ->setName('Haymarket Theatre')
            ->setNumberOfRows(30)
            ->setNumberOfSeatsPerRow(30);

        $manager->persist($theatre1);
        $manager->persist($theatre2);
        $manager->persist($theatre3);
        $manager->flush();

        $play1 = $this->container->get('at21_eboxoffice_play');
        $play1
            ->setTitle('The Bull')
            ->setDescription('A razor-sharp play about the fine line between office politics and playground bullying,
             Bull offers ringside seats as three employees fight to keep their jobs.
             Following his West End hit King Charles III, don\'t miss this London premiere from award-winning playwright
             Mike Bartlett, directed by Clare Lizzimore.')
            ->setFromDate(new \DateTime('2015-01-30'))
            ->setToDate(new \DateTime('2015-02-17'));
        $play2 = $this->container->get('at21_eboxoffice_play');
        $play2
            ->setTitle('How To Hold Your Breath')
            ->setDescription('Because we live in Europe. Because nothing really bad happens. The worst is a bit of an
            inconvenience. Perhaps not such a good mini break. But really in the grand scheme of life, not so bad.')
            ->setFromDate(new \DateTime('2015-02-5'))
            ->setToDate(new \DateTime('2015-02-28'));
        $play3 = $this->container->get('at21_eboxoffice_play');
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
    }
}