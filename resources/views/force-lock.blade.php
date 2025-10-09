@extends('layout.pos')
@section('title', 'Caisse vérrouillée')
@section('content')

<div class="container py-5">
    <div class="row text-center py-5">
        <div class="col-12">
            <img src="/images/logo_dev.svg" style="max-width:100px;">
            <br /><br />
            <h4>Service Technologique J.Bédard</h4>
            <h4>819-852-8705</h4>
            <br />
            <hr />
            <br />
            <br />
            <h1 class="text-danger">Le système est désormais verrouillé</h1>
            <h4>Pour plus d'information demandé Cde Jimmy Béland-Bédard au 819-852-8705.</h4>
            <br />
            <br />
            <input type="button" id="reloadPage" class="btn btn-danger" value="Recharger la page">
        </div>
    </div>
</div>
<br />
<br />
<script>
$('#reloadPage').on('click', function() {
    window.location.reload();
})
</script>
@endsection