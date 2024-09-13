<div class="space-y-6 p-6 bg-gray-100 rounded-xl">
    @foreach($exercise->elements as $index => $element)
        <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center mb-4">
                <x-heroicon-o-question-mark-circle class="w-6 h-6 text-indigo-600 mr-2" />
                <h3 class="text-xl font-semibold text-gray-800">@lang('trad.Question') {{ $index + 1 }}</h3>
            </div>
            <p class="text-gray-700 mb-6">{{ $element->content }}</p>

            @php
                $answer = $closeAnswer->firstWhere('ex_elem_id', $element->id);
                $correctAnswer = $element->truth; // Assuming this field exists
            @endphp

            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg">
                <span class="font-medium text-gray-700">@lang('trad.Answer'):</span>
                @if($answer)
                    <span class="px-4 py-2 rounded-full text-sm font-semibold transition-colors duration-300
                        {{ $answer->content == 1 ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                        {{ $answer->content == 1 ? __('trad.True') : __('trad.False') }}
                    </span>
                @else
                    <span class="px-4 py-2 rounded-full text-sm font-semibold bg-gray-200 text-gray-600 transition-colors duration-300">
                        @lang('trad.Not answered')
                    </span>
                @endif
            </div>
            <div class="mt-4 text-sm">
                <span class="font-medium text-gray-700">@lang('trad.Correct answer'):</span>
                <span class="ml-2 font-semibold text-green-600">
                    @if($correctAnswer)
                        @lang('trad.True')
                    @else
                        @lang('trad.False')
                    @endif
                </span>
            </div>
        </div>
    @endforeach
</div>
