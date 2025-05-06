<?php

use App\Models\Domain;
use App\Models\User;
use App\Repositories\Interfaces\DomainRepositoryInterface;
use App\Services\DomainService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Mockery;

beforeEach(function () {
    $this->userMock = Mockery::mock(User::class)->makePartial();
    $this->userMock->id = 1;

    $this->otherUserMock = Mockery::mock(User::class)->makePartial();
    $this->otherUserMock->id = 2;

    $this->domainMock = Mockery::mock(Domain::class)->makePartial();
    $this->domainMock->id = 1;
    $this->domainMock->user_id = $this->userMock->id;
    $this->domainMock->domain = 'old-domain.com';

    $this->otherDomainMock = Mockery::mock(Domain::class)->makePartial();
    $this->otherDomainMock->id = 2;
    $this->otherDomainMock->user_id = $this->otherUserMock->id;
    $this->otherDomainMock->domain = 'other-user-domain.com';

    Auth::shouldReceive('id')->andReturn($this->userMock->id);

    $domainRepoMock = Mockery::mock(DomainRepositoryInterface::class);
    $this->domainServiceMock = Mockery::mock(DomainService::class)->makePartial();

    $this->domainServiceMock->shouldReceive('getUserDomains')
        ->andReturn(new Collection([$this->domainMock]));

    $this->domainServiceMock->shouldReceive('createDomain')
        ->with('example.com')
        ->andReturn([
            'success' => true,
            'message' => 'Domain added successfully.'
        ]);

    $this->domainServiceMock->shouldReceive('updateDomain')
        ->with($this->domainMock->id, 'new-domain.com')
        ->andReturn([
            'success' => true,
            'message' => 'Domain updated successfully.'
        ]);

    $this->domainServiceMock->shouldReceive('deleteDomain')
        ->with($this->domainMock->id)
        ->andReturn([
            'success' => true,
            'message' => 'Domain deleted successfully.'
        ]);

    Domain::shouldReceive('find')
        ->with($this->domainMock->id)
        ->andReturn($this->domainMock);

    Domain::shouldReceive('find')
        ->with($this->otherDomainMock->id)
        ->andReturn($this->otherDomainMock);

    app()->instance(DomainService::class, $this->domainServiceMock);
});

test('user can view domain dashboard', function () {
    $this->actingAs($this->userMock);

    $response = $this->get('/dashboard');

    $response->assertStatus(200);
    $response->assertViewIs('dashboard');
});

test('user can create domain', function () {
    $this->actingAs($this->userMock);

    $response = $this->post('/domains', [
        'domain' => 'example.com'
    ]);

    $response->assertRedirect('/dashboard');
    $response->assertSessionHas('success');
});

test('user can update their domain', function () {
    $this->actingAs($this->userMock);

    $response = $this->put("/domains/{$this->domainMock->id}", [
        'domain' => 'new-domain.com'
    ]);

    $response->assertRedirect('/dashboard');
    $response->assertSessionHas('success');
});

test('user cannot update other users domain', function () {
    $this->actingAs($this->userMock);

    $response = $this->put("/domains/{$this->otherDomainMock->id}", [
        'domain' => 'attempted-change.com'
    ]);

    $response->assertStatus(403);
});

test('user can delete their domain', function () {
    $this->actingAs($this->userMock);

    $response = $this->delete("/domains/{$this->domainMock->id}");

    $response->assertRedirect('/dashboard');
    $response->assertSessionHas('success');
});

test('user cannot delete other users domain', function () {
    $this->actingAs($this->userMock);

    $response = $this->delete("/domains/{$this->otherDomainMock->id}");

    $response->assertStatus(403);
});
