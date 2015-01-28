<?php

namespace Acme\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Tests\Functional\WebTestCase;

class PlayControllerTest extends KernelTestCase
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
        $theatres = $this->em
            ->getRepository('At21EBoxOfficeBundle:Theatre')
            ->findAll()
        ;
        $this->assertContainsOnlyInstancesOf('At21\EBoxOfficeBundle\Entity\Play', $plays);
        $this->assertContainsOnlyInstancesOf('At21\EBoxOfficeBundle\Entity\Theatre', $theatres);

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
