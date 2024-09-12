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
    <div
        class="flex items-center flex-col"
    >
        <div class="py-12 flex flex-wrap justify-center w-4/5">
            @foreach ($quizzes as $quiz)
                <x-cardNDE id="{{ $quiz->id }}" editModal="EditQuiz-modal-{{ $quiz->id }}" deleteModal="DeleteQuiz-modal-{{ $quiz->id }}" href="{{ route('quiz.show', ['id' => $quiz->id]) }}">
                    
                    <x-slot name="name">{{ $quiz->name }}</x-slot>
                    <x-slot name="description">{{ $quiz->description }}</x-slot>
                    
                </x-cardNDE>
                @include('forms.quiz.edit')
                @include('forms.quiz.delete')
            @endforeach
        </div>
        
    </div>
</x-app-layout>
