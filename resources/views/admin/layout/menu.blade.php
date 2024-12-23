<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
            {{-- <div class="app-brand-logo demo">
                <img src="https://w7.pngwing.com/pngs/381/771/png-transparent-2x3-hd-logo-thumbnail.png" width="220px" height="55px" />
            </div> --}}
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item @if(Request::segment(1) == 'dashboard') active @endif">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        @hasanyrole('admin|super-admin')
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">{{ __('Account') }}</span>
            </li>
            <li class="menu-item @if(in_array(Request::segment(2), ['adminuser','user','role','permission'])) open active @endif">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="User Management">{{ __('User Management') }}</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item @if(Request::segment(2) == 'adminuser') active @endif">
                        <a href="{{ route('admin.adminuser.index') }}" class="menu-link">
                            <div data-i18n="Admin Users">{{ __('Admin Users') }}</div>
                        </a>
                    </li>
                    <li class="menu-item @if(Request::segment(2) == 'user') active @endif">
                        <a href="{{ route('admin.user.index') }}" class="menu-link">
                            <div data-i18n="Users">{{ __('Users') }}</div>
                        </a>
                    </li>
                    @hasrole('super-admin')
                        <li class="menu-item @if(Request::segment(2) == 'role') active @endif">
                            <a href="{{ route('admin.role.index') }}" class="menu-link">
                                <div data-i18n="Roles">{{ __('Roles') }}</div>
                            </a>
                        </li>
                        <li class="menu-item @if(Request::segment(2) == 'permission') active @endif">
                            <a href="{{ route('admin.permission.index') }}" class="menu-link">
                                <div data-i18n="Permissions">{{ __('Permissions') }}</div>
                            </a>
                        </li>
                    @endhasrole
                </ul>
            </li>
        @endhasanyrole

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ __('Events') }}</span>
        </li>
        <li class="menu-item @if(in_array(Request::segment(2), ['categories','events'])) open active @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Event Management">{{ __('Event Management') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if(Request::segment(2) == 'categories') active @endif">
                    <a href="{{ route('admin.categories.index') }}" class="menu-link">
                        <div data-i18n="Categories">{{ __('Categories') }}</div>
                    </a>
                </li>
                <li class="menu-item @if(Request::segment(2) == 'events') active @endif">
                    <a href="{{ route('admin.events.index') }}" class="menu-link">
                        <div data-i18n="Events">{{ __('Events') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ __('Enrolments') }}</span>
        </li>
        <li class="menu-item @if(in_array(Request::segment(2), ['booking'])) open active @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Enrolment Management">{{ __('Enrolment Management') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if(Request::segment(2) == 'booking') active @endif">
                    <a href="{{ route('admin.booking.index') }}" class="menu-link">
                        <div data-i18n="Enrolments">{{ __('Enrolments') }}</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
  </aside>