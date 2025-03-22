@extends('admin.layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Events</h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Events</h5>
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Create Event
            </a>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Event Period</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($events as $event)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->category->name }}</td>
                        <td>
                            @if($event->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>{{ $event->user->name }}</td>
                        <td>
                            <div class="text-muted small">
                                Start: {{ \Carbon\Carbon::parse($event->started_at)->format('M d, Y h:i A') }}<br>
                                End: {{ \Carbon\Carbon::parse($event->end_at)->format('M d, Y h:i A') }}
                            </div>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if ($event->category->name == 'MCQs')
                                        <a class="dropdown-item" href="{{ route('admin.questionoptions.viewquestion', $event->id) }}">
                                            <i class="bx bx-plus me-1"></i> Add Questions
                                        </a>
                                    @endif
                                    
                                    <a class="dropdown-item" href="{{ route('admin.events.edit', $event->id) }}">
                                        <i class="bx bx-edit me-1"></i> Edit
                                    </a>

                                    @if($event->status === 'inactive')
                                        <a class="dropdown-item" href="{{ route('admin.events.active', $event->id) }}">
                                            <i class="bx bx-check me-1"></i> Activate
                                        </a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('admin.events.inactive', $event->id) }}">
                                            <i class="bx bx-x me-1"></i> Deactivate
                                        </a>
                                    @endif

                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this event?')">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No events found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $events->links() }}
        </div>
    </div>
</div>
@endsection