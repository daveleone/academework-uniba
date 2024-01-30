<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $topic->name }}
        </h2>
    </x-slot>
    <div style="display: flex; align-items:center; justify-content:center; flex-direction: column;">
        <div style="background-color: white">
            <form action="{{ route('exercise.createFill', ['id' => $topic->id]) }}" method="post" id="fill-Form">
                @csrf
                <input type="hidden" id="elemNum" name="elemNum" value="0" min="1">
                <div id="fill-FormDiv">

                </div>
            </form>
            <button onclick="addTextElem()">Add text</button>
            <button onclick="addInputElem()">Add input</button>
            <button id="submitButtn" type="submit" form="fill-Form" disabled>Submit</button>
        </div>
    </div>

    <script>
        const elemNum = document.getElementById("elemNum");
        const form = document.getElementById("fill-FormDiv");
        const submitButtn = document.getElementById("submitButtn");

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
