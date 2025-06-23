@extends('layout.app')
@section('title', 'Galerie d\'images')
@section('content')

<img class="w-100" src="/images/banner.jpg">
<br/><br />
<div class="container text-justify">
    <div class="content-item">
        <p>Notre galerie d'images est présentement en montage. Comme une image vaut mille mots, vous aurez bientôt la chance d'en découvrir plus sur la Légion Royale Canadienne - Filiale 101 de Grand-Mère. Au plaisir!</p>
    </div>
    <div class="content-item text-center">
        <img src="/images/legion.jpg" style="height:500px">
    </div>
</div>
@endsection