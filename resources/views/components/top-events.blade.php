<div class="card mb-5">
    <div class="card-header text-uppercase">
        <h4 class="mb-0">Top Rated Events</h4>
    </div>
    <div class="card-body">
        @if($topEvents->count() > 0)
            <div class="row g-4">
                @foreach($topEvents as $index => $event)
                    <div class="col-md-6 col-lg-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="badge bg-{{ ['primary', 'success', 'warning'][$index] }} me-2">
                                        #{{ $index + 1 }}
                                    </div>
                                    <h5 class="card-title mb-0">{{ $event->name }}</h5>
                                </div>
                                <div class="text-warning mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bx {{ $i <= round($event->feedback_avg_rating) ? 'bxs-star' : 'bx-star' }}"></i>
                                    @endfor
                                    <span class="ms-2">({{ number_format($event->feedback_avg_rating, 1) }})</span>
                                </div>
                                <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                                <a href="{{ route('event.show', $event) }}" class="btn btn-sm btn-primary">
                                    View Event
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                No events have been rated yet.
            </div>
        @endif
    </div>
</div>