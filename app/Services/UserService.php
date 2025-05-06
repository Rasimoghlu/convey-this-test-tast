<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function getAllUsers(int $perPage = 20): LengthAwarePaginator
    {
        return $this->userRepository->getAllUsers($perPage);
    }
}
