<x-app-layout>
    <x-slot name="header">
        <h2
            class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
        >
            {{ $topic->name }}
        </h2>
    </x-slot>
    <div class="flex w-full flex-col items-center py-12">
        <form
            action="{{ route("exercise.createOpen", ["id" => $topic->id]) }}"
            method="post"
            id="open-Form"
        >
            @csrf

            <div class="m-10 w-60">
                <label
                    for="exAnswer"
                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                >
                    Answer:
                </label>
                <textarea
                    name="exAnswer"
                    id="exAnswer"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                    required
                ></textarea>
            </div>
        </form>
        <button
            type="submit"
            form="open-Form"
            class="mb-2 me-2 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >
            Submit
        </button>
    </div>
</x-app-layout>
