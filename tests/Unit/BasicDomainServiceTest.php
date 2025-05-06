<?php

use App\Models\Domain;
use App\Repositories\Interfaces\DomainRepositoryInterface;
use App\Services\DomainService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Mockery as m;

beforeEach(function () {
    $this->repository = m::mock(DomainRepositoryInterface::class);
    $this->service = new DomainService($this->repository);

    Auth::shouldReceive('id')->andReturn(1);
});

test('getUserDomains returns domains from repository', function () {
    $domains = new Collection([
        new Domain(),
        new Domain()
    ]);

    $this->repository
        ->shouldReceive('getAllByUser')
        ->once()
        ->with(1)
        ->andReturn($domains);

    $result = $this->service->getUserDomains();

    expect($result)->toHaveCount(2);
    expect($result)->toBe($domains);
});

test('createDomain creates domain with cleaned input', function () {
    $this->repository
        ->shouldReceive('createDomain')
        ->once()
        ->with([
            'user_id' => 1,
            'domain' => 'example.com'
        ])
        ->andReturn(new Domain());

    $result = $this->service->createDomain('http://example.com/path');

    expect($result['success'])->toBeTrue();
    expect($result['message'])->toBe('Domain added successfully.');
});
