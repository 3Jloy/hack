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

class VacanciesService implements SecuredApplicationServiceInterface
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
        $vacancies = [
            ['title' => 'Frontend-разработчик (React + Redux)',
            'company' => 'amoCRM',
            'salary' => '90000 - 100000 ₽',],

            ['title' => 'Middle/Senior Android разработчик',
            'company' => 'Akvelon',
            'salary' => '90000 - 100000 ₽',],

            ['title' => 'Senior Android разработчик',
                'company' => 'Avito',
                'salary' => '100000 - 900000 ₽',],

            ['title' => 'Senior Android разработчик',
                'company' => 'SuperJob',
                'salary' => '90000 - 100000 ₽',],
        ];

        return new BaseResponse($vacancies);
    }
}