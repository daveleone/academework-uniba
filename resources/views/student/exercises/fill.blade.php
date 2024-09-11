<div class="mt-2 inline-flex flex-wrap items-center gap-1">
    @foreach($exercise->elements as $element)
        @if($element->type == 'text')
            <span>{{ $element->content }}</span>
        @elseif($element->type == 'input')
            @php
                $answer = $fillAnswer->firstWhere('ex_elem_id', $element->id);
            @endphp
            <span class="px-2 py-1 bg-gray-100 rounded">
                @if($answer)
                    <span class="text-blue-600 font-medium">{{ $answer->content }}</span>
                @else
                    <span class="text-gray-500 italic">N/A</span>
                @endif
            </span>
        @endif
    @endforeach
</div>
