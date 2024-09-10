<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Exam conducted by: {{ $student->user->name }}. Quiz: {{ $quiz->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-8 p-6 bg-gray-50 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-4">{{$student->user->name}}'s Mark</h3>

                            @php
                                $maxPoints = $exercises->sum('points');
                                $openPoints = $exercises->where('type', 'open')->value('points');
                            @endphp
                            <form action="{{ route('student.updateVote', ['course' => $course->id, 'student' => $student->id, 'quiz' => $quiz->id]) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')
                                <div class="flex items-center space-x-4">
                                    <label for="mark" class="font-medium">Mark:</label>
                                    <input type="number" id="mark" name="mark" value="{{ $mark->mark }}" min="{{$mark->mark}}" max="{{ $mark->mark + $openPoints }}" step="0.5" class="mt-1 block w-24 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="text-gray-500">/ {{ $maxPoints }}</span>
                                </div>
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                    Update Mark
                                </button>
                            </form>
                        </div>

                    @foreach($exercises as $exercise)
                        <div class="mb-8 p-6 bg-gray-50 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">{{ $exercise->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ $exercise->description }}</p>

                            <div class="bg-white p-4 rounded-md">
                                @switch($exercise->type)
                                    @case('true/false')
                                        @include('student.exercises.tf', ['exercise' => $exercise, 'tfAnswer' => $tfAnswer])
                                        @break
                                    @case('open')
                                        @include('student.exercises.open', ['exercise' => $exercise, 'openAnswer' => $openAnswer])
                                        @break
                                    @case('close')
                                        @include('student.exercises.closed', ['exercise' => $exercise, 'closeAnswer' => $closeAnswer])
                                        @break
                                    @case('fill-in')
                                        @include('student.exercises.fill', ['exercise' => $exercise, 'fillAnswer' => $fillAnswer])
                                        @break
                                    @default
                                @endswitch
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
