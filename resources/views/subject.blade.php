<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subject') }}
        </h2>
    </x-slot>
    <div style="display: flex; align-items:center; justify-content:center;">
        <div style="background-color: white">
           @include('forms.create-subject')
        </div>
    </div>
</x-app-layout>
