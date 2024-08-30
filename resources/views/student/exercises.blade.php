<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Course Exercises') }} - {{ $course->value('course_name') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(count($quizzes) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($quizzes as $quizData)
                                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300">
                                    <h3 class="text-lg font-semibold mb-2">{{ $quizData->name }}</h3>
                                    <p class="text-gray-600 mb-4">{{ $quizData->description }}</p>
                                    <div class="space-y-2">
                                        <p class="text-sm">
                                            <span class="font-medium">Start time:</span>
                                            {{ $quizData->start_time ? $quizData->start_time->format('Y-m-d H:i') : 'Not set' }}
                                        </p>
                                        <p class="text-sm">
                                            <span class="font-medium">Duration:</span>
                                            {{ $quizData->duration_minutes }} {{__('minutes')}}
                                        </p>
                                        <p class="text-sm">
                                            <span class="font-medium">Repeatable:</span>
                                            {{ $quizData['repeatable'] ? 'Yes' : 'No' }}
                                        </p>
                                    </div>
                                    <div class="mt-4">

                                        <a class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                            {{__('Start quiz')}}
                                        </a>
                                    </div>
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
