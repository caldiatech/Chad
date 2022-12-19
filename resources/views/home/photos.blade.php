@extends('layouts._front.pages')

@section('content')
<div class="uk-container uk-container-center uk-margin-medium-bottom">
  <article id="main" role="main">
    <div class="uk-grid"> 
      <div class="uk-width-1-1">    
      
        {!! $pages->fldPagesDescription !!}
        
          <div class="uk-width-1-1 uk-text-center uk-margin-medium-bottom uk-margin-medium-top">
            <a href="#" class="uk-button fnone uk-button-trans uk-container-center uk-margin-large-top  white uk-margin-large-bottom text-uppercase" class="roboto">View Image Gallery</a>
          </div>
      </div>

    </div>  
  </article>
</div><!--container -->
<div class="full-layout smaller-padd-grid featured-photos-section gallery-style-1">
  <?php $i= 0; for($m = 1; $m<=4; $m++){ $i=1;  ?>
        <div class="uk-width-1-1 uk-margin-small-top uk-margin-small-bottom">          
          <div class="uk-grid">
            <div class="uk-width-medium-1-4 uk-width-small-1-2 first-row">
              <div class="uk-overlay-hover  uk-cover-background  uk-scrollspy-inview uk-animation-fade" data-uk-modal="{target:'#modal-{!!$i++!!}'}" >
                  <figure class="uk-overlay">                                            
                      {!! Html::image('uploads/photos/16/447x397-sample-1.jpg','',array('class'=>'w100 hauto pull-left')) !!}                     
                      <figcaption class="uk-overlay-panel  uk-overlay-background uk-overlay-slide-bottom uk-overlay-bottom"><h3 class="">Lorem Ipsum Sup Et Elite Dolor</h3>
                <div class="sub-title roboto light-grey uk-margin-small-bottom">Neque Porro Quisquam</div>
                <div class="price">From <span class="bold">$85.99</span></div></figcaption>
                      <a class="uk-position-cover" href="javascript:void(0)"></a>
                  </figure>
              </div>              
            </div>
            <div class="uk-width-medium-1-4 uk-width-small-1-2 first-row">
              <div class="uk-overlay-hover  uk-cover-background  uk-scrollspy-inview uk-animation-fade" data-uk-modal="{target:'#modal-{!!$i++!!}'}" >
                  <figure class="uk-overlay">                                            
                      {!! Html::image('uploads/photos/16/447x397-sample-2.jpg','',array('class'=>'w100 hauto pull-left')) !!}                     
                      <figcaption class="uk-overlay-panel  uk-overlay-background uk-overlay-slide-bottom uk-overlay-bottom"><h3 class="">Lorem Ipsum Sup Et Elite Dolor</h3>
                <div class="sub-title roboto light-grey uk-margin-small-bottom">Neque Porro Quisquam</div>
                <div class="price">From <span class="bold">$85.99</span></div></figcaption>
                      <a class="uk-position-cover" href="javascript:void(0)"></a>
                  </figure>
              </div>              
            </div>
            <div class="uk-width-medium-1-4 uk-width-small-1-2 first-row">
              <div class="uk-overlay-hover  uk-cover-background  uk-scrollspy-inview uk-animation-fade" data-uk-modal="{target:'#modal-{!!$i++!!}'}" >
                  <figure class="uk-overlay">                                            
                      {!! Html::image('uploads/photos/16/447x397-sample-3.jpg','',array('class'=>'w100 hauto pull-left')) !!}                     
                      <figcaption class="uk-overlay-panel  uk-overlay-background uk-overlay-slide-bottom uk-overlay-bottom"><h3 class="">Lorem Ipsum Sup Et Elite Dolor</h3>
                <div class="sub-title roboto light-grey uk-margin-small-bottom">Neque Porro Quisquam</div>
                <div class="price">From <span class="bold">$85.99</span></div></figcaption>
                      <a class="uk-position-cover" href="javascript:void(0)"></a>
                  </figure>
              </div>              
            </div>
            <div class="uk-width-medium-1-4 uk-width-small-1-2 first-row">
              <div class="uk-overlay-hover  uk-cover-background  uk-scrollspy-inview uk-animation-fade" data-uk-modal="{target:'#modal-{!!$i++!!}'}" >
                  <figure class="uk-overlay">                                            
                      {!! Html::image('uploads/photos/16/447x397-sample-4.jpg','',array('class'=>'w100 hauto pull-left')) !!}                     
                      <figcaption class="uk-overlay-panel  uk-overlay-background uk-overlay-slide-bottom uk-overlay-bottom"><h3 class="">Lorem Ipsum Sup Et Elite Dolor</h3>
                <div class="sub-title roboto light-grey uk-margin-small-bottom">Neque Porro Quisquam</div>
                <div class="price">From <span class="bold">$85.99</span></div></figcaption>
                      <a class="uk-position-cover" href="javascript:void(0)"></a>
                  </figure>
              </div>              
            </div>
          </div>                
      </div>
      <?php } ?>
    </div>  
<?php for($m = 1; $m <=4; $m++){ ?>
<div id="modal-{!!$m!!}" class="uk-modal">
      <div class="uk-modal-dialog uk-modal-dialog-lightbox">
          <a href="" class="uk-modal-close uk-close uk-close-alt"></a>
           {!! Html::image('uploads/photos/16/447x397-sample-'.$m.'.jpg','',array('class'=>'w100 hauto pull-left')) !!}                      
      </div>
</div> 
      <?php } ?>
<?php
/*  @foreach($photo as $photo_item) 
  $photos = (object) $photo_item;
  @endforeach 
?>
                  
                                <div class="uk-grid uk-grid-width-small-1-2">                                
                                    @foreach($photo as $photos) 
                                                                        
                                          <div class="uk-thumbnail uk-overlay-hover" data-uk-modal="{target:'#modal-{{$photos->fldPhotoGalleryID}}'}" >
                                              <figure class="uk-overlay">                                            
                                                  {!! Html::image('upload/photos/'.$photos->fldPhotoGalleryID.'/'.$photos->fldPhotoGalleryImage,$photos->fldPhotoGalleryName) !!}                     
                                                  <figcaption class="uk-overlay-panel uk-overlay-icon uk-overlay-background uk-overlay-fade">{{$photos->fldPhotoGalleryName}}</figcaption>
                                                  <a class="uk-position-cover" href="javascript:void(0)"></a>
                                              </figure>
                                          </div>
                                          
                                      
                                
                                 @endforeach  
                              </div>    
                              @foreach($photo as $photos) 
                                <div id="modal-{{$photos->fldPhotoGalleryID}}" class="uk-modal">
                                    <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                                        <a href="" class="uk-modal-close uk-close uk-close-alt"></a>
                                        {!! Html::image('upload/photos/'.$photos->fldPhotoGalleryID.'/'.$photos->fldPhotoGalleryImage,$photos->fldPhotoGalleryName) !!}                     
                                    </div>
                                </div>          
                              @endforeach                               
                            </div>
                            */
                          ?>
                                      
      

@stop

@section('headercodes')
	
@stop