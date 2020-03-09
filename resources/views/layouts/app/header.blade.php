<header class="c-header c-header-light c-header-fixed c-header-with-subheader">

    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
        <span class="c-icon c-icon-lg">
            <i class="cil-menu"></i>
        </span>
    </button>
    <a class="c-header-brand d-lg-none c-header-brand-sm-up-center" href="#">
        <span class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <i class="cil-coreui"></i>
        </span>
    </a>
    <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
        <span class="c-icon c-icon-lg">
            <i class="cil-menu"></i>
        </span>
    </button>


    <ul class="c-header-nav mfs-auto">
        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="c-avatar">
                    <img class="c-avatar-img" src="{{ Avatar::create(Auth::user()->nama)->toBase64() }}" alt="user@email.com">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2">
                    <strong>Settings</strong>
                </div>
                <a class="dropdown-item" href="{{ route('profil.index') }}">
                    <span class="c-icon mfe-2">
                        <i class="cil-user"></i>
                    </span> Profile
                </a>
                <a class="dropdown-item" href="#">
                    <span class="c-icon mfe-2">
                        <i class="cil-settings"></i>
                    </span> Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    <span class="c-icon mfe-2">
                        <i class="cil-account-logout"></i>
                    </span> Logout
                </a>
            </div>
        </li>

    </ul>
    <ul class="c-header-nav">
        <li class="c-header-nav-item px-3 c-d-legacy-none">
            <button class="c-class-toggler c-header-nav-btn" type="button" id="header-tooltip" data-target="body" data-class="c-dark-theme" data-toggle="c-tooltip" data-placement="bottom" title="Toggle Light/Dark Mode">
                <span class="c-icon c-d-dark-none">
                    <i class="cil-moon"></i>
                </span>
                <span class="c-icon c-d-default-none">
                    <i class="cil-sun"></i>
                </span>
            </button>
        </li>
    </ul>
    <div class="c-subheader justify-content-between px-3">
        <!-- Breadcrumb-->
        <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
            @yield('breadcrumb')
            <!-- Breadcrumb Menu-->
        </ol>
        <div class="c-header-nav d-md-down-none mfe-2">
            @yield('toolbar')
        </div>
    </div>
</header>
