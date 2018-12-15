<?php

namespace App\Repository;

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

    public function getUserTickets(User $user): array
    {
        return [];
    }
}