<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gambling Code Test</title>

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        
    </head>
    <body>
        
        <div id="app">
            <list :data="{{json_encode($arrayObj)}}">
                
            </list>
            
        </div>
        <script src="{{asset('js/app.js')}}"></script>
    </body>

</html>
