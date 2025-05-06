<?php

namespace Tests\Unit;

use App\Models\User;
use Mockery;

beforeEach(function () {
    $this->userMock = Mockery::mock(User::class)->makePartial();
});

test('isAdmin returns true when user is admin', function () {
    $this->userMock->is_admin = true;
    
    expect($this->userMock->isAdmin())->toBeTrue();
});

test('isAdmin returns false when user is not admin', function () {
    $this->userMock->is_admin = false;
    
    expect($this->userMock->isAdmin())->toBeFalse();
}); 