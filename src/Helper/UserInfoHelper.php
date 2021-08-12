<?php


namespace App\Helper;


use App\Entity\UserInfo;
use App\Repository\UserInfoRepository;

class UserInfoHelper
{
    private $userInfoRepository;

    public function __construct(UserInfoRepository $repository)
    {
        $this->userInfoRepository = $repository;
    }

    public function findOrCreate($userId)
    {
        return $this->userInfoRepository->findOneBy(['user' => $userId]) ?: (new UserInfo());
    }

}