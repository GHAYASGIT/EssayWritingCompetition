<div class="card mb-5">
    <div class="card-header">
        <h4 class="mb-0">{{ isset($feedback) ? 'Edit Your Feedback' : 'Leave Your Feedback' }}</h4>
    </div>
    <div class="card-body">
        @if($event->end_at->addDays(7)->isFuture())
            <form action="{{ isset($feedback) ? route('event.feedback.update', $feedback) : route('event.feedback.store', $event) }}" method="POST">
                @csrf
                @if(isset($feedback))
                    @method('PUT')
                @endif
                <input type="hidden" name="to_user_id" value="{{ $userId }}">
                <div class="mb-3">
                    <label class="form-label">{{ __('Rating') }}</label>
                    <select name="rating" class="form-select" required>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ isset($feedback) && $i == $feedback->rating ? 'selected' : '' }}>
                                {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Review</label>
                    <textarea name="body" class="form-control" rows="4" maxlength="1000">{{ old('body', $feedback->body ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ isset($feedback) ? 'Update Feedback' : 'Submit Feedback' }}
                </button>
                @if(isset($feedback))
                    <a href="{{ route('event.show', $event) }}" class="btn btn-secondary">Cancel</a>
                @endif
            </form>
        @else
            <div class="alert alert-info">
                The feedback period for this event has ended.
            </div>
        @endif
    </div>
</div>