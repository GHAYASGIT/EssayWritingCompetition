@extends('app.layout')

@section('title', 'Profile')

@section('content')

<div class="container-fluid">
    <div class="row profile">
        <div class="col-lg-2 col-md-3 col-sm-12">
            <ul class="nav nav-tabs flex-column" id="myTab" role="tablist">
                <li class="nav-item dropdown d-block d-lg-none d-md-none">
                    <a class="nav-link dropdown-toggle" id="showmenu" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">{{ __('Account Information') }}</a>
                    <ul class="dropdown-menu w-100">
                        <li>
                            <p class="nav-link" onclick="showGenre(this)" id="account-tab" data-bs-toggle="tab" data-bs-target="#account-tab-pane" type="button" role="tab" aria-controls="account-tab-pane" aria-selected="true">{{ __('Account Information') }}</p>
                        </li>
                        <li>
                            <p class="nav-link" onclick="showGenre(this)" id="inrolment-tab" data-bs-toggle="tab" data-bs-target="#inrolment-tab-pane" type="button" role="tab" aria-controls="inrolment-tab-pane" aria-selected="false">{{ __('Inrolments') }}</p>                   
                        </li>
                    </ul>
                </li>

                <li class="nav-item d-none d-lg-block d-md-block" role="presentation">
                  <p class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account-tab-pane" type="button" role="tab" aria-controls="account-tab-pane" aria-selected="true">{{ __('Account Information') }}</p>
                </li>
                <li class="nav-item d-none d-lg-block d-md-block" role="presentation">
                  <p class="nav-link" id="inrolment-tab" data-bs-toggle="tab" data-bs-target="#inrolment-tab-pane" type="button" role="tab" aria-controls="inrolment-tab-pane" aria-selected="false">{{ __('Inrolments') }}</p>
                </li>
            </ul>
        </div>
        <div class="col-lg-10 col-md-9 col-sm-12">
            <div class="tab-content p-0">
                <div class="tab-pane fade show active" id="account-tab-pane" role="tabpanel" aria-labelledby="account-tab" tabindex="0">
                    <div class="row">
                        <div class="divider">
                            <div class="divider-text text-uppercase"><span class="display-6">{{ __('Your Profile') }}</span></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-evenly align-items-center">
                        <div class="card">
                            <img class="card-img img-fluid" src="
                                @if(isset($profile->avatar))
                                    {{ asset('assets/img/avatars/thumbnail/'.$profile->avatar) }}
                                @else
                                    {{ asset('assets/img/avatars/user.png') }}
                                @endif
                            " alt="{{ __($user->name) }}">
                        </div>
                        <p><h1>{{ __($user->name) }}</h1></p>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <dl>                
                                <dt class="col-sm-4 text-uppercase">{{ __('Phone Number') }}</dt>
                                <dd class="col-sm-8">{{ __($user->name) }}</dd>
        
                                <hr>
        
                                <dt class="col-sm-4 text-uppercase">{{ __('Status') }}</dt>
                                <dd class="col-sm-8">{{ __('not approved') }}</dd>
        
                                <hr>
                    
                                <dt class="col-sm-4 text-uppercase">{{ __('gender') }}</dt>
                                <dd class="col-sm-8">{{ __($profile->gender) }}</dd>
                                <hr>
                                <dt class="col-sm-4 text-uppercase">{{ __('street') }}</dt>
                                <dd class="col-sm-8">{{ __($profile->street) }}</dd>
                                <hr>
                                <dt class="col-sm-4 text-uppercase">{{ __('city') }}</dt>
                                <dd class="col-sm-8">{{ __($profile->city) }}</dd>
                                <hr>
                                <dt class="col-sm-4 text-uppercase">{{ __('state') }}</dt>
                                <dd class="col-sm-8">{{ __($profile->state) }}</dd>
                                <hr>
                                <dt class="col-sm-4 text-uppercase">{{ __('post code') }}</dt>
                                <dd class="col-sm-8">{{ __($profile->zip_code) }}</dd>
                                <hr class="m-0">
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="inrolment-tab-pane" role="tabpanel" aria-labelledby="inrolment-tab" tabindex="0">
                    <div class="row">
                        <div class="divider">
                            <div class="divider-text text-uppercase"><span class="display-6">{{ __('Your Enrolments') }}</span></div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <h5 class="card-header">{{ __('Enrolments') }}</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#Enrolment No</th>
                                        <th>Event Id</th>
                                        <th>Event Name</th>
                                        <th>Event Started at</th>
                                        <th>Event Ended at</th>
                                        <th>Enroled at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $booking)
                                        <tr>
                                            <td>{{ __($booking->booking_no) }}</td>
                                            <td>{{ __($booking->event->id) }}</td>
                                            <td>{{ __($booking->event->name) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($booking->event->started_at)->format('d-m-Y h:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($booking->event->end_at)->format('d-m-Y h:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('d-m-Y h:i A') }}</td>
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
                                            {!! $bookings->links('pagination::bootstrap-5') !!}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>              
        </div>
    </div>

</div>


@endsection

@section('script')
    <script type="text/javascript">
        function showGenre(item) {
            document.getElementById("showmenu").innerHTML = item.innerHTML;
        }
    </script>
@endsection