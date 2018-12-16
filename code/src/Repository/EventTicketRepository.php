<?php

namespace App\Repository;

use App\Entity\Event;
use App\Entity\EventTicket;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class EventTicketRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EventTicket::class);
    }

    /**
     * @param EventTicket $eventTicket
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(EventTicket $eventTicket)
    {
        $this->_em->persist($eventTicket);
        $this->_em->flush();
    }

    public function getUserTickets(User $user, Event $event = null): array
    {
        $criteria = ['user' => $user->getId()];
        if ($event) {
            $criteria['event'] = $event->getId();
        }
        return $this->findBy($criteria);
    }
}