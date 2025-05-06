<?php

use App\Models\Domain;
use App\Models\User;
use App\Policies\DomainPolicy;
use Mockery as m;

beforeEach(function () {
    $this->policy = new DomainPolicy();

    $this->owner = m::mock(User::class);
    $this->owner->shouldReceive('getAttribute')->with('id')->andReturn(1);

    $this->otherUser = m::mock(User::class);
    $this->otherUser->shouldReceive('getAttribute')->with('id')->andReturn(2);

    $this->domain = m::mock(Domain::class);
    $this->domain->shouldReceive('getAttribute')->with('user_id')->andReturn(1);
});

test('owner can update domain', function () {
    $result = $this->policy->update($this->owner, $this->domain);
    expect($result)->toBeTrue();
});

test('non-owner cannot update domain', function () {
    $result = $this->policy->update($this->otherUser, $this->domain);
    expect($result)->toBeFalse();
});

test('owner can delete domain', function () {
    $result = $this->policy->delete($this->owner, $this->domain);
    expect($result)->toBeTrue();
});

test('non-owner cannot delete domain', function () {
    $result = $this->policy->delete($this->otherUser, $this->domain);
    expect($result)->toBeFalse();
});
