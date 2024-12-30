@extends('admin.layout.app')

@section('title', 'Create Events')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>

<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-3">
        <h5 class="card-header">{{ __('Create Events') }}</h5>
        <a href="{{ route('admin.events.index') }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-left-arrow-alt"></span>&nbsp; Back
        </a>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="event_image" class="form-label">Image</label>
                <input class="form-control @error('event_image') is-invalid @enderror" type="file" id="event_image" name='event_image'>
                @error('event_image')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="name">Title</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" placeholder="Event Title">
                @error('name')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select id="category" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    <option value="">{{ __('---Select Category---') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="started_at" class="form-label">Start Date Time</label>
                <input class="form-control @error('started_at') is-invalid @enderror" min="{{ now()->subMonths(5)->format('Y-m-d\TH:i') }}" max="{{ now()->addMonths(5)->format('Y-m-d\TH:i') }}" type="datetime-local" name="started_at" value="{{ old('started_at') }}" id="started_at"/>
                @error('started_at')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="end_at" class="form-label">End Date Time</label>
                <input class="form-control @error('end_at') is-invalid @enderror" min="{{ now()->subMonths(5)->format('Y-m-d\TH:i') }}" max="{{ now()->addMonths(5)->format('Y-m-d\TH:i') }}" type="datetime-local" name="end_at" value="{{ old('end_at') }}" id="end_at"/>
                @error('end_at')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-lable d-block">Status</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="active" value="active">
                    <label class="form-check-label" for="active">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="inactive" value="inactive">
                    <label class="form-check-label" for="inactive">Inactive</label>
                </div>
                @error('status')
                    <p class="invalid-feedback d-block"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="subscribers">Total Subscribers</label>
                <input type="number" class="form-control @error('subscribers') is-invalid @enderror" name="subscribers" value="{{ old('subscribers') }}" min="1" id="subscribers" placeholder="Total Subscribers">
                @error('subscribers')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="5" placeholder="Description">{{ old('description') }}</textarea>
                @error('description')
                    <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>    
    </div>
</div>

@endsection
