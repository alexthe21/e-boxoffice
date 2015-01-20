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
use At21\EBoxOfficeBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setEmail('admin@email.com');
        $userAdmin->setPassword('admin');
        $userAdmin->setEnabled(true);

        $manager->persist($userAdmin);
        $manager->flush();
    }
}