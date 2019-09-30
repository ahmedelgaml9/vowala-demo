@extends('site.template.index')
@section('content')
<div class="content-push">
    <div class="information-blocks">
        <div class="row text-center">
             <div class="col-md-12">
                <div style="margin-bottom: 200px;" > 
                    @if(Session::has('message'))
                        <p dir="rtl" class="alert {{ Session::get('alert-class', 'alert-success')}} text-center">{{ Session::get('message') }}
                        </p>
                        <p class="cost-details">Total Order Price <span class="price"> {{$order->total_price}} </span> <span class="currency"> {{ trans('lang.EGP') }} </span> </p>
                        <br>
                        {{ trans('lang.forOrder') }}  <a href="{{ 'order/'.$order->id }}">{{ trans('lang.more') }}</a>
                    @endif
                </div>
             </div>
            <div col-md-12>
            </div>        
        </div>
    </div>
                                        
</div>
@endsection

@section('script')
<script>
    window.onload = function() {
        var price = parseInt($('.cost-details .price').text());
        var currency = $('.cost-details .currency').text();

        fbq('track', 'Purchase', {
            value: price,
            currency: currency
        });
    }
</script>
