<?php

namespace App\Service;

use App\Entity\ResourceLink;
use App\Repository\EventRepository;
use App\Repository\UserRepository;
use App\Response\BaseResponse;
use App\Security\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class ResourceLinksService implements SecuredApplicationServiceInterface
{
    private $eventRepository;

    private $userRepository;

    private $ticketRepository;

    public function __construct(
        UserRepository $userRepository,
        EventRepository $eventRepository
    ) {
        $this->userRepository = $userRepository;
        $this->eventRepository = $eventRepository;
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
        $links = $event->getResourcesLinks();

        $links = array_map(function (ResourceLink $resourceLink) {
            return [
                'id' => $resourceLink->getId(),
                'title' => $resourceLink->getTitle(),
                'link' => $resourceLink->getLink(),
                'type' => $resourceLink->getType(),
            ];
        }, $links);

        return new BaseResponse($links);
    }
}