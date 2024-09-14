<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('trad.Welcome to Academe Work')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-fadeInUp { animation: fadeInUp 0.8s ease-out forwards; }
        .animate-float { animation: float 3s ease-in-out infinite; }
        *{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
<div class="min-h-screen flex flex-col">
    <header class="bg-white shadow-sm">
        <nav x-data="{ open: false, openLanguage: false }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <!-- Logo placeholder -->
                <div class="h-12 w-12 text-indigo-600">

                </div>
                <span class="text-2xl font-bold text-gray-900">Academe Work</span>
            </div>

            <div class="flex items-center space-x-4">




                @if(Auth::check())

                        <a href="{{ route('dashboard') }}" class="text-black hover:text-gray-500 transition duration-300 flex items-center transition ease-in-out duration-300 hover:-translate-y-1">
                            @lang('trad.Dashboard')
                        </a>
                @else
                        <a href="{{ route('login') }}" class="text-black hover:text-gray-500 transition duration-300 flex items-center transition ease-in-out duration-300 hover:-translate-y-1">
                            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            @lang('trad.Login')
                        </a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300 flex items-center transition ease-in-out duration-300 hover:-translate-y-1">
                            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            @lang('trad.Register')
                        </a>
                @endif


                    <div class="relative" @click.away="openLanguage = false" @close.stop="openLanguage = false">
                        <button @click="openLanguage = !openLanguage" class="text-gray-700 inline-flex items-center">
                            <x-heroicon-o-language class="w-5 h-5 ml-2 mr-1"/>
                            @lang('trad.Language')
                            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="openLanguage" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" x-cloak>
                            <div class="py-1">
                                <a href="{{ url('locale/en') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">@lang('trad.English')</a>
                                <a href="{{ url('locale/it') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">@lang('trad.Italian')</a>
                                <a href="{{ url('locale/es') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">@lang('trad.Spanish')</a>
                            </div>
                        </div>
                    </div>

            </div>
        </nav>
    </header>

    <main class="flex-grow">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <img src="{{ url('art/logo.svg') }}" class="text-center"/>
            </div>
            <div class="text-center mb-16 animate-fadeInUp">
                <h1 class="text-6xl font-extrabold text-gray-900 mb-4">
                    @lang('trad.Welcome to') <span class="text-indigo-600">Academe Work</span>
                </h1>
                <p class="text-2xl text-gray-600 font-semibold">
                    @lang('trad.Master the Knowledge')
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-16">
                <div class="bg-white p-8 rounded-xl shadow-lg animate-fadeInUp hover:shadow-xl transition duration-300 transform hover:-translate-y-1" style="animation-delay: 0.2s;">
                    <div class="text-indigo-600 mb-4 animate-float">
                        <x-heroicon-o-academic-cap class="h-16 w-16 mx-auto" />
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">@lang('trad.For Professors')</h2>
                    <p class="text-gray-600">@lang('trad.Create engaging exercises, evaluate performance, and track progress with our intuitive tools.')</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-lg animate-fadeInUp hover:shadow-xl transition duration-300 transform hover:-translate-y-1" style="animation-delay: 0.4s;">
                    <div class="text-indigo-600 mb-4 animate-float">
                        <svg class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">@lang('trad.For Students')</h2>
                    <p class="text-gray-600">@lang('trad.Access a wealth of exercises, practice effectively, and watch your progress soar across various subjects.')</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-lg animate-fadeInUp hover:shadow-xl transition duration-300 transform hover:-translate-y-1" style="animation-delay: 0.6s;">
                    <div class="text-indigo-600 mb-4 animate-float">
                        <svg class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">@lang('trad.Secure & Reliable')</h2>
                    <p class="text-gray-600">@lang('trad.Experience peace of mind with our robust platform, ensuring data privacy and a stable learning environment.')</p>
                </div>
            </div>

            <div class="text-center animate-fadeInUp" style="animation-delay: 0.8s;">
                <a href="{{ Auth::check() ? route('dashboard') : route('login') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                    @lang('trad.Start Your Journey')
                    <svg class="ml-2 -mr-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </main>

{{--    <footer class="bg-white border-t border-gray-200 mt-16">--}}
{{--        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 flex justify-between items-center">--}}
{{--            <p class="text-gray-500">@lang('trad.© 2024 Academe Work. All rights reserved.')</p>--}}
{{--            <div class="flex space-x-6">--}}
{{--                <a href="#" class="text-gray-400 hover:text-gray-500">--}}
{{--                    <span class="sr-only">Facebook</span>--}}
{{--                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">--}}
{{--                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />--}}
{{--                    </svg>--}}
{{--                </a>--}}
{{--                <a href="#" class="text-gray-400 hover:text-gray-500">--}}
{{--                    <span class="sr-only">Twitter</span>--}}
{{--                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">--}}
{{--                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />--}}
{{--                    </svg>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </footer>--}}
</div>
</body>
</html>
