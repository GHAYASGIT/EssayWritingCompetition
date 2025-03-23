@extends('app.layout')

@section('title', 'Feedback')

@section('content')

<div class="container">
    <h1>Feedback for Event: {{ $event->name }}</h1>
</div>

<div class="container">
    @auth
    <div class="row">
        <div class="col-md-8">
            @isset($essay_event->content)
                {{ $essay_event->content }}
            @endif
            @isset ($score)
                {{ __('You get the score : ') }}{{ $score }}{{ '%' }}
            @endif
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