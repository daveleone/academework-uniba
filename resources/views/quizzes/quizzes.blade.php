<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
            @lang('trad.My quizzes')
            </h2>

            @include("forms.quiz.create")
        </div>
    </x-slot>
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($quizzes as $quiz)
                <x-cardNDE id="{{ $quiz->id }}" editModal="EditQuiz-modal-{{ $quiz->id }}" deleteModal="DeleteQuiz-modal-{{ $quiz->id }}" href="{{ route('quiz.show', ['id' => $quiz->id]) }}" hrefName="View Quiz">
                    <x-slot name="name">{{ $quiz->name }}</x-slot>
                    <x-slot name="description">{{ $quiz->description }}</x-slot>
                    <x-slot name=icon>
                        <x-heroicon-o-clipboard class="w-7 h-7 mr-1" />
                    </x-slot>
                </x-cardNDE>
                @include('forms.quiz.edit')
                @include('forms.quiz.delete')
            @endforeach
        </div>
        
    </div>
</x-app-layout>
