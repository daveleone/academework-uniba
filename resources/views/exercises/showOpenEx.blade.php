<x-app-layout>
    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div class="mb-8 inline-flex items-center">
                    <a href="{{ route('topic.exercises', ['id' => $exercise->topic->id]) }}">
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

            @include('exercises.cards.open')

            <div class="mt-[1rem] flex flex-row">
                <button
                    onclick="enableEdit()"
                    class="mb-2 me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                >
                    Edit
                </button>
                <button
                    type="submit"
                    data-modal-target="DeleteEx-modal-{{ $exercise->id }}"
                    data-modal-toggle="DeleteEx-modal-{{ $exercise->id }}"
                    class="mb-2 me-2 rounded-lg bg-red-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                >
                    Delete
                </button>
                @include("forms.exercise.delete", ["exercise" => $exercise])
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
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        ></textarea>
                    </div>
                @endforeach
            </form>
            <div class="mt-[2rem] flex flex-row">
                <button
                    type="submit"
                    form="open-Form"
                    class="mb-2 me-2 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    Edit
                </button>
                <button
                    type="button"
                    onclick="disableEdit()"
                    class="mb-2 me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                >
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
