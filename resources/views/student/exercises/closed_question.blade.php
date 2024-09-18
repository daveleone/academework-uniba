<div class="mb-6">
    <h3 class="font-semibold text-gray-800 text-lg mb-2 flex items-center">
        <x-heroicon-o-question-mark-circle class="w-6 h-6 mr-2 text-indigo-600" />
        {{ $exercise->name }}
    </h3>
    <p class="text-gray-600 mb-4">{{ $exercise->description }}</p>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($exercise->elements->shuffle()->all() as $element)
            <div class="bg-white p-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                <label for="closed_{{ $exercise->id }}_{{ $element->id }}" class="flex items-center cursor-pointer group">
                    <input
                        id="closed_{{ $exercise->id }}_{{ $element->id }}"
                        name="closed_{{ $exercise->id }}"
                        type="radio"
                        value="{{ $element->id }}"
                        class="form-radio text-indigo-600 focus:ring-indigo-500 h-5 w-5"
                        required
                    >
                    <span class="ml-3 text-gray-700 group-hover:text-indigo-600 transition duration-200">
                        {{ $element->content }}
                    </span>
                </label>
            </div>
        @endforeach
    </div>
</div>
