<section class="space-y-6">
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        @lang('trad.Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.')
    </p>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-300 hover:-translate-y-1"
    >
        <x-heroicon-s-trash class="w-5 h-5 mr-2" />
        @lang('trad.Delete Account')
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                @lang('trad.Are you sure you want to delete your account?')
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                @lang('trad.Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.')
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="mr-3">
                    @lang('trad.Cancel')
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    @lang('trad.Delete Account')
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
