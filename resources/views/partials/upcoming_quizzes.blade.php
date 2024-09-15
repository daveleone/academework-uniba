<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition duration-300 ease-in-out">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <x-heroicon-o-clock class="w-8 h-8 text-indigo-600 mr-3" />
                <h2 class="text-2xl font-bold text-gray-900">@lang('trad.Upcoming Quizzes')</h2>
            </div>
            <span class="text-sm text-gray-500">@lang('trad.Next 5 quizzes')</span>
        </div>

        @if($upcomingQuizzes->count() > 0)
            <ul class="space-y-6">
                @foreach($upcomingQuizzes as $quiz)
                    @php
                        $quiz_name = \App\Models\Quiz::where('id', $quiz->quiz_id)->value('name');
                        $course_name = \App\Models\Course::where('id', $quiz->course_id)->value('course_name');
                        $start_time = \Carbon\Carbon::parse($quiz->start_time);
                        $time_left = $start_time->diffForHumans(null, true, false, 2);
                    @endphp
                    <li class="bg-gradient-to-r from-indigo-50 to-indigo-60 p-5 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex justify-between items-start">
                            <div class="flex-grow">
                                <div class="flex items-center mb-3">
                                    <a class="mr-3 bg-indigo-100 rounded-full p-2 ">
                                        <x-heroicon-o-clipboard class="w-6 h-6 text-indigo-600"/>
                                    </a>
                                    <h3 class="text-xl font-semibold text-gray-900">{{ $quiz_name }}</h3>
                                </div>
                                <p class="text-sm text-gray-600 mb-2">
                                    <x-heroicon-o-academic-cap class="w-4 h-4 inline mr-1" />
                                    {{ $course_name }}
                                </p>
                                <div class="flex items-center text-sm text-gray-500">
                                    <x-heroicon-o-calendar class="w-4 h-4 mr-1" />
                                    <span>{{ $start_time->format('d M, H:i') }}</span>
                                    <span class="mx-2">•</span>
                                    <x-heroicon-o-clock class="w-4 h-4 mr-1" />
                                    <span>
                                        @if($quiz->duration)
                                            {{ $quiz->duration }}
                                            @if($quiz->duration < 2)
                                                @lang('trad.minute')
                                            @else
                                                @lang('trad.minutes')
                                            @endif
                                        @else
                                            @lang('trad.N/A')
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-block bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                    @lang('trad.Starts in') {{ $time_left }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end">
                            @if(auth()->user()->isStudent())
                                <a href="{{ route('student.exercises', $quiz->course_id) }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200">
                                    @lang('trad.View Details')
                                    <x-heroicon-s-arrow-right class="ml-1 w-4 h-4" />
                                </a>
                            @elseif(auth()->user()->isTeacher())
                                <a href="{{ route('courses.quizzes', $quiz->course_id) }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200">
                                    @lang('trad.View Details')
                                    <x-heroicon-s-arrow-right class="ml-1 w-4 h-4" />
                                </a>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="mt-6">
                {{ $upcomingQuizzes->appends(['upcoming_page' => request()->upcoming_page])->links() }}
            </div>
        @else
            @if(auth()->user()->isStudent())
                <div class="text-center py-12 bg-gradient-to-r from-indigo-50 to-white rounded-xl">
                    <x-heroicon-o-check-circle class="mx-auto h-16 w-16 text-indigo-600" />
                    <h3 class="mt-4 text-xl font-semibold text-gray-900">@lang('trad.Great job!')</h3>
                    <p class="mt-2 text-base text-gray-600">@lang('trad.No upcoming quizzes to take')</p>
                    <p class="mt-4 text-sm text-indigo-600">@lang('trad.Enjoy your free time!')</p>
                </div>
            @elseif(auth()->user()->isTeacher())
                <div class="text-center py-12 bg-gradient-to-r from-indigo-50 to-white rounded-xl">
                    <x-heroicon-o-calendar class="mx-auto h-16 w-16 text-indigo-400" />
                    <h3 class="mt-4 text-xl font-semibold text-gray-900">@lang('trad.No upcoming quizzes')</h3>
                    <p class="mt-2 text-base text-gray-600">@lang('trad.You have no quizzes scheduled in the near future')</p>
                    <p class="mt-4 text-sm text-indigo-600">@lang('trad.Create a new quiz to get started!')</p>
                </div>
            @endif

        @endif
    </div>
</div>
