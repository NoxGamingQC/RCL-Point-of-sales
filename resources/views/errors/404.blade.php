@extends('layout.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center py-5 my-5">
            <img src="{{isset(session()->all()['_old_input']['branch']) ? session()->all()['_old_input']['branch']->logo : '/logo.png'}}">
            <br />
            <br />
            <h1 class="text-danger">Page non trouvée</h1>
            <p>La page que vous recherchez n'existe pas.</p>
        </div>
    </div>
</div>

@endsection