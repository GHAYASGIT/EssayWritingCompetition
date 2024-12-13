@extends('layout.app')

@section('title', 'Categories')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>

<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-4">
        <h5 class="card-header">{{ __('Categories') }}</h5>
        <a href="{{ route('categories.create') }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Create Categories
        </a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
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
                        <td>{{ $category->notes }}</td>
                        <td>{{ $category->category_user->name }}</td>
                        <td>
                            <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
                                {{-- <a class="btn rounded-pill btn-icon btn-info" href="{{ route('category.show',$category->id) }}"><span class="tf-icons bx bx-show"></span></a> --}}
                                <a class="btn btn-icon btn-outline-success" href="{{ route('categories.edit',$category->id) }}"><span class="tf-icons bx bx-edit"></span></a>
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
                        {!! $categories->links('pagination::bootstrap-5') !!}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>    

@endsection