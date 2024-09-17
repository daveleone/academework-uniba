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
            action="{{ route("exercise.createTf", ["id" => $topic->id]) }}"
            method="post"
            id="tf-Form"
        >
            @csrf
            <input
                type="hidden"
                id="questionNum"
                name="questionNum"
                value="1"
            />
            <div id="tf-FormDiv" class="m-10 w-60">
                <div id="questDiv0" class="mb-[1rem] w-[17rem]">
                    <label
                        for="question0"
                        id="questLab0"
                        required
                        class="mb-2 flex text-sm font-medium text-gray-900 dark:text-white"
                    >
                        @lang('trad.Question') 1:
                    </label>
                    <div class="flex flex-row items-center justify-start">
                        <input
                            type="text"
                            id="question0"
                            name="question0"
                            class="block rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            required
                        />
                        <div
                            class="ml-[1rem] flex flex-row items-center justify-evenly"
                            id="divInputs0"
                        >
                            <input
                                id="isTrue0"
                                name="isTrue0"
                                type="checkbox"
                                value="1"
                                class="h-6 w-6 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
                            />
                            <label
                                for="isTrue0"
                                id="isTrueLab0"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                            >
                                @lang('trad.True?')
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="ml-10">
            <button
                onclick="addQuestion()"
                class="mb-2 me-2 rounded-lg bg-gray-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
            >
                @lang('trad.Add question')
            </button>
            <button
                type="submit"
                form="tf-Form"
                class="mb-2 me-2 rounded-lg px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                @lang('trad.Submit')
            </button>
        </div>
    </div>

    <button
        id="delButtn"
        type="button"
        class="me-2 ml-[1rem] mr-0 hidden items-center rounded-full bg-red-700 p-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
            class="h-4 w-4"
        >
            <path
                fill-rule="evenodd"
                d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                clip-rule="evenodd"
            />
        </svg>
        <span class="sr-only">@lang('trad.Delete')</span>
    </button>

    <script>
        const questionNum = document.getElementById('questionNum');

        const deleteButtnSample = document.getElementById('delButtn');
        const form = document.getElementById('tf-FormDiv');
        const question0 = document.getElementById('questDiv0').cloneNode(true);

        function addQuestion() {
            const deleteButtn = deleteButtnSample.cloneNode(true);
            const newQuestion = question0.cloneNode(true);
            let n = parseInt(questionNum.value);

            newQuestion.id = 'questDiv' + n;
            newQuestion.querySelector('#questLab0').innerText =
                '@lang('trad.Question') ' + (n + 1) + ':';
            newQuestion.querySelector('#questLab0').for = 'question' + n;
            newQuestion.querySelector('#questLab0').id = 'questLab' + n;
            newQuestion.querySelector('#question0').name = 'question' + n;
            newQuestion.querySelector('#question0').id = 'question' + n;
            newQuestion.querySelector('#isTrue0').name = 'isTrue' + n;
            newQuestion.querySelector('#isTrue0').id = 'isTrue' + n;
            newQuestion.querySelector('#isTrueLab0').for = 'isTrue' + n;
            newQuestion.querySelector('#isTrueLab0').id = 'isTrueLab' + n;
            newQuestion.querySelector('#divInputs0').id = 'divInputs' + n;

            deleteButtn.id = 'delButt' + n;
            deleteButtn.style.display = 'block';
            deleteButtn.onclick = () => {
                deleteQuestion(n);
            };

            newQuestion
                .querySelector('#divInputs' + n)
                .appendChild(deleteButtn);

            form.appendChild(newQuestion);
            questionNum.value++;
        }

        function deleteQuestion(p) {
            // p := posizione elemento
            const divToDelete = document.getElementById('questDiv' + p);
            let n = parseInt(questionNum.value);

            divToDelete.remove();
            for (let i = p + 1; i < n; i++) {
                let questionDiv = document.getElementById('questDiv' + i);
                let questionLabel = document.getElementById('questLab' + i);
                let questionInput = document.getElementById('question' + i);
                let questionCheckbox = document.getElementById('isTrue' + i);
                let checkboxLabel = document.getElementById('isTrueLab' + i);
                let deleteButtn = document.getElementById('delButt' + i);
                let inputsDiv = document.getElementById('divInputs' + i);

                questionDiv.id = 'questDiv' + (i - 1);

                questionLabel.id = 'questLab' + (i - 1);
                questionLabel.for = 'question' + (i - 1);
                questionLabel.innerText = 'Question ' + i + ': ';

                questionInput.id = 'question' + (i - 1);
                questionInput.name = 'question' + (i - 1);

                questionCheckbox.id = 'isTrue' + (i - 1);
                questionCheckbox.name = 'isTrue' + (i - 1);

                checkboxLabel.id = 'isTrueLab' + (i - 1);
                checkboxLabel.for = 'isTrue' + (i - 1);

                inputsDiv.id = 'divInputs' + (i - 1);

                deleteButtn.id = 'delButt' + (i - 1);
                deleteButtn.onclick = () => {
                    deleteQuestion(i - 1);
                };
            }

            questionNum.value--;
        }
    </script>
</x-app-layout>
