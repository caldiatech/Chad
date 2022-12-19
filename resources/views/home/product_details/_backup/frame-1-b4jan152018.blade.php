<? /*
<div class="product-settings">
  <h3 class="text-uppercase">Select Size:</h3>
  <div class="uk-grid w100 uk-margin-remove uk-text-large remove-frame-section">
    <div class="uk-width-medium-1-2 uk-width-1-1 uk-padding-remove">
            <div class="select-wrapper uk-md-large input-append spinner">
               <select name="imageSize" id="imageSize" onChange="generateNewImageFrame()">
                    @foreach($productOption as $productOptions)
                      <option data-height= "{{ $productOptions->fldOptionsAssetsHeight }}" data-width="{{ $productOptions->fldOptionsAssetsWidth }}" data-price="{{ $productOptions->fldProductOptionsPrice }}" data-widthfraction="{{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsWidthFraction)}}" data-heightfraction="{{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsHeightFraction)}}" value="{{ $productOptions->fldProductOptionsID }}" {{Input::old('imageSize') == $productOptions->fldProductOptionsID ? "selected='selected'" : ""}}>{{ $productOptions->fldOptionsAssetsWidth }} {{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsWidthFraction)}} x {{ $productOptions->fldOptionsAssetsHeight }} {{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsHeightFraction)}}</option>
                    @endforeach
                </select>
                <div class="add-on">
                  <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                  <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
              </div>
            </div>
        </div>
    <div class="uk-width-large-1-2  uk-width-small-1-2  uk-width-1-1 uk-padding-remove">
        <button class="uk-button-primary uk-button-grey uk-text-large uk-float-right lato uk-button-large uk-width-1-1" id="chkNoFrame" type="button">
          Remove Frame
        </button>
    </div>
    <div class="uk-width-large-1-2  uk-width-small-1-2  uk-width-1-1 uk-padding-remove"></div>
  </div>
  <h3 class="text-uppercase">Choose Your Frame:</h3>
  <div class="uk-grid w100 uk-margin-remove uk-text-large" id="graphikAttribute">
    <div class="uk-width-1-1 uk-padding-remove">
      <label class="uk-form-label light full-width" for="width">Browse Frame Choices:</label>
      <div class="uk-grid uk-padding-small-top w100 uk-margin-remove">
        <div class="uk-width-large-1-4 uk-width-small-1-2  uk-width-1-1 uk-padding-remove">
            <div class="select-wrapper uk-md-large input-append spinner">
             <select name="color" id="frameColor" onChange="loadColors(this.value)">
                  <option data-uk-filter="" value="0">Color</option>
                  @foreach($color as $colors)
                       <option value="{{ $colors }}" data-uk-filter="{{ $colors }}">{{ $colors }}</option>
                  @endforeach
              </select>                             <div class="add-on">
                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
              </div>
            </div>
        </div>
        <div class="uk-width-large-1-4 uk-width-small-1-2  uk-width-1-1 uk-padding-remove">
             <div class="select-wrapper uk-md-large input-append spinner">
              <select name="width" id="frameWidth"  onChange="loadWidth(this.value)">
                    <option value="0">Width</option>
                    @foreach(config('constants.frame_width')  as $range => $widthValues)
                       <option value="{{ $range }}">{{ $widthValues }}</option>
                    @endforeach
              </select>                              <div class="add-on">
                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
              </div>
            </div>
        </div>
        <div class="uk-width-large-1-4 uk-width-small-1-2  uk-width-1-1 uk-padding-remove">
            <div class="select-wrapper uk-md-large input-append spinner">
              <select name="style" id="frameStyle" onChange="loadStyle(this.value)">
                  <option value="0">Style</option>
                  @foreach($styleValue as $styleValues)
                       <option value="{{ $styleValues }}">{{ $styleValues }}</option>
                  @endforeach
              </select>                              <div class="add-on">
                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
              </div>
            </div>
        </div>
        <div class="uk-width-large-1-4 uk-width-small-1-2  uk-width-1-1 uk-padding-remove">
            <div class="select-wrapper uk-md-large input-append spinner">
              <select name="material" id="frameMaterial" onChange="loadMaterial(this.value)">
                  <option value="0">Material</option>
                  @foreach($materialValue as $materialValue)
                       <option value="{{ $materialValue }}">{{ $materialValue }}</option>
                  @endforeach
              </select>                              <div class="add-on">
                <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="full-width uk-margin-medium-top uk-padding-remove"> </div>
    <div class="uk-width-medium-6-10 uk-width-1-1 uk-padding-remove">
      <div class="text-wrapper">
          <input type="text" value="" class="text" placeholder="Enter SKU" id="txtSKU" onkeypress="return event.keyCode != 13;">
          <button type="submit" class="append-button uk-text-bold" form="form1" value="Submit" onClick="searchFrame()"><i class="fa uk-icon-search"></i></button>
      </div>
    </div>
    <div class="uk-width-medium-4-10 uk-width-1-1  uk-padding-remove uk-text-right">
      <button type="button" class="uk-button-primary uk-button-grey reset-btn uk-text-large uk-float-right full-width lato uk-button-large" onClick="resetme()" >Reset</button>
    </div>

      </div>
*/ 

$get_static_frames = config('constants.frames');
$get_static_frames_count = count($get_static_frames);
$get_frames_ctr = 0; $frame_row_counter = 0;

?>

  <div class="full-width uk-margin-medium-top uk-padding-remove"> </div>
  <div id="frameDisplay">
    <div id="frameLoader" class="uk-margin-top">
     <div class="product-frames-slider">
       <div class="uk-slidenav-position" id="frame_slider" data-uk-slideshow="{animation: 'scroll'}">
          <ul class="uk-slideshow">
             <li class="frame-slider-item uk-active" data-id="0">
                <div class="uk-grid uk-margin-remove" data-uk-grid="{controls: '#graphikAttribute'}" id="gridFilter">
                  @if($get_static_frames_count > 0)
                    @foreach($get_static_frames as $frame_key => $frame_obj)
                      @if($get_frames_ctr > 2)
                        <?php  $frame_row_counter++; $get_frames_ctr = 0; ?>
                        </div>
                      </li>
                      <li class="frame-slider-item" data-id="{{$frame_row_counter}}" ">
                        <div class="uk-grid uk-margin-remove" data-uk-grid="{controls: '#graphikAttribute'}" id="gridFilter">
                      @endif
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

                      ?>
                      <div class="uk-width-1-3 frame-slider-subitem">
                        <img src="{{url('uploads/photo-gallery/'.$this_frame_sku.'_l.jpg')}}" width="175" height="175" onclick="changeFrame('{{$this_frame_sku}}','{{$this_frame_width}}',0,'{{$this_frame_title}}')" alt="{{$this_frame_title}}" data-filter="{{$attr}}" data-sku="{{$this_frame_sku}}" data-material="{{$this_frame_materials}}">
                      </div>                      
                      <?php $get_frames_ctr++; ?>
                    @endforeach
                  @endif
                </div>
             </li>             
          </ul>
          <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"><i class="uk-icon-chevron-left"></i></a><a href="#" class=" uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"><i class="uk-icon-chevron-right"></i></a>
        </div>
    </div>
  </div>
</div>
<div class="uk-width-large-1-1 uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1 uk-padding-remove  uk-text-right">
  <div id="pagination"></div>
</div>

<? /*
</div> <!-- <div class="product-settings"> -->
*/ ?>