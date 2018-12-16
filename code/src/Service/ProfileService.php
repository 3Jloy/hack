<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Response\BaseResponse;
use App\Security\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class ProfileService implements SecuredApplicationServiceInterface
{
    /** @var UserRepository  */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $user
     * @param Request $request
     * @return \App\Response\BaseResponse;
     */
    public function invoke(User $user, Request $request): BaseResponse
    {
        $currentUser = $this->userRepository->findByEmail($user->getEmail());
        $mentor = $currentUser->getMentor();
        if ($mentor) {
            $mentor = [
                'id' => $mentor->getId(),
                'name' => $mentor->getName(),
                'surname' => $mentor->getSurname(),
                'photo' => $mentor->getPhoto(),
                'phone' => $mentor->getPhone(),
                'email' => $mentor->getEmail(),
                'current_job' => $mentor->getCurrentJob(),
                'about' => $mentor->getAbout(),
                'is_mentor' => $mentor->isMentor(),
                'homeWorks' => [],
            ];
        }

        $currentUser = [
            'id' => $currentUser->getId(),
            'name' => $currentUser->getName(),
            'surname' => $currentUser->getSurname(),
            'photo' => $currentUser->getPhoto(),
            'phone' => $currentUser->getPhone(),
            'email' => $currentUser->getEmail(),
            'current_job' => $currentUser->getCurrentJob(),
            'about' => $currentUser->getAbout(),
            'is_mentor' => $currentUser->isMentor(),
            'homeWorks' => $this->getRandomHomeWorks(),
            'lectures' => $this->getRandomLectures(),
            'mentor' => $mentor,
        ];
        return new BaseResponse($currentUser);
    }

    private function getRandomHomeWorks()
    {
        $works = [];
        for ($i = 0; $i < 12; $i++) {
            $works[] = [
                'number' => $i,
                'done' => (bool)mt_rand(0, 1),
            ];
        }

        return $works;
    }

    private function getRandomLectures()
    {
        $lectures = [];
        for ($i = 0; $i < 12; $i++) {
            $lectures[] = [
                'number' => $i,
                'visited' => (bool)mt_rand(0, 1),
            ];
        }

        return $lectures;
    }
}