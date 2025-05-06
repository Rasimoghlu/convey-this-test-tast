<?php

namespace App\Services;

use App\Repositories\Interfaces\PlanRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PlanService
{
    public function __construct(
        private readonly PlanRepositoryInterface $planRepository,
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function getAllPlans(): Collection
    {
        return $this->planRepository->getAllPlans();
    }

    public function buyPlan(int $planId): array
    {
        $plan = $this->planRepository->getPlanById($planId);

        if (!$plan) {
            return [
                'success' => false,
                'message' => 'Plan not found.'
            ];
        }

        // Update user's plan
        $this->userRepository->updateUserPlan(Auth::id(), $planId);

        return [
            'success' => true,
            'message' => 'Plan updated successfully.'
        ];
    }
} 