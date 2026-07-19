@extends('layouts.frontend')

@section('title', __('Book a Consultation - Havre Bienveillant Consultant Ltd'))

@section('content')

<!-- HERO SECTION -->
<section class="position-relative d-flex align-items-center justify-content-center text-center" style="padding: 120px 0 100px; background: url('https://upload.wikimedia.org/wikipedia/commons/6/65/Tea_Harvest_in_Rwanda.jpg') center/cover no-repeat; margin-top: 76px;">
    <!-- Dark Emerald Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(6, 78, 59, 0.85);"></div>
    
    <div class="container position-relative z-1 text-center animate-up">
        <span class="badge rounded-pill bg-white px-3 py-2 mb-4 shadow-sm" style="color: var(--primary); font-size: 0.85rem; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 700;">{{ __('Consultation') }}</span>
        
        <h1 class="display-5 fw-bolder text-white mb-4" style="letter-spacing: -0.5px; text-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            {{ __('We\'re Here to Listen and Support You') }}
        </h1>
        
        <p class="text-white mx-auto mb-0" style="max-width: 650px; font-size: 1.15rem; font-weight: 300; opacity: 0.9; line-height: 1.7;">
            {{ __('Take the first step toward better mental health and wellbeing. Request a consultation below and our team will get in touch with you shortly.') }}
        </p>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        
        <!-- IMPORTANT NOTICE (EMERGENCY) -->
        <div class="row justify-content-center mb-5 animate-up">
            <div class="col-lg-10">
                <div class="alert border-0 shadow-sm rounded-4 p-4 d-flex gap-3 align-items-start" style="background-color: #fff5f5; border-left: 4px solid #e53e3e !important;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background-color: rgba(229, 62, 62, 0.1);">
                        <i class="bx bx-error-circle text-danger fs-3"></i>
                    </div>
                    <div>
                        <h5 class="alert-heading fw-bold mb-2 text-danger">{{ __('Important Notice') }}</h5>
                        <p class="mb-0 text-dark opacity-75" style="font-size: 0.95rem;">{{ __('This website is not an emergency or crisis response service. If you or someone you know is experiencing an immediate mental health emergency, please contact local emergency services or visit the nearest healthcare facility immediately.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gy-5 justify-content-center">
            
            <!-- LEFT COLUMN: BOOKING INFO & BEFORE YOU COME -->
            <div class="col-lg-4 animate-up delay-1">
                
                <div class="bg-white rounded-4 p-4 mb-4 shadow-sm border custom-hover-lift" style="border-top: 4px solid var(--primary) !important;">
                    <h4 class="fw-bold mb-4 text-dark">{{ __('How It Works') }}</h4>
                    <ul class="list-unstyled mb-0 position-relative booking-steps">
                        <!-- Step 1 -->
                        <li class="d-flex mb-4 position-relative">
                            <div class="rounded-circle border shadow-sm d-flex align-items-center justify-content-center flex-shrink-0 me-3" style="width: 40px; height: 40px; background-color: rgba(6, 78, 59, 0.05); z-index: 1;">
                                <span class="fw-bold text-primary">1</span>
                            </div>
                            <div class="pt-1">
                                <h6 class="fw-bold mb-1 text-dark">{{ __('Submit Request') }}</h6>
                                <p class="text-muted small mb-0">{{ __('Fill out the form with your details.') }}</p>
                            </div>
                        </li>
                        <!-- Step 2 -->
                        <li class="d-flex mb-4 position-relative">
                            <div class="rounded-circle border shadow-sm d-flex align-items-center justify-content-center flex-shrink-0 me-3" style="width: 40px; height: 40px; background-color: rgba(6, 78, 59, 0.05); z-index: 1;">
                                <span class="fw-bold text-primary">2</span>
                            </div>
                            <div class="pt-1">
                                <h6 class="fw-bold mb-1 text-dark">{{ __('We Review') }}</h6>
                                <p class="text-muted small mb-0">{{ __('Our team reviews your specific needs.') }}</p>
                            </div>
                        </li>
                        <!-- Step 3 -->
                        <li class="d-flex mb-4 position-relative">
                            <div class="rounded-circle border shadow-sm d-flex align-items-center justify-content-center flex-shrink-0 me-3" style="width: 40px; height: 40px; background-color: rgba(6, 78, 59, 0.05); z-index: 1;">
                                <span class="fw-bold text-primary">3</span>
                            </div>
                            <div class="pt-1">
                                <h6 class="fw-bold mb-1 text-dark">{{ __('Confirmation') }}</h6>
                                <p class="text-muted small mb-0">{{ __('We contact you to confirm details.') }}</p>
                            </div>
                        </li>
                        <!-- Step 4 -->
                        <li class="d-flex position-relative">
                            <div class="rounded-circle border shadow-sm d-flex align-items-center justify-content-center flex-shrink-0 me-3" style="width: 40px; height: 40px; background-color: rgba(6, 78, 59, 0.05); z-index: 1;">
                                <span class="fw-bold text-primary">4</span>
                            </div>
                            <div class="pt-1">
                                <h6 class="fw-bold mb-1 text-dark">{{ __('Schedule') }}</h6>
                                <p class="text-muted small mb-0">{{ __('We schedule your consultation.') }}</p>
                            </div>
                        </li>
                    </ul>
                    <style>
                        .booking-steps li:not(:last-child)::after {
                            content: '';
                            position: absolute;
                            left: 19px;
                            top: 40px;
                            bottom: -10px;
                            width: 2px;
                            background-color: rgba(6, 78, 59, 0.1);
                            z-index: 0;
                        }
                    </style>
                </div>

                <div class="bg-white rounded-4 p-4 shadow-sm border custom-hover-lift" style="border-top: 4px solid var(--primary) !important;">
                    <h4 class="fw-bold mb-4 text-dark">{{ __('Before Your Consultation') }}</h4>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex align-items-start mb-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 me-3" style="width: 30px; height: 30px; background-color: rgba(6, 78, 59, 0.05);">
                                <i class="bx bx-time text-primary"></i>
                            </div>
                            <span class="text-muted small pt-1">{{ __('Please arrive at least 10 minutes on time.') }}</span>
                        </li>
                        <li class="d-flex align-items-start mb-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 me-3" style="width: 30px; height: 30px; background-color: rgba(6, 78, 59, 0.05);">
                                <i class="bx bx-info-circle text-primary"></i>
                            </div>
                            <span class="text-muted small pt-1">{{ __('Share any relevant background information with our team.') }}</span>
                        </li>
                        <li class="d-flex align-items-start">
                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 me-3" style="width: 30px; height: 30px; background-color: rgba(6, 78, 59, 0.05);">
                                <i class="bx bx-calendar-x text-primary"></i>
                            </div>
                            <span class="text-muted small pt-1">{{ __('Inform us at least 24 hours in advance if you need to reschedule.') }}</span>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- RIGHT COLUMN: BOOKING FORM -->
            <div class="col-lg-6 animate-up delay-2">
                <div class="bg-white p-4 p-md-5 h-100 shadow-sm border rounded-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width: 50px; height: 50px; background-color: rgba(6, 78, 59, 0.05); min-width: 50px;">
                            <i class="bx bx-calendar-plus fs-4 text-primary"></i>
                        </div>
                        <h3 class="fw-bold mb-0 text-dark">{{ __('Request an Appointment') }}</h3>
                    </div>
                    <form action="#" method="POST">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ __('Full Name') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control px-4 py-3 bg-light border-0 rounded-3 shadow-none" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ __('Organization') }} <span class="text-muted fw-normal fs-6">({{ __('Optional') }})</span></label>
                                <input type="text" class="form-control px-4 py-3 bg-light border-0 rounded-3 shadow-none" placeholder="Company / School Name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                                <input type="email" class="form-control px-4 py-3 bg-light border-0 rounded-3 shadow-none" placeholder="john@example.com" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control px-4 py-3 bg-light border-0 rounded-3 shadow-none" placeholder="+250 ..." required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">{{ __('Service Required') }} <span class="text-danger">*</span></label>
                                <select class="form-select px-4 py-3 bg-light border-0 rounded-3 shadow-none" required style="cursor: pointer;">
                                    <option value="" selected disabled>{{ __('Select a service') }}</option>
                                    <option value="individual">{{ __('Individual Counseling') }}</option>
                                    <option value="school">{{ __('School Mental Health') }}</option>
                                    <option value="positive_ed">{{ __('Positive Education Consulting') }}</option>
                                    <option value="training">{{ __('Mental Health Training') }}</option>
                                    <option value="organizational">{{ __('Organizational Wellness') }}</option>
                                    <option value="psychosocial">{{ __('Psychosocial Support') }}</option>
                                    <option value="other">{{ __('Other / Unsure') }}</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ __('Preferred Date') }} <span class="text-danger">*</span></label>
                                <input type="date" class="form-control px-4 py-3 bg-light border-0 rounded-3 shadow-none" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ __('Preferred Time') }} <span class="text-danger">*</span></label>
                                <input type="time" class="form-control px-4 py-3 bg-light border-0 rounded-3 shadow-none" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">{{ __('Message / Additional Details') }}</label>
                                <textarea class="form-control px-4 py-3 bg-light border-0 rounded-3 shadow-none" rows="4" placeholder="{{ __('Briefly describe what you are looking for...') }}"></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-premium w-100 py-3 rounded-pill fs-5 shadow-sm">{{ __('Submit Consultation Request') }}</button>
                                <div class="text-center mt-3 d-flex justify-content-center align-items-center gap-2">
                                    <i class="bx bx-lock-alt text-muted"></i>
                                    <p class="text-muted small mb-0">{{ __('Your information is strictly confidential.') }}</p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</section>

@endsection
