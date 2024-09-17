<!-- Modal toggle -->
<button
    data-modal-target="AddToCourse-modal"
    data-modal-toggle="AddToCourse-modal"
    class="inline-flex cursor-pointer items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white ring-indigo-300 transition duration-300 ease-in-out hover:-translate-y-1 hover:bg-indigo-700 focus:border-indigo-900 focus:outline-none focus:ring active:bg-indigo-900 disabled:opacity-25"
    type="button"
>
    <x-heroicon-s-plus class="mr-2 h-5 w-5" />
    @lang("trad.Add to course")
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
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-700 rounded-t-2xl rounded-b-2xl">
            <!-- Modal header -->
            <div
                class="px-8 py-6 bg-indigo-600 rounded-t-2xl"
            >
                <h2 class="text-2xl font-bold text-white text-center">
                    @lang("trad.Add to course")
                </h2>
                    
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
                            @lang("trad.Select hour:")
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
                                value=""
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
                            @lang("trad.Repeatable")
                        </label>
                    </div>

                    <div class="flex flex-row">
                        <label
                            for="time_limit"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            @lang("trad.Time limit (minutes):")
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
                    
                        <button type="submit" class="group inline-flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <x-heroicon-s-plus-circle class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" />
                            </span>
                            @lang('trad.Add to course')
                        </button>
                        <a class="group flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1"
                        data-modal-toggle="AddToCourse-modal">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <x-heroicon-s-x-circle class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" />
                            </span>
                            @lang('trad.Cancel')
                        </a>
        
                    <script>
                        const submit =
                            document.getElementById('addToCourse-Submit');
                        const offsetInput = document.getElementById('offset');
                        offsetInput.value = new Date().getTimezoneOffset();

                        const dateInput = document.getElementById('datepicker');
                        const timeInput = document.getElementById('time');

                        function updateRequired() {
                            const isDateFilled = dateInput.value !== '';
                            const isTimeFilled = timeInput.value !== '';

                            console.log('Date: ' + dateInput.value);
                            console.log('Time: ' + timeInput.value);

                            if (isDateFilled || isTimeFilled) {
                                dateInput.required = true;
                                timeInput.required = true;
                            } else {
                                dateInput.required = false;
                                timeInput.required = false;
                            }
                        }

                        submit.addEventListener('focus', updateRequired);
                    </script>
                </div>
            </form>
        </div>
    </div>
</div>
