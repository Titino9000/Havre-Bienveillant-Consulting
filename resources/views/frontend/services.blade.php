@extends('layouts.frontend')

@section('title', __('Services - Havre Bienveillant Consultant Ltd'))

@section('content')

<!-- HERO SECTION -->
<section class="position-relative d-flex align-items-center justify-content-center text-center" style="padding: 120px 0 100px; background: url('https://upload.wikimedia.org/wikipedia/commons/c/c5/Rwanda_tea.jpg') center/cover no-repeat; margin-top: 76px;">
    <!-- Dark Emerald Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(6, 78, 59, 0.85);"></div>
    
    <div class="container position-relative z-1 text-center animate-up">
        <span class="badge rounded-pill bg-white px-3 py-2 mb-4 shadow-sm" style="color: var(--primary); font-size: 0.85rem; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 700;">{{ __('Our Expertise') }}</span>
        
        <h1 class="display-5 fw-bolder text-white mb-4" style="letter-spacing: -0.5px; text-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            {{ __('Professional Mental Health') }} <br class="d-none d-md-block">
            <span style="color: var(--bg-light);">{{ __('& Psychosocial Services') }}</span>
        </h1>
        
        <p class="text-white mx-auto mb-0" style="max-width: 650px; font-size: 1.15rem; font-weight: 300; opacity: 0.9; line-height: 1.7;">
            {{ __('Compassionate, evidence-informed solutions for individuals, schools, and organizations.') }}
        </p>
    </div>
</section>

<!-- SERVICE QUICK JUMP (Horizontal Slider) -->
<section class="bg-white shadow-sm position-sticky" style="top: 76px; z-index: 999; border-bottom: 1px solid rgba(0,0,0,0.05);">
    <div class="container">
        <!-- Horizontal scroll wrapper -->
        <div class="d-flex align-items-center py-3 overflow-auto" style="scrollbar-width: none; -ms-overflow-style: none;">
            <!-- Hide scrollbar hack for webkit inline -->
            <style> .overflow-auto::-webkit-scrollbar { display: none; } </style>
            
            <div class="d-flex gap-3 flex-nowrap" style="width: max-content;">
                @foreach($services as $service)
                    <a href="#service-{{ $service->id }}" class="btn bg-light border px-4 py-2 custom-hover-lift text-dark fw-medium rounded-pill text-decoration-none d-flex align-items-center" style="transition: all 0.3s ease; white-space: nowrap;">
                        <i class="bx {{ $service->icon ?? 'bx-briefcase' }} text-primary fs-5 me-2"></i> {{ $service->title }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- SECTION 1: OUR APPROACH (Sleek 2-Column Layout) -->
<section class="py-5" style="background: var(--bg-light);">
    <div class="container py-4">
        <div class="row align-items-center gx-lg-5 animate-up">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge rounded-pill bg-white px-4 py-2 mb-3 fw-bold shadow-sm" style="color: var(--primary); letter-spacing: 1px; text-transform: uppercase;">{{ __('Our Approach') }}</span>
                <h2 class="display-6 fw-bold mb-4 text-dark" style="letter-spacing: -0.5px;">{{ __('Every Person. Every School. Every Organization Has Unique Needs.') }}</h2>
                <div class="d-flex align-items-center mt-4">
                    <a href="{{ route('book') }}" class="btn fw-bold rounded-pill shadow-sm px-5 py-3 custom-hover-lift text-white" style="background-color: var(--primary);">
                        {{ __('Book a Consultation') }}
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm" style="border-left: 4px solid var(--accent);">
                    <p class="fs-5 text-dark mb-4" style="line-height: 1.8; font-weight: 300;">
                        {{ __('At Havre Bienveillant Consultant Ltd, we understand that no two situations are alike. That\'s why we take time to understand each client\'s goals, challenges, and context before recommending the most appropriate support.') }}
                    </p>
                    <p class="fs-5 text-primary fw-medium mb-0" style="line-height: 1.8;">
                        {{ __('Our services combine professional knowledge, ethical practice, and practical experience to provide solutions that are culturally relevant, compassionate, and focused on long-term wellbeing.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- DYNAMIC SERVICES SECTIONS (Google Material Alignment) -->
@foreach($services as $index => $service)
    @php
        $bgClass = $index % 2 == 0 ? 'bg-white' : 'bg-light';
    @endphp
    
    <section class="py-5 {{ $bgClass }} border-bottom" id="service-{{ $service->id }}">
        <div class="container py-5">
            <div class="row gx-lg-5">
                <!-- Text Content Column -->
                <div class="col-lg-7 animate-up">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bx {{ $service->icon ?? 'bx-briefcase' }} text-primary fs-3 me-3"></i>
                        <span class="text-uppercase fw-bold text-muted" style="letter-spacing: 1px; font-size: 0.85rem;">
                            {{ __('Service') }} {{ sprintf('%02d', $index + 1) }}
                        </span>
                    </div>
                    
                    <h2 class="display-5 fw-bold mb-3 text-dark" style="letter-spacing: -1px;">{{ $service->title }}</h2>
                    
                    @if($service->subtitle)
                        <h5 class="text-muted fw-normal mb-4" style="font-family: 'Inter', sans-serif;">{{ $service->subtitle }}</h5>
                    @endif
                    
                    <p class="fs-5 text-dark mb-5" style="line-height: 1.8; font-weight: 300;">{{ $service->description }}</p>
                    
                    <!-- Feature Lists using Google Material Chips/Pills -->
                    <div class="row gy-4 mb-5">
                        @if($service->audiences)
                            <div class="col-md-6">
                                <h6 class="fw-bold text-dark mb-3 text-uppercase" style="font-size: 0.8rem; letter-spacing: 0.5px;">{{ __('Who We Support') }}</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach(explode("\n", trim($service->audiences)) as $item)
                                        @if(trim($item))
                                            <span class="badge bg-white text-dark border fw-medium px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.9rem;">
                                                <i class="bx bx-check text-primary me-1"></i> {{ trim($item) }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        @if($service->features)
                            <div class="col-md-6">
                                <h6 class="fw-bold text-dark mb-3 text-uppercase" style="font-size: 0.8rem; letter-spacing: 0.5px;">{{ __('Areas of Support') }}</h6>
                                <ul class="list-unstyled mb-0">
                                    @foreach(explode("\n", trim($service->features)) as $item)
                                        @if(trim($item))
                                            <li class="d-flex align-items-start mb-2 text-muted">
                                                <i class="bx bx-check-circle text-primary fs-5 mt-1 me-2"></i> 
                                                <span>{{ trim($item) }}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    
                    @if($service->benefits)
                        <div class="p-4 rounded-3 mb-5" style="background-color: rgba(6, 78, 59, 0.03); border: 1px solid rgba(6, 78, 59, 0.1);">
                            <h6 class="fw-bold text-dark mb-3 text-uppercase" style="font-size: 0.8rem; letter-spacing: 0.5px;">{{ __('What to Expect') }}</h6>
                            <div class="row">
                                @foreach(explode("\n", trim($service->benefits)) as $item)
                                    @if(trim($item))
                                        <div class="col-md-6 d-flex align-items-start mb-2 text-muted">
                                            <i class="bx bx-chevron-right text-primary mt-1 me-1"></i> 
                                            <span style="font-size: 0.95rem;">{{ trim($item) }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <div class="mt-2">
                        <a href="{{ route('book') }}" class="btn fw-bold rounded-pill px-5 py-3 shadow-sm custom-hover-lift text-white" style="background-color: var(--primary);">
                            {{ $service->cta_text ?? __('Book a Session') }}
                        </a>
                    </div>
                </div>
                
                <!-- Image Column (Sticky for Google-like reading experience) -->
                <div class="col-lg-5 d-none d-lg-block animate-up delay-1">
                    <div class="position-sticky" style="top: 100px;">
                        @php
                            $images = [
                                'https://upload.wikimedia.org/wikipedia/commons/c/c6/Hills_of_Nyamagabe_in_Rwanda.jpg',
                                'https://upload.wikimedia.org/wikipedia/commons/5/58/Rwanda_schoolchildren.jpg',
                                'https://upload.wikimedia.org/wikipedia/commons/c/c5/Rwanda_tea.jpg',
                                'https://upload.wikimedia.org/wikipedia/commons/8/83/Kigali2018Cropped.jpg',
                                'https://upload.wikimedia.org/wikipedia/commons/b/b7/Holly_Rwanda_Landscape_Image_hills_of_Rwanda.jpg',
                                'https://upload.wikimedia.org/wikipedia/commons/2/2c/Kigali%2C_the_cleanest_city_in_Africa.jpg'
                            ];
                            $imgSrc = $images[$index % count($images)];
                        @endphp
                        
                        <img src="{{ $imgSrc }}" alt="{{ $service->title }}" class="img-fluid rounded-4 shadow-sm w-100" style="object-fit: cover; height: 500px; border: 1px solid rgba(0,0,0,0.05);">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endforeach

<!-- SECTION 8: HOW WE WORK -->
<section class="section-padding" style="background: linear-gradient(to bottom, #ffffff 0%, var(--bg-light) 100%);">
    <div class="container text-center">
        <span class="badge rounded-pill bg-white px-4 py-2 mb-4 fw-bold shadow-sm" style="color: var(--primary); letter-spacing: 1px; text-transform: uppercase;">{{ __('Our Process') }}</span>
        <h2 class="display-5 fw-bold mb-5 text-dark">{{ __('How We Work') }}</h2>
        
        <div class="row justify-content-center position-relative mt-5 pt-3 animate-up delay-1">
            <!-- Connecting Line -->
            <div class="d-none d-lg-block position-absolute top-0 start-50 translate-middle-x" style="width: 75%; height: 4px; background: rgba(6, 78, 59, 0.1); z-index: 0; margin-top: 40px; border-radius: 4px;"></div>
            
            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0 position-relative z-1">
                <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-lg mb-4 custom-hover-lift" style="width: 80px; height: 80px; border: 4px solid var(--primary); transition: all 0.3s ease;">
                    <h3 class="text-primary mb-0 fw-bold">1</h3>
                </div>
                <h5 class="fw-bold text-dark">{{ __('Initial Consultation') }}</h5>
                <p class="text-muted small px-3" style="line-height: 1.6;">{{ __('We listen to your needs and discuss how we can help.') }}</p>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0 position-relative z-1">
                <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-lg mb-4 custom-hover-lift" style="width: 80px; height: 80px; border: 4px solid var(--secondary); transition: all 0.3s ease;">
                    <h3 class="text-secondary mb-0 fw-bold">2</h3>
                </div>
                <h5 class="fw-bold text-dark">{{ __('Needs Assessment') }}</h5>
                <p class="text-muted small px-3" style="line-height: 1.6;">{{ __('We evaluate your situation and recommend the most appropriate services.') }}</p>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-5 mb-lg-0 position-relative z-1">
                <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-lg mb-4 custom-hover-lift" style="width: 80px; height: 80px; border: 4px solid var(--accent); transition: all 0.3s ease;">
                    <h3 class="text-accent mb-0 fw-bold">3</h3>
                </div>
                <h5 class="fw-bold text-dark">{{ __('Service Delivery') }}</h5>
                <p class="text-muted small px-3" style="line-height: 1.6;">{{ __('We provide counseling, consulting, training, or psychosocial support tailored to your needs.') }}</p>
            </div>
            
            <div class="col-lg-3 col-md-6 position-relative z-1">
                <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-lg mb-4 custom-hover-lift" style="width: 80px; height: 80px; border: 4px solid var(--primary); transition: all 0.3s ease;">
                    <h3 class="text-primary mb-0 fw-bold">4</h3>
                </div>
                <h5 class="fw-bold text-dark">{{ __('Follow-Up') }}</h5>
                <p class="text-muted small px-3" style="line-height: 1.6;">{{ __('We review progress and provide ongoing guidance where needed.') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 9: FAQ -->
<section class="section-padding bg-white position-relative">
    <div class="container">
        <div class="row justify-content-center animate-up">
            <div class="col-lg-8 text-center mb-5">
                <span class="badge rounded-pill bg-light px-4 py-2 mb-4 fw-bold shadow-sm" style="color: var(--primary); letter-spacing: 1px; text-transform: uppercase;">{{ __('Questions & Answers') }}</span>
                <h2 class="display-5 fw-bold text-dark">{{ __('Frequently Asked Questions') }}</h2>
            </div>
        </div>
        
        <div class="row justify-content-center animate-up delay-1">
            <div class="col-lg-8">
                <div class="accordion accordion-flush" id="faqAccordion">
                    
                    <div class="accordion-item border-0 mb-3 bg-light rounded-4 shadow-sm overflow-hidden custom-hover-lift">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-transparent fw-bold text-dark collapsed px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                <i class="bx bx-question-mark text-primary me-2"></i> {{ __('Do I need an appointment before visiting?') }}
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted px-4 pb-4 pt-0" style="line-height: 1.8;">
                                {{ __('Yes. We recommend booking an appointment to ensure we can provide you with dedicated time and the appropriate professional support.') }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 mb-3 bg-light rounded-4 shadow-sm overflow-hidden custom-hover-lift">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-transparent fw-bold text-dark collapsed px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                <i class="bx bx-question-mark text-primary me-2"></i> {{ __('Do you provide services outside Kigali?') }}
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted px-4 pb-4 pt-0" style="line-height: 1.8;">
                                {{ __('Yes. Depending on the nature of the service, we can provide support in other parts of Rwanda and, where appropriate, online.') }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 mb-3 bg-light rounded-4 shadow-sm overflow-hidden custom-hover-lift">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-transparent fw-bold text-dark collapsed px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                <i class="bx bx-question-mark text-primary me-2"></i> {{ __('Are your counseling sessions confidential?') }}
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted px-4 pb-4 pt-0" style="line-height: 1.8;">
                                {{ __('Yes. Confidentiality is a fundamental principle of our practice, except where disclosure is required by law or necessary to protect someone\'s safety.') }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item border-0 bg-light rounded-4 shadow-sm overflow-hidden custom-hover-lift">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-transparent fw-bold text-dark collapsed px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                <i class="bx bx-question-mark text-primary me-2"></i> {{ __('Can schools and organizations request customized training?') }}
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted px-4 pb-4 pt-0" style="line-height: 1.8;">
                                {{ __('Absolutely. We tailor our training programs to meet the specific needs and objectives of each institution.') }}
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 10: CALL TO ACTION -->
<section class="section-padding text-center position-relative" style="background: var(--primary); overflow: hidden;">
    <!-- Abstract Shapes -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at top right, rgba(248, 231, 201, 0.1) 0%, transparent 60%);"></div>
    
    <div class="container position-relative z-1 animate-up py-4">
        <h2 class="display-4 fw-bold mb-4" style="color: var(--bg-light);">{{ __('Ready to Invest in Wellbeing?') }}</h2>
        <p class="lead mb-5 mx-auto" style="max-width: 700px; color: rgba(248, 231, 201, 0.8);">
            {{ __('Whether you\'re seeking support for yourself, your family, your school, or your organization, we\'re here to help.') }}
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <a href="{{ route('book') }}" class="btn fw-bold rounded-pill shadow-lg px-5 py-3 custom-hover-lift" style="background-color: var(--bg-light); color: var(--primary);">
                {{ __('Book a Consultation') }}
            </a>
            <a href="{{ route('contact') }}" class="btn fw-bold rounded-pill px-5 py-3 text-white custom-hover-white" style="border: 2px solid rgba(248, 231, 201, 0.5); transition: all 0.3s ease;">
                {{ __('Contact Our Team') }}
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
    .custom-hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }
    .accordion-button:not(.collapsed) {
        color: var(--primary);
        background-color: transparent;
        box-shadow: inset 0 -1px 0 rgba(0,0,0,.125);
    }
</style>

@endsection
