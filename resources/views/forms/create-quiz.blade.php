<div>
    <form action="{{ route('quiz.create', ['id' => $topic->id]) }}" method="post" id="CreateQuiz">
        @csrf
        <div>
            <label for="QuizName">@lang('trad.Name'): </label>
            <x-text-input type="text" id="QuizName" name="QuizName" required />
        </div>
        <div>
            <label for="QuizDescription">@lang('trad.Description'): </label>
            <textarea id="QuizDescription" name="QuizDescription" required></textarea>
        </div>
        <div>
            <button type="submit">@lang('trad.Next')</button>
        </div>
    </form>
</div>
