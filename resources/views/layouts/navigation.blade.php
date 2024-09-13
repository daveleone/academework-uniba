<nav x-data="{ open: false, openLanguage: false }" class="bg-indigo-600 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-white" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if (auth()->user()->isTeacher())
                        <x-nav-link :href="route('subject.show')" :active="request()->routeIs('subject.show')" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-5 text-white hover:text-indigo-200 transition duration-150 ease-in-out">
                            <x-heroicon-o-book-open class="w-5 h-5 mr-2" />
                            @lang('trad.My subjects')
                        </x-nav-link>

                        <x-nav-link :href="route('quiz.index')" :active="request()->routeIs('quiz.index')" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-5 text-white hover:text-indigo-200 transition duration-150 ease-in-out">
                            <x-heroicon-o-clipboard class="w-5 h-5 mr-2" />
                            @lang('trad.My quizzes')
                        </x-nav-link>

                        <x-nav-link :href="route('courses.show')" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-5 text-white hover:text-indigo-200 transition duration-150 ease-in-out">
                            <x-heroicon-o-academic-cap class="w-5 h-5 mr-2" />
                            @lang('trad.My classes')
                        </x-nav-link>
                    @endif

                    @if(auth()->user()->isStudent())
                        <x-nav-link :href="route('student.show')" :active="request()->routeIs('student.show')" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-5 text-white hover:text-indigo-200 transition duration-150 ease-in-out">
                            <x-heroicon-o-user-group class="w-5 h-5 mr-2" />
                            @lang('trad.My classes')
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <x-heroicon-o-user class="w-5 h-5 mr-2" />
                            @lang('trad.Profile')
                        </x-dropdown-link>

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

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <x-heroicon-o-arrow-right-start-on-rectangle class="w-5 h-5 mr-2" />
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-200 hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500 focus:text-gray-200 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden bg-indigo-700">
        <div class="pt-2 pb-3 space-y-1">
            @if (auth()->user()->isTeacher())
                <x-responsive-nav-link :href="route('subject.show')" :active="request()->routeIs('subject.show')" class="flex items-center pl-3 pr-4 py-2 border-l-4 text-base font-medium text-white hover:bg-indigo-600 transition duration-150 ease-in-out">
                    <x-heroicon-o-book-open class="w-5 h-5 mr-2" />
                    @lang('trad.My subjects')
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('quiz.index')" :active="request()->routeIs('quiz.index')" class="flex items-center pl-3 pr-4 py-2 border-l-4 text-base font-medium text-white hover:bg-indigo-600 transition duration-150 ease-in-out">
                    <x-heroicon-o-clipboard class="w-5 h-5 mr-2" />
                    @lang('trad.My quizzes')
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('courses.show')" class="flex items-center pl-3 pr-4 py-2 border-l-4 text-base font-medium text-white hover:bg-indigo-600 transition duration-150 ease-in-out">
                    <x-heroicon-o-academic-cap class="w-5 h-5 mr-2" />
                    @lang('trad.My classes')
                </x-responsive-nav-link>
            @endif

            @if(auth()->user()->isStudent())
                <x-responsive-nav-link :href="route('student.show')" :active="request()->routeIs('student.show')" class="flex items-center pl-3 pr-4 py-2 border-l-4 text-base font-medium text-white hover:bg-indigo-600 transition duration-150 ease-in-out">
                    <x-heroicon-o-user-group class="w-5 h-5 mr-2" />
                    @lang('trad.My classes')
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-indigo-800">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-indigo-300">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center pl-3 pr-4 py-2 border-l-4 text-base font-medium text-white hover:bg-indigo-600 transition duration-150 ease-in-out">
                    <x-heroicon-o-user class="w-5 h-5 mr-2" />
                    @lang('trad.Profile')
                </x-responsive-nav-link>

                <!-- Responsive Language Options -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center w-full pl-3 pr-4 py-2 border-l-4 text-base font-medium text-white hover:bg-indigo-600 transition duration-150 ease-in-out">
                        <x-heroicon-o-language class="w-5 h-5 mr-2" />
                        @lang('trad.Language')
                        <x-heroicon-o-chevron-down class="w-5 h-5 ml-auto" />
                    </button>
                    <div x-show="open" class="bg-indigo-800 pl-8" style="display: none;">
                        <a href="{{ url('locale/en') }}" class="block py-2 text-base font-medium text-white hover:bg-indigo-700">
                            @lang('trad.English')
                        </a>
                        <a href="{{ url('locale/it') }}" class="block py-2 text-base font-medium text-white hover:bg-indigo-700">
                            @lang('trad.Italian')
                        </a>
                        <a href="{{ url('locale/es') }}" class="block py-2 text-base font-medium text-white hover:bg-indigo-700">
                            @lang('trad.Spanish')
                        </a>
                    </div>
                </div>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center pl-3 pr-4 py-2 border-l-4 text-base font-medium text-white hover:bg-indigo-600 transition duration-150 ease-in-out">
                        <x-heroicon-o-arrow-right-start-on-rectangle class="w-5 h-5 mr-2" />
                        @lang('trad.Log Out')
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
