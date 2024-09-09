<!DOCTYPE html>
<html>
<head>
    <title>{{ $quiz->name }}</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px;
            line-height: 1.6;
        }
        h1, h2, h3, h4 { 
            color: #333; 
            margin-bottom: 10px;
        }
        p {
            margin: 5px 0;
        }
        .exercise {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .exercise h3 {
            margin-bottom: 5px;
            color: #0056b3;
        }
        .question {
            margin-left: 20px;
            margin-top: 10px;
        }
        .question p {
            margin: 3px 0;
        }
        .question strong {
            display: block;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>{{ $quiz->name }}</h1>
    <p>{{ $quiz->description }}</p>
    
    <h2>Exercises:</h2>
    @foreach($quiz->exercises as $exercise)
    <div class="exercise">
        <h3>{{ $exercise->name }}</h3>
        <p>{{ $exercise->description }}</p>
        <p><strong>Type:</strong> {{ ucfirst($exercise->type) }}</p>
        <p><strong>Points:</strong> {{ $exercise->points }}</p>
        
        @foreach($exercise->elements as $element)
            <div class="question">
                @if($exercise->type === 'true/false')
                    <p><strong>Question:</strong> {{ $element->content }}</p>
                    <p><strong>True  |  False</strong></p>
                
                @elseif($exercise->type === 'open')
                
                @elseif($exercise->type === 'close')
                    <p><strong>Option:</strong> {{ $element->content }}</p>
                    
                    @php
                        $options = json_decode($element->options, true);
                    @endphp
                    @if(is_array($options))
                        <ul>
                            @foreach($options as $option)
                                <li>{{ $option }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>{{ $element->options }}</p>
                    @endif
                    
                
                @elseif($exercise->type === 'fill-in')

                @endif
            </div>
        @endforeach
    </div>
@endforeach

</body>
</html>
