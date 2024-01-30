<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Subjects') }}
        </h2>
    </x-slot>
    <div style="display: flex; align-items:center; justify-content:center; flex-direction: column;">
        <div style="background-color: white">
           @include('forms.create-subject')
           @foreach ($subjects as $subject)
           <div style="display:flex;" id="{{'subDiv'.$subject->id}}">
               <div style="margin: 2rem; align: left;">
                   <a href="{{ route('subject.topics', ['id' => $subject->id]) }}">
                       <p><b>Title: </b>{{ $subject->name }}</p>
                       <p><b>Description: </b>{{ $subject->description }}</p>
                   </a>
               </div>
               <div style="display: flex; justify-content: center; align-items: center; flex-direction: column">
                   <button onclick="enableEdit( '{{ $subject->id }}' )">Edit</button>
                   <form action="{{ route('subject.delete') }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="subId" value = {{ $subject->id }}>
                        <button type="submit" style="">Delete</button>
                   </form>
               </div>
           </div>
           <div id="{{'editDiv'.$subject->id}}" style="display: none;">
                <form action="{{ route('subject.edit') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="subId" value="{{ $subject->id }}">
                    <p>
                        <label for="{{ 'subName'.$subject->id }}">
                            <b>Title: </b>
                        </label>
                        <input type="text" id = "{{ 'subName'.$subject->id }}"
                        name = "{{ 'subName'.$subject->id }}" placeholder="{{ $subject->name }}">
                    </p>
                    <p>
                        <label for="{{ 'subDesc'.$subject->id }}">
                            <b>Description: </b>
                        </label>
                        <textarea
                            name="{{ 'subDesc'.$subject->id }}"
                            id="{{ 'subDesc'.$subject->id }}"
                            placeholder="{{ $subject->description }}"></textarea>
                    </p>
                    <button type="submit">Edit</button>
                </form>
                <button onclick="disableEdit('{{ $subject->id }}')">Abort</button>
            </div>
           @endforeach
        </div>
    </div>
    <script>
        function enableEdit(subId){
            const subDiv = document.getElementById('subDiv' + subId);
            const editDiv = document.getElementById('editDiv' + subId);
            subDiv.style.display = 'none';
            editDiv.style.display = 'flex';
        }

        function disableEdit(subId){
            const editDiv = document.getElementById('editDiv' + subId);
            const subDiv = document.getElementById('subDiv' + subId);
            const nameInput = document.getElementById('subName' + subId);
            const descInput = document.getElementById('subDesc' + subId);
            nameInput.value = null;
            descInput.value = null;
            editDiv.style.display = 'none';
            subDiv.style.display = 'flex';
        }
    </script>
</x-app-layout>
