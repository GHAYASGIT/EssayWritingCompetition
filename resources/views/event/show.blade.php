@extends('app.layout')

@section('title', 'Welcome')

@section('content')

<!-- Modal -->
<div class="modal loginmodel fade" id="modalCenter" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Join Us Today!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="bx bx-user-circle display-1 text-primary mb-3"></i>
                <p class="lead mb-4">Please login to participate in events</p>
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5">
                    <i class="bx bx-log-in me-2"></i> Login Now
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row g-4">
        <div class="col-lg-8 order-lg-1 order-md-2">
            <div class="row g-4">
                <div class="card mb-4">
                    <img class="card-img-top" src="{{ asset('/storage/'.$event->image) }}" alt="{{ __($event->name) }}">
                    <div class="card-body">
                        <dl class="row">
                            <h1 class="mb-4">{{ __($event->name) }}</h1>
                            <hr>
                            <dt class="col-sm-5 text-uppercase">{{ __('Category') }}</dt>
                            <dd class="col-sm-7">{{ __($event->category->name) }}</dd>
                            <hr>
                            <dt class="col-sm-5 text-uppercase">{{ __('Status') }}</dt>
                            <dd class="col-sm-7">{{ __($event->status) }}</dd>
                            <hr>            
                            <dt class="col-sm-5 text-uppercase">{{ __('Start Date & Time') }}</dt>
                            <dd class="col-sm-7">{{ __(\Carbon\Carbon::parse($event->started_at)->format('d-m-Y h:m A')) }}</dd>
                            <hr>
                            <dt class="col-sm-5 text-uppercase">{{ __('End Date & Time') }}</dt>
                            <dd class="col-sm-7">{{ __(\Carbon\Carbon::parse($event->end_at)->format('d-m-Y h:m A')) }}</dd>
                            <hr>
                            <dt class="col-sm-5 text-uppercase">{{ __('Total Members') }}</dt>
                            <dd class="col-sm-7">{{ __($event->subscribers) }}</dd>
                            <hr>
                            <dt class="col-sm-5 text-uppercase">{{ __('Already Enrolled Members') }}</dt>
                            @if($event->booking->count())
                                <dd class="col-sm-7">{{ __($event->booking->count()) }}</dd>
                            @endif
                            <hr class="m-0">
                        </dl>

                        @auth

                            @if($event->end_at <= now()->format('Y-m-d H:i:s'))
                                {{ __('You scored : ') }}
                            @else
                                @if($event->started_at >= now()->format('Y-m-d H:i:s'))
                                    {{ __('Event will start soon!') }}
                                @else
                                    @if($event->getUserBookingByEventId($event->id))
                                        @php
                                        switch ($event->category->name) {
                                            case 'Essay':
                                                $route_create = 'essay.create';
                                                break;
                                            case 'MCQs':
                                                $route_create = 'mcqs.create';
                                                break;
                                            
                                            default:
                                                $route_create = null;
                                                break;
                                        }
                                        @endphp

                                        @if ($is_drafted = $event->eventIsDrafted($event->id, $event->category->name))
                                            @if ($is_drafted->is_drafted)
                                                {{ __("$event->name, is in draft. ") }}<a href="{{ route($route_create, ['id' => $event->id]) }}" class="card-link oevents_enroll_now">{{ __('Resume Now') }}</a>{{ __(' to finish it.') }}
                                            @endif
                                            @if ($is_drafted->is_submitted)
                                                <span class="card-link oevents_enroll_now">{{ __("$event->name, has been submitted.") }}</span>
                                            @endif
                                        @else
                                            <a href="{{ route($route_create, ['id' => $event->id]) }}" class="card-link oevents_enroll_now">{{ __('Start Now') }}</a>
                                        @endif
                                    @else
                                        <form action="{{ route('booking.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                                            {{ __('Members are joining fast ') }}<button type="submit" class="btn btn-link p-0">{{ __('enroll now') }}</button>{{ __(' to start event.') }}
                                        </form>
                                    @endif
                                @endif
                            @endif
                        @endauth
                        @guest
                            {{ __('Members are joining fast ') }}<a href="javascript:void(0)" class="btn btn-link p-0 oevents_enroll_now">{{ __('enroll now') }}</a>{{ __(' to start event.') }}
                        @endguest
                    </div>
                </div>
            </div>

            <div class="nav-align-top">
                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#description{{ $event->id }}" aria-controls="description{{ $event->id }}" aria-selected="true">
                            <i class="tf-icons bx bx-detail"></i> {{ __('Description') }}
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#participants" aria-controls="participants" aria-selected="false">
                            <i class='bx bxs-group'></i> Participants
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="description{{ $event->id }}" role="tabpanel">
                        {{ __($event->description) }}
                    </div>
                    <div class="tab-pane fade" id="participants" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>

                                        @if($event->getEventType() == 'essay')
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ _('Action') }}</th>
                                        @endif

                                        @if($event->getEventType() == 'mcqs')
                                            <th>{{ __('Score') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($event->booking as $booking)
                                        <tr>
                                            <td>{{ $booking->user->name }}</td>
                                            @if($event->getEventType() == 'essay')
                                                <td>
                                                    @if($booking->event->getIsSubmitted($booking->user->id) == null)
                                                        <!-- Code for when the submission is blank -->
                                                    @else
                                                        @if($booking->event->getIsSubmitted($booking->user->id))
                                                            <span class="badge bg-success">{{ __('Submitted') }}</span>
                                                        @else
                                                            <span class="badge bg-warning">{{ __('In Progress') }}</span>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @auth
                                                        @if($booking->event->getIsSubmitted($booking->user->id) == null)
                                                            <!-- Code for when the submission is blank -->
                                                        @else
                                                            @if($booking->event->getIsSubmitted($booking->user->id) && $booking->user->id !== auth()->id())
                                                                <a href="{{ route('event.show.view', [$event->id, $booking->user->id]) }}" class="btn btn-sm btn-primary hover-scale">
                                                                    <i class='bx bx-show'></i> {{ __('Give Your Feedback') }}
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endauth
                                                </td>
                                            @endif
                                            @if($booking->event->getEventType() == 'mcqs')
                                                <td>{{ $booking->getMcqScore($booking->event->getMcqs($booking->user->id)) }}{{ '%' }}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 order-lg-2 order-md-1">
            <!-- Existing event details code -->

            <x-top-events :topEvents="$topEvents" />

        </div>
    </div>
</div>

@if ($event->getEventType() != 'mcqs')
    <div class="container">
        <div class="row">
            <div class="divider my-5">
                <div class="divider-text text-uppercase"><span class="display-3">{{ __('Reviews & Feedback') }}</span></div>
            </div>
        </div>
        @auth
            <x-event-feedback-list :event="$event" />
        @endauth
    </div>
@endif

@endsection

@section('script')
    <script type="text/javascript">
        $('.oevents_enroll_now').click(function (e) { 

            $.ajax({
                url: '/check-auth',
                method: 'GET',
                success: function(response) {
                    if (!response.authenticated) {
                        const modal = new bootstrap.Modal($('.loginmodel'));
                        modal.show();
                    }
                },
                error: function() {
                    console.log("Error checking authentication");
                }
            });
        });
    </script>
@endsection