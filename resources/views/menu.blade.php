@extends('layout.pos')
@section('content')

<div style="position:absolute;margin:20vh;margin-left:30vh;z-index:99">
    <h1 id="amount" class="text-success" value="0"></h1>
</div>
<div style="position:absolute;margin:20vh;margin-left:95vh;z-index:99;">
    <h2 id="givenAmount" value="" style="width:50vh"></h2>
</div>
<div class="row" style="margin:0px;padding:0px;">
    <div class="col-12 text-center" style="min-height:49vh;max-height:49vh;overflow:hidden;margin:0px;padding:0px;">
        <div class="col-12" style="background-color:#E51937;height:3vh;color:#FFF;border: 1px solid black">
            {{$cashierName . ' - ' . $name . ' - ' . $phone_number}}
        </div>
        <div class="col-7" style="min-height:49vh;overflow:hidden;margin:0px;padding:0px">
        <div class="col-12">
            <h4 id="customerId" value=""></h4>
            <input id="invoiceID" type="hidden" value="">
        </div>
            @if($invoices)
                @foreach($invoices as $invoice)
                    <div class="col-3" style="{{Carbon\Carbon::create($invoice->created_at)->addWeeks(1)->lessThan(Carbon\Carbon::create()) ? 'background:#c41d1d;color:#FFF !important;' : 'color:#000 !important;'}}margin:0px !important;padding:0px !important;border: 1px solid black">
                    <a id="{{$invoice->id}}" customer-id="{{$invoice->customer_id}}" name="{{$invoice->getCustomerFullname()}}" class="invoices-list btn btn-lg" style="min-height:12vh;max-height:12vh;height:100%;width:100%; margin:0px !important;padding:0px !important;overflow:hidden;border-radius:0px;">
                            <b><li style="{{Carbon\Carbon::create($invoice->created_at)->addWeeks(1)->lessThan(Carbon\Carbon::create()) ? 'background:#c41d1d;color:#FFF !important;' : 'color:#000 !important;'}}list-style-type: none;overflow:hidden;padding:2px;border-radius: 5px;opacity: 0.85;">{{$invoice->getCustomerFirstName()}}</li></b>
                            <b><li style="{{Carbon\Carbon::create($invoice->created_at)->addWeeks(1)->lessThan(Carbon\Carbon::create()) ? 'background:#c41d1d;color:#FFF !important;' : 'color:#000 !important;'}}list-style-type: none;overflow:hidden;padding:2px;border-radius: 5px;opacity: 0.85;">{{$invoice->getCustomerLastName()}}</li></b>
                            <b><li style="color:#000;list-style-type: none;overflow:hidden;padding:2px;border-radius: 5px;opacity: 0.85;">{{$invoice->getTotalPrice()}}$<br /></li></b>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <div id="shoppingCart" class="col-5" style="min-height:42vh;max-height:42vh;background:#F8F8F8;padding:0px;overflow:hidden !important;">
        </div>
        <div class="col-5 text-left" style="min-height:3vh;">
            <div class="row">
                <div class="col-6 text-left">
                    <h4><b>Total</b></h4>
                </div>
                <div class="col-6 text-right">
                    <h4 class="text-danger"><b id="totalPrice" value="">0,00 $</b></h4>
                </div>
                <div class="col-4">
                </div>
            </div>
        </div>
    </div>
    <div class="col-12" style="min-height:49vh;max-height:49vh;overflow:hidden;margin:0px;padding:0px">
        <div id="items" class="col-7 text-center" style="overflow:hidden;margin:0px;padding:0px;">
            <div class="col-2" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                <a class="btn btn-lg" href="/pos" style="min-height:12vh;max-height:12vh;height:100%;width:100%; margin:0px !important;padding:0px !important;overflow:hidden;border-radius:0px;">
                    <li style="margin-top:3vh;list-style-type: none;overflow:hidden;padding-top:0px !important;padding:2px;color: #f00;border-radius: 5px;opacity: 0.85;">Fermer<br />session</li>
                </a>
            </div>                                      
            @foreach($catalog as $item)
                <div class="col-2" style="margin:0px !important;padding:0px !important;border: 1px solid black;">
                    <a id="{{$item->id}}" {{$item->getQuantity() == 0 ? ('price=' . $item->price. ' name=' . $item->name) : ''}} class="{{$item->getQuantity() == 0 ? 'items' : ''}} btn btn-lg" data-toggle="modal" data-target="#{{$item->name}}Modal" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:0px !important;min-height:12vh;max-height:12vh;background-image: url({{$item->image}}); background-color: #ffffff;background-size: cover;background-repeat: no-repeat;background-position: center;">
                        @if(!is_null($item->inventory) && $item->inventory == 0)
                            <span class="text-danger" style="z-index:99;position:absolute;margin:-25px;margin-top:-12px;padding:0px"><h1 style="font-size: 70px;color:#F00;text-shadow:1px 1px 0 #000, -1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000;">X</h1></span>
                        @elseif(!is_null($item->inventory) && $item->inventory <= $item->alert_threshold)
                            <span class="text-warning" style="z-index:99;position:absolute;margin:-12px;margin-top:-12px;padding:0px"><h1 style="font-size: 70px;color:#FF0;text-shadow:1px 1px 0 #000, -1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000;">!</h1></span>
                        @endif
                        <li style="font-weight: bold;padding-top:50px;list-style-type:none;overflow:hidden;padding-top:4vh;{{$item->image ? 'color: #FFF; text-shadow: -2px 0 #000, 0 2px #000, 2px 0 #000, 0 -2px #000;' : 'color:#000;'}}">{{$item->name}}</li>
                        @if($item->getQuantity() == 0)
                            <span style="margin-top:2px;padding:2px;{{$item->image ? 'color: #FFF; text-shadow: -2px 0 #000, 0 2px #000, 2px 0 #000, 0 -2px #000;' : 'color:#000;'}}border-radius: 5px;opacity: 0.85;">{{$item->price}} $</span>
                        @endif
                    </a>
                </div>
                @if($item->getQuantity() > 0)
                <!-- Modal start-->
                    <div id="{{$item->name}}Modal" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">{{$item->name}}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        @foreach($item->getVariations() as $variation)
                                            <div class="col-2" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                                                <a id="{{$item->id}};{{$variation->id}}" name="{{$variation->name}}" price="{{$variation->price}}" class="items btn btn-lg" data-dismiss="modal" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:0px !important;min-height:20vh;max-height:20vh;background-image: url({{$variation->image}}); background-color: #ffffff;background-size: cover;background-repeat: no-repeat;background-position: center;">
                                                    @if(!is_null($variation->inventory) && $variation->inventory == 0)
                                                        <span class="text-danger" style="z-index:99;position:absolute;margin:-25px;margin-top:10px;padding:0px"><h1 style="font-size: 70px;color:#F00;text-shadow:1px 1px 0 #000, -1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000;">X</h1></span>
                                                    @elseif(!is_null($variation->inventory) && $variation->inventory <= $variation->alert_threshold)
                                                        <span class="text-warning" style="z-index:99;position:absolute;margin:-12px;margin-top:12px;padding:0px"><h1 style="font-size: 70px;color:#FF0;text-shadow:1px 1px 0 #000, -1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000;">!</h1></span>
                                                    @endif
                                                    <li style="font-weight: bold;;margin:8vh;margin-left:2vh !important;margin-bottom:2px;list-style-type: none;{{ $variation->image ? 'background-color:#000;color:#FFF;': 'color: #000;'}}border-radius: 5px;opacity: 0.85;">{{$variation->name}}</li>
                                                    <span style="margin-top:2px;padding:2px;{{ $variation->image ? 'background-color:#000;color:#FFF;': 'color: #000;'}}border-radius: 5px;opacity: 0.85;">{{$variation->price}} $</span>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- Modal end-->
                @endif
            @endforeach
            <!-- Button trouver client -->
            <div class="col-2" style="margin:0px !important;padding:0px !important;border: 1px solid black;">
                <a id="" class="btn btn-lg" data-toggle="modal" data-target="#customerModal" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:0px !important;min-height:12vh;max-height:12vh;">
                    <li style="font-weight: bold;padding-top:50px;list-style-type:none;overflow:hidden;padding-top:3vh;color: #000;">Trouver<br />client</li>
                </a>
            </div>
            <!-- Modal start-->
                    <div id="customerModal" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Assigner client</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-2" style="border:1px solid black;margin;0px;padding:0px;">
                                            <a class="customer btn btn-lg" style="color:red;min-height:75px !important;max-height:75px !important; height:100%;width:100%;" data-dismiss="modal" value="remove">
                                                <b>Enlever client</b>
                                            </a>
                                        </div>
                                        @foreach($customers as $customer)
                                            <div class="col-2" style="border:1px solid black;margin;0px;padding:0px;">
                                                <a class="customer btn btn-lg" style="color:black;min-height:75px !important;max-height:75px !important; height:100%;width:100%;" data-dismiss="modal" value="{{$customer->id}}" name="{{$customer->firstname}} {{$customer->lastname}}">
                                                    <b>{{$customer->firstname}}<br />{{$customer->lastname}}</b>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- Modal end-->
                    @if($hasKitshopAccess)
                        <div class="col-2" style="margin:0px !important;padding:0px !important;border: 1px solid black;">
                            <a id="kitshop" class="kitshop variable-price btn btn-lg disabled" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:0px !important;min-height:12vh;max-height:12vh;background-image: url(); background-color: #ffffff;background-size: cover;background-repeat: no-repeat;background-position: center;" disabled>
                                <span class="text-danger" style="z-index:99;position:absolute;margin:-25px;margin-top:5px;padding:0px"><h1 style="font-size: 70px;color:#F00;text-shadow:1px 1px 0 #000, -1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000;">X</h1></span>
                                <li style="font-weight: bold;padding-top:50px;list-style-type:none;overflow:hidden;padding-top:4vh;{{null /*image*/? 'color: #FFF; text-shadow: -2px 0 #000, 0 2px #000, 2px 0 #000, 0 -2px #000;' : 'color:#000;'}}">Kitshop</li>
                                <span style="margin-top:2px;padding:2px;{{null /*image*/ ? 'color: #FFF; text-shadow: -2px 0 #000, 0 2px #000, 2px 0 #000, 0 -2px #000;' : 'color:#000;'}}border-radius: 5px;opacity: 0.85;">Variable</span>
                            </a>
                        </div>
                    @endif
            <!-- Fill out the rest of the blank square with empty button -->
            @for($i = 0; $i < 24; $i++)
                <div class="col-2" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                    <a class="btn btn-lg disabled" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:0px !important;">
                        
                    </a>
                </div>
            @endfor
        </div>
        <div id="numpad">
            <div class="col-3 text-center" style="min-height:49vh;max-height:49vh;overflow:hidden;margin:0px;padding:0px">
                <div class="row" style="margin:0px;padding:0px">
                    <div class="col-4" style="margin:0px !important;padding:0px !important;border: 1px solid black;">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="7">
                            7
                        </a>
                    </div>
                    <div class="col-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="8">
                            8
                        </a>
                    </div>
                    <div class="col-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="9">
                            9
                        </a>
                    </div>
                    <div class="col-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="4">
                            4
                        </a>
                    </div>
                    <div class="col-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="5">
                            5
                        </a>
                    </div>
                    <div class="col-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="6">
                            6
                        </a>
                    </div>
                    <div class="col-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="1">
                            1
                        </a>
                    </div>
                    <div class="col-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="2">
                            2
                        </a>
                    </div>
                    <div class="col-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="3">
                            3
                        </a>
                    </div>
                    <div class="col-8" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="0">
                            0
                        </a>
                    </div>
                    <div class="col-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad-backspace btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;">
                            DEL
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="total-menu">
            <div class="col-2 text-center" style="min-height:49vh;max-height:49vh;overflow:hidden;margin:0px;padding:0px">
                <div class="col-12" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a id="total" class="btn btn-lg btn-default" style="min-height:16.5vh;max-height:12vh;height:100%;width:100%; margin:0px !important;padding:6.8vh;height:9vh;">
                            Total
                        </a>
                    </div>
                    <div class="col-12" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a id="createInvoice" class="btn btn-lg btn-default" style="min-height:16.5vh;max-height:12vh;height:100%;width:100%; margin:0px !important;padding:6vh;padding-left:7vh;height:9vh;">
                            Créer<br />facture 
                        </a>
                    </div>
                    <div class="col-12" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a id="promotion" class="btn btn-lg btn-default" style="min-height:16.5vh;max-height:12vh;height:100%;width:100%; margin:0px !important;padding:6.8vh;padding-left:7vh;height:9vh;">
                            Promotion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 text-center" style="background-color:#E51937;height:3vh;color:#FFF;border:1px solid black;">
        Créé et maintenu par Service Technologique J.Bédard - 819-852-8705
    </div>
</div>
<script>
$(document).ready(function() {
    $('.items').on('click', function(){
        $('#givenAmount').html('');
        $('#givenAmount').attr('value', '');
        var realAmount = $('#amount').attr('value');
        var amount = (Number($('#amount').attr('value')) == 0) ? '1' : $('#amount').attr('value')
        $('#amount').html('');
        $('#amount').attr('value', '')
        var total = 0;
        var html = $('#shoppingCart').html();
        if($(this).hasClass('variable-price')) {
            console.log(true)
            html += '<a class="cart-item btn btn-lg" style="width:100%;border:1px solid #CCC; min-height:3vh;max-height:5vh;border-radius:5px;padding:0px;color:#000;">'+
                    '<div class="col-6 text-left">'+
                        '<h4><b>1 x ' + $(this).attr('name') + '</b></h4>'+
                    '</div>'+
                    '<div class="col-6 text-right">'+
                        '<h4><b class="item-price" value="' + Number(realAmount.slice(0, realAmount.length-2) + '.' + realAmount.slice(realAmount.length -2, realAmount.length)) + '">' + Number(realAmount.slice(0, realAmount.length-2) + '.' + realAmount.slice(realAmount.length -2, realAmount.length)).toLocaleString('fr-CA', { style: 'currency', currency: 'CAD'}) + '</b></h4>'+
                    '</div>'+
                '</a>';
        } else {
            html += '<a class="cart-item btn btn-lg" category="' + $(this).attr('id').split(';')[0] + '" item="' + $(this).attr('id').split(';')[1] + '" quantity="' + Number(amount) + '" price="' + Number($(this).attr('price')) + '" style="width:100%;border:1px solid #CCC; min-height:3vh;max-height:5vh;border-radius:5px;padding:0px;color:#000;">'+
                    '<div class="col-6 text-left">'+
                        '<h4><b>' + Number(amount) + ' x ' + $(this).attr('name') + '</b></h4>'+
                    '</div>'+
                    '<div class="col-6 text-right">'+
                        '<h4><b class="item-price" value="' + Number($(this).attr('price')) * Number(amount) + '">' + (Number($(this).attr('price')) * Number(amount)).toLocaleString('fr-CA', { style: 'currency', currency: 'CAD'}) + '</b></h4>'+
                    '</div>'+
                '</a>';
        }
        $('#shoppingCart').html(html);
        $('.item-price').each(function(key, item) {
            total += Number(item.getAttribute('value'));
        });
        $('#totalPrice').attr('value',total);
        $('#totalPrice').html(total.toLocaleString('fr-CA', { style: 'currency', currency: 'CAD'}));

        $('.cart-item').on('click', function() {
            var total = 0;
            $(this).remove();
            $('.item-price').each(function(key, item) {
                total += Number(item.getAttribute('value'));
            });
            $('#totalPrice').attr('value', total);
            $('#totalPrice').html(total.toLocaleString('fr-CA', { style: 'currency', currency: 'CAD'}));
        }); 
    });

    $('.numpad').on('click', function() {
        var html = "";
        var oldValue = $('#amount').attr('value');
        html = oldValue + $(this).attr('value')
        $('#amount').attr('value', oldValue + $(this).attr('value'));
        $('#amount').html(Number(html.slice(0, html.length-2) + '.' + html.slice(html.length -2, html.length)).toLocaleString('fr-CA', { style: 'currency', currency: 'CAD'}));
    }); 
    $('.numpad-backspace').on('click', function() {
        var value = 0;
        value = $('#amount').attr('value').substring(0, $('#amount').attr('value').length -1);
        $('#amount').attr('value', Number(value));
        if(Number(value) == 0) {
            $('#amount').html('')
        } else {
            $('#amount').html(Number(value.slice(0, value.length-2) + '.' + value.slice(value.length -2, value.length)).toLocaleString('fr-CA', { style: 'currency', currency: 'CAD'}));
        }
    }); 
    $('#total').on('click', function() {
        var value = 0;
        var givenBack = 0;
        var exactPrice = 0;
        value = $('#amount').attr('value')
        givenBack = (Number(value.slice(0, value.length-2) + '.' + value.slice(value.length -2, value.length)) - Number($('#totalPrice').attr('value')));
        if (isNaN(givenBack)) {
            registerPayment(false);
            $('#givenAmount').html('Remise: ' + exactPrice.toLocaleString('fr-CA', { style: 'currency', currency: 'CAD'}));
            $('#givenAmount').addClass('text-success');
            $('#givenAmount').removeClass('text-danger');
            $('#amount').attr('value', '0');
            $('#amount').html('');
            $('#totalPrice').attr('value', '0');
            $('#totalPrice').html(exactPrice.toLocaleString('fr-CA', { style: 'currency', currency: 'CAD'}));
            $('.cart-item').each(function() {
                $(this).remove();
            })
        }else if(givenBack < 0) {
            $('#givenAmount').html('Remise invalide');
            $('#givenAmount').addClass('text-danger');
            $('#givenAmount').removeClass('text-success');
            $('#amount').attr('value', '0');
            $('#amount').html('');
        } else {
            registerPayment(false);
            $('#givenAmount').html('Remise: ' + givenBack.toLocaleString('fr-CA', { style: 'currency', currency: 'CAD'}));
            $('#givenAmount').addClass('text-success');
            $('#givenAmount').removeClass('text-danger');
            $('#amount').attr('value', '0');
            $('#amount').html('');
            $('#totalPrice').attr('value', '0');
            $('#totalPrice').html(exactPrice.toLocaleString('fr-CA', { style: 'currency', currency: 'CAD'}));
            $('.cart-item').each(function() {
                $(this).remove();
            })
        }
    });

    $('#createInvoice').on('click', function() {
        if($('#customerId').attr('value') === '') {
            $('#givenAmount').html('Client obligatoire pour facture');
            $('#givenAmount').addClass('text-danger');
            $('#givenAmount').removeClass('text-success');
        } else {
            var cartItems = [];
            var customerID = $('#customerId').attr('value');
            var invoiceID = $('#invoiceID').attr('value');
            $('.cart-item').each(function(key, item) {
                cartItems.push({
                    'category_id': $(this).attr('category'),
                    'item_id': $(this).attr('item'),
                    'price' : $(this).attr('price'),
                    'quantity': $(this).attr('quantity'),
                });
            });
            $.ajax({
                url: "/pos/invoice/edit",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'customer_id': customerID,
                    'items': cartItems,
                    'cashier_id': {{$cashier_id}},
                    'is_promotion' : false,
                    'invoice_id': invoiceID,
                    'menu': 'menu'
                },
                success: function (result) {
                    $('.cart-item').each(function(key, item) {
                        $('.cart-item').each(function() {
                            $(this).remove();
                        })
                    });
                    console.log('success');
                },
                error: function (error) {
                    console.log(error);
                },
                complete: function() {
                    window.location.reload();
                }
            });
        }
    });


    $('#promotion').on('click', function() {
        var value = 0;
        var givenBack = 0;
        var exactPrice = 0;
        registerPayment(true);
        $('#givenAmount').html('Remise: ' + givenBack.toLocaleString('fr-CA', { style: 'currency', currency: 'CAD'}));
        $('#givenAmount').addClass('text-success');
        $('#givenAmount').removeClass('text-danger');
        $('#amount').attr('value', '0');
        $('#amount').html('');
        $('#totalPrice').attr('value', '0');
        $('#totalPrice').html(exactPrice.toLocaleString('fr-CA', { style: 'currency', currency: 'CAD'}));
        $('.cart-item').each(function() {
            $(this).remove();
        })
    });

    $('.physical-count').each(function() {
        var item = $(this);
        $.ajax({
            url: "/pos/getInventory/" + $(this).attr('id') + "/",
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                if(Number(result) == 0) {
                    item.html('<h1 style="font-size: 70px;color:#f00;text-shadow:1px 1px 0 #000, -1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000;margin-top:5px;">X</h1>');
                } else if(Number(result) <= Number(item.attr('warning'))) {
                    item.html('<h1 style="font-size: 70px;color:#fF0;text-shadow:1px 1px 0 #000, -1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000;margin-top:5px;">!</h1>');
                }
            }
        })
    });

    function registerPayment(isPromotion) {
        var cartItems = [];
        var customerID = $('#customerId').attr('value');
        var invoiceID = $('#invoiceID').attr('value');
        $('.cart-item').each(function(key, item) {
            cartItems.push({
                'category_id': $(this).attr('category'),
                'item_id': $(this).attr('item'),
                'price' : $(this).attr('price'),
                'quantity': $(this).attr('quantity'),
            });
        });
        $.ajax({
            url: "/pos/pay/",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'invoice_id': invoiceID,
                'items': cartItems,
                'cashier_id': {{$cashier_id}},
                'is_promotion' : isPromotion ? true : null,
                'menu': 'menu',
                'customer_id': $('#customerId').attr('value'),
            },
            success: function (result) {
                $('.cart-item').each(function(key, item) {
                    adjustInventory(item);
                });
                console.log('success');
            },
            error: function (error) {
                console.log(error);
            },
            complete: function() {
                window.location.reload();
            }
        });
    }

    function adjustInventory(item) {
        $.ajax({
            url: "/pos/inventory/",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'category_id': $(item).attr('category'),
                'item_id': $(item).attr('item'),
                'quantity': $(item).attr('quantity'),

            },
            success: function (result) {
                console.log('success');
            },
            error: function (error) {
                console.log(error);
            }
        })
    }

    $('.customer').on('click', function() {
        if($(this).attr('value') === 'remove') {
            $('#customerId').attr('value', '');
            $('#customerId').html('')
        } else {
        $('#customerId').attr('value', $(this).attr('value'));
        $('#customerId').html($(this).attr('name'))
        }
    });

    $('.invoices-list').on('click', function() {
        var newInvoiceID = $(this).attr('id');
        if($('#invoiceID').attr('value') == newInvoiceID) {
            $('#invoiceID').attr('value', '');
            $('#customerId').attr('value', '');
            $('#customerId').html('');
            $('.cart-item').each(function() {
                $(this).remove();
                var total = 0;
                $('#totalPrice').attr('value', total);
                $('#totalPrice').html(total.toLocaleString('fr-CA', { style: 'currency', currency: 'CAD'}));
            });
        } else {
            var customerName = $(this).attr('name');
            var customerID = $(this).attr('customer-id');
            var invoiceID = $(this).attr('id');
            $('#customerId').attr('value', customerID);
            $('#customerId').html(customerName);
            $('#invoiceID').attr('value', invoiceID);
            var html = '';
            @foreach($transactions as $item)
                if({{$item->invoice_id}} == invoiceID) {
                    html += '<a class="cart-item btn btn-lg" category="{{$item->category_id}}" item="{{$item->item_id}}" quantity="' + Number({{$item->quantity}}) + '" price="' + Number({{$item->price}}) + '" style="width:100%;border:1px solid #CCC; min-height:3vh;max-height:5vh;border-radius:5px;padding:0px;color:#000;">'+
                                '<div class="col-6 text-left">'+
                                    '<h4><b>' + Number({{$item->quantity}}) + ' x {{$item->getItemName() ? $item->getItemName() : $item->getCategoryName()}}</b></h4>'+
                                '</div>'+
                                '<div class="col-6 text-right">'+
                                    '<h4><b class="item-price" value="' + Number({{$item->price  * $item->quantity}}) + '">' + (Number({{$item->price}}) * Number({{$item->quantity}})).toLocaleString('fr-CA', { style: 'currency', currency: 'CAD'}) + '</b></h4>'+
                                '</div>'+
                            '</a>';
                }
            @endforeach
            $('#shoppingCart').html(html);
            var total = 0;
            $('.item-price').each(function(key, item) {
                total += Number(item.getAttribute('value'));
            });
            $('#totalPrice').attr('value', total);
            $('#totalPrice').html(total.toLocaleString('fr-CA', { style: 'currency', currency: 'CAD'}));

            $('.cart-item').on('click', function() {
                var total = 0;
                $(this).remove();
                $('.item-price').each(function(key, item) {
                    total += Number(item.getAttribute('value'));
                });
                $('#totalPrice').attr('value', total);
                $('#totalPrice').html(total.toLocaleString('fr-CA', { style: 'currency', currency: 'CAD'}));
            }); 
        }
    });
});

$(document).ready(function() {
    window.onInactive();
});
 
function onInactive(){
    var wait = setTimeout(doInactive, 300000); 
    document.onmousemove = document.mousedown = document.mouseup = document.onkeydown = document.onkeyup = document.focus = function(){
        clearTimeout(wait);
        wait = setTimeout(doInactive, 300000);
    };
}

function doInactive() {
    document.location.href = '/pos'
}
</script>
@endsection