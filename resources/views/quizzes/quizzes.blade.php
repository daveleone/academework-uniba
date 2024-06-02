<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ "Quiz " . $subject->name}}
        </h2>
    </x-slot>
    <div style="display: flex; align-items:center; justify-content:center; flex-direction: column;">
        <div style="background-color: white">
            @include('forms.create-quiz')

            @foreach ($quizzes as $quiz)
            <div style="display:flex; flex-direction: row;">
                <div style="margin: 2rem;">
                    <a href="{{ route('exercise.show', ['id' => $exercise->id]) }}">
                        <p><b>Title: </b>{{ $quiz->name }}</p>
                        <p><b>Description: </b>{{ $quiz->description }}</p>
                        <p><b>Points: </b>{{ $quiz->points }}</p>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
