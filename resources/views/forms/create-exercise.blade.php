<div>
    <form action="{{ route('exercise.createInit', ['id' => $topic->id]) }}" method="post" id="CreateEx">
        @csrf
        <div>
            <label for="ExName">Name: </label>
            <input type="text"  id="ExName" name="ExName" required>
        </div>
        <div>
            <label for="ExDescription">Description: </label>
            <textarea id="ExDescription" name="ExDescription" required></textarea>
        </div>
        <div>
            <label for="ExPoints"> Points: </label>
            <input type="number" id="ExPoints" name="ExPoints" min="1" required>
        </div>
        <div>
            <label for="ExType">Choose a type:</label>
            <select id="ExType" name="ExType" form="CreateEx">
                <option value="true/false">True or false</option>
                <option value="open">Open question</option>
                <option value="close">Closed question</option>
                <option value="fill-in">Fill in text</option>
            </select>
        </div>
        <div>
            <button type="submit">Next</button>
        </div>
    </form>
</div>
