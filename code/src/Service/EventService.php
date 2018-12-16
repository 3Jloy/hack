<?php

namespace App\Service;

use App\Entity\Event;
use App\Entity\EventTicket;
use App\Repository\EventRepository;
use App\Repository\EventTicketRepository;
use App\Repository\UserRepository;
use App\Response\BaseResponse;
use App\Security\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class EventService implements SecuredApplicationServiceInterface
{
    private $eventRepository;

    private $userRepository;

    private $ticketRepository;

    public function __construct(
        UserRepository $userRepository,
        EventRepository $eventRepository,
        EventTicketRepository $ticketRepository
    ) {
        $this->userRepository = $userRepository;
        $this->eventRepository = $eventRepository;
        $this->ticketRepository = $ticketRepository;
    }

    /**
     * @param User $user
     * @param Request $request
     * @return \App\Response\BaseResponse;
     */
    public function invoke(User $user, Request $request): BaseResponse
    {
        $eventId = $request->get('event_id');

        if (empty($eventId)) {
            return new BaseResponse([], 400, 'Не передан обязательный параметр: email');
        }

        $event = $this->eventRepository->getEvent($eventId);
        $currentUser = $this->userRepository->findByEmail($user->getEmail());
        /** @var EventTicket[] $userTickets */
        $userTickets = $this->ticketRepository->getUserTickets($currentUser);
        $userTicket = null;
        if (isset($userTickets[0])) {
            $userTicket = [
                'id' => $userTickets[0]->getId(),
                'is_confirmed' => $userTickets[0]->isConfirmed(),
                'is_visited' => $userTickets[0]->isVisited(),
            ];
        }

        $event = [
            'id' => $event->getId(),
            'title' => $event->getTitle(),
            'mentor' => [
                'id' => $event->getMentor()->getId(),
                'name' => $event->getMentor()->getName(),
                'surname' => $event->getMentor()->getSurname(),
                'photo' => $event->getMentor()->getPhoto(),
                'phone' => $event->getMentor()->getPhone(),
                'email' => $event->getMentor()->getEmail(),
                'current_job' => $event->getMentor()->getCurrentJob(),
                'about' => $event->getMentor()->getAbout(),
                'is_mentor' => $event->getMentor()->isMentor(),
                'homeWorks' => []
            ],
            'description' => $event->getDescription(),
            'location' => [
                'title' => $event->getLocation()->getTitle(),
                'lat' => $event->getLocation()->getLat(),
                'long' => $event->getLocation()->getLong(),
                'description' => $event->getLocation()->getDescription(),
                'wifi' => [
                    'name' => $event->getLocation()->getWifi()->getName(),
                    'login' => $event->getLocation()->getWifi()->getLogin(),
                    'password' => $event->getLocation()->getWifi()->getPassword(),
                ],
            ],
            'number' => $event->getNumber(),
            'startDate' => $event->getStartDate()->getTimestamp(),
            'endDate' => $event->getEndDate()->getTimestamp(),
            'ticket' => $userTicket,
        ];

        return new BaseResponse($event);
    }
}