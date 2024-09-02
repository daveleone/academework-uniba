<div class="mb-4">
    <h3 class="font-semibold">{{ $exercise->name }}</h3>
    <p>{{ $exercise->description }}</p>
    <div class="mt-2">
        @foreach($exercise->elements as $element)
            <div class="flex items-center mb-2">
                <input 
                    id="closed_{{ $exercise->id }}_{{ $element->id }}" 
                    name="closed_{{ $exercise->id }}" 
                    type="radio" 
                    value="{{ $element->id }}" 
                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                    required
                >
                <label for="closed_{{ $exercise->id }}_{{ $element->id }}" class="ml-3 block text-sm font-medium text-gray-700">
                    {{ $element->content }}
                </label>
            </div>
        @endforeach
    </div>
</div>
