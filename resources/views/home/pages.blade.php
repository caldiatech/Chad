@extends('layouts._front.pages')

@section('content')

<div class="uk-container uk-container-center uk-margin-medium-bottom uk-margin-medium-top uk-padding-large-bottom">
	<article id="main" role="main">
		<div class="uk-grid">
			<div class="uk-width-1-1">
                {!! $pages->fldPagesDescription !!}
			</div>


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
