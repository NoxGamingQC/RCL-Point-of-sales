@extends('layout.app')
@section('content')

<div class="container">
    <div class="row">
        <table class="table table-hover">
            <tr>
                <th>Client</th>
                <th>Quantité</th>
                <th>Article</th>
                <th>Prix</th>
                <th>Date</th>
                <th>Caissier</th>
            </tr>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{$transaction->customer_id}}</td>
                    <td>{{$transaction->quantity}}</td>
                    <td>{{$transaction->item_id}}</td>
                    <td>{{$transaction->price}}</td>
                    <td>{{new Carbon\Carbon($transaction->created_at, 'America/Toronto')}}</td>
                    <td>{{$transaction->cashier_id}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection