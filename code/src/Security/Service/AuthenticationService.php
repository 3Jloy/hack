<?php

namespace App\Security\Service;

use App\Entity\User;
use App\Infrastructure\Storage\SmsCodeStorageInterface;
use App\Repository\UserRepository;
use App\Response\BaseResponse;
use App\Security\Generator\SmsCodeGeneratorInterface;
use App\Security\Validator\ValidatorInterface;
use App\Service\ApplicationServiceInterface;
use Predis\ClientInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationService implements ApplicationServiceInterface
{
    /** @var ClientInterface */
    private $redis;

    /** @var UserRepository */
    private $userRepository;

    /** @var SmsCodeGeneratorInterface */
    private $smsCodeGenerator;

    /** @var SmsCodeStorageInterface */
    private $smsCodeStorage;

    /** @var ValidatorInterface */
    private $smsCodeValidator;

    public function __construct(
        ClientInterface $redis,
        UserRepository $userRepository,
        SmsCodeGeneratorInterface $smsCodeGenerator,
        SmsCodeStorageInterface $smsCodeStorage,
        ValidatorInterface $smsCodeValidator
    ) {
        $this->redis = $redis;
        $this->userRepository = $userRepository;
        $this->smsCodeGenerator = $smsCodeGenerator;
        $this->smsCodeStorage = $smsCodeStorage;
        $this->smsCodeValidator = $smsCodeValidator;
    }

    /**
     * @inheritDoc
     */
    public function invoke(Request $request)
    {
        $email = $request->get('email');
        if ($email) {
            try {
                $this->initializeUser($email);
                return new BaseResponse([['token' => $this->generateToken($email)]]);
            } catch (\Exception $exception) {
                return new BaseResponse([], 500, 'Обратись к Юрцу');
            }
        }

        return new BaseResponse([], 400, 'Не передан обязательный параметр: email');
    }

    /**
     * @param $prefix
     * @return string
     */
    private function generateToken(string $prefix) : string
    {
        $token = uniqid(hash('sha256',$prefix));
        $this->redis->set($token, $prefix);
        return $token;
    }

    /**
     * @param string $phone
     * @param string $code
     * @return BaseResponse
     */
    private function validateCode(string $phone, string $code): BaseResponse
    {
        $storedCode = $this->smsCodeStorage->get($phone);
        if ($this->smsCodeValidator->isEqual($code, $storedCode)) {
            return new BaseResponse(['token' => $this->generateToken($phone)]);
        }

        return new BaseResponse([], Response::HTTP_FORBIDDEN, 'Неверный код подтвержедния');
    }

    /**
     *
     * @param string $email
     * @return BaseResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function initializeUser(string $email): BaseResponse
    {
        $code = $this->smsCodeGenerator->generateSmsCode();
        if ($user = $this->userRepository->findByEmail($email)) {
            $this->smsCodeStorage->set($email, $code);
            return new BaseResponse([], Response::HTTP_CREATED);
        }

        $user = new User($email);
        $user->setIsMentor(false);
        $this->userRepository->save($user);
        $this->smsCodeStorage->set($email, $code);
        return new BaseResponse([], Response::HTTP_CREATED);
    }
}