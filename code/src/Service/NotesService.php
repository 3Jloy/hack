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

class NotesService implements SecuredApplicationServiceInterface
{
    private $userRepository;

    private $noteRepository;

    public function __construct(
        UserRepository $userRepository,
        NoteRepository $noteRepository
    ) {
        $this->userRepository = $userRepository;
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

        if (empty($eventId)) {
            return new BaseResponse([], 400, 'Не передан обязательный параметр: email');
        }

        $currentUser = $this->userRepository->findByEmail($user->getEmail());
        $notes = $this->noteRepository->getNotes($currentUser->getId(), $eventId);
        $notes = array_map(function (Note $note) {
            return [
                'id' => $note->getId(),
                'text' => $note->getText(),
            ];
        }, $notes);

        return new BaseResponse($notes);
    }
}