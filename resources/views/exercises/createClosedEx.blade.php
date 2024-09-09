<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $topic->name }}
        </h2>
    </x-slot>
    <div class="py-12 flex flex-col items-center w-full">            
        <form action="{{ route('exercise.createClosed', ['id' => $topic->id]) }}" method="post" id="closed-Form">
            @csrf
            <input type="hidden" id="answerNum" name="answerNum" value="1">
            <div id="closed-FormDiv"  class="w-60 m-10">
                <div id="ansDiv0" class="w-[17rem] mb-[1rem]">
                    <label for="answer0" id = "ansLab0" class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('trad.Answer 1:') </label>
                    <div class="flex flex-row justify-start items-center">
                        <input type="text" id="answer0" name="answer0" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> 
                        <div class="ml-[1rem] flex flex-row justify-evenly items-center" id="divInputs0">                    
                            <input type="radio" id="isTrue0" name="isTrue" value="0" class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="isTrue0" id="isTrueLab0" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"> @lang('trad.True?')</label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="ml-10">
            <button onclick="addAnswer()" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">@lang('trad.Add answer')</button>
            <button type="submit" form="closed-Form" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">@lang('trad.Submit')</button>
        </div>        
    </div>

    <button id="delButtn" type="button" class=" hidden ml-[1rem] mr-0 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
        </svg>
        <span class="sr-only">@lang('trad.Delete')</span>
    </button>

    <script>
        const answerNum = document.getElementById("answerNum");
        
        const form = document.getElementById("closed-FormDiv");
        const deleteButtnSample = document.getElementById("delButtn");
        const answer0 = document.getElementById("ansDiv0").cloneNode(true);

        function addAnswer(){
            const deleteButtn = deleteButtnSample.cloneNode(true);
            const newAnswer = answer0.cloneNode(true);
            let n = parseInt(answerNum.value);

            newAnswer.id = "ansDiv" + n;
            newAnswer.querySelector("#ansLab0").innerText = "Answer " + (n + 1) + ":";
            newAnswer.querySelector("#ansLab0").for = "answer" + n;
            newAnswer.querySelector("#ansLab0").id = "ansLab" + n;
            newAnswer.querySelector("#answer0").name = "answer" + n;
            newAnswer.querySelector("#answer0").id = "answer" + n;
            newAnswer.querySelector("#isTrue0").value = n;
            newAnswer.querySelector("#isTrue0").id = "isTrue" + n;
            newAnswer.querySelector("#isTrueLab0").for = "isTrue" + n;
            newAnswer.querySelector("#isTrueLab0").id = "isTrueLab" + n;
            newAnswer.querySelector("#divInputs0").id = "divInputs" + n;

            deleteButtn.id = "delButt" + n;
            deleteButtn.style.display = "block";
            deleteButtn.onclick = () => { deleteAnswer(n); };
            newAnswer.querySelector("#divInputs" + n).appendChild(deleteButtn);

            form.appendChild(newAnswer);
            answerNum.value++;
        }

        function deleteAnswer(p){ // p := posizione elemento
            const divToDelete = document.getElementById("ansDiv" + p);
            let n = parseInt(answerNum.value);

            divToDelete.remove();
            for(let i = p+1; i < n; i++){
                let answerDiv       = document.getElementById("ansDiv"  + i);
                let answerLabel     = document.getElementById("ansLab"  + i);
                let answerInput     = document.getElementById("answer"  + i);
                let answerRadio  = document.getElementById("isTrue"    + i);
                let radioLabel     = document.getElementById("isTrueLab" + i);
                let deleteButtn       = document.getElementById("delButt"   + i);
                let inputsDiv = document.getElementById("divInputs" + i);

                answerDiv.id = "ansDiv" + (i - 1);

                answerLabel.id = "ansLab" + (i - 1);
                answerLabel.for = "answer" + (i - 1);
                answerLabel.innerText = "Answer "+ (i) + ": ";

                answerInput.id = "answer" + (i - 1);
                answerInput.name = "answer" + (i - 1);

                answerRadio.value = i - 1;
                answerRadio.id = "isTrue" + (i - 1);

                radioLabel.id = "isTrueLab" + (i - 1);
                radioLabel.for = "isTrue" + (i - 1);

                inputsDiv.id = "divInputs" + (i - 1);
                deleteButtn.id = "delButt" + (i - 1);
                deleteButtn.onclick = () => { deleteAnswer(i-1); };
            }

            answerNum.value--;
        }
    </script>
</x-app-layout>
