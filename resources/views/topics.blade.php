<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $subject->name }}
            </h2>
        </x-slot>
        <div style="display: flex; align-items:center; justify-content:center; flex-direction: column;">
            <div style="background-color: white">
                @include('forms.create-topic')

                @foreach ($topics as $topic)
                <div style="display:flex;" id="{{'topDiv'.$topic->id}}">
                    <div style="margin: 2rem; align: left;">
                        <a href="{{ route('topic.exercises', ['id' => $topic->id]) }}">
                            <p><b>Title: </b>{{ $topic->name }}</p>
                            <p><b>Description: </b>{{ $topic->description }}</p>
                        </a>
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center; flex-direction: column">
                        <button onclick="enableEdit( '{{ $topic->id }}' )">Edit</button>
                        <form action="{{ route('topic.delete', ['id' => $subject->id]) }}" method="POST">
                             @method('DELETE')
                             @csrf
                             <input type="hidden" name="topId" value = {{ $topic->id }}>
                             <button type="submit" style="">Delete</button>
                        </form>
                    </div>
                </div>
                <div id="{{'editDiv'.$topic->id}}" style="display: none;">
                    <form action="{{ route('topic.edit', ['id' => $subject->id]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="topId" value="{{ $topic->id }}">
                        <p>
                            <label for="{{ 'topName'.$topic->id }}">
                                <b>Title: </b>
                            </label>
                            <input type="text" id = "{{ 'topName'.$topic->id }}"
                            name = "{{ 'topName'.$topic->id }}" placeholder="{{ $topic->name }}">
                        </p>
                        <p>
                            <label for="{{ 'topDesc'.$topic->id }}">
                                <b>Description: </b>
                            </label>
                            <textarea
                                name="{{ 'topDesc'.$topic->id }}"
                                id="{{ 'topDesc'.$topic->id }}"
                                placeholder="{{ $topic->description }}"></textarea>
                        </p>
                        <button type="submit">Edit</button>
                    </form>
                    <button onclick="disableEdit('{{ $topic->id }}')">Abort</button>
                </div>
                @endforeach
            </div>
        </div>
    </x-app-layout>
    <script>
        function enableEdit(topId){
            const topDiv = document.getElementById('topDiv' + topId);
            const editDiv = document.getElementById('editDiv' + topId);
            topDiv.style.display = 'none';
            editDiv.style.display = 'flex';
        }

        function disableEdit(topId){
            const editDiv = document.getElementById('editDiv' + topId);
            const topDiv = document.getElementById('topDiv' + topId);
            const nameInput = document.getElementById('topName' + topId);
            const descInput = document.getElementById('topDesc' + topId);
            nameInput.value = null;
            descInput.value = null;
            editDiv.style.display = 'none';
            topDiv.style.display = 'flex';
        }
    </script>
</div>
