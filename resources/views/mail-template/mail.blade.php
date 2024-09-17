<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #2c3e50;
        }
        p {
            font-size: 16px;
            color: #34495e;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ciao!</h2>
        <p>Il quiz <strong>{{ $quizName }}</strong> è stato aggiunto al corso <strong>{{ $courseName }}</strong>.</p>
        <p>Accedi al corso per ulteriori informazioni.</p>
        <a href="route('student.show')" class="button">Vai al corso</a>
    </div>
</body>
</html>
