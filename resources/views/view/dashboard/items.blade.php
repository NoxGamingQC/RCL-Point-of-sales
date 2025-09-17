@extends('layout.app')
@section('content')

<div class="container">
    <br /><br />
    <h1>Listes des articles</h1>
    <hr />
    <div class="row">
        @foreach($catalog as $category)
            <div class="col-md-12">
                <br /><br />
                <h2>{{$category->fullname}}</h2>
                <div class="row gx-4 gy-4">
                    @if(count($category->getVariations()) > 0)
                        @foreach ($category->getVariations() as $item)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-img-top" style="background-image:url({{$item->image}});height:200px;max-height:200px;overflow:hidden;background-size: cover;background-repeat: no-repeat;background-position: center;"></div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$item->name}}</h5>
                                        <div class="row gy-3">
                                            <div class="input-group">
                                                <span class="input-group-text">Nom: </span>
                                                <input type="text" class="form-control" value="{{$item->name}}">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text">Prix: </span>
                                                <input type="text" class="form-control" value="{{$item->price}}">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text form-control">Disponible à la vente: </span>
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Radio button for following text input">
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text form-control">Calculer dans l'inventaire: </span>
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Radio button for following text input">
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text">Alertes d'inventaire bas: </span>
                                                <input type="text" class="form-control" value="{{$item->alert_threshold}}">
                                            </div>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="inputGroupFile01">Image:</label>
                                                <input type="file" class="form-control" id="inputGroupFile01">
                                            </div>

                                            <button class="btn btn-success disabled" style="margin-bottom: 10px;" disabled>Sauvegarder</button>
                                            <hr />
                                            <button class="btn btn-danger disabled" disabled>Supprimer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-4">
                                <div class="card">
                                    <div class="card-img-top" style="background-image:url({{$category->image}});height:200px;max-height:200px;overflow:hidden;background-size: cover;background-repeat: no-repeat;background-position: center;"></div>
                                    <div class="card-body">
                                        <h5 class="card-title">Article de base</h5>
                                        <div class="row gy-3">
                                            <div class="input-group">
                                                <span class="input-group-text">Nom: </span>
                                                <input type="text" class="form-control" value="Article de base">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text">Prix: </span>
                                                <input type="text" class="form-control" value="{{$category->price}}">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text form-control">Disponible à la vente: </span>
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Radio button for following text input">
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text form-control">Calculer dans l'inventaire: </span>
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Radio button for following text input">
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text">Alertes d'inventaire bas: </span>
                                                <input type="text" class="form-control" value="{{$category->alert_threshold}}">
                                            </div>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="inputGroupFile01">Image:</label>
                                                <input type="file" class="form-control" id="inputGroupFile01">
                                            </div>

                                            <button class="btn btn-success disabled" style="margin-bottom: 10px;" disabled>Sauvegarder</button>
                                            <hr />
                                            <button class="btn btn-danger disabled" disabled>Supprimer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <br /><br /><br /><br />
</div>

@endsection