<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
     <!--    <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <meta content="width=device-width,initial-scale=1,minimal-ui" name="viewport">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic|Material+Icons">
       
        {{-- <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" /> --}}
        <meta name="csrf-token" value="{{ csrf_token() }}" />


        {{-- <script src="https://cdn.jsdelivr.net/npm/quasar@v1.0.0/dist/lang/de.umd.min.js"></script>
        <script>
          Quasar.lang.set(Quasar.lang.de)
        </script> --}}
        
    </head>
    <body>
        <div id="app">
        
        </div>
        
        <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>

        <style>
        bg-dark {
            /* background: #1d1d1d !important; */
            background: red !important;
        }</style>
    </body>
</html>