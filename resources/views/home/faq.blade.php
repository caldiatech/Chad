@extends('layouts._front.pages')

@section('content')


<div class="uk-container uk-container-center uk-margin-large-bottom uk-margin-large-top uk-padding-bottom">
	<article id="main" role="main">
		<div class="uk-grid">
            <? /*
			<div class="uk-width-1-1">
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
					{!! $pages->fldPagesDescription !!}
				@endif
			</div>
            */ ?>

<div class="uk-width-6-10  uk-faq">
<div class="uk-accordion uk-accordion-me" data-uk-accordion="{collapse: false}">

    <h2 class="uk-margin-bottom-remove">Frequently Asked Questions</h2>
 		<? /* <p class="uk-margin-large-bottom">Lorem ipsum dolor sit amet</p> */ ?>
        {!! $pages->fldPagesDescription !!}
    </div>
 </div>
 <div class="uk-width-4-10  uk-faq">
 	<div class="bordered-left bordered-white padleft40">
        {!! $pages->fldPagesDescription2 !!}
 		<? /* <h2 class="uk-margin-bottom-remove">Can't Find What You're Looking For?</h2>
 		<p class="uk-margin-remove">Send us your question directly.</p> */ ?>
 		{!! Form::open(array('url' => '/faq', 'method' => 'post',  'class' => 'row-fluid input-100 bill-info')); !!}
        @if(isset($error))
            <div class="uk-alert uk-alert-danger"> {!! $error !!}</div>
        @endif
         @if(Session::has('success'))
            <div class="uk-alert uk-alert-success"> {!! Session::get('success') !!}</div>
        @endif
            <div class="uk-grid">

                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                    {!! Form::label('email', '* Email Address',array( )); !!}
                    {!! Form::email('email',"",array('id'=>'email','required','class'=>'form-control')) !!}
                    @if ($errors->has('email'))
                        <div id="" style="" class="uk-alert uk-alert-danger uk-alert-error"> {!! $errors->first('email') !!} </div>
                    @endif
                </div >
                <div class = "uk-width-1-1  uk-margin-top" >
                    {!! Form::label('question', '* Question',array( )); !!}
                    {!! Form::textarea('question',"",array('id'=>'message','required','class'=>'form-control text')) !!}
                </div >
                <div class = "uk-width-1-1 uk-margin-large-top">
                 {!! Form::submit('Send',array('name'=>'send','class'=>'uk-button uk-button-primary uk-max-width'))!!}
                </div>
            </div><!--row -->
        {!! Form::close() !!}
 	</div>
 </div>



@stop


@section('headercodes')

@stop


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

			
			loadScript("{!!url('_front/plugins/uikit/js/components/accordion.min.js')!!}", function(){
				var accordion = UIkit.accordion($('.uk-accordion-me'), {  });
			});
			


		});
	</script>
@stop
