<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{config('app.name') . ($title ?? '' ? " - " . $title : "")}}</title>

    <link rel="apple-touch-icon" href="{{asset('assets/backend/img/logos/favicon.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/backend/img/logos/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/boxicons/css/boxicons.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/fontawesome/css/all.min.css')}}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/7.1.0/css/flag-icons.min.css" rel="stylesheet">
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/backend/css/basic-styles.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/backend/css/theme-styles.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/backend/css/custom-style.css')}}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
    <!-- Vendor Styles -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
    <!-- Form Components Styles -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    @stack('styles')
    
    <style>
        html, body {
            font-size: 15px !important;
        }
    </style>

    <!-- Frontend Matching Styling -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bs-font-sans-serif: 'Public Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
            --bs-primary: #006DAF;
            --bs-primary-rgb: 0, 109, 175;
            --bs-success: #4BC261;
            --bs-success-rgb: 75, 194, 97;
            --bs-secondary: #0B1A2E;
            --bs-body-font-family: 'Public Sans', sans-serif;
        }

        body {
            font-family: 'Public Sans', sans-serif !important;
            font-size: 0.9375rem; /* 15px */
            background-color: #f5f5f9;
        }

        h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
            font-family: 'Public Sans', sans-serif !important;
            font-weight: 500;
            color: #566a7f;
        }

        .text-primary { color: #006DAF !important; }
        .bg-primary { background-color: #006DAF !important; }
        .text-success { color: #4BC261 !important; }

        .btn-primary {
            background-color: #006DAF !important;
            border-color: #006DAF !important;
            box-shadow: 0 4px 6px rgba(0, 109, 175, 0.2);
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #005a91 !important;
            border-color: #005a91 !important;
            transform: translateY(-1px);
        }

        .btn-success {
            background-color: #4BC261 !important;
            border-color: #4BC261 !important;
            box-shadow: 0 4px 6px rgba(75, 194, 97, 0.2);
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-success:hover {
            background-color: #3ca950 !important;
            border-color: #3ca950 !important;
            transform: translateY(-1px);
        }

        .app-brand {
            padding: 1.5rem 1rem !important;
        }

        .app-brand-text {
            font-size: 1.25rem;
            letter-spacing: -0.5px;
            color: #0B1A2E !important;
            text-transform: uppercase;
        }

        .card {
            border: 0 !important;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(161, 172, 184, 0.4) !important;
            transition: box-shadow 0.2s ease-in-out;
            background-clip: padding-box;
        }

        .card:hover {
            box-shadow: 0 0.25rem 0.5rem rgba(161, 172, 184, 0.4) !important;
        }

        .card-header {
            background-color: transparent !important;
            border-bottom: 0 !important;
            padding: 1.5rem 1.5rem 0 1.5rem;
        }

        .bg-label-primary {
            background: rgba(0, 109, 175, 0.1) !important;
            color: #006DAF !important;
        }

        .bg-label-success {
            background: rgba(75, 194, 97, 0.1) !important;
            color: #4BC261 !important;
        }
    </style>
</head>
<body>
<div class="layout-wrapper layout-content-navbar ">
    <div class="layout-container">
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-white">
            @include('components.backend.backend-navigation')
        </aside>
        <!-- Layout page -->
        <div class="layout-page">
            <nav
                class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                id="layout-navbar">
                @include('components.backend.backend-header')
            </nav>

            <div class="content-wrapper">
                <div class="container-xxl p-0">
                    {{$slot}}
                </div>
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        @include('components.backend.backend-footer')
                    </div>
                </footer>
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"
         style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>
</div>

<livewire:backend.global-search />

@include('components.backend.includes.foot')
<div class="content-backdrop fade"></div>
</body>
</html>
