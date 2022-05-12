<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ strip_tags($msg['subject']) }}</title>
</head>
<body>
    <h2><strong>Títol: </strong> {{ strip_tags($msg['subject']) }}</h2>
    <p><strong>Nom: </strong>{{ strip_tags($msg['name']) }}</p>
    <p><strong>Email: </strong>{{ strip_tags($msg['email']) }}</p>
    <p><strong>Missatge: </strong>{{ strip_tags($msg['message']) }}</p>
</body>
</html>