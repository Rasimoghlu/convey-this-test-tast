<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Mockery;

beforeEach(function () {
    $this->adminMock = Mockery::mock(User::class);
    $this->adminMock->shouldReceive('isAdmin')->andReturn(true);

    $this->userMock = Mockery::mock(User::class);
    $this->userMock->shouldReceive('isAdmin')->andReturn(false);
});

test('view admin pages gate allows admin users', function () {
    expect(Gate::forUser($this->adminMock)->allows('view-admin-pages'))->toBeTrue();
});

test('view admin pages gate denies regular users', function () {
    expect(Gate::forUser($this->userMock)->denies('view-admin-pages'))->toBeTrue();
});
