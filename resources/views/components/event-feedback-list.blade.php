@if($event->feedback->count() > 0)
<div class="row g-4">
    @foreach($event->feedback as $feedback)
        @if($feedback->to_user_id == auth()->user()->id)
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="card-title">{{ $feedback->title ?? 'Untitled Review' }}</h5>
                            <div class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bx {{ $i <= $feedback->rating ? 'bxs-star' : 'bx-star' }}"></i>
                                @endfor
                            </div>
                        </div>
                        <p class="card-text">{{ $feedback->body }}</p>
                        <small class="text-muted">
                            Posted by {{ $feedback->user->name }} on {{ $feedback->created_at->format('M d, Y') }}
                        </small>
                    </div>
                </div>
            </div>            
        @endif
    @endforeach
</div>
@else
<div class="alert alert-info">
    No feedback available for this event yet.
</div>
@endif