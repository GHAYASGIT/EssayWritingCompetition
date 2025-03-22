@extends('admin.layout.app')

@section('title', 'Users')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Users</h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Users</h5>
            <a href="{{ route('admin.adminuser.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Create User
            </a>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Last Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($users as $user)
                        @if(!$user->hasRole('super-admin'))
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @forelse ($user->getRoleNames() as $rolename)
                                        <span class="badge bg-primary me-1">{{ $rolename }}</span>
                                    @empty
                                        <span class="badge bg-info">No Role</span>
                                    @endforelse
                                </td>
                                <td>{{ $user->updated_at->format('M d, Y h:i A') }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('admin.adminuser.edit', $user->id) }}">
                                                <i class="bx bx-edit me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.adminuser.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this user?')">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection

@section('script')
    <!-- Page JS -->
    <script src="{{ asset('assets/js/extended-ui-perfect-scrollbar.js') }}"></script>
@endsection