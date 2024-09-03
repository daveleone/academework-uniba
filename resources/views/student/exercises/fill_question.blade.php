<div class="mb-4">
    <h3 class="font-semibold">{{ $exercise->name }}</h3>
    <p>{{ $exercise->description }}</p>
    <p class="mt-2 inline-flex">
        @foreach($exercise->elements as $element)
            @if($element->type == 'text')
                {{ $element->content }}
            @else
                <input
                    type="text"
                    id="fill_{{ $exercise->id }}_{{ $element->id }}"
                    name="fill_{{ $exercise->id }}_{{ $element->id }}"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm border-gray-300 rounded-md"
                    required
                >
            @endif
        @endforeach
    </p>
</div>
