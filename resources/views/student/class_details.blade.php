<x-app-layout>
    <div>
        <div class="max-w-7xl mx-auto">
            <div class="mb-8 inline-flex items-center">
                <a href="{{ url()->previous() }}">
                    <x-heroicon-o-chevron-left class="ml-1 mr-2 w-6 h-6" />
                </a>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ $course->name }} @lang('trad.Course Details')
                </h1>
            </div>

            <div class="bg-indigo-600 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6 pb-6 text-center">
                    <div>
                        <p class="text-sm font-medium text-white">@lang('trad.Teacher')</p>
                        <p class="mt-1 text-lg text-white">{{ $teacher->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white">@lang('trad.Average Grade')</p>
                        <p class="mt-1 text-lg text-white">{{ number_format($averageGrade, 2, '.', '') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white">@lang('trad.Total Quizzes')</p>
                        <p class="mt-1 text-lg text-white">{{ $nonRepeatableQuizzes->count() + $repeatableQuizzes->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 inline-flex items-center">
                <x-heroicon-o-clipboard-document-list class="w-6 h-6 mr-2 ml-1 text-indigo-600" />
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    @lang('trad.Exams')
                </h1>
            </div>

            <div class="mt-6">
                @include('student.partials.details_table', ['quizzes' => $nonRepeatableQuizzes])
            </div>

            <div class="mt-8 inline-flex items-center">
                <x-heroicon-o-clipboard-document-list class="w-6 h-6 mr-2 ml-1 text-indigo-600" />
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    @lang('trad.Exercises')
                </h1>
            </div>

            <div class="mt-6">
                @include('student.partials.details_table', ['quizzes' => $repeatableQuizzes])
            </div>
        </div>
    </div>
</x-app-layout>
