<div class="m-2.5 rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
    <p class="mb-3 text-gray-500 dark:text-gray-400">
        <strong class="font-semibold text-gray-900 dark:text-white">
            {{ __("Description: ") }}
        </strong>
        {{ $exercise->description }}
    </p>

    <p class="mb-3 text-gray-500 dark:text-gray-400">
        @foreach ($exercise->elements()->orderBy("position")->get() as $element)
            @switch($element->type)
                @case("text")
                    {{ $element->content }}

                    @break
                @case("input")
                    <input
                        type="text"
                        id="{{ "answer" . $element->position }}"
                        value="{{ $element->content }}"
                        disabled
                        class="focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-[1rem] rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                    />

                    @break
            @endswitch
        @endforeach
    </p>
</div>
