@extends('admin.layout.app')

@section('title', 'Update Events')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>

<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-3">
        <h5 class="card-header">{{ __('Update Events') }}</h5>
        <a href="{{ route('admin.events.index') }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-left-arrow-alt"></span>&nbsp; Back
        </a>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="card p-3">
                    <img class="card-img-top" id="event_image_output" src="{{ asset('/storage\/'.$event->image) }}" alt="{{ __($event->name) }}">
                </div>
            </div>
            <div class="col-8">
                <form method="POST" action="{{ route('admin.events.update', $event->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="event_image" class="form-label">Image</label>
                        <input class="form-control @error('event_image') is-invalid @enderror" type="file" id="event_image" name='event_image' onchange="document.querySelector('#event_image_output').src=window.URL.createObjectURL(this.files[0])">
                        @error('event_image')
                            <p class="invalid-feedback"> {{ $message }} </p>
                        @enderror
                    </div>
        
                    <div class="mb-3">
                        <label class="form-label" for="name">Title</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $event->name) }}" id="name" placeholder="Event Title">
                        @error('name')
                            <p class="invalid-feedback"> {{ $message }} </p>
                        @enderror
                    </div>
        
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select id="category" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">{{ __('---Select Category---') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id',$event->category_id) == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="invalid-feedback"> {{ $message }} </p>
                        @enderror
                    </div>
        
                    <div class="mb-3">
                        <label for="started_at" class="form-label">Start Date Time</label>
                        <input class="form-control @error('started_at') is-invalid @enderror" type="datetime-local" name="started_at" value="{{ old('started_at', $event->started_at) }}" id="started_at"/>
                        @error('started_at')
                            <p class="invalid-feedback"> {{ $message }} </p>
                        @enderror
                    </div>
        
                    <div class="mb-3">
                        <label for="end_at" class="form-label">End Date Time</label>
                        <input class="form-control @error('end_at') is-invalid @enderror" type="datetime-local" name="end_at" value="{{ old('end_at', $event->end_at) }}" id="end_at"/>
                        @error('end_at')
                            <p class="invalid-feedback"> {{ $message }} </p>
                        @enderror
                    </div>
        
                    <div class="mb-3">
                        <label class="form-lable d-block">Status</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('status') is-invalid @enderror" @checked(old('active', $event->status)) type="radio" name="status" id="active" value="active">
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('status') is-invalid @enderror" @checked(old('inactive', $event->status)) type="radio" name="status" id="inactive" value="inactive">
                            <label class="form-check-label" for="inactive">Inactive</label>
                        </div>
                        @error('status')
                            <p class="invalid-feedback d-block"> {{ $message }} </p>
                        @enderror
                    </div>
        
                    <div class="mb-3">
                        <label class="form-label" for="subscribers">Total Subscribers</label>
                        <input type="number" class="form-control @error('subscribers') is-invalid @enderror" name="subscribers" value="{{ old('subscribers', $event->subscribers) }}" min="1" id="subscribers" placeholder="Total Subscribers">
                        @error('subscribers')
                            <p class="invalid-feedback"> {{ $message }} </p>
                        @enderror
                    </div>
        
                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="5" placeholder="Description">{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <p class="invalid-feedback"> {{ $message }} </p>
                        @enderror
                    </div>
        
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>    
            </div>
        </div>
    </div>
</div>


@endsection
