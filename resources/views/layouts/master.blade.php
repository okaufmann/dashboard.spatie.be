<!DOCTYPE html>
<html>
    <head>
        <title>Laravel Dashboard</title>
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,900' rel='stylesheet'
              type='text/css'>

        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css"/>

        <link href="{{ elixir("css/app.css") }}" rel="stylesheet"/>

        <meta name="google" value="notranslate">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body class="dashboard">

        @yield('content')

        <script src="{{ elixir("js/app.js") }}"></script>
    </body>
</html>