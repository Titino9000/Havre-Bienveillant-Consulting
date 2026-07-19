<!-- ! Hide app brand if navbar-full -->
<div class="app-brand demo">
    <a href="/" class="app-brand-link">
        <span class="app-brand-logo demo">
            <img alt="HBC Icon" src="{{ asset('assets/backend/img/logos/icon-only.png') }}" style="width: 45px;">
        </span>
        <div class="ms-3 d-flex flex-column justify-content-center" style="font-size: 0.90rem; line-height: 1.15; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; font-family: 'Times New Roman', Times, serif; color: #305a46;">
            <span>Havre</span>
            <span>Bienveillant</span>
            <span>Consulting</span>
        </div>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
</div>

<div class="menu-inner-shadow" style="display: none;"></div>

<ul class="menu-inner py-1">
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Core</span>
    </li>
    <li class="menu-item {{ (request()->routeIs('admin.dashboard')) ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}" class="menu-link ">
            <i class="menu-icon tf-icons bx bxs-dashboard"></i>
            <div class="text-truncate">Dashboard</div>
        </a>
    </li>

    <!-- Organization -->
    <li class="menu-item {{ (request()->routeIs('admin.services') || request()->routeIs('admin.team') || request()->routeIs('admin.achievements')) ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-building-house"></i>
            <div class="text-truncate">Organization</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ (request()->routeIs('admin.services')) ? 'active' : '' }}">
                <a href="{{ route('admin.services') }}" class="menu-link ">
                    <div class="text-truncate">Services</div>
                </a>
            </li>
            <li class="menu-item {{ (request()->routeIs('admin.team')) ? 'active' : '' }}">
                <a href="{{ route('admin.team') }}" class="menu-link ">
                    <div class="text-truncate">Team Members</div>
                </a>
            </li>
            <li class="menu-item {{ (request()->routeIs('admin.achievements')) ? 'active' : '' }}">
                <a href="{{ route('admin.achievements') }}" class="menu-link ">
                    <div class="text-truncate">Achievements</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Content Management -->
    <li class="menu-item {{ (request()->routeIs('admin.sliders') || request()->routeIs('admin.knowledge_hub') || request()->routeIs('admin.faqs')) ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-book-content"></i>
            <div class="text-truncate">Content</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ (request()->routeIs('admin.sliders')) ? 'active' : '' }}">
                <a href="{{ route('admin.sliders') }}" class="menu-link ">
                    <div class="text-truncate">Sliders</div>
                </a>
            </li>
            <li class="menu-item {{ (request()->routeIs('admin.knowledge_hub')) ? 'active' : '' }}">
                <a href="{{ route('admin.knowledge_hub') }}" class="menu-link ">
                    <div class="text-truncate">Knowledge Hub</div>
                </a>
            </li>
            <li class="menu-item {{ (request()->routeIs('admin.faqs')) ? 'active' : '' }}">
                <a href="{{ route('admin.faqs') }}" class="menu-link ">
                    <div class="text-truncate">FAQs</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- User Management -->
    <li class="menu-item {{ (request()->routeIs('admin.users') || request()->routeIs('admin.roles') || request()->routeIs('admin.permissions')) ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-user-circle"></i>
            <div class="text-truncate">User Management</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <a href="{{ route('admin.users') }}" class="menu-link">
                    <div data-i18n="Users">Users</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.roles') ? 'active' : '' }}">
                <a href="{{ route('admin.roles') }}" class="menu-link">
                    <div data-i18n="Roles">Roles</div>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.permissions') ? 'active' : '' }}">
                <a href="{{ route('admin.permissions') }}" class="menu-link">
                    <div data-i18n="Permissions">Permissions</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- System & Monitoring -->
    <li class="menu-item {{ (request()->routeIs('admin.settings.email') || request()->routeIs('admin.monitoring.health') || request()->routeIs('admin.monitoring.logs')) ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-server"></i>
            <div class="text-truncate">System & Monitor</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ (request()->routeIs('admin.settings.email')) ? 'active' : '' }}">
                <a href="{{ route('admin.settings.email') }}" class="menu-link ">
                    <div class="text-truncate">Email Settings</div>
                </a>
            </li>
            <li class="menu-item {{ (request()->routeIs('admin.monitoring.health')) ? 'active' : '' }}">
                <a href="{{ route('admin.monitoring.health') }}" class="menu-link ">
                    <div class="text-truncate">System Health</div>
                </a>
            </li>
            <li class="menu-item {{ (request()->routeIs('admin.monitoring.logs')) ? 'active' : '' }}">
                <a href="{{ route('admin.monitoring.logs') }}" class="menu-link ">
                    <div class="text-truncate">404 Error Logs</div>
                </a>
            </li>
            <li class="menu-item {{ (request()->routeIs('admin.translations')) ? 'active' : '' }}">
                <a href="{{ route('admin.translations') }}" class="menu-link ">
                    <div class="text-truncate">Translations</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Communication (Stand-alone) -->
    <li class="menu-item {{ request()->routeIs('admin.inquiries') ? 'active' : '' }}">
        @php $unreadCount = \App\Models\Inquiry::where('is_read', false)->count(); @endphp
        <a href="{{ route('admin.inquiries') }}" class="menu-link d-flex justify-content-between align-items-center">
            <div>
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <span class="text-truncate">Inquiries</span>
            </div>
            @if($unreadCount > 0)
                <div class="badge bg-danger rounded-pill">{{ $unreadCount }}</div>
            @endif
        </a>
    </li>

    <!-- Personal -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Personal</span>
    </li>
    <li class="menu-item">
        <form method="POST" action="{{ route('logout') }}" id="sidebar-logout-form">
            @csrf
        </form>
        <a href="javascript:void(0);" onclick="document.getElementById('sidebar-logout-form').submit();" class="menu-link text-danger">
            <i class="menu-icon tf-icons bx bx-power-off"></i>
            <div class="text-truncate">Logout</div>
        </a>
    </li>
</ul>
