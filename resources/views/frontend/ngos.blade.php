@extends('layouts.frontend')

@section('title', __('NGOs & Organizations - Havre Bienveillant Consultant Ltd'))

@section('content')

<!-- HERO SECTION -->
<section class="position-relative d-flex align-items-center justify-content-center text-center" style="padding: 120px 0 100px; background: url('https://upload.wikimedia.org/wikipedia/commons/8/83/Kigali2018Cropped.jpg') center/cover no-repeat; margin-top: 76px;">
    <!-- Dark Emerald Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(6, 78, 59, 0.85);"></div>
    
    <div class="container position-relative z-1 text-center animate-up">
        <span class="badge rounded-pill bg-white px-3 py-2 mb-4 shadow-sm" style="color: var(--primary); font-size: 0.85rem; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 700;">{{ __('For Organizations') }}</span>
        
        <h1 class="display-5 fw-bolder text-white mb-4" style="letter-spacing: -0.5px; text-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            {{ __('Supporting Organizations') }} <br class="d-none d-md-block">
            <span style="color: var(--bg-light);">{{ __('That Care for People') }}</span>
        </h1>
        
        <p class="text-white mx-auto mb-5" style="max-width: 650px; font-size: 1.15rem; font-weight: 300; opacity: 0.9; line-height: 1.7;">
            {{ __('We partner with NGOs, businesses, and public institutions to improve staff wellbeing, prevent burnout, and strengthen community programs.') }}
        </p>
        
        <a href="{{ route('contact') }}" class="btn fw-bold rounded-pill px-5 py-3 shadow-sm custom-hover-lift text-primary" style="background-color: var(--bg-light);">
            {{ __('Request a Proposal') }}
        </a>
    </div>
</section>

<!-- SECTION 1 & 2: SERVICES & AUDIENCES -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row gy-5">
            <!-- Our Services -->
            <div class="col-lg-6 animate-up">
                <span class="badge-soft mb-3">{{ __('What We Offer') }}</span>
                <h3 class="display-6 fw-bold mb-4">{{ __('Our Organizational Services') }}</h3>
                <div class="row gy-3">
                    <div class="col-sm-6">
                        <div class="card-premium h-100 p-4 border-0" style="background: var(--bg-light);">
                            <i class="bx bx-check-shield text-primary fs-3 mb-2"></i>
                            <h5 class="fw-bold mb-0">{{ __('Employee Wellbeing Programs') }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card-premium h-100 p-4 border-0" style="background: var(--bg-light);">
                            <i class="bx bx-check-shield text-primary fs-3 mb-2"></i>
                            <h5 class="fw-bold mb-0">{{ __('Mental Health Awareness') }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card-premium h-100 p-4 border-0" style="background: var(--bg-light);">
                            <i class="bx bx-check-shield text-primary fs-3 mb-2"></i>
                            <h5 class="fw-bold mb-0">{{ __('Staff Counseling') }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card-premium h-100 p-4 border-0" style="background: var(--bg-light);">
                            <i class="bx bx-check-shield text-primary fs-3 mb-2"></i>
                            <h5 class="fw-bold mb-0">{{ __('Capacity Building') }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card-premium h-100 p-4 border-0" style="background: var(--bg-light);">
                            <i class="bx bx-check-shield text-primary fs-3 mb-2"></i>
                            <h5 class="fw-bold mb-0">{{ __('Leadership Coaching') }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card-premium h-100 p-4 border-0" style="background: var(--bg-light);">
                            <i class="bx bx-check-shield text-primary fs-3 mb-2"></i>
                            <h5 class="fw-bold mb-0">{{ __('Stress Management') }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card-premium h-100 p-4 border-0" style="background: var(--bg-light);">
                            <i class="bx bx-check-shield text-primary fs-3 mb-2"></i>
                            <h5 class="fw-bold mb-0">{{ __('Burnout Prevention') }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card-premium h-100 p-4 border-0" style="background: var(--bg-light);">
                            <i class="bx bx-check-shield text-primary fs-3 mb-2"></i>
                            <h5 class="fw-bold mb-0">{{ __('Team Building (Wellbeing Focus)') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Who We Serve -->
            <div class="col-lg-5 offset-lg-1 animate-up delay-1">
                <div class="card-premium p-5 h-100" style="background: linear-gradient(to bottom right, var(--primary), var(--primary-dark)); color: white;">
                    <h3 class="display-6 fw-bold text-white mb-4">{{ __('Who We Serve') }}</h3>
                    <ul class="list-unstyled mb-0 fs-5">
                        <li class="d-flex align-items-center mb-4">
                            <i class="bx bx-right-arrow-circle text-accent fs-3 me-3"></i>
                            <span>{{ __('NGOs') }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                            <i class="bx bx-right-arrow-circle text-accent fs-3 me-3"></i>
                            <span>{{ __('Government Institutions') }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                            <i class="bx bx-right-arrow-circle text-accent fs-3 me-3"></i>
                            <span>{{ __('Faith-Based Organizations') }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                            <i class="bx bx-right-arrow-circle text-accent fs-3 me-3"></i>
                            <span>{{ __('Clinics') }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                            <i class="bx bx-right-arrow-circle text-accent fs-3 me-3"></i>
                            <span>{{ __('Healthcare Facilities') }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                            <i class="bx bx-right-arrow-circle text-accent fs-3 me-3"></i>
                            <span>{{ __('Private Companies') }}</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="bx bx-right-arrow-circle text-accent fs-3 me-3"></i>
                            <span>{{ __('Community Organizations') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 3: OUR APPROACH -->
<section class="section-padding bg-light">
    <div class="container text-center animate-up">
        <span class="badge-soft mb-3">{{ __('Methodology') }}</span>
        <h2 class="display-5 fw-bold mb-5">{{ __('Our Approach to Organizational Support') }}</h2>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <p class="fs-5 text-muted mb-5">
                    {{ __('We do not believe in one-size-fits-all solutions. Our process is designed to ensure that every intervention creates meaningful, lasting change for your specific organization.') }}
                </p>
                <div class="row gy-4 text-start">
                    <div class="col-md-3 col-sm-6">
                        <div class="text-center">
                            <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm mb-3" style="width: 80px; height: 80px;">
                                <i class="bx bx-search-alt-2 fs-1 text-primary"></i>
                            </div>
                            <h5 class="fw-bold">{{ __('1. Assess') }}</h5>
                            <p class="text-muted small">{{ __('We conduct a thorough needs assessment to understand your team\'s challenges.') }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="text-center">
                            <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm mb-3" style="width: 80px; height: 80px;">
                                <i class="bx bx-pencil fs-1 text-secondary"></i>
                            </div>
                            <h5 class="fw-bold">{{ __('2. Design') }}</h5>
                            <p class="text-muted small">{{ __('We design customized interventions, programs, or workshops.') }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="text-center">
                            <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm mb-3" style="width: 80px; height: 80px;">
                                <i class="bx bx-run fs-1 text-accent"></i>
                            </div>
                            <h5 class="fw-bold">{{ __('3. Deliver') }}</h5>
                            <p class="text-muted small">{{ __('We deliver engaging training, counseling, or capacity building.') }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="text-center">
                            <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm mb-3" style="width: 80px; height: 80px;">
                                <i class="bx bx-line-chart fs-1 text-primary"></i>
                            </div>
                            <h5 class="fw-bold">{{ __('4. Support') }}</h5>
                            <p class="text-muted small">{{ __('We provide robust follow-up support to ensure long-term wellbeing.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CALL TO ACTION -->
<section class="section-padding text-white text-center position-relative" style="background: linear-gradient(135deg, var(--primary-dark), var(--primary)); overflow: hidden;">
    <div class="position-absolute top-50 start-50 translate-middle" style="width: 1000px; height: 1000px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);"></div>
    
    <div class="container position-relative z-1 animate-up">
        <h2 class="display-5 fw-bold mb-4 text-white">{{ __('Ready to Strengthen Your Organization?') }}</h2>
        <p class="lead mb-5 mx-auto" style="max-width: 700px; color: rgba(255,255,255,0.9);">
            {{ __('Contact us today to discuss how we can tailor our services to meet the unique needs of your team.') }}
        </p>
        <a href="{{ route('contact') }}" class="btn-premium" style="background: white !important; color: var(--primary) !important;">{{ __('Request a Proposal') }}</a>
    </div>
</section>

@endsection
