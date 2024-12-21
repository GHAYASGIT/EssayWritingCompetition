@extends('admin.layout.app')

@section('title', 'Edit User')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>

<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-3">
        <h5 class="card-header">{{ __('Edit User') }}</h5>
        <a href="{{ route('admin.user.index') }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-left-arrow-alt"></span>&nbsp; Back
        </a>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
            @csrf
            @method('put')
            <div class="mb-3">
                <label class="form-label" for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" id="name" @required(true) placeholder="Name">
                @error('name')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" id="email" @required(true) placeholder="Enter Email">
                @error('email')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select multiple id="role" name="role[]" class="form-select">
                    @foreach ($roles as $role)
                        <option {{ $user->roles->pluck('name')->contains($role->name) ? 'selected' : '' }} value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>            

            <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                    <input
                        type="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password"
                        autocomplete="new-password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                    @error('password')
                        <p class="invalid-feedback"> {{ $message }} </p>
                    @enderror

                </div>
            </div>

            <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <div class="input-group input-group-merge">
                    <input
                        type="password"
                        id="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password_confirmation"
                        autocomplete="new-confirmation"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                    @error('password_confirmation')
                        <p class="invalid-feedback"> {{ $message }} </p>
                    @enderror

                </div>
            </div>
                        
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>    
    </div>
</div>


@endsection
