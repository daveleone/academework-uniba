<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title> Academe Work</title>
        <link rel="icon" href="{{ asset('art/logo.png') }}" sizes="512x512">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(["resources/css/app.css", "resources/js/app.js"])
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    </head>

    <body class="bg-gray-50">
        <div class="min-h-screen flex flex-col">
            <header class="bg-white shadow-sm">
                @if(!Auth::check())
                    @include("components.nav-guest")
                @else
                    @include("layouts.navigation")
                @endif
            </header>


{{--            <!-- Page Heading -->--}}
{{--            @if (isset($header))--}}
{{--                <header class="bg-white shadow dark:bg-gray-800">--}}
{{--                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">--}}
{{--                        {{ $header }}--}}
{{--                    </div>--}}
{{--                </header>--}}
{{--            @endif--}}

            <!-- Page Content -->
            <main class="flex-grow">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    @if (session("success"))
                        <!-- Success alert -->
                        <div
                            id="success-alert"
                            class="my-5 flex items-center absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-lg border border-green-300 bg-green-50 p-4 text-sm text-green-800 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
                            role="alert"
                            onclick="hideAlert(this)"
                        >
                            <svg
                                class="me-3 inline h-4 w-4 flex-shrink-0"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"
                                />
                            </svg>
                            <span class="sr-only">@lang('trad.Info')</span>
                            <div>
                                <span class="font-medium">@lang('trad.Success')!</span>
                                {{ session("success") }}
                            </div>
                        </div>
                    @endif

                    @if (session("error"))
                        <!-- Error alert -->
                        <div
                            class="my-5 flex items-center absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded-lg border border-red-300 bg-red-50 p-4 text-sm text-red-800 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
                            role="alert"
                            onclick="hideAlert(this)"
                        >
                            <svg
                                class="me-3 inline h-4 w-4 flex-shrink-0"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"
                                />
                            </svg>
                            <span class="sr-only">@lang('trad.Info')</span>
                            <div>
                                <span class="font-medium">@lang('trad.Error')!</span>
                                {{ session("error") }}
                            </div>
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>
        </div>
        <script>
            function hideAlert(alertDiv) {
                alertDiv.animate(
                    [
                        { transform: 'translateY(0px)', opacity: 1 },
                        { transform: 'translateY(-0px)', opacity: 0 },
                    ],
                    {
                        duration: 500,
                        easing: 'ease-out',
                        fill: 'forwards',
                    },
                );

                setTimeout(() => {
                    alertDiv.classList.add('hidden');
                }, 500);
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    </body>
</html>
