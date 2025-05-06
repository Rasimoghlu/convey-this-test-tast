<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function getAllUsers(int $perPage = 20): LengthAwarePaginator;
    public function getUserById(int $id): ?User;
    public function updateUserPlan(int $userId, int $planId): bool;
}
