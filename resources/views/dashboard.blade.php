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
        <h4>Bonjour {{explode(' ', $user->name)[0]}},</h4>
            <h4>L'impression de rapport pour le bar est désormais disponible dans l'onglet <a class="text-danger" href="/transactions">Transactions</a> ci haut.</h4>
            <br/>
            <br /><br/>
            <br /><br/>
            <br /><br/>
            <br /><br /><br/>
            <br /><br/>
            <br />
        </div>
    </div>
</div>
@endsection