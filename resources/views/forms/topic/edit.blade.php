<x-modal name="edit-topic-{{ $topic->id }}">
    <div class="max-w-md mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="px-40 py-6 bg-indigo-600">
            <h2 class="text-2xl font-bold text-white text-center">
                @lang('trad.Edit') {{ $topic->name }}
            </h2>
        </div>
        <form class="px-8 py-6 space-y-6" action="{{ route('topic.edit', ['id' => $subject->id]) }}) }}" method="POST">
            @method('PUT')
            @csrf
            <input type="hidden" name="topId" value="{{ $topic->id }}">
            <div>
                <label for="{{ 'topName'.$topic->id }}" class="block text-sm font-medium text-gray-700">
                    @lang('trad.Topic\'s name')
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <x-heroicon-o-book-open class="w-5 h-5 text-gray-400" />
                    </div>
                    <input type="text" name="{{ 'topName'.$topic->id }}" id="{{ 'topName'.$topic->id }}"
                           class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md"
                           value="{{ $topic->name }}">
                </div>
            </div>
            <div>
                <label for="{{ 'topDesc'.$topic->id }}" class="block text-sm font-medium text-gray-700">
                    @lang('trad.Topic\'s Description')
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 pt-2">
                        <x-heroicon-o-document-text class="w-5 h-5 text-gray-400" />
                    </div>
                    <textarea id="{{ 'topDesc'.$topic->id }}" name="{{ 'topDesc'.$topic->id }}" rows="4"
                              class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md">{{ $topic->description }}</textarea>
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between space-x-4">
                    <button type="submit" class="group w-1/2 inline-flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-2">
                            <x-heroicon-s-pencil class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" />
                        </span>
                        @lang('trad.Edit topic')
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

