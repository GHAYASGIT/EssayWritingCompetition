@extends('admin.layout.app')

@section('title', 'Users')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>

<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-4">
        <h5 class="card-header">{{ __('Users') }}</h5>
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Create User
        </a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('#ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Role') }}</th>
                    <th>{{ __('Last Updated') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($users as $user)
                    @if(!$user->hasRole('super-admin'))
                        <tr>
                            <th scope="row"> {{ ++$i }} </th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div class="overflow-auto" style="width: 450px">
                                    @forelse ($user->getRoleNames() as $rolename)
                                        <label class="badge bg-primary mx-1">{{ $rolename }}</label>
                                    @empty
                                        <label class="badge bg-info mx-1">{{ __('Role not assigned.') }}</label>
                                    @endforelse
                                </div>
                            </td>
                            <td>{{ $user->updated_at->format('d-m-Y h:m A') }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-info dropdown-toggle p-2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-cog"></i>
                                    </button>
                                    <ul class="dropdown-menu" style="">
                                        {{-- <li>
                                            <a class="dropdown-item d-flex align-items-center text-info" href="{{ route('admin.categories.show',$category->id) }}"><span class="tf-icons bx bx-show"></span><span class="ms-3">View</span></a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li> --}}
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center text-warning" href="{{ route('admin.profile.edit', $user->id) }}"><span class="tf-icons bx bx-edit"></span><span class="ms-3">Edit Profile</span></a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center text-warning" href="{{ route('admin.user.edit', $user->id) }}"><span class="tf-icons bx bx-edit"></span><span class="ms-3">Edit</span></a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a type="submit" class="dropdown-item d-flex align-items-center text-danger" onclick="return confirm('Are you sure?');"><span class="tf-icons bx bx-trash"></span><span class="ms-3">Delete</span></a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>                                
                                {{-- <form action="{{ route('admin.user.destroy',$user->id) }}" method="POST">
                                    <a class="btn rounded-pill btn-icon btn-info" href="{{ route('admin.user.show',$user->id) }}"><span class="tf-icons bx bx-show"></span></a>
                                    <a class="btn btn-icon btn-outline-success" href="{{ route('admin.user.edit',$user->id) }}"><span class="tf-icons bx bx-edit"></span></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-outline-danger" onclick="return confirm('Are you sure?');"><span class="tf-icons bx bx-trash"></span></button>
                                </form> --}}
                            </td>    
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="3" class="text-center">{{ __('No record found!') }}</td>
                    </tr>                    
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">
                        {{$users->links()}}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection

@section('script')
    <!-- Page JS -->
    <script src="{{ asset('assets/js/extended-ui-perfect-scrollbar.js') }}"></script>
@endsection