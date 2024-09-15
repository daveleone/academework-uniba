{{--<x-app-layout>--}}
{{--    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">--}}
{{--        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">--}}
{{--            <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">{{ $course->name }} @lang('trad.Course Details')</h2>--}}
{{--            <p class="text-gray-700 dark:text-gray-300"><strong class="text-gray-900 dark:text-white">@lang('trad.Teacher'):</strong> {{ $teacher->name }}</p>--}}
{{--            <p class="text-gray-700 dark:text-gray-300"><strong class="text-gray-900 dark:text-white">@lang('trad.Average Grade (Non-repeatable Quizzes):')</strong> {{ number_format($averageGrade, 2, '.', '') }}</p>--}}

{{--            <h3 class="text-xl font-semibold mt-6 mb-2 text-gray-900 dark:text-white">@lang('trad.Non-Repeatable Quiz Grades')</h3>--}}
{{--            @include('student.partials.details_table', ['quizzes' => $nonRepeatableQuizzes])--}}

{{--            <h3 class="text-xl font-semibold mt-6 mb-2 text-gray-900 dark:text-white">@lang('trad.Repeatable Quiz Grades')</h3>--}}
{{--            @include('student.partials.details_table', ['quizzes' => $repeatableQuizzes])--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}

<x-app-layout>
    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8 inline-flex items-center">
                <a href="{{ route('student.exercises', $course->id) }}">
                    <x-heroicon-o-chevron-left class="ml-1 mr-2 w-6 h-6" />
                </a>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ $course->name }} @lang('trad.Course Details')
                </h1>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <p class="text-gray-700 dark:text-gray-300"><strong class="text-gray-900 dark:text-white">@lang('trad.Teacher'):</strong> {{ $teacher->name }}</p>
                <p class="text-gray-700 dark:text-gray-300"><strong class="text-gray-900 dark:text-white">@lang('trad.Average Grade (Non-repeatable Quizzes)'):</strong> {{ number_format($averageGrade, 2, '.', '') }}</p>
            </div>

            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">@lang('trad.Non-Repeatable Quiz Grades')</h3>
                @include('student.partials.details_table', ['quizzes' => $nonRepeatableQuizzes])
            </div>

            <div>
                <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">@lang('trad.Repeatable Quiz Grades')</h3>
                @include('student.partials.details_table', ['quizzes' => $repeatableQuizzes])
            </div>
        </div>
    </div>
</x-app-layout>
