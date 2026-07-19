@extends('layouts.frontend')

@section('content')

<!-- SECTION 1: FULL-WIDTH HERO (DYNAMIC) -->
@if($sliders->count() > 0)
<section id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" style="margin-top: 76px;">
    <div class="carousel-inner">
        @foreach($sliders as $index => $slider)
        <div class="carousel-item {{ $index === 0 ? 'active' : '' }} position-relative d-flex align-items-center justify-content-center text-center" style="min-height: 90vh; background: url('{{ $slider->image_path }}') center/cover no-repeat;">
            <!-- Dark Emerald Overlay -->
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(6, 78, 59, 0.75);"></div>
            
            <div class="container position-relative z-1 animate-up pt-5">
                <span class="badge rounded-pill bg-white px-4 py-2 mb-4 fw-bold shadow-sm" style="color: var(--primary); letter-spacing: 1px; text-transform: uppercase;">{{ __('Welcome to HBC Ltd') }}</span>
                
                <h1 class="display-4 fw-bolder text-white mb-3" style="line-height: 1.2; text-shadow: 0 4px 12px rgba(0,0,0,0.2);">
                    {!! $slider->title !!}
                </h1>
                
                <p class="fs-5 text-white mb-4 mx-auto" style="max-width: 700px; font-weight: 300; opacity: 0.95;">
                    {{ $slider->subtitle }}
                </p>
                
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('book') }}" class="btn fw-bold rounded-pill shadow-lg px-4 py-2" style="background-color: var(--bg-light); color: var(--primary); transition: all 0.3s ease;">
                        {{ __('Book a Consultation') }}
                    </a>
                    <a href="{{ route('services') }}" class="btn fw-bold rounded-pill border-2 border-white text-white px-4 py-2 custom-hover-white" style="transition: all 0.3s ease;">
                        {{ __('Explore Our Services') }}
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    @if($sliders->count() > 1)
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    @endif

    <!-- Scroll Down Indicator -->
    <div class="position-absolute bottom-0 start-50 translate-middle-x mb-4 z-1 animate-pulse">
        <a href="#about-us" class="text-white opacity-75 text-decoration-none">
            <i class="bx bx-chevron-down bx-fade-down" style="font-size: 2.5rem;"></i>
        </a>
    </div>
</section>
@endif

<!-- SECTION 2: ABOUT US -->
<section id="about-us" class="section-padding bg-white" style="position: relative;">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6 position-relative animate-up delay-1">
                <div class="position-relative p-2 p-md-4">
                    <!-- Soft organic background shape -->
                    <div class="position-absolute top-0 start-0 w-100 h-100 rounded-circle opacity-50 blur-3xl" style="background: radial-gradient(circle, var(--bg-light) 0%, transparent 70%); z-index: 0; filter: blur(40px);"></div>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/58/Rwanda_schoolchildren.jpg" alt="Authentic Learning" class="img-fluid rounded-4 shadow-lg position-relative z-1" style="border: 8px solid white;">
                    
                    <!-- Floating badge -->
                    <div class="position-absolute bottom-0 end-0 bg-white p-3 rounded-4 shadow-lg d-none d-md-flex align-items-center gap-3 z-2" style="margin-bottom: -20px; margin-right: -20px;">
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background-color: var(--bg-light);">
                            <i class="bx bx-heart bx-md" style="color: var(--primary);"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold" style="color: var(--primary);">{{ __('Compassion') }}</h5>
                            <span class="text-muted small">{{ __('At the heart of all we do') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-5 offset-lg-1 animate-up">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width: 40px; height: 3px; background-color: var(--accent);"></div>
                    <span class="text-uppercase fw-bold" style="color: var(--primary); letter-spacing: 1px;">{{ __('Who We Are') }}</span>
                </div>
                <h2 class="display-5 fw-bold mb-4" style="color: var(--text-main);">{{ __('Genuine Care for Genuine Healing') }}</h2>
                
                <p class="fs-5 mb-4" style="color: var(--text-muted); line-height: 1.8;">
                    {{ __('Havre Bienveillant Consultant Ltd is a mental health and psychosocial consulting firm based in Kigali, Rwanda. We provide compassionate, professional, and evidence-informed services that support emotional wellbeing, strengthen resilience, and promote healthy environments.') }}
                </p>
                <div class="d-flex flex-column gap-3 mb-5">
                    <div class="d-flex align-items-start gap-3">
                        <i class="bx bxs-check-circle mt-1 fs-4" style="color: var(--primary);"></i>
                        <span class="text-muted fs-6">{{ __('Helping individuals and families overcome challenges.') }}</span>
                    </div>
                    <div class="d-flex align-items-start gap-3">
                        <i class="bx bxs-check-circle mt-1 fs-4" style="color: var(--primary);"></i>
                        <span class="text-muted fs-6">{{ __('Supporting schools and clinics in building resilient communities.') }}</span>
                    </div>
                    <div class="d-flex align-items-start gap-3">
                        <i class="bx bxs-check-circle mt-1 fs-4" style="color: var(--primary);"></i>
                        <span class="text-muted fs-6">{{ __('Empowering NGOs and institutions through expert training.') }}</span>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="btn fw-bold px-4 py-3 rounded-pill shadow-sm text-white" style="background-color: var(--primary);">
                    {{ __('Discover Our Story') }} <i class="bx bx-right-arrow-alt ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 3: DYNAMIC SERVICES -->
<section class="section-padding" style="background-color: var(--bg-light);">
    <div class="container">
        <div class="text-center mb-5 animate-up">
            <span class="badge bg-white px-3 py-2 mb-3 fw-bold shadow-sm" style="color: var(--primary); border-radius: 50px;">{{ __('What We Do') }}</span>
            <h2 class="display-5 fw-bold mb-4" style="color: var(--primary);">{{ __('Our Expertise') }}</h2>
            <p class="text-muted mx-auto fs-5" style="max-width: 600px;">{{ __('Comprehensive psychosocial and psychological interventions tailored to your unique needs.') }}</p>
        </div>

        <div class="row gy-4">
            @forelse($services as $index => $service)
                <div class="col-lg-4 col-md-6 animate-up delay-{{ $index % 3 }}">
                    <div class="card h-100 border-0 rounded-4 overflow-hidden custom-hover-card" style="background: white; transition: all 0.4s ease; box-shadow: 0 10px 30px rgba(6, 78, 59, 0.05);">
                        <div class="card-body p-5">
                            <div class="mb-4 d-inline-block">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background-color: rgba(6, 78, 59, 0.05);">
                                    <i class="bx {{ str_replace('bx ', '', $service->icon ?? 'bx-heart') }}" style="font-size: 2rem; color: var(--primary);"></i>
                                </div>
                            </div>
                            <h4 class="fw-bold mb-3" style="color: var(--primary);">{{ $service->title }}</h4>
                            <p class="text-muted mb-4" style="line-height: 1.6;">
                                {{ Str::limit($service->description, 120) }}
                            </p>
                            <a href="{{ route('services') }}#service-{{ $service->id }}" class="text-decoration-none fw-bold d-inline-flex align-items-center" style="color: var(--secondary);">
                                {{ __('Learn more') }} <i class="bx bx-right-arrow-alt ms-1 fs-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 bg-white rounded-4 shadow-sm mx-auto" style="max-width: 600px;">
                        <i class="bx bx-briefcase bx-lg text-muted mb-3"></i>
                        <h4 class="text-muted">{{ __('No services available yet.') }}</h4>
                        <p class="text-muted">{{ __('Administrators can add services from the backend CMS to see them displayed here dynamically.') }}</p>
                    </div>
                </div>
            @endforelse
        </div>
        
        @if($services->isNotEmpty())
        <div class="text-center mt-5 pt-3 animate-up">
            <a href="{{ route('services') }}" class="btn fw-bold px-5 py-3 rounded-pill shadow-sm" style="border: 2px solid var(--primary); color: var(--primary); background: transparent;">
                {{ __('View All Services') }}
            </a>
        </div>
        @endif
    </div>
</section>

<!-- SECTION 4: WHY CHOOSE US (Glassmorphism inspired) -->
<section class="section-padding position-relative" style="background: linear-gradient(to bottom, #ffffff, var(--bg-light)); overflow: hidden;">
    <div class="container position-relative z-1">
        <div class="text-center mb-5 animate-up">
            <h2 class="display-5 fw-bold" style="color: var(--primary);">{{ __('The HBC Difference') }}</h2>
            <p class="text-muted fs-5">{{ __('Why organizations and individuals trust us with their wellbeing.') }}</p>
        </div>
        
        <div class="row gy-4 text-center justify-content-center">
            <div class="col-lg-3 col-md-6 animate-up">
                <div class="p-4 rounded-4 h-100 bg-white shadow-sm border border-light custom-hover-lift">
                    <div class="rounded-circle d-inline-flex p-3 mb-4" style="background-color: var(--bg-light);">
                        <i class="bx bx-certification bx-lg" style="color: var(--primary);"></i>
                    </div>
                    <h5 class="fw-bold text-dark">{{ __('Expertise') }}</h5>
                    <p class="text-muted small mb-0">{{ __('Services delivered by seasoned professionals in psychology and education.') }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 animate-up delay-1">
                <div class="p-4 rounded-4 h-100 bg-white shadow-sm border border-light custom-hover-lift">
                    <div class="rounded-circle d-inline-flex p-3 mb-4" style="background-color: var(--bg-light);">
                        <i class="bx bx-shield-quarter bx-lg" style="color: var(--secondary);"></i>
                    </div>
                    <h5 class="fw-bold text-dark">{{ __('Confidentiality') }}</h5>
                    <p class="text-muted small mb-0">{{ __('We maintain strict adherence to privacy and professional ethics at all times.') }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 animate-up delay-2">
                <div class="p-4 rounded-4 h-100 bg-white shadow-sm border border-light custom-hover-lift">
                    <div class="rounded-circle d-inline-flex p-3 mb-4" style="background-color: var(--bg-light);">
                        <i class="bx bx-leaf bx-lg" style="color: var(--accent);"></i>
                    </div>
                    <h5 class="fw-bold text-dark">{{ __('Tailored Care') }}</h5>
                    <p class="text-muted small mb-0">{{ __('Every client receives a highly personalized approach suited to their context.') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 5: AUDIENCES (Interactive tags) -->
<section class="section-padding bg-white">
    <div class="container text-center">
        <h2 class="display-5 fw-bold mb-3 animate-up" style="color: var(--primary);">{{ __('Who We Support') }}</h2>
        <p class="text-muted mx-auto fs-5 mb-5 animate-up" style="max-width: 600px;">{{ __('We partner with diverse groups to foster mental wellness across all levels of society.') }}</p>
        
        <div class="d-flex flex-wrap justify-content-center gap-3 animate-up delay-1">
            @php
                $audiences = [
                    'Individuals', 'Children & Adolescents', 'Parents & Families', 
                    'Schools', 'Teachers', 'NGOs', 'Clinics', 
                    'Public Institutions', 'Private Organizations'
                ];
            @endphp
            @foreach($audiences as $audience)
                <div class="audience-pill px-4 py-3 rounded-pill bg-white shadow-sm border border-light" style="transition: all 0.3s ease; cursor: default;">
                    <span class="text-dark fw-medium fs-6"><i class="bx bx-check me-2" style="color: var(--secondary);"></i> {{ __($audience) }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- SECTION 6: CALL TO ACTION -->
<section class="section-padding text-center position-relative" style="background: var(--primary); overflow: hidden;">
    <!-- Abstract Shapes -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at top right, rgba(248, 231, 201, 0.1) 0%, transparent 60%);"></div>
    
    <div class="container position-relative z-1 animate-up py-4">
        <h2 class="display-4 fw-bold mb-4" style="color: var(--bg-light);">{{ __('Ready to Start Your Journey?') }}</h2>
        <p class="lead mb-5 mx-auto" style="max-width: 700px; color: rgba(248, 231, 201, 0.8);">
            {{ __('Whether you need personal counseling, staff training, or organizational consulting, our experts are here to guide you.') }}
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <a href="{{ route('book') }}" class="btn btn-lg fw-bold rounded-pill shadow-lg px-5 py-3" style="background-color: var(--bg-light); color: var(--primary);">
                {{ __('Schedule a Consultation') }}
            </a>
            <a href="{{ route('contact') }}" class="btn btn-lg fw-bold rounded-pill px-5 py-3 text-white custom-hover-white" style="border: 2px solid rgba(248, 231, 201, 0.5); transition: all 0.3s ease;">
                {{ __('Get in Touch') }}
            </a>
        </div>
    </div>
</section>

<style>
    .custom-hover-white:hover {
        background-color: white !important;
        color: var(--primary) !important;
        border-color: white !important;
    }
    .custom-hover-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(6, 78, 59, 0.1) !important;
    }
    .custom-hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08) !important;
        border-color: transparent !important;
    }
    .audience-pill:hover {
        background-color: var(--bg-light) !important;
        transform: scale(1.05);
    }
</style>
@endsection
