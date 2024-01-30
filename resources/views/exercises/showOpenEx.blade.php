<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $exercise->topic->name . ' / ' . $exercise->name }}
        </h2>
    </x-slot>
    <div style="display: flex; align-items:center; justify-content:center; flex-direction: column;">
        <div style="background-color: white" id="showDiv">
           <p>{{ $exercise->description }}</p>
            @foreach ($exercise->elements as $element)
            <div>
                <textarea name="answer" id="answer" disabled>{{ $element->answer }}</textarea>
            </div>
            @endforeach
            <button onclick="enableEdit()">Edit</button>
            <form action="{{ route('exercise.delete', ['id' => $exercise->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
        <div id="editDiv" style="display:none;">
            <form action="{{ route('exercise.edit', ['id' => $exercise->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="exId" value="{{ $exercise->id }}">
                <div>
                    <label for="exName">Name: </label>
                    <input type="text"  id="exName" name="exName" placeholder="{{ $exercise->name }}">
                </div>
                <div>
                    <label for="exDescription">Description: </label>
                    <textarea id="exDescription" name="exDescription" placeholder="{{ $exercise->description }}"></textarea>
                </div>
                <div>
                    <label for="exPoints"> Points: </label>
                    <input type="number" id="exPoints" name="exPoints" min="1" placeholder="{{ $exercise->points }}">
                </div>
                @foreach ($exercise->elements as $element)
                <div>
                    <label for="exAnswer">Answer: </label>
                    <textarea name="exAnswer" id="exAnswer" placeholder="{{ $element->answer }}"></textarea>
                </div>
                @endforeach
                <button type="submit">Edit</button>
            </form>
            <button onclick="disableEdit()">Abort</button>
        </div>
    </div>
    <script>
        function enableEdit(){
            const showDiv = document.getElementById('showDiv');
            const editDiv = document.getElementById('editDiv');
            showDiv.style.display = 'none';
            editDiv.style.display = 'flex';
        }

        function disableEdit(){
            const editDiv = document.getElementById('editDiv');
            const showDiv = document.getElementById('showDiv');
            //const nameInput = document.getElementById('subName' + subId);
            //const descInput = document.getElementById('subDesc' + subId);
            //nameInput.value = null;
            //descInput.value = null;
            editDiv.style.display = 'none';
            showDiv.style.display = 'block  ';
        }
    </script>
</x-app-layout>
