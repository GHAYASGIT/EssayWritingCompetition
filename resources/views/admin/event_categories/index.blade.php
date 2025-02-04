@extends('admin.layout.app')

@section('title', 'Categories')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>

<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-4">
        <h5 class="card-header">{{ __('Categories') }}</h5>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Create Categories
        </a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Notes</th>
                    <th>Created By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($categories as $category)
                    <tr>
                        <th scope="row"> {{ ++$i }} </th>
                        <td>{{ $category->name }}</td>
                        <td>
                            @switch($category->status)
                                @case('active')
                                    <span class="badge rounded-pill bg-success">{{ $category->status }}</span>
                                    @break

                                @case('inactive')
                                    <span class="badge rounded-pill bg-danger">{{ $category->status }}</span>
                                    @break
                            
                                @default
                                    <span></span>                                    
                            @endswitch
                        </td>
                        <td>{{ $category->notes }}</td>
                        <td>{{ $category->user->name }} ({{ $category->user->getRoleNames()->implode(' | ') }})</td>
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
                                        <a class="dropdown-item d-flex align-items-center text-warning" href="{{ route('admin.categories.edit', $category->id) }}"><span class="tf-icons bx bx-edit"></span><span class="ms-3">Edit</span></a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a type="submit" class="dropdown-item d-flex align-items-center text-danger" onclick="return confirm('Are you sure?');"><span class="tf-icons bx bx-trash"></span><span class="ms-3">Delete</span></a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
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
                        {!! $categories->links('pagination::bootstrap-5') !!}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>    

@endsection