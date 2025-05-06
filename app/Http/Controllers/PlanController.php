<?php

namespace App\Http\Controllers;

use App\Services\PlanService;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function __construct(
        private readonly PlanService $planService
    )
    {
    }

    public function index()
    {
        $plans = $this->planService->getAllPlans();

        return view('plans', compact('plans'));
    }

    public function buy(Request $request, Plan $plan)
    {
        $result = $this->planService->buyPlan($plan->id);

        return redirect()->route('plans')
            ->with($result['success'] ? 'success' : 'error', $result['message']);
    }
}
