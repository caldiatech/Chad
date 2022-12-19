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

@stop


@section('headercodes')
 
@stop
 
@section('extracodes')  
 
@stop
