@extends('admin.layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold m-0">Enrolment Details</h4>
        <a href="{{ route('admin.booking.index') }}" class="btn btn-primary">
            <i class="bx bx-arrow-back me-1"></i> Back to List
        </a>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Event Information</h5>
                    <span class="badge bg-primary">{{ $booking->booking_no }}</span>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="text-muted d-block">Event Name</label>
                            <span class="fw-semibold">{{ $booking->event->name }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted d-block">Category</label>
                            <span class="fw-semibold">{{ $booking->event->category->name }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted d-block">Status</label>
                            <span class="badge bg-{{ $booking->status === 'active' ? 'success' : ($booking->status === 'completed' ? 'info' : 'danger') }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="text-muted d-block">Start Date</label>
                            <span class="fw-semibold">{{ $booking->event->start_date ? $booking->event->start_date->format('M d, Y') : 'Not set' }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted d-block">End Date</label>
                            <span class="fw-semibold">{{ $booking->event->end_date ? $booking->event->end_date->format('M d, Y') : 'Not set' }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted d-block">Duration</label>
                            <span class="fw-semibold">
                                @if($booking->event->start_date && $booking->event->end_date)
                                    {{ $booking->event->start_date->diffInDays($booking->event->end_date) + 1 }} days
                                @else
                                    Not available
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="text-muted d-block">Description</label>
                            <p class="mb-0">{{ $booking->event->description ?? 'No description available' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Student Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="text-muted d-block">Name</label>
                            <span class="fw-semibold">{{ $booking->user->name }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted d-block">Email</label>
                            <span class="fw-semibold">{{ $booking->user->email }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted d-block">Phone</label>
                            <span class="fw-semibold">{{ $booking->user->phone ?? 'Not provided' }}</span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted d-block">Enrolled On</label>
                            <span class="fw-semibold">{{ $booking->created_at ? $booking->created_at->format('M d, Y h:i A') : 'Not available' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <form action="{{ route('admin.booking.destroy', $booking->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this booking?')">
                                <i class="bx bx-trash me-1"></i> Delete Booking
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
