@php
    $maxPoints = $exercises->sum('points');
    $openPoints = $exercises->where('type', 'open')->value('points');
@endphp

<x-app-layout>
    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div class="inline-flex items-center">
                    <a href="{{ url()->previous() }}" class="hover:text-indigo-800 transition duration-150 ease-in-out">
                        <x-heroicon-o-chevron-left class="w-6 h-6 mr-2" />
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">
                        @lang('trad.Quiz review')
                    </h1>
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
