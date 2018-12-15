<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Response\BaseResponse;
use App\Security\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class MentorsService implements SecuredApplicationServiceInterface
{
    /** @var UserRepository  */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return \App\Response\BaseResponse;
     */
    public function invoke(User $user, Request $request): BaseResponse
    {
        $mentors = $this->userRepository->getMentors();
        $responseArray = array_map(function (\App\Entity\User $mentor) {
            return [
                'id' => $mentor->getId(),
                'name' => $mentor->getName(),
                'surname' => $mentor->getSurname(),
                'photo' => $mentor->getPhoto(),
                'phone' => $mentor->getPhone(),
                'email' => $mentor->getEmail(),
                'current_job' => $mentor->getCurrentJob(),
                'about' => $mentor->getAbout(),
                'is_mentor' => $mentor->isMentor(),
                'homeWorks' => []
            ];
        }, $mentors);

        return new BaseResponse($responseArray);
    }
}