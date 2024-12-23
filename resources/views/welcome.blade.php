@extends('app.layout')

@section('title', 'Welcome')

@section('content')

<!-- Modal -->
<div class="modal loginmodel fade" id="modalCenter" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">{{ _('Login') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row border-bottom border-top text-center text-uppercase pt-3 mb-3"><p>{{ __('Please login to enroll') }}</p></div>
                <div class="row">
                    <a class="btn btn-primary" href="{{ route('login') }}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">{{ __('Login Now') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="divider mb-5">
        <div class="divider-text text-uppercase"><span class="display-3">{{ __('Ongoing Events') }}</span></div>
    </div>
</div>

<div class="row">
    @forelse ($ongoing_events as $oevents)
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
            <div class="card">
                <img class="card-img-top" src="{{ asset('/storage\/'.$oevents->image) }}" height="300px" width="450px" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title text-uppercase">{{ __($oevents->name) }}</h5>
                    {{-- <p class="card-text"> {{ Str::limit($oevents->description, 100) }}</p> --}}
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                {{-- <tr class="text-uppercase">
                                    <td>{{ __('Event Category') }}</td>
                                    <td>{{ __($oevents->category->name) }}</td>
                                </tr> --}}
                                <tr class="text-uppercase">
                                    <td>{{ __('Event Started At') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($oevents->started_at)->format('d-m-Y h:m A') }}</td>
                                </tr>
                                <tr class="text-uppercase">
                                    <td>{{ __('Event end at') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($oevents->end_at)->format('d-m-Y h:m A') }}</td>
                                </tr>
                                {{-- <tr class="text-uppercase">
                                    <td>{{ __('Subscribers') }}</td>
                                    <td>{{ __($oevents->subscribers) }}</td>
                                </tr>
                                <tr class="text-uppercase">
                                    <td>{{ __('required Subscribers') }}</td>
                                    <td>{{ __($oevents->subscribers) }}</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>    
                </div>
                <div class="card-footer d-flex justify-content-around pt-0">
                    <a href="{{ route('event.show', ['id'=>$oevents->id]) }}" class="card-link">{{ __('View Details') }}</a>
                    @auth
                        <form action="{{ route('booking.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $oevents->id }}">
                            <button type="submit" class="btn btn-link p-0">{{ __('Enroll Now') }}</button>
                        </form>
                    @endauth
                    @guest
                        <a href="javascript:void(0)" class="card-link oevents_enroll_now">{{ __('Enroll Now') }}</a>
                    @endguest
                </div>
            </div>
        </div>
    @empty
        <p>{{ __('There is no events available.') }}</p>
    @endforelse
</div>

<div class="row">
    <div class="divider mb-5">
        <div class="divider-text text-uppercase"><span class="display-3">{{ __('upcomming Events') }}</span></div>
    </div>
</div>

<div class="row">
    @forelse ($upcomming_events as $upevents)
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4">
            <div class="card">
                <img class="card-img-top" src="{{ asset('/storage\/'.$upevents->image) }}" height="300px" width="450px" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title text-uppercase">{{ __($upevents->name) }}</h5>
                    {{-- <p class="card-text"> {{ Str::limit($upevents->description, 100) }}</p> --}}
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                {{-- <tr class="text-uppercase">
                                    <td>{{ __('Event Category') }}</td>
                                    <td>{{ __($upevents->category->name) }}</td>
                                </tr> --}}
                                <tr class="text-uppercase">
                                    <td>{{ __('Event Started At') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($upevents->started_at)->format('d-m-Y h:m A') }}</td>
                                </tr>
                                <tr class="text-uppercase">
                                    <td>{{ __('Event end at') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($upevents->end_at)->format('d-m-Y h:m A') }}</td>
                                </tr>
                                {{-- <tr class="text-uppercase">
                                    <td>{{ __('Subscribers') }}</td>
                                    <td>{{ __($upevents->subscribers) }}</td>
                                </tr>
                                <tr class="text-uppercase">
                                    <td>{{ __('required Subscribers') }}</td>
                                    <td>{{ __($upevents->subscribers) }}</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>    
                </div>
                <div class="card-footer d-flex justify-content-around pt-0">
                    <a href="{{ route('event.show', ['id'=>$upevents->id]) }}" class="card-link">{{ __('View Details') }}</a>
                    <a href="javascript:void(0)" class="card-link">{{ __('Enroll Now') }}</a>
                </div>
            </div>
        </div>
    @empty
        <p>{{ __('There is no events available.') }}</p>
    @endforelse
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $('.oevents_enroll_now').click(function (e) { 
            e.preventDefault();
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
