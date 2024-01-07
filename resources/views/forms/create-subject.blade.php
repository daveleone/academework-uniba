<div>
    <form action="{{ route('subject.create') }}" method="post" id="CreateSub">
        @csrf
        <div>
            <label for="Subname">Name</label>
            <input type="text"  id="SubName" name="SubName" required>
        </div>
        <div>
            <label for="SubDescription"> Description </label>
            <textarea id="SubDescription" name="SubDescription" required></textarea>
        </div>
        <div>
            <button type="submit">Create</button>
        </div>

    </form>
</div>
