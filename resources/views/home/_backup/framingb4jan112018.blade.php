@extends('layouts._front.full-width')

@section('content')
<div class="uk-margin-medium-bottom">

	<article role="main" id="main">
		{!! $pages->fldPagesDescription2 !!}
	</article>

</div><!--container -->
@stop


@section('headercodes')

@stop

@if($pageEditable==true)

@endif
@section('extracodes')
 {{-- */ /* */ /* --}}
{!! HTML::script('_front/plugins/uikit/js/components/lightbox.min.js') !!}
<script type="text/javascript">
	var modal_show_rendered_canvas = UIkit.modal(".show-rendered-canvas");
	

	$(document).ready(function(){
		$(document).on('click','.get-canvas', function(){
			var this_get_canvas_a = $(this);
			var this_sku = this_get_canvas_a.attr('data-sku');
			var this_imgUrl = this_get_canvas_a.attr('data-href');
			$('#load_rendered_img').attr('src', "http://pod.cloud.graphikservices.com/renderEMF/render?imgUrl=http://54.68.88.28/clarkin/public/_admin/assets/images/clarking-adminlogo.png&imgHI=8&imgWI=8&sku="+this_sku+"&t=2&b=2&r=2&l=2&mat1=PM983&mat2=PM3297");
			if ( modal_show_rendered_canvas.isActive() ) {
			    modal_show_rendered_canvas.hide();
			} else {
			    modal_show_rendered_canvas.show();
			}

			
		});
	});
</script>
@stop
