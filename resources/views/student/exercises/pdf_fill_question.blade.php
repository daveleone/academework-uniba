<div class="mb-6">
    <h3 class="font-semibold text-gray-800 text-lg mb-2 flex items-center">
        <x-heroicon-o-question-mark-circle class="w-6 h-6 mr-2 text-indigo-600" />
        {{ $exercise->name }}
    </h3>
    <p class="text-gray-600 mb-4">{{ $exercise->description }}</p>
    <div class="bg-white p-4 rounded-lg shadow-md">
        @foreach($exercise->elements as $element)
            <div class="flex items-center mb-4">
                @if($element->type == 'text')
                    <span class="text-gray-700 flex-grow">{{ $element->content }}</span>
                @else
                    <div class="relative flex-grow ml-4">
                        <textarea class="w-full h-24 p-2 border border-gray-300 rounded-lg"></textarea>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
