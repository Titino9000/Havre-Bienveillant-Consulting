@extends('layouts.frontend')

@section('title', 'Our Achievements - HBC Ltd')

@section('content')

<section class="section-padding" style="background: linear-gradient(to right, rgba(43, 92, 119, 0.05), rgba(212, 163, 115, 0.05)); padding-top: 150px;">
    <div class="container text-center animate-up">
        <span class="badge-soft">Nos Réalisations</span>
        <h1 class="display-4 fw-bold">Impact & <span class="text-gradient">Projets</span></h1>
        <p class="lead text-muted mx-auto mt-3" style="max-width: 600px;">Nous sommes fiers des projets que nous avons menés pour promouvoir la santé mentale et le bien-être.</p>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="row gy-4">
            @php
                $achievements = \App\Models\Achievement::all();
            @endphp

            @forelse($achievements as $achievement)
                <div class="col-lg-6 animate-up">
                    <div class="card-premium d-flex flex-md-row flex-column gap-4 h-100 p-0 overflow-hidden">
                        @if($achievement->image)
                            <div class="w-md-50 w-100" style="min-height: 250px; background-image: url('{{ $achievement->image }}'); background-size: cover; background-position: center;"></div>
                        @else
                            <div class="w-md-50 w-100 d-flex align-items-center justify-content-center bg-light" style="min-height: 250px;">
                                <i class="bx bx-image bx-lg text-muted"></i>
                            </div>
                        @endif
                        <div class="p-4 w-md-50 w-100 d-flex flex-column justify-content-center">
                            <span class="badge-soft mb-2 align-self-start">{{ ucfirst($achievement->type) }}</span>
                            <h4 class="mb-3">{{ $achievement->title_fr ?? $achievement->title_en }}</h4>
                            <p class="text-muted mb-0">{{ Str::limit($achievement->description_fr ?? $achievement->description_en, 120) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <i class="bx bx-trophy bx-lg mb-3"></i>
                    <p>Les réalisations seront publiées très prochainement.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
