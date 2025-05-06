<?php

namespace App\Http\Controllers;

use App\Http\Requests\DomainRequest;
use App\Services\DomainService;
use App\Models\Domain;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DomainController extends Controller
{
    public function __construct(
        private readonly DomainService $domainService
    )
    {

    }

    public function index()
    {
        $domains = $this->domainService->getUserDomains();

        return view('dashboard', compact('domains'));
    }

    public function store(DomainRequest $request): RedirectResponse
    {
        $result = $this->domainService->createDomain($request->domain);

        return redirect()->route('dashboard')
            ->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(DomainRequest $request, Domain $domain): RedirectResponse
    {
        $this->authorize('update', $domain);

        $result = $this->domainService->updateDomain($domain->id, $request->domain);

        return redirect()->route('dashboard')
            ->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Request $request, Domain $domain): RedirectResponse
    {
        $this->authorize('delete', $domain);

        $result = $this->domainService->deleteDomain($domain->id);

        return redirect()->route('dashboard')
            ->with($result['success'] ? 'success' : 'error', $result['message']);
    }
}
