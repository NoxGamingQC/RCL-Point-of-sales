@extends('layout.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br />
            <h1>Tableau de bord</h1>
            <hr />
            <br />
        <div class="col-md-12">
            <h3>Total de la veille: {{$yesterday_count}}</h3>
            <h3>Total aujourd'hui: {{$today_count}}</h3>
            <br/>
        </div>
        <div class="col-md-12">
        <h1>Bonjour {{explode(' ', $user->name)[0]}},</h1>
            <h4>L'impression de rapport est présentement en maintenance. Ne vous inquiété pas, les données sont tout de même sauvegarder et vous allez pouvoir imprimer le rapport sous peu.</h4>
            <br/>
        </div>
    </div>
</div>
@endsection