@extends('layout.app')
@section('content')

<div class="container">
    @if($exception->getMessage() === 'account_suspended')
        <div class="text-center my-5 py-5">
            <img src="/images/logo_dev.svg" height="100px"/>
            <br /><br />
            <h4>Service Technologique J.Bédard</h4>
            <h4>819-852-8705</h4>
            <br /><br />
            <hr />
            <br /><br />
            <h1 class="text-danger">Le système est désormais verrouillé</h1>
            <h4>Pour plus d'information demandé Cde Jimmy Béland-Bédard au 819-852-8705.</h4>
        </div>
    @else
        <h1>Accès refusé</h1>
        <p>Vous n'avez pas la permission d'accéder à cette ressource.</p>
    @endif
</div>

@endsection