@extends('app.layout')

@section('title', 'Feedback')

@section('content')

<div class="container">
    <h1>Feedback for Event: {{ $event->name }}</h1>

    <a href="{{ route('event.show', $event->id) }}" class="btn btn-primary">Back to Event</a>
</div>

<div class="container">
    @auth
    <div class="row">
        <div class="col-md-8">
            {{ $essay_event->content }}            
        </div>
        <div class="col-md-4">
            <x-event-feedback-form 
                :event="$event"
                :feedback="null"
                :isEditing="true"
                :userId="$userId"
            />
        </div>
    </div>
    @endauth
</div>

@endsection