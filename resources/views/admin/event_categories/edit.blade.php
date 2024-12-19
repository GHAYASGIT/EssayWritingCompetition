@extends('admin.layout.app')

@section('title', 'Update Categories')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>

<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-3">
        <h5 class="card-header">{{ __('Update Categories') }}</h5>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-left-arrow-alt"></span>&nbsp; Back
        </a>
    </div>

    <div class="card-body mx-auto w-50">
        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
            @csrf
            @method('put')
            <div class="mb-3">
                <label class="form-label" for="name">Category Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $category->name) }}" id="name" placeholder="Category Name">
                @error('name')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-lable d-block">Category Status</label>
                <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input @error('status') is-invalid @enderror" @if($category->status == 'active') checked @endif type="radio" name="status" id="active" value="active">
                    <label class="form-check-label" for="active">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input @error('status') is-invalid @enderror" @if($category->status == 'inactive') checked @endif type="radio" name="status" id="inactive" value="inactive">
                    <label class="form-check-label" for="inactive">Inactive</label>
                </div>
                @error('status')
                    <p class="invalid-feedback d-block"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="note">Category Note</label>
                <input type="text" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ old('note', $category->notes) }}" id="note" placeholder="Category Note">
                @error('note')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>    
    </div>
</div>


@endsection
