<div class="mt-2 space-y-4">
    @foreach($exercise->elements as $element)
        <div>
            <p class="font-medium">{{ $element->content }}</p>

            @php
                $answer = $openAnswer->firstWhere('ex_elem_id', $element->id);
            @endphp

            <p class="mt-2">
                Answer:
                @if($answer)
                    <span class="text-blue-600">{{ $answer->content }}</span>
                @else
                    <span class="text-gray-500 italic">N/A</span>
                @endif
            </p>
        </div>
    @endforeach
</div>
