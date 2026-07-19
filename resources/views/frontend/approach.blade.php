@extends('layouts.frontend')

@section('title', __('Our Approach - Havre Bienveillant Consultant Ltd'))

@section('content')

<!-- HERO SECTION -->
<section class="position-relative d-flex align-items-center justify-content-center text-center" style="padding: 120px 0 100px; background: url('https://upload.wikimedia.org/wikipedia/commons/b/b7/Holly_Rwanda_Landscape_Image_hills_of_Rwanda.jpg') center/cover no-repeat; margin-top: 76px;">
    <!-- Dark Emerald Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(6, 78, 59, 0.85);"></div>
    
    <div class="container position-relative z-1 text-center animate-up">
        <span class="badge rounded-pill bg-white px-3 py-2 mb-4 shadow-sm" style="color: var(--primary); font-size: 0.85rem; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 700;">{{ __('Our Methodology') }}</span>
        
        <h1 class="display-5 fw-bolder text-white mb-4" style="letter-spacing: -0.5px; text-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            {{ __('How We Work') }}
        </h1>
        
        <p class="text-white mx-auto mb-0" style="max-width: 650px; font-size: 1.15rem; font-weight: 300; opacity: 0.9; line-height: 1.7;">
            {{ __('We believe that how we deliver support is just as important as what we deliver. Our approach is grounded in respect, science, and a deep commitment to positive outcomes.') }}
        </p>
    </div>
</section>

<!-- CORE PHILOSOPHY -->
<section class="py-5 bg-white">
    <div class="container py-4">
        
        <div class="row gy-5 gx-lg-5">
            
            <div class="col-lg-4 animate-up">
                <div class="position-sticky" style="top: 100px;">
                    <span class="badge rounded-pill bg-light px-3 py-2 mb-3 shadow-sm border" style="color: var(--primary); font-size: 0.85rem; letter-spacing: 1px; text-transform: uppercase; font-weight: 700;">{{ __('Guiding Principles') }}</span>
                    <h2 class="display-6 fw-bold mb-4 text-dark" style="letter-spacing: -0.5px;">{{ __('Our Commitment to Excellence') }}</h2>
                    <p class="fs-5 text-dark mb-5" style="line-height: 1.8; font-weight: 300;">
                        {{ __('At Havre Bienveillant Consultant Ltd, we adhere to a strict set of principles that ensure every client receives the highest standard of care and professional consulting.') }}
                    </p>
                    <a href="{{ route('book') }}" class="btn fw-bold rounded-pill shadow-sm px-5 py-3 custom-hover-lift text-white" style="background-color: var(--primary);">
                        {{ __('Work With Us') }}
                    </a>
                </div>
            </div>
            
            <div class="col-lg-7 offset-lg-1">
                
                <!-- Principle 1 -->
                <div class="d-flex mb-5 animate-up">
                    <div class="flex-shrink-0 me-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm border" style="width: 60px; height: 60px; background-color: rgba(6, 78, 59, 0.05);">
                            <i class="bx bx-bulb fs-2 text-primary"></i>
                        </div>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-3 text-dark">{{ __('Our Philosophy') }}</h4>
                        <p class="text-muted fs-5 mb-0" style="line-height: 1.7;">{{ __('We believe that mental health and wellbeing are fundamental human rights and the foundation for all personal, academic, and professional success.') }}</p>
                    </div>
                </div>
                
                <!-- Principle 2 -->
                <div class="d-flex mb-5 animate-up delay-1">
                    <div class="flex-shrink-0 me-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm border" style="width: 60px; height: 60px; background-color: rgba(6, 78, 59, 0.05);">
                            <i class="bx bx-user-circle fs-2 text-primary"></i>
                        </div>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-3 text-dark">{{ __('Person-Centered Care') }}</h4>
                        <p class="text-muted fs-5 mb-0" style="line-height: 1.7;">{{ __('Every client is unique. We do not use a one-size-fits-all model. Instead, we adapt our interventions to fit your individual personality, background, and specific challenges.') }}</p>
                    </div>
                </div>
                
                <!-- Principle 3 -->
                <div class="d-flex mb-5 animate-up delay-2">
                    <div class="flex-shrink-0 me-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm border" style="width: 60px; height: 60px; background-color: rgba(6, 78, 59, 0.05);">
                            <i class="bx bx-test-tube fs-2 text-primary"></i>
                        </div>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-3 text-dark">{{ __('Evidence-Informed Practice') }}</h4>
                        <p class="text-muted fs-5 mb-0" style="line-height: 1.7;">{{ __('Our methods are not based on guesswork. All our interventions, training programs, and counseling techniques are grounded in proven professional knowledge and psychology research.') }}</p>
                    </div>
                </div>
                
                <!-- Principle 4 -->
                <div class="d-flex mb-5 animate-up">
                    <div class="flex-shrink-0 me-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm border" style="width: 60px; height: 60px; background-color: rgba(6, 78, 59, 0.05);">
                            <i class="bx bx-git-merge fs-2 text-primary"></i>
                        </div>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-3 text-dark">{{ __('Collaboration') }}</h4>
                        <p class="text-muted fs-5 mb-0" style="line-height: 1.7;">{{ __('We work alongside families, schools, and organizations. True, sustainable outcomes are achieved when all stakeholders are engaged and working toward the same goal.') }}</p>
                    </div>
                </div>
                
                <!-- Principle 5 -->
                <div class="d-flex mb-5 animate-up delay-1">
                    <div class="flex-shrink-0 me-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm border" style="width: 60px; height: 60px; background-color: rgba(6, 78, 59, 0.05);">
                            <i class="bx bx-check-shield fs-2 text-primary"></i>
                        </div>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-3 text-dark">{{ __('Ethics & Confidentiality') }}</h4>
                        <p class="text-muted fs-5 mb-0" style="line-height: 1.7;">{{ __('Trust is everything. We maintain strict confidentiality and adhere to the highest ethical standards of the counseling and consulting professions.') }}</p>
                    </div>
                </div>
                
                <!-- Principle 6 -->
                <div class="d-flex animate-up delay-2">
                    <div class="flex-shrink-0 me-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm border" style="width: 60px; height: 60px; background-color: rgba(6, 78, 59, 0.05);">
                            <i class="bx bx-book-reader fs-2 text-primary"></i>
                        </div>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-3 text-dark">{{ __('Continuous Learning') }}</h4>
                        <p class="text-muted fs-5 mb-0" style="line-height: 1.7;">{{ __('The fields of psychology and education are constantly evolving. Our team is committed to continuous professional development to ensure we bring you the latest best practices.') }}</p>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
</section>

@endsection
