<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $exercise->topic->name . ' / ' . $exercise->name}}
        </h2>
    </x-slot>
    <div style="display: flex; align-items:center; justify-content:center; flex-direction: column;">
        <div style="background-color: white" id="showDiv">
           <p>{{ $exercise->description }}</p>
            @foreach ($exercise->elements()->orderBy('position')->get() as $element)
            <div>
                <label for="{{ 'answer' . $element->position }}">{{ $element->content }}</label>
                <input type="radio" id="{{ 'answer' . $element->position }}"
                value="{{ $element->position }}" @if ($element->truth) checked @endif disabled>
            </div>
            @endforeach
            <button onclick="enableEdit()">Edit</button>
            <form action="{{ route('exercise.delete', ['id' => $exercise->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
        <div id="editDiv" style="display:none;">
            <form action="{{ route('exercise.edit', ['id' => $exercise->id]) }}" method="POST" id="closed-Form">
                @csrf
                @method('PUT')
                <input type="hidden" name="exId" value="{{ $exercise->id }}">
                <input type="hidden" id="answerNum" name="answerNum" value="{{ $exercise->elements->count() }}">
                <div id="closed-FormDiv">
                    <div>
                        <label for="exName">Name: </label>
                        <input type="text"  id="exName" name="exName" placeholder="{{ $exercise->name }}">
                    </div>
                    <div>
                        <label for="exDescription">Description: </label>
                        <textarea id="exDescription" name="exDescription" placeholder="{{ $exercise->description }}"></textarea>
                    </div>
                    <div>
                        <label for="exPoints"> Points: </label>
                        <input type="number" id="exPoints" name="exPoints" min="1" placeholder="{{ $exercise->points }}">
                    </div>
                    @foreach ($exercise->elements()->orderBy('position')->get() as $element)
                    <div  id="{{'ansDiv' . $element->position}}">
                        <label for="{{ 'exAnswer' . $element->position }}" id="{{'ansLab'.$element->position}}">Answer {{ $element->position + 1 }}: </label>
                        <input type="text" name="{{ 'exAnswer' . $element->position }}"
                            id="{{ 'exAnswer' . $element->position }}"
                            value="{{ $element->content }}" required
                        >
                        <input type="radio" id="{{ 'isTrue' . $element->position}}"
                            name="isTrue" value="{{$element->position}}"
                            @if($element->truth) checked @endif
                        >
                        <label for="{{ 'isTrue' . $element->position}}" id="{{ 'isTrueLab' . $element->position}}"> True?</label>

                    </div>
                    @endforeach
                </div>
            </form>
            <button type="submit" form="closed-Form">Edit</button>
            <button onclick="addAnswer()">Add answer</button>
            <button onclick="disableEdit()">Abort</button>
        </div>
    </div>
    <script>
        const answerNum = document.getElementById("answerNum");
        const form = document.getElementById("closed-Form");

        for(let i = 1; i<answerNum.value; i++){
            let answerDiv = document.getElementById('ansDiv' + i);
            let deleteButtn = document.createElement('button');
            deleteButtn.id = "delButt" + i;
            deleteButtn.onclick = () => { deleteAnswer(answerDiv.id, i); };
            deleteButtn.innerText = " Delete";
            answerDiv.appendChild(deleteButtn);
        }

        const initialForm = form.innerHTML;

        function enableEdit(){
            const showDiv = document.getElementById('showDiv');
            const editDiv = document.getElementById('editDiv');
            showDiv.style.display = 'none';
            editDiv.style.display = 'flex';
        }

        function disableEdit(){
            const editDiv = document.getElementById('editDiv');
            const showDiv = document.getElementById('showDiv');
            editDiv.style.display = 'none';
            showDiv.style.display = 'block  ';
            form.innerHTML = initialForm;
        }

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
            answerLabel.for = "exAnswer" + n;
            answerLabel.innerText = "Answer "+ (1 + n) + ": ";
            answerDiv.appendChild(answerLabel);

            answerInput.type = "text";
            answerInput.id = "exAnswer" + n;
            answerInput.name = "exAnswer" + n;
            answerInput.required = true;
            answerDiv.appendChild(answerInput);

            answerRadio.type = "radio";
            answerRadio.id = "isTrue" + n;
            answerRadio.name = "isTrue";
            answerRadio.value = n;
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
            for(let i = p+1; i < n; i++){
                let answerDiv       = document.getElementById("ansDiv"  + i);
                let answerLabel     = document.getElementById("ansLab"  + i);
                let answerInput     = document.getElementById("exAnswer"  + i);
                let answerRadio  = document.getElementById("isTrue"    + i);
                let radioLabel     = document.getElementById("isTrueLab" + i);
                let deleteButtn       = document.getElementById("delButt"   + i);

                answerDiv.id = "ansDiv" + (i - 1);

                answerLabel.id = "ansLab" + (i - 1);
                answerLabel.for = "exAnswer" + (i - 1);
                answerLabel.innerText = "Answer "+ (i) + ": ";

                answerInput.id = "exAnswer" + (i - 1);
                answerInput.name = "exAnswer" + (i - 1);

                answerRadio.id = "isTrue" + (i - 1);
                answerRadio.name = "isTrue" + (i - 1);

                radioLabel.id = "isTrueLab" + (i - 1);
                radioLabel.for = "isTrue" + (i - 1);

                deleteButtn.id = "delButt" + (i - 1);
                deleteButtn.onclick = () => { deleteAnswer(answerDiv.id, i-1); };
            }

            answerNum.value--;
        }
    </script>
</x-app-layout>
