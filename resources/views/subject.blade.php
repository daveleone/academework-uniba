<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subject') }}
        </h2>
    </x-slot>
    <div style="display: flex; align-items:center; justify-content:center; flex-direction: column;">
        <div style="background-color: white">
           @include('forms.create-subject')
        </div>

        @foreach ($subjects as $subject)
            <div>
                <p><b>Title:</b> {{ $subject->name }}</p>
                <p><b>Description:</b>  {{ $subject->description }}</p>
            </div>
        @endforeach

    </div>
</x-app-layout>
