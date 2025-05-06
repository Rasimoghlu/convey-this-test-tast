<?php

namespace App\Repositories;

use App\Models\Domain;
use App\Repositories\Interfaces\DomainRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DomainRepository implements DomainRepositoryInterface
{
    public function getAllByUser(int $userId): Collection
    {
        return Domain::where('user_id', $userId)->get();
    }

    public function getDomainById(int $id): ?Domain
    {
        return Domain::find($id);
    }

    public function createDomain(array $domainData): Domain
    {
        return Domain::create($domainData);
    }

    public function updateDomain(int $id, array $domainData): bool
    {
        return Domain::find($id)->update($domainData);
    }

    public function deleteDomain(int $id): bool
    {
        return Domain::find($id)->delete();
    }
    
    public function domainExists(string $domain): bool
    {
        return Domain::where('domain', $domain)->exists();
    }
} 