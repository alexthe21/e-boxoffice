<?php

namespace At21\EBoxOfficeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends EntityRepository
{
    /**
     * @param integer $eventId
     * @return array
     */
    public function getTheatre($eventId)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT e FROM At21EBoxOfficeBundle:Event e WHERE e.id = :eventId'
            )
            ->setParameter('eventId', $eventId)
            ->getResult();
    }
}
