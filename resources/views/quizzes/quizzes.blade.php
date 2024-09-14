<x-app-layout>
    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">

                <div class="mb-8 inline-flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-heroicon-o-chevron-left class="ml-1 mr-2 w-6 h-6" />
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">
                        @lang('trad.My quizzes')
                    </h1>
                </div>
                <div class="mb-8 inline-flex items-center">
                    @include("forms.quiz.create")
                </div>
            </div>
            @if($quizzes->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
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
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <x-heroicon-o-academic-cap class="mx-auto h-12 w-12 text-gray-400" />
                        <h3 class="mt-2 text-sm font-medium text-gray-900">@lang('trad.No quizzes')</h3>
                        <p class="mt-1 text-sm text-gray-500">@lang('trad.Get started by creating a new quiz')</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
