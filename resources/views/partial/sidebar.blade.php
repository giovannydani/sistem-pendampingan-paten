<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

    @if (auth()->user()->role->isUser())
        <li class="sidebar-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
            <a href="{{ route('user.dashboard') }}" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
            </a>
        </li>
        {{-- <li class="sidebar-item {{ request()->routeIs('user.template.*') ? 'active' : '' }}">
            <a href="{{ route('user.template.index') }}" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Template</span>
            </a>
        </li>
        <li class="sidebar-item {{ request()->routeIs('user.ajuan.*') ? 'active' : '' }}">
            <a href="{{ route('user.ajuan.index') }}" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Ajuan</span>
            </a>
        </li> --}}
    @endif

    @if (auth()->user()->role->isAdmin())
        <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        {{-- <li class="sidebar-item {{ request()->routeIs('admin.ajuan.*') ? 'active' : '' }}">
            <a href="{{ route('admin.ajuan.index') }}" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Ajuan</span>
            </a>
        </li>
        
        <li class="sidebar-item mt-5 {{ request()->routeIs('admin.parameter.holder.*') ? 'active' : '' }}">
            <a href="{{ route('admin.parameter.holder.index') }}" class="sidebar-link">
                <i class="bi bi-grid-fill"></i>
                <span>Default Holder</span>
            </a>
        </li>
        <li class="sidebar-item {{ request()->routeIs('admin.template.*') ? 'active' : '' }}">
            <a href="{{ route('admin.template.index') }}" class="sidebar-link">
                <i class="bi bi-grid-fill"></i>
                <span>Template</span>
            </a>
        </li>
        <li class="sidebar-item {{ request()->routeIs('admin.application-type.*') ? 'active' : '' }}">
            <a href="{{ route('admin.application-type.index') }}" class="sidebar-link">
                <i class="bi bi-grid-fill"></i>
                <span>Tipe Ajuan</span>
            </a>
        </li>
        @if (auth()->user()->role->isSuperAdmin())
            <li class="sidebar-item {{ request()->routeIs('admin.manage-admin.*') ? 'active' : '' }}">
                <a href="{{ route('admin.manage-admin.index') }}" class="sidebar-link">
                <i class="bi bi-grid-fill"></i>
                <span>Manage Admin</span>
                </a>
            </li>
        @endif --}}
    @endif
    
    
        {{-- @dump(auth()->user()->role->isAdmin()) --}}
        {{-- @if (auth()->user()->role->isAdmin())
        <li class="sidebar-item mt-5 {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
            <a href="{{ route('admin.profile.index') }}" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Profile</span>
            </a>
        </li>
        @endif
        @if (auth()->user()->role->isUser())
        <li class="sidebar-item mt-5 {{ request()->routeIs('user.profile.*') ? 'active' : '' }}">
            <a href="{{ route('user.profile.index') }}" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Profile</span>
            </a>
        </li>
        @endif --}}
        <li class="sidebar-item">
            <a style="cursor: pointer; background-color: red" class='sidebar-link' onclick="logoutModalShow()">
            <i style="color: #fff" class="fa-solid fa-right-from-bracket"></i>
            <span style="color: #fff">Log Out</span>
            </a>
        </li>

      {{-- @if (request('is_super_admin') || request('is_admin'))    
        @if (request()->routeIs('user.*'))
            <li class="sidebar-item mt-5">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link" style="background-color: red; color: white">
                <i class="fa-solid fa-arrow-right" style="color: white"></i>
                <span>Go To Admin Panel</span>
            </a>
            </li>
        @endif

        @if (request()->routeIs('admin.*'))
            <li class="sidebar-item mt-5">
            <a href="{{ route('user.dashboard') }}" class="sidebar-link" style="background-color: red; color: white">
                <i class="fa-solid fa-arrow-right" style="color: white"></i>
                <span>Go To User Panel</span>
            </a>
            </li>
        @endif
      @endif --}}


    </ul>
  </div>