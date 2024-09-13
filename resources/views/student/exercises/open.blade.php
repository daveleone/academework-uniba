<div class="space-y-6 p-6 bg-gray-100 rounded-xl">
    @foreach($exercise->elements as $index => $element)
        <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center mb-4">
                <x-heroicon-o-chat-bubble-left-ellipsis class="w-6 h-6 text-indigo-600 mr-2" />
                <h3 class="text-xl font-semibold text-gray-800">@lang('trad.Question') {{ $index + 1 }}</h3>
            </div>
            <p class="text-gray-700 mb-6">{{ $element->content }}</p>

            @php
                $answer = $openAnswer->firstWhere('ex_elem_id', $element->id);
            @endphp

            <div class="mt-4">
                <h4 class="font-medium text-gray-700 mb-2">@lang('trad.Your answer'):</h4>
                @if($answer)
                    <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-indigo-400 transition-all duration-300 hover:border-indigo-600">
                        <p class="text-gray-600">{{ $answer->content }}</p>
                    </div>
                @else
                    <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-gray-300">
                        <p class="text-gray-500 italic">@lang('trad.Not answered')</p>
                    </div>
                @endif
            </div>

            <div class="mt-6">
                <h4 class="font-medium text-gray-700 mb-2">@lang('trad.Answer given by the professor'):</h4>
                <div class="bg-green-50 p-4 rounded-lg border-l-4 border-green-400">
                    <p class="text-gray-600">{{ $element->answer ?? __('trad.No sample answer provided') }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
