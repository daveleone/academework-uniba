<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $topic->name }}
        </h2>
    </x-slot>
    <div style="display: flex; align-items:center; justify-content:center; flex-direction: column;">
        <div style="background-color: white">
            <form action="{{ route('exercise.createTf', ['id' => $topic->id]) }}" method="post" id="tf-Form">
                @csrf
                <input type="hidden" id="questionNum" name="questionNum" value="1">
                <div id="tf-FormDiv">
                    <div id="questDiv0">
                        <label for="question0" id = "questLab0">Question 1: </label>
                        <input type="text" id="question0" name="question0" required>
                        <input type="checkbox" id="isTrue0" name="isTrue0" value="1">
                        <label for="isTrue" id="isTrueLab0"> True?</label>
                    </div>
                </div>
            </form>
            <button onclick="addQuestion()">Add question</button>
            <button type="submit" form="tf-Form">Submit</button>
        </div>
    </div>

    <script>
        const questionNum = document.getElementById("questionNum");
        const form = document.getElementById("tf-FormDiv");

        function addQuestion(){
            const questionDiv =       document.createElement("div");
            const questionLabel =     document.createElement("label");
            const questionInput =     document.createElement("input");
            const questionCheckbox =  document.createElement("input");
            const checkboxLabel =     document.createElement("label");
            const deleteButtn =       document.createElement("button")
            let n = parseInt(questionNum.value);

            questionDiv.id = "questDiv" + n;

            questionLabel.id = "questLab" + n;
            questionLabel.for = "question" + n;
            questionLabel.innerText = "Question "+ (1 + n) + ": ";
            questionDiv.appendChild(questionLabel);

            questionInput.type = "text";
            questionInput.id = "question" + n;
            questionInput.name = "question" + n;
            questionDiv.appendChild(questionInput);

            questionCheckbox.type = "checkbox";
            questionCheckbox.id = "isTrue" + n;
            questionCheckbox.name = "isTrue" + n;
            questionCheckbox.value = "1";
            questionDiv.appendChild(questionCheckbox);

            checkboxLabel.id = "isTrueLab" + n;
            checkboxLabel.for = "isTrue" + n;
            checkboxLabel.innerText = " True?";
            questionDiv.appendChild(checkboxLabel);

            deleteButtn.id = "delButt" + n;
            deleteButtn.onclick = () => { deleteQuestion(questionDiv.id, n); };
            deleteButtn.innerText = " Delete";
            questionDiv.appendChild(deleteButtn);

            form.appendChild(questionDiv);
            questionNum.value++;
        }

        function deleteQuestion(divId, p){ // p := posizione elemento
            const divToDelete = document.getElementById(divId);
            let n = parseInt(questionNum.value);

            divToDelete.remove();
            if(p != n-1){
                for(let i = p+1; i < n; i++){
                    let questionDiv       = document.getElementById("questDiv"  + i);
                    let questionLabel     = document.getElementById("questLab"  + i);
                    let questionInput     = document.getElementById("question"  + i);
                    let questionCheckbox  = document.getElementById("isTrue"    + i);
                    let checkboxLabel     = document.getElementById("isTrueLab" + i);
                    let deleteButtn       = document.getElementById("delButt"   + i);

                    questionDiv.id = "questDiv" + (i - 1);

                    questionLabel.id = "questLab" + (i - 1);
                    questionLabel.for = "question" + (i - 1);
                    questionLabel.innerText = "Question "+ (i) + ": ";

                    questionInput.id = "question" + (i - 1);
                    questionInput.name = "question" + (i - 1);

                    questionCheckbox.id = "isTrue" + (i - 1);
                    questionCheckbox.name = "isTrue" + (i - 1);

                    checkboxLabel.id = "isTrueLab" + (i - 1);
                    checkboxLabel.for = "isTrue" + (i - 1);

                    deleteButtn.id = "delButt" + (i - 1);
                    deleteButtn.onclick = () => { deleteQuestion(questionDiv.id, i-1); };
                }
            }
            questionNum.value--;
        }
    </script>
</x-app-layout>
