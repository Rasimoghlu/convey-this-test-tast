<?php

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Mockery as m;

beforeEach(function () {
    $this->admin = m::mock(User::class);
    $this->admin->shouldReceive('isAdmin')->andReturn(true);

    $this->user = m::mock(User::class);
    $this->user->shouldReceive('isAdmin')->andReturn(false);
});

test('view admin pages gate allows admin users', function () {
    $result = Gate::forUser($this->admin)->allows('view-admin-pages');
    expect($result)->toBeTrue();
});

test('view admin pages gate denies regular users', function () {
    $result = Gate::forUser($this->user)->denies('view-admin-pages');
    expect($result)->toBeTrue();
});
