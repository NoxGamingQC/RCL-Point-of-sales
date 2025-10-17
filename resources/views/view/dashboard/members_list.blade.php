@extends('layout.app')
@section('content')
<style>
@page {
    @top-center { 
        content: '{{env('NAME')}} - Liste des membres'; 
    }
    @bottom-left { 
        content: 'Généré par Services Tech. J.Bédard'
    }
    @bottom-right { 
        content: counter(page)  '/' counter(pages)
    }
}
</style>
<div class="container-fluid">
    <br />
    <h1>Liste des membres en règle ({{date('Y')}})</h1> 
    <br />
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No de membre</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Courriel</th>
                <th>Année payé</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
                @if(!$member->archive)
                    <tr class="{{ $member->last_year_paid < date('Y') ? 'table-danger' : ($member->last_year_paid == date('Y') ? 'table-warning' : ($member->last_year_paid > date('Y') ? 'table-success' : '')) }}">
                        <td>{{ $member->member_id }}</td>
                        <td>{{ $member->lastname }}</td>
                        <td>{{ $member->firstname }}</td>
                        <td>{{ $member->phone_number }}</td>
                        <td>{{ $member->email_address }}</td>
                        <td>{{ $member->last_year_paid }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection