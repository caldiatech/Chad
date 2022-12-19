@extends('layouts._front.pages')

@section('content')

<div class="uk-container uk-container-center uk-margin-medium-bottom uk-margin-medium-top uk-padding-large-bottom">
	<article id="main" role="main">
		<div class="uk-grid">
			<div class="uk-width-1-1">
                {!! $pages->fldPagesDescription !!}
			</div>


<? /*
@if($pages->fldPagesSlug == 'faq')
<div class="uk-width-6-10  uk-faq">
<div class="uk-accordion uk-accordion-me" data-uk-accordion="{collapse: false}">

    <h2 class="uk-margin-bottom-remove">Frequently Asked Questions</h2>
 		<p class="uk-margin-large-bottom">Lorem ipsum dolor sit amet</p>

	<?php $ten  = 2; ?>
	@for($i=0; $i<$ten; $i++)
        <div class="box-panel">
            <h3 class="uk-accordion-title">Lorem ipsum dolor sit amet?</h3>
            <div class="uk-accordion-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
            </div>
        </div>
        <div class="box-panel">
            <h3 class="uk-accordion-title">Consectetur adipiscing elit?</h3>
            <div class="uk-accordion-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
            </div>
        </div>
        <div class="box-panel">
            <h3 class="uk-accordion-title">Duis aute irure dolor in reprehenderit?</h3>
            <div class="uk-accordion-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
            </div>
        </div>
    @endfor


    </div>
 </div>

 <div class="uk-width-4-10  uk-faq">
 	<div class="bordered-left bordered-white padleft40">
 		<h2 class="uk-margin-bottom-remove">Can't Find What You're Looking For?</h2>
 		<p class="uk-margin-remove">Send us your question directly.</p>
 		{!! Form::open(array('url' => '/contact-us', 'method' => 'post',  'class' => 'row-fluid input-100 bill-info')); !!}
        @if(isset($error))
            <div class="alert alert-danger"> {!! $error !!}</div>
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

@elseif($pages->fldPagesSlug == 'shipping')
*/ ?>

@if($pages->fldPagesSlug == 'shipping')
    <div class="uk-width-1-1">
        {!! $pages->fldPagesDescription2 !!}
    </div>
@endif

		</div>
	</article>
</div><!--container -->

@if($pages->fldPagesID==72)

@elseif($pages->fldPagesSlug == 'customer-service')

    {!! $pages->fldPagesDescription2 !!}

    <? /*
    <div class="uk-margin-large-bottom uk-container-center uk-container  uk-padding-large-top uk-padding-large-bottom">
        <div class="uk-block uk-block-default">
            <div class="uk-grid" style="padding: 0 50px">
                <div class="uk-width-mini-1-1 uk-width-small-1-1">
                    <small class="uk-text-bold uk-text-uppercase fontblack letterspace">Customers</small>
                    <h2 class="cservice-h1 uk-text-bold uk-margin-top-remove fontblack">Support</h2>
                    <div class="uk-grid uk-grid-match" data-uk-grid-margin="">
                        <div class="uk-width-medium-1-3 uk-row-first">
                            <div class="uk-panel">
                                <p class="fontblack">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="uk-panel">
                                <p class="fontblack">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                            <div class="uk-panel">
                                <p class="fontblack">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="uk-button uk-button-primary uk-margin-top  uk-float-none ctabtn">Call Us Today</a>
                    <a href="#" class="uk-button uk-button-primary uk-margin-top  uk-float-none ctabtn-2">Email Us</a>
                </div>
            </div>
        </div>
    </div>
	<div class="uk-container-center uk-container  uk-padding-large-top uk-padding-large-bottom">
		<div class="uk-width-1-1 full-width uk-margin-large-bottom">
			<h2 class="uk-margin-bottom-remove full-width uk-margin-large-bottom uk-text-center uk-h1 cservice-h1">How Can We Help You?</h2>
            <p class="uk-text-center uk-container-center uk-width-2-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
		</div>
        <div class="uk-width-1-1 full-width">
        	<div class="uk-grid">
        		<div class="uk-width-medium-1-4 uk-width-small-1-1 uk-text-center uk-margin-large-bottom">
        			<div class="icon-wrapper uk-text-center"><i class="ionicons ion-ios-people-outline uk-icon-circled uk-text-large"></i></div>
        			<h3>Lorem Ipsum</h3>
        			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        			<a href="#" class="uk-button uk-button-primary uk-float-none cservice-btn">Learn More</a>
        		</div>
        		<div class="uk-width-medium-1-4 uk-width-small-1-1 uk-text-center uk-margin-large-bottom">
        			<div class="icon-wrapper uk-text-center"><i class="ionicons ion-ios-time-outline uk-icon-circled uk-text-large"></i></div>
        			<h3>Lorem Ipsum</h3>
        			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        			<a href="#" class="uk-button uk-button-primary uk-float-none cservice-btn">Learn More</a>
        		</div>
        		<div class="uk-width-medium-1-4 uk-width-small-1-1 uk-text-center uk-margin-large-bottom">
        			<div class="icon-wrapper uk-text-center"><i class="ionicons ion-ios-world-outline uk-icon-circled uk-text-large"></i></div>
        			<h3>Lorem Ipsum</h3>
        			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        			<a href="#" class="uk-button uk-button-primary uk-float-none cservice-btn">Learn More</a>
        		</div>
        		<div class="uk-width-medium-1-4 uk-width-small-1-1 uk-text-center uk-margin-large-bottom">
        			<div class="icon-wrapper uk-text-center"><i class="ionicons ion-ios-telephone-outline uk-icon-circled uk-text-large"></i></div>
        			<h3>Lorem Ipsum</h3>
        			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        			<a href="#" class="uk-button uk-button-primary uk-float-none cservice-btn">Learn More</a>
        		</div>
        	</div>
        </div>
        </div>
        <div class="full-width uk-margin-large-top uk-text-center bordered-top"></div>
        <div class="full-width bg-white uk-padding-large-top uk-padding-large-bottom uk-text-center bordered-top cservice-bg">
        	<div class="uk-margin-large-top uk-container-center uk-container  uk-padding-large-top uk-padding-large-bottom">
        		<div class="uk-float-left uk-width-small-1-2 uk-width-small-1-1 uk-text-left uk-padding-small-top">
        			<h3 class="uk-margin-remove">Customer Support</h3>
        			 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <strong>Ut enim ad minim veniam,</strong> quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        		</div>
        			<a href="#" class="uk-button uk-button-primary uk-margin-large-top  uk-float-none">Contact Us Today</a>
        </div>
        </div>
    */ ?>

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

			@if($pages->fldPagesSlug == 'faq' || $pages->fldPagesSlug == 'shipping')
			loadScript("{!!url('_front/plugins/uikit/js/components/accordion.min.js')!!}", function(){
				var accordion = UIkit.accordion($('.uk-accordion-me'), {  });
			});
			@endif


		});
	</script>
@stop
