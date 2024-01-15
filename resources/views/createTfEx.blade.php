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
                    <div>
                        <label for="question">Question 1: </label>
                        <input type="text" id="question0" name="question0" required>
                        <input type="checkbox" id="isTrue0" name="isTrue0" value="1">
                        <label for="isTrue"> True?</label>
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
            const questionDiv = document.createElement("div");
            const questionLabel = document.createElement("label");
            const questionInput = document.createElement("input");
            const questionCheckbox = document.createElement("input");
            const checkboxLabel = document.createElement("label");
            let n = parseInt(questionNum.value);

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

            checkboxLabel.for = "isTrue" + n;
            checkboxLabel.innerText = " True?";
            questionDiv.appendChild(checkboxLabel);

            form.appendChild(questionDiv);
            questionNum.value++;
        }
    </script>
</x-app-layout>
