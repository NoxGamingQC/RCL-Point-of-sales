@extends('layout.app')
@section('content')
<div class="container-fluid">
    <br />
    <h3>Rapport du {{$firstDay->format('Y-m-d')}} au {{$secondDay->format('Y-m-d')}}</h3>
    <br />
    <div class="row">
        @foreach($transaction_categories as $category)
            <div class="col-sm-3">
                <h4>{{$category->fullname}} ({{Number_format(\App\Models\Transaction::whereBetween('created_at', [new Carbon\Carbon($firstDay)->format('Y-m-d')." 04:00:00", new Carbon\Carbon($secondDay)->addDays(1)->format('Y-m-d') ." 03:59:59"])->countByCategory($category->id),2)}}$) ({{Number_format(\App\Models\Transaction::whereBetween('created_at', [new Carbon\Carbon($firstDay)->format('Y-m-d')." 04:00:00", new Carbon\Carbon($secondDay)->addDays(1)->format('Y-m-d') ." 03:59:59"])->countByCategory($category->id, true),2)}}$)</h4>
                <hr />
                @if(count($category->getVariations()) > 0)
                    @foreach($category->getVariations() as $item)
                    <b>{{\App\Models\Transaction::whereBetween('created_at', [new Carbon\Carbon($firstDay)->format('Y-m-d')." 04:00:00", new Carbon\Carbon($secondDay)->addDays(1)->format('Y-m-d') ." 03:59:59"])->quantityByItem($item->id)}} x {{$item->name}}:&nbsp</b>{{Number_format(\App\Models\Transaction::whereBetween('created_at', [new Carbon\Carbon($firstDay)->format('Y-m-d')." 04:00:00", new Carbon\Carbon($secondDay)->addDays(1)->format('Y-m-d') ." 03:59:59"])->countByItem($item->id),2)}}$ ({{\App\Models\Transaction::whereBetween('created_at', [new Carbon\Carbon($firstDay)->format('Y-m-d')." 04:00:00", new Carbon\Carbon($secondDay)->addDays(1)->format('Y-m-d') ." 03:59:59"])->quantityByItem($item->id)}} x {{$item->name}}:&nbsp</b>{{Number_format(\App\Models\Transaction::whereBetween('created_at', [new Carbon\Carbon($firstDay)->format('Y-m-d')." 04:00:00", new Carbon\Carbon($secondDay)->addDays(1)->format('Y-m-d') ." 03:59:59"])->countByItem($item->id, true),2)}}$)
                    <br />
                    @endforeach
                @else
                    <b>{{\App\Models\Transaction::whereBetween('created_at', [new Carbon\Carbon($firstDay)->format('Y-m-d')." 04:00:00", new Carbon\Carbon($secondDay)->addDays(1)->format('Y-m-d') ." 03:59:59"])->quantityByCategory($category->id)}} x Article de base:&nbsp</b>{{Number_format(\App\Models\Transaction::whereBetween('created_at', [new Carbon\Carbon($firstDay)->format('Y-m-d')." 04:00:00", new Carbon\Carbon($secondDay)->addDays(1)->format('Y-m-d') ." 03:59:59"])->countByCategory($category->id),2)}}$ ({{\App\Models\Transaction::whereBetween('created_at', [new Carbon\Carbon($firstDay)->format('Y-m-d')." 04:00:00", new Carbon\Carbon($secondDay)->addDays(1)->format('Y-m-d') ." 03:59:59"])->quantityByCategory($category->id)}} x Article de base:&nbsp</b>{{Number_format(\App\Models\Transaction::whereBetween('created_at', [new Carbon\Carbon($firstDay)->format('Y-m-d')." 04:00:00", new Carbon\Carbon($secondDay)->addDays(1)->format('Y-m-d') ." 03:59:59"])->countByCategory($category->id, true),2)}}$)
                    <br />
                @endif
                <br />
            </div>
        @endforeach
    </div>
    <h4><b>Grand total: {{Number_format($transactionsTotalCount,2)}}$ ({{Number_format($promotionTotalCount,2)}}$)</b></h4>
</div>
@endsection