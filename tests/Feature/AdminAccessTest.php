<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Mockery;

beforeEach(function () {
    $this->adminMock = Mockery::mock(User::class)->makePartial();
    $this->adminMock->shouldReceive('isAdmin')->andReturn(true);
    
    $this->userMock = Mockery::mock(User::class)->makePartial();
    $this->userMock->shouldReceive('isAdmin')->andReturn(false);
    
    Gate::shouldReceive('allows')
        ->withArgs(['view-admin-pages'])
        ->andReturnUsing(function ($ability, $arguments = []) {
            return $arguments[0]->isAdmin();
        });
        
    Gate::shouldReceive('denies')
        ->withArgs(['view-admin-pages'])
        ->andReturnUsing(function ($ability, $arguments = []) {
            return !$arguments[0]->isAdmin();
        });
});

test('admin can access users page', function () {
    $this->actingAs($this->adminMock);
    
    $response = $this->get('/users');

    $response->assertStatus(200);
});

test('regular user cannot access users page', function () {
    $this->actingAs($this->userMock);
    
    $response = $this->get('/users');

    $response->assertStatus(403);
});

test('guest cannot access users page', function () {
    $response = $this->get('/users');

    $response->assertRedirect('/login');
}); 