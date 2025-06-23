@extends('layout.app')
@section('content')


<div id="carouselBanner" class="carousel slide" data-bs-ride="carousel">
  <!-- Indicators -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="3" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="4" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="/images/image-slider-1.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="/images/image-slider-2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="/images/image-slider-3.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="/images/image-slider-4.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="/images/image-slider-5.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="container">
    <div class="content-item">
        <br /><br /><br />
        <h1>Mot du Président</h1>

        <p class="text-justify">Bienvenue sur le site Internet de la Filiale 101 de la Légion Royale Canadienne, située à Grand-Mère.
        
            La Filiale 101 de la Légion Royale Canadienne a décidé de se doter de ce site afin de mieux se faire connaître de la communauté du centre de la Mauricie et de tout ceux qui auraient quelconque questionnement concernant notre filiale et la Légion Royale Canadienne.
            Il est évident que ce site web est l’outil nécessaire pour rejoindre la population en général et c’est pourquoi la Filiale 101 de Grand-Mère a décidé de se mettre à la page au niveau des communications.

            <br /><br />
            Sur le site de la Filiale 101, comme internaute, vous pourrez  naviguer en utilisant les onglets appropriés pour bien connaître notre Filiale et la Légion Royale canadienne, les raisons d’être de celle-ci, ses dirigeants, notre local, les activités et la façon de nous joindre.

            <br /><br />
            Nous souhaitons qu’après avoir visité notre site, vous soyez amenés à venir nous rendre visite.
            Nous serons heureux de vous accueillir au local de la Filiale 101 de Grand-Mère  et également heureux de répondre aux interrogations qui pourraient persister.

            <br /><br />
            Pour devenir membre de la Filiale 101 de Grand-Mère, il n’est pas nécessaire que vous soyez un ancien combattant ou un militaire retraité ou actif.
            Pour ce faire, il ne s’agit que d’adhérer à la mission principale de la Légion Royale Canadienne qui est de <b>« promulguer le souvenir de tous ceux qui ont laissé leur vie pour la défense de la liberté et de la démocratie »</b>.
            Les dames sont également les bienvenues.
            
            <br /><br />
            Maintenant, je vous invite à naviguer et apprécier le site internet de la filiale 101 de Grand-Mère.
            Si vous avez des questions ou des commentaires, je vous invite à nous les faire parvenir en utilisant le formulaire de contact dans l’onglet <a href="/contact_us">"Nous joindre"</a>.
        </p>

        <br /><br /><br />
    </div>
</div>
@endsection