<x-modal name="delete-topic-{{ $topic->id }}" focusable>
    <div class="max-w-md mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 bg-gray-100">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-yellow-100 rounded-full">
                <x-heroicon-o-user-minus class="w-6 h-6 text-yellow-600" />
            </div>
            <h2 class="mt-4 text-lg font-medium text-center text-gray-900">
                @lang('trad.Are you sure you want to delete this topic?')
            </h2>
            <p class="mt-2 text-sm text-center text-gray-600">
                @lang('trad.Once this topic is deleted all of its data will be permanently deleted')
            </p>
            <form method="post" action="{{ route('topic.delete', ['id' => $subject->id]) }}" class="mt-6">
                @csrf
                @method('DELETE')
                <div class="flex justify-end space-x-3">
                    <x-secondary-button x-on:click="$dispatch('close')" class="px-3 py-2 transition duration-150 ease-in-out hover:bg-gray-100 hover:shadow-lg hover:-translate-y-1">
                        @lang('trad.Cancel')
                    </x-secondary-button>
                    <input type="hidden" name="topId" value="{{ $topic->id }}">
                    <x-danger-button class="px-3 py-2 transition duration-150 ease-in-out hover:bg-red-700 hover:shadow-lg hover:-translate-y-1" dusk="submit-delete-topic">
                        <x-heroicon-o-user-minus class="w-4 h-4 mr-2" />
                        @lang('trad.Delete topic')
                    </x-danger-button>
                </div>
            </form>
        </div>
    </div>
</x-modal>


