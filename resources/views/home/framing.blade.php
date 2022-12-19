@extends('layouts._front.full-width')

@section('content')
<div class="uk-margin-medium-bottom">

<article role="main" id="main">
	{!!$pages->fldPagesDescription2!!}
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
