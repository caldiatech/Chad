@extends('layouts._front.photos')

@section('content')

	<div class="row">	
      <div class="col-xs-12 col-sm-12 col-md-12">
            <ul class="breadcrumb">
                    <li>{!! Html::link('/','Home') !!}<span class="divider"></span></li>
                    <li>{!! Html::link('/photo-gallery','Gallery') !!}<span class="divider"></span></li>
                    <li class="active">{{ $photo->name }}</li>
             </ul>
        </div>
    </div>  
  	
    <h1>{{ $photo->name }}</h1> 
    
    <div class="row gallery-details">  	  
      <div class="col-xs-12 col-sm-12 col-md-12">
           <div id="slider" class="flexslider">
              <ul class="slides">
                <li>{!! Html::image('upload/photos/'.$photo->fldPhotoGalleryID.'/'.$photo->fldPhotoGalleryImage) !!}  </li>  	    
                @foreach($photos_additional as $photos_additionals)
                    <li>{!! Html::image('upload/photos/'.$photo->fldPhotoGalleryID.'/others/'.$photos_additionals->fldAdditionalPhotoGalleryImage) !!}</li>
                @endforeach
              </ul>
            </div>
            <div id="carousel" class="flexslider">
              <ul class="slides">
                <li>{!! Html::image('upload/photos/'.$photo->fldPhotoGalleryID.'/_300_'.$photo->fldPhotoGalleryImage,'',array('style'=>'width: 190px; !Important')) !!}</li>
                @foreach($photos_additional as $photos_additionals)
                    <li>{!! Html::image('upload/photos/'.$photo->fldPhotoGalleryID.'/others/_300_'.$photos_additionals->fldAdditionalPhotoGalleryImage,'',array('style'=>'width: 190px; !Important')) !!}</li>
                @endforeach  	    
              </ul>
            </div>
            <div class="photo-description top5">
            {!! $photo->fldPhotoGalleryDescription !!}
            </div>
      </div>     
    </div>	

@stop

@section('headercodes')

	  {!! Html::style('_front/plugins/flexslider/flexslider.css') !!}    
    {!! Html::script('_front/plugins/flexslider/jquery.flexslider-min.js') !!}
    
    <script>
		$(window).load(function() {
		  // The slider being synced must be initialized first
		  $('#carousel').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			itemWidth: 220,
			itemMargin: 5,
			asNavFor: '#slider'
		  });
		   
		  $('#slider').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			sync: "#carousel"
		  });
		});
	</script>
@stop