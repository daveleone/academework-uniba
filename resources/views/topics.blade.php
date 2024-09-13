<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                {{ __($subject->name . " topics") }}
            </h2>

            @include("forms.topic.create")
        </div>
    </x-slot>
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($topics as $topic)
                <x-cardNDE
                    id="{{ $topic->id }}"
                    icon="pencil"
                    editModal="EditTop-modal-{{ $topic->id }}"
                    deleteModal="DeleteTop-modal-{{ $topic->id }}"
                    href="{{ route('topic.exercises', ['id' => $topic->id]) }}"
                    hrefName="View Exercises"
                >
                    <x-slot name="name">{{ $topic->name }}</x-slot>
                    <x-slot name="description">
                        {{ $topic->description }}
                    </x-slot>
                    <x-slot name="icon">
                        <x-heroicon-o-book-open class="w-7 h-7 mr-1" />
                    </x-slot>
                </x-cardNDE>
                @include("forms.topic.edit", ["topic" => $topic, "subject" => $subject])
                @include("forms.topic.delete", ["topic" => $topic, "subject" => $subject])
            @endforeach
        </div>
    </div>
</x-app-layout>
