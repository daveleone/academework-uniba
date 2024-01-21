<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $topic->name }}
        </h2>
    </x-slot>
    <div style="display: flex; align-items:center; justify-content:center; flex-direction: column;">
        <div style="background-color: white">
            <form action="{{ route('exercise.createOpen', ['id' => $topic->id]) }}" method="post" id="open-Form">
                @csrf
                <input type="hidden" id="questionNum" name="questionNum" value="1">
                <div>
                    <div>
                        <label for="exAnswer">Answer: </label>
                        <textarea name="exAnswer" id="exAnswer"></textarea>
                    </div>
                </div>
            </form>
            <button type="submit" form="open-Form">Submit</button>
        </div>
    </div>
</x-app-layout>
