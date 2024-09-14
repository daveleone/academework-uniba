<div class="m-2.5 w-[35rem] rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
    <p class="mb-3 text-gray-500 dark:text-gray-400">
        <strong class="font-semibold text-gray-900 dark:text-white">
        @lang('trad.Description')
        </strong>
        {{ $exercise->description }}
    </p>
    <ol
        class="max-w-md list-inside list-decimal space-y-1 text-gray-500 dark:text-gray-400"
    >
        <div class="grid grid-cols-2 gap-2 w-[50rem]">
            @foreach($exercise->elements()->orderBy("position")->get() as $element)
                    <li>
                        <span class="text-gray-900 dark:text-white">
                                {{ $element->content }}
                        </span>
                    </li>            
                    @if ($element->truth)
                        <x-heroicon-s-check-circle class="w-7 h-7 text-green-600"/>
                    @else
                        <div></div>
                    @endif
            @endforeach
        </div>
    </ol>
</div>
