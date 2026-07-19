@extends('layouts.frontend')

@section('title', __('Schools - Havre Bienveillant Consultant Ltd'))

@section('content')

<!-- HERO SECTION -->
<section class="position-relative d-flex align-items-center justify-content-center text-center" style="padding: 120px 0 100px; background: url('https://upload.wikimedia.org/wikipedia/commons/5/58/Rwanda_schoolchildren.jpg') center/cover no-repeat; margin-top: 76px;">
    <!-- Dark Emerald Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(6, 78, 59, 0.85);"></div>
    
    <div class="container position-relative z-1 text-center animate-up">
        <span class="badge rounded-pill bg-white px-3 py-2 mb-4 shadow-sm" style="color: var(--primary); font-size: 0.85rem; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 700;">{{ __('For Schools') }}</span>
        
        <h1 class="display-5 fw-bolder text-white mb-4" style="letter-spacing: -0.5px; text-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            {{ __('Helping Schools Build Safe, Healthy,') }} <br class="d-none d-md-block">
            <span style="color: var(--bg-light);">{{ __('& Supportive Learning Environments') }}</span>
        </h1>
        
        <p class="text-white mx-auto mb-5" style="max-width: 650px; font-size: 1.15rem; font-weight: 300; opacity: 0.9; line-height: 1.7;">
            {{ __('We partner with schools to strengthen student wellbeing, support teachers, engage families, and promote positive school cultures where every learner can thrive.') }}
        </p>
        
        <a href="{{ route('book') }}" class="btn fw-bold rounded-pill px-5 py-3 shadow-sm custom-hover-lift text-primary" style="background-color: var(--bg-light);">
            {{ __('Request a School Consultation') }}
        </a>
    </div>
</section>

<!-- SECTION 1: WHY MENTAL HEALTH MATTERS -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center gy-5 gx-lg-5">
            <div class="col-lg-6 animate-up">
                <span class="badge rounded-pill bg-light px-3 py-2 mb-3 shadow-sm" style="color: var(--primary); font-size: 0.85rem; letter-spacing: 1px; text-transform: uppercase; font-weight: 700;">{{ __('The Foundation') }}</span>
                <h2 class="display-6 fw-bold mb-4 text-dark" style="letter-spacing: -0.5px;">{{ __('Why Mental Health Matters in Schools') }}</h2>
                <p class="fs-5 text-dark mb-4" style="line-height: 1.8; font-weight: 300;">
                    {{ __('A student\'s emotional wellbeing is directly linked to their ability to learn, behave positively, build healthy relationships, and attend school regularly. When mental health is prioritized, academic performance naturally improves.') }}
                </p>
                <div class="bg-light p-4 rounded-4 shadow-sm" style="border-left: 4px solid var(--accent);">
                    <p class="mb-0 fs-5 text-dark fw-medium" style="line-height: 1.6;">
                        {{ __('Supporting mental health doesn\'t just benefit students - it creates a stronger, more resilient environment for teachers, staff, and the wider school community.') }}
                    </p>
                </div>
            </div>
            <div class="col-lg-6 animate-up delay-1">
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c6/Hills_of_Nyamagabe_in_Rwanda.jpg" alt="Rwandan Hills" class="img-fluid rounded-4 shadow-sm w-100" style="object-fit: cover; height: 450px;">
            </div>
        </div>
    </div>
</section>

<!-- SECTION 2: HOW WE SUPPORT SCHOOLS -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5 animate-up">
            <span class="badge-soft mb-3">{{ __('Our Services') }}</span>
            <h2 class="display-5 fw-bold">{{ __('How We Support Schools') }}</h2>
        </div>
        
        <div class="row gy-4">
            <!-- Card 1 -->
            <div class="col-lg-4 col-md-6 animate-up">
                <div class="card-premium h-100">
                    <div class="mb-4">
                        <span class="avatar-initial rounded bg-label-primary p-3"><i class="bx bx-user bx-md text-primary"></i></span>
                    </div>
                    <h4 class="fw-bold">{{ __('Student Counseling') }}</h4>
                    <p class="text-muted mb-0">{{ __('Confidential support for students experiencing emotional, behavioral, or social challenges.') }}</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-lg-4 col-md-6 animate-up delay-1">
                <div class="card-premium h-100">
                    <div class="mb-4">
                        <span class="avatar-initial rounded bg-label-secondary p-3"><i class="bx bx-heart bx-md text-secondary"></i></span>
                    </div>
                    <h4 class="fw-bold">{{ __('Teacher Wellbeing') }}</h4>
                    <p class="text-muted mb-0">{{ __('Helping educators manage stress, prevent burnout, and build resilience.') }}</p>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-lg-4 col-md-6 animate-up delay-2">
                <div class="card-premium h-100">
                    <div class="mb-4">
                        <span class="avatar-initial rounded bg-label-accent p-3"><i class="bx bx-book-reader bx-md text-accent"></i></span>
                    </div>
                    <h4 class="fw-bold">{{ __('Positive Education') }}</h4>
                    <p class="text-muted mb-0">{{ __('Supporting schools in implementing positive discipline and socio-emotional learning approaches.') }}</p>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col-lg-4 col-md-6 animate-up">
                <div class="card-premium h-100">
                    <div class="mb-4">
                        <span class="avatar-initial rounded bg-label-primary p-3"><i class="bx bx-group bx-md text-primary"></i></span>
                    </div>
                    <h4 class="fw-bold">{{ __('Parent Engagement') }}</h4>
                    <p class="text-muted mb-0">{{ __('Workshops that strengthen collaboration between schools and families.') }}</p>
                </div>
            </div>
            <!-- Card 5 -->
            <div class="col-lg-4 col-md-6 animate-up delay-1">
                <div class="card-premium h-100">
                    <div class="mb-4">
                        <span class="avatar-initial rounded bg-label-secondary p-3"><i class="bx bx-bulb bx-md text-secondary"></i></span>
                    </div>
                    <h4 class="fw-bold">{{ __('Mental Health Awareness') }}</h4>
                    <p class="text-muted mb-0">{{ __('School-wide awareness sessions that reduce stigma and promote early support.') }}</p>
                </div>
            </div>
            <!-- Card 6 -->
            <div class="col-lg-4 col-md-6 animate-up delay-2">
                <div class="card-premium h-100">
                    <div class="mb-4">
                        <span class="avatar-initial rounded bg-label-accent p-3"><i class="bx bx-chalkboard bx-md text-accent"></i></span>
                    </div>
                    <h4 class="fw-bold">{{ __('Staff Training') }}</h4>
                    <p class="text-muted mb-0">{{ __('Professional development on classroom wellbeing, communication, child protection awareness, and emotional support.') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 3 & 4: WHO WE WORK WITH & WHY PARTNER -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row gy-5">
            <!-- Who We Work With -->
            <div class="col-lg-6 animate-up">
                <div class="pe-lg-4">
                    <span class="badge-soft mb-3">{{ __('Our Partners') }}</span>
                    <h3 class="display-6 fw-bold mb-4">{{ __('Who We Work With') }}</h3>
                    <div class="d-flex flex-wrap gap-3">
                        <div class="bg-light px-4 py-3 rounded-pill shadow-sm border"><h5 class="mb-0 text-dark fw-medium">{{ __('Nursery Schools') }}</h5></div>
                        <div class="bg-light px-4 py-3 rounded-pill shadow-sm border"><h5 class="mb-0 text-dark fw-medium">{{ __('Primary Schools') }}</h5></div>
                        <div class="bg-light px-4 py-3 rounded-pill shadow-sm border"><h5 class="mb-0 text-dark fw-medium">{{ __('Secondary Schools') }}</h5></div>
                        <div class="bg-light px-4 py-3 rounded-pill shadow-sm border"><h5 class="mb-0 text-dark fw-medium">{{ __('International Schools') }}</h5></div>
                        <div class="bg-light px-4 py-3 rounded-pill shadow-sm border"><h5 class="mb-0 text-dark fw-medium">{{ __('TVET Institutions') }}</h5></div>
                        <div class="bg-light px-4 py-3 rounded-pill shadow-sm border"><h5 class="mb-0 text-dark fw-medium">{{ __('Universities') }} <small class="text-muted fw-normal">(where applicable)</small></h5></div>
                    </div>
                </div>
            </div>
            
            <!-- Why Partner With Us -->
            <div class="col-lg-6 animate-up delay-1">
                <div class="card-premium p-5 h-100" style="background: linear-gradient(to bottom right, #ffffff, var(--bg-light));">
                    <h3 class="display-6 fw-bold mb-4">{{ __('Why Partner With Us') }}</h3>
                    <ul class="list-unstyled mb-0 fs-5">
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-check-circle text-primary fs-3 me-3"></i>
                            <span class="text-dark">{{ __('Professional expertise') }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-check-circle text-primary fs-3 me-3"></i>
                            <span class="text-dark">{{ __('Tailored programs') }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-check-circle text-primary fs-3 me-3"></i>
                            <span class="text-dark">{{ __('Practical and interactive training') }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bx bx-check-circle text-primary fs-3 me-3"></i>
                            <span class="text-dark">{{ __('Child-centered approaches') }}</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="bx bx-check-circle text-primary fs-3 me-3"></i>
                            <span class="text-dark">{{ __('Long-term partnerships') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CALL TO ACTION -->
<section class="section-padding text-white text-center position-relative" style="background: linear-gradient(135deg, var(--primary-dark), var(--primary)); overflow: hidden;">
    <div class="position-absolute top-50 start-50 translate-middle" style="width: 1000px; height: 1000px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);"></div>
    
    <div class="container position-relative z-1 animate-up">
        <h2 class="display-5 fw-bold mb-5 text-white">{{ __('Let\'s Build a Healthier School Community Together') }}</h2>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="{{ route('book') }}" class="btn-premium" style="background: white !important; color: var(--primary) !important;">{{ __('Request a Consultation') }}</a>
            <a href="{{ route('contact') }}" class="btn-outline-white">{{ __('Contact Us') }}</a>
        </div>
    </div>
</section>

@endsection
