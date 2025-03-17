@extends('layout.app')
@section('content')
<br />
<h2>Rapport du {{$firstDay->format('Y-m-d')}} au {{$secondDay->format('Y-m-d')}}</h2>
<br />
<div class="row">
    @foreach($transaction_categories as $category)
        <div class="col-sm-3">
            <h3>{{$category->fullname}}</h3>
            <hr />
            @foreach($category->getVariations() as $item)
            <b>{{$item->name}}:&nbsp</b>
            <br />
            @endforeach
            <br />
        </div>
    @endforeach
</div>
<h4><b>Grand total: {{$transactionsTotalCount}}</b></h4>
@endsection