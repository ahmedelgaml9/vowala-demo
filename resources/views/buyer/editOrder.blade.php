@extends('site.template.index')
@section('content')

<div class="content-push">
    <div class="breadcrumb-box">
        <a href="{{ url('/') }}">{{ trans('lang.home') }}</a>
        <a href="{{ url('myorders') }}">{{ trans('lang.account') }}</a>
        <a >{{ trans('lang.orders') }}</a>
    </div>
    <div class="information-blocks">
        <div class="row">
            <div class="col-sm-9 col-sm-push-3">

                    <div class="message-box message-success" id="messagebox" style="display: none">
                        <div class="message-icon"><i class="fa fa-check"></i></div>
                        <div class="message-text message"></div>
                        <div class="message-close"><i class="fa fa-times"></i></div>
                    </div>
                <div class="wishlist-box">
                {!!Form::model($order, ['url' => ['order/update', $order]])!!}
                    <label>{{ trans('lang.name') }}</label>  
                    <span style="color: red">{{ $errors->first('name') }}</span>
                    {!!Form::text('first_name', null,array('class'=>'form-control','id'=>'first_name'))!!}
                    <br>
                    <label>{{ trans('lang.phone') }}</label>  
                    <span style="color: red">{{ $errors->first('phone') }}</span>
                    {!!Form::number('phone', null,array('class'=>'form-control','id'=>'phone'))!!}
                    <br>
                    <label>{{ trans('lang.email') }}</label>  
                    <span style="color: red">{{ $errors->first('email') }}</span>
                    {!!Form::email('email', null,array('class'=>'form-control','id'=>'email'))!!}
                    <br>
                    <label>{{ trans('lang.address') }}</label>  
                    <span style="color: red">{{ $errors->first('address') }}</span>
                    {!!Form::textarea('address', null,array('class'=>'form-control','id'=>'Address'))!!}
                    <br>
                    <label>{{ trans('lang.comments') }}</label>  
                    <span style="color: red">{{ $errors->first('comments') }}</span>
                    {!!Form::textarea('comments', null,array('class'=>'form-control','id'=>'Address'))!!}
                    <br>
                    {!!Form::submit('submit',array('class'=>"btn btn-success"))!!}
                {!!Form::close()!!}
                </div>
            </div>
            <div class="col-sm-3 col-sm-pull-9 blog-sidebar">
                <div class="information-blocks">
                    <div class="categories-list account-links">
                        <div class="block-title size-3">Client account</div>
                        <ul>
                            @include('site.template.profileheader')

                        </ul>
                    </div>
                    <div class="article-container">
                        <br/>Custom CMS block displayed below the one page account panel block. Put your own content here.
                    </div>
                </div>
            </div>
        </div>
    </div>
                                        

<!--     @include('site.template.featured')
 -->    
</div>





@endsection