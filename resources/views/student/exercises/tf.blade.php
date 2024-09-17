<div class="bg-gray-100 p-6 rounded-xl">
    <div class="space-y-6">
        @foreach($exercise->elements as $index => $element)
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center mb-4">
                    <x-heroicon-o-check-circle class="w-6 h-6 text-indigo-600 mr-2" />
                    <h3 class="text-xl font-semibold text-gray-800">@lang('trad.Statement') {{ $index + 1 }}</h3>
                </div>
                <p class="text-gray-700 mb-6">{{ $element->content }}</p>
                @php
                    $answer = $tfAnswer->firstWhere('ex_elem_id', $element->id);
                    $correctAnswer = $element->truth; // Assuming this field exists
                @endphp

                <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg">
                    <span class="font-medium text-gray-700">@lang('trad.Answer'):</span>
                    @if($answer)
                        <div class="flex space-x-3">
                            <button class="px-4 py-2 rounded-full text-sm font-semibold transition-colors duration-300
                                {{ $answer->content == 1 ? ($correctAnswer == 1 ? 'bg-green-600 text-white' : 'bg-red-600 text-white') : 'bg-gray-200 text-gray-600' }}">
                                @lang('trad.True')
                            </button>
                            <button class="px-4 py-2 rounded-full text-sm font-semibold transition-colors duration-300
                                {{ $answer->content == 0 ? ($correctAnswer == 0 ? 'bg-green-600 text-white' : 'bg-red-600 text-white') : 'bg-gray-200 text-gray-600' }}">
                                @lang('trad.False')
                            </button>
                        </div>
                    @else
                        <span class="px-4 py-2 rounded-full text-sm font-semibold bg-gray-200 text-gray-600">
                            @lang('trad.Not answered')
                        </span>
                    @endif
                </div>
                <div class="mt-4 text-sm">
                    <span class="font-medium text-gray-700">@lang('trad.Correct answer'):</span>
                    <span class="ml-2 font-semibold text-green-600">
                        {{ $correctAnswer ? __('trad.True') : __('trad.False') }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</div>
