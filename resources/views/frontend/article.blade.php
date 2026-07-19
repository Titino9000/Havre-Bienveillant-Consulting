@extends('layouts.frontend')

@section('title', $article->title . ' - Havre Bienveillant Consultant Ltd')

@section('content')

<!-- ARTICLE HEADER -->
<section class="position-relative d-flex align-items-center justify-content-center text-center" style="padding: 120px 0 100px; background: url('{{ $article->image_path ? asset('storage/' . $article->image_path) : 'https://upload.wikimedia.org/wikipedia/commons/c/c6/Hills_of_Nyamagabe_in_Rwanda.jpg' }}') center/cover no-repeat; margin-top: 76px;">
    <!-- Dark Emerald Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(6, 78, 59, 0.85);"></div>
    
    <div class="container position-relative z-1 text-center animate-up">
        <span class="badge rounded-pill bg-white px-3 py-2 mb-4 shadow-sm" style="color: var(--primary); font-size: 0.85rem; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 700;">{{ __('Article') }}</span>
        
        <h1 class="display-5 fw-bolder text-white mb-4" style="letter-spacing: -0.5px; text-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            {{ $article->title }}
        </h1>
        
        <p class="text-white mx-auto mb-0" style="max-width: 650px; font-size: 1.15rem; font-weight: 300; opacity: 0.9; line-height: 1.7;">
            {{ $article->created_at->format('M d, Y') }}
        </p>
    </div>
</section>

<!-- ARTICLE CONTENT -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="article-content" style="line-height: 1.8; font-size: 1.1rem; color: var(--text-main);">
                    {!! nl2br(e($article->content)) !!}
                </div>
                
                <div class="mt-5 pt-4 border-top">
                    <a href="{{ route('resources') }}" class="btn btn-outline-primary rounded-pill px-4 fw-bold">
                        <i class="bx bx-left-arrow-alt me-2"></i> {{ __('Back to Resources') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
