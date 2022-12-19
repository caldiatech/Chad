@extends('layouts._front.news')

@section('content')
	
  <div class="uk-grid"> 
      <div class="uk-width-1-1">
            <ul class="uk-breadcrumb uk-margin-top">
              <li>{!! Html::link('/','Home') !!}<span class="divider"></span></li>
              <li>{!! Html::link('/news','News') !!}<span class="divider"></span></li>
              <li class="active">{{ $news->fldNewsName }}</li>
          </ul>
    </div>
  </div> 
  
  <div class="uk-grid uk-margin-top">
        <div class="uk-width-medium-2-10">
    	@include('home.includes.sidenav_news')
    </div>
    <div class="uk-width-medium-6-10 uk-margin-left">
        <div class="blog-post">
        	<h2 class="blog-post-title">{{ $news->fldNewsName }}</h2>
        	<p class="blog-post-meta">Date Posted {{ date('F d, Y',strtotime($news->fldNewsNewsDate)) }}</p> 
        	<p> {!! $news->fldNewsDescription !!} </p>          	
        </div>
        <ul class="uk-pagination">
       		@if(count($news_previous)==1)
            <li class="uk-pagination-previous">                              	
              <a href="{{url('news/'.$news_previous->fldNewsSlug)}}"><i class="uk-icon-angle-double-left"></i> Previous</a>
              
            </li>
        	@endif
        
                    
        	@if(count($news_next)==1)
            <li class="uk-pagination-next">
              <a href="{{url('news/'.$news_next->fldNewsSlug)}}">Next <i class="uk-icon-angle-double-right"></i></a>
            	
            </li>
        	@endif
        </ul>	
    </div>
  </div><!--row -->

@stop

@section('headercodes')
	
@stop