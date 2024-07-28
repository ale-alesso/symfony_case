<?php

namespace App\Service;

use App\Repository\UserRepository;

class UserService
{
    public function __construct(private readonly UserRepository $userRepository)
    {}

    public function getUserByEmail(string $email)
    {
        return $this->userRepository->findByEmail($email);
    }

    public function getUsersByRole(string $role)
    {
        return $this->userRepository->findByRole($role);
    }

    public function getUsersCreatedAfter(\DateTime $date)
    {
        return $this->userRepository->findCreatedAfter($date);
    }
}
