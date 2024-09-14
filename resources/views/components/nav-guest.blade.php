<nav x-data="{ open: false, openLanguage: false }" class="bg-indigo-600 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left side (Logo) -->
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-white" />
                    </a>
                </div>
            </div>

            <!-- Right side (Guest dropdown) -->
            <div class="flex items-center">
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none transition ease-in-out duration-150">
                                <div>@lang('trad.Guest')</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Language Subdropdown -->
                            <div x-data="{ open: false }" @click.away="open = false" class="relative">
                                <button @click.stop="open = !open" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <x-heroicon-o-language class="w-5 h-5 mr-2" />
                                    @lang('trad.Language')
                                    <x-heroicon-o-chevron-right class="w-5 h-5 ml-auto" />
                                </button>
                                <div x-show="open" class="absolute left-full top-0 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" style="display: none;">
                                    <a href="{{ url('locale/en') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        @lang('trad.English')
                                    </a>
                                    <a href="{{ url('locale/it') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        @lang('trad.Italian')
                                    </a>
                                    <a href="{{ url('locale/es') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        @lang('trad.Spanish')
                                    </a>
                                </div>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</nav>
