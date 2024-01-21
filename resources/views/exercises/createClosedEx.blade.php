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
                    <div>
                        <p>Select the correct answer</p>
                        <label for="answer0">Answer 1: </label>
                        <input type="text" id="answer0" name="answer0" required>
                        <input type="radio" id="isTrue0" name="isTrue0" value="0">
                        <label for="isTrue0"> True?</label>
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
            const answerDiv = document.createElement("div");
            const answerLabel = document.createElement("label");
            const answerInput = document.createElement("input");
            const answerRadio = document.createElement("input");
            const checkboxLabel = document.createElement("label");
            let n = parseInt(answerNum.value);

            answerLabel.for = "answer" + n;
            answerLabel.innerText = "Answer "+ (1 + n) + ": ";
            answerDiv.appendChild(answerLabel);

            answerInput.type = "text";
            answerInput.id = "answer" + n;
            answerInput.name = "answer" + n;
            answerDiv.appendChild(answerInput);

            answerRadio.type = "radio";
            answerRadio.id = "isTrue" + n;
            answerRadio.name = "isTrue" + n;
            answerRadio.value = "1";
            answerDiv.appendChild(answerRadio);

            checkboxLabel.for = "isTrue" + n;
            checkboxLabel.innerText = " True?";
            answerDiv.appendChild(checkboxLabel);

            form.appendChild(answerDiv);
            answerNum.value++;
        }
    </script>
</x-app-layout>
