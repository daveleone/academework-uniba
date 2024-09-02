<div class="mb-4">
    <h3 class="font-semibold">{{ $exercise->name }}</h3>
    <p>{{ $exercise->description }}</p>
    <div class="mt-2">
        <label for="open_{{ $exercise->id }}" class="block text-sm font-medium text-gray-700">Your answer:</label>
        <textarea 
            id="open_{{ $exercise->id }}" 
            name="open_{{ $exercise->id }}" 
            rows="4" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
            required
        ></textarea>
    </div>
</div>
