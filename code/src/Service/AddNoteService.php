<?php

namespace App\Service;

use App\Entity\Event;
use App\Entity\Note;
use App\Repository\EventRepository;
use App\Repository\EventTicketRepository;
use App\Repository\NoteRepository;
use App\Repository\UserRepository;
use App\Response\BaseResponse;
use App\Security\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class AddNoteService implements SecuredApplicationServiceInterface
{
    private $userRepository;

    private $noteRepository;

    private $eventRepository;

    public function __construct(
        UserRepository $userRepository,
        EventRepository $eventRepository,
        NoteRepository $noteRepository
    ) {
        $this->userRepository = $userRepository;
        $this->eventRepository = $eventRepository;
        $this->noteRepository = $noteRepository;
    }

    /**
     * @param User $user
     * @param Request $request
     * @return \App\Response\BaseResponse;
     */
    public function invoke(User $user, Request $request): BaseResponse
    {
        $eventId = $request->get('event_id');
        $text = $request->get('text');

        if (empty($eventId)) {
            return new BaseResponse([], 400, 'Не передан обязательный параметр: event_id');
        }

        if (empty($text)) {
            return new BaseResponse([], 400, 'Не передан обязательный параметр: text');
        }

        $currentUser = $this->userRepository->findByEmail($user->getEmail());
        $event = $this->eventRepository->getEvent($eventId);
        $note = new Note($currentUser, $event, $text);

        $this->noteRepository->save($note);

        return new BaseResponse([
            'id' => $note->getId(),
            'text' => $note->getText(),
        ]);
    }
}