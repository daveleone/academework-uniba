<x-app-layout>
    <x-guest-layout>
        <div>
            <form action="{{ route('courses.store') }}" method="POST">
                @method('POST')
                @csrf
                <div>
                    <x-input-label for="name" :value="__('Class Name')"/>
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"  required autofocus autocomplete="name" />
                </div>
                <div class="mt-4">
                    <x-input-label for="description" :value="__('Class Description')"/>
                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"  required autofocus autocomplete="name" />
                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-4">
                        @lang('trad.Create class')
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-guest-layout>
</x-app-layout>
