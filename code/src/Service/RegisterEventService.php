<?php

namespace App\Service;

use App\Entity\Event;
use App\Entity\EventTicket;
use App\Repository\EventRepository;
use App\Repository\EventTicketRepository;
use App\Repository\UserRepository;
use App\Response\BaseResponse;
use App\Security\Entity\User;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\Request;

class RegisterEventService implements SecuredApplicationServiceInterface
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
        $userName = $request->get('user_name');
        $userSurname = $request->get('user_surname');

        if (empty($eventId)) {
            return new BaseResponse([], 400, 'Не передан обязательный параметр: event_id');
        }

        if (empty($userName)) {
            return new BaseResponse([], 400, 'Не передан обязательный параметр: user_name');
        }

        if (empty($userSurname)) {
            return new BaseResponse([], 400, 'Не передан обязательный параметр: user_surname');
        }



        $event = $this->eventRepository->getEvent($eventId);
        $currentUser = $this->userRepository->find(1);
        $currentUser->setName($userName);
        $currentUser->setSurname($userSurname);
        $userTicket = new EventTicket($currentUser, $event);
        $userTicket->setIsConfirmed(true);

        try {
            $this->userRepository->save($currentUser);
            $this->ticketRepository->save($userTicket);
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
                'ticket' => [
                    'id' => $userTicket->getId(),
                    'is_confirmed' => $userTicket->isConfirmed(),
                    'is_visited' => $userTicket->isVisited(),
                ]
            ];
            return new BaseResponse($event);
        } catch (\Exception $exception) {
            return new BaseResponse([], 500, 'Беги к Юрцу');
        }
    }
}