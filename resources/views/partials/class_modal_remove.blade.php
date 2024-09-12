<x-modal name="confirm-course-deletion" :show="$errors->courseDelete->isNotEmpty()" focusable>
    <div class="p-6 bg-gray-100">
        <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full">
            <x-heroicon-o-exclamation-triangle class="w-6 h-6 text-red-600" />
        </div>
        <h2 class="mt-4 text-lg font-medium text-center text-gray-900">
            @lang('trad.Are you sure you want to delete this course?')
        </h2>
        <p class="mt-2 text-sm text-center text-gray-600">
            @lang('trad.Once this course is deleted all of its resources and data will be permanently deleted')
        </p>
        <form method="post" action="{{ route('courses.destroy', $course->id) }}" class="mt-6">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="px-3 py-2 transition duration-150 ease-in-out hover:bg-gray-100 hover:shadow-lg hover:-translate-y-1">
                    @lang('trad.Cancel')
                </x-secondary-button>
                <x-danger-button class="px-3 py-2 transition duration-150 ease-in-out hover:bg-red-700 hover:shadow-lg hover:-translate-y-1">
                    <x-heroicon-s-trash class="w-4 h-4 mr-2" />
                    @lang('trad.Delete Course')
                </x-danger-button>
            </div>
        </form>
    </div>
</x-modal>
