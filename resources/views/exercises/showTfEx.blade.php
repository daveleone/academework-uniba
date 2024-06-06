<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{ route('topic.exercises', ['id' => $exercise->topic->id]) }}">{{ $exercise->topic->name }}</a> / {{$exercise->name}}
        </h2>
    </x-slot>
    <div class="py-12 flex flex-col items-center w-full text-lg">
        <div id="showDiv" class="m-2.5 w-[22rem] p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <p class="mb-3 text-gray-500 dark:text-gray-400"><strong class="font-semibold text-gray-900 dark:text-white">{{__('Description: ')}}</strong> {{ $exercise->description }}</p>
            <ol class="max-w-md space-y-1 text-gray-500 list-decimal list-inside dark:text-gray-400">
                @foreach ($exercise->elements()->orderBy('position')->get() as $element)
                <li>
                    <span class="inline-flex items-center justify-between font-semibold text-gray-900 dark:text-white">
                        <div class="w-[13rem] mr-[1rem]">{{ $element->content }}
                        </div>
                        @if ($element->truth)
                        <svg xmlns="http://www.w3.org/2000/svg" fill="green" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        @endif
                    </span>
                </li>
                @endforeach
            </ol>
            <div class="flex flex-row mt-[1rem]">
                <button onclick="enableEdit()" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Edit</button>
                    <button type="submit" data-modal-target="DeleteEx-modal-{{$exercise->id}}" data-modal-toggle="DeleteEx-modal-{{$exercise->id}}" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                    @include('forms.exercise.delete', ['exercise' => $exercise])
            </div>
        </div>

        <div id="editDiv" class="flex flex-col hidden m-2.5 w-[30rem] p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <form action="{{ route('exercise.edit', ['id' => $exercise->id]) }}" method="POST" id="tf-Form">
                @csrf
                @method('PUT')
                <input type="hidden" name="exId" value="{{ $exercise->id }}">
                <input type="hidden" id="questionNum" name="questionNum" value="{{ $exercise->elements->count() }}">
                <div class="mb-[1rem]">
                    <label for="exName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name: </label>
                    <input type="text" id="exName" name="exName" placeholder="{{ $exercise->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                </div>
                <div class="mb-[1rem]">
                    <label for="exDescription" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description: </label>
                    <textarea id="exDescription" name="exDescription" placeholder="{{ $exercise->description }}" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                </div>
                <div class="mb-[1rem]">
                    <label for="exPoints" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Points: </label>
                    <input type="number" id="exPoints" name="exPoints" min="1" placeholder="{{ $exercise->points }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                </div>
                @foreach ($exercise->elements()->orderBy('position')->get() as $element)
                <div id="{{'questDiv' . $element->position}}" class="w-[17rem] my-[1rem]">
                    <label for="{{ 'question' . $element->position }}" id="{{'questLab'.$element->position}}" class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white">Question {{ $element->position + 1 }}: </label>
                    <div class="flex flex-row justify-start items-center">
                        <input type="text" name="{{ 'question' . $element->position }}" id="{{ 'question' . $element->position }}" value="{{ $element->content }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <div class="ml-[1rem] flex  flex-row justify-evenly items-center" id="{{ 'divInputs' . $element->position}}">
                            <input type="checkbox" id="{{'isTrue' . $element->position}}" name="{{ 'isTrue' . $element->position}}" class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" value="1" @if($element->truth) checked @endif>
                            <label for="{{ 'isTrue' . $element->position}}" id="{{ 'isTrueLab' . $element->position}}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"> True?</label>
                        </div>
                    </div>
                </div>
                @endforeach
            </form>
            <div class="flex flex-row mt-[2rem]">
                <button type="submit" form="tf-Form" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button>
                <button type="button" onclick="addQuestion()" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Add answer</button>
                <button type="button" onclick="disableEdit()" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Abort</button>
            </div>
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
        const initialQuestionNum = questionNum.value;
        const form = document.getElementById("tf-Form");

        for (let i = 1; i < questionNum.value; i++) {
            let inputDiv = document.getElementById('divInputs' + i);
            let deleteButtn = document.getElementById('delButtn').cloneNode(true);

            deleteButtn.id = "delButt" + i;
            deleteButtn.style.display = "block";
            deleteButtn.onclick = () => {
                deleteQuestion("questDiv" + i, i);
            };
            inputDiv.appendChild(deleteButtn);
        }

        const initialForm = form.innerHTML;

        function enableEdit() {
            const showDiv = document.getElementById('showDiv');
            const editDiv = document.getElementById('editDiv');
            showDiv.style.display = 'none';
            editDiv.style.display = 'flex';
        }

        function disableEdit() {
            const editDiv = document.getElementById('editDiv');
            const showDiv = document.getElementById('showDiv');
            editDiv.style.display = 'none';
            showDiv.style.display = 'block  ';
            form.innerHTML = initialForm;
            questionNum.value = initialQuestionNum;
            for (let i = 1; i < questionNum.value; i++) {
                let deleteButtn = document.getElementById('delButt' + i);
                deleteButtn.onclick = () => {
                    deleteQuestion("questDiv" + i, i)
                };
            }
        }

        function addQuestion() {
            const deleteButtn = document.getElementById('delButtn').cloneNode(true);
            const newQuestion = document.getElementById('questDiv0').cloneNode(true);
            let n = parseInt(questionNum.value);


            newQuestion.id = "questDiv" + n;
            newQuestion.querySelector("#questLab0").innerText = "Question " + (n + 1) + ":";
            newQuestion.querySelector("#questLab0").for = "question" + n;
            newQuestion.querySelector("#questLab0").id = "questLab" + n;
            newQuestion.querySelector("#question0").name = "question" + n;
            newQuestion.querySelector("#question0").value = "";
            newQuestion.querySelector("#question0").id = "question" + n;
            newQuestion.querySelector("#isTrue0").checked = false;
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
                let inputDiv = document.getElementById("divInputs" + i)
                let deleteButtn = document.getElementById("delButt" + i);

                questionDiv.id = "questDiv" + (i - 1);

                questionLabel.id = "questLab" + (i - 1);
                questionLabel.for = "question" + (i - 1);
                questionLabel.innerText = "Question " + (i) + ": ";

                questionInput.id = "question" + (i - 1);
                questionInput.name = "question" + (i - 1);

                questionCheckbox.id = "isTrue" + (i - 1);
                questionCheckbox.name = "isTrue" + (i - 1);

                inputDiv.id = "divInputs" + (i - 1);

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
