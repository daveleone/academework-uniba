<div class="mb-6">
    <h3 class="font-semibold text-gray-800 text-lg mb-2 flex items-center">
        <x-heroicon-o-question-mark-circle class="w-6 h-6 mr-2 text-indigo-600" />
        {{ $exercise->name }}
    </h3>
    <p class="text-gray-600 mb-4">{{ $exercise->description }}</p>
    <div class="mt-2 relative">
        <label for="open_{{ $exercise->id }}" class="block text-sm font-medium text-gray-700 mb-2">
            @lang('trad.Your answer'):
        </label>
        <textarea
            rows="100"
            cols="100"
        ></textarea>
    </div>
</div>
