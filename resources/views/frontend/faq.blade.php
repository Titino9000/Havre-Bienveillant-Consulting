@extends('layouts.frontend')

@section('title', __('Frequently Asked Questions - Havre Bienveillant Consultant Ltd'))

@section('content')

<!-- HERO SECTION -->
<section class="position-relative d-flex align-items-center justify-content-center text-center" style="padding: 120px 0 100px; background: url('https://upload.wikimedia.org/wikipedia/commons/8/88/Kigali_City_Tower.jpg') center/cover no-repeat; margin-top: 76px;">
    <!-- Dark Emerald Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(6, 78, 59, 0.85);"></div>
    
    <div class="container position-relative z-1 text-center animate-up">
        <span class="badge rounded-pill bg-white px-3 py-2 mb-4 shadow-sm" style="color: var(--primary); font-size: 0.85rem; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 700;">{{ __('Answers') }}</span>
        
        <h1 class="display-5 fw-bolder text-white mb-4" style="letter-spacing: -0.5px; text-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            {{ __('Frequently Asked Questions') }}
        </h1>
        
        <p class="text-white mx-auto mb-0" style="max-width: 650px; font-size: 1.15rem; font-weight: 300; opacity: 0.9; line-height: 1.7;">
            {{ __('Find answers to common questions about our counseling, consulting, and training services.') }}
        </p>
    </div>
</section>

<!-- FAQ ACCORDION -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row justify-content-center animate-up">
            <div class="col-lg-8">
                <div class="accordion accordion-flush bg-light rounded-4 shadow-sm p-4" id="mainFaqAccordion">
                    
                    @forelse($faqs as $index => $faq)
                    <!-- Q{{ $index + 1 }} -->
                    <div class="accordion-item border-0 {{ $loop->last ? '' : 'border-bottom' }} bg-transparent {{ $index > 0 ? 'mt-2' : '' }}">
                        <h2 class="accordion-header">
                            <button class="accordion-button bg-transparent fw-bold text-dark fs-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $index + 1 }}">
                                {{ $faq->question }}
                            </button>
                        </h2>
                        <div id="faq{{ $index + 1 }}" class="accordion-collapse collapse" data-bs-parent="#mainFaqAccordion">
                            <div class="accordion-body text-muted pb-4 fs-6">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted text-center">{{ __('No FAQs available.') }}</p>
                    @endforelse
                    
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center mt-5 animate-up delay-1">
            <div class="col-lg-8 text-center">
                <p class="fs-5 text-muted mb-4">{{ __('Still have questions? We\'re here to help.') }}</p>
                <a href="{{ route('contact') }}" class="btn-premium">{{ __('Contact Us') }}</a>
            </div>
        </div>
    </div>
</section>

@endsection
