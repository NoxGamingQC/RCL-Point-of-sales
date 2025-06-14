@extends('layout.pos')
@section('content')

<div class="container-fluid" style="background-color:#FFF; background: url('/images/poppy_background.jpg')">
    <div class="row" style="margin:0px;padding:0px;">
        <div class="col-md-12">
            <h1 class="text-center" style="margin-top:5%;min-height:50px">Honneur et Récompenses</h1>
            <hr />
        </div>
        <div class="col-6 text-center" style="min-height:100vh;overflow:hidden;margin:0px;padding:0px;">
            <div class="text-start">
                <a class="btn btn-lg btn-warning" href="/pos">Fermer la session</a>
            </div>
            <br /> <br />
            <select class="form-select" aria-label="Item choice">
                <option selected disabled>Choisissez un article ...</option>
                @foreach($items as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 text-center" style="min-height:100vh;overflow:hidden;margin:0px;padding:0px;">
            <br/>
            <br/>
            <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:2%;padding-bottom:2%;padding-left:8%;padding-right:8%;" value="1"><h1>1</h1></a>
            <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:2%;padding-bottom:2%;padding-left:8%;padding-right:8%;" value="2"><h1>2</h1></a>
            <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:2%;padding-bottom:2%;padding-left:8%;padding-right:8%;" value="3"><h1>3</h1></a>
            <br />
            <br />
            <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:2%;padding-bottom:2%;padding-left:8%;padding-right:8%;" value="4"><h1>4</h1></a>
            <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:2%;padding-bottom:2%;padding-left:8%;padding-right:8%;" value="5"><h1>5</h1></a>
            <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:2%;padding-bottom:2%;padding-left:8%;padding-right:8%;" value="6"><h1>6</h1></a>
            <br/>
            <br/>
            <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:2%;padding-bottom:2%;padding-left:8%;padding-right:8%;" value="7"><h1>7</h1></a>
            <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:2%;padding-bottom:2%;padding-left:8%;padding-right:8%;" value="8"><h1>8</h1></a>
            <a class="pinpad btn btn-lg btn-default" style="border-radius:50%;padding-top:2%;padding-bottom:2%;padding-left:8%;padding-right:8%;" value="9"><h1>9</h1></a>
            <br />
            <br/>
            <a class="pinpad btn btn-lg btn-default" style="margin-left:22%;border-radius:50%;padding-top:2%;padding-bottom:2%;padding-left:8%;padding-right:8%;" value="0"><h1>0</h1></a>
            <a class="pin-erase btn btn-lg btn-default" style="border-radius:50%;padding-top:2%;padding-bottom:2%;padding-left:8%;padding-right:8%;"><h1><</h1></a>
            <br />
            <br />
            <div class="text-center">
                <button class="btn btn-lg btn-success">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>
<script>
</script>
@endsection