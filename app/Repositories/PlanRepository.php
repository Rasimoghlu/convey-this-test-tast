<?php

namespace App\Repositories;

use App\Models\Plan;
use App\Repositories\Interfaces\PlanRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PlanRepository implements PlanRepositoryInterface
{
    public function getAllPlans(): Collection
    {
        return Plan::all();
    }

    public function getPlanById(int $id): ?Plan
    {
        return Plan::find($id);
    }
} 