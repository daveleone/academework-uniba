<nav x-data="{ open: false, openLanguage: false }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
    <div class="flex items-center space-x-2">
        <!-- Logo placeholder -->
        <div class="h-12 w-12 text-indigo-600">

        </div>
        <a href="{{ route('welcome') }}" class="text-2xl font-bold text-gray-900">Academe Work</a>
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
