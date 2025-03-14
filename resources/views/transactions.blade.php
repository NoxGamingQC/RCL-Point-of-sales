@extends('layout.app')
@section('content')

<div class="container">
    <div class="row">
        <table class="table table-hover text-center">
            <tr class="text-center">
                <th class="text-center">Client</th>
                <th class="text-center">Quantité</th>
                <th class="text-center">Catégorie</th>
                <th class="text-center">Article</th>
                <th class="text-center">Prix</th>
                <th class="text-center">Date</th>
                <th class="text-center">Caissier</th>
                <th class="text-center">Type de payment</th>
            </tr>
            @foreach($transactions as $transaction)
                <tr class="text-center {{new Carbon\Carbon($transaction->created_at, 'America/Toronto') == Carbon\Carbon::yesterday('America/Toronto') ? 'success' : ''}}{{new Carbon\Carbon($transaction->created_at, 'America/Toronto') == Carbon\Carbon::today('America/Toronto') ? 'primary' : ''}}">
                    <td>{{$transaction->customer_id ? $transaction->customer_id : 'N/A'}}</td>
                    <td>{{$transaction->quantity}}</td>
                    <td>{{$transaction->getCategoryName()}}</td>
                    <td>{{$transaction->getItemName()}}</td>
                    <td>{{Number_format($transaction->price, 2)}} $</td>
                    <td>{{new Carbon\Carbon($transaction->created_at, 'America/Toronto')}}</td>
                    <td>{{$transaction->getCashier()}}</td>
                    <td>{{$transaction->payment_type === 'cash' ? 'Argent' : 'Carte'}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection