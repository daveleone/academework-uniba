<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $exercise->topic->name . ' / ' . $exercise->name }}
        </h2>
    </x-slot>
    <div class="py-12 flex flex-col items-center w-full">
        <div style="background-color: white" id="showDiv">
            <p class="mb-3 text-gray-500 dark:text-gray-400"><strong class="font-semibold text-gray-900 dark:text-white">{{__('Description: ')}}</strong> {{ $exercise->description }}</p>
            @foreach ($exercise->elements()->orderBy('position')->get() as $element)
            <div>
                <label for="{{ 'answer' . $element->position }}">{{ $element->content }}</label>
                <input type="checkbox" id="{{ 'answer' . $element->position }}" value="{{ $element->position }}" @if ($element->truth) checked @endif disabled>
            </div>
            @endforeach
            <button onclick="enableEdit()">@lang('trad.Edit')</button>
            <form action="{{ route('exercise.delete', ['id' => $exercise->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>

        <div id="editDiv" style="display:none;">
            <form action="{{ route('exercise.edit', ['id' => $exercise->id]) }}" method="POST" id="tf-Form">
                @csrf
                @method('PUT')
                <input type="hidden" name="exId" value="{{ $exercise->id }}">
                <input type="hidden" id="questionNum" name="questionNum" value="{{ $exercise->elements->count() }}">
                <div id="tf-FormDiv">
                    <div>
                        <label for="exName">@lang('trad.Name'): </label>
                        <input type="text" id="exName" name="exName" placeholder="{{ $exercise->name }}">
                    </div>
                    <div>
                        <label for="exDescription">@lang('trad.Description'): </label>
                        <textarea id="exDescription" name="exDescription" placeholder="{{ $exercise->description }}"></textarea>
                    </div>
                    <div>
                        <label for="exPoints"> @lang('trad.Points'): </label>
                        <input type="number" id="exPoints" name="exPoints" min="1" placeholder="{{ $exercise->points }}">
                    </div>
                    @foreach ($exercise->elements()->orderBy('position')->get() as $element)
                    <div id="{{'questDiv' . $element->position}}">
                        <label for="{{ 'question' . $element->position }}" id="{{'questLab'.$element->position}}">Question {{ $element->position + 1 }}: </label>
                        <input type="text" name="{{ 'question' . $element->position }}" id="{{ 'question' . $element->position }}" value="{{ $element->content }}" required>
                        <input type="checkbox" id="{{ 'isTrue' . $element->position}}" name="{{ 'isTrue' . $element->position}}" value="1" @if($element->truth) checked @endif
                        >
                        <label for="{{ 'isTrue' . $element->position}}" id="{{ 'isTrueLab' . $element->position}}"> True?</label>

                    </div>
                    @endforeach
                </div>
            </form>
            <button type="submit" form="tf-Form">@lang('trad.Edit')</button>
            <button onclick="addQuestion()">@lang('trad.Add answer')</button>
            <button onclick="disableEdit()">@lang('trad.Abort')</button>
        </div>
    </div>

    <script>
        const questionNum = document.getElementById("questionNum");
        const form = document.getElementById("tf-FormDiv");

        for (let i = 1; i < questionNum.value; i++) {
            let questionDiv = document.getElementById('questDiv' + i);
            let deleteButtn = document.createElement('button');
            deleteButtn.id = "delButt" + i;
            deleteButtn.onclick = () => {
                deleteQuestion(questionDiv.id, i);
            };
            deleteButtn.innerText = " Delete";
            questionDiv.appendChild(deleteButtn);
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
        }

        function addQuestion() {
            const questionDiv = document.createElement("div");
            const questionLabel = document.createElement("label");
            const questionInput = document.createElement("input");
            const questionCheckbox = document.createElement("input");
            const checkboxLabel = document.createElement("label");
            const deleteButtn = document.createElement("button");
            let n = parseInt(questionNum.value);

            questionDiv.id = "questDiv" + n;

            questionLabel.id = "questLab" + n;
            questionLabel.for = "question" + n;
            questionLabel.innerText = "Question " + (1 + n) + ": ";
            questionDiv.appendChild(questionLabel);

            questionInput.type = "text";
            questionInput.id = "question" + n;
            questionInput.name = "question" + n;
            questionInput.required = true;
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
            deleteButtn.onclick = () => {
                deleteQuestion(questionDiv.id, n);
            };
            deleteButtn.innerText = " Delete";
            questionDiv.appendChild(deleteButtn);

            form.appendChild(questionDiv);
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
