<?php

namespace Tests\Unit;

use App\Models\Domain;
use App\Models\User;
use App\Repositories\Interfaces\DomainRepositoryInterface;
use App\Services\DomainService;
use Illuminate\Support\Facades\Auth;
use Mockery;

beforeEach(function () {
    $this->mockDomainRepo = Mockery::mock(DomainRepositoryInterface::class);
    $this->domainService = new DomainService($this->mockDomainRepo);
    
    $this->userMock = Mockery::mock(User::class);
    $this->userMock->id = 1;
    
    Auth::shouldReceive('id')->andReturn($this->userMock->id);
});

test('getUserDomains returns user domains', function () {
    $domainsMock = collect([
        Mockery::mock(Domain::class),
        Mockery::mock(Domain::class),
        Mockery::mock(Domain::class)
    ]);

    $this->mockDomainRepo
        ->shouldReceive('getAllByUser')
        ->once()
        ->with($this->userMock->id)
        ->andReturn($domainsMock);

    $result = $this->domainService->getUserDomains();

    expect($result)->toHaveCount(3);
    expect($result)->toBe($domainsMock);
});

test('createDomain creates new domain', function () {
    $domainMock = Mockery::mock(Domain::class);

    $this->mockDomainRepo
        ->shouldReceive('createDomain')
        ->once()
        ->with(['user_id' => $this->userMock->id, 'domain' => 'example.com'])
        ->andReturn($domainMock);

    $result = $this->domainService->createDomain('http://example.com/some/path');

    expect($result['success'])->toBeTrue();
    expect($result['message'])->toBe('Domain added successfully.');
});

test('updateDomain updates existing domain', function () {
    $domainMock = Mockery::mock(Domain::class);
    $domainMock->id = 1;
    $domainMock->user_id = $this->userMock->id;

    $this->mockDomainRepo
        ->shouldReceive('getDomainById')
        ->once()
        ->with(1)
        ->andReturn($domainMock);

    $this->mockDomainRepo
        ->shouldReceive('updateDomain')
        ->once()
        ->with(1, ['domain' => 'new-domain.com'])
        ->andReturn(true);

    $result = $this->domainService->updateDomain(1, 'https://new-domain.com');

    expect($result['success'])->toBeTrue();
    expect($result['message'])->toBe('Domain updated successfully.');
});

test('updateDomain returns error when domain not found', function () {
    $this->mockDomainRepo
        ->shouldReceive('getDomainById')
        ->once()
        ->with(999)
        ->andReturn(null);

    $result = $this->domainService->updateDomain(999, 'new-domain.com');

    expect($result['success'])->toBeFalse();
    expect($result['message'])->toBe('Domain not found.');
}); 