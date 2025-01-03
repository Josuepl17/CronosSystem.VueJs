<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">

    <title>Cronos</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<style>
    * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
        text-decoration: none;
        font-size: 13px;
        font-family: Arial, Helvetica, sans-serif;
    }
</style>

<body class="font-sans antialiased" style="width: 100%;">
    @inertia
</body>

</html>