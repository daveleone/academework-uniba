<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __($subject->name . ' topics' ) }}
            </h2>

            @include('forms.topic.create')
        </div>
    </x-slot>
    <div class="flex items-center flex-col">
        <div class="py-12 flex flex-wrap justify-center w-4/5">
            @foreach ($topics as $topic)
            <x-cardNDE id="{{ $topic->id }}" editModal="EditTop-modal-{{ $topic->id }}" deleteModal="DeleteTop-modal-{{ $topic->id }}" href="{{ route('topic.exercises', ['id' => $topic->id]) }}">
                <x-slot name="name">{{ $topic->name }}</x-slot>
                <x-slot name="description">{{ $topic->description }}</x-slot>
            </x-cardNDE>
            @include('forms.topic.edit', ['topic' => $topic, 'subject' => $subject])
            @include('forms.topic.delete', ['topic' => $topic, 'subject' => $subject])
            @endforeach
        </div>
    </div>
</x-app-layout>
