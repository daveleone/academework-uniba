<div class="m-2.5 w-[22rem] rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
    <p class="mb-3 text-gray-500 dark:text-gray-400">
        {{ $exercise->description }}
    </p>
    @foreach($exercise->elements as $element)
        <div>
            <textarea
                name="answer"
                id="answer"
                disabled
                placeholder=""
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
            >
{{ $element->answer }}</textarea
            >
        </div>
    @endforeach
</div>
