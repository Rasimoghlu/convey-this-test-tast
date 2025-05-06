<?php

namespace Tests\Unit;

use App\Models\Domain;
use App\Models\User;
use App\Policies\DomainPolicy;
use Mockery;

beforeEach(function () {
    $this->policy = new DomainPolicy();

    $this->ownerMock = Mockery::mock(User::class);
    $this->ownerMock->id = 1;

    $this->otherUserMock = Mockery::mock(User::class);
    $this->otherUserMock->id = 2;

    $this->domainMock = Mockery::mock(Domain::class);
    $this->domainMock->user_id = 1;
});

test('owner can update domain', function () {
    expect($this->policy->update($this->ownerMock, $this->domainMock))->toBeTrue();
});

test('non-owner cannot update domain', function () {
    expect($this->policy->update($this->otherUserMock, $this->domainMock))->toBeFalse();
});

test('owner can delete domain', function () {
    expect($this->policy->delete($this->ownerMock, $this->domainMock))->toBeTrue();
});

test('non-owner cannot delete domain', function () {
    expect($this->policy->delete($this->otherUserMock, $this->domainMock))->toBeFalse();
});
