<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <a href="{{ route('subject.topics', ['id' => $topic->subject->id]) }}">{{ $topic->subject->name }}</a> / {{$topic->name}}
            </h2>

            @include('forms.create-exercise')
        </div>
    </x-slot>
    <div class="flex items-center flex-col">
        <div class="py-12 flex flex-wrap justify-center w-4/5">
            @foreach ($exercises as $exercise)
            <x-card-NDE type="{{$exercise->type}}" points="{{$exercise->points}}" href="{{ route('exercise.show', ['id' => $exercise->id]) }}">
                <x-slot name="name">{{ $exercise->name }}</x-slot>
                <x-slot name="description">{{ $exercise->description }}</x-slot>
            </x-card-NDE>
            @endforeach
        </div>
    </div>
</x-app-layout>
