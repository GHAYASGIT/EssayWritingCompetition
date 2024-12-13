@extends('layout.app')

@section('title', 'Create Categories')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>

<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-3">
        <h5 class="card-header">{{ __('Create Categories') }}</h5>
        <a href="{{ route('categories.index') }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-left-arrow-alt"></span>&nbsp; Back
        </a>
    </div>

    <div class="card-body mx-auto w-50">
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="name">Category Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" placeholder="Category Name">
                @error('name')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="note">Category Note</label>
                <input type="text" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ old('note') }}" id="note" placeholder="Category Note">
                @error('note')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>    
    </div>
</div>


@endsection
