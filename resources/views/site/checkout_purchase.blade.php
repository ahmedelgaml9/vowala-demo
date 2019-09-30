@if($main->chosetemplate == 1)

@include('site.template.header')

@endif

@if($main->chosetemplate == 2)
@include('site.template.header2')
@endif
<div class="content-push">
    <div class="information-blocks">
        <div class="row text-center">
             <div class="col-md-12">
                <div style="margin-bottom: 200px;" > 
                          @if(Session::has('message'))
                        <p dir="rtl" class="alert {{ Session::get('alert-class', 'alert-success')}} text-center">{{ Session::get('message') }}
                        </p>
                        <p class="cost-details">Order  Number<span class="price">{{$order->id}} </span> </p>
                        <a href="{{url('order/'.$order->id)}}"> more details  </a>

                             @endif
                             
                          </div>
                       </div>
                     <div>
                  </div>        
                </div>
            </div>
        </div>

@if($main->chosetemplate   ==2)

@include('site.template.footer2')

@endif

@if($main->chosetemplate  ==1)

@include('site.template.footer')

@endif
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
