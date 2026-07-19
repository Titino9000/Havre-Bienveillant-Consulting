@extends('layouts.frontend')

@section('title', __('Contact Us - Havre Bienveillant Consultant Ltd'))

@section('content')

<!-- HERO SECTION -->
<section class="position-relative d-flex align-items-center justify-content-center text-center" style="padding: 120px 0 100px; background: url('https://upload.wikimedia.org/wikipedia/commons/8/83/Kigali2018Cropped.jpg') center/cover no-repeat; margin-top: 76px;">
    <!-- Dark Emerald Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(6, 78, 59, 0.85);"></div>
    
    <div class="container position-relative z-1 text-center animate-up">
        <span class="badge rounded-pill bg-white px-3 py-2 mb-4 shadow-sm" style="color: var(--primary); font-size: 0.85rem; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 700;">{{ __('Get in Touch') }}</span>
        
        <h1 class="display-5 fw-bolder text-white mb-4" style="letter-spacing: -0.5px; text-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            {{ __('Let\'s Start the Conversation') }}
        </h1>
        
        <p class="text-white mx-auto mb-0" style="max-width: 650px; font-size: 1.15rem; font-weight: 300; opacity: 0.9; line-height: 1.7;">
            {{ __('Whether you have a question, need support, or want to discuss a partnership, we are here to listen and help.') }}
        </p>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="row gy-5">
            
            <!-- LEFT COLUMN: INFO & HOURS & SOCIALS -->
            <div class="col-lg-5 animate-up">
                
                <div class="pe-lg-4">
                    <h3 class="display-6 fw-bold mb-5">{{ __('Contact Information') }}</h3>
                    
                    <ul class="list-unstyled mb-5">
                        <li class="d-flex align-items-center mb-4 pb-3 border-bottom custom-hover-lift">
                            <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm me-4" style="width: 50px; height: 50px; background-color: rgba(6, 78, 59, 0.05); min-width: 50px;">
                                <i class="bx bx-map fs-4 text-primary"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1 text-dark">{{ __('Our Office') }}</h5>
                                <p class="text-muted mb-0">KG 139 Avenue 1, Building 1<br>Kimironko, Kigali, Rwanda</p>
                            </div>
                        </li>
                        <li class="d-flex align-items-center mb-4 pb-3 border-bottom custom-hover-lift">
                            <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm me-4" style="width: 50px; height: 50px; background-color: rgba(6, 78, 59, 0.05); min-width: 50px;">
                                <i class="bx bx-phone fs-4 text-primary"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1 text-dark">{{ __('Phone') }}</h5>
                                <p class="text-muted mb-0">+250 788 585 656</p>
                            </div>
                        </li>
                        <li class="d-flex align-items-center mb-4 custom-hover-lift">
                            <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm me-4" style="width: 50px; height: 50px; background-color: rgba(6, 78, 59, 0.05); min-width: 50px;">
                                <i class="bx bx-envelope fs-4 text-primary"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1 text-dark">{{ __('Email') }}</h5>
                                <p class="text-muted mb-0 text-break">
                                    <a href="mailto:havrebienveillant@gmail.com" class="text-muted text-decoration-none hover-primary">havrebienveillant@gmail.com</a><br>
                                    <a href="mailto:uje2006@gmail.com" class="text-muted text-decoration-none hover-primary">uje2006@gmail.com</a>
                                </p>
                            </div>
                        </li>
                    </ul>

                    <h4 class="fw-bold mb-4">{{ __('Office Hours') }}</h4>
                    <div class="card border-0 shadow-sm rounded-4 mb-5" style="background: var(--bg-light);">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                                <span class="fw-medium text-dark">{{ __('Monday - Friday') }}</span>
                                <span class="text-muted">8:00 AM - 5:00 PM</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                                <span class="fw-medium text-dark">{{ __('Saturday') }}</span>
                                <span class="text-muted">{{ __('By Appointment') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="fw-medium text-dark">{{ __('Sunday') }}</span>
                                <span class="text-danger fw-bold">{{ __('Closed') }}</span>
                            </div>
                        </div>
                    </div>

                    <h4 class="fw-bold mb-4">{{ __('Connect With Us') }}</h4>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-primary rounded-circle shadow-sm" style="width: 45px; height: 45px; display: inline-flex; align-items: center; justify-content: center;"><i class="bx bxl-linkedin fs-4"></i></a>
                        <a href="#" class="btn btn-primary rounded-circle shadow-sm" style="width: 45px; height: 45px; display: inline-flex; align-items: center; justify-content: center;"><i class="bx bxl-facebook fs-4"></i></a>
                        <a href="#" class="btn btn-primary rounded-circle shadow-sm" style="width: 45px; height: 45px; display: inline-flex; align-items: center; justify-content: center;"><i class="bx bxl-instagram fs-4"></i></a>
                        <a href="https://wa.me/250788585656" class="btn btn-success rounded-circle shadow-sm" style="width: 45px; height: 45px; display: inline-flex; align-items: center; justify-content: center;" target="_blank"><i class="bx bxl-whatsapp fs-4"></i></a>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: FORM -->
            <div class="col-lg-7 animate-up delay-1">
                <div class="bg-white p-4 p-md-5 h-100 shadow-sm border rounded-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width: 50px; height: 50px; background-color: rgba(6, 78, 59, 0.05); min-width: 50px;">
                            <i class="bx bx-send fs-4 text-primary"></i>
                        </div>
                        <h3 class="fw-bold mb-0 text-dark">{{ __('Send Us a Message') }}</h3>
                    </div>
                    <form action="#" method="POST">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ __('Your Name') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control px-4 py-3 bg-light border-0 rounded-3 shadow-none" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ __('Your Email') }} <span class="text-danger">*</span></label>
                                <input type="email" class="form-control px-4 py-3 bg-light border-0 rounded-3 shadow-none" placeholder="john@example.com" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ __('Phone Number') }}</label>
                                <input type="tel" class="form-control px-4 py-3 bg-light border-0 rounded-3 shadow-none" placeholder="+250 ...">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{ __('Subject') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control px-4 py-3 bg-light border-0 rounded-3 shadow-none" placeholder="How can we help?" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">{{ __('Message') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control px-4 py-3 bg-light border-0 rounded-3 shadow-none" rows="5" placeholder="Write your message here..." required></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-premium px-5 py-3 w-100 rounded-pill fs-5">{{ __('Send Message') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- MAP SECTION -->
<section class="p-0 animate-up delay-2">
    <div style="height: 400px; width: 100%;">
        <!-- Placeholder for actual Google Map iframe -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15950.009756184236!2d30.12354785!3d-1.954202!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca6823908c691%3A0xc328fa8d10b74da1!2sKimironko%2C%20Kigali%2C%20Rwanda!5e0!3m2!1sen!2s!4v1700000000000!5m2!1sen!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

@endsection
