<x-app-layout>
    <div class="py-12">
        @if($courses->count() > 0)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-6 gap-4">
                    @foreach ($courses as $course)
                        <div class="w-full clickable-course cursor-pointer" data-href="{{ route('courses.edit', $course->id) }}">
                            <div class="bg-gray-200 dark:bg-gray-700 p-4 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition duration-300">
                                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{$course->course_name}}</p>
                                <p class="text-gray-700 dark:text-gray-300">{{$course->course_description}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __("You dont have any classes.")}}</p>
            </div>
        </div>
        @endif
    </div>

    <script>
        document.querySelectorAll('.clickable-course').forEach(function(div) {
            div.addEventListener('click', function() {
                var href = this.getAttribute('data-href');

                window.location.href = href;
            });
        });
    </script>
</x-app-layout>
