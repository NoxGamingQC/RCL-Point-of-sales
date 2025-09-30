@extends('layout.pos')
@section('content')

<div class="container-fluid" style="">
    <div class="row" style="margin:0px;padding:0px;">
        <div class="col-md-12">
            <h1 class="text-center" style="margin-top:5%;min-height:50px">Inventaire complet</h1>
            <hr />
        </div>
        <div class="col-6 text-center">
            <div class="text-start">
                <a class="btn btn-lg btn-warning" href="/pos?token={{$token}}">Fermer la session</a>
            </div>
            <br /> <br />
        </div>
        <div class="col-12">
        </div>
        @foreach ($items as $item)
            <div class="col-2 text-center" style="background-image: url({{$item['image']}});background-size:cover;background-position:center;margin:0px !important;padding:0px !important;border: 1px solid black;max-height:75px;min-height:75px">
                <b style="padding:5px;background-color:#000;color:#FFF;border-radius:3px;">{{$item['name']}}</b>
                <br />
                <span style="padding:5px;background-color:#000;color:#FFF;border-radius:3px;">{{$item['inventory']}}</span>
            </div>
        @endforeach
        <div class="col-12 text-right">
            <br />
            <input class="btn btn-success" value="Sauvegarder">
        </div>
    </div>
</div>
<script>
</script>
@endsection