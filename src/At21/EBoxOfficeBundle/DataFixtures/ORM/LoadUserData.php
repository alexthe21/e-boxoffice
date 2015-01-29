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
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
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
        $userManager = $this->container->get('fos_user.user_manager');

        $user1 = $userManager->createUser();
        $user1->setUsername('admin');
        $user1->setEmail('admin@email.com');
        $user1->setPlainPassword('admin');
        $user1->setEnabled(true);
        $user1->setRoles(array('ROLE_ADMIN'));

        $user2 = $userManager->createUser();
        $user2->setUsername('user1');
        $user2->setEmail('user1@email.com');
        $user2->setPlainPassword('user1');
        $user2->setEnabled(true);
        $user2->setRoles(array('ROLE_USER'));

        // Update the users
        $userManager->updateUser($user1, true);
        $userManager->updateUser($user2, true);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 4;
    }
}