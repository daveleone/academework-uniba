<!-- Modal toggle -->
<button
    data-modal-target="AddToCourse-modal"
    data-modal-toggle="AddToCourse-modal"
    class="cursor-pointer inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-300 hover:-translate-y-1"
    type="button"
>
    <x-heroicon-s-plus class="w-5 h-5 mr-2" />
    @lang('trad.Add to course')
</button>

<!-- Main modal -->
<div
    id="AddToCourse-modal"
    tabindex="-1"
    aria-hidden="true"
    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0"
>
    <div class="relative max-h-full w-full max-w-md p-4">
        <!-- Modal content -->
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5"
            >
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    @lang('trad.Add to course')
                </h3>
                <button
                    type="button"
                    class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="AddToCourse-modal"
                >
                    <svg
                        class="h-3 w-3"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 14 14"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                        />
                    </svg>
                    <span class="sr-only">@lang('trad.Close modal')</span>
                </button>
            </div>
            <!-- Modal body -->
            <form
                action="{{ route("quiz.addToCourse") }}"
                method="post"
                class="p-4 md:p-5"
            >
                @csrf
                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        @include("forms.quiz.search_courses")
                    </div>
                    <div>
                        <label
                            for="datepicker"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Select date:
                        </label>
                        <div class="relative max-w-sm">
                            <div
                                class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3"
                            >
                                <svg
                                    class="h-4 w-4 text-gray-500 dark:text-gray-400"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
                                    />
                                </svg>
                            </div>
                            <input
                                id="datepicker"
                                name="date"
                                datepicker
                                datepicker-title="Start time"
                                type="text"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 ps-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="Select date"
                            />
                        </div>
                    </div>
                    <div>
                        <label
                            for="time"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                        @lang('trad.Select hour:')
                        </label>
                        <div class="relative">
                            <div
                                class="pointer-events-none absolute inset-y-0 end-0 top-0 flex items-center pe-3.5"
                            >
                                <svg
                                    class="h-4 w-4 text-gray-500 dark:text-gray-400"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </div>
                            <input
                                type="time"
                                id="time"
                                name="time"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm leading-none text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            />
                        </div>
                    </div>
                    <div class="mb-5 flex items-start">
                        <div class="flex h-5 items-center">
                            <input
                                id="repeatable"
                                name="repeatable"
                                type="checkbox"
                                value="1"
                                class="focus:ring-3 h-4 w-4 rounded border border-gray-300 bg-gray-50 focus:ring-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-800"
                            />
                        </div>
                        <label
                            for="repeatable"
                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >
                            @lang('trad.Repeatable')
                        </label>
                    </div>

                    <div class="flex flex-row">
                        <label
                            for="time_limit"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            @lang('trad.Time limit (minutes):')
                        </label>
                        <input
                            type="number"
                            id="time_limit"
                            name="time_limit"
                            min="1"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        />
                    </div>

                    <input
                        type="hidden"
                        name="offset"
                        id="offset"
                        value="getOffset()"
                    />
                    <script>
                        const offsetInput = document.getElementById('offset');
                        offsetInput.value = new Date().getTimezoneOffset();
                    </script>
                    <button
                        type="submit"
                        class="inline-flex items-center rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >
                        <svg
                            class="-ms-1 me-1 h-5 w-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                        @lang('trad.Add to course')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
