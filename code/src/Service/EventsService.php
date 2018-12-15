<?php

namespace App\Service;

use App\Entity\Event;
use App\Repository\EventRepository;
use App\Response\BaseResponse;
use App\Security\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class EventsService implements SecuredApplicationServiceInterface
{

    /** @var EventRepository  */
    private $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * @param User $user
     * @param Request $request
     * @return \App\Response\BaseResponse;
     */
    public function invoke(User $user, Request $request): BaseResponse
    {
        $events = $this->eventRepository->getEvents();
        $events = array_map(function (Event $event) {
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
                'number' => $event->getNumber(),
                'startDate' => $event->getStartDate()->getTimestamp(),
                'endDate' => $event->getEndDate()->getTimestamp(),
            ];
        }, $events);

        return new BaseResponse($events);
    }
}