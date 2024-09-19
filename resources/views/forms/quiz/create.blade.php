<!-- Modal toggle -->
<button
    data-modal-target="CreateQuiz-modal"
    data-modal-toggle="CreateQuiz-modal"
    class="inline-flex cursor-pointer items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white ring-indigo-300 transition duration-300 ease-in-out hover:-translate-y-1 hover:bg-indigo-700 focus:border-indigo-900 focus:outline-none focus:ring active:bg-indigo-900 disabled:opacity-25"
    dusk="create-quiz-button"
>
    <x-heroicon-s-plus class="mr-2 h-5 w-5" />
    @lang("trad.Add quiz")
</button>

<!-- Main modal -->
<div
    id="CreateQuiz-modal"
    tabindex="-1"
    aria-hidden="true"
    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0"
>
    <div class="relative max-h-full w-full max-w-md p-4">
        <!-- Modal content -->
        <div
            class="relative rounded-lg rounded-b-2xl rounded-t-2xl bg-white shadow dark:bg-gray-700"
        >
            <!-- Modal header -->
            <div class="rounded-t-2xl bg-indigo-600 px-8 py-6">
                <h2 class="text-center text-2xl font-bold text-white">
                    @lang("trad.Create New Quiz")
                </h2>
            </div>
            <!-- Modal body -->
            <form
                action="{{ route("quiz.create") }}"
                method="post"
                id="CreateQuiz"
                class="p-4 md:p-5"
            >
                @csrf
                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label
                            for="QuizName"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            @lang("trad.Quiz name")
                        </label>
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <div
                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                            >
                                <x-heroicon-o-clipboard
                                    class="h-5 w-5 text-gray-400"
                                />
                            </div>
                            <input
                                type="text"
                                name="QuizName"
                                id="QuizName"
                                class="block w-full rounded-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Type quiz name"
                                required
                                dusk="create-quiz-name"
                            />
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label
                            for="QuizDescription"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            @lang("trad.Quiz Description")
                        </label>
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <div
                                class="pointer-events-none absolute inset-y-0 left-0 flex pl-3 pt-2"
                            >
                                <x-heroicon-o-clipboard
                                    class="h-5 w-5 text-gray-400"
                                />
                            </div>
                            <textarea
                                id="QuizDescription"
                                name="QuizDescription"
                                rows="4"
                                class="block w-full rounded-md border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                placeholder="Write quiz description here"
                                required
                                dusk="create-quiz-description"
                            ></textarea>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between space-x-4">
                    <button
                        type="submit"
                        class="group inline-flex w-1/2 transform justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-sm font-medium text-white transition duration-300 ease-in-out hover:-translate-y-1 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        dusk="create-quiz-submit"
                    >
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3"
                        >
                            <x-heroicon-s-plus-circle
                                class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                            />
                        </span>
                        @lang("trad.Create Quiz")
                    </button>
                    <a
                        class="group flex w-1/2 transform justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-sm font-medium text-white transition duration-300 ease-in-out hover:-translate-y-1 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        data-modal-toggle="CreateQuiz-modal"
                    >
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3"
                        >
                            <x-heroicon-s-x-circle
                                class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                            />
                        </span>
                        @lang("trad.Cancel")
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
