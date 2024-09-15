@php
    $maxPoints = $exercises->sum('points');
    $openPoints = $exercises->where('type', 'open')->value('points');
@endphp

<x-app-layout>
    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div class="inline-flex items-center">
                    <a href="{{ route('student.details', ['course' => $course, 'student' => $student]) }}" class="hover:text-indigo-800 transition duration-150 ease-in-out">
                        <x-heroicon-o-chevron-left class="w-6 h-6 mr-2" />
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">
                        @lang('trad.Quiz review') - {{$student->user->name}} {{ $student->user->surname }}
                    </h1>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">@lang('trad.Student mark')</h2>
                    <form action="{{ route('student.updateVote', ['course' => $course->id, 'student' => $student->id, 'quiz' => $quiz->id]) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="flex items-center space-x-4">
                            <label for="mark" class="font-medium text-gray-700">@lang('trad.Mark'):</label>
                            <input type="number" id="mark" name="mark" value="{{ $mark->mark }}" min="{{$mark->mark}}" max="{{ $mark->mark + $openPoints }}" step="0.5" class="mt-1 block w-24 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <span class="text-gray-500">/ {{ $maxPoints }}</span>
                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-300 hover:-translate-y-1">
                            <x-heroicon-s-pencil class="w-5 h-5 mr-2" />
                            @lang('trad.Update mark')
                        </button>
                    </form>
                </div>
            </div>

            @if($exercises->count() > 0)
                <div class="mb-6">
                    @foreach($exercises as $exercise)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition duration-300 ease-in-out mb-6">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">@lang('trad.Exercise')</h3>
                                <p class="text-gray-600 mb-4">{{ $exercise->description }}</p>

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
                                        <p class="text-red-500">@lang('trad.Unknown exercise type')</p>
                                @endswitch
                            </div>
                        </div>
                    @endforeach
                </div>

            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <x-heroicon-o-clipboard-document-list class="mx-auto h-12 w-12 text-gray-400" />
                        <h3 class="mt-2 text-sm font-medium text-gray-900">@lang('trad.No exercises found')</h3>
                        <p class="mt-1 text-sm text-gray-500">@lang('trad.There are no exercises for this quiz')</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
