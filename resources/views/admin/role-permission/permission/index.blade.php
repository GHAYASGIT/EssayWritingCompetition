@extends('admin.layout.app')

@section('title', 'Permissions')

@section('content')

@hasrole('super-admin')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>

<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-4">
        <h5 class="card-header">{{ __('Permissions') }}</h5>
        <a href="{{ route('admin.permission.create') }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Create Permission
        </a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>{{ __('Auth Guard') }}</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($permissions as $permission)
                    <tr>
                        <th scope="row"> {{ ++$i }} </th>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->guard_name }}</td>
                        <td>
                            <form action="{{ route('admin.permission.destroy',$permission->id) }}" method="POST">
                                {{-- <a class="btn rounded-pill btn-icon btn-info" href="{{ route('admin.permission.show',$permission->id) }}"><span class="tf-icons bx bx-show"></span></a> --}}
                                <a class="btn btn-icon btn-outline-success" href="{{ route('admin.permission.edit',$permission->id) }}"><span class="tf-icons bx bx-edit"></span></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-icon btn-outline-danger" onclick="return confirm('Are you sure?');"><span class="tf-icons bx bx-trash"></span></button>
                            </form>
                        </td>    
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">{{ __('No record found!') }}</td>
                    </tr>                    
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">
                        {!! $permissions->links('pagination::bootstrap-5') !!}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@else

<div class="p-5 mb-4 bg-body-tertiary rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">{{ __('I\'m Sorry') }}</h1>
        <p class="col-md-8 fs-4">{{ __('You are not allowed to visit this page.') }}</p>
    </div>
</div>

@endhasrole

@endsection
