<div class="mt-2 space-y-4">
    @foreach($exercise->elements as $index => $element)
        <div>
            <p class="font-medium">{{ $element->content }}</p>

            @php
                $answer = $tfAnswer->firstWhere('ex_elem_id', $element->id);
            @endphp

            <p class="mt-2">
                Answer:
                @if($answer)
                    <span class="{{ $answer->content == 1 ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                        {{ $answer->content == 1 ? 'Vero' : 'Falso' }}
                    </span>
                @else
                    <span class="text-gray-500 italic">N/A</span>
                @endif
            </p>
        </div>
    @endforeach
</div>
