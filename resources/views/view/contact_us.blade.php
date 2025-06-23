@extends('layout.app')
@section('title', 'Nous joindre')
@section('content')

<img class="w-100" src="/images/banner.jpg">
<br/><br />
<div class="container text-justify">
    <div class="content-item">
        <h3 class="text-left">Heures d'ouverture</h3>
        <table class="table table-striped">
            <tr>
                <th>Jour</th>
                <th>Horaire</th>
            </tr>
            <tr>
                <td>Lundi au Jeudi</td>
                <td>Fermé</td>
            </tr>
            <tr>
                <td>Vendredi</td>
                <td>19h00 à fermeture</td>
            </tr>
            <tr>
                <td>Samedi</td>
                <td>Fermé, sauf si activités</td>
            </tr>
            <tr>
                <td>Dimanche</td>
                <td>13h00 à fermeture </td>
            </tr>
        </table>



        <h3 class="text-left">Formulaire de contact</h3>
        <p>Nous nous engageons à vous répondre dans un délai de 48 heures. Passé ce délai, nous vous invitons à vérifier votre boîte de courriel indésirable ou à communiquer avec nous par téléphone au <a href="tel:+18195381616">819 538-1616</a>. Merci!</p>

        <h3>Adresse postale</h3>
        <address><p>
            Légion Royale Canadienne - Filiale 101
            C.P. 10052
            Shawinigan (Québec) G9T 5K7</p></address>

        <h3 class="text-left">Adresse physique</h3>
        <address><p>1250, 3e Avenue, SS 
        Shawinigan (Québec) G9T 7H9</p>
        <p><b>Courriel :</b> <a href="mailto:legionfiliale101@gmail.com">legionfiliale101@gmail.com</a></p>
        <p><b>Téléphone et Télécopieur :</b> <a href="tel:+18195381616">819 538-1616</a></p></address>
    </div>
</div>

@endsection