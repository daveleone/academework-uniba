<div>
    <form action="{{ route('topic.create', ['id' => $subject->id]) }}" method="post" id="CreateTopic">
        @csrf
        <div>
            <label for="TopicName">Name</label>
            <input type="text"  id="TopicName" name="TopicName" required>
        </div>
        <div>
            <label for="TopicDescription"> Description </label>
            <textarea id="TopicDescription" name="TopicDescription" required></textarea>
        </div>
        <div>
            <button type="submit">Create</button>
        </div>
    </form>
</div>
