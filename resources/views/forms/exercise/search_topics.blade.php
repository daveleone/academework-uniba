<div
    id="SearchTopics"
    class="h-[10rem] bg-white dark:bg-gray-700"
>
    <div class="p-3">
        <label for="input-group-search" class="sr-only">@lang('trad.Search topic')</label>
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
                placeholder="{{__('Search topics')}}"
            />
        </div>
    </div>
    <ul
        class="block h-[6rem] overflow-y-auto px-3 pb-3 text-sm text-gray-700 dark:text-gray-200"
        aria-labelledby="dropdownSearchTopicsButton"
        id="topic-list"
    >
    @foreach ($topics as $i => $topic)
        @php $subject = $topic->subject @endphp
        <li>
            <div
                class="flex items-center rounded ps-2 hover:bg-gray-100 dark:hover:bg-gray-600"
            >
                <input
                    id="radio-topic-{{ $i }}"
                    name="TopicId"
                    type="radio"
                    value="{{ $topic->id }}"
                    class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-700"
                    required
                />
                <label
                    for="radio-topic-{{ $i }}"
                    class="ms-2 w-full rounded py-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                >
                    {{$subject->name . ' \ ' . $topic->name }}
                </label>
            </div>
        </li>
    @endforeach
    </ul>
</div>



<script>
    // get input
    let input = document.getElementById('input-group-search');
    //get list of value
    let list = document.querySelectorAll('#topic-list li');

    //function search on the list.
    function search() {
        for (let i = 0; i < list.length; i += 1) {
            let label = list[i].querySelector('label');
            //check if the element contains the value of the input
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

    //to the change run search.
    input.addEventListener('input', search);
</script>
