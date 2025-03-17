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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
        <link href="/css/app.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="/js/app.js"></script>
    </head>
    <body>
        <div id="content" style="margin:0px !important;padding:0px !important">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <br />
                                <div class="text-left"><h1>Connexion au tableau de bord</h1></div>
                                <hr />
                                @include('layout.alert')
                            </div>
                            <div class="col-md-3 text-left">
                                <img src="/logo.png" width="100%">
                                <br /><br />
                                <h4>{{env('PHONE_NUMBER')}}</h4>
                                <h4>{{env('ADDRESS')}}</h4>
                                <br />
                                <br />
                                <br />
                                <br />
                                <br />
                            </div>
                            <div class="text-center col-md-8">
                                <br /><br /><br />
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="row mb-8  text-center">
                                        <label for="email" class="col-md-4 col-form-label text-md-end text-right">Courriel</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <br />
                                    </div>
                                    <div class="row mb-3  text-center">
                                        <label for="password" class="col-md-4 col-form-label text-md-end text-right">Mot de passe</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <br />
                                    </div>
                                    <div class="row mb-0 text-center">
                                        <div class="col-md-12 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Se connecter
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link text-danger" href="{{ route('password.request') }}">
                                                    Mot de passe oublié?
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layout.footer')
    </body>
</html>

