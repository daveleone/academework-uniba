<div
    {{ $id }}
    class="m-2.5 overflow-hidden rounded-lg bg-white p-6 shadow-md transition-shadow duration-300 hover:shadow-lg dark:bg-gray-700"
>
    <div class="flex flex-row justify-between">
        <h3 class="mb-2 text-xl font-semibold text-gray-800 dark:text-white">
            {{ $name }}
        </h3>

        @if($sub_top != '')
            <div>
                <span class="ml-2 inline-flex items-center px-1.5 py-1 rounded-lg text-xs font-small bg-indigo-100 text-indigo-800">
                {{ $sub_top }}
                </span>
            </div>
        @else
            {{ $icon }}
        @endif
    </div>
    <p class="mb-4 text-gray-600 dark:text-gray-300">{{ $description }}</p>
    <div class="flex items-center justify-between">
        <a
            href="{{ $href }}"
            class="font-medium text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300"
        >
            @lang($hrefName)
        </a>
        <div class="flex space-x-2">
            <button
                @if($editModal != "")
                    x-data="" x-on:click.prevent="$dispatch('open-modal', '{{$editModal}}')"
                @endif
                class="{{ $displayEdit }} text-gray-600 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-300"
            >
                <x-heroicon-o-pencil class="h-5 w-5" />
            </button>
            <button
                @if($deleteModal != "")
                    x-data="" x-on:click.prevent="$dispatch('open-modal', '{{$deleteModal}}')"
                @endif
                class="{{ $displayDelete }} text-gray-600 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400"
            >
                <x-heroicon-o-trash class="h-5 w-5" />
            </button>
        </div>
        <div class="{{ $displayExFoot }}">
            <p
                class="mb-2 text-sm tracking-tight text-gray-900 dark:text-white"
            >
                {{ $type }}
                <br />
                {{ $points }}
                @lang("trad.Points")
            </p>
        </div>
    </div>
</div>
