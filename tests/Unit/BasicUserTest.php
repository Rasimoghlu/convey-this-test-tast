<?php

use App\Models\User;

test('user admin check works', function () {
    $admin = new User();
    $admin->is_admin = true;
    
    expect($admin->isAdmin())->toBeTrue();
    
    $user = new User();
    $user->is_admin = false;
    
    expect($user->isAdmin())->toBeFalse();
}); 