<!doctype html>
<html lang="{{ app()->getLocale() }}" style="margin:-2px !important;padding:0px !important;background-color:#000">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" property='og:description' content="@yield('description', 'Point of sale')">
        <meta property='og:image:width' content='500' />
        <meta property='og:image:height' content='500' />
        <meta property="og:type" content='website' />
        <meta name="author" content="J.Bédard Tech Services">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>POS {{env('NAME') ? '- ' . env('NAME') : ''}}</title>
        <link rel="icon" href="{{env('ICON')}}" type="image/png"><link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ms+Madi&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="/js/app.js"></script>
        <style>
            .developper-font {
                font-family: "Ms Madi", cursive;
            }
        </style>
    </head>
    <body style="background-color:#FFF;overflow:hidden;margin:0px !important;padding:0px !important;width:1024px !important;height:768px !important">
        <div id="content" style="margin:0px !important;padding:0px !important">
            @yield('content')
        </div>
        <script type="text/javascript">
            console.log('%cAttention !!', 'color:#F80; font-size:60px; font-weight: bold; -webkit-text-stroke: 1px black;');
            console.log('%cSi quelqu\'un vous à demander de copier/coller quelque chode ici, il y a 11 chance sur 10 que ce sois une harnaque.', 'color:#FFF; font-size:18px;');
            console.log('%cCollez quelque chose ici, peux donner au attaquant accès à votre compte.', 'color:#F00; font-size:18px;');
            console.log('%cÀ moins que vous sachez ce que vous faites, fermez cette fenêtre et rester en sécurité.', 'color:#FFF; font-size:18px;');
        </script>
    </body>
</html>
