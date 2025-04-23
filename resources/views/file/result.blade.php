<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notification</title>
</head>

<body>
    <style>
        .container {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .question-container {
            margin-bottom: 15px;
        }

        .question-label {
            font-weight: bold;
            font-size: 16px;
            color: #333;
        }

        .answer-list {
            list-style-type: disc;
            margin-left: 20px;
            color: #555;
        }

        .answer-item {
            font-size: 14px;
        }
    </style>

    <div class="container">
        @foreach ($result as $key => $value)
            <div class="question-container">
                @if (!is_null($value['question']))
                    <label class="question-label">{{ $key. '. ' . $value['question'] }}</label>
                    <ul class="answer-list">
                        <li class="answer-item">{{ $value['answer'] }}</li>
                    </ul>
                @endif
            </div>
        @endforeach
    </div>
</body>

</html>
