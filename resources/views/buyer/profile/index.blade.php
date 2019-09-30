@extends('mastar.index')
@section('content')
<div class="col-md-3">
    <aside class="sidebar-left">
        <ul class="nav nav-pills nav-stacked nav-arrow">
            <?php $url = Route::getFacadeRoot()->current(); ?>
             <li @if($url != null) @if($url->uri()=='profile') class="active" @endif @endif><a href="{{ url("profile") }}">{{ trans('lang.settings')}}</a>
            </li>

            <li @if($url != null) @if($url->uri()=='myorder') class="active" @endif @endif><a href="{{ url("myorder") }}">{{ trans('lang.orders')}}</a>
            </li>
            <li @if($url != null) @if($url->uri()=='mywishlist') class="active" @endif @endif><a href="{{ url("mywishlist") }}">{{ trans('lang.wlist')}}</a>
            </li>
        </ul>
    </aside>
</div>
<div class="col-md-9">
    <div class="row">
        @yield('profile')
    </div>
</div>
@endsection
