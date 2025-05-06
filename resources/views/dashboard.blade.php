@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Manage Your Domains</h5>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDomainModal">
                        <i class="bi bi-plus-circle"></i> Add New Domain
                    </button>
                </div>

                <div class="card-body">
                    @if ($domains->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Domain</th>
                                        <th>Added on</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($domains as $domain)
                                        <tr>
                                            <td>{{ $domain->domain }}</td>
                                            <td>{{ $domain->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <button type="button" class="btn btn-sm btn-primary edit-domain" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editDomainModal"
                                                            data-id="{{ $domain->id }}"
                                                            data-domain="{{ $domain->domain }}">
                                                        <i class="bi bi-pencil-fill"></i> Edit
                                                    </button>
                                                    <form action="{{ route('domains.destroy', $domain->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this domain?')">
                                                            <i class="bi bi-trash-fill"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            You don't have any domains yet. Click the "Add New Domain" button to add one.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Domain Modal -->
<div class="modal fade" id="addDomainModal" tabindex="-1" aria-labelledby="addDomainModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDomainModalLabel">Add New Domain</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('domains.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="domain" class="form-label">Domain Name</label>
                        <input type="text" class="form-control @error('domain') is-invalid @enderror" id="domain" name="domain" required placeholder="example.com" value="{{ old('domain') }}">
                        <div class="form-text">Enter domain name without http:// or www.</div>
                        @error('domain')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Domain</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Domain Modal -->
<div class="modal fade" id="editDomainModal" tabindex="-1" aria-labelledby="editDomainModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDomainModalLabel">Edit Domain</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editDomainForm" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit_domain" class="form-label">Domain Name</label>
                        <input type="text" class="form-control @error('domain') is-invalid @enderror" id="edit_domain" name="domain" required>
                        <div class="form-text">Enter domain name without http:// or www.</div>
                        @error('domain')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Domain</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show modals if validation errors exist
        @if($errors->any() && old('_method') == 'PUT')
            const editDomainModal = new bootstrap.Modal(document.getElementById('editDomainModal'));
            editDomainModal.show();
        @endif

        @if($errors->any() && !old('_method'))
            const addDomainModal = new bootstrap.Modal(document.getElementById('addDomainModal'));
            addDomainModal.show();
        @endif

        // Edit domain modal setup
        const editButtons = document.querySelectorAll('.edit-domain');
        
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const domain = this.getAttribute('data-domain');
                
                document.getElementById('edit_domain').value = domain;
                document.getElementById('editDomainForm').action = `/domains/${id}`;
            });
        });
    });
</script>
@endsection 