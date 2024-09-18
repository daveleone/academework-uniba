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
            id="open_{{ $exercise->id }}"
            name="open_{{ $exercise->id }}"
            rows="4"
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-white transition duration-200 ease-in-out"
            required
        ></textarea>
        <div class="absolute bottom-3 right-3 text-gray-400">
            <x-heroicon-o-paper-airplane class="w-5 h-5" />
        </div>
    </div>
</div>
