<x-modal name="create-subject">
    <div class="max-w-md mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="px-24 py-6 bg-indigo-600">
            <h2 class="text-2xl font-bold text-white text-center">
                @lang('trad.Create New Subject')
            </h2>
        </div>
        <form class="px-8 py-6 space-y-6" action="{{ route('subject.create') }}" method="POST">
            @method('POST')
            @csrf
            <div>
                <label for="SubName" value="__('trad.Subject\'s name')" class="block text-sm font-medium text-gray-700">
                    @lang('trad.Subject Name')
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <x-heroicon-o-bookmark class="w-5 h-5 text-gray-400" />
                    </div>
                    <input type="text" name="SubName" id="SubName"
                           class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md"
                           required autofocus dusk="create-subject-name">
                </div>
            </div>
            <div>
                <label for="SubDescription" value="__('trad.Subject\'s Description')" class="block text-sm font-medium text-gray-700">
                    @lang('trad.Subject Description')
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <x-heroicon-o-bars-3-bottom-left class="w-5 h-5 text-gray-400" />
                    </div>
                    <textarea type="text" name="SubDescription" id="SubDescription"
                           class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md"
                           required dusk="create-subject-description"></textarea>
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between space-x-4">
                    <button type="submit" class="group w-1/2 inline-flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1" dusk="submit-create-subject">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <x-heroicon-s-plus-circle class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" />
                        </span>
                        @lang('trad.Create Subject')
                    </button>

                    <a class="group w-1/2 flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1"
                       x-on:click="$dispatch('close')">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <x-heroicon-s-x-circle class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" />
                        </span>
                        @lang('trad.Cancel')
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-modal>
