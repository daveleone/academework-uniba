<!-- Modal toggle -->
<button
    data-modal-target="CreateEx-modal"
    data-modal-toggle="CreateEx-modal"
    class="text-s inline-flex items-center rounded-lg bg-blue-700 px-3 py-2 text-center font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    type="button"
>
    Add exercise
    <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="w-7 pl-1"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
        />
    </svg>
</button>

<!-- Main modal -->
<div
    id="CreateEx-modal"
    tabindex="-1"
    aria-hidden="true"
    class="fixed inset-0 z-50 flex hidden h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900 bg-opacity-50"
>
    <div class="relative max-h-full w-full max-w-md p-4">
        <!-- Modal content -->
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5"
            >
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Create New Exercise
                </h3>
                <button
                    type="button"
                    class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="CreateEx-modal"
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
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form
                id="CreateEx"
                action="{{ route("exercise.createInit", ["id" => $topic->id]) }}"
                method="post"
                class="p-4 md:p-5"
            >
                @csrf
                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label
                            for="ExName"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Exercise name
                        </label>
                        <input
                            type="text"
                            name="ExName"
                            id="ExName"
                            class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                            placeholder="Type exercise name"
                            required=""
                        />
                    </div>
                    <div class="col-span-2">
                        <label
                            for="ExDescription"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Exercise's Description
                        </label>
                        <textarea
                            id="ExDescription"
                            name="ExDescription"
                            rows="4"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            placeholder="Write exercise description here"
                            required
                        ></textarea>
                    </div>
                    <div>
                        <label
                            for="ExPoints"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Exercise points
                        </label>
                        <input
                            type="number"
                            id="ExPoints"
                            name="ExPoints"
                            min="1"
                            required
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            placeholder=""
                            required
                        />
                    </div>
                    <div>
                        <label
                            for="ExType"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Select the type
                        </label>
                        <select
                            form="CreateEx"
                            required
                            id="ExType"
                            name="ExType"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        >
                            <option value="true/false">True or false</option>
                            <option value="open">Open question</option>
                            <option value="close">Closed question</option>
                            <option value="fill-in">Fill in text</option>
                        </select>
                    </div>
                </div>
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
                    Add new exercise
                </button>
            </form>
        </div>
    </div>
</div>
