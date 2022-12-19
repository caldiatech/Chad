@extends('layouts._front.pages')

@section('content')
      
  
<div class="uk-container uk-container-center uk-margin-medium-bottom">
	<article id="main" role="main">
		<div class="uk-grid">	
			<div class="uk-width-1-1">    
				@if($pages->fldPagesID==72)
					<div class="uk-grid">
						<div class="uk-width-medium-1-2 uk-width-small-1-1 first-row">
						{!! $pages->fldPagesDescription !!}
						</div>
						<div class="uk-width-medium-1-2 uk-width-small-1-1 last-row">
						<img class="image-responsive  uk-align-left uk-margin-large-right uk-margin-large-top" src="http://tekcopia.com/clarkin/public/uploads/pages/icon-user.png" alt="" />
						{!! $pages->fldPagesDescription2 !!}
						</div>
						</div>
				@else
					{!! $pages->fldPagesDescription !!}
				@endif	
   
			</div>

		</div>	
	</article>
</div><!--container -->
@if($pages->fldPagesID==72)
<div class="full-width-slider-1" id="pageslideshow" data-uk-scrollspy="{repeat:true}">
	<?php $slideshow_directional_nav = '<div class="uk-slideshow-direction-nav uk-margin-medium-bottom">
                     		<a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous" ></a>
        					<a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
                     	</div>
                    </div>'; ?>
	<div class="uk-slidenav-position" data-uk-slideshow>
        <ul class="uk-slideshow uk-overlay-active">
            
            <li>
                <img src="{!!url('uploads/pages/about-us-slider1.jpg')!!}" width="800" height="400" alt="">
                <div class="uk-overlay-panel  uk-overlay-bottom uk-overlay-slide-bottom uk-margin-medium-bottom">
                    <div class="uk-container uk-container-center">  
                    {!!$slideshow_directional_nav!!}
                     <div class="uk-container uk-container-center">                     	
                     	<div class="uk-grid">
                     		<div class="uk-width-1-1 uk-width-medium-1-3" >
		                     	<h2>lorem ipsum dolor set elite</h2>
		                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		                        <button class="uk-button uk-button-trans fnone text-uppercase">Lorem Ipsum</button>
		                    </div>
		                    <div class="uk-width-1-1 uk-width-medium-1-3">
		                     	<h2>lorem ipsum dolor</h2>
		                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
		                    </div>
		                    <div class="uk-width-1-1 uk-width-medium-1-3">
		                     	<h2>lorem ipsum dolor set</h2>
		                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>		                        
		                    </div>
		                </div>
                    </div>
                </div>
            </li>
            <li>
                <img src="{!!url('uploads/pages/about-us-header.jpg')!!}" width="800" height="400" alt="">
                <div class="uk-overlay-panel  uk-overlay-bottom uk-overlay-slide-bottom uk-margin-medium-bottom">
                    <div class="uk-container uk-container-center">  
                     {!!$slideshow_directional_nav!!}
                     <div class="uk-container uk-container-center">                     	
                     	<div class="uk-grid">
                     		<div class="uk-width-1-1 uk-width-medium-1-3">
		                     	<h2>lorem ipsum dolor set elite</h2>
		                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		                        <button class="uk-button uk-button-trans fnone text-uppercase">Lorem Ipsum</button>
		                    </div>
		                    <div class="uk-width-1-1 uk-width-medium-1-3">
		                     	<h2>lorem ipsum dolor</h2>
		                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
		                    </div>
		                    <div class="uk-width-1-1 uk-width-medium-1-3" >
		                     	<h2>lorem ipsum dolor set</h2>
		                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>		                        
		                    </div>
		                </div>
                    </div>
                </div>
            </li>
            
        </ul>
        
         
    </div>

</div>
@endif

@stop


@section('headercodes')
 
@stop

@if($pageEditable==true)
  
@endif  
@section('extracodes')  
 {{-- */ /* */ /* --}}
	<script>
		$(document).ready(function(){
						
			loadScript("{!!url('_front/plugins/uikit/js/components/slideshow.min.js')!!}", function(){			   
				var slideshow = UIkit.slideshow($('#pageslideshow'), {  });
				slideshow.on('beforeshow.uk.slideshow', function(){
					console.log("trest");
				   
				});
			});	
		
			
		});
	</script>
@stop
