<button
    id="dropdownSearchButton"
    data-dropdown-toggle="dropdownSearch"
    data-dropdown-placement="bottom"
    class="inline-flex items-center rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    type="button"
>
    Add to quiz
    <svg
        class="ms-3 h-2.5 w-2.5"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 10 6"
    >
        <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="m1 1 4 4 4-4"
        />
    </svg>
</button>

<!-- Dropdown menu -->
<div
    id="dropdownSearch"
    class="z-10 hidden w-60 rounded-lg bg-white shadow dark:bg-gray-700"
>
    <div class="p-3">
        <label for="input-group-search" class="sr-only">{{__('Search quiz')}}</label>
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
                placeholder="Search quiz"
            />
        </div>
    </div>
    <form action="{{route('quiz.addExercise', $exercise->id)}}" method="POST">
        @csrf
        @method('POST')
        @include('partials.quizzes_ul')
        <button
            type="submit"
            class="flex items-center rounded-b-lg border-t border-gray-200 bg-gray-50 p-3 text-sm font-medium text-red-600 hover:bg-gray-100 hover:underline dark:border-gray-600 dark:bg-gray-700 dark:text-blue-500 dark:hover:bg-gray-600 w-[100%]"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 pr-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
            Add
        </button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#input-group-search').on('keyup', function () {
            let query = $(this).val();
            $.ajax({
                url: "{{ route('exercise.search', $exercise->id) }}",
                type: "GET",
                data: {
                    'query': query
                },
                success: function (data) {
                    $('#dropdownSearch ul').html(data.html); // Update only the ul content
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
