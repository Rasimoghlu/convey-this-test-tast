<?php

namespace App\Repositories\Interfaces;

use App\Models\Domain;
use Illuminate\Database\Eloquent\Collection;

interface DomainRepositoryInterface
{
    public function getAllByUser(int $userId): Collection;
    public function getDomainById(int $id): ?Domain;
    public function createDomain(array $domainData): Domain;
    public function updateDomain(int $id, array $domainData): bool;
    public function deleteDomain(int $id): bool;
    public function domainExists(string $domain): bool;
} 