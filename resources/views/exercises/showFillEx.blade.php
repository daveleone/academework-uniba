<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $exercise->topic->name . ' / ' . $exercise->name }}
        </h2>
    </x-slot>
    <div style="display: flex; align-items:center; justify-content:center; flex-direction: column;">
        <div style="background-color: white" id="showDiv">
           <p>{{ $exercise->description }}</p>

           <p>
               @foreach ($exercise->elements()->orderBy('position')->get() as $element)
                   @switch($element->type)
                       @case('text')
                           {{ $element->content }}
                           @break

                       @case('input')
                           <input type="text" id = "{{ 'answer' . $element->position }}" value="{{ $element->content }}" disabled>
                           @break
                   @endswitch
               @endforeach
           </p>
           <button onclick="enableEdit()">Edit</button>
            <form action="{{ route('exercise.delete', ['id' => $exercise->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
        <div id="editDiv" style="display:none;">
            <form action="{{ route('exercise.edit', ['id' => $exercise->id]) }}" method="POST" id="fill-Form">
                @csrf
                @method('PUT')
                <input type="hidden" name="exId" value="{{ $exercise->id }}">
                <input type="hidden" id="elemNum" name="elemNum" value="{{ $exercise->elements->count() }}">
                <div id="fill-FormDiv">
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
                    <div id="{{'elemDiv' . $element->position}}">
                        @switch($element->type)
                        @case('text')
                           <input type="hidden" value="text" name="{{'elemType'.$element->position}}"
                            id="{{'elemType'.$element->position}}"
                           >
                           <textarea name="{{'element'.$element->position}}"
                            id="{{'element'.$element->position}}" required
                           >{{$element->content}}</textarea>
                           @break
                        @case('input')
                            <input type="hidden" value="input" name="{{'elemType'.$element->position}}"
                             id="{{'elemType'.$element->position}}"
                            >
                            <input type="text" name="{{'element'.$element->position}}"
                                id="{{'element'.$element->position}}" required
                                value="{{$element->content}}"
                            >
                            @break
                        @endswitch
                    </div>
                    @endforeach
                </div>
            </form>
            <button type="submit" form="fill-Form" id="subEditBtn">Edit</button>
            <button onclick="addTextElem()">Add text</button>
            <button onclick="addInputElem()">Add input</button>
            <button onclick="disableEdit()">Abort</button>
        </div>
    </div>
    <script>
        const elemNum = document.getElementById("elemNum");
        const form = document.getElementById("fill-Form");
        const submitButtn = document.getElementById("subEditBtn");

        for(let i = 0; i<elemNum.value; i++){
            let elementDiv = document.getElementById('elemDiv' + i);
            let deleteButtn = document.createElement('button');
            deleteButtn.id = "delButt" + i;
            deleteButtn.onclick = () => { deleteElement(elementDiv.id, i); };
            deleteButtn.innerText = " Delete";
            elementDiv.appendChild(deleteButtn);
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

        function addTextElem(){
            const elemDiv     = document.createElement("div");
            const elem        = document.createElement("textarea");
            const elemType    = document.createElement("input");
            const deleteButtn = document.createElement("button");
            let n = parseInt(elemNum.value);

            elemDiv.id = "elemDiv" + n;

            elemType.type = "hidden";
            elemType.value = "text";
            elemType.id = "elemType" + n;
            elemType.name = "elemType" + n;

            elem.id = "element" + n;
            elem.name = "element" + n;
            elem.required = true;
            elemDiv.appendChild(elem);
            elemDiv.appendChild(elemType);

            deleteButtn.id = "delButt" + n;
            deleteButtn.onclick = () => { deleteElement(elemDiv.id, n); };
            deleteButtn.innerText = " Delete";
            elemDiv.appendChild(deleteButtn);

            form.appendChild(elemDiv);
            elemNum.value++;

            submitButtn.disabled = elemNum.value == 0 ? true : false;
        }

        function addInputElem(){
            const elemDiv     = document.createElement("div");
            const elem        = document.createElement("input");
            const elemType    = document.createElement("input");
            const deleteButtn = document.createElement("button");
            let n = parseInt(elemNum.value);

            elemDiv.id = "elemDiv" + n;

            elemType.type = "hidden";
            elemType.value = "input";
            elemType.id = "elemType" + n;
            elemType.name = "elemType" + n;

            elem.type = "text";
            elem.id = "element" + n;
            elem.name = "element" + n;
            elem.required = true;
            elemDiv.appendChild(elem);
            elemDiv.appendChild(elemType);

            deleteButtn.id = "delButt" + n;
            deleteButtn.onclick = () => { deleteElement(elemDiv.id, n); };
            deleteButtn.innerText = " Delete";
            elemDiv.appendChild(deleteButtn);

            form.appendChild(elemDiv);
            elemNum.value++;

            submitButtn.disabled = elemNum.value == 0 ? true : false;
        }

        function deleteElement(divId, p){ // p := posizione elemento
            const divToDelete = document.getElementById(divId);
            let n = parseInt(elemNum.value);

            divToDelete.remove();

            for(let i = p+1; i < n; i++){
                let elementDiv    = document.getElementById("elemDiv"  + i);
                let elementType      = document.getElementById("elemType" + i);
                let elementInput  = document.getElementById("element"  + i);
                let deleteButtn   = document.getElementById("delButt"  + i);

                elementDiv.id = "elemDiv" + (i - 1);

                elementType.id = "elemType" + (i - 1);
                elementType.name = "elemType" + (i - 1);

                elementInput.id = "element" + (i - 1);
                elementInput.name = "element" + (i - 1);

                deleteButtn.id = "delButt" + (i - 1);
                deleteButtn.onclick = () => { deleteElement(elementDiv.id, i-1); };
            }

            elemNum.value--;

            submitButtn.disabled = elemNum.value == 0 ? true : false;
        }

    </script>
</x-app-layout>
