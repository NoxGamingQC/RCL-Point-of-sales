@extends('layout.pos')
@section('content')

<div class="row" style="margin:0px;padding:0px;">
    <div class="col-md-4 text-center" style="min-height:100vh;overflow:hidden;margin:0px;padding:0px;">
        <img src="{{env('LOGO')}}" alt="{{$name}}" style="margin-top:40%;width:85%">
        <br /><br />
        <h4>{{$phone_number}}</h4>
        <h4>{!!$address!!}</h4>
        <br />
        <hr />
        <br />
        <h2 class="developper-font"><b>Créé & maintenu par Service Technologique J.Bédard</b></h2>
        <h3 class="developper-font"><b>(819) 852-8705</b></h3>
    </div>
    <div class="col-md-4 text-center" style="min-height:100vh;overflow:hidden;margin:0px;padding:0px;">
        <h1 id="pin" style="margin-top:30%;min-height:50px" value=""></h1>
        <br/>
        <br/>
        <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:5%;padding-bottom:5%;padding-left:12%;padding-right:12%;" value="1"><h1>1</h1></a>
        <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:5%;padding-bottom:5%;padding-left:12%;padding-right:12%;" value="2"><h1>2</h1></a>
        <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:5%;padding-bottom:5%;padding-left:12%;padding-right:12%;" value="3"><h1>3</h1></a>
        <br/>
        <br/>
        <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:5%;padding-bottom:5%;padding-left:12%;padding-right:12%;" value="4"><h1>4</h1></a>
        <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:5%;padding-bottom:5%;padding-left:12%;padding-right:12%;" value="5"><h1>5</h1></a>
        <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:5%;padding-bottom:5%;padding-left:12%;padding-right:12%;" value="6"><h1>6</h1></a>
        <br/>
        <br/>
        <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:5%;padding-bottom:5%;padding-left:12%;padding-right:12%;" value="7"><h1>7</h1></a>
        <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:5%;padding-bottom:5%;padding-left:12%;padding-right:12%;" value="8"><h1>8</h1></a>
        <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:5%;padding-bottom:5%;padding-left:12%;padding-right:12%;" value="9"><h1>9</h1></a>
        <br />
        <br/>
        <a class="pinpad btn btn-lg btn-default" style="margin-left:32%;border-radius:50%;padding-top:5%;padding-bottom:5%;padding-left:12%;padding-right:12%;" value="0"><h1>0</h1></a>
        <a class="pin-erase btn btn-lg btn-default" style="border-radius:50%;padding-top:5%;padding-bottom:5%;padding-left:12%;padding-right:12%;"><h1><</h1></a>
    </div>
    <div class="col-md-4 text-center" style="min-height:100vh;overflow:hidden;margin:0px;padding:0px;">
        <br />
        <a class="menu-button btn btn-lg btn-danger" style="margin-left:10%;padding-top:5%;padding-bottom:5%;padding-left:12%;width:90%;max-width:90%"><h1>Menu</h1></a>
        <br />
        <br />
        <a class="btn btn-lg btn-danger disabled" disabled style="margin-left:10%;padding-top:5%;padding-bottom:5%;padding-left:12%;width:90%;max-width:90%"><h1>Inventaire</h1></a>
        <br />
        <br /><a class="btn btn-lg btn-danger disabled" disabled style="margin-left:10%;padding-top:5%;padding-bottom:5%;padding-left:12%;width:90%;max-width:90%"><h1>Rapport</h1></a>
        <br />
        <br />
        <a class="btn btn-lg btn-danger disabled" disabled style="margin-left:10%;padding-top:5%;padding-bottom:5%;padding-left:12%;width:90%;max-width:90%"><h1>Administration</h1></a>
    </div>
</div>
<script>
$('.pinpad').on('click', function() {
    var html = "";
    var oldValue = $('#pin').attr('value');
    if($('#pin').attr('value').length < 4) {
        $('#pin').attr('value', oldValue + $(this).attr('value'));
        for(i=0; i < $('#pin').attr('value').length; i++) {
            html += '* '
        }
        $('#pin').html(html);
    }
});

$('.pin-erase').on('click', function() {
    var html = "";
    var newValue = $('#pin').attr('value').substring(0, $('#pin').attr('value').length - 1); ;
    console.log(newValue);
    $('#pin').attr('value', newValue);
    for(i=0; i < newValue.length; i++) {
        html += '* '
    }
    $('#pin').html(html);
});

$('.menu-button').on('click', function() {
    var pin = $('#pin').attr('value');
    $.ajax({
        url: "/pos/validate/" + pin + "/menu",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (result) {
            $('#pin').html('<h3 class="text-success">Bonjour, ' + result.name + '</h3>');
            window.location.replace("/pos/menu/" + result.id);
        },
        error: function (error) {
            $('#pin').attr('value', '')
            if (error.responseJSON.message === 'pin_error') {
                $('#pin').html('<h3 class="text-danger">NIP ERRONÉ</h3>');
            } else if(error.responseJSON.message === 'access_denied') {
                $('#pin').html('<h3 class="text-danger">ACCÈS REFUSÉ</h3>');
            } else {
                $('#pin').html('<h3 class="text-danger">ERREUR INCONNU</h3>');
                window.location.reload();
            }
        }
    });
});
</script>
@endsection