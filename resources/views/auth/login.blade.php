<x-app-layout>
    <div class="">
        <div class="max-w-3xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div class="inline-flex items-center">
                    <h1 class="text-3xl font-bold text-gray-900">
                        @lang('trad.Login')
                    </h1>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}"
                          x-data="loginForm"
                          @submit="submitForm">
                        @csrf

                        <div class="mt-4">
                            <x-input-label for="email">@lang('trad.Email')</x-input-label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <x-heroicon-o-envelope class="h-5 w-5 text-gray-400" />
                                </div>
                                <x-text-input id="email" class="block w-full pl-10" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="password">@lang('trad.Password')</x-input-label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <x-heroicon-o-lock-closed class="h-5 w-5 text-gray-400" />
                                </div>
                                <x-text-input id="password" class="block w-full pl-10 pr-10"
                                              type="password" name="password"
                                              required autocomplete="current-password" />
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <!-- Button per mostrare/nascondere la password -->
                                    <button type="button" id="toggle-password" class="focus:outline-none">
                                        <!-- Mostra l'icona dell'occhio aperto (inizialmente nascosta) -->
                                        <x-heroicon-o-eye id="show-eye" class="h-5 w-5 text-gray-400 hidden" />
                                        <!-- Mostra l'icona dell'occhio sbarrato (inizialmente visibile) -->
                                        <x-heroicon-o-eye-slash id="hide-eye" class="h-5 w-5 text-gray-400" />
                                    </button>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>


                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox"
                                       class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                       name="remember">
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                    @lang('trad.Remember me')
                                </span>
                            </label>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    @lang('trad.Forgot your password?')
                                </a>
                            @endif

                            <div class="flex items-center">
                                <!-- Pulsante per tornare alla pagina di registrazione -->
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-300 hover:-translate-y-1">
                                    <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                    @lang('trad.Register')
                                </a>

                                <!-- Pulsante di login -->
                                <x-primary-button class="ml-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 transition ease-in-out duration-300 hover:-translate-y-1">
                                    <x-heroicon-o-arrow-left-start-on-rectangle class="h-5 w-5 mr-2" />
                                    @lang('trad.Login')
                                </x-primary-button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordButton = document.getElementById('toggle-password');
            const passwordField = document.getElementById('password');
            const showEyeIcon = document.getElementById('show-eye');
            const hideEyeIcon = document.getElementById('hide-eye');

            togglePasswordButton.addEventListener('click', function() {
                // Controlla il tipo di input e alterna tra 'password' e 'text'
                const isPasswordHidden = passwordField.type === 'password';
                passwordField.type = isPasswordHidden ? 'text' : 'password';

                // Alterna la visibilità delle icone
                showEyeIcon.classList.toggle('hidden', !isPasswordHidden);
                hideEyeIcon.classList.toggle('hidden', isPasswordHidden);
            });
        });
    </script>

</x-app-layout>
