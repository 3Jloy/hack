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

class EventsService implements SecuredApplicationServiceInterface
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
        $events = $this->eventRepository->getEvents();
        $currentUser = $this->userRepository->findByEmail($user->getEmail());
        $userTickets = $this->ticketRepository->getUserTickets($currentUser);
        if (!empty($userTickets)) {
            $userTicketKeys = array_map(function (EventTicket $eventTicket) {
                return $eventTicket->getEvent()->getId();
            }, $userTickets);
            $userTickets = array_map(function (EventTicket $eventTicket) {
                return [
                    'id' => $eventTicket->getId(),
                    'is_confirmed' => $eventTicket->isConfirmed(),
                    'is_visited' => $eventTicket->isVisited(),
                ];
            }, $userTickets);
            $userTickets = array_combine($userTicketKeys, $userTickets);
        }


        //todo: распределить билеты по пользователям и эвентам
        $events = array_map(function (Event $event) use($userTickets) {
            return [
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
                'location' => [
                    'title' => $event->getLocation()->getTitle(),
                    'lat' => $event->getLocation()->getLat(),
                    'long' => $event->getLocation()->getLong(),
                    'description' => $event->getLocation()->getDescription(),
                ],
                'number' => $event->getNumber(),
                'startDate' => $event->getStartDate()->getTimestamp(),
                'endDate' => $event->getEndDate()->getTimestamp(),
                'ticket' => $userTickets[$event->getId()] ?? null
            ];
        }, $events);

        return new BaseResponse($events);
    }
}