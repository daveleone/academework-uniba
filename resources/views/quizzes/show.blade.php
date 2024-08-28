<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                {{ $quiz->name }}
            </h2>

            @include('forms.quiz.add_to_course')
        </div>
    </x-slot>
    <div
        class="flex items-center flex-col"
    >
        <div class="flex w-full flex-col items-center py-12 text-lg">
            @foreach ($quiz->exercises as $exercise)
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
            @endforeach
        </div>
    </div>
</x-app-layout>
