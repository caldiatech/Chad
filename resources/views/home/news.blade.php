@extends('layouts._front.news_archieve')

@section('content')

    <div class="uk-grid"> 
      <div class="uk-width-1-1">
            <ul class="uk-breadcrumb uk-margin-top">
                <li>{!! Html::link('/','Home') !!}<span class="divider"></span></li>
                <li class="active">News</li>
            </ul>
    	</div>
    </div><!--<!--row -->
     <div class="uk-grid uk-margin-top">
        <div class="uk-width-medium-2-10">
            @include('home.includes.sidenav_news')
      </div>
      <div class="uk-width-medium-6-10 uk-margin-left">
         @foreach($news as $newss)   
         <div class="blog-post">
            <h2 class="blog-post-title">{{ $newss->fldNewsName }}</h2>
            <p class="blog-post-meta">Date Posted {{ date('F d, Y',strtotime($newss->fldNewsNewsDate)) }}</p> 
            <p> {!! substr(strip_tags($newss->fldNewsDescription),0,250) ."... " . Html::link('/news/'. $newss->fldNewsSlug ,'Read more') !!} </p>          	
          </div>
          <hr />
          @endforeach 
          @if($news->isEmpty())
            <div class="uk-alert uk-alert-danger">No News Found</div>
          @endif	
      </div>
    </div><!--row -->

@stop

@section('headercodes')
@stop