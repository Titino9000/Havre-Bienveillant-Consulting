@extends('layouts.frontend')

@section('title', __('About Us - Havre Bienveillant Consultant Ltd'))

@section('content')

<!-- HERO SECTION -->
<section class="position-relative d-flex align-items-center justify-content-center text-center" style="padding: 120px 0 100px; background: url('https://upload.wikimedia.org/wikipedia/commons/0/0a/Kigali_city_view.jpg') center/cover no-repeat; margin-top: 76px;">
    <!-- Dark Emerald Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(6, 78, 59, 0.85);"></div>
    
    <div class="container position-relative z-1 text-center animate-up">
        <span class="badge rounded-pill bg-white px-3 py-2 mb-4 shadow-sm" style="color: var(--primary); font-size: 0.85rem; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 700;">{{ __('About Us') }}</span>
        
        <h1 class="display-5 fw-bolder text-white mb-4" style="letter-spacing: -0.5px; text-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            {{ __('About Havre Bienveillant') }} <br class="d-none d-md-block">
            <span style="color: var(--bg-light);">{{ __('Consultant Ltd') }}</span>
        </h1>
        
        <p class="text-white mx-auto mb-0" style="max-width: 650px; font-size: 1.15rem; font-weight: 300; opacity: 0.9; line-height: 1.7;">
            {{ __('Dedicated to promoting mental health, emotional wellbeing, and positive human development through compassionate, professional, and evidence-informed services.') }}
        </p>
    </div>
</section>

<!-- SECTION 1: WHO WE ARE -->
<section class="section-padding bg-white" style="position: relative;">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6 animate-up">
                <div class="pe-lg-5">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div style="width: 40px; height: 3px; background-color: var(--accent);"></div>
                        <span class="text-uppercase fw-bold" style="color: var(--primary); letter-spacing: 1px;">{{ __('Our Identity') }}</span>
                    </div>
                    <h2 class="display-5 fw-bold mb-4 text-dark">{{ __('Compassionate Professionals Committed to Mental Wellbeing') }}</h2>
                    <p class="text-muted fs-5 mb-4" style="line-height: 1.8;">
                        {{ __('Havre Bienveillant Consultant Ltd is a professional mental health and psychosocial consulting firm based in Kigali, Rwanda. We provide counseling, psychosocial support, mental health training, and positive education consulting to individuals, families, schools, organizations, and communities.') }}
                    </p>
                    <p class="text-muted mb-4" style="line-height: 1.8;">
                        {{ __('Our approach combines professional expertise with compassion, recognizing that every individual and organization has unique strengths, challenges, and aspirations. We work collaboratively with our clients to develop practical, culturally appropriate, and sustainable solutions that promote emotional wellbeing, resilience, and personal growth.') }}
                    </p>
                    <p class="text-muted fw-medium mb-0" style="color: var(--primary) !important;">
                        {{ __('Whether supporting a child experiencing emotional difficulties, training teachers to create healthier classrooms, or helping organizations strengthen workplace wellbeing, our goal remains the same: to place people at the center of every solution.') }}
                    </p>
                </div>
            </div>
            <div class="col-lg-6 animate-up delay-1">
                <div class="position-relative p-2 p-md-4">
                    <div class="position-absolute top-0 start-0 w-100 h-100 rounded-circle opacity-50 blur-3xl" style="background: radial-gradient(circle, var(--bg-light) 0%, transparent 70%); z-index: 0; filter: blur(40px);"></div>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/65/Tea_Harvest_in_Rwanda.jpg" alt="Rwanda Landscape" class="img-fluid rounded-4 shadow-lg position-relative z-1" style="border: 8px solid white;">
                    <div class="position-absolute bottom-0 end-0 translate-middle-y bg-white p-4 rounded-4 shadow-lg d-none d-sm-block z-2" style="margin-right: -30px;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background-color: var(--bg-light);">
                                <i class="bx bx-group bx-md" style="color: var(--primary);"></i>
                            </div>
                            <div>
                                <h4 class="text-primary fw-bold mb-0">{{ __('People First') }}</h4>
                                <span class="text-muted small">{{ __('Centered on human connection') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 2: OUR STORY (Glassmorphism styling) -->
<section class="section-padding position-relative" style="background: url('https://upload.wikimedia.org/wikipedia/commons/c/c6/Hills_of_Nyamagabe_in_Rwanda.jpg') center/cover fixed;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(8px);"></div>
    <div class="container position-relative z-1">
        <div class="row justify-content-center animate-up">
            <div class="col-lg-8 text-center">
                <span class="badge rounded-pill px-4 py-2 mb-4 fw-bold shadow-sm" style="background-color: var(--primary); color: white; letter-spacing: 1px; text-transform: uppercase;">{{ __('Our Story') }}</span>
                <h2 class="display-5 fw-bold mb-5 text-dark">{{ __('Why We Started') }}</h2>
            </div>
        </div>
        <div class="row justify-content-center animate-up delay-1">
            <div class="col-lg-10">
                <div class="p-md-5 p-4 rounded-4 shadow-lg border" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(16px); border-color: rgba(255,255,255,0.5);">
                    <p class="fs-5 text-dark mb-4" style="line-height: 1.8;">
                        {{ __('Havre Bienveillant Consultant Ltd was founded in response to the growing need for accessible, compassionate, and professional mental health and psychosocial support in Rwanda. As awareness of mental wellbeing continues to grow, many individuals, families, schools, and organizations are seeking trusted partners who can provide practical guidance, professional counseling, and preventive mental health programs.') }}
                    </p>
                    <p class="fs-5 text-dark mb-4" style="line-height: 1.8;">
                        {{ __('Drawing on experience in psychology, education, educational leadership, coaching, and community development, we established Havre Bienveillant Consultant Ltd with a clear purpose: to help people overcome challenges, strengthen resilience, and create environments where individuals and communities can thrive.') }}
                    </p>
                    <div class="p-4 rounded-3 mt-4 position-relative overflow-hidden shadow-sm" style="background-color: var(--bg-light); border-left: 6px solid var(--primary);">
                        <i class="bx bxs-quote-left position-absolute top-0 start-0 text-white" style="font-size: 8rem; opacity: 0.3; transform: translate(-20%, -20%);"></i>
                        <p class="mb-0 fs-4 text-dark fw-bold fst-italic position-relative z-1 px-4 py-2" style="color: var(--primary) !important;">
                            {{ __('"We believe that investing in mental health is an investment in stronger families, healthier schools, more productive workplaces, and a more resilient society."') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 3: MISSION & VISION (Simple) -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row gy-4 animate-up">
            <!-- Mission -->
            <div class="col-md-6">
                <div class="h-100 p-4 p-md-5 bg-light rounded-4 border-start border-4 border-primary">
                    <div class="d-flex align-items-center mb-4">
                        <i class="bx bx-target-lock fs-1 text-primary me-3"></i>
                        <h3 class="fw-bold mb-0 display-6 text-dark">{{ __('Our Mission') }}</h3>
                    </div>
                    <p class="fs-5 mb-0 text-muted" style="line-height: 1.8;">
                        {{ __('To provide professional and compassionate psychosocial support to individuals and educational institutions, promoting mental health, emotional wellbeing, and personal development through ethical, evidence-informed, and client-centered services.') }}
                    </p>
                </div>
            </div>
            <!-- Vision -->
            <div class="col-md-6 animate-up delay-1">
                <div class="h-100 p-4 p-md-5 bg-light rounded-4 border-start border-4 border-accent">
                    <div class="d-flex align-items-center mb-4">
                        <i class="bx bx-show fs-1 text-accent me-3"></i>
                        <h3 class="fw-bold mb-0 display-6 text-dark">{{ __('Our Vision') }}</h3>
                    </div>
                    <p class="fs-5 mb-0 text-muted" style="line-height: 1.8;">
                        {{ __('To become a trusted leader in mental health and human development by placing people, dignity, and positive transformation at the heart of every intervention.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 4: OUR VALUES (Sleek Border Cards) -->
<section class="section-padding bg-light position-relative">
    <div class="container position-relative z-1">
        <div class="text-center mb-5 animate-up">
            <span class="badge rounded-pill bg-white px-4 py-2 mb-4 fw-bold shadow-sm" style="color: var(--primary); letter-spacing: 1px; text-transform: uppercase;">{{ __('Core Principles') }}</span>
            <h2 class="display-5 fw-bold text-dark">{{ __('The Principles That Guide Our Work') }}</h2>
        </div>
        <div class="row gy-4">
            <!-- Value 1 -->
            <div class="col-lg-4 col-md-6 animate-up">
                <div class="bg-white rounded-4 p-4 h-100 shadow-sm border custom-hover-lift" style="border-top: 4px solid var(--primary) !important; transition: all 0.3s ease;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width: 50px; height: 50px; background-color: rgba(6, 78, 59, 0.05);">
                            <i class="bx bx-heart fs-4 text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-0 text-dark">{{ __('Compassion') }}</h4>
                    </div>
                    <p class="text-muted mb-0" style="line-height: 1.7;">{{ __('We treat every individual with empathy, kindness, and respect, creating safe spaces where people feel heard and supported.') }}</p>
                </div>
            </div>
            <!-- Value 2 -->
            <div class="col-lg-4 col-md-6 animate-up delay-1">
                <div class="bg-white rounded-4 p-4 h-100 shadow-sm border custom-hover-lift" style="border-top: 4px solid var(--primary) !important; transition: all 0.3s ease;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width: 50px; height: 50px; background-color: rgba(6, 78, 59, 0.05);">
                            <i class="bx bx-briefcase-alt-2 fs-4 text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-0 text-dark">{{ __('Professionalism') }}</h4>
                    </div>
                    <p class="text-muted mb-0" style="line-height: 1.7;">{{ __('We uphold high standards of competence, ethics, accountability, and service quality in everything we do.') }}</p>
                </div>
            </div>
            <!-- Value 3 -->
            <div class="col-lg-4 col-md-6 animate-up delay-2">
                <div class="bg-white rounded-4 p-4 h-100 shadow-sm border custom-hover-lift" style="border-top: 4px solid var(--primary) !important; transition: all 0.3s ease;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width: 50px; height: 50px; background-color: rgba(6, 78, 59, 0.05);">
                            <i class="bx bx-shield-quarter fs-4 text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-0 text-dark">{{ __('Integrity') }}</h4>
                    </div>
                    <p class="text-muted mb-0" style="line-height: 1.7;">{{ __('We act with honesty, transparency, and responsibility, building trust through ethical practice and sound professional judgment.') }}</p>
                </div>
            </div>
            <!-- Value 4 -->
            <div class="col-lg-4 col-md-6 animate-up">
                <div class="bg-white rounded-4 p-4 h-100 shadow-sm border custom-hover-lift" style="border-top: 4px solid var(--primary) !important; transition: all 0.3s ease;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width: 50px; height: 50px; background-color: rgba(6, 78, 59, 0.05);">
                            <i class="bx bx-lock-alt fs-4 text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-0 text-dark">{{ __('Confidentiality') }}</h4>
                    </div>
                    <p class="text-muted mb-0" style="line-height: 1.7;">{{ __('We protect the privacy and dignity of every client by maintaining strict confidentiality and ethical standards.') }}</p>
                </div>
            </div>
            <!-- Value 5 -->
            <div class="col-lg-4 col-md-6 animate-up delay-1">
                <div class="bg-white rounded-4 p-4 h-100 shadow-sm border custom-hover-lift" style="border-top: 4px solid var(--primary) !important; transition: all 0.3s ease;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width: 50px; height: 50px; background-color: rgba(6, 78, 59, 0.05);">
                            <i class="bx bx-group fs-4 text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-0 text-dark">{{ __('Collaboration') }}</h4>
                    </div>
                    <p class="text-muted mb-0" style="line-height: 1.7;">{{ __('We believe meaningful change happens through strong partnerships with families, schools, organizations, and communities.') }}</p>
                </div>
            </div>
            <!-- Value 6 -->
            <div class="col-lg-4 col-md-6 animate-up delay-2">
                <div class="bg-white rounded-4 p-4 h-100 shadow-sm border custom-hover-lift" style="border-top: 4px solid var(--primary) !important; transition: all 0.3s ease;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width: 50px; height: 50px; background-color: rgba(6, 78, 59, 0.05);">
                            <i class="bx bx-world fs-4 text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-0 text-dark">{{ __('Social Commitment') }}</h4>
                    </div>
                    <p class="text-muted mb-0" style="line-height: 1.7;">{{ __('We are committed to strengthening communities by promoting mental health awareness, prevention, and inclusive support systems.') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 5: LEADERSHIP -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-5 animate-up">
                <div class="position-relative p-2">
                    <div class="position-absolute top-0 end-0 w-75 h-75 rounded-4" style="background-color: var(--bg-light); z-index: 0; transform: translate(15px, -15px);"></div>
                    <!-- Placeholder image for founder. Update when a real portrait is available -->
                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/88/Kigali_City_Tower.jpg" alt="Founder Professional Workspace" class="img-fluid rounded-4 shadow-lg position-relative z-1" style="border: 6px solid white;">
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1 animate-up delay-1">
                <span class="badge rounded-pill bg-light px-4 py-2 mb-4 fw-bold shadow-sm" style="color: var(--primary); letter-spacing: 1px; text-transform: uppercase;">{{ __('Leadership') }}</span>
                <h2 class="display-5 fw-bold mb-2 text-dark">{{ __('Meet Our Founder') }}</h2>
                <h4 class="text-primary mb-4">{{ __('Jeanine Umulisa') }} <span class="text-muted fs-6 fw-normal ms-2">- {{ __('Managing Director') }}</span></h4>
                
                <p class="text-muted fs-5 mb-4" style="line-height: 1.8;">
                    {{ __('Jeanine Umulisa is the Founder and Managing Director of Havre Bienveillant Consultant Ltd. With professional experience in psychology, education, educational leadership, coaching, and psychosocial support, she is passionate about helping individuals and institutions achieve positive and lasting transformation.') }}
                </p>
                <p class="text-muted mb-4" style="line-height: 1.8;">
                    {{ __('Throughout her career, she has worked closely with schools, teachers, students, parents, public institutions, and health professionals to strengthen mental wellbeing, improve educational outcomes, and promote resilient communities.') }}
                </p>
                <p class="fw-medium text-dark border-start border-4 border-accent ps-3 mb-0" style="line-height: 1.8;">
                    {{ __('Her leadership is grounded in compassion, professionalism, continuous learning, and a strong belief that mental health is essential for personal, educational, and organizational success.') }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 6: OUR TEAM -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6 order-2 order-lg-1 animate-up">
                <span class="badge rounded-pill bg-white px-4 py-2 mb-4 fw-bold shadow-sm" style="color: var(--primary); letter-spacing: 1px; text-transform: uppercase;">{{ __('Our Team') }}</span>
                <h2 class="display-5 fw-bold mb-4 text-dark">{{ __('A Multidisciplinary Approach') }}</h2>
                <p class="text-muted fs-5 mb-4" style="line-height: 1.8;">
                    {{ __('Havre Bienveillant Consultant Ltd brings together professionals with complementary expertise to provide holistic support tailored to the needs of each client.') }}
                </p>
                <p class="text-dark fw-bold mb-4">{{ __('Our work is strengthened by experience in:') }}</p>
                
                <div class="row gy-3 mb-4">
                    <div class="col-sm-6">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex align-items-center mb-3 bg-white p-2 rounded shadow-sm"><i class="bx bxs-check-circle text-primary fs-5 me-3"></i> <span class="fw-medium">{{ __('Psychology') }}</span></li>
                            <li class="d-flex align-items-center mb-3 bg-white p-2 rounded shadow-sm"><i class="bx bxs-check-circle text-primary fs-5 me-3"></i> <span class="fw-medium">{{ __('Psychosocial Support') }}</span></li>
                            <li class="d-flex align-items-center mb-3 bg-white p-2 rounded shadow-sm"><i class="bx bxs-check-circle text-primary fs-5 me-3"></i> <span class="fw-medium">{{ __('Education') }}</span></li>
                            <li class="d-flex align-items-center mb-0 bg-white p-2 rounded shadow-sm"><i class="bx bxs-check-circle text-primary fs-5 me-3"></i> <span class="fw-medium">{{ __('Educational Leadership') }}</span></li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex align-items-center mb-3 bg-white p-2 rounded shadow-sm"><i class="bx bxs-check-circle text-primary fs-5 me-3"></i> <span class="fw-medium">{{ __('Coaching') }}</span></li>
                            <li class="d-flex align-items-center mb-3 bg-white p-2 rounded shadow-sm"><i class="bx bxs-check-circle text-primary fs-5 me-3"></i> <span class="fw-medium">{{ __('Personal Development') }}</span></li>
                            <li class="d-flex align-items-center mb-3 bg-white p-2 rounded shadow-sm"><i class="bx bxs-check-circle text-primary fs-5 me-3"></i> <span class="fw-medium">{{ __('Training and Facilitation') }}</span></li>
                            <li class="d-flex align-items-center mb-0 bg-white p-2 rounded shadow-sm"><i class="bx bxs-check-circle text-primary fs-5 me-3"></i> <span class="fw-medium">{{ __('Organizational Dev.') }}</span></li>
                        </ul>
                    </div>
                </div>
                <p class="text-muted mb-0 small fst-italic">
                    {{ __('As our organization grows, we remain committed to building a diverse team of qualified professionals who share our values of compassion, excellence, and service.') }}
                </p>
            </div>
            <div class="col-lg-5 offset-lg-1 order-1 order-lg-2 animate-up delay-1">
                <div class="position-relative p-2">
                    <div class="position-absolute bottom-0 start-0 w-75 h-75 rounded-4" style="background-color: var(--primary); opacity: 0.1; z-index: 0; transform: translate(-15px, 15px);"></div>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/1/1a/Green_Kigali.jpg" alt="Collaborative Concept" class="img-fluid rounded-4 shadow-lg position-relative z-1" style="border: 6px solid white;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 7: OUR COMMITMENT -->
<section class="section-padding bg-white position-relative overflow-hidden">
    <!-- Background blob -->
    <div class="position-absolute top-50 start-50 translate-middle w-100 h-100 rounded-circle opacity-25 blur-3xl" style="background: radial-gradient(circle, var(--bg-light) 0%, transparent 50%); z-index: 0; filter: blur(60px);"></div>
    
    <div class="container position-relative z-1">
        <div class="row justify-content-center animate-up">
            <div class="col-lg-8 text-center">
                <span class="badge rounded-pill bg-light px-4 py-2 mb-4 fw-bold shadow-sm" style="color: var(--primary); letter-spacing: 1px; text-transform: uppercase;">{{ __('Our Promise') }}</span>
                <h2 class="display-5 fw-bold mb-4 text-dark">{{ __('What You Can Expect When Working With Us') }}</h2>
                <p class="text-muted fs-5 mb-5" style="line-height: 1.8;">
                    {{ __('Every client relationship is built on trust, professionalism, and genuine care. When you choose Havre Bienveillant Consultant Ltd, you can expect:') }}
                </p>
            </div>
        </div>
        
        <div class="row justify-content-center gy-4 mb-5 animate-up delay-1">
            <div class="col-lg-10">
                <div class="bg-white rounded-4 shadow-sm border p-md-5 p-4" style="border-top: 4px solid var(--primary) !important;">
                    <ul class="list-unstyled mb-0 fs-5">
                        <li class="d-flex align-items-center mb-4 pb-3 border-bottom">
                            <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm me-4" style="width: 50px; height: 50px; background-color: rgba(6, 78, 59, 0.05); min-width: 50px;">
                                <i class="bx bx-check-shield text-primary fs-4"></i>
                            </div>
                            <span class="text-dark fw-medium">{{ __('Compassionate and respectful support.') }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-4 pb-3 border-bottom">
                            <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm me-4" style="width: 50px; height: 50px; background-color: rgba(6, 78, 59, 0.05); min-width: 50px;">
                                <i class="bx bx-check-shield text-primary fs-4"></i>
                            </div>
                            <span class="text-dark fw-medium">{{ __('Confidential and ethical services.') }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-4 pb-3 border-bottom">
                            <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm me-4" style="width: 50px; height: 50px; background-color: rgba(6, 78, 59, 0.05); min-width: 50px;">
                                <i class="bx bx-check-shield text-primary fs-4"></i>
                            </div>
                            <span class="text-dark fw-medium">{{ __('Evidence-informed approaches adapted to your context.') }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-4 pb-3 border-bottom">
                            <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm me-4" style="width: 50px; height: 50px; background-color: rgba(6, 78, 59, 0.05); min-width: 50px;">
                                <i class="bx bx-check-shield text-primary fs-4"></i>
                            </div>
                            <span class="text-dark fw-medium">{{ __('Practical and sustainable solutions.') }}</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm me-4" style="width: 50px; height: 50px; background-color: rgba(6, 78, 59, 0.05); min-width: 50px;">
                                <i class="bx bx-check-shield text-primary fs-4"></i>
                            </div>
                            <span class="text-dark fw-medium">{{ __('A collaborative partnership focused on long-term wellbeing and positive outcomes.') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center animate-up delay-2">
            <div class="col-lg-8 text-center">
                <p class="fs-5 mb-0 fw-medium text-dark bg-light rounded-pill px-4 py-3 shadow-sm d-inline-block">
                    {{ __('Committed to helping you achieve meaningful and lasting change.') }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 8: FINAL CALL TO ACTION -->
<section class="section-padding text-center position-relative" style="background: var(--primary); overflow: hidden;">
    <!-- Abstract Shapes -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at top right, rgba(248, 231, 201, 0.1) 0%, transparent 60%);"></div>
    
    <div class="container position-relative z-1 animate-up py-4">
        <h2 class="display-4 fw-bold mb-4" style="color: var(--bg-light);">{{ __('Ready to Take the Next Step?') }}</h2>
        <p class="lead mb-5 mx-auto" style="max-width: 700px; color: rgba(248, 231, 201, 0.8);">
            {{ __('We would be honored to partner with you in promoting mental health, personal wellbeing, and positive development.') }}
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <a href="{{ route('services') }}" class="btn fw-bold rounded-pill shadow-lg px-5 py-3 custom-hover-lift" style="background-color: var(--bg-light); color: var(--primary);">
                {{ __('Explore Our Services') }}
            </a>
            <a href="{{ route('book') }}" class="btn fw-bold rounded-pill px-5 py-3 text-white custom-hover-white" style="border: 2px solid rgba(248, 231, 201, 0.5); transition: all 0.3s ease;">
                {{ __('Book a Consultation') }}
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
</style>

@endsection
