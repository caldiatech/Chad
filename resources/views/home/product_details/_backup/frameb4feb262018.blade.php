<?php
$get_frames_ctr = 0; $frame_row_counter = 0;
?>
<div class="product-settings">
  <h3 class="text-uppercase">Frame:</h3>
  <div class="uk-grid w100 uk-margin-remove uk-text-large remove-frame-section">
    <div class="uk-width-1-2 frame-select-column uk-float-left uk-padding-remove">
          <div class="select-wrapper uk-md-large uk-float-right input-append spinner">
               <select name="frame_selection" id="frame_selection" class="frame_selection" onChange="generateNewImageFrame()">
                    @foreach($get_static_frames as $frame_obj)
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
                      $this_frame_title = $frame_obj['title'];
                      $this_frame_width = $frame_obj['width'];
                      $this_frame_color = stringify_items($frame_obj['color']);
                      $this_frame_style = stringify_items($frame_obj['style']);

                      ?>
                      <option value="{{$this_frame_sku}}" id="option_{{$this_frame_sku}}" data-style="{{$this_frame_style}}" data-color="{{$this_frame_color}}" data-width="{{$this_frame_width}}" data-title="{{$this_frame_title}}" data-filter="{{$attr}}" data-price="0" data-material="{{$this_frame_materials}}" data-style=""> {{$this_frame_title}}
                      </option>
                    @endforeach
                </select>
                <div class="add-on">
                  <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                  <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
              </div>
          </div>
    </div>
    <div class="uk-width-large-5-10 uk-float-right uk-display-inline uk-width-1-2 uk-padding-remove remove-frame-column">
        <button class="uk-button-yellow uk-button uk-width-1-1 uk-button-grey uk-text-large uk-float-right  uk-button-large" id="chkNoFrame" type="button">
          Remove Frame
        </button>
    </div>
  </div>
  <div class="uk-grid uk-width-1-1  select-photo-size uk-margin-remove uk-text-large remove-frame-section">
    <div class="uk-width-medium-1-2 uk-width-7-10 uk-padding-remove">
      Photo Size (Inches)
    </div>
    <div class="uk-width-medium-1-2 uk-width-3-10 uk-padding-remove">
      Price
    </div>
  </div>
  <?php 
  $price_html_temp = '' 
  ?>
  <div class="uk-grid uk-width-1-1 uk-margin-remove uk-text-large border-size-price-section">
    <div class="uk-width-medium-1-2 uk-width-7-10 uk-padding-remove">
      <div class="radio-option-wrapper uk-md-large">               
        @foreach($productOption as $photo_size_key => $productOptions)
          <?php 
            $first_fraction = $product_option_class->frameFraction($productOptions->fldOptionsAssetsWidthFraction);
            $first_fraction_val = fractionized($first_fraction);
            $second_fraction = $product_option_class->frameFraction($productOptions->fldOptionsAssetsHeightFraction);
            $second_fraction_val = fractionized($second_fraction);
            $border_size =  $productOptions->fldOptionsAssetsWidth . ' ' . $first_fraction .' x ' .$productOptions->fldOptionsAssetsHeight . ' ' . $second_fraction;
            $border_size_html =  $productOptions->fldOptionsAssetsWidth . ' ' . $first_fraction_val .' x ' .$productOptions->fldOptionsAssetsHeight  . ' ' .$second_fraction_val;

            if($productOptions->fldProductOptionsPrice == null || $productOptions->fldProductOptionsPrice == ''){
              $productOptions->fldProductOptionsPrice = 0;
            }
          ?>
          <label for="photo_size_{{$photo_size_key}}" class="uk-width-1-1">
            <input type="radio" name="imageSize" class="photo-size-selection-option photo-size-selection-option-{{$productOptions->fldProductOptionsID}}" id="photo_size_{{$photo_size_key}}" data-height= "{{ $productOptions->fldOptionsAssetsHeight }}" data-width="{{ $productOptions->fldOptionsAssetsWidth }}" data-price="{{ $productOptions->fldProductOptionsPrice }}" data-frame_border_size="{{$border_size}}" data-widthfraction="{{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsWidthFraction)}}" data-heightfraction="{{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsHeightFraction)}}" onchange="generateNewImageFrame()" value="{{ $productOptions->fldProductOptionsID }}" {{Input::old('imageSize') == $productOptions->fldProductOptionsID ? "selected='selected'" : ""}}>{!!$border_size_html!!}</label>

          <?php $price_html_temp .= '<label class="uk-width-1-1 uk-display-block">$<span class="price-start price-start-'.$productOptions->fldProductOptionsID.'">'.$productOptions->fldProductOptionsPrice.'</span></label>' ?>
        @endforeach
      </div>
    </div>
    <div class="uk-width-medium-1-2 uk-width-3-10 uk-padding-remove">
      <div class="radio-option-wrapper uk-md-large">               
       {!!$price_html_temp!!}
      </div>
    </div>
  </div>
    
  <div class="uk-hidden">
    <h3 class="text-uppercase">Choose Your Frame:</h3>
    <div class="uk-grid w100 uk-margin-remove uk-text-large" id="graphikAttribute">
      <div class="uk-width-1-1 uk-padding-remove">
        <label class="uk-form-label light full-width" for="width">Browse Frame Choices:</label>
        <div class="uk-grid uk-padding-small-top w100 uk-margin-remove">
          <div class="uk-width-large-1-4 uk-width-small-1-2  uk-width-1-2 uk-padding-remove">
              <div class="select-wrapper uk-md-large input-append spinner">
               <select name="color" id="frameColor">
                    <!--<option data-uk-filter="" value="0">Color</option>-->
                    @if(isset($color))
                    @foreach($color as $colors)
                         <option value="{{ $colors }}" data-uk-filter="{{ $colors }}">{{ $colors }}</option>
                    @endforeach
                    @endif
                </select>                             <div class="add-on">
                  <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                  <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                </div>
              </div>
          </div>
          <div class="uk-width-large-1-4 uk-width-small-1-2  uk-width-1-2 uk-padding-remove">
               <div class="select-wrapper uk-md-large input-append spinner">
                <select name="width" id="frameWidth">
                      <!--<option value="0">Width</option>-->
                      @foreach(config('constants.frame_width')  as $range => $widthValues)
                         <option value="{{ $range }}">{{ $widthValues }}</option>
                      @endforeach
                </select>                              <div class="add-on">
                  <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                  <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                </div>
              </div>
          </div>
          <div class="uk-width-large-1-4 uk-width-small-1-2  uk-width-1-2 uk-padding-remove">
              <div class="select-wrapper uk-md-large input-append spinner">
                <select name="style" id="frameStyle">
                    <!--<option value="0">Style</option>-->
                    @if(isset($styleValue))
                    @foreach($styleValue as $styleValues)
                         <option value="{{ $styleValues }}">{{ $styleValues }}</option>
                    @endforeach
                    @endif
                </select>                              <div class="add-on">
                  <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                  <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                </div>
              </div>
          </div>
          <div class="uk-width-large-1-4 uk-width-small-1-2  uk-width-1-2 uk-padding-remove">
              <div class="select-wrapper uk-md-large input-append spinner">
                <select name="material" id="frameMaterial">
                    <!--<option value="0">Material</option>-->
                    @if(isset($materialValue))
                    @foreach($materialValue as $materialValue)
                         <option value="{{ $materialValue }}">{{ $materialValue }}</option>
                    @endforeach
                    @endif
                </select>                              <div class="add-on">
                  <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                  <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                </div>
              </div>
          </div>
        </div>
      </div>
      <div class="full-width uk-margin-medium-top uk-padding-remove"> </div>
      <div class="uk-width-medium-6-10 uk-width-1-2 uk-padding-remove">
        <div class="text-wrapper">
            <input type="text" value="" class="text" placeholder="Enter SKU" id="txtSKU" onkeypress="return event.keyCode != 13;">
            <button type="submit" class="append-button uk-text-bold" form="form1" value="Submit" onClick="searchFrame()"><i class="fa uk-icon-search"></i></button>
        </div>
      </div>
      <div class="uk-width-medium-4-10 uk-width-1-2  uk-padding-remove uk-text-right">
        <button type="button" class="uk-button-primary uk-button-grey reset-btn uk-text-large uk-float-right full-width lato uk-button-large" onClick="resetme()" >Reset</button>
      </div>

    </div>
  </div>


  <div class="full-width bg-grey uk-margin uk-margin-top uk-hidden" id="toggle-frame-details">
    <div class="full-width padding-small border-bottom">
          <span class="light frame-description-lbl uk-display-inline-block uk-margin-small-right">Frame: &nbsp;</span><span class="bold text-uppercase  frame-description-text uk-display-inline-block uk-margin-right"></span><span class="light frame-sku-lbl uk-display-inline-block uk-margin-small-right">SKU: &nbsp;</span>
          <span class="bold text-uppercase  frame-sku-text uk-display-inline-block uk-margin-right"></span><span class="light frame-color-lbl uk-display-inline-block uk-margin-small-right"> Color: &nbsp;</span> <span class="bold text-uppercase  frame-color-text uk-display-inline-block uk-margin-right"></span>  <span class="light frame-style-lbl uk-display-inline-block uk-margin-small-right">Style: &nbsp;</span> <span class="bold text-uppercase  frame-style-text uk-display-inline-block"></span>  
          <div class="full-width">
                <span class="light frame-liner-lbl uk-display-inline-block uk-margin-small-right">Liner: &nbsp;</span>
                <span class="bold text-uppercase  frame-liner-text uk-display-inline-block">Linen Liners Large Black Linen Liner</span>
          </div>  
          <div class="full-width">
                <span class="light photo-size-lbl uk-display-inline-block uk-margin-small-right">Photo Sizw: &nbsp;</span>
                <span class="bold text-uppercase  photo-size-text uk-display-inline-block"></span>
          </div>     
    </div>
  </div>
  


<? /* 
    <div class="uk-grid uk-grid-collapse"> 
      <div class="uk-width-large-1-2  uk-width-medium-1-1 uk-width-small-1-2 uk-width-1-1">
          <label class=" light uk-margin-small-right" for="sortby">Sort By:</label>
          <div class="select-wrapper wrapper-large input-append spinner">
             <select id="sortby" onChange="loadSort(this.value)">
  <option value="name">Name</option>
                <option value="price">Price</option>
            </select>
           <div class="add-on">
              <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
              <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
            </div>
          </div>
      </div>
       <div class="uk-width-large-1-2 uk-width-medium-1-1 uk-width-small-1-2 uk-width-1-1 uk-padding-remove  uk-text-right">
            <div id="pagination"></div>
      </div>
    </div>

  <div class="full-width uk-margin-medium-top uk-padding-remove"> </div>
  <div id="frameDisplay">
    <div id="frameLoader" class="uk-margin-top">
      <div class="uk-alert uk-alert-warning"><i class="uk-icon-spinner uk-icon-spin"></i> <strong>Please wait!</strong> Loading available frames.</div>
    </div>
  </div>
*/ ?>

</div> <!-- <div class="product-settings"> -->