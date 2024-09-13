<x-app-layout>
    <div class="bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">

                <div class="mb-8 inline-flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-heroicon-o-chevron-left class="ml-1 mr-2 w-6 h-6" />
                    </a>
                    <h2 class="font-bold text-3xl text-gray-900 leading-tight">
                        @lang('trad.Subjects')
                    </h2>
                </div>
                <a x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-subject')" class="cursor-pointer inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-300 hover:-translate-y-1">
                    <x-heroicon-s-plus class="w-5 h-5 mr-2" />
                    @lang('trad.Add subject')
                </a>
            </div>

            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($subjects as $subject)
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="p-6">
                                <x-heroicon-o-bookmark class="w-7 h-7" />
                                <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">{{ $subject->name }}</h3>
                                <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $subject->description }}</p>
                                <div class="flex justify-between items-center">
                                    <a href="{{ route('subject.topics', ['id' => $subject->id]) }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                                        @lang('trad.View Topics')
                                    </a>
                                    <div class="flex space-x-2">
                                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-subject-{{ $subject->id }}')" class="text-gray-600 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-300">
                                            <x-heroicon-o-pencil class="w-5 h-5" />
                                        </button>
                                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'delete-subject-{{ $subject->id }}')" class="text-gray-600 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400">
                                            <x-heroicon-o-trash class="w-5 h-5" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('forms.subject.create')
    @foreach ($subjects as $subject)
        @include('forms.subject.edit', ['subject' => $subject])
        @include('forms.subject.delete', ['subject' => $subject])
    @endforeach
</x-app-layout>
