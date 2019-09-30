@extends('site.template.index')
@section('content')
<div class="breadcrumb-box">
    <a href="{{ url('/') }}">Home</a>
    <a href="">Faq</a>
</div>
<div class="information-blocks">
    <div class="row">
        <div class="accordeon">
            <div class="col-md-6">
                <?php  $n=0; ?>
                  @foreach($faqs as $f)
                <div class="accordeon-title @if($n == 0)active @endif">{{ $f->question }}</div>
                <div class="accordeon-entry" style="display: block;">
                    <div class="article-container style-1">
                        <p>{{ $f->answer }}</p>
                     </div>
                </div>
                     <?php  $n++; ?>
                @endforeach
             </div>
        </div>
    </div>
</div>
 

@endsection