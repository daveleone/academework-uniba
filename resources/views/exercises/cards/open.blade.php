<div class="m-2.5 w-[35rem] rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
    <h2 class="mb-3  dark:text-gray-400">
        {{ $exercise->description }}
    </h2>
    @foreach($exercise->elements as $element)
        <div>
            <textarea
                name="answer"
                id="answer"
                rows="10"
                disabled
                placeholder=""
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
            >
{{ $element->answer }}</textarea
            >
        </div>
    @endforeach
</div>
