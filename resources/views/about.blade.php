<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1, minimum scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>About</title>

        <link rel="stylesheet" href="css/app.css">
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <h1>Halaman About</h1>
        <h1><?= $name; ?></h1>
        <h1><?= $email; ?></h1>
    <script src="js/script.js"></script>
    </body>
</html>
