@extends('app.layout')

@section('title', 'Welcome to School Events')

@section('content')
<!-- Dashboard Overview -->
<div class="row mb-5">
    <div class="col-lg-8 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Welcome to School Events! 🎉</h5>
                        <p class="mb-4">
                            Discover and participate in exciting school events, competitions, and activities. 
                            Join our community of learners and showcase your talents!
                        </p>
                        @guest
                            <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                        @endguest
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded">
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Active Events</span>
                        <h3 class="card-title mb-2">{{ $active_events_count }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="row mb-5">
    <div class="col-md-4 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="badge bg-label-primary p-2 rounded">
                        <i class="bx bx-calendar bx-sm"></i>
                    </div>
                </div>
                <h5 class="card-title mb-1 mt-3">Event Management</h5>
                <small class="text-muted">Stay Updated</small>
                <p class="mb-0 mt-2">Browse and register for upcoming events. Get real-time updates on event schedules.</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="badge bg-label-success p-2 rounded">
                        <i class="bx bx-user-check bx-sm"></i>
                    </div>
                </div>
                <h5 class="card-title mb-1 mt-3">Easy Registration</h5>
                <small class="text-muted">Quick Process</small>
                <p class="mb-0 mt-2">Simple registration process. Track your participation history and manage your events.</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="badge bg-label-warning p-2 rounded">
                        <i class="bx bx-trophy bx-sm"></i>
                    </div>
                </div>
                <h5 class="card-title mb-1 mt-3">Competitions</h5>
                <small class="text-muted">Win Prizes</small>
                <p class="mb-0 mt-2">Participate in various competitions and showcase your skills to win exciting prizes.</p>
            </div>
        </div>
    </div>
</div>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
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




<div class=" mb-5">
    <div class="divider mb-5">
        <div class="divider-text">
            <h2 class="text-uppercase display-6">
                <i class="bx bx-calendar text-primary"></i> {{ __('Events') }}
            </h2>
        </div>
    </div>

    <!-- Events Tabs -->
    <ul class="nav nav-tabs mb-4" id="eventsTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="ongoing-tab" data-bs-toggle="tab" data-bs-target="#ongoing" type="button" role="tab" aria-controls="ongoing" aria-selected="false">
                <i class="bx bx-run me-2"></i> Ongoing
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="upcoming-tab" data-bs-toggle="tab" data-bs-target="#upcoming" type="button" role="tab" aria-controls="upcoming" aria-selected="true">
                <i class="bx bx-calendar-plus me-2"></i> Upcoming
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="closed-tab" data-bs-toggle="tab" data-bs-target="#closed" type="button" role="tab" aria-controls="closed" aria-selected="false">
                <i class="bx bx-check-circle me-2"></i> Recently Closed
            </button>
        </li>
    </ul>

    <!-- Events Content -->
    <div class="tab-content" id="eventsTabContent">
        <!-- Ongoing Events -->
        <div class="tab-pane fade show active" id="ongoing" role="tabpanel" aria-labelledby="ongoing-tab">
            <div class="row g-4">
                @foreach($ongoing_events as $event)
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 shadow-sm border-0 hover-scale">
                        <div class="position-absolute top-0 end-0 p-3">
                            <span class="badge bg-success">Ongoing</span>
                        </div>
                        <img src="{{ asset('/storage/'.$event->image) }}" class="card-img-top object-fit-cover" style="height: 200px;" alt="{{ $event->name }}">
                        <div class="card-body">
                            <h5 class="card-title text-uppercase fw-bold">{{ $event->name }}</h5>
                            <div class="text-muted small mb-3">
                                <div class="mb-1">
                                    <i class="bx bx-calendar"></i> 
                                    Ends: {{ Carbon\Carbon::parse($event->end_at)->format('d M Y, h:i A') }}
                                </div>
                                <div>
                                    <i class="bx bx-time"></i> 
                                    Time Remaining: <span class="countdown" data-end="{{ $event->end_at }}"></span>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <a href="{{ route('event.show', ['id'=>$event->id]) }}" class="btn btn-outline-primary">
                                    <i class="bx bx-info-circle"></i> View Details
                                </a>
                                @auth
                                    @if($event->getUserBookingByEventId($event->id))
                                        @php
                                            $route_create = match($event->category_id) {
                                                1 => 'essay.create',
                                                2 => 'mcqs.create',
                                                default => null
                                            };
                                        @endphp
                                        @if($is_drafted = $event->eventIsDrafted($event->id, $event->category_id))
                                            @if($is_drafted->is_drafted)
                                                <a href="{{ route($route_create, ['id' => $event->id]) }}" class="btn btn-warning">
                                                    <i class="bx bx-edit"></i> Resume Draft
                                                </a>
                                            @endif
                                            @if($is_drafted->is_submitted)
                                                <button class="btn btn-success" disabled>
                                                    <i class="bx bx-check"></i> Submitted
                                                </button>
                                            @endif
                                        @else
                                            <a href="{{ route($route_create, ['id' => $event->id]) }}" class="btn btn-primary">
                                                <i class="bx bx-play"></i> Start Now
                                            </a>
                                        @endif
                                    @else
                                        <form action="{{ route('booking.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                                            <button type="submit" class="btn btn-primary w-100" onclick="return confirm('Are you sure you want to enroll?');">
                                                <i class="bx bx-user-plus"></i> Enroll Now
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                                        <i class="bx bx-user-plus"></i> Enroll Now
                                    </button>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="tab-pane fade" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
            <div class="row g-4">
                @foreach($upcomming_events as $event)
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 shadow-sm border-0 hover-scale">
                        <div class="position-absolute top-0 end-0 p-3">
                            <span class="badge bg-primary">Upcoming</span>
                        </div>
                        <img src="{{ asset('/storage/'.$event->image) }}" class="card-img-top object-fit-cover" style="height: 200px;" alt="{{ $event->name }}">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $event->name }}</h5>
                            <div class="text-muted small mb-3">
                                <div class="mb-1">
                                    <i class="bx bx-calendar"></i> 
                                    Starts: {{ Carbon\Carbon::parse($event->started_at)->format('M d, Y, h:i A') }}
                                </div>
                            </div>
                            <a href="{{ route('event.show', $event->id) }}" class="btn btn-outline-primary w-100">
                                <i class="bx bx-info-circle me-1"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recently Closed Events -->
        <div class="tab-pane fade" id="closed" role="tabpanel" aria-labelledby="closed-tab">
            <div class="row g-4">
                @foreach($closed_events as $event)
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 shadow-sm border-0 hover-scale">
                        <div class="position-absolute top-0 end-0 p-3">
                            <span class="badge bg-secondary">Closed</span>
                        </div>
                        <img src="{{ asset('/storage/'.$event->image) }}" class="card-img-top object-fit-cover" style="height: 200px;" alt="{{ $event->name }}">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $event->name }}</h5>
                            <div class="text-muted small mb-3">
                                <div class="mb-1">
                                    <i class="bx bx-calendar"></i> 
                                    Ended: {{ Carbon\Carbon::parse($event->end_at)->format('M d, Y, h:i A') }}
                                </div>
                            </div>
                            <a href="{{ route('event.show', $event->id) }}" class="btn btn-outline-secondary w-100">
                                <i class="bx bx-info-circle me-1"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .hover-scale {
        transition: transform 0.3s ease;
    }
    .hover-scale:hover {
        transform: scale(1.03);
    }
    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
    }
    .nav-tabs .nav-link.active {
        color: #0d6efd;
        border-bottom: 2px solid #0d6efd;
    }
    .card {
        border-radius: 0.5rem;
        overflow: hidden;
    }
</style>




@endsection

@section('script')
<script>
function updateCountdown() {
    document.querySelectorAll('.countdown').forEach(el => {
        const endDate = el.dataset.end;
        const startDate = el.dataset.start;
        const targetDate = endDate || startDate;
        
        if (!targetDate) return;

        const now = new Date().getTime();
        const target = new Date(targetDate).getTime();
        const distance = target - now;

        if (distance < 0) {
            el.innerHTML = 'Expired';
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        el.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
    });
}

setInterval(updateCountdown, 1000);
updateCountdown();
</script>
@endsection
