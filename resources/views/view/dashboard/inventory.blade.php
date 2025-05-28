@extends('layout.app')
@section('content')
<div class="container-fluid">
    <br />
    <h3>Inventaire</h3>
    <br />
    <div class="row">
        @foreach($catalog as $category)
            <div class="col-md-3">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <h4>{{$category->name}}</h4>
                    </div>
                    <hr />
                    @if(count($category->getVariations()) > 0)
                        @foreach($category->getVariations() as $item)
                            <div class="row">
                                <div class="col-sm-6">
                                    <b class="{{!is_null($item->inventory) && $item->inventory <= 0 ? 'text-danger' : ''}} {{!is_null($item->inventory) && $item->inventory < $item->alert_threshold ? 'text-warning' : ''}}">{{$item->name}}:</b>
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-inline form-control-sm" type="text" value="{{$item->inventory}}">
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row">
                            <div class="col-sm-6">
                                <b class="{{!is_null($item->inventory) && $category->inventory <= 0 ? 'text-danger' : ''}} {{!is_null($item->inventory) && $category->inventory < $category->alert_threshold ? 'text-warning' : ''}}">Article de base: </b>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-inline form-control-sm" type="text" value="{{$category->inventory}}">
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-12">
                    <br />
                    <br />
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection