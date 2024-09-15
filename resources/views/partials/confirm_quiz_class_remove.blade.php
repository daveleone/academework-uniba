<x-modal name="confirm-quiz-deletion-{{ $course->id }}" focusable>
    <div class="max-w-md mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 bg-gray-100">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-yellow-100 rounded-full">
                <x-heroicon-o-user-minus class="w-6 h-6 text-yellow-600" />
            </div>
            <h2 class="mt-4 text-lg font-medium text-center text-gray-900">
                @lang('trad.Are you sure you want to remove this quiz from the class?')
            </h2>
            <p class="mt-2 text-sm text-center text-gray-600">
                @lang('trad.Once this quiz is removed all of their data related to this class will be permanently deleted')
            </p>
            <form method="post" action="{{ route('quiz.remove', ['course' => $course->id, 'quiz' => $quiz->id]) }}" class="mt-6">
                @csrf
                @method('DELETE')
                <div class="flex justify-end space-x-3">
                    <x-secondary-button x-on:click="$dispatch('close')" class="px-3 py-2 transition duration-150 ease-in-out hover:bg-gray-100 hover:shadow-lg hover:-translate-y-1">
                        @lang('trad.Cancel')
                    </x-secondary-button>
                    <x-danger-button class="px-3 py-2 transition duration-150 ease-in-out hover:bg-red-700 hover:shadow-lg hover:-translate-y-1">
                        <x-heroicon-o-user-minus class="w-4 h-4 mr-2" />
                        @lang('trad.Remove Quiz')
                    </x-danger-button>
                </div>
            </form>
        </div>
    </div>
</x-modal>
