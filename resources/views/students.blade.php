<x-app-layout>
    <form action="{{ route('students', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="bg-white dark:bg-gray-800 overflow-hidden max-w-7xl mx-auto shadow-sm sm:rounded-lg p-6 sm:px-6 lg:px-8 mt-4">
            <div class="grid grid-cols-6 gap-4">
                @if ($students->count() > 0)
                @foreach ($students as $student)
                <div class="bg-gray-200 dark:bg-gray-700 p-4 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition duration-300">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="selected_students[]" value="{{ $student->id }}" class="form-checkbox h-5 w-5 text-gray-600 dark:text-gray-400">
                        <span class="ml-2 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $student->user->name }}</span>
                    </label>
                </div>
                @endforeach
                @else
            </div>
            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{__('Seems like there arent any students to be added to your class!')}}</p>
            @endif
        </div>
        <div class="max-w-7xl mx-auto shadow-sm">
            <x-primary-button class="mt-4">
                {{__('Add Selected Students')}}
            </x-primary-button>
        </div>
        <div class="max-w-7xl mx-auto shadow-sm">
            <x-nav-link :href="route('courses.edit', $course->id)">
                {{__('Go back to view the class')}}
            </x-nav-link>
        </div>
    </form>
</x-app-layout>
