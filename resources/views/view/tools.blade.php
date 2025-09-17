@extends('layout.app')
@section('title', 'Outils')
@section('content')

<img class="w-100" src="/images/banner.jpg">
<br/><br />
<div class="container text-justify">
    <div class="content-item">
        <div class="col-md-12">
            <h1 class="text-left">Outils</h1>

            <p>La Légion Royale Canadienne - Filiale 101 de Grand-Mère accueille toute personne adhérant aux buts et à la mission que celle-ci s'est fixée.</p>
            <ul>
                <li>La Légion 101 de Grand-Mère est une organisation à but non lucratif, financièrement indépendante, comprenant environ 75 membres.</li>
                <br />
                <li>Les membres reçoivent la revue Légion, l'un des plus importants périodiques, à tirage payé, au Canada, qui traite de questions se rapportant aux Anciens combattants, les aîné(e)s, anecdotes canadiennes de guerre et activités sur l'organisation.</li>
                <br />
                <li>Le Programme de Bénéfices pour Membres offre aux membres, par l'entremise de sociétés qui y collaborent, des coûts réduits pour produits et services ( ex :assurances etc.).</li>
                <br />
                <li>La Légion 101 a un local pouvant servir à organiser des activités qui amassent des fonds pour les œuvres caritatives. Ce local est également un lieu de rencontre pour les membres. Si vous désirez venir y faire un tour, vous êtes les bienvenues.</li>
            </ul>
            <br />
            <div class="text-center">
                <a class="btn btn-primary" href="/download/formulaire_adhesion_fr.pdf">Devenir Membre</a>
            </div>

            <h3 class="text-left">Liens Utiles</h3>
            <a href="https://legion.ca">Légion Royale Canadienne - Direction Nationale</a>
            <br /><br />
            <a href="https://www.qc.legion.ca">Légion Royale Canadienne - Direction du Québec</a>
            <br /><br />
            <a href="https://www.facebook.com/62RAC62RCA">62e Régiment d'Artillerie de Campagne (Page Facebook)</a>
            <br /><br />
            <a href="https://www.croixrouge.ca">Croix-Rouge Canadienne</a>
            <br /><br />
            <a href="/download/plaques.pdf">Plaque d'immatriculation pour les anciens combattants</a>
            <br /><br />
            <a href="https://www.veterans.gc.ca/fr">Anciens Combattants Canada</a>
            <br /><br />
            <a href="https://portal.legion.ca/docs/default-source/branch-and-command-resources/supply/catalogue_f.pdf">Catalogue de filiale</a>
        </div>
    </div>
</div>
@endsection