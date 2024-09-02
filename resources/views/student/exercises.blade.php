<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Course Exercises') }} - {{ $course->course_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(count($quizzes) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($quizzes as $quizData)
                                @php
                                    $quiz_id = $quizData->id;
                                @endphp
                                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300">
                                    <h3 class="text-lg font-semibold mb-2">{{ $quizData->name }}</h3>
                                    <p class="text-gray-600 mb-4">{{ $quizData->description }}</p>
                                    <div class="space-y-2">
                                        <p class="text-sm">
                                            <span class="font-medium">{{__('Start time')}}:</span>
                                            {{ $quizData->pivot->start_time ? \Carbon\Carbon::parse($quizData->pivot->start_time)->format('d/m/y H:i') : 'Not set' }}
                                        </p>
                                        <p class="text-sm">
                                            <span class="font-medium">{{__('Duration')}}:</span>
                                            {{ $quizData->pivot->duration_minutes }} {{__('minutes')}}
                                        </p>
                                        <p class="text-sm">
                                            <span class="font-medium">{{__('Repeatable')}}:</span>
                                            {{ $quizData->pivot->repeatable ? 'Yes' : 'No' }}
                                        </p>
                                    </div>

                                    @if(!$exam_taken[$quiz_id])

                                        <div class="mt-4">
                                            <a class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded" href="{{route('student.exam', ['courses'=>$course->id, 'quiz'=>$quizData->id]) }}">
                                                {{__('Start quiz')}}
                                            </a>
                                        </div>
                                    @else
                                        <div class="mt-4">
                                            <p class="bg-gray-600 text-white font-bold py-2 px-4 rounded">
                                                {{__('Quiz already taken')}}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">{{__('No quizzes have been assigned to this course yet.')}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
