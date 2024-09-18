<div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
    <div class="flex items-center mb-6">
        <x-heroicon-o-code-bracket-square class="w-6 h-6 text-indigo-600 mr-2" />
        <h3 class="text-xl font-semibold text-gray-800">@lang('trad.Fill in the blanks')</h3>
    </div>
    <div class="bg-gray-50 p-6 rounded-lg text-lg leading-relaxed">
        @foreach($exercise->elements as $element)
            @if($element->type == 'text')
                <span class="text-gray-700">{{ $element->content }}</span>
            @elseif($element->type == 'input')
                @php
                    $answer = $fillAnswer->firstWhere('ex_elem_id', $element->id);
                    $correctAnswer = $element->content; // Assuming this field exists
                @endphp
                <span class="inline-block min-w-[100px] px-3 py-1 mx-1 border-b-2 transition-all duration-300
                    {{ $answer ? ($answer->content == $correctAnswer ? 'border-green-400 hover:border-green-600' : 'border-red-400 hover:border-red-600') : 'border-gray-400 hover:border-gray-600' }}">
                    @if($answer)
                        <span class="font-semibold {{ $answer->content == $correctAnswer ? 'text-green-600' : 'text-red-600' }}">{{ $answer->content }}</span>
                    @else
                        <span class="text-gray-400 italic">@lang('trad.Blank')</span>
                    @endif
                </span>
                <span class="inline-block text-sm ml-2">
                    <span class="font-medium text-gray-700">@lang('trad.Correct'):</span>
                    <span class="font-semibold text-green-600">{{ $correctAnswer }}</span>
                </span>
            @endif
        @endforeach
    </div>
</div>
