<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" property='og:description' content="@yield('description', 'Point of sale')">
        <meta property='og:image:width' content='500' />
        <meta property='og:image:height' content='500' />
        <meta property="og:type" content='website' />
        <meta name="author" content="J.Bédard Tech Services">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta id="csrf" name="csrf-token" content="{{ csrf_token() }}">
        <title>POS {{env('NAME') ? '- ' . env('NAME') : ''}}</title>
        <link rel="icon" href="{{env('ICON')}}" type="image/png">
        <link href="{{mix('css/bootstrap.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
        <link href="/css/app.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="/js/app.js"></script>
    </head>
    <body>
        @include('layout.navbar')
        <div id="content" style="margin:0px !important;padding:0px !important">
            @yield('content')
        </div>
        <script type="text/javascript">
            console.log('%c{{trans('general.console_wait')}}', 'color:#F80; font-size:60px; font-weight: bold; -webkit-text-stroke: 1px black;');
            console.log('%c{!!trans('general.console_copy_paste01')!!}', 'color:#FFF; font-size:18px;');
            console.log('%c{{trans('general.console_copy_paste02')}}', 'color:#F00; font-size:18px;');
            console.log('%c{{trans('general.console_close_window')}}', 'color:#FFF; font-size:18px;');
        </script>
    </body>
</html>
