<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>{{ $quiz->name }}</title>
</head>
<style>
    @page {
        size: A4;
        margin: 2cm;
    }
    body {
        font-family: 'Times New Roman', Times, serif;
        line-height: 1.5;
        font-size: 12pt;
    }
    .question {
        margin-bottom: 15px;
    }
    .question-content {
        margin-bottom: 5px;
    }
    .answer-space {
        border: 1px solid #000;
        padding-bottom: 2px;
        min-height: 150px;
    }
</style>

<body>
<div class="header">
    <h1>{{ $quiz->name }}</h1>
    <div class="quiz-info">
        <p>{{ $quiz->description }}</p>
        <p>@lang('trad.Name'): _________________________ @lang('trad.Date'): ______________</p>
    </div>
</div>
                @foreach ($quiz->exercises as $exercise)
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2 text-gray-800">{{ $exercise->question }}</h3>
                        @switch($exercise->type)
                            @case('true/false')
                                @include('student.exercises.tf_question')
                                @break
                            @case("open")
                                <div class="question">
                                    <div class="question-content">@lang('trad.Question'): {{ $exercise->description }}</div>
                                    <div class="answer-space"></div>
                                </div>
                                @break
                            @case('close')
                                @include('student.exercises.closed_question')
                                @break
                            @case('fill-in')
                                @include('student.exercises.pdf_fill_question')
                                @break
                        @endswitch
                    </div>
                @endforeach
</body>
</html>

