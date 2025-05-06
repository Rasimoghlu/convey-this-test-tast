@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">User Management</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Domains</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->domains->count() > 0)
                                                <ul class="list-unstyled mb-0">
                                                    @foreach ($user->domains as $domain)
                                                        <li>{{ $domain->domain }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <span class="text-muted">No domains</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 