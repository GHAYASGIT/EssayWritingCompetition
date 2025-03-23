{{-- <nav
    class="layout-navbar navbar-expand-lg navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar"
>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                />
                </div>
            </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                        <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                    <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">John Doe</span>
                                    <small class="text-muted">Admin</small>
                                </div>
                                </div>
                            </a>
                        </li>

                        <li>
                            <div class="dropdown-divider"></div>
                        </li>

                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">Settings</span>
                            </a>
                        </li>

                        <li>
                            <div class="dropdown-divider"></div>
                        </li>

                        <li>
                            <a class="dropdown-item" href="auth-login-basic.html">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <!--/ User -->
        </ul>
    </div>
</nav> --}}

<nav class="navbar navbar-expand-lg bg-navbar-theme sticky-top shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}"> {{"Event"}} </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class='bx bx-menu'></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}"> {{__("Home")}} </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ url('/event-history') }}">Event History</a>
                </li>
            </ul>

            @if(Auth::check())
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <img class="w-px-40 h-auto rounded-circle" src="
                        @if(isset(auth()->user()->profile->avatar))
                            {{ asset('assets/img/avatars/thumbnail/'.auth()->user()->profile->avatar) }}
                        @else
                            {{ Avatar::create(auth()->user()->name)->toBase64(); }}
                        @endif
                    " alt="{{ __(auth()->user()->name) }}">
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <img class="w-px-40 h-auto rounded-circle" src="
                                        @if(isset(auth()->user()->profile->avatar))
                                            {{ asset('assets/img/avatars/thumbnail/'.auth()->user()->profile->avatar) }}
                                        @else
                                            {{ Avatar::create(auth()->user()->name)->toBase64(); }}
                                        @endif
                                    " alt="{{ __(auth()->user()->name) }}">
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ __(auth()->user()->name) }}</span>
                                    <small class="text-muted">
                                        @foreach(auth()->user()->getRoleNames() as $role)
                                            {{ __($role) }}
                                        @endforeach
                                    </small>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>

                    {{-- <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li> --}}

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">{{ __('Log Out') }}</span>
                            </a>
                        </form>
                    </li>
                </ul>
            @else
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <img class="w-px-40 h-auto rounded-circle" src="{{ asset('assets/img/avatars/user.png') }}" alt="login/register">
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('login') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">{{ __('Login') }}</span>
                        </a>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('register') }}">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">{{ __('Register') }}</span>
                        </a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>