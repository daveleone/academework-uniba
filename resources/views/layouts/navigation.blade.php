<header class="bg-white shadow-sm">
    <nav x-data="{ open: false, openLanguage: false }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <div class="h-12 w-12 text-indigo-600">
                <!-- Empty for a reason-->
            </div>
            <a href="{{ route('welcome') }} " class="text-2xl font-bold text-gray-900">Academe Work</a>
        </div>



        <div class="flex items-center space-x-4">
            @if (auth()->user()->isTeacher())
                <a href="{{ route('subject.show') }}" class="text-black hover:text-gray-500 transition duration-300 flex items-center transition ease-in-out duration-300 hover:-translate-y-1">
                    <x-heroicon-o-book-open class="w-6 h-6 mr-2" />
                    @lang('trad.My subjects')
                </a>
                <a href="{{ route('exercise.index') }}" class="text-black hover:text-gray-500 transition duration-300 flex items-center transition ease-in-out duration-300 hover:-translate-y-1">
                    <x-heroicon-o-bookmark class="w-6 h-6 mr-2" />
                    @lang('trad.My exercises')
                </a>
                <a href="{{ route('quiz.index') }}" class="text-black hover:text-gray-500 transition duration-300 flex items-center transition ease-in-out duration-300 hover:-translate-y-1">
                    <x-heroicon-o-clipboard class="w-6 h-6 mr-2" />
                    @lang('trad.My quizzes')
                </a>
                <a href="{{ route('courses.show') }}" class="text-black hover:text-gray-500 transition duration-300 flex items-center transition ease-in-out duration-300 hover:-translate-y-1">
                    <x-heroicon-o-academic-cap class="w-6 h-6 mr-2" />
                    @lang('trad.My classes')
                </a>
            @elseif(auth()->user()->isStudent())
                <a href="{{ route('student.show') }}" class="text-black hover:text-gray-500 transition duration-300 flex items-center transition ease-in-out duration-300 hover:-translate-y-1">
                    <x-heroicon-o-user-group class="w-6 h-6 mr-2" />
                    @lang('trad.My classes')
                </a>
            @endif

                <a href="{{ route('dashboard') }}" class="text-black hover:text-gray-500 transition duration-300 flex items-center transition ease-in-out duration-300 hover:-translate-y-1">
                    <x-heroicon-o-chart-pie class="w-6 h-6 mr-2" />
                    @lang('trad.Dashboard')
                </a>


        <!-- Right side (User dropdown) -->
        <div class="flex items-center">
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button dusk="dropdown" class="text-gray-700 inline-flex items-center">
                            {{ Auth::user()->name }}
                            <div class="ml-1">
                                <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center px-4 py-2 text-base text-gray-700 hover:bg-gray-100">
                            <x-heroicon-o-user class="w-6 h-6 mr-2"/>
                            @lang('trad.Profile')
                        </x-dropdown-link>

                        <!-- Language Subdropdown -->
                        <div x-data="{ open: false }" @click.away="open = false" class="relative">
                            <button @click.stop="open = !open" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <x-heroicon-o-language class="w-6 h-6 mr-2" />
                                    @lang('trad.Language')
                                <x-heroicon-o-chevron-right class="w-6 h-6 ml-auto" />
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
                            <x-dropdown-link dusk="logout-button" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center px-4 py-2 text-base text-gray-700 hover:bg-gray-100">
                                <x-heroicon-o-arrow-right-start-on-rectangle class="w-6 h-6 mr-2" />
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>
</header>
