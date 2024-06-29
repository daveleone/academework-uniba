<x-app-layout>
    <x-slot name="header">
        <h2
            class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
        >
            {{ $topic->name }}
        </h2>
    </x-slot>
    <div class="flex w-full flex-col items-center py-12">
        <div class="flex w-full flex-col items-center py-12">
            <form
                action="{{ route("exercise.createFill", ["id" => $topic->id]) }}"
                method="post"
                id="fill-Form"
            >
                @csrf
                <input
                    type="hidden"
                    id="elemNum"
                    name="elemNum"
                    value="0"
                    min="1"
                />
                <div id="fill-FormDiv"></div>
            </form>
            <div class="ml-10">
                <button
                    onclick="addTextElem()"
                    class="mb-2 me-2 rounded-lg bg-gray-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                >
                    Add text
                </button>
                <button
                    onclick="addInputElem()"
                    class="mb-2 me-2 rounded-lg bg-gray-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                >
                    Add input
                </button>
                <button
                    id="submitButtn"
                    type="submit"
                    form="fill-Form"
                    disabled
                    class="mb-2 me-2 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    Submit
                </button>
            </div>
        </div>
    </div>

    <button
        id="delButtn"
        type="button"
        class="me-2 mr-0 hidden items-center rounded-full bg-red-700 p-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
            class="h-4 w-4"
        >
            <path
                fill-rule="evenodd"
                d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                clip-rule="evenodd"
            />
        </svg>
        <span class="sr-only">Delete</span>
    </button>

    <script>
        const elemNum = document.getElementById('elemNum');
        const form = document.getElementById('fill-FormDiv');
        const submitButtn = document.getElementById('submitButtn');
        const deleteButtnSample = document.getElementById('delButtn');

        function addTextElem() {
            const elemDiv = document.createElement('div');
            const elem = document.createElement('textarea');
            const elemType = document.createElement('input');
            const divInputs = document.createElement('div');
            const deleteButtn = deleteButtnSample.cloneNode(true);
            let n = parseInt(elemNum.value);

            elemDiv.id = 'elemDiv' + n;
            elemDiv.className =
                'mb-[1rem] w-[17rem] flex flex-row items-center justify-between';

            divInputs.className =
                'ml-[1rem] flex flex-row items-center justify-evenly';

            elemType.type = 'hidden';
            elemType.value = 'text';
            elemType.id = 'elemType' + n;
            elemType.name = 'elemType' + n;

            elem.id = 'element' + n;
            elem.name = 'element' + n;
            elem.required = true;

            elem.className =
                'block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500';

            elemDiv.appendChild(elem);
            elemDiv.appendChild(divInputs);
            elemDiv.appendChild(elemType);

            deleteButtn.id = 'delButt' + n;
            deleteButtn.style.display = 'block';
            deleteButtn.onclick = () => {
                deleteElement(n);
            };
            divInputs.appendChild(deleteButtn);

            form.appendChild(elemDiv);
            elemNum.value++;

            submitButtn.disabled = elemNum.value == 0 ? true : false;
        }

        function addInputElem() {
            const elemDiv = document.createElement('div');
            const elem = document.createElement('input');
            const elemType = document.createElement('input');
            const divInputs = document.createElement('div');
            const deleteButtn = deleteButtnSample.cloneNode(true);
            let n = parseInt(elemNum.value);

            elemDiv.id = 'elemDiv' + n;
            elemDiv.className =
                'mb-[1rem] w-[17rem] flex flex-row items-center justify-between';

            divInputs.className =
                'ml-[1rem] flex flex-row items-center justify-evenly';

            elemType.type = 'hidden';
            elemType.value = 'input';
            elemType.id = 'elemType' + n;
            elemType.name = 'elemType' + n;

            elem.type = 'text';
            elem.id = 'element' + n;
            elem.name = 'element' + n;
            elem.required = true;
            elem.className =
                'block rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500';

            elemDiv.appendChild(elem);
            elemDiv.appendChild(divInputs);
            elemDiv.appendChild(elemType);

            deleteButtn.id = 'delButt' + n;
            deleteButtn.style.display = 'block';
            deleteButtn.onclick = () => {
                deleteElement(n);
            };
            divInputs.appendChild(deleteButtn);

            form.appendChild(elemDiv);
            elemNum.value++;

            submitButtn.disabled = elemNum.value == 0 ? true : false;
        }

        function deleteElement(p) {
            // p := posizione elemento
            const divToDelete = document.getElementById('elemDiv' + p);
            let n = parseInt(elemNum.value);

            divToDelete.remove();

            for (let i = p + 1; i < n; i++) {
                let elementDiv = document.getElementById('elemDiv' + i);
                let elementType = document.getElementById('elemType' + i);
                let elementInput = document.getElementById('element' + i);
                let deleteButtn = document.getElementById('delButt' + i);

                elementDiv.id = 'elemDiv' + (i - 1);

                elementType.id = 'elemType' + (i - 1);
                elementType.name = 'elemType' + (i - 1);

                elementInput.id = 'element' + (i - 1);
                elementInput.name = 'element' + (i - 1);

                deleteButtn.id = 'delButt' + (i - 1);
                deleteButtn.onclick = () => {
                    deleteElement(i - 1);
                };
            }

            elemNum.value--;

            submitButtn.disabled = elemNum.value == 0 ? true : false;
        }
    </script>
</x-app-layout>
