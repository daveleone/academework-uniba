@php


@endphp

<x-app-layout>
    <div>
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex items-center justify-between">
                <div class="mb-8 inline-flex items-center">
                    <a href="{{ url()->previous() }}">
                        <x-heroicon-o-chevron-left class="ml-1 mr-2 h-6 w-6" />
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">
                        @lang("trad.Exercises")
                    </h1>
                </div>
                <div class="mb-8 inline-flex items-center">
                    @include("forms.exercise.create-no-topic")
                </div>
            </div>

            @if ($exercises->count() > 0)
                <div
                    class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
                >
                    @foreach ($exercises as $exercise)
                        <x-card-NDE
                            type="{{$exercise->type}}"
                            points="{{$exercise->points}}"
                            href="{{ route('exercise.show', ['id' => $exercise->id]) }}"
                            hrefName="View Exercise"
                        >
                            <x-slot name="name">
                                {{ $exercise->name }}
                            </x-slot>
                            <x-slot name="description">
                                {{ $exercise->description }}
                            </x-slot>
                            <x-slot name="sub_top">
                                @php $topic = $exercise->topic; $subject = $topic->subject; @endphp
                                {{$subject->name . ' - ' . $topic->name }}
                            </x-slot>
                        </x-card-NDE>
                    @endforeach
                </div>
            @else
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <x-heroicon-o-academic-cap
                            class="mx-auto h-12 w-12 text-gray-400"
                        />
                        <h3 class="mt-2 text-sm font-medium text-gray-900">
                            @lang("trad.No exercises")
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            @lang("trad.Get started by creating a new exercise")
                        </p>
                    </div>
                </div>
            @endif

            {{ $exercises->links() }}
        </div>
    </div>
</x-app-layout>
