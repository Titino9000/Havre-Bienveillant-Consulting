<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{route('admin.dashboard')}}" class="app-brand-link">
              <span class="app-brand-logo demo mt-2 mb-3">
                <img src="{{asset('images/logo/logo.png')}}" alt="logo" width="150"/>
              </span>
        </a>
        <button class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none btn btn-icon"
                type="button">
            <i class="bx bx-menu bx-sm"></i>
        </button>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>

    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ (request()->is('admin/dashboard')) ? 'active ' : '' }}">
            <a href="{{route('admin.dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>{{ __('Dashboard') }}</div>
            </a>
        </li>

        <!-- Blog -->
        <li class="menu-item {{ (request()->is('admin/blog') || request()->is('admin/blog/*')) ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div>{{ __('Blog') }}</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ (request()->is('admin/blog/posts') || request()->is('admin/blog/posts/*')) ? 'active' : '' }}">
                    <a href="{{route('admin.blog.posts.view')}}" class="menu-link">
                        <div>{{ __('Post') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('admin/blog/categories')) ? 'active ' : '' }}">
                    <a href="{{route('admin.blog.posts.categories.view')}}" class="menu-link">
                        <div>{{ __('Categories') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('admin/blog/tags')) ? 'active ' : '' }}">
                    <a href="{{route('admin.blog.posts.tags.view')}}" class="menu-link">
                        <div>{{ __('tags') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- projects -->
        <li class="menu-item {{ (request()->is('admin/projects') || request()->is('admin/projects/*')) ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-list-ul"></i>
                <div>{{ __('Projects') }}</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item
                {{ (request()->is('admin/projects/all')) ? 'active ' : '' }}
                {{ (request()->is('admin/projects/create')) ? 'active ' : '' }}
                {{ (request()->is('admin/projects/edit')) ? 'active ' : '' }}">
                    <a href="{{route('admin.projects.view')}}" class="menu-link">
                        <div>{{ __('Projects') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ (request()->is('admin/projects/categories')) ? 'active ' : '' }}">
                    <a href="{{route('admin.projects.categories.view')}}" class="menu-link">
                        <div>{{ __('Categories') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Offerings -->
        <li class="menu-item {{ request()->routeIs('admin.services.*') || request()->routeIs('admin.products.*') || request()->routeIs('admin.solutions.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-store-alt"></i>
                <div>{{ __('Offerings') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.services.view') ? 'active' : '' }}">
                    <a href="{{ route('admin.services.view') }}" class="menu-link">
                        <div>{{ __('Services') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.products.view') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.view') }}" class="menu-link">
                        <div>{{ __('Products') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.solutions.view') ? 'active' : '' }}">
                    <a href="{{ route('admin.solutions.view') }}" class="menu-link">
                        <div>{{ __('Solutions') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- clients -->
        <li class="menu-item {{ (request()->is('admin/clients')) ? 'active ' : '' }}">
            <a href="{{route('admin.clients.view')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-list-ul"></i>
                <div>{{ __('Clients') }}</div>
            </a>
        </li>

        <!-- clients -->
        <li class="menu-item {{ (request()->is('admin/users/all')) ? 'active ' : '' }}">
            <a href="{{route('admin.users.view')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div>{{ __('Users') }}</div>
            </a>
        </li>
        <!-- Communication -->
        <li class="menu-item {{ request()->routeIs('admin.contacts.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-chat"></i>
                <div>{{ __('Communication') }}</div>
                @php $unreadCount = \App\Models\CRM\ContactFormRecord::whereNull('read_at')->count(); @endphp
                @if($unreadCount > 0)
                    <div class="badge bg-danger rounded-pill ms-auto me-2">{{ $unreadCount }}</div>
                @endif
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.contacts.forms.view') ? 'active ' : '' }}">
                    <a href="{{route('admin.contacts.forms.view')}}" class="menu-link d-flex justify-content-between align-items-center">
                        <div>{{ __('Messages') }}</div>
                        @if($unreadCount > 0)
                            <div class="badge bg-danger rounded-pill">{{ $unreadCount }}</div>
                        @endif
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.contacts.newsletter.view') ? 'active ' : '' }}">
                    <a href="{{route('admin.contacts.newsletter.view')}}" class="menu-link">
                        <div>{{ __('Newsletters') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- In your admin sidebar --}}
        <li class="menu-item {{ request()->routeIs('admin.monitoring.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-pie-chart-alt-2"></i>
                <div>{{ __('Monitoring') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.monitoring.system-health') ? 'active' : '' }}">
                    <a href="{{ route('admin.monitoring.system-health') }}" class="menu-link">
                        <div>{{ __('System Health') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.monitoring.not-found-logs') ? 'active' : '' }}">
                    <a href="{{route('admin.monitoring.not-found-logs')}}" class="menu-link">
                        <div>{{ __('404 Logs') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('log-viewer*') ? 'active' : '' }}">
                    <a href="{{url('log-viewer')}}" class="menu-link" target="_blank">
                        <div>{{ __('Site Logs') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Frontend UI -->
        <li class="menu-item {{ request()->routeIs('admin.sliders.view') ? 'active' : '' }}">
            <a href="{{ route('admin.sliders.view') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-carousel"></i>
                <div>{{ __('Homepage Sliders') }}</div>
            </a>
        </li>

        <!-- Translations -->
        <li class="menu-item {{ (request()->routeIs('admin.translations')) ? 'active ' : '' }}">
            <a href="{{route('admin.translations')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-globe"></i>
                <div>{{ __('Translations') }}</div>
            </a>
        </li>

        <!-- Settings -->
        <li class="menu-item {{ (request()->is('admin/settings')) ? 'active ' : '' }}">
            <a href="{{route('admin.settings.view')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div>{{ __('Global Settings') }}</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="#" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div>{{ __('Support') }}</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div>{{ __('Documentation') }}</div>
            </a>
        </li>
    </ul>
</aside>
