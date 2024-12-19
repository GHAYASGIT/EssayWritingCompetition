@extends('app.layout')

@section('title', 'Welcome')

@section('content')


<div class="container">
    <div class="row">
        <div class="divider my-5">
            <div class="divider-text text-uppercase"><span class="display-3">{{ __('Event Details') }}</span></div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-5 mt-3">
            <div class="card">
                <img class="card-img img-fluid" src="{{ asset('/storage\/'.$event->image) }}" alt="{{ __($event->name) }}">
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-7 mt-3">
            <div class="card">
                <div class="card-body">
                    <dl class="row">
                        <h1>{{ __($event->name) }}</h1>
                        <hr>

                        <dt class="col-sm-4 text-uppercase">{{ __('Category') }}</dt>
                        <dd class="col-sm-8">{{ __($event->category->name) }}</dd>

                        <hr>

                        <dt class="col-sm-4 text-uppercase">{{ __('Status') }}</dt>
                        <dd class="col-sm-8">{{ __($event->status) }}</dd>

                        <hr>
            
                        <dt class="col-sm-4 text-uppercase">{{ __('Start Date & Time') }}</dt>
                        <dd class="col-sm-8">{{ __(\Carbon\Carbon::parse($event->started_at)->format('d-m-Y h:m A')) }}</dd>

                        <hr>

                        <dt class="col-sm-4 text-uppercase">{{ __('End Date & Time') }}</dt>
                        <dd class="col-sm-8">{{ __(\Carbon\Carbon::parse($event->end_at)->format('d-m-Y h:m A')) }}</dd>
                        <hr>
                        <dt class="col-sm-4 text-uppercase">{{ __('Total Members') }}</dt>
                        <dd class="col-sm-8">{{ __($event->subscribers) }}</dd>
                        <hr>
                        <dt class="col-sm-4 text-uppercase">{{ __('Required Members') }}</dt>
                        <dd class="col-sm-8">{{ __($event->subscribers) }}</dd>
                        <hr class="m-0">
                    </dl>

                    {{ __('Members are joining fast') }}
                    <a href="#" class="btn-link p-0">{{ __('enroll now') }}</a>
                    {{ __('to start event.') }}
                </div>
            </div>
        </div>
    </div>

    <div class="nav-align-top mt-4">
        <ul class="nav nav-tabs nav-fill" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#description{{ $event->id }}" aria-controls="description{{ $event->id }}" aria-selected="true">
                    <i class="tf-icons bx bx-detail"></i> {{ __('Description') }}
                </button>
            </li>
            {{-- <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false">
                <i class="tf-icons bx bx-user"></i> Profile
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages" aria-selected="false">
                <i class="tf-icons bx bx-message-square"></i> Messages
                </button>
            </li> --}}
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="description{{ $event->id }}" role="tabpanel">
                {{ __($event->description) }}
            </div>
            {{-- <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                <p>
                Donut dragée
                </p>
                <p class="mb-0">
                Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah
                cotton candy liquorice caramels.
                </p>
            </div>
            <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                <p>
                    Oat cake
                </p>
                <p class="mb-0">
                    Cake chocolate
                </p>
            </div> --}}
        </div>
    </div>

</div>


@endsection