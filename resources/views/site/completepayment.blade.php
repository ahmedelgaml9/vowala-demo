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
                        <p dir="rtl" class="alert-success  text-center"> payment operation cancelled
                        </p>
                      </br>
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