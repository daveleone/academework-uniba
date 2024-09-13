<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <a href="{{ route('subject.topics', ['id' => $topic->subject->id]) }}">{{ $topic->subject->name }}</a> / {{$topic->name}} @lang('trad.Exercises')
            </h2>

            @include('forms.create-exercise')
        </div>
    </x-slot>
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($exercises as $exercise)
            <x-card-NDE type="{{$exercise->type}}" points="{{$exercise->points}}" href="{{ route('exercise.show', ['id' => $exercise->id]) }}" hrefName="View Exercise">
                <x-slot name="name">{{ $exercise->name }}</x-slot>
                <x-slot name="description">{{ $exercise->description }}</x-slot>
                <x-slot name="icon">
                    <x-heroicon-o-document-text class="h-5 w-5" />
                </x-slot>
            </x-card-NDE>
            @endforeach
        </div>
    </div>
</x-app-layout>
