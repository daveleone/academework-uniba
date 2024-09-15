<x-app-layout>
    <div class="">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex items-center justify-between">
                <div class="mb-8 inline-flex items-center">
                    <a href="{{ route("dashboard") }}">
                        <x-heroicon-o-chevron-left class="ml-1 mr-2 h-6 w-6" />
                    </a>
                    <h2 class="text-3xl font-bold leading-tight text-gray-900">
                        @lang("trad.Subjects")
                    </h2>
                </div>
                <div class="mb-8 inline-flex items-center">
                    <a
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'create-subject')"
                        class="inline-flex cursor-pointer items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white ring-indigo-300 transition duration-300 ease-in-out hover:-translate-y-1 hover:bg-indigo-700 focus:border-indigo-900 focus:outline-none focus:ring active:bg-indigo-900 disabled:opacity-25"
                    >
                        <x-heroicon-s-plus class="mr-2 h-5 w-5" />
                        @lang("trad.Add subject")
                    </a>
                </div>
            </div>
            @if($subjects->count() > 0)
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($subjects as $subject)
                        <x-cardNDE
                            editModal="edit-subject-{{ $subject->id }}"
                            deleteModal="delete-subject-{{ $subject->id }}"
                            href="{{ route('subject.topics', ['id' => $subject->id]) }}"
                            hrefName="View Topics"
                        >
                            <x-slot name="name">
                                {{ $subject->name }}
                            </x-slot>
                            <x-slot name="description">
                                {{ $subject->description }}
                            </x-slot>
                            <x-slot name="icon">
                                <x-heroicon-o-bookmark class="mr-1 h-7 w-7" />
                            </x-slot>
                        </x-cardNDE>
                        @include("forms.subject.edit", ["subject" => $subject])
                        @include("forms.subject.delete", ["subject" => $subject])
                    @endforeach
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <x-heroicon-o-academic-cap class="mx-auto h-12 w-12 text-gray-400" />
                        <h3 class="mt-2 text-sm font-medium text-gray-900">@lang('trad.No subjects')</h3>
                        <p class="mt-1 text-sm text-gray-500">@lang('trad.Get started by creating a new subject')</p>
                    </div>
                </div>
            @endif
            </div>
        </div>
    @include("forms.subject.create")
</x-app-layout>
