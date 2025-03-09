@extends('layout.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br/><br/>
            <h1>Bonjour {{explode(' ', $user->name)[0]}},</h1>
            <h4>L'impression de rapport est présentement en maintenance. Ne vous inquiété pas, les données sont tout de même sauvegarder et vous allez pouvoir imprimer le rapport sous peu.</h4>
            <br/><br/>
            <h4 class="text-center">J.Bédard Service Technologique - 819-852-8705</h4>
            <a id="logout" class="btn btn-danger btn-lg">Déconnexion</a>
        </div>
    </div>
</div>
@endsection