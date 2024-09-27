@extends('layouts._front.template-1')

@section('content')

<div class="uk-container uk-container-center uk-margin-medium-bottom">
    <article id="main" role="main">
        <div class="uk-grid">
            <div class="uk-width-1-1 uk-text-center uk-margin-large-top uk-margin-large-bottom thank-you-page">
                @if(isset($pages))
                    <h1 class="uk-margin-large-top uk-margin-large-bottom"> {{ $pages->fldPagesTitle }} </h1>
    
                    @if($pages->fldPagesID==72)
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-2 uk-width-small-1-1 first-row">
                            {!! $pages->fldPagesDescription !!}
                            </div>
                            <div class="uk-width-medium-1-2 uk-width-small-1-1 last-row">
                            <img class="image-responsive  uk-align-left uk-margin-large-right uk-margin-large-top" src="{{  url('uploads/pages/icon-user.png') }}" alt="" />
                            {!! $pages->fldPagesDescription2 !!}
                            </div>
                        </div>
                    @else
                        <div class=""><h2>{!! $pages->fldPagesDescription !!}</h2></div>
                    @endif
                @endif

            </div>

        </div>
    </article>
</div><!--container -->




@stop

@section('headercodes')

@stop


