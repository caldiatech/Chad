<div class="product-frames-slider">
                    <div class="uk-slidenav-position" id="frame_slider" data-uk-slideshow="{animation: 'scroll'}">
                      @if(!$slideFinalCount)
                          <div class="uk-alert uk-alert-danger">No results</div>
                      @endif
                                <ul class="uk-slideshow" >
			            @for($i=0;$i<=$slideFinalCount-1;$i++)
				   <li class=" frame-slider-item">
                                            <div class="uk-grid uk-margin-remove" data-uk-grid="{controls: '#graphikAttribute'}" id="gridFilter">
						<?
              //echo $slideFinalCount . "<br>";
              $graphicDisplay = array_slice($graphikAPI,  6*$i,6,true);

            ?>
                                                @foreach($graphicDisplay as $graphikAPIs)
                                                    <div class="uk-width-1-3 frame-slider-subitem">
							@if(isset($graphikAPIs->sku))
	                                                         {!! Html::image("http://image.pictureframes.com/images/angled_corners/".$graphikAPIs->sku."_l.jpg",'',array('class'=>'frame-style w100 hauto mauto','width'=>'175','height'=>'175','onClick'=>'changeFrame('."'".$graphikAPIs->sku."'".','."'".$graphikAPIs->frameWidthValue."'".','."'".$graphikAPIs->priceData->markUpPrice."'".','."'".$graphikAPIs->shortDescription."'".')')) !!}
							@endif
                                                    </div>
                                                @endforeach
                                            </div>
                                       </li>
				     @endfor
                                    <? /*
                                    @for($f1 = 1; $f1<=2; $f1++)
                                        <li class=" frame-slider-item">
                                          <div class="uk-grid uk-margin-remove">
                                          @for($f = 1; $f<=9; $f++)
                                            <div class="uk-width-1-3 frame-slider-subitem">
                                             {!! Html::image(url(PRODUCT_IMAGE_PATH.'product-name/frames/frame'.$f.'.jpg'),'',array('class'=>'frame-style w100 hauto mauto','width'=>'175','height'=>'175')) !!}
                                            </div>
                                          @endfor
                                          </div>
                                      </li>
                                    @endfor
                                     */
                                     ?>
                                </ul>
                                @if($slideFinalCount > 1)
                                <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"><i class="uk-icon-chevron-left"></i></a>
                                <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"><i class="uk-icon-chevron-right"></i></a>
                                @endif

                            </div>

                  </div>

<script>

    $(document).ready(function(){
      loadScript("{!!url('_front/plugins/spinner/src/jquery.spinner.js')!!}", function(){
        $('#customize-spinner').spinner('changed',function(e, newVal, oldVal){

        });

   loadScript("{!!url('_front/plugins/uikit/js/components/slideshow.min.js')!!}", function(){
          var frames_slider = UIkit.slideshow($('#frame_slider'), { /* options */ });
        });

        loadScript("{!!url('_front/plugins/uikit/js/components/pagination.min.js')!!}", function(){

        });

      });
    });



    $("#pagination").html('<ul class="uk-pagination uk-pagination-smaller bg-white uk-text-center" data-uk-pagination="{items:{{$slideFinalCount}}, itemsOnPage:1}"></ul>');

     $('[data-uk-pagination]').on('select.uk.pagination', function(e, pageIndex){

        var slideshow = UIkit.slideshow($("#frame_slider"), { start:pageIndex});
        slideshow.show(pageIndex);


      });

     (function($){

        var container  = $('#frame_slider'),
            slideshows = container.find('[data-uk-slideshow]');

        container.on('beforeshow.uk.slideshow', function(e, next) {
            console.log(next.index());

            //var pagination = UIkit.pagination($("#pagination"), { currentPage:next.index()});
            var pagination = UIkit.pagination('.uk-pagination');
              pagination.options.currentPage = next.index();
              pagination.options.items = {{ $slideFinalCount }};
              pagination.init();
           // slideshows.not(next.closest('[data-uk-slideshow]')[0]).data('slideshow').show(next.index());
        });

    })(jQuery);


  </script>