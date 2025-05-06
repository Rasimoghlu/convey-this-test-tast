@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Choose Your Plan</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        @foreach ($plans as $plan)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-header text-center">
                                        <h5 class="mb-0">{{ $plan->plan_name }}</h5>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <h2 class="text-center mb-4">${{ $plan->price }}<small class="text-muted">/month</small></h2>
                                        
                                        <ul class="list-group list-group-flush mb-4">
                                            @if(is_array($plan->features) || is_object($plan->features))
                                                @foreach ($plan->features as $feature => $value)
                                                    <li class="list-group-item">
                                                        <strong>{{ $feature }}:</strong> {{ $value }}
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="list-group-item">
                                                    <strong>Features:</strong> {{ $plan->features }}
                                                </li>
                                            @endif
                                        </ul>
                                        
                                        <div class="text-center mt-auto">
                                            <form action="{{ route('plans.buy', $plan->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary{{ Auth::user()->plan_id == $plan->id ? ' disabled' : '' }}">
                                                    {{ Auth::user()->plan_id == $plan->id ? 'Current Plan' : 'Buy' }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 