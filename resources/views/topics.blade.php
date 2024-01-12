<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Topics') }}
            </h2>
        </x-slot>
        <div style="display: flex; align-items:center; justify-content:center; flex-direction: column;">
            <div style="background-color: white">
                <h2>{{$subject->name}}</h2>
            </div>

        </div>
    </x-app-layout>

</div>
