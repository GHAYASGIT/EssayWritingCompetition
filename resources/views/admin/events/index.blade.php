@extends('admin.layout.app')

@section('title', 'Events')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4>

<div class="card">
    <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-4">
        <h5 class="card-header">{{ __('Events') }}</h5>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary border-0 m-3">
            <span class="tf-icons bx bx-plus-circle"></span>&nbsp; Create Events
        </a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Started At</th>
                    <th>End At</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($events as $event)
                    <tr>
                        <th scope="row"> {{ ++$i }} </th>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->category->name }}</td>
                        <td>
                            @switch($event->status)
                                @case('active')
                                    <span class="badge rounded-pill bg-success">{{ $event->status }}</span>
                                    @break

                                @case('inactive')
                                    <span class="badge rounded-pill bg-danger">{{ $event->status }}</span>
                                    @break
                            
                                @default
                                    <span></span>                                    
                            @endswitch
                        </td>
                        <td>{{ $event->user->name }} ({{ $event->user->getRoleNames()->implode(' | ') }})</td>
                        <td>{{ \Carbon\Carbon::parse($event->started_at)->format('d-m-Y h:i A') }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->end_at)->format('d-m-Y h:i A') }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->created_at)->format('d-m-Y h:i A') }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-info dropdown-toggle p-2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-cog"></i>
                                </button>
                                <ul class="dropdown-menu" style="">
                                    {{-- <li>
                                        <a class="dropdown-item d-flex align-items-center text-info" href="{{ route('admin.categories.show',$category->id) }}"><span class="tf-icons bx bx-show"></span><span class="ms-3">View</span></a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li> --}}
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center text-success" href="{{ route('admin.events.active',$event->id) }}"><span class="tf-icons bx bx-show"></span><span class="ms-3 text-upercase">Active</span></a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    @if ($event->category->name == 'MCQs')
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center text-primary" href="{{ route('admin.questionoptions.create') }}"><span class="tf-icons bx bx-show"></span><span class="ms-3 text-upercase">Create Questions</span></a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                    @endif
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center text-danger" href="{{ route('admin.events.inactive',$event->id) }}"><span class="tf-icons bx bx-show"></span><span class="ms-3 text-upercase">Inactive</span></a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center text-warning" href="{{ route('admin.events.edit', $event->id) }}"><span class="tf-icons bx bx-edit"></span><span class="ms-3">Edit</span></a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item d-flex align-items-center text-danger" onclick="return confirm('Are you sure?');"><span class="tf-icons bx bx-trash"></span><span class="ms-3">Delete</span></button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>    
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">{{ __('No record found!') }}</td>
                    </tr>                    
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">
                        {!! $events->links('pagination::bootstrap-5') !!}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>    

@endsection