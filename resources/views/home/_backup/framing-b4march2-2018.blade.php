@extends('layouts._front.full-width')

@section('content')
<div class="uk-margin-medium-bottom">

<article role="main" id="main">
	<div class="uk-grid">
		<div class="uk-width-1-1">
			<div class="uk-grid-width-1-1 uk-grid-width-small-1-2  uk-grid-width-medium-1-3   uk-grid-width-large-1-4 tm-grid-heights" data-uk-grid="{gutter:0}">
<!-- 1st Row -->


	<?php

		$get_static_frames = config('constants.frames');
		$get_static_frames_count = count($get_static_frames);
		$get_frames_ctr = 0; $frame_row_counter = 0;


	?>
	 @if($get_static_frames_count > 0)
        @foreach($get_static_frames as $frame_key => $frame_obj)          
          <?php 
          $attr = '';
          $frame_obj_attr = $frame_obj['attributes'];
          foreach($frame_obj_attr as $i => $frame_obj_attr_item){
            if($attr != ''){
              $attr .= ',';
            }
            $attr .= $frame_obj_attr_item;
          } 
          $this_frame_sku = $frame_obj['sku'];
          $this_frame_materials = $frame_obj['material'];
          $this_frame_title = $this_frame_sku. ' ' .$frame_obj['title'];
          $this_frame_width = $frame_obj['width'];
          echo '<div>
					<div class="uk-panel-box">
					<figure class="uk-overlay uk-overlay-hover">
						<img class="frame-img" src="'.url('uploads/photo-gallery/'.$this_frame_sku.'_l.jpg').'" width="500">
						<figcaption class="uk-overlay-panel uk-overlay-background">
							<h3>'.$this_frame_title.'</h3>
							<a data-sku="'.$this_frame_sku.'" href="javascript:void(0)" class="uk-button uk-button-trans fnone text-uppercase white get-canvas">View Canvas</a>
						</figcaption>
					</figure>
				</div>
			</div>';
          ?>
			                     
        @endforeach
      @endif
     </div>
    </div>
   </div>
</article>

</div><!--container -->
@stop


@section('headercodes')
	<style type="text/css">
	.uk-modal.show-rendered-canvas .uk-modal-dialog.uk-text-center {
	    min-height: 120px;
	    position: relative;
	    width: 84%;
	    max-width: 668px;
	    padding: 0;
	}
	.uk-modal.show-rendered-canvas .uk-modal-dialog.uk-text-center.loading:before {
	    content: 'Loading...';
	    position: absolute;
	    z-index: 0;
	    top: -50%;
	    height: 50px;
	    bottom: -50%;
	    left: -50%;
	    right: -50%;
	    width: auto;
	    margin: auto;
	}
	.uk-modal.show-rendered-canvas .uk-modal-dialog iframe {
	    position: relative;
	    z-index: 1;
	}	
	article#main{ position: relative; max-width: 1260px; margin: auto; }	
	</style>
@stop

@if($pageEditable==true)

@endif
@section('extracodes')
 {{-- */ /* */ /* --}}

<script type="text/javascript">
	function iframeDidLoad(){
		$('.show-rendered-canvas .uk-modal-dialog').removeClass('loading');
		$('.show-rendered-canvas .uk-modal-dialog img').removeClass('uk-hidden');
	}
</script>
<div class="uk-modal show-rendered-canvas ">
    <div class="uk-modal-dialog uk-modal-dialog-lightbox uk-text-center loading " >
    	<a class="uk-modal-close uk-close uk-close-alt"></a>
        <img width="800" height="800" class="uk-hidden" src="about:void" id="load_rendered_img"  onLoad="iframeDidLoad();"></iframe>
    </div>
</div>
<script type="text/javascript">
	var modal_show_rendered_canvas = UIkit.modal(".show-rendered-canvas", {center:true});
	$(document).ready(function(){
		$('.show-rendered-canvas').on({

		    'show.uk.modal': function(){
		        console.log("Modal is visible.");
		    },

		    'hide.uk.modal': function(){
		        $('.show-rendered-canvas .uk-modal-dialog img').addClass('uk-hidden');
		        $('.show-rendered-canvas .uk-modal-dialog').addClass('loading');
		    }
		});

		$(document).on('click','.get-canvas', function(){
			console.log('sasas');
			var this_get_canvas_a = $(this);
			var this_sku = this_get_canvas_a.attr('data-sku');
			$('#load_rendered_img').attr('src', "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{url('_front/assets/images/big-sur-sample-image-stock.jpg')}}&imgHI=25&imgWI=80&maxW=800&maxH=250&m1b=0&off=0&sku="+this_sku+"&frameW=5");

			if ( modal_show_rendered_canvas.isActive() ) {
			    modal_show_rendered_canvas.hide();
			} else {
			    modal_show_rendered_canvas.show();
			}

			
		});
	});
</script>

@stop
