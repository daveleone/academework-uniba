<x-app-layout>
    <div class="">
        <div class="max-w-3xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div class="inline-flex items-center">
                    <h1 class="text-3xl font-bold text-gray-900">
                        @lang('trad.Register')
                    </h1>
                </div>
            </div>

            <div x-data="{ activeForm: 'student' }" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-center mb-8">
                        <div class="inline-flex rounded-full p-1 bg-indigo-600">
                            <button @click="activeForm = 'student'"
                                    :class="{ 'bg-white text-indigo-600': activeForm === 'student', 'bg-transparent text-white': activeForm !== 'student' }"
                                    class="px-6 py-3 rounded-full font-bold transition-all duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <span class="flex items-center">
                                    <x-heroicon-o-academic-cap class="w-6 h-6 mr-2" />
                                    @lang('trad.Student')
                                </span>
                            </button>
                            <button @click="activeForm = 'teacher'"
                                    :class="{ 'bg-white text-indigo-600': activeForm === 'teacher', 'bg-transparent text-white': activeForm !== 'teacher' }"
                                    class="px-6 py-3 rounded-full font-bold transition-all duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <span class="flex items-center">
                                    <x-heroicon-o-user class="w-6 h-6 mr-2" />
                                    @lang('trad.Teacher')
                                </span>
                            </button>
                        </div>
                    </div>

                    <form id="registration-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="form_id" :value="activeForm + '-form'">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="name">@lang('trad.Name')</x-input-label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <x-heroicon-o-user class="h-5 w-5 text-gray-400" />
                                    </div>
                                    <x-text-input id="name" class="block w-full pl-10" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="surname">@lang('trad.Surname')</x-input-label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <x-heroicon-o-user class="h-5 w-5 text-gray-400" />
                                    </div>
                                    <x-text-input id="surname" class="block w-full pl-10" type="text" name="surname" :value="old('surname')" required />
                                </div>
                                <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="email">@lang('trad.Email')</x-input-label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <x-heroicon-o-envelope class="h-5 w-5 text-gray-400" />
                                </div>
                                <x-text-input id="email" class="block w-full pl-10" type="email" name="email" :value="old('email')" required />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="password">@lang('trad.Password')</x-input-label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <x-heroicon-o-lock-closed class="h-5 w-5 text-gray-400" />
                                </div>
                                <x-text-input id="password" class="block w-full pl-10 pr-10" type="password" name="password" required />
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

                        <div class="mt-4">
                            <x-input-label for="password_confirmation">@lang('trad.Confirm Password')</x-input-label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <x-heroicon-o-lock-closed class="h-5 w-5 text-gray-400" />
                                </div>
                                <x-text-input id="password_confirmation" class="block w-full pl-10" type="password" name="password_confirmation" required />
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div x-show="activeForm === 'student'"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="mt-4">
                            <x-input-label for="student_number">@lang('trad.Matriculation Number')</x-input-label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <x-heroicon-o-identification class="h-5 w-5 text-gray-400" />
                                </div>
                                <x-text-input id="student_number" class="block w-full pl-10" type="text" name="student_number" :value="old('student_number')" />
                            </div>
                            <x-input-error :messages="$errors->get('student_number')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                @lang('trad.Already registered?')
                            </a>


                            <x-primary-button class="ml-4 bg-indigo-600 hover:bg-indigo-400 focus:ring-indigo-500 transition ease-in-out duration-300 hover:-translate-y-1">

                                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                @lang('trad.Register')
                            </x-primary-button>

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
            const confirmPasswordField = document.getElementById('password_confirmation');
            const showEyeIcon = document.getElementById('show-eye');
            const hideEyeIcon = document.getElementById('hide-eye');

            togglePasswordButton.addEventListener('click', function() {
                // Controlla il tipo di input e alterna tra 'password' e 'text'
                const isPasswordHidden = passwordField.type === 'password';
                const newType = isPasswordHidden ? 'text' : 'password';
                passwordField.type = newType;
                confirmPasswordField.type = newType;

                // Alterna la visibilità delle icone
                showEyeIcon.classList.toggle('hidden', !isPasswordHidden);
                hideEyeIcon.classList.toggle('hidden', isPasswordHidden);
            });
        });
    </script>



@push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('registration', () => ({
                    activeForm: 'student',
                    init() {
                        this.$watch('activeForm', value => {
                            this.$nextTick(() => {
                                document.getElementById('registration-form').reset();
                            });
                        });
                    }
                }));
            });
        </script>
    @endpush
</x-app-layout>
