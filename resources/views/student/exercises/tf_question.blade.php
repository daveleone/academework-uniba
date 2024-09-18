<div class="mb-6">
    <h3 class="font-semibold text-gray-800 text-lg mb-2 flex items-center">
        <x-heroicon-o-question-mark-circle class="w-6 h-6 mr-2 text-indigo-600" />
        {{ $exercise->name }}
    </h3>
    <p class="text-gray-600 mb-4">{{ $exercise->description }}</p>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($exercise->elements->shuffle()->all() as $element)
            <div class="bg-white p-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                <p class="text-gray-700 mb-3">{{ $element->content }}</p>
                <div class="flex justify-center space-x-4">
                    <label class="inline-flex items-center cursor-pointer group">
                        <input type="radio" name="tf_{{ $exercise->id }}_{{ $element->id }}" value="1" class="form-radio text-indigo-600 focus:ring-indigo-500 h-5 w-5" required>
                        <span class="ml-2 text-gray-700 group-hover:text-indigo-600 transition duration-200">
                            <x-heroicon-o-check-circle class="w-6 h-6 inline-block mr-1" />
                            @lang('trad.True')
                        </span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer group">
                        <input type="radio" name="tf_{{ $exercise->id }}_{{ $element->id }}" value="0" class="form-radio text-indigo-600 focus:ring-indigo-500 h-5 w-5" required>
                        <span class="ml-2 text-gray-700 group-hover:text-indigo-600 transition duration-200">
                            <x-heroicon-o-x-circle class="w-6 h-6 inline-block mr-1" />
                            @lang('trad.False')
                        </span>
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>
