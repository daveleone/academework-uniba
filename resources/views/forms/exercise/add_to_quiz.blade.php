<button
    id="dropdownSearchButton"
    data-dropdown-toggle="dropdownSearch"
    data-dropdown-placement="bottom"
    class="cursor-pointer inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-300 hover:-translate-y-1"
    type="button"
>
    <x-heroicon-s-plus class="w-5 h-5 mr-2" />
    @lang('trad.Add to quiz')
</button>




<!-- Dropdown menu -->
<div
    id="dropdownSearch"
    class="z-10 hidden w-60 rounded-lg bg-white shadow dark:bg-gray-700"
>
    <div class="p-3">
        <label for="input-group-search" class="sr-only">@lang('trad.Search quiz')</label>
        <div class="relative">
            <div
                class="rtl:inset-r-0 pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3"
            >
                <svg
                    class="h-4 w-4 text-gray-500 dark:text-gray-400"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 20 20"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                    />
                </svg>
            </div>
            <input
                type="text"
                id="input-group-search"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 ps-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                placeholder="@lang('trad.Search quiz')"
            />
        </div>
    </div>
    <form id="quizForm" action="{{ route("quiz.addExercise") }}" method="POST">
        @csrf
        @method("POST")
        <ul
            class="h-48 overflow-y-auto px-3 pb-3 text-sm text-gray-700 dark:text-gray-200"
            aria-labelledby="dropdownSearchButton"
            id="quiz-list"
        >
            <input type="hidden" name="exId" value="{{ $exercise->id }}" />
            @foreach ($quizzes as $i => $quiz)
                <li>
                    <div
                        class="flex items-center rounded ps-2 hover:bg-gray-100 dark:hover:bg-gray-600"
                    >
                        <input
                            id="checkbox-quiz-{{ $i }}"
                            name="checkbox-quiz-{{ $i }}"
                            type="checkbox"
                            value="{{ $quiz->id }}"
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-700"
                        />
                        <label
                            for="checkbox-quiz-{{ $i }}"
                            class="ms-2 w-full rounded py-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >
                            {{ $quiz->name }}
                        </label>
                    </div>
                </li>
            @endforeach
        </ul>
        <button
            @if($quizzes->count() == 0)
                disabled
            @endif
            type="submit"
            class="flex w-[100%] items-center rounded-b-lg border-t border-gray-200 bg-gray-50 p-3 text-sm font-medium text-red-600 hover:bg-gray-100 hover:underline dark:border-gray-600 dark:bg-gray-700 dark:text-blue-500 dark:hover:bg-gray-600"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-7 pr-1"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                />
            </svg>
            @lang('trad.Add')
        </button>
    </form>
</div>

<script>
    let input = document.getElementById('input-group-search');
    let list = document.querySelectorAll('#quiz-list li');

    function search() {
        for (let i = 0; i < list.length; i += 1) {
            let label = list[i].querySelector('label');
            if (
                label.innerText
                    .toLowerCase()
                    .includes(input.value.toLowerCase())
            ) {
                list[i].style.display = 'block';
            } else {
                list[i].style.display = 'none';
            }
        }
    }

    input.addEventListener('input', search);

    document.getElementById('quizForm').addEventListener('submit', function(event) {
        const checkboxes = document.querySelectorAll('#quiz-list input[type="checkbox"]');

        const isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

        if (!isChecked) {
            event.preventDefault();
        }
    });
</script>
