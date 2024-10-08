<x-app-layout>
    <div>
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">

                <div class="mb-8 inline-flex items-center">
                    <a href="{{ url()->previous() }}">
                        <x-heroicon-o-chevron-left class="ml-1 mr-2 w-6 h-6" />
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">
                        {{ __($subject->name ) }} @lang('trad.- topics')
                    </h1>
                </div>
                <div class="mb-8 inline-flex items-center">
                        @include("forms.topic.create")
                </div>
            </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($topics as $topic)
                        <x-card-n-d-e
                            id="{{ $topic->id }}"
                            icon="pencil"
                            editModal="edit-topic-{{ $topic->id }}"
                            deleteModal="delete-topic-{{ $topic->id }}"
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
                        </x-card-n-d-e>
                        @include("forms.topic.edit", ["topic" => $topic, "subject" => $subject])
                        @include("forms.topic.delete", ["topic" => $topic, "subject" => $subject])
                    @endforeach
                </div>
            {{$topics->links()}}
        </div>
    </div>
</x-app-layout>
