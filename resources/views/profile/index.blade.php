@extends('app.layout')

@section('title', 'Profile')

@section('content')

<div class="container">
    <div class="row">
        <div class="divider my-5">
            <div class="divider-text text-uppercase"><span class="display-3">{{ __('Your Profile') }}</span></div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-5 mt-3">
            <div class="card">
                <img class="card-img img-fluid" src="
                    @if(isset($profile->avatar))
                        {{ asset('assets/img/avatars/thumbnail/'.$profile->avatar) }}
                    @else
                        {{ asset('assets/img/avatars/user.png') }}
                    @endif
                " alt="{{ __($user->name) }}">
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-7 mt-3">
            <div class="card">
                <div class="card-body">
                    <dl class="row">
                        <h1>{{ __($user->name) }}</h1>
                        <hr>

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
    </div>

</div>


@endsection