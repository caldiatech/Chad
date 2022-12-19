@extends('layouts._front.store')

@section('content')



<?php $slider = array(
				array('fldSliderImage'=>'header-style-1.jpg', 'fldSliderContent1'=>'Lorem ipsum dolor sit amet', 'fldSliderTitle1'=> 'Lorem ipsum dolor sit amet'),
				array('fldSliderImage'=>'train.jpg', 'fldSliderContent1'=>'Lorem ipsum dolor sit amet', 'fldSliderTitle1'=> 'Lorem ipsum dolor sit amet')
		);
	?>

    <div class="absolute-title-tag  uk-margin-large-top absolute-title-tag-pos-1">

        <h1 class="uk-text-center uk-text-contrast">{!! $pages->fldPagesTitle == "" ? $pages->fldPagesName : $pages->fldPagesTitle !!}</h1>
    <div class="small uk-text-center  uk-container uk-container-center uk-width-medium-1-2 uk-width-1-1 grey uk-margin-top"><p class="uk-text-contrast">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div>
	</div>
<div class="full-width-slider-1 pos-rel full-width" id="store-slideshow" data-uk-scrollspy="{repeat:true}">

	<?php $slideshow_directional_nav = '<div class="uk-slideshow-direction-nav uk-margin-medium-bottom">
                     		<a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous" ></a>
        					<a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
                     	</div>
                    </div>'; ?>
	<div class="uk-slidenav-position uk-text-contrast" data-uk-slideshow>

        <ul class="uk-slideshow uk-overlay-active">

            @foreach($slider as $sliders)
            <?php settype($sliders, 'object'); ?>
	            <li><span class="uk-overlay-background uk-background-ov"></span>
	                <img src="{{url('_front/assets/images/wallpapers/'.$sliders->fldSliderImage)}}" alt="">
	                <div class="uk-padding-xlarge-top uk-padding-xlarge-bottom uk-overlay-panel uk-overlay-background  uk-overlay-bottom uk-overlay-slide-bottom">

	                    <div class="uk-container uk-container-center">
	                    {!!$slideshow_directional_nav!!}
	                     <div class="uk-container uk-container-center white">
	                     	<div class="uk-grid">
	                     		<div class="uk-width-1-1 uk-width-medium-1-3 uk-margin-bottom" >
			                     	<h2>Lorem ipsum dolor sit amet</h2>
			                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
			                        <a href="#" class="uk-button uk-button-trans fnone text-uppercase white">Print Your Canvas Now!</a>
			                    </div>
			                    <div class="uk-width-1-1 uk-width-medium-1-3 uk-margin-bottom">
			                     	<h2>Lorem ipsum dolor sit amet</h2>
			                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
			                    </div>
			                    <div class="uk-width-1-1 uk-width-medium-1-3 uk-margin-bottom">
			                     	<h2>Lorem ipsum dolor sit amet</h2>
			                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
			                    </div>
			                </div>
	                    </div>
	                </div>
	            </li>
	        @endforeach



        </ul>


    </div>

</div>

<div class="uk-block" style="clear: both">
	<div class="uk-container uk-container-center">
		<h2>Create Easy Masterpieces</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>


	</div>
</div><!--container -->

<div class="uk-margin-medium-bottom">
	<article id="main" role="main">
		<div class="uk-grid">
			<div class="uk-width-1-1">

				<?php $frames = array(
							array('image'=>'447x397-sample-1.jpg', 'frame_color'=>'white'),
							array('image'=>'447x397-sample-2.jpg', 'frame_color'=>'white'),
							array('image'=>'447x397-sample-3.jpg', 'frame_color'=>'white'),
							array('image'=>'447x397-sample-4.jpg', 'frame_color'=>'white'),
							array('image'=>'447x397-sample-4.jpg', 'frame_color'=>'white'),
							array('image'=>'447x397-sample-3.jpg', 'frame_color'=>'white'),
							array('image'=>'447x397-sample-2.jpg', 'frame_color'=>'white'),
							array('image'=>'447x397-sample-1.jpg', 'frame_color'=>'white')
				)?>
				<div class="uk-grid-width-1-1 uk-grid-width-small-1-2  uk-grid-width-medium-1-3   uk-grid-width-large-1-4 tm-grid-heights" data-uk-grid="{gutter:0}">
					@foreach($frames as $frame)
					<?php settype($frame, 'object'); ?>
                    <div class="">
                    	<div class="uk-panel-box">
	                    	<figure class="uk-overlay uk-overlay-hover">
							    <img class="" src="{{url('uploads/photo-gallery/'.$frame->image)}}" width="500" class="w100 hauto mauto" alt="">
							    <figcaption class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-contrast">
							    		<h3 class="uk-contrast">Lorem ipsum dolor</h3>
							    		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							    </figcaption>
							</figure>
						</div>
					</div>
					@endforeach
                </div>


			</div>

		</div>
	</article>
</div><!--container -->
@stop


@section('headercodes')

@stop

@section('extracodes')
 {{-- */ /* */ /* --}}
	<script>
		$(document).ready(function(){

			loadScript("{!!url('_front/plugins/uikit/js/components/slideshow.min.js')!!}", function(){
				var slideshow = UIkit.slideshow($('#store-slideshow'), {  });
				slideshow.on('beforeshow.uk.slideshow', function(){
					console.log("trest");

				});
			});


		});
	</script>

@stop
