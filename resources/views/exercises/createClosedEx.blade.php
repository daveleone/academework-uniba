<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $topic->name }}
        </h2>
    </x-slot>
    <div style="display: flex; align-items:center; justify-content:center; flex-direction: column;">
        <div style="background-color: white">
            <form action="{{ route('exercise.createClosed', ['id' => $topic->id]) }}" method="post" id="closed-Form">
                @csrf
                <input type="hidden" id="answerNum" name="answerNum" value="1">
                <div id="closed-FormDiv">
                    <div id="ansDiv0">
                        <p>Select the correct answer</p>
                        <label for="answer0" id = "ansLab0">Answer 1: </label>
                        <input type="text" id="answer0" name="answer0" required>
                        <input type="radio" id="isTrue0" name="isTrue0" value="0">
                        <label for="isTrue0" id="isTrueLab0"> True?</label>
                    </div>
                </div>
            </form>
            <button onclick="addAnswer()">Add answer</button>
            <button type="submit" form="closed-Form">Submit</button>
        </div>
    </div>

    <script>
        const answerNum = document.getElementById("answerNum");
        const form = document.getElementById("closed-FormDiv");

        function addAnswer(){
            const answerDiv =   document.createElement("div");
            const answerLabel = document.createElement("label");
            const answerInput = document.createElement("input");
            const answerRadio = document.createElement("input");
            const radioLabel =  document.createElement("label");
            const deleteButtn = document.createElement("button");
            let n = parseInt(answerNum.value);

            answerDiv.id = "ansDiv" + n;

            answerLabel.id = "ansLab" + n;
            answerLabel.for = "answer" + n;
            answerLabel.innerText = "Answer "+ (1 + n) + ": ";
            answerDiv.appendChild(answerLabel);

            answerInput.type = "text";
            answerInput.id = "answer" + n;
            answerInput.name = "answer" + n;
            answerInput.required = true;
            answerDiv.appendChild(answerInput);

            answerRadio.type = "radio";
            answerRadio.id = "isTrue" + n;
            answerRadio.name = "isTrue" + n;
            answerRadio.value = "1";
            answerDiv.appendChild(answerRadio);

            radioLabel.id = "isTrueLab" + n;
            radioLabel.for = "isTrue" + n;
            radioLabel.innerText = " True?";
            answerDiv.appendChild(radioLabel);

            deleteButtn.id = "delButt" + n;
            deleteButtn.onclick = () => { deleteAnswer(answerDiv.id, n); };
            deleteButtn.innerText = " Delete";
            answerDiv.appendChild(deleteButtn);

            form.appendChild(answerDiv);
            answerNum.value++;
        }

        function deleteAnswer(divId, p){ // p := posizione elemento
            const divToDelete = document.getElementById(divId);
            let n = parseInt(answerNum.value);

            divToDelete.remove();
            if(p != n-1){
                for(let i = p+1; i < n; i++){
                    let answerDiv       = document.getElementById("ansDiv"  + i);
                    let answerLabel     = document.getElementById("ansLab"  + i);
                    let answerInput     = document.getElementById("answer"  + i);
                    let answerRadio  = document.getElementById("isTrue"    + i);
                    let radioLabel     = document.getElementById("isTrueLab" + i);
                    let deleteButtn       = document.getElementById("delButt"   + i);

                    answerDiv.id = "ansDiv" + (i - 1);

                    answerLabel.id = "ansLab" + (i - 1);
                    answerLabel.for = "answer" + (i - 1);
                    answerLabel.innerText = "Answer "+ (i) + ": ";

                    answerInput.id = "answer" + (i - 1);
                    answerInput.name = "answer" + (i - 1);

                    answerRadio.id = "isTrue" + (i - 1);
                    answerRadio.name = "isTrue" + (i - 1);

                    radioLabel.id = "isTrueLab" + (i - 1);
                    radioLabel.for = "isTrue" + (i - 1);

                    deleteButtn.id = "delButt" + (i - 1);
                    deleteButtn.onclick = () => { deleteAnswer(answerDiv.id, i-1); };
                }
            }
            answerNum.value--;
        }
    </script>
</x-app-layout>
