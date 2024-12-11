@extends('layout.app')

@section('title', 'Roles')

@section('content')

@hasrole('super-admin')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>
<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-4">
        <h5 class="card-header">{{ __('Roles') }}</h5>
        <a href="{{ route('role.create') }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Create Role
        </a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('#ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Permissions') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($roles as $role)
                    <tr>
                        <th scope="row"> {{ ++$i }} </th>
                        <td>{{ $role->name }}</td>
                        <td>
                            <button type="button" class="btn btn-icon btn-outline-primary" data-bs-toggle="modal" data-bs-target="#role{{ $role->id }}" ><span class="tf-icons bx bx-show"></span></button>
                            <div class="modal fade" id="role{{ $role->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-bottom border-3">
                                            <h5 class="modal-title" id="modalCenterTitle">{{ __('Permisions for') }}&nbsp;{{ $role->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row text-wrap">
                                                {{ $role->permissions->pluck('name')->implode(' | ') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('role.destroy',$role->id) }}" method="POST">
                                {{-- <a class="btn rounded-pill btn-icon btn-info" href="{{ route('role.show',$role->id) }}"><span class="tf-icons bx bx-show"></span></a> --}}
                                <a class="btn btn-icon btn-outline-success" href="{{ route('role.edit',$role->id) }}"><span class="tf-icons bx bx-edit"></span></a>
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
                        {{$roles->links()}}
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
