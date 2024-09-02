<div class="mb-4">
    <h3 class="font-semibold">{{ $exercise->name }}</h3>
    <p>{{ $exercise->description }}</p>
    @foreach($exercise->elements as $element)
        <div class="mt-2">
            <p>{{ $element->content }}</p>
            <div class="mt-1">
                <label class="inline-flex items-center">
                    <input type="radio" name="tf_{{ $exercise->id }}_{{ $element->id }}" value="1" class="form-radio" required>
                    <span class="ml-2">True</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input type="radio" name="tf_{{ $exercise->id }}_{{ $element->id }}" value="0" class="form-radio" required>
                    <span class="ml-2">False</span>
                </label>
            </div>
        </div>
    @endforeach
</div>
