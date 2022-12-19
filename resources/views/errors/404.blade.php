<?php 
	$pages = \App\Models\Pages::find(84); 
?>
@extends('layouts._front.pages')

@section('content')
      
  
<div class="uk-container uk-container-center uk-margin-medium-bottom">
    <article id="main" role="main">
        <div class="uk-grid">   
            <div class="uk-width-1-1">                  
                    {!! $pages->fldPagesDescription !!}
                 
            </div>

        </div>  
    </article>
</div><!--container -->

@stop


@section('headercodes')
 
@stop


@section('extracodes')  
 {{-- */ /* */ /* --}}
@stop
