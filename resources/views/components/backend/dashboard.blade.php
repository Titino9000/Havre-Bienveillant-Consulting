<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Overview & Metrics -->
        <div class="col-lg-8 col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">{{ __('Overview & Activity') }}</h5>
                        <small class="text-muted">{{ __('Key metrics at a glance') }}</small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mt-4">
                        <div class="col-sm-3 col-6 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-briefcase bx-sm"></i></span>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-muted fw-normal">{{ __('Services') }}</h6>
                                    <h4 class="mb-0">{{ $totalServices }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info"><i class="bx bx-trophy bx-sm"></i></span>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-muted fw-normal">{{ __('Achievements') }}</h6>
                                    <h4 class="mb-0">{{ $totalAchievements }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success"><i class="bx bx-group bx-sm"></i></span>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-muted fw-normal">{{ __('Team') }}</h6>
                                    <h4 class="mb-0">{{ $totalTeamMembers }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-6 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-envelope bx-sm"></i></span>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-muted fw-normal">{{ __('Unread') }}</h6>
                                    <h4 class="mb-0 text-danger">{{ $unreadInquiries }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Future: ApexChart can be placed here -->
                    <div class="bg-light rounded p-4 text-center mt-2 border border-dashed">
                        <i class="bx bx-line-chart text-muted mb-2 fs-2"></i>
                        <p class="text-muted mb-0 small">{{ __('A chart mapping inquiries and engagement will be displayed here.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Generated Leads / Inquiry Stats -->
        <div class="col-lg-4 col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-title mb-auto">
                            <h5 class="mb-0">{{ __('Inquiries Pipeline') }}</h5>
                            <p class="mb-0 text-muted small">{{ __('Status of recent leads') }}</p>
                        </div>
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-message-rounded-dots"></i></span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-bell"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">{{ __('Unread') }}</h6>
                                        <small class="text-muted">{{ __('Requires action') }}</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ $unreadInquiries }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-check-double"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">{{ __('Total Inquiries') }}</h6>
                                        <small class="text-muted">{{ __('All time') }}</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ \App\Models\Inquiry::count() }}</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Inquiries -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">{{ __('Recent Inquiries') }}</h5>
                    <a href="{{ route('admin.inquiries') }}" class="btn btn-sm btn-outline-primary">{{ __('View All') }}</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless border-top mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentInquiries as $inquiry)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3">
                                            <span class="avatar-initial rounded-circle bg-label-secondary">{{ substr($inquiry->name, 0, 1) }}</span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold text-heading">{{ $inquiry->name }}</span>
                                            <small class="text-muted">{{ Str::limit($inquiry->subject, 20) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($inquiry->is_read)
                                        <span class="badge bg-label-success">{{ __('Read') }}</span>
                                    @else
                                        <span class="badge bg-label-danger">{{ __('Unread') }}</span>
                                    @endif
                                </td>
                                <td><small class="text-muted">{{ $inquiry->created_at->diffForHumans() }}</small></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">{{ __('No recent inquiries.') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Team Members List -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">{{ __('Team Members') }}</h5>
                    <a href="{{ route('admin.team') }}" class="btn btn-sm btn-outline-primary">{{ __('View All') }}</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless border-top mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('Member') }}</th>
                                <th>{{ __('Position') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teamMembersList as $member)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3">
                                            @if($member->image)
                                                <img src="{{ Storage::url($member->image) }}" alt="Avatar" class="rounded-circle">
                                            @else
                                                <span class="avatar-initial rounded-circle bg-label-primary">{{ substr($member->name, 0, 1) }}</span>
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold text-heading">{{ $member->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="text-muted">{{ $member->position }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted py-3">{{ __('No team members added.') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
