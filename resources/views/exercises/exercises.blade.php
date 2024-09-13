<x-app-layout>
        <div class="bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-between items-center mb-8">

                    <div class="mb-8 inline-flex items-center">
                        <a href="{{ route('subject.topics', ['id' => $topic->subject->id]) }}">
                            <x-heroicon-o-chevron-left class="ml-1 mr-2 w-6 h-6" />
                        </a>
                        <h1 class="text-3xl font-bold text-gray-900">
                            {{ $topic->subject->name }} - {{$topic->name}} @lang('trad.Exercises')
                        </h1>
                    </div>
                    <div class="mb-8 inline-flex items-center">
                        @include('forms.create-exercise')
                    </div>
                </div>




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
    </div>
</x-app-layout>
