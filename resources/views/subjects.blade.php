<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Subjects') }}
            </h2>

            @include('forms.subject.create')
        </div>
    </x-slot>
    <div class="flex items-center flex-col">
        <div class="py-12 flex flex-wrap justify-center w-4/5">
            @foreach ($subjects as $subject)
            <x-cardNDE id="{{ $subject->id }}" editModal="EditSub-modal-{{ $subject->id }}" deleteModal="DeleteSub-modal-{{ $subject->id }}" href="{{ route('subject.topics', ['id' => $subject->id]) }}">
                <x-slot name="name">{{ $subject->name }}</x-slot>
                <x-slot name="description">{{ $subject->description }}</x-slot>
            </x-cardNDE>
            @include('forms.subject.edit', ['subject' => $subject])
            @include('forms.subject.delete', ['subject' => $subject])
            @endforeach
        </div>
    </div>
</x-app-layout>
