<x-app-layout>
    <div>
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div class="mb-8 inline-flex items-center">
                    <a href="{{ url()->previous() }}">
                        <x-heroicon-o-chevron-left class="ml-1 mr-2 w-6 h-6" />
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">
                        {{ $exercise->topic->name }} / {{ $exercise->name }}
                    </h1>
                </div>
                <div class="mb-8 inline-flex items-center">
                    @include('forms.exercise.add_to_quiz')
                </div>
            </div>
    <div class="flex w-full flex-col items-center py-12 text-lg">
        <div id="showDiv">

            <div class="relative">
                <div class="absolute right-0">
                    <div class="flex flex-col grow-0">

                        <button type="button" onclick="enableEdit()" class="flex m-1 mr-0 text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <x-heroicon-o-pencil-square class="w-4 h-4"/>
                            <span class="sr-only">@lang('trad.Edit')</span>
                        </button>

                        <button
                            type="submit"
                            data-modal-target="DeleteEx-modal-{{ $exercise->id }}"
                            data-modal-toggle="DeleteEx-modal-{{ $exercise->id }}"
                            class="flex m-1 mr-0 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                        >
                            <x-heroicon-o-trash class="w-4 h-4"/>
                            <span class="sr-only">@lang('trad.Remove')</span>
                        </button>
                        @include("forms.exercise.delete", ["exercise" => $exercise])

                    </div>
                </div>

                @include('exercises.cards.fill')
            </div>
        </div>

        <div
            id="editDiv"
            class="m-2.5 flex hidden w-[30rem] flex-col rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800"
        >
            <form
                action="{{ route("exercise.edit", ["id" => $exercise->id]) }}"
                method="POST"
                id="fill-Form"
            >
                @csrf
                @method("PUT")
                <input type="hidden" name="exId" value="{{ $exercise->id }}" />
                <input
                    type="hidden"
                    id="elemNum"
                    name="elemNum"
                    value="{{ $exercise->elements->count() }}"
                />
                <div id="fill-FormDiv">
                    <div class="mb-[1rem]">
                        <label
                            for="exname"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            name:
                        </label>
                        <input
                            type="text"
                            id="exname"
                            name="exname"
                            placeholder="{{ $exercise->name }}"
                            class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                        />
                    </div>
                    <div class="mb-[1rem]">
                        <label
                            for="exDescription"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Description:
                        </label>
                        <textarea
                            id="exDescription"
                            name="exDescription"
                            placeholder="{{ $exercise->description }}"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        ></textarea>
                    </div>
                    <div class="mb-[1rem]">
                        <label
                            for="exPoints"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Points:
                        </label>
                        <input
                            type="number"
                            id="exPoints"
                            name="exPoints"
                            min="1"
                            placeholder="{{ $exercise->points }}"
                            class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                        />
                    </div>
                    @foreach ($exercise->elements()->orderBy("position")->get() as $element)
                        <div
                            id="{{ "elemDiv" . $element->position }}"
                            class="mb-[1rem] flex w-[17rem] flex-row items-center justify-between"
                        >
                            @switch($element->type)
                                @case("text")
                                    <input
                                        type="hidden"
                                        value="text"
                                        name="{{ "elemType" . $element->position }}"
                                        id="{{ "elemType" . $element->position }}"
                                    />
                                    <textarea
                                        name="{{ "element" . $element->position }}"
                                        id="{{ "element" . $element->position }}"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                        required
                                    >
{{ $element->content }}</textarea
                                    >

                                    @break
                                @case("input")
                                    <input
                                        type="hidden"
                                        value="input"
                                        name="{{ "elemType" . $element->position }}"
                                        id="{{ "elemType" . $element->position }}"
                                    />
                                    <input
                                        type="text"
                                        name="{{ "element" . $element->position }}"
                                        id="{{ "element" . $element->position }}"
                                        required
                                        class="block rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                        value="{{ $element->content }}"
                                    />

                                    @break
                            @endswitch
                        </div>
                    @endforeach
                </div>
            </form>
            <div class="mt-[2rem]">
                <div class="flex items-center justify-between space-x-4">
                    <button type="submit" form="fill-Form" class="group w-1/2 inline-flex justify-center py-3.5 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1">
                        @lang('trad.Edit')
                    </button>
                    <button type="submit" onclick="addTextElem()" class="group w-1/2 inline-flex justify-center py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-purple-950 hover:bg-pink-1100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1">
                        @lang('trad.Add text')
                    </button>
                    <button type="submit" onclick="addInputElem()" class="group w-1/2 inline-flex justify-center py-1 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-purple-950 hover:bg-pink-1100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1">
                        @lang('trad.Add input')
                    </button>
                    <button type="submit" onclick="disableEdit()" class="group w-1/2 inline-flex justify-center py-3.5 px-4 border border-gray-400 text-sm font-medium rounded-md text-black bg-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1">
                        @lang('trad.Abort')
                    </button>
                </div>
            </div>
        </div>
    </div>

    <button
        id="delButtn"
        type="button"
        class="me-2 ml-[1rem] mr-0 hidden items-center rounded-full bg-red-700 p-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
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
        const initialElemNum = elemNum.value;
        const form = document.getElementById('fill-Form');
        const submitButtn = document.getElementById('subEditBtn');
        const deleteButtnSample = document.getElementById('delButtn');

        for (let i = 0; i < elemNum.value; i++) {
            let elementDiv = document.getElementById('elemDiv' + i);
            let deleteButtn = deleteButtnSample.cloneNode(true);
            deleteButtn.id = 'delButt' + i;
            deleteButtn.style.display = 'block';
            deleteButtn.onclick = () => {
                deleteElement(elementDiv.id, i);
            };
            console.log(elementDiv.id);
            elementDiv.appendChild(deleteButtn);
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
            elemNum.value = initialElemNum;
            for (let i = 1; i < elemNum.value; i++) {
                let deleteButtn = document.getElementById('delButt' + i);
                deleteButtn.onclick = () => {
                    deleteQuestion('elemDiv' + i, i);
                };
            }
        }

        function addTextElem() {
            const elemDiv = document.createElement('div');
            const elem = document.createElement('textarea');
            const elemType = document.createElement('input');
            const deleteButtn = deleteButtnSample.cloneNode(true);
            let n = parseInt(elemNum.value);

            elemDiv.id = 'elemDiv' + n;
            elemDiv.className =
                'mb-[1rem] w-[17rem] flex flex-row items-center justify-between';

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
            elemDiv.appendChild(elemType);

            deleteButtn.id = 'delButt' + n;
            deleteButtn.style.display = 'block';
            deleteButtn.onclick = () => {
                deleteElement(elemDiv.id, n);
            };
            elemDiv.appendChild(deleteButtn);

            form.appendChild(elemDiv);
            elemNum.value++;

            submitButtn.disabled = elemNum.value == 0 ? true : false;
        }

        function addInputElem() {
            const elemDiv = document.createElement('div');
            const elem = document.createElement('input');
            const elemType = document.createElement('input');
            const deleteButtn = deleteButtnSample.cloneNode(true);
            let n = parseInt(elemNum.value);

            elemDiv.id = 'elemDiv' + n;
            elemDiv.className =
                'mb-[1rem] w-[17rem] flex flex-row items-center justify-between';

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
            elemDiv.appendChild(elemType);

            deleteButtn.id = 'delButt' + n;
            deleteButtn.style.display = "block";
            deleteButtn.onclick = () => {
                deleteElement(elemDiv.id, n);
            };
           elemDiv.appendChild(deleteButtn);

            form.appendChild(elemDiv);
            elemNum.value++;

            submitButtn.disabled = elemNum.value == 0 ? true : false;
        }

        function deleteElement(divId, p) {
            // p := posizione elemento
            const divToDelete = document.getElementById(divId);
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
                    deleteElement(elementDiv.id, i - 1);
                };
            }

            elemNum.value--;

            submitButtn.disabled = elemNum.value == 0 ? true : false;
        }
    </script>
</x-app-layout>
