<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers(int $perPage = 20): LengthAwarePaginator
    {
        return User::with('domains')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getUserById(int $id): ?User
    {
        return User::find($id);
    }

    public function updateUserPlan(int $userId, int $planId): bool
    {
        return User::where('id', $userId)->update(['plan_id' => $planId]);
    }
}
