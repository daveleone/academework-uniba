<x-app-layout>
    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div class="inline-flex items-center">
                    <a href="{{ route('quiz.index') }}">
                        <x-heroicon-o-chevron-left class="ml-1 mr-2 w-6 h-6" />
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">
                        {{ $quiz->name }}
                    </h1>
                    <a href="{{ route('quiz.download', ['id' => $quiz->id]) }}" class="ml-4 text-indigo-600 hover:text-indigo-900">
                        <x-heroicon-o-arrow-down-tray class="w-6 h-6" />
                    </a>
                </div>

                <div>
                    @include('forms.quiz.add_to_course')
                </div>
            </div>
    <div
        class="flex items-center flex-col"
    >
        <div class="flex w-full flex-col items-center py-12 text-lg">
            @foreach ($quiz->exercises as $exercise)
                <div class="relative">
                    <div class="absolute right-0">
                        <div class="flex flex-col grow-0">
                            <a href="{{ route('exercise.show', ['id' => $exercise->id]) }}" type="button" class="flex m-1 mr-0 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4"/>
                                <span class="sr-only">@lang('trad.Edit')</span>
                            </a>
                            @include('forms.quiz.remove_ex')
                            <button type="button" data-modal-target="RemoveEx-modal-{{ $exercise->id }}" data-modal-toggle="RemoveEx-modal-{{ $exercise->id }}" class="flex m-1 mr-0 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                <x-heroicon-o-minus-circle class="w-4 h-4"/>
                                <span class="sr-only">@lang('trad.Remove')</span>
                            </button>
                        </div>                    
                    </div>
                    @switch($exercise->type)
                        @case('true/false')
                            @include('exercises.cards.tf')
                            @break
                        @case('open')
                            @include('exercises.cards.open')
                            @break
                        @case('close')
                            @include('exercises.cards.closed')
                            @break
                        @case('fill-in')
                            @include('exercises.cards.fill')
                            @break
                        @default
                            @break
                    @endswitch
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
