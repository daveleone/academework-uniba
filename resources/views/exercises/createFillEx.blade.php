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
            <button type="submit" form="fill-Form">Submit</button>
        </div>
    </div>

    <script>
        const elemNum = document.getElementById("elemNum");
        const form = document.getElementById("fill-FormDiv");

        function addTextElem(){
            const elemDiv = document.createElement("div");
            const elem = document.createElement("textarea");
            const elemType = document.createElement("input");
            let n = parseInt(elemNum.value);

            elemType.type = "hidden";
            elemType.value = "text";
            elemType.id = "elemType" + n;
            elemType.name = "elemType" + n;

            elem.id = "element" + n;
            elem.name = "element" + n;
            elem.required = true;
            elemDiv.appendChild(elem);
            elemDiv.appendChild(elemType);

            form.appendChild(elemDiv);
            elemNum.value++;
        }

        function addInputElem(){
            const elemDiv = document.createElement("div");
            const elem = document.createElement("input");
            const elemType = document.createElement("input");
            let n = parseInt(elemNum.value);

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

            form.appendChild(elemDiv);
            elemNum.value++;
        }

    </script>
</x-app-layout>
