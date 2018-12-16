<?php

namespace App\Repository;

use App\Entity\Note;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class NoteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Note::class);
    }

    /**
     * @param Note $note
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Note $note)
    {
        $this->_em->persist($note);
        $this->_em->flush();
    }

    public function getNotes($userId, $eventId): array
    {
        return $this->findBy(['user' => $userId, 'event' => $eventId]);
    }
}