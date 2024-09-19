<div
    @if(isset($id))
    {{ $id }}
    @endif
    class="m-2.5 overflow-hidden rounded-lg bg-white p-6 shadow-md transition-shadow duration-300 hover:shadow-lg dark:bg-gray-700"
>
    <div class="flex flex-row justify-between">
        <h3 class="mb-2 text-xl font-semibold text-gray-800 dark:text-white">
            {{ $name }}
        </h3>

        @if(isset($sub_top) and $sub_top != '')
            <div>
                <span class="ml-2 inline-flex items-center px-1.5 py-1 rounded-lg text-xs font-small bg-indigo-100 text-indigo-800">
                {{ $sub_top }}
                </span>
            </div>
        @elseif(isset($icon))

            {{ $icon }}
        @endif
    </div>
    <p class="mb-4 text-gray-600 dark:text-gray-300">@if(isset($description)){{ $description }}@endif </p>
    <div class="flex items-center justify-between">
        <a
            @if(isset($href)) href="{{ $href }}" @endif
            class="font-medium text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300"
            dusk="nde-link"
        >
            @if(isset($hrefName)) @lang($hrefName) @endif
        </a>
        <div class="flex space-x-2">
            @if(isset($editModal) and $editModal != "")
            <button
                x-data="" x-on:click.prevent="$dispatch('open-modal', '{{$editModal}}')"
                class="@if(isset($displayEdit)){{ $displayEdit }}@endif text-gray-600 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-300"
                dusk="nde-edit-button"
            >
                <x-heroicon-o-pencil class="h-5 w-5" />
            </button>
            @endif

            @if(@isset($deleteModal) and $deleteModal != "")
            <button
                    x-data="" x-on:click.prevent="$dispatch('open-modal', '{{$deleteModal}}')"
                class="@if(isset($displayDelete)){{ $displayDelete }}@endif text-gray-600 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400"
                dusk="nde-delete-button"
            >
                <x-heroicon-o-trash class="h-5 w-5" />
            </button>
            @endif
        </div>
        <div class="@if(isset($displayExFoot)){{ $displayExFoot }}@endif ">
            <p
                class="mb-2 text-sm tracking-tight text-gray-900 dark:text-white"
            >
            @if(isset($type) and isset($points))
                @switch($type)
                    @case('true/false')
                        @lang('trad.True False')
                        @break
                    @case('open')
                        @lang('trad.Open')
                        @break
                    @case('close')
                        @lang('trad.Closed')
                        @break
                    @case('fill-in')
                        @lang('trad.Fill In')
                        @break
                @endswitch
                <br />
                {{ $points }}
                @lang("trad.Points")
            @endif
            </p>
        </div>
    </div>
</div>
