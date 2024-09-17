<x-app-layout>
    <div class="">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex items-center justify-between">
                <div class="mb-8 inline-flex items-center">
                    <a href="{{ url()->previous() }}">
                        <x-heroicon-o-chevron-left class="ml-1 mr-2 h-6 w-6" />
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">
                        @lang("trad.My quizzes")
                    </h1>
                </div>
                <div class="mb-8 inline-flex items-center">
                    @include("forms.quiz.create")
                </div>
            </div>
            @if ($quizzes->count() > 0)
                <div
                    class="mb-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3"
                >
                    @foreach ($quizzes as $quiz)
                        <x-cardNDE
                            id="{{ $quiz->id }}"
                            editModal="edit-quiz-{{ $quiz->id }}"
                            deleteModal="delete-quiz-{{ $quiz->id }}"
                            href="{{ route('quiz.show', ['id' => $quiz->id]) }}"
                            hrefName="View Quiz"
                        >
                            <x-slot name="name">{{ $quiz->name }}</x-slot>
                            <x-slot name="description">
                                {{ $quiz->description }}
                            </x-slot>
                            <x-slot name="icon">
                                <x-heroicon-o-clipboard class="mr-1 h-7 w-7" />
                            </x-slot>
                        </x-cardNDE>
                        @include("forms.quiz.edit")
                        @include("forms.quiz.delete")
                    @endforeach
                </div>
            @else
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <x-heroicon-o-academic-cap
                            class="mx-auto h-12 w-12 text-gray-400"
                        />
                        <h3 class="mt-2 text-sm font-medium text-gray-900">
                            @lang("trad.No quizzes")
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            @lang("trad.Get started by creating a new quiz")
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
