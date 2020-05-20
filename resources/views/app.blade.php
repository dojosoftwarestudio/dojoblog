<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
      {{--   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> --}}
        <link rel="stylesheet" href="{{ asset('/css/all.css')}}">
        <script>
            (() => {
                window.Laravel = {
                    csrfToken : '{{ csrf_token() }}'
                }
            })()
        </script>
    </head>
    <body id="page-top">
        <div id="app">
            <mainapp></mainapp>
        </div>
        <script src="{{ asset('/js/app.js') }}"></script>
    </body>
</html>
