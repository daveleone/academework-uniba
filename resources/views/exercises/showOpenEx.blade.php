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

                @include('exercises.cards.open')
            </div>
        </div>

        <div
            id="editDiv"
            class="m-2.5 flex hidden w-[30rem] flex-col rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800"
        >
            <form
                action="{{ route("exercise.edit", ["id" => $exercise->id]) }}"
                method="POST"
                id="open-Form"
            >
                @csrf
                @method("PUT")
                <input type="hidden" name="exId" value="{{ $exercise->id }}" />
                <input
                    type="hidden"
                    id="questionNum"
                    name="questionNum"
                    value="{{ $exercise->elements->count() }}"
                />
                <div class="mb-[1rem]">
                    <label
                        for="exName"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                    >
                        Name:
                    </label>
                    <input
                        type="text"
                        id="exName"
                        name="exName"
                        placeholder="{{ $exercise->name }}"
                        class="focus:ring-indigo-500 focus:border-indigo-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-500 bg-white dark:text-white dark:placeholder-gray-400"
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
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
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
                        class="focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                    />
                </div>
                @foreach ($exercise->elements as $element)
                    <div>
                        <label
                            for="exAnswer"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Answer:
                        </label>
                        <textarea
                            name="exAnswer"
                            id="exAnswer"
                            placeholder="{{ $element->answer }}"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        ></textarea>
                    </div>
                @endforeach
            </form>
            <div class="mt-[2rem]">
                <div class="flex items-center justify-between space-x-4">
                    <button type="submit" form="open-Form" class="group w-1/2 inline-flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <x-heroicon-s-plus-circle class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" />
                        </span>
                        @lang('trad.Edit')
                    </button>
                    <button type="submit" onclick="disableEdit()" class="group w-1/2 inline-flex justify-center py-3 px-4 border border-gray-400 text-sm font-medium rounded-md text-black bg-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out transform hover:-translate-y-1">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <x-heroicon-s-x-circle class="h-5 w-5 text-gray-400 group-hover:text-gray-400" />
                        </span>
                        @lang('trad.Abort')
                    </button>
                </div>
            </div>
    </div>
    <script>
        initialForm = document.getElementById('editDiv').innerHTML;
        function enableEdit() {
            const showDiv = document.getElementById('showDiv');
            const editDiv = document.getElementById('editDiv');
            showDiv.style.display = 'none';
            editDiv.style.display = 'flex';
        }

        function disableEdit() {
            const editDiv = document.getElementById('editDiv');
            const showDiv = document.getElementById('showDiv');
            editDiv.innerHTML = initialForm;
            editDiv.style.display = 'none';
            showDiv.style.display = 'block  ';
        }
    </script>
</x-app-layout>
