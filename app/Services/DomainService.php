<?php

namespace App\Services;

use App\Repositories\Interfaces\DomainRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class DomainService
{
    public function __construct(
        private readonly DomainRepositoryInterface $domainRepository
    ) {}

    public function getUserDomains(): Collection
    {
        return $this->domainRepository->getAllByUser(Auth::id());
    }

    public function createDomain(string $domainInput): array
    {
        // Clean the domain input (remove https://, www, path, etc)
        $domain = $this->cleanDomainInput($domainInput);

        // Create the domain
        $this->domainRepository->createDomain([
            'user_id' => Auth::id(),
            'domain' => $domain
        ]);

        return [
            'success' => true,
            'message' => 'Domain added successfully.'
        ];
    }

    public function updateDomain(int $id, string $domainInput): array
    {
        $domain = $this->domainRepository->getDomainById($id);

        // Check if domain exists and belongs to the user
        if (!$domain) {
            return [
                'success' => false,
                'message' => 'Domain not found.'
            ];
        }

        // Clean the domain input
        $cleanDomain = $this->cleanDomainInput($domainInput);

        // Update the domain
        $this->domainRepository->updateDomain($id, [
            'domain' => $cleanDomain
        ]);

        return [
            'success' => true,
            'message' => 'Domain updated successfully.'
        ];
    }

    public function deleteDomain(int $id): array
    {
        $domain = $this->domainRepository->getDomainById($id);

        // Check if domain exists
        if (!$domain) {
            return [
                'success' => false,
                'message' => 'Domain not found.'
            ];
        }

        // Delete the domain
        $this->domainRepository->deleteDomain($id);

        return [
            'success' => true,
            'message' => 'Domain deleted successfully.'
        ];
    }

    private function cleanDomainInput(string $input): string
    {
        if ($input === null) {
            return '';
        }

        // Remove protocol (http://, https://)
        $domain = preg_replace('(^https?://)', '', $input);

        // Remove www.
        $domain = preg_replace('/^www\./', '', $domain);

        // Remove anything after the first slash
        $domain = explode('/', $domain)[0];

        // Remove any query parameters
        $domain = explode('?', $domain)[0];

        // Trim whitespace
        $domain = trim($domain);

        return $domain;
    }
}
