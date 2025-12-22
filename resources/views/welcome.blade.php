<?php use App\Constants; ?>

<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>{{ config('app.name') }} - {{ Constants::TITLE_WELCOME_PAGE }}</title>
    
    <link rel="author" href="/{{ Constants::ROUTE_ABOUT }}">

    <link rel="stylesheet" href="{{ asset(Constants::URL_STYLES) }}">

    <style>
        a.gradient-button {
            background: linear-gradient(225deg, #E04F67, #7B1E6A);
            background-position: left center;
            background-size: 200% 100%;
            transition: background-position 300ms ease-in-out;
        }
        
        a.gradient-button:hover {
            background-position: right center;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <div class="bg-white">
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8">
                <a class="-m-1.5 p-1.5">
                    <span class="application-name text-xl">{{ config('app.name') }}</span>
                </a>
                
                <span class="-m-1.5 p-1.5 text-gray-400">Made with ♥ by Ariel Machini</span>
            </nav>
        </header>
        
        <div class="isolate px-6 lg:px-8 relative">
            <div aria-hidden="true" class="absolute blur-3xl inset-x-0 overflow-hidden -top-40 sm:-top-80 transform-gpu -z-10">
                <div style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%);" class="aspect-1155/678 bg-linear-to-tr from-[#FF80B5] to-[#9089FC] left-[calc(50%-11rem)] sm:left-[calc(50%-30rem)] opacity-40 relative rotate-60 -translate-x-1/2 w-144.5 sm:w-288.75"></div>
            </div>
            
            <div class="max-w-3xl mx-auto py-32">
                <div class="hidden sm:flex sm:justify-center sm:mb-8">
                    <div class="px-3 py-1 relative ring-1 ring-gray-900/10 hover:ring-gray-900/20 rounded-full text-gray-600 text-sm/6">
                        You can learn more about our usability model by <a class="font-semibold text-indigo-600" href="{{ Constants::ROUTE_MODEL }}"><span aria-hidden="true" class="absolute inset-0"></span>clicking here <span aria-hidden="true">&rarr;</span></a>
                    </div>
                </div>
                
                <div class="text-center">
                    <h2 class="font-semibold text-5xl sm:text-7xl text-balance text-gray-900 tracking-tight">Study the usability of your web APIs, free of charge.</h2>
                    
                    <p class="font-medium mt-8 text-gray-500 text-lg text-pretty sm:text-xl/8">In a competitive market, usability can define the value of an API, and therefore, it can also define its success.</p>
                </div>
                
                <div class="flex gap-x-6 items-center justify-center mt-10">
                    <a class="focus-visible:outline-2 focus-visible:outline-offset-2 font-semibold gradient-button rounded-lg px-3.5 py-2.5 text-sm text-white" href="{{ Constants::ROUTE_ASSESSMENT }}" title="Obtain a usability score for your web API">Get started</a>
                    <span class="text-gray-500 text-sm/6">or</span> <a class="font-semibold text-gray-900 text-sm/6" href="{{ Constants::ROUTE_RESTORE }}" title="Restore your saved progress with a code">Restore your progress</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>