<?php use App\Constants; ?>

<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name') }} - {{ $pageTitle }}</title>

    <link rel="author" href="/{{ Constants::ROUTE_ABOUT }}">

    <link rel="stylesheet" href="{{ asset(Constants::URL_STYLES) }}">
    <link rel="stylesheet" href="{{ asset(Constants::FOLDER_CSS . 'bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg sticky-top text-bg-dark">
        <div class="container-fluid">
            <a class="application-name navbar-brand" href="/">{{ config('app.name') }}</a>

            <button aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-bs-target="#mainNavbar" data-bs-toggle="collapse" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="me-auto my-2 my-lg-0 navbar-nav">
                    <li class="nav-item">
                        <x-nav-link href="/{{ Constants::ROUTE_ASSESSMENT }}" title="Obtain a usability score for your web API" :active="request()->is(Constants::ROUTE_ASSESSMENT . '/*')">
                            <i class="bi bi-clipboard2-check-fill pe-2"></i>Assess
                        </x-nav-link>
                    </li>

                    <li class="nav-item">
                        <x-nav-link href="/{{ Constants::ROUTE_RESTORE }}" title="Restore your saved progress with a code" :active="request()->is(Constants::ROUTE_RESTORE)">
                            <i class="bi bi-cloud-download-fill pe-2"></i>Restore
                        </x-nav-link>
                    </li>

                    <li class="nav-item">
                        <x-nav-link href="/{{ Constants::ROUTE_MODEL }}" :active="request()->is(Constants::ROUTE_MODEL)">
                            <i class="bi bi-diagram-2-fill pe-2"></i>Model
                        </x-nav-link>
                    </li>

                    <li class="nav-item">
                        <x-nav-link href="/{{ Constants::ROUTE_SOURCES }}" :active="request()->is(Constants::ROUTE_SOURCES)">
                            <i class="bi bi-book-half pe-2"></i>Sources
                        </x-nav-link>
                    </li>

                    <li class="nav-item">
                        <x-nav-link href="/{{ Constants::ROUTE_ABOUT }}" :active="request()->is(Constants::ROUTE_ABOUT)">
                            <i class="bi bi-question-circle-fill pe-2"></i>About
                        </x-nav-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mb-5 mt-5">
        <h3 class="mb-4">{{ $pageTitle }}</h3>
        {{ $slot }}
    </div>

    <script src="{{ asset(Constants::FOLDER_JS . 'bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>

</html>