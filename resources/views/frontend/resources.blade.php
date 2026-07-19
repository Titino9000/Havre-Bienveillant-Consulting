@extends('layouts.frontend')

@section('title', __('Resources - Havre Bienveillant Consultant Ltd'))

@section('content')

<!-- HERO SECTION -->
<section class="position-relative d-flex align-items-center justify-content-center text-center" style="padding: 120px 0 100px; background: url('https://upload.wikimedia.org/wikipedia/commons/c/c6/Hills_of_Nyamagabe_in_Rwanda.jpg') center/cover no-repeat; margin-top: 76px;">
    <!-- Dark Emerald Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(6, 78, 59, 0.85);"></div>
    
    <div class="container position-relative z-1 text-center animate-up">
        <span class="badge rounded-pill bg-white px-3 py-2 mb-4 shadow-sm" style="color: var(--primary); font-size: 0.85rem; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 700;">{{ __('Knowledge Hub') }}</span>
        
        <h1 class="display-5 fw-bolder text-white mb-4" style="letter-spacing: -0.5px; text-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            {{ __('Learning Resources') }} <br class="d-none d-md-block">
            <span style="color: var(--bg-light);">{{ __('for Better Mental Health') }}</span>
        </h1>
        
        <p class="text-white mx-auto mb-0" style="max-width: 650px; font-size: 1.15rem; font-weight: 300; opacity: 0.9; line-height: 1.7;">
            {{ __('Explore our curated collection of articles, guides, and tools designed to support emotional wellbeing and personal development.') }}
        </p>
    </div>
</section>

<!-- SECTION 1: FEATURED ARTICLES -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5 animate-up">
            <div>
                <span class="badge-soft mb-3">{{ __('Insights') }}</span>
                <h2 class="display-5 fw-bold mb-0">{{ __('Featured Articles') }}</h2>
            </div>
        </div>
        
        <div class="row gy-4">
            @php $articles = $knowledgeHubs->where('type', 'article'); @endphp
            @forelse($articles as $index => $article)
            <div class="col-lg-4 col-md-6 animate-up delay-{{ $index % 3 }}">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                    <div style="height: 200px; background: url('{{ $article->image_path ?? '' }}') center/cover;"></div>
                    <div class="card-body p-4">
                        <span class="text-primary fw-bold small mb-2 d-block">{{ __('Article') }}</span>
                        <h5 class="card-title fw-bold">{{ $article->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($article->content, 120) }}</p>
                        <a href="{{ route('article.show', $article->id) }}" class="btn btn-link text-primary p-0 fw-bold text-decoration-none">{{ __('Read Article') }} <i class="bx bx-right-arrow-alt"></i></a>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-muted">{{ __('No articles available.') }}</p>
            @endforelse
        </div>
    </div>
</section>

<!-- SECTION 2: DOWNLOADABLE RESOURCES -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5 animate-up">
            <span class="badge-soft mb-3">{{ __('Downloads') }}</span>
            <h2 class="display-5 fw-bold">{{ __('Free Downloadable Guides') }}</h2>
        </div>
        
        <div class="row justify-content-center gy-4">
            <div class="col-lg-8">
                @php $pdfs = $knowledgeHubs->where('type', 'pdf'); @endphp
                @forelse($pdfs as $index => $pdf)
                <div class="bg-white p-4 mb-3 animate-up delay-{{ $index % 3 }} d-flex flex-column flex-sm-row align-items-sm-center justify-content-between rounded-4 border shadow-sm custom-hover-lift">
                    <div class="d-flex align-items-center mb-3 mb-sm-0">
                        <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm me-4" style="width: 60px; height: 60px; background-color: rgba(6, 78, 59, 0.05);">
                            <i class="bx bxs-file-pdf fs-2 text-primary"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1 text-dark">{{ $pdf->title }}</h5>
                            <p class="text-muted small mb-0">{{ Str::limit($pdf->content, 80) }}</p>
                        </div>
                    </div>
                    <a href="{{ $pdf->file_path ? asset('storage/' . $pdf->file_path) : '#' }}" class="btn btn-outline-primary px-4 rounded-pill fw-bold" {{ $pdf->file_path ? 'target="_blank"' : '' }}>{{ __('Download PDF') }}</a>
                </div>
                @empty
                <p class="text-muted text-center">{{ __('No downloads available.') }}</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- SECTION 3: VIDEOS & WEBINARS -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5 animate-up">
            <span class="badge-soft mb-3">{{ __('Media') }}</span>
            <h2 class="display-5 fw-bold">{{ __('Videos & Webinars') }}</h2>
            <p class="text-muted">{{ __('Educational content, recorded workshops, and mental health discussions.') }}</p>
        </div>
        
        <div class="row gy-4 justify-content-center">
            @php $videos = $knowledgeHubs->where('type', 'video'); @endphp
            @forelse($videos as $index => $video)
            <div class="col-lg-5 animate-up delay-{{ $index % 2 }}">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden position-relative group">
                    <img src="{{ $video->image_path ?? 'https://via.placeholder.com/600x400' }}" alt="Video Thumbnail" class="img-fluid" style="height: 250px; width: 100%; object-fit: cover;">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.4);">
                        <a href="{{ $video->file_path ?? '#' }}" class="btn btn-light rounded-circle shadow-lg" style="width: 70px; height: 70px; display: inline-flex; align-items: center; justify-content: center;">
                            <i class="bx bx-play fs-1 ms-1 text-primary"></i>
                        </a>
                    </div>
                </div>
                <h5 class="fw-bold mt-3 text-center">{{ $video->title }}</h5>
            </div>
            @empty
            <p class="text-muted text-center">{{ __('No videos available.') }}</p>
            @endforelse
        </div>
    </div>
</section>

<!-- CALL TO ACTION -->
<section class="section-padding text-white text-center position-relative" style="background: linear-gradient(135deg, var(--primary-dark), var(--primary)); overflow: hidden;">
    <div class="position-absolute top-50 start-50 translate-middle" style="width: 1000px; height: 1000px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);"></div>
    
    <div class="container position-relative z-1 animate-up">
        <h2 class="display-5 fw-bold mb-4 text-white">{{ __('Stay Updated with Our Resources') }}</h2>
        <p class="lead mb-5 mx-auto" style="max-width: 700px; color: rgba(255,255,255,0.9);">
            {{ __('Subscribe to our newsletter to receive the latest articles, guides, and updates directly in your inbox.') }}
        </p>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <form class="d-flex gap-2">
                    <input type="email" class="form-control form-control-lg rounded-pill px-4" placeholder="{{ __('Email Address') }}" required>
                    <button type="submit" class="btn btn-premium" style="background: white !important; color: var(--primary) !important;">{{ __('Subscribe') }}</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
