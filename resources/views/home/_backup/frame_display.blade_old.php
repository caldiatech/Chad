<div class="product-frames-slider">
                    <div class="uk-slidenav-position" id="frame_slider" data-uk-slideshow="{animation: 'scroll'}">
                                <ul class="uk-slideshow" >
			            @for($i=1;$i<=$slideFinalCount;$i++)		
				   <li class=" frame-slider-item">
                                            <div class="uk-grid uk-margin-remove" data-uk-grid="{controls: '#graphikAttribute'}" id="gridFilter">
						<? $graphicDisplay = array_slice($graphikAPI, $i==1 ? 0 : $slideFinalCount*$i+$i,6,true)?>
                                                @foreach($graphicDisplay as $graphikAPIs)
                                                    <div class="uk-width-1-3 frame-slider-subitem" data-uk-filter="{{ $graphikAPIs->filterValue != "" ? $graphikAPIs->filterValue  : "" }},{{$graphikAPIs->sku}}">    
							@if(isset($graphikAPIs->sku))
	                                                         {!! Html::image("http://image.pictureframes.com/images/angled_corners/".$graphikAPIs->sku."_l.jpg",'',array('class'=>'frame-style w100 hauto mauto','width'=>'175','height'=>'175','onClick'=>'changeFrame('."'".$graphikAPIs->sku."'".','."'".$graphikAPIs->frameWidthValue."'".')')) !!}
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
                                <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"><i class="uk-icon-chevron-left"></i></a>
                                <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"><i class="uk-icon-chevron-right"></i></a>
                                
                            </div>





                    
                  </div>