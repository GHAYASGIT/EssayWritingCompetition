@extends('admin.layout.app')

@section('title', 'Create Permission')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>

<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-3">
        <h5 class="card-header">{{ __('Create Permission') }}</h5>
        <a href="{{ route('admin.permission.index') }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-left-arrow-alt"></span>&nbsp; Back
        </a>
    </div>

    <div class="card-body mx-auto w-50">
        <form method="POST" action="{{ route('admin.permission.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="name">Permission Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" placeholder="Permission Name">
                @error('name')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="guard" class="form-label">Select Authontication Guard</label>
                <select id="guard" name="guard" class="form-select @error('guard') is-invalid @enderror">
                    <option value="">{{ __('---select---') }}</option>
                    @foreach ($guards as $guard)
                        <option value="{{ $guard }}" @if(old('guard') == $guard) selected @endif>{{ $guard }}</option>
                    @endforeach
                </select>
                @error('guard')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>    
    </div>
</div>


@endsection
