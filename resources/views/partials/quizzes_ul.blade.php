<ul
    class="h-48 overflow-y-auto px-3 pb-3 text-sm text-gray-700 dark:text-gray-200"
    aria-labelledby="dropdownSearchButton"

>
{{--    <input type="hidden" name="exId" value="{{ $exercise->id }}">--}}
    @foreach($quizzes as $i => $quiz)
        <li id="quizList">
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

