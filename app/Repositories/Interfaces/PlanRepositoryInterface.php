<?php

namespace App\Repositories\Interfaces;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Collection;

interface PlanRepositoryInterface
{
    public function getAllPlans(): Collection;
    public function getPlanById(int $id): ?Plan;
} 