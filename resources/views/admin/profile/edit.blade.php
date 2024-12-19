@extends('admin.layout.app')

@section('title', 'Profile Details')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="d-flex justify-content-between border-bottom border-3 border-dark mb-3">
                <h5 class="card-header">{{ __('Profile Details') }}</h5>
                <a href="{{ route('admin.user.index') }}" class="btn btn-primary border-0 m-3">
                    <span class="tf-icons bx bx-left-arrow-alt"></span>&nbsp; Back
                </a>
            </div>
            <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center justify-content-around gap-4">
                        <img
                            @if(isset($profile->avatar))
                                src="{{ asset('assets/img/avatars/thumbnail/'.$profile->avatar) }}"
                            @else
                                src="{{ asset('assets/img/avatars/user.png') }}"
                            @endif
                            alt="user-avatar"
                            class="d-block rounded"
                            height="100"
                            width="100"
                            id="uploadedAvatar"
                        />
                        <div class="text-bold">
                            <blockquote class="blockquote">{{ $user->name }}</blockquote>
                            <blockquote class="blockquote">{{ $user->email }}</blockquote>
                        </div>
                    </div>
                </div>

                <hr class="my-0" />

                <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="{{ route('admin.profile.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required/>

                                @error('name')
                                    <p class="invalid-feedback"> {{ $message }} </p>
                                @enderror
                            </div>

                            {{-- <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input
                                    class="form-control @error('email') is-invalid @enderror"
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    placeholder="name@domain.com"
                                />

                                @error('email')
                                    <p class="invalid-feedback"> {{ $message }} </p>
                                @enderror

                            </div> --}}

                            <div class="mb-3 col-md-6">
                                <label for="avatar" class="form-label">Upload Profile</label>
                                <input class="form-control @error('avatar') is-invalid @enderror" type="file" id="avatar" name='avatar'>
                                @error('avatar')
                                    <p class="invalid-feedback"> {{ $message }} </p>
                                @enderror                                
                            </div>

                            {{-- <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Phone Number</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">{{ __('IN (+91)') }}</span>
                                    <input
                                        type="tel"
                                        id="phoneNumber"
                                        name="phone_number"
                                        class="form-control @error('phone_number') is-invalid @enderror"
                                        placeholder="9988774455"
                                        pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                                    />
                                </div>
                                <div class="form-text">{{ __('Use format like : xxx-xxx-xxxx') }}</div>
                                @error('phone_number')
                                    <p class="invalid-feedback"> {{ $message }} </p>
                                @enderror                                
                            </div> --}}
                            
                            <div class="mb-3 col-md-6">
                                <label class="form-lable d-block">Gender</label>
                                <div class="form-check form-check-inline mt-3">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" @if($profile->gender == 'male') checked @endif type="radio" name="gender" id="male" value="male">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" @if($profile->gender == 'female') checked @endif type="radio" name="gender" id="female" value="female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" @if($profile->gender == 'other') checked @endif type="radio" name="gender" id="other" value="other">
                                    <label class="form-check-label" for="other">Other</label>
                                </div>

                                @error('gender')
                                    <p class="invalid-feedback"> {{ $message }} </p>
                                @enderror
                            </div>
                            
                            @php
                                $street = explode('|', $profile->street);
                                $street1 = $street[0];
                                $street2 = (isset($street[1]))? $street[1] : '';
                            @endphp

                            <div class="mb-3 col-md-6">
                                <label for="street1" class="form-label">Street 1</label>
                                <input type="text" value="{{ old('street1', $street1) }}" class="form-control @error('street1') is-invalid @enderror" id="street1" name="street1" placeholder="street1" />
                                @error('street1')
                                    <p class="invalid-feedback"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="street2" class="form-label">Street 2</label>
                                <input type="text" value="{{ old('street2', $street2) }}" class="form-control @error('street2') is-invalid @enderror" id="street2" name="street2" placeholder="street2" />
                                @error('street2')
                                    <p class="invalid-feedback"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input class="form-control @error('city') is-invalid @enderror" type="text" id="city" name="city" value="{{ old('city', $profile->city) }}" placeholder="Lucknow"/>
                                @error('city')
                                    <p class="invalid-feedback"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="state" class="form-label">State</label>
                                <input class="form-control @error('state') is-invalid @enderror" type="text" id="state" name="state" value="{{ old('state', $profile->state) }}" placeholder="Uttar Pradesh" />
                                @error('city')
                                    <p class="invalid-feedback"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="zipCode" class="form-label">Zip Code</label>
                                <input type="number" class="form-control @error('zipcode') is-invalid @enderror" id="zipCode" name="zipcode" value="{{ old('zipcode', $profile->zip_code) }}" placeholder="123456"/>
                                @error('zipcode')
                                    <p class="invalid-feedback"> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        </div>
                    </form>
                </div>
            <!-- /Account -->
        </div>

        <div class="card">
            <h5 class="card-header">Delete Account</h5>
            <div class="card-body">
                <div class="mb-3 col-12 mb-0">
                    <div class="alert alert-warning">
                    <h6 class="alert-heading fw-bold mb-1">{{ __('Are you sure you want to delete your account?') }}</h6>
                    <p class="mb-0">{{ __('Once you delete your account, there is no going back. Please be certain.') }}</p>
                    </div>
                </div>
                <form id="formAccountDeactivation" action="{{ route('admin.profile.destroy', $profile->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="form-check mb-3">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="delete_account"
                            value="checked"
                            id="accountActivation"
                            required
                        />
                        <label class="form-check-label" for="accountActivation">{{ __('I confirm my account deactivation') }}</label>
                    </div>
                    <button type="submit" class="btn btn-danger deactivate-account" onclick="return confirm('Are you sure?');">{{ __('Deactivate Account') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
