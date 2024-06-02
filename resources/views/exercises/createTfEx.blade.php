<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $topic->name }}
        </h2>
    </x-slot>
    <div class="py-12 flex flex-col items-center w-full">
        <form action="{{ route('exercise.createTf', ['id' => $topic->id]) }}" method="post" id="tf-Form">
            @csrf
            <input type="hidden" id="questionNum" name="questionNum" value="1">
            <div id="tf-FormDiv" class="w-60 m-10">
                <div id="questDiv0" class="w-[17rem] mb-[1rem]">
                    <label for="question0" id="questLab0" required class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white">Question 1:</label>
                    <div class="flex flex-row justify-start items-center">
                        <input type="text" id="question0" name="question0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        <div class="ml-[1rem] flex  flex-row justify-evenly items-center" id="divInputs0">
                            <input id="isTrue0" name="isTrue0" type="checkbox" value="1" class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="isTrue0" id="isTrueLab0" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">True?</label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="ml-10">
            <button onclick="addQuestion()" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Add question</button>
            <button type="submit" form="tf-Form" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
        </div>
    </div>

    <button id="delButtn" type="button" class=" hidden ml-[1rem] mr-0 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
        </svg>
        <span class="sr-only">Delete</span>
    </button>

    <script>
        const questionNum = document.getElementById("questionNum");

        const deleteButtnSample = document.getElementById("delButtn");
        const form = document.getElementById("tf-FormDiv");
        const question0 = document.getElementById("questDiv0").cloneNode(true);

        function addQuestion() {
            const deleteButtn = deleteButtnSample.cloneNode(true);
            const newQuestion = question0.cloneNode(true);
            let n = parseInt(questionNum.value);


            newQuestion.id = "questDiv" + n;
            newQuestion.querySelector("#questLab0").innerText = "Question " + (n + 1) + ":";
            newQuestion.querySelector("#questLab0").for = "question" + n;
            newQuestion.querySelector("#questLab0").id = "questLab" + n;
            newQuestion.querySelector("#question0").name = "question" + n;
            newQuestion.querySelector("#question0").id = "question" + n;
            newQuestion.querySelector("#isTrue0").name = "isTrue" + n;
            newQuestion.querySelector("#isTrue0").id = "isTrue" + n;
            newQuestion.querySelector("#isTrueLab0").for = "isTrue" + n;
            newQuestion.querySelector("#isTrueLab0").id = "isTrueLab" + n;
            newQuestion.querySelector("#divInputs0").id = "divInputs" + n;

            deleteButtn.id = "delButt" + n;
            deleteButtn.style.display = "block";
            deleteButtn.onclick = () => {
                deleteQuestion(newQuestion.id, n);
            };

            newQuestion.querySelector("#divInputs" + n).appendChild(deleteButtn);


            form.appendChild(newQuestion);
            questionNum.value++;
        }

        function deleteQuestion(divId, p) { // p := posizione elemento
            const divToDelete = document.getElementById(divId);
            let n = parseInt(questionNum.value);

            divToDelete.remove();
            for (let i = p + 1; i < n; i++) {
                let questionDiv = document.getElementById("questDiv" + i);
                let questionLabel = document.getElementById("questLab" + i);
                let questionInput = document.getElementById("question" + i);
                let questionCheckbox = document.getElementById("isTrue" + i);
                let checkboxLabel = document.getElementById("isTrueLab" + i);
                let deleteButtn = document.getElementById("delButt" + i);

                questionDiv.id = "questDiv" + (i - 1);

                questionLabel.id = "questLab" + (i - 1);
                questionLabel.for = "question" + (i - 1);
                questionLabel.innerText = "Question " + (i) + ": ";

                questionInput.id = "question" + (i - 1);
                questionInput.name = "question" + (i - 1);

                questionCheckbox.id = "isTrue" + (i - 1);
                questionCheckbox.name = "isTrue" + (i - 1);

                checkboxLabel.id = "isTrueLab" + (i - 1);
                checkboxLabel.for = "isTrue" + (i - 1);

                deleteButtn.id = "delButt" + (i - 1);
                deleteButtn.onclick = () => {
                    deleteQuestion(questionDiv.id, i - 1);
                };
            }

            questionNum.value--;
        }
    </script>
</x-app-layout>
