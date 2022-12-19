@extends('layouts._front.pages')

@section('content')

<div class="uk-container uk-container-center uk-margin-medium-bottom uk-margin-medium-top uk-padding-large-bottom">
	<article id="main" role="main">
		<div class="uk-grid">

<div class="uk-width-1-1">

    {!! $pages->fldPagesDescription !!}

<!-- 	<h2>Shipping Information</h2>
	<p>Committed to a WOW experience, we're proud to fulfill orders with the fastest turn-around time in our industry. The vast majority of orders are processed, produced and shipped within 2-3 business days – including custom!</p>

    <div class="uk-grid" data-uk-grid-margin="">
        <div class="uk-width-medium-1-3 uk-row-first">
            <div class="uk-panel uk-panel-box" style="padding: 0 0 40px">
                <div class="uk-thumbnail uk-padding-remove">
                    <img src="public/_front/assets/images/1.jpg" alt="">
                    <div class="uk-thumbnail-caption" style="padding: 30px 40px 40px">
                        <h3 class="blac">Shipping</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <a href="#" class="uk-button uk-display-block">Lorem Ipsum</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-width-medium-1-3">
            <div class="uk-panel uk-panel-box" style="padding: 0 0 40px">
                <div class="uk-thumbnail uk-padding-remove">
                    <img src="public/_front/assets/images/2.jpg" alt="">
                    <div class="uk-thumbnail-caption" style="padding: 30px 40px 40px">
                        <h3 class="blac">Shipping</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <a href="#" class="uk-button uk-display-block">Lorem Ipsum</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-width-medium-1-3">
            <div class="uk-panel uk-panel-box" style="padding: 0 0 40px">
                <div class="uk-thumbnail uk-padding-remove">
                    <img src="public/_front/assets/images/3.jpg" alt="">
                    <div class="uk-thumbnail-caption" style="padding: 30px 40px 40px">
                        <h3 class="blac">Shipping</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <a href="#" class="uk-button uk-display-block">Lorem Ipsum</a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="accordion_custom"> <!--start of accordion_custom-->


    <div class="accordion_wrapper uk-accordion uk-accordion-me" data-uk-accordion="{collapse: false}">
        <h2>Frequently Asked Question</h2>
	<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

	<?php $ten  = 2; ?>
	@for($i=0; $i<$ten; $i++)
    <div class="box-panel">
        <h3 class="uk-accordion-title">I'm Ordering Something Large, Will There be Oversized Carrier Charges?</h3>
        <div class="uk-accordion-content">
            <p>For frames over 55" combined outside dimensions, an Oversized Carrier Charge is added. This reflects our shippers' surcharges for such large packages, as well as the additional packaging materials required to ensure that your oversized frame arrives just as beautiful as the day it left our workshop.</p>

    <p>Please note that outside dimensions are different from frame size. Your frame's outside dimensions will be larger, taking into account the width of the moulding.</p>
    <p class="yellow">Outside dimensions = Width + Height + (4x moulding width)</p>
    <h3>Oversized Carrier Charges</h3>
    <ul class="uk-list  uk-list-line">
    <li><div  class="uk-width-1-2 uk-float-left"> 55"</div><div  class="uk-width-1-2 uk-float-left"> <strong>No Charge</strong> </div></li>
    <li><div  class="uk-width-1-2 uk-float-left"> 55" - 70"</div><div  class="uk-width-1-2 uk-float-left"> $14.50 </div></li>
    <li><div  class="uk-width-1-2 uk-float-left"> 71" - 90"</div><div  class="uk-width-1-2 uk-float-left"> $29.50 </div></li>
    <li><div  class="uk-width-1-2 uk-float-left"> 90" - 120"</div><div  class="uk-width-1-2 uk-float-left"> $200.00 </div></li>
    <li><div  class="uk-width-1-2 uk-float-left"> > 120"</div><div  class="uk-width-1-2 uk-float-left"> <strong>$275.00</strong> </div></li>
    </ul>
            </div>
        </div>


        <div class="box-panel">
            <h3 class="uk-accordion-title">How Much Does Shipping Cost?</h3>
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

</div> <!--end of accordion_custom-->

</div>


		</div>
	</article>
</div><!--container -->


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
