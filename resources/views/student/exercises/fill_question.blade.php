<div class="mb-4">
    <h3 class="font-semibold">{{ $exercise->name }}</h3>
    <p>{{ $exercise->description }}</p>
    <div class="mt-2">
        @foreach($exercise->elements as $element)
            @if($element->type == 'text')
                <span>{{ $element->content }}</span>
            @else
                <input 
                    type="text" 
                    id="fill_{{ $exercise->id }}_{{ $element->id }}" 
                    name="fill_{{ $exercise->id }}_{{ $element->id }}" 
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                    required
                >
            @endif
        @endforeach
    </div>
</div>
