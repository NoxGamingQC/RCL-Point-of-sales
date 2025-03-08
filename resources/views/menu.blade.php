@extends('layout.app')
@section('content')
<div style="position:absolute;margin:20vh;margin-left:30vh;z-index:99">
    <h1 id="amount" class="text-success" value="0"></h1>
</div>
<div style="position:absolute;margin:20vh;margin-left:95vh;z-index:99;">
    <h2 id="givenAmount" value="" style="width:50vh"></h2>
</div>
<div class="row" style="margin:0px;padding:0px;">
    <div class="col-md-12 text-center" style="min-height:49vh;max-height:49vh;overflow:hidden;margin:0px;padding:0px;">
        <div class="col-md-12" style="background-color:#E51937;height:3vh;color:#FFF;border: 1px solid black">
            {{$cashierName . ' - ' . $name . ' - ' . $phone_number}}
        </div>
        <div class="col-md-7" style="min-height:49vh;overflow:hidden;margin:0px;padding:0px">
            @if($invoices)
                @foreach($invoices as $invoice)
                    <div class="col-md-3" style="{{Carbon\Carbon::create($invoice->getCreatedAt())->addWeeks(1)->lessThan(Carbon\Carbon::create()) ? 'background:#c41d1d;color:#FFF !important;' : 'color:#000 !important;'}}margin:0px !important;padding:0px !important;border: 1px solid black">
                    <a id="{{$invoice->getId()}}" class="btn btn-lg" style="min-height:12vh;max-height:12vh;height:100%;width:100%; margin:0px !important;padding:0px !important;overflow:hidden;border-radius:0px;">
                            <b><li style="{{Carbon\Carbon::create($invoice->getCreatedAt())->addWeeks(1)->lessThan(Carbon\Carbon::create()) ? 'background:#c41d1d;color:#FFF !important;' : 'color:#000 !important;'}}margin-top:1vh;list-style-type: none;overflow:hidden;padding:2px;border-radius: 5px;opacity: 0.85;">{{$invoice->getPrimaryRecipient()->getGivenName()}}<br />  {{$invoice->getPrimaryRecipient()->getFamilyName()}}</li></b>
                            <b><span style="{{Carbon\Carbon::create($invoice->getCreatedAt())->addWeeks(1)->lessThan(Carbon\Carbon::create()) ? 'background:#c41d1d;color:#FFF !important;' : 'color:#000 !important;'}}border-radius: 5px;opacity: 0.85;">{{$invoice->getPaymentRequests()[0]->getComputedAmountMoney()->getAmount() ? substr($invoice->getPaymentRequests()[0]->getComputedAmountMoney()->getAmount() - ($invoice->getPaymentRequests()[0]->getTotalCompletedAmountMoney()->getAmount() ? $invoice->getPaymentRequests()[0]->getTotalCompletedAmountMoney()->getAmount() : 0), 0, -2) .',' . substr($invoice->getPaymentRequests()[0]->getComputedAmountMoney()->getAmount() - ($invoice->getPaymentRequests()[0]->getTotalCompletedAmountMoney()->getAmount() ? $invoice->getPaymentRequests()[0]->getTotalCompletedAmountMoney()->getAmount() : 0), -2) . '$' : 'variable'}}</span></b>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <div id="shoppingCart" class="col-md-5" style="min-height:42vh;max-height:42vh;background:#F8F8F8;padding:0px;overflow:hidden !important;">
        </div>
        <div class="col-md-5 text-left" style="min-height:3vh;">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h4><b>Total</b></h4>
                </div>
                <div class="col-md-6 text-right">
                    <h4 class="text-danger"><b id="totalPrice" value="">0,00$</b></h4>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="min-height:49vh;max-height:49vh;overflow:hidden;margin:0px;padding:0px">
        <div id="items" class="col-md-7 text-center" style="overflow:hidden;margin:0px;padding:0px;">
            <div class="col-md-2" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                <a class="btn btn-lg" href="/pos" style="min-height:12vh;max-height:12vh;height:100%;width:100%; margin:0px !important;padding:0px !important;overflow:hidden;border-radius:0px;">
                    <li style="margin-top:3vh;list-style-type: none;overflow:hidden;padding-top:0px !important;padding:2px;color: #000;border-radius: 5px;opacity: 0.85;">Fermer<br />session</li>
                </a>
            </div>                                      
            @foreach($catalog as $item)
                <div class="col-md-2" style="margin:0px !important;padding:0px !important;border: 1px solid black;">
                    <a id="{{$item->id}}" class="btn btn-lg" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:0px !important;min-height:12vh;max-height:12vh;">
                        <li style="padding-top:50px;list-style-type:none;overflow:hidden;padding:4vh;height:12vh;">{{$item->name}}</li>
                    </a>
                </div>
            @endforeach

            <!-- Fill out the rest of the blank square with empty button -->
            @for($i = 0; $i < 24; $i++)
                <div class="col-md-2" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                    <a class="btn btn-lg disabled" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:0px !important;">
                        
                    </a>
                </div>
            @endfor
        </div>
        <div id="numpad">
            <div class="col-md-3 text-center" style="min-height:49vh;max-height:49vh;overflow:hidden;margin:0px;padding:0px">
                <div class="row" style="margin:0px;padding:0px">
                    <div class="col-md-4" style="margin:0px !important;padding:0px !important;border: 1px solid black;">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="7">
                            7
                        </a>
                    </div>
                    <div class="col-md-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="8">
                            8
                        </a>
                    </div>
                    <div class="col-md-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="9">
                            9
                        </a>
                    </div>
                    <div class="col-md-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="4">
                            4
                        </a>
                    </div>
                    <div class="col-md-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="5">
                            5
                        </a>
                    </div>
                    <div class="col-md-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="6">
                            6
                        </a>
                    </div>
                    <div class="col-md-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="1">
                            1
                        </a>
                    </div>
                    <div class="col-md-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="2">
                            2
                        </a>
                    </div>
                    <div class="col-md-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="3">
                            3
                        </a>
                    </div>
                    <div class="col-md-8" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;" value="0">
                            0
                        </a>
                    </div>
                    <div class="col-md-4" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="numpad-backspace btn btn-lg btn-default" style="min-height:12vh;height:100%;width:100%; margin:0px !important;padding:4vh;height:12vh;">
                            DEL
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="total-menu">
            <div class="col-md-2 text-center" style="min-height:49vh;max-height:49vh;overflow:hidden;margin:0px;padding:0px">
                <div class="col-md-12" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a id="total" class="btn btn-lg btn-default" style="min-height:25vh;max-height:25vh;height:100%;width:100%; margin:0px !important;padding:9vh;height:12vh;">
                            Total
                        </a>
                    </div>
                    <div class="col-md-12" style="margin:0px !important;padding:0px !important;border: 1px solid black">
                        <a class="btn btn-lg btn-default disabled" style="min-height:25vh;max-height:25vh;height:100%;width:100%; margin:0px !important;padding:9vh;padding-left:7vh;height:12vh;">
                            Promotion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center" style="background-color:#E51937;height:3vh;color:#FFF;border:1px solid black;">
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
                    '<div class="col-md-6 text-left">'+
                        '<h4><b>1 x ' + $(this).attr('name') + '</b></h4>'+
                    '</div>'+
                    '<div class="col-md-6 text-right">'+
                        '<h4><b class="item-price" value="' + Number(realAmount.slice(0, realAmount.length-2) + '.' + realAmount.slice(realAmount.length -2, realAmount.length)) + '">' + Number(realAmount.slice(0, realAmount.length-2) + '.' + realAmount.slice(realAmount.length -2, realAmount.length)).toLocaleString('fr-CA', { style: 'currency', currency: 'CAD'}) + '</b></h4>'+
                    '</div>'+
                '</a>';
        } else {
            html += '<a class="cart-item btn btn-lg" style="width:100%;border:1px solid #CCC; min-height:3vh;max-height:5vh;border-radius:5px;padding:0px;color:#000;">'+
                    '<div class="col-md-6 text-left">'+
                        '<h4><b>' + Number(amount) + ' x ' + $(this).attr('name') + '</b></h4>'+
                    '</div>'+
                    '<div class="col-md-6 text-right">'+
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
            registerPayment(value);
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
            registerPayment(value);
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

function registerPayment(amount) {
    $.ajax({
        url: "/pos/pay/",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'amount': amount
        },
        success: function (result) {
             console.log('success');
        },
        error: function (error) {
            console.log(error);
        }
    })
}
</script>
@endsection