<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Response\BaseResponse;
use Symfony\Component\HttpFoundation\Request;

class MentorsService implements ApplicationServiceInterface
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
    public function invoke(Request $request): BaseResponse
    {
        $mentors = $this->userRepository->getMentors();
        $responseArray = array_map(function (User $user) {
            return [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'surname' => $user->getSurname(),
                'photo' => $user->getPhoto(),
                'phone' => $user->getPhone(),
                'email' => $user->getEmail(),
                'current_job' => $user->getCurrentJob(),
                'about' => $user->getAbout(),
                'is_mentor' => $user->isMentor(),
                'homeWorks' => []
            ];
        }, $mentors);

        return new BaseResponse($responseArray);
    }
}