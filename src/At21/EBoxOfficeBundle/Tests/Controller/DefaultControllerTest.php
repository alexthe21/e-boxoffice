<?php

namespace Acme\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Tests\Functional\WebTestCase;

class DefaultControllerTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;
    }

    public function testIndex()
    {

        $plays = $this->em
            ->getRepository('At21EBoxOfficeBundle:Play')
            ->findAll()
        ;
        $this->assertContainsOnlyInstancesOf('At21\EBoxOfficeBundle\Entity\Play', $plays);

    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
    }
}
