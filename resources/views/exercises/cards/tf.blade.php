<div
    class="m-2.5 w-[22rem] rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800"
>
    <p class="mb-3 text-gray-500 dark:text-gray-400">
        <strong class="font-semibold text-gray-900 dark:text-white">
            @lang('trad.Description')
        </strong>
        {{ $exercise->description }}
    </p>
    <ol
        class="max-w-md list-inside list-decimal space-y-1 text-gray-500 dark:text-gray-400"
    >
        @foreach($exercise->elements()->orderBy("position")->get() as $element)
            <li>
                <span
                    class="inline-flex items-center justify-between font-semibold text-gray-900 dark:text-white"
                >
                    <div class="mr-[1rem] w-[13rem]">
                        {{ $element->content }}
                    </div>
                    @if ($element->truth)
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="green"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-7"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                            />
                        </svg>
                    @else
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="red"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-7"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                            />
                        </svg>
                    @endif
                </span>
            </li>
        @endforeach
    </ol>
</div>
