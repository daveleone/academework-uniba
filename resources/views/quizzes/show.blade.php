<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center align-center justify-between">
            <div class="flex flex-row items-center">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    {{ $quiz->name }}
                </h2>

                <!-- Pdf Download -->
                <a href="{{ route('quiz.download', ['id' => $quiz->id]) }}" class="btn btn-primary ml-2 dark:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6  hover:stroke-gray-400">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                    </svg>
                </a>
            </div>
            
            @include('forms.quiz.add_to_course')
        </div>
    </x-slot>
    <div
        class="flex items-center flex-col"
    >
        <div class="flex w-full flex-col items-center py-12 text-lg">
            @foreach ($quiz->exercises as $exercise)
                <div class="relative">
                    <div class="absolute right-0">
                        <div class="flex flex-col grow-0">
                            <a href="{{ route('exercise.show', ['id' => $exercise->id]) }}" type="button" class="flex m-1 mr-0 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                    <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                </svg>
                                <span class="sr-only">@lang('trad.Edit')</span>
                            </a>
                            @include('forms.quiz.remove_ex')
                            <button type="button" data-modal-target="RemoveEx-modal-{{ $exercise->id }}" data-modal-toggle="RemoveEx-modal-{{ $exercise->id }}" class="flex m-1 mr-0 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                                <span class="sr-only">@lang('trad.Remove')</span>
                            </button>
                        </div>                    </div>
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
