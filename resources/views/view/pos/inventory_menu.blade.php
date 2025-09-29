@extends('layout.pos')
@section('content')

<div class="container-fluid" style="">
    <div class="row" style="margin:0px;padding:0px;">
        <div class="col-md-12">
            <h1 class="text-center" style="margin-top:5%;min-height:50px">Inventaire</h1>
            <hr />
        </div>
        <div class="col-6 text-center" style="">
            <div class="text-start">
                <a class="btn btn-lg btn-default" href="/pos?token={{$token}}" style="border: 1px solid black">Fermer la session</a>
            </div>
        </div>
        <div class="col-12">
            <br /><br />
        </div>
        <div class="col-12">
            <a class="btn btn-success btn-lg form-control" style="padding-top:2%;padding-bottom:2%;">Ajout à l'inventaire</a>
            <br /><br />
            <a href="/pos/inventory/count/{{$cashier_id}}?token={{$token}}" class="btn btn-danger btn-lg form-control" style="padding-top:2%;padding-bottom:2%;">Inventaire complet</a>
        </div>
    </div>
</div>
<script>
</script>
@endsection