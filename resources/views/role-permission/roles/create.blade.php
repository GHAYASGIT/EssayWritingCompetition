@extends('layout.app')

@section('title', 'Create Roles')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>

<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-3">
        <h5 class="card-header">{{ __('Create Roles') }}</h5>
        <a href="{{ route('role.index') }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-left-arrow-alt"></span>&nbsp; Back
        </a>
    </div>

    <div class="card-body mx-auto w-50">
        <form method="POST" action="{{ route('role.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="name">{{ __('Role Name') }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" required placeholder="Role Name">
                @error('name')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-label">{{ __('Assign permission to role') }}</div>
                @isset($permissions)
                    @forelse ($permissions as $permission)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="permission[]" id="{{ $permission->id }}" value="{{ $permission->name }}">
                            <label class="form-check-label" for="{{ $permission->id }}">{{ $permission->name }}</label>
                        </div>
                    @empty
                        {{ __('No permission found.') }}
                    @endforelse
                @endisset
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>    
    </div>
</div>


@endsection
