@extends('app.layout')

@section('title', 'Submitted Essay')

@section('content')

<div class="container">
    <div class="row">
        <div class="divider my-5">
            <div class="divider-text text-uppercase"><span class="display-3">{{ __('Your Submitted Essay') }}</span></div>
        </div>
    </div>

    <div class="card mb-4">
        {!! $essay->content !!}
    </div>
</div>

@endsection