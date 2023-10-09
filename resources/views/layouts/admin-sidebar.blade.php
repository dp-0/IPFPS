<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="text-white"><x-application-logo class="w-16 h-16" /></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }} <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    {{-- Search Sidebar --}}
    <li class="nav-item {{ Request::is('search/image') ? 'active' : '' }}">
        <a class="nav-link bg-red" href="#" data-toggle="collapse" data-target="#search" aria-expanded="true"
            aria-controls="users">
            <i class="fas fa-fw fa-search"></i>
            <span>Search</span>
        </a>
        <div id="search" class="collapse {{ Request::is('search/image') ? 'show' : '' }}" aria-labelledby="search"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('search/image') ? 'active' : '' }}"
                    href="{{ route('search.imagesearch') }}"><i class="fa fa-image"></i> Image Search</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Users Collapse Menu -->
    <li class="nav-item {{ Request::is('admin/users', 'admin/roles') ? 'active' : '' }}">
        <a class="nav-link bg-red" href="#" data-toggle="collapse" data-target="#users" aria-expanded="true"
            aria-controls="users">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
        <div id="users" class="collapse {{ Request::is('admin/users', 'admin/roles') ? 'show' : '' }}"
            aria-labelledby="users" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('admin/users') ? 'active' : '' }}"
                    href="{{ route('admin.users') }}">Users</a>
                <a class="collapse-item {{ Request::is('admin/roles') ? 'active' : '' }}"
                    href="{{ route('admin.roles') }}">Roles</a>
            </div>
        </div>
    </li>

    {{-- Complain Management --}}

    <li
        class="nav-item {{ Request::is('admin/complinants/details/*') || Request::is('admin/complain/view/*') ||  Request::is('admin/complainants', 'admin/complain', 'admin/complain/new') ? 'active' : '' }}">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#complain" aria-expanded="true"
            aria-controls="complain">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Complain Management</span>
        </a>
        <div id="complain"
            class="collapse {{ Request::is('admin/complinants/details/*') || Request::is('admin/complain/view/*') ||  Request::is('admin/complainants', 'admin/complain', 'admin/complain/new') ? 'show' : '' }}"
            aria-labelledby="complain" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('admin/complinants/details/*') || Request::is('admin/complainants') ? 'active' : '' }}"
                    href="{{ route('admin.fir.complainants') }}">Complainants</a>
                <a class="collapse-item {{ Request::is('admin/complain/new') ? 'active' : '' }}"
                    href="{{ route('admin.fir.complain.new') }}">New Complain</a>
                <a class="collapse-item {{ Request::is('admin/complain/view/*') || Request::is('admin/complain') ? 'active' : '' }}"
                    href="{{ route('admin.fir.complain') }}">Complain Lists</a>
            </div>
        </div>
    </li>

    {{--    Fir Management Sidebar --}}
    <li
        class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#fir" aria-expanded="true"
            aria-controls="fir">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Fir Management</span>
        </a>
        <div id="fir"
            class="collapse {{ Request::is('admin/fir/view/*') || Request::is('admin/fir-list', 'admin/fir/new', 'admin/incident-type', 'admin/case-priority', 'admin/fir-status') ? 'show' : '' }}"
            aria-labelledby="fir" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('admin/fir/view/*') || Request::is('admin/fir-list','admin/fir/new') ? 'active' : '' }}"
                href="{{ route('admin.fir.fir-list') }}">Fir Lists</a>
                <a class="collapse-item {{ Request::is('admin/incident-type') ? 'active' : '' }}"
                    href="{{ route('admin.fir.incident-type') }}">Incident Type</a>
                <a class="collapse-item {{ Request::is('admin/case-priority') ? 'active' : '' }}"
                    href="{{ route('admin.fir.case-priority') }}">Case Priority</a>
                <a class="collapse-item {{ Request::is('admin/fir-status') ? 'active' : '' }}"
                    href="{{ route('admin.fir.fir-status') }}">Fir Status</a>
            </div>
        </div>
    </li>
    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item active" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
