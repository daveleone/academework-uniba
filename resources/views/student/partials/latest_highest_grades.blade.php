

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition duration-300 ease-in-out">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <x-heroicon-o-academic-cap class="w-8 h-8 text-indigo-600 mr-3" />
                <h2 class="text-2xl font-bold text-gray-900">@lang('trad.Recent Grades')</h2>
            </div>
            <span class="text-sm text-gray-500">@lang('trad.Last 5 quizzes')</span>
        </div>

        @if($nonRepeatableQuizzes->count() > 0)
            <ul class="space-y-6">
                @foreach($nonRepeatableQuizzes as $mark)

                    @php
                        $maxPoints = 0;

                        $exercises_quiz = \App\Models\exercise_quiz::where('quiz_id', $mark->quiz->id)->get();
                        foreach ($exercises_quiz as $eq)
                        {
                            $exercises = \App\Models\Exercise::whereIn('id', $eq)->get();
                        }

                        foreach ($exercises as $ex)
                        {
                            $maxPoints += $ex->points;
                        }
                    @endphp


                    <li class="bg-gradient-to-r from-indigo-50 to-white p-5 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex justify-between items-start">
                            <div class="flex-grow">
                                <div class="flex items-center mb-3">
                                    <a href="{{ route('student.exercises', $mark->quiz->course_quiz->course->id) }}" class="mr-3 bg-indigo-100 rounded-full p-2 hover:bg-indigo-200 transition-colors duration-200">
                                        <x-heroicon-o-clipboard-document-check class="w-6 h-6 text-indigo-600"/>
                                    </a>
                                    <h3 class="text-xl font-semibold text-gray-900">{{ $mark->quiz->name }}</h3>
                                </div>
                                <p class="text-sm text-gray-600 mb-2">
                                    <x-heroicon-o-academic-cap class="w-4 h-4 inline mr-1" />
                                    {{ $mark->quiz->course_quiz->course->course_name }}
                                </p>
                                <div class="flex items-center text-sm text-gray-500">
                                    <x-heroicon-o-calendar class="w-4 h-4 mr-1" />
                                    <span>{{ $mark->created_at->format('d M, H:i') }}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-block bg-green-100 text-green-800 text-lg font-semibold px-3 py-1 rounded-full">
                                    {{ $mark->mark }} / {{ $maxPoints }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <a href="{{ route('student.exercises', $mark->quiz->course_quiz->course->id) }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200">
                                @lang('trad.View Details')
                                <x-heroicon-s-arrow-right class="ml-1 w-4 h-4" />
                            </a>
                        </div>
                    </li>
                @endforeach
                    <div class="mt-6">
                        {{ $nonRepeatableQuizzes->appends(['marks' => request()->marks])->links() }}
                    </div>
            </ul>
        @else
            <div class="text-center py-12 bg-gradient-to-r from-indigo-50 to-white rounded-xl">
                <x-heroicon-o-face-smile class="mx-auto h-16 w-16 text-indigo-400" />
                <h3 class="mt-4 text-xl font-semibold text-gray-900">@lang('trad.No grades yet')</h3>
                <p class="mt-2 text-base text-gray-600">@lang('trad.Complete some quizzes to see your grades here')</p>
                <p class="mt-4 text-sm text-indigo-600">@lang('trad.Keep up the good work!')</p>
            </div>
        @endif
    </div>
</div>
