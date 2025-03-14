@extends('layout.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br />
            <h1>Liste des transactions</h1>
            <hr />
            <br />
        </div>
        <div class="col-md-12">
            <h3>Filtres</h3>
            
            <div class="col-md-6">
                <div class="input-daterange input-group" id="datepicker">
                    <input type="text" class="input-sm form-control" name="start" />
                    <span class="input-group-addon">&nbspà&nbsp</span>
                    <input type="text" class="input-sm form-control" name="end" />
                </div>
            </div>
            <br />
        </div>
        <table class="table">
            <tr class="text-center">
                <th class="text-center">Client</th>
                <th class="text-center">Quantité</th>
                <th class="text-center">Catégorie</th>
                <th class="text-center">Article</th>
                <th class="text-center">Prix</th>
                <th class="text-center">Date</th>
                <th class="text-center">Caissier</th>
                <th class="text-center">Type de payment</th>
                <th class="text-center">Annuler la transaction</th>

            </tr>
            @foreach($transactions as $transaction)
                <tr class="text-center {{$transaction->is_cancel_validated ? 'table-danger' : ''}} {{$transaction->is_canceled ? 'table-warning' : ''}} {{new Carbon\Carbon($transaction->created_at, 'America/Toronto')->format('Y-m-d') == Carbon\Carbon::today('America/Toronto')->format('Y-m-d') ? 'table-info' : ''}} {{new Carbon\Carbon($transaction->created_at, 'America/Toronto')->format('Y-m-d') == Carbon\Carbon::yesterday('America/Toronto')->format('Y-m-d') ? 'table-success' : ''}}">
                    <td>{{$transaction->customer_id ? $transaction->customer_id : 'N/A'}}</td>
                    <td>{{$transaction->quantity}}</td>
                    <td>{{$transaction->getCategoryName()}}</td>
                    <td>{{$transaction->getItemName()}}</td>
                    <td>{{Number_format($transaction->price, 2)}} $</td>
                    <td>{{new Carbon\Carbon($transaction->created_at, 'America/Toronto')}}</td>
                    <td>{{$transaction->getCashier()}}</td>
                    <td>{{$transaction->payment_type === 'cash' ? 'Argent' : 'Carte'}}</td>
                    <td><a class="btn btn-danger  {{$transaction->is_cancel_validated ? 'hidden disabled' : ''}}" {{$transaction->is_cancel_validated ? 'hidden disabled' : ''}}><i class="fa fa-remove"></i></a></td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
<script type="text/javascript">
$('.input-daterange').datepicker({
    format: "yyyy-mm-dd",
    maxViewMode: 0,
    todayBtn: true,
    clearBtn: true,
    language: "fr",
    autoclose: true,
    todayHighlight: true
});
</script>
@endsection