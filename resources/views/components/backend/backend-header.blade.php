<!-- ! Not required for layout-without-menu -->
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
        <i class="icon-base bx bx-menu icon-md"></i>
    </a>
</div>

<div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
    
    <!-- Search -->
    <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
            <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#globalSearchModal">
                <span class="d-inline-block text-body-secondary fw-normal">
                    <div class="aa-Autocomplete" role="combobox">
                        <button type="button" class="aa-DetachedSearchButton" title="Search">
                            <div class="aa-DetachedSearchButtonIcon">
                                <svg class="aa-SubmitIcon" viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M16.041 15.856c-0.034 0.026-0.067 0.055-0.099 0.087s-0.060 0.064-0.087 0.099c-1.258 1.213-2.969 1.958-4.855 1.958-1.933 0-3.682-0.782-4.95-2.050s-2.050-3.017-2.050-4.95 0.782-3.682 2.050-4.95 3.017-2.050 4.95-2.050 3.682 0.782 4.95 2.050 2.050 3.017 2.050 4.95c0 1.886-0.745 3.597-1.959 4.856zM21.707 20.293l-3.675-3.675c1.231-1.54 1.968-3.493 1.968-5.618 0-2.485-1.008-4.736-2.636-6.364s-3.879-2.636-6.364-2.636-4.736 1.008-6.364 2.636-2.636 3.879-2.636 6.364 1.008 4.736 2.636 6.364 3.879 2.636 6.364 2.636c2.125 0 4.078-0.737 5.618-1.968l3.675 3.675c0.391 0.391 1.024 0.391 1.414 0s0.391-1.024 0-1.414z"></path></svg>
                            </div>
                            <div class="aa-DetachedSearchButtonPlaceholder">Mega Search [CTRL + K]</div>
                        </button>
                    </div>
                </span>
            </a>
        </div>
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-md-auto">
        <!-- Language Switcher -->
        <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <i class="icon-base bx bx-globe icon-md"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item {{ app()->getLocale() === 'en' ? 'active' : '' }}" href="{{ route('set-locale', 'en') }}">
                        <span class="fi fi-gb me-2 rounded"></span><span class="align-middle">English</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ app()->getLocale() === 'fr' ? 'active' : '' }}" href="{{ route('set-locale', 'fr') }}">
                        <span class="fi fi-fr me-2 rounded"></span><span class="align-middle">French</span>
                    </a>
                </li>
            </ul>
        </li>
        <!--/ Language Switcher -->

        <!-- Style Switcher -->
        <li class="nav-item dropdown me-2 me-xl-0">
            <a class="nav-link dropdown-toggle hide-arrow" id="nav-theme" href="javascript:void(0);" data-bs-toggle="dropdown" aria-label="Toggle theme (light)">
                <i class="bx-sun icon-base bx icon-md theme-icon-active"></i>
                <span class="d-none ms-2" id="nav-theme-text">Toggle theme</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
                <li>
                    <button type="button" class="dropdown-item align-items-center active" data-bs-theme-value="light" aria-pressed="true">
                        <span><i class="icon-base bx bx-sun icon-md me-3" data-icon="sun"></i>Light</span>
                    </button>
                </li>
                <li>
                    <button type="button" class="dropdown-item align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                        <span><i class="icon-base bx bx-moon icon-md me-3" data-icon="moon"></i>Dark</span>
                    </button>
                </li>
                <li>
                    <button type="button" class="dropdown-item align-items-center" data-bs-theme-value="system" aria-pressed="false">
                        <span><i class="icon-base bx bx-desktop icon-md me-3" data-icon="desktop"></i>System</span>
                    </button>
                </li>
            </ul>
        </li>
        <!-- / Style Switcher-->

        <!-- Quick links  -->
        <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                <i class="icon-base bx bx-grid-alt icon-md"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end p-0">
                <div class="dropdown-menu-header border-bottom">
                    <div class="dropdown-header d-flex align-items-center py-3">
                        <h6 class="mb-0 me-auto">Shortcuts</h6>
                        <a href="{{ route('admin.dashboard') }}" class="dropdown-shortcuts-add py-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Dashboard"><i class="icon-base bx bxs-dashboard text-heading"></i></a>
                    </div>
                </div>
                <div class="dropdown-shortcuts-list scrollable-container ps">
                    <div class="row row-bordered overflow-visible g-0">
                        <div class="dropdown-shortcuts-item col">
                            <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                <i class="icon-base bx bx-building-house icon-26px text-heading"></i>
                            </span>
                            <a href="{{ route('admin.services') }}" class="stretched-link">Services</a>
                            <small>Manage Offerings</small>
                        </div>
                        <div class="dropdown-shortcuts-item col">
                            <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                <i class="icon-base bx bx-envelope icon-26px text-heading"></i>
                            </span>
                            <a href="{{ route('admin.inquiries') }}" class="stretched-link">Inquiries</a>
                            <small>Client Messages</small>
                        </div>
                    </div>
                    <div class="row row-bordered overflow-visible g-0">
                        <div class="dropdown-shortcuts-item col">
                            <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                <i class="icon-base bx bx-group icon-26px text-heading"></i>
                            </span>
                            <a href="{{ route('admin.team') }}" class="stretched-link">Team</a>
                            <small>Manage Members</small>
                        </div>
                        <div class="dropdown-shortcuts-item col">
                            <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                                <i class="icon-base bx bx-book-content icon-26px text-heading"></i>
                            </span>
                            <a href="{{ route('admin.knowledge_hub') }}" class="stretched-link">Knowledge Hub</a>
                            <small>Articles</small>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <!-- Quick links -->

        <!-- Notification -->
        @php $unreadInquiries = \App\Models\Inquiry::where('is_read', false)->get(); @endphp
        <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                <span class="position-relative">
                    <i class="icon-base bx bx-bell icon-md"></i>
                    @if($unreadInquiries->count() > 0)
                        <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
                    @endif
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end p-0">
                <li class="dropdown-menu-header border-bottom">
                    <div class="dropdown-header d-flex align-items-center py-3">
                        <h6 class="mb-0 me-auto">Notification</h6>
                        <div class="d-flex align-items-center h6 mb-0">
                            @if($unreadInquiries->count() > 0)
                                <span class="badge bg-label-primary me-2">{{ $unreadInquiries->count() }} New</span>
                            @endif
                        </div>
                    </div>
                </li>
                <li class="dropdown-notifications-list scrollable-container ps">
                    <ul class="list-group list-group-flush">
                        @forelse($unreadInquiries as $inquiry)
                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <span class="avatar-initial rounded-circle bg-label-danger"><i class="icon-base bx bx-envelope"></i></span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <a href="{{ route('admin.inquiries') }}" class="text-body text-decoration-none">
                                            <h6 class="small mb-0">New Message from {{ $inquiry->name }}</h6>
                                            <small class="mb-1 d-block text-body">{{ Str::limit($inquiry->subject, 30) }}</small>
                                            <small class="text-body-secondary">{{ $inquiry->created_at->diffForHumans() }}</small>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                <div class="d-flex align-items-center justify-content-center py-3">
                                    <h6 class="text-muted mb-0">No new notifications</h6>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </li>
                <li class="border-top">
                    <div class="d-grid p-4">
                        <a class="btn btn-primary btn-sm d-flex" href="{{ route('admin.inquiries') }}">
                            <small class="align-middle">View all messages</small>
                        </a>
                    </div>
                </li>
            </ul>
        </li>
        <!--/ Notification -->
        
        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random" alt="" class="rounded-circle">
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar avatar-online">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random" alt="" class="w-px-40 h-auto rounded-circle">
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                                <small class="text-body-secondary text-capitalize">{{ auth()->user()->roles->first()->name ?? 'User' }}</small>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider my-1"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.profile') }}"> <i class="icon-base bx bx-user icon-md me-3"></i><span>My Profile</span> </a>
                </li>
                <li>
                    <div class="dropdown-divider my-1"></div>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="icon-base bx bx-power-off icon-md me-3 text-danger"></i><span class="text-danger">Log Out</span>
                        </button>
                    </form>
                </li>
            </ul>
        </li>
        <!--/ User -->
    </ul>
</div>
