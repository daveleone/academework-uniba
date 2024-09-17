<x-app-layout>
    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8 flex justify-between items-center">
                <div class="inline-flex items-center">
                    <a href="{{ url()->previous() }}">
                        <x-heroicon-o-chevron-left class="ml-1 mr-2 w-6 h-6" />
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $course->course_name }}</h1>
                </div>
                <a href="{{ route('student.class_details', ['course' => $course->id]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                    <x-heroicon-s-check-badge class="w-5 h-5 mr-2" />
                    @lang('trad.Show Grades')
                </a>
            </div>

                @if(count($quizzes) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($quizzes as $quizData)
                            @php
                                $quiz_id = $quizData->id;
                            @endphp
                            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300">
                                <div class="flex flex-row justify-between">
                                    <h3 class="text-lg font-semibold mb-2">{{ $quizData->name }}</h3>
                                    <x-heroicon-o-clipboard class="w-7 h-7"/>
                                </div>

                                <p class="text-gray-600 mb-4">{{ $quizData->description }}</p>
                                <div class="space-y-2">
                                    <div class="flex flex-row items-center">
                                        <x-heroicon-o-calendar-days class="w-5 h-5"/>
                                        <p class="text-sm pl-2">
                                            <span class="font-medium">@lang('trad.Start time'):</span>
                                            @if($quizData->pivot->start_time)
                                                {{ \Carbon\Carbon::parse($quizData->pivot->start_time)->format('d/m/y H:i') }}
                                            @else
                                                @lang('trad.Not set')
                                            @endif
                                        </p>
                                    </div>
                                    <div class="flex flex-row items-center">
                                        <x-heroicon-o-clock class="w-5 h-5"/>
                                        <p class="text-sm pl-2">
                                            <span class="font-medium">@lang('trad.Duration'):</span>
                                            @if($quizData->pivot->duration_minutes == null)
                                                @lang('N/A')
                                            @elseif($quizData->pivot->duration_minutes < 2)
                                                {{ $quizData->pivot->duration_minutes }} @lang('trad.minute')
                                            @else
                                                {{ $quizData->pivot->duration_minutes }} @lang('trad.minutes')
                                            @endif
                                        </p>
                                    </div>
                                    <div class="flex flex-row items-center">
                                        <x-heroicon-o-arrow-path class="w-5 h-5" />
                                        <p class="text-sm pl-2">
                                            <span class="font-medium">@lang('trad.Repeatable'):</span>
                                            {{ $quizData->pivot->repeatable ? 'Yes' : 'No' }}
                                        </p>
                                    </div>
                                </div>

                                @if(!$exam_taken[$quiz_id])
                                    <div class="mt-4">
                                        <a dusk="start-quiz" href="{{route('student.exam', ['courses'=>$course->id, 'quiz'=>$quizData->id]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                                            <x-heroicon-s-play class="w-5 h-5 mr-2" />
                                            @lang('trad.Start quiz')
                                        </a>
                                    </div>
                                @else
                                    <div class="mt-4">
                                        <p class="inline-flex items-center px-4 py-2 bg-indigo-300 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                                            <x-heroicon-s-check-circle class="w-5 h-5 mr-2" />
                                            @lang('trad.Quiz already taken')
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                {{ $quizzes->links() }}

                @else
                    <div class="text-center py-12">
                        <x-heroicon-o-document-text class="mx-auto h-12 w-12 text-gray-400" />
                        <h3 class="mt-2 text-sm font-medium text-gray-900">@lang('trad.No quizzes available')</h3>
                        <p class="mt-1 text-sm text-gray-500">@lang('trad.No quizzes have been assigned to this course yet.')</p>
                    </div>
                @endif
            </div>
        </div>
</x-app-layout>
