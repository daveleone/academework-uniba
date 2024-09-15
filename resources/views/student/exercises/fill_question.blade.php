<div class="mb-6">
    <h3 class="font-semibold text-gray-800 text-lg mb-2 flex items-center">
        <x-heroicon-o-question-mark-circle class="w-6 h-6 mr-2 text-indigo-600" />
        {{ $exercise->name }}
    </h3>
    <p class="text-gray-600 mb-4">{{ $exercise->description }}</p>
    <div class="bg-white p-4 rounded-lg shadow-md">
        @foreach($exercise->elements as $element)
            @if($element->type == 'text')
                <span class="text-gray-700">{{ $element->content }}</span>
            @else
                <div class="inline-block relative">
                    <input
                        type="text"
                        id="fill_{{ $exercise->id }}_{{ $element->id }}"
                        name="fill_{{ $exercise->id }}_{{ $element->id }}"
                        class="mt-1 px-3 py-2 bg-white border shadow-sm border-gray-300 placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 block w-full rounded-md sm:text-sm focus:ring-1 transition duration-200 ease-in-out"
                        required
                        placeholder="@lang('trad.Fill in...')"
                    >
                    <x-heroicon-o-pencil class="w-5 h-5 text-gray-400 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none" />
                </div>
            @endif
        @endforeach
    </div>
</div>
