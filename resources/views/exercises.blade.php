    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $topic->name }}
            </h2>
        </x-slot>
        <div style="display: flex; align-items:center; justify-content:center; flex-direction: column;">
            <div style="background-color: white">
                @include('forms.create-exercise')

                @foreach ($exercises as $exercise)
                <div style="display:flex; flex-direction: row;">
                    <div style="margin: 2rem; align: left;">
                        <a href="">
                            <p><b>Title: </b>{{ $exercise->name }}</p>
                            <p><b>Description: </b>{{ $exercise->description }}</p>
                            <p><b>Type: </b>{{ $exercise->type }}</p>
                            <p><b>Points: </b>{{ $exercise->points }}</p>
                        </a>
                    </div>
                    <button>Edit</button>
                </div>
                @endforeach
            </div>
        </div>
    </x-app-layout>
