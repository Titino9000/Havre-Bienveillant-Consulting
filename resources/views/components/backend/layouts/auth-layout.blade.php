<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{config('app.name')." - Authentication"}}</title>
    <link rel="apple-touch-icon" href="{{asset('assets/backend/img/logos/favicon.png')}}"> {{--{{Storage::disk('local')->url($siteFavicon->value)}}--}}
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/backend/img/logos/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/boxicons/css/boxicons.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/fontawesome/css/all.min.css')}}" />
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
<div class="container mt-5 w-25">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            @yield('content')
        </div>
    </div>
</div>
@include('components.backend.includes.foot')
</body>
</html>

