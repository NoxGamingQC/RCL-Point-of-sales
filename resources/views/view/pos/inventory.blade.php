@extends('layout.pos')
@section('content')

<div class="container-fluid" style="">
    <div class="row" style="margin:0px;padding:0px;">
        <div class="col-md-12">
            <h1 class="text-center" style="margin-top:5%;min-height:50px">Inventaire</h1>
            <hr />
        </div>
        <div class="col-6 text-center" style="min-height:100vh;overflow:hidden;margin:0px;padding:0px;">
            <div class="text-start">
                <a class="btn btn-lg btn-warning" href="/pos">Fermer la session</a>
            </div>
            <br /> <br />
                
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
            <div class="d-grid text-center" style="padding:20px">
                <button class="btn btn-lg btn-success" style="border: 5px solid black;box-shadow: 0px 0px 15px 5px white;">Sauvegarder</button>
            </div>
        </div>
    </div>
</div>
<script>
</script>
@endsection