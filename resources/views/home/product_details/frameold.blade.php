<?php
$get_frames_ctr = 0; $frame_row_counter = 0;

// $array_expensive_costs = ["40"=>"200","50"=>"250","60"=>"300","70"=>"300","80"=>"301","90"=>"302","100"=>"303","110"=>"304"]; // 8 Frame Sizes
$array_expensive_costs = get_expensive_costs(); // can be updated in config/constants.php
// print_r($array_expensive_costs);

// Re-index --- start from 0
$array_expensive_costs = array_values($array_expensive_costs);
// echo '<pre>';
// print_r($array_expensive_costs);
// die('Ln188');
$i = 0; $ii = 1;
$this_expensive_cost = $cheap_cost_counter = 0;
$default_dataliner = "LN1BK";
?>

{{--  <hr>  --}}


<div style="display:none;" >
  <div class="alert alert-info">
    <strong>Note:</strong> Please choose your category to filter which option/s you want.
  </div>
  <form>
      <label for="radio1">FRAME & LINER</label>
      <input type="radio" name="opt" id="radio1" class="categoryOpt" value="FRAMEX" checked>

      <label for="radio2">PRINTS</label>
      <input type="radio" name="opt" id="radio2" class="categoryOpt" value="PRINTSX">
  </form>
</div>

<?php
  if ( isset( $_GET['print_id'] ) && !empty( $_GET['print_id']) ) {
      $sizelist = App\Models\SizeListModel::where( 'print_id' , $_GET['print_id'] )->where( 'deleted' , 0 )->paginate( 10 );
      $print_id = $_GET['print_id'];
  } else {
      $print_id = 0;
      $sizelist = 0;
  }
?>

<br>

<!-- <input type="radio" id="OptionsFrames10001" name="OptionsFrames"  data-id = "10001"  class="OptionsFrames" value="10001" {{ $print_id == 0 ? 'checked' : '' }} {{ $print_id == '10001' ? 'checked' : '' }}><label style="font-size: 21px; font-weight: 400;">&nbspFramed Prints</label> -->
<br><br>
<!-- <label for="OptionsFrames10001"><h3>Framed Prints</h3></label><br> -->
{{--  <hr>  --}}

<!-- Graphik Cost Est --> <input type="hidden" name="defaultcost" id="defaultcost" value="">  
<!-- Frame Sequence --> <input type="hidden" name="frame_sequence" id="frame_sequence" value="1">
<!-- <br />
<br /> -->


<div class="product-settings">
  
  
  <!-- <div class="uk-grid w100 uk-margin-remove uk-text-large remove-frame-section" id="frameDiv">
    <div class="uk-width-large-5-10 uk-float-left uk-display-inline uk-width-1-2 uk-padding-remove remove-frame-column">
	
        <h2>Select FRAME:</h2>
    </div>

    <div class="uk-width-1-2 frame-select-column uk-float-right uk-padding-remove" style="margin-bottom: 1em !important;">
          <div class="select-wrapper uk-md-large uk-float-right input-append spinner">
               <select name="frame_selection" id="frame_selection" class="frame_selection" onChange="generateNewImageFrame()">
		    <option value="">Choose your frame</option>
                    @foreach($get_static_frames as $frame_obj)
                      <?php 
                      $attr = $attr_selected = '';
                      $frame_obj_attr = $frame_obj['attributes'];
                      foreach($frame_obj_attr as $i => $frame_obj_attr_item){
                        if($attr != ''){
                          $attr .= ',';
                        }
                        $attr .= $frame_obj_attr_item;
                      } 
                      $this_frame_sku = $frame_obj['sku'];
                      $this_frame_materials = $frame_obj['material'];
                      // $this_frame_title = $frame_obj['title'];
                      $this_frame_title = strstr($frame_obj['title'], ' ');
                      if ($this_frame_sku=='PEC6') { $this_frame_title = str_replace(' Economy', '', $this_frame_title); } // Remove the word 'Economy'
                      $this_frame_width = $frame_obj['width'];
                      $this_frame_color = stringify_items($frame_obj['color']);
                      $this_frame_style = stringify_items($frame_obj['style']);
                      $this_frame_ischeap = $frame_obj['is_cheap'];
                      if($this_frame_ischeap == 1 && $cheap_cost_counter == 0){
                        $attr_selected = ' selected = "selected" ';
                        $cheap_cost_counter++;
                      }
                      ?>
                      <option value="{{$this_frame_sku}}" id="option_{{$this_frame_sku}}" data-style="{{$this_frame_style}}" data-color="{{$this_frame_color}}" data-width="{{$this_frame_width}}" data-title="{{$this_frame_title}}" data-filter="{{$attr}}" data-price="0" data-material="{{$this_frame_materials}}" data-style="" data-is_cheap="{{$this_frame_ischeap}}" {{$attr_selected}}> {{$this_frame_title}}
                      </option>
                    @endforeach
                </select>
                <div class="add-on">
                  <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                  <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
              </div>
          </div>
    </div>

  </div>


  <div class="uk-grid w100 uk-margin-remove uk-text-large remove-frame-section" id="linerDiv">
    <div class="uk-width-large-5-10 uk-float-left uk-display-inline uk-width-1-2 uk-padding-remove remove-frame-column">
        <h3>Select LINER:</h3>
    </div>

    <div class="uk-width-1-2 frame-select-column uk-float-right uk-padding-remove" >
        <div class="select-wrapper uk-md-large uk-float-right input-append spinner">
        <select name="liner_selection" id="liner_selection" class="liner_selection" onChange="generateLiner(this)">
            <option value="">Choose your Liner</option>
            <option value="BK" id="BK" data-text="Black Linen Liner" data-color="black" data-code="BK" data-title="" data-filter="" selected>Black Linen Liner</option>
            <option value="NT" id="NT" data-text="Natural Linen Liner" data-color="natural" data-code="NT" data-title="" data-filter="">Natural Linen Liner</option>
            <option value="WT" id="WT" data-text="White Linen Liner" data-color="white" data-code="WT" data-title="" data-filter="">White Linen Liner</option>
        </select>
        <div class="add-on">
        <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
        <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
        </div>
        </div>
    </div>
  </div> -->

    {{--ROI ADDED JAN 14--}}
    <br>
    <div class="uk-grid w100 uk-margin-remove uk-text-large remove-frame-section" id="printsDiv">
        <div class="uk-width-large-5-10 uk-float-left uk-display-inline uk-width-1-2 uk-padding-remove remove-frame-column">
            {{--  <h3>Print Only :</h3>  --}}
        </div>

        <div class="uk-width-1-2 frame-select-column uk-float-right uk-padding-remove">
            <div class="select-wrapper uk-md-large uk-float-right input-append spinner">
                <select name="prints_selection" id="printsselection" class="prints_selection" style="display:none;">
                    <option value="">Select Print</option>
                    @foreach(App\Models\Prints::get() as $print)
                    <option value="{{$print->id}}" data-text="{{$print->name}}" data-price="{{$print->price}}" {{$print_id == $print->id ? 'selected' : '' }}>{{$print->name}}</option>
                    @endforeach
                </select>
                <div class="add-on">
                    <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                    <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                </div>
            </div>
        </div>
    </div>
    {{--ROI ADDED JAN 14--}}
</div>
{{--  <br><br>
<hr>  --}}

@if( $print_id == 0 || $print_id == 10001)
<br><br><br><br><br>
@endif
<hr>
<!-- <h3>Print Only :</h3> -->
<?php
$count = 0;
?>
@foreach(App\Models\Prints::get() as $print)
  <input type="radio" data-sequence="{{$count}}" id="OptionsFrames{{$print->id}}" name="OptionsFrames" data-id = "{{$print->id}}" class="OptionsFrames" value="{{$print->id}}"
  {{ $print_id == $print->id ? 'checked' : '' }}>
  <label for="OptionsFrames{{$print->id}}" style="font-size: 21px; font-weight: 400;">&nbsp;{!! $print->name !!}
    {{--  - ${!! $print->price!!}  --}}</label><br><br>
	<?php
	$count++;
	?>
@endforeach


    <!-- <strong>Note</strong>: Please verify size when switching between framed and print only products. -->
  <div class="uk-grid uk-width-1-1  select-photo-size uk-margin-remove uk-text-large remove-frame-section">
    <div class="uk-width-medium-1-2 uk-width-7-10 uk-padding-remove">
        Photo (only) Size (inches)
    </div>
    <div class="uk-width-medium-1-2 uk-width-3-10 uk-padding-remove">
      Price: &nbsp; &nbsp; &nbsp; &nbsp; <!--<small>* Includes Shipping</small>-->
    </div>
  </div>
  <?php 
  $price_html_temp = ''; 

    // echo '---------------------------------------';
    // $arrayShipProcFee = array(21,34,56,98);
    // $arrayShipProcFee = array($product->shipping_proc_fee1,$product->shipping_proc_fee2,$product->shipping_proc_fee3,$product->shipping_proc_fee4); // 4 Frame Sizes
    // $arrayShipProcFee = array(21,34,56,98,100,101,102,103); // 8 Frame Sizes
    // $arrayShipProcFee = array($product->shipping_proc_fee1,$product->shipping_proc_fee2,$product->shipping_proc_fee3,$product->shipping_proc_fee4,
                                // $product->shipping_proc_fee5,$product->shipping_proc_fee6,$product->shipping_proc_fee7,$product->shipping_proc_fee8); // 8 Frame Sizes
    // echo '<pre>';
    // print_r($arrayShipProcFee);
    // die('Ln77');
  ?>

  <div class="uk-grid uk-width-1-1 uk-margin-remove uk-text-large border-size-price-section">
    <div class="uk-width-medium-1-2 uk-width-7-10 uk-padding-remove">

<?php
// echo "<pre>";
// print_r($array_expensive_costs[$photo_size_key]);
// echo count($productOption).'<br>';
// foreach ($productOption as $option) {
//  echo $option->fldOptionsAssetsWidth.': '.$option->fldProductOptionsPrice.'<br>';
// }
// print_r($productOption);
// die('Ln92');
?>


    <div class="radio-option-wrapper uk-md-large">
        <?php 
        $lowcost = []; $highcost = [];
        if (isset($defaultcosts)) {
          foreach ($defaultcosts as $dcost) {
            $lowcost[$dcost->sequence] = $dcost->framelow_cost;
            $highcost[$dcost->sequence] = $dcost->framehigh_cost;
          }
        }
        // Original Place
        //if (isset($defaultcosts)) {
        //  foreach ($defaultcosts as $dcost) {
        //    $lowcost[$dcost->sequence] = $dcost->framelow_cost;
        //    $highcost[$dcost->sequence] = $dcost->framehigh_cost;
        //  }
        //}
          
        ?>
      

        @if($print_id == "10001")
              
              @foreach($productOption as $photo_size_key => $productOptions)
                    <?php 
                      // echo $productOptions->fldOptionsAssetsWidth.': '.$productOptions->fldProductOptionsPrice.'<br>';

                      $first_fraction = $product_option_class->frameFraction($productOptions->fldOptionsAssetsWidthFraction);
                      $first_fraction_val = fractionized($first_fraction);
                      $second_fraction = $product_option_class->frameFraction($productOptions->fldOptionsAssetsHeightFraction);
                      $second_fraction_val = fractionized($second_fraction);
                      $border_size =  $productOptions->fldOptionsAssetsWidth . ' ' . $first_fraction .' x ' .$productOptions->fldOptionsAssetsHeight . ' ' . $second_fraction;
                      $border_size_html =  $productOptions->fldOptionsAssetsWidth . ' ' . $first_fraction_val .' x ' .$productOptions->fldOptionsAssetsHeight  . ' ' .$second_fraction_val;

                      ?>
                      
                      <?php
                      
                      if($productOptions->fldProductOptionsPrice == null || $productOptions->fldProductOptionsPrice == ''){
                          $productOptions->fldProductOptionsPrice = 0;
                      }

                      // if(isset($array_expensive_costs[$productOptions->fldOptionsAssetsWidth])){
                      //   $this_expensive_cost = $array_expensive_costs[$productOptions->fldOptionsAssetsWidth];
                      // }
                      $this_expensive_cost = $array_expensive_costs[$photo_size_key];

                      $frame_cost = $productOptions->fldProductOptionsPrice;

                      // Liner
                      $default_dataliner = "LN1BK";
                      if ( in_array($i, array('0')) ) {
                          $dataliner = "LN1BK";
                      } elseif ( in_array($i, array('1')) ) {
                          $dataliner = "LN2BK";
                      } else {
                          $dataliner = "LN3BK";
                      }
                    ?>
    <input type="text" id="liner" name="liner" value="{{$default_dataliner}}" style="display:none;">

                    <?php  /* 
                    <label for="photo_size_{{$photo_size_key}}" class="uk-width-1-1">
                      <input type="radio" name="imageSize" class="photo-size-selection-option photo-size-selection-option-{{$productOptions->fldProductOptionsID}}" id="photo_size_{{$photo_size_key}}" data-height= "{{ $productOptions->fldOptionsAssetsHeight }}" data-width="{{ $productOptions->fldOptionsAssetsWidth }}" data-price="{{ $productOptions->fldProductOptionsPrice }}" data-frame_border_size="{{$border_size}}" data-shipping = {{$arrayShipProcFee[$i]}} data-defaultlocost = "{{$lowcost[$ii]}}" data-defaulthicost = "{{$highcost[$ii]}}" data-sequence="{{$ii}}" data-widthfraction="{{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsWidthFraction)}}" data-heightfraction="{{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsHeightFraction)}}" onchange="generateNewImageFrame()" value="{{ $productOptions->fldProductOptionsID }}" {{Input::old('imageSize') == $productOptions->fldProductOptionsID ? "selected='selected'" : ""}} data-addtnl_cost="{{$this_expensive_cost}}" data-frame_cost="{{$frame_cost}}"><span class="uk-display-inline-block photo-size-selection-option-lbl-{{$productOptions->fldProductOptionsID}}" >{!!$border_size_html!!}</span></label>

                    <label for="photo_size_{{$photo_size_key}}" class="uk-width-1-1">
                      <input type="radio" name="imageSize" class="photo-size-selection-option photo-size-selection-option-{{$productOptions->fldProductOptionsID}}" id="photo_size_{{$photo_size_key}}" data-height= "{{ $productOptions->fldOptionsAssetsHeight }}" data-width="{{ $productOptions->fldOptionsAssetsWidth }}" data-price="{{ $productOptions->fldProductOptionsPrice }}" data-frame_border_size="{{$border_size}}" data-shipping = {{$arrayShipProcFee[$i]}} data-defaultlocost = "{{$lowcost[$ii]}}" data-defaulthicost = "{{$highcost[$ii]}}" data-sequence="{{$ii}}" data-widthfraction="{{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsWidthFraction)}}" data-heightfraction="{{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsHeightFraction)}}" onchange="generateNewImageFrame()" value="{{ $productOptions->fldProductOptionsID }}" {{($i == 0)? "selected='selected'" : ""}} data-addtnl_cost="{{$this_expensive_cost}}" data-frame_cost="{{$frame_cost}}" data-liner="{{$dataliner}}"><span class="uk-display-inline-block photo-size-selection-option-lbl-{{$productOptions->fldProductOptionsID}}" >{!!$border_size_html!!}</span></label>
                  
                  
                  
                      data-sequence $ii


                      */ ?>
                
                  
                    <label for="photo_size_{{$photo_size_key}}" class="uk-width-1-1">{{($i == 0)? "a" : "b"}}
                      <input type="radio" name="imageSize" 
                      class="photo-size-selection-option photo-size-selection-option-{{$productOptions->fldProductOptionsID}}" 
                      id="photo_size_{{$photo_size_key}}" data-height= "{{ $productOptions->fldOptionsAssetsHeight }}" 
                      data-width="{{ $productOptions->fldOptionsAssetsWidth }}" 
                      data-price="{{ $productOptions->fldProductOptionsPrice }}" 
                      data-frame_border_size="{{$border_size}}" 
                      data-shipping="" data-defaultlocost="{{$lowcost[$ii]}}" data-defaulthicost="{{$highcost[$ii]}}" 
                      data-sequence="{{$ii}}"
                      data-arrange="{{$queryOptions->fldOptionsAssetsPosition}}"
                      data-widthfraction="{{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsWidthFraction)}}" 
                      data-heightfraction="{{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsHeightFraction)}}" onchange="generateNewImageFrame()" value="{{ $productOptions->fldProductOptionsID }}" {{($i == 0)? "checked='checked'" : "b"}} data-addtnl_cost="{{$this_expensive_cost}}" data-frame_cost="{{$frame_cost}}" data-liner="{{$dataliner}}"><span class="uk-display-inline-block photo-size-selection-option-lbl-{{$productOptions->fldProductOptionsID}}" >{!!$border_size_html!!}</span></label>

                      <?php /* LoCost<input type="text" name="defaultlocost" id="defaultlocost" value="{{$lowcost[$ii]}}"> */ ?>

                    <?php
                    // $price_html_temp .= '<label class="uk-width-1-1 uk-display-block">$ <span class="price-start price-start-'.$productOptions->fldProductOptionsID.'">'.$productOptions->fldProductOptionsPrice.' ('.$arrayShipProcFee[$i].')</span></label>';
                    $price_html_temp .= '<label class="uk-width-1-1 uk-display-block">$ <span class="price-start price-start-'.$productOptions->fldProductOptionsID.'">'.$productOptions->fldProductOptionsPrice.'</span></label>';
                    ?>

                    <?php $i++; $ii++; ?>
              @endforeach
        @elseif($print_id == 0)
              @foreach($productOption as $photo_size_key => $productOptions)
                    <?php 
                    $defaultCostPrint = \App\Models\ProductCost::where('product_id','=',$itemID)->where('sequence',$ii)->first();
                    $queryOptions = \App\Models\OptionsAssets::where( 'fldOptionsAssetsID', $productOptions->fldProductOptionsAssetsID )->first();
                    ?>
                    @if( !empty($queryOptions) )
                      <?php 
                        $first_fraction = $product_option_class->frameFraction($productOptions->fldOptionsAssetsWidthFraction);
                        $first_fraction_val = fractionized($first_fraction);
                        $second_fraction = $product_option_class->frameFraction($productOptions->fldOptionsAssetsHeightFraction);
                        $second_fraction_val = fractionized($second_fraction);
                        $border_size =  $productOptions->fldOptionsAssetsWidth . ' ' . $first_fraction .' x ' .$productOptions->fldOptionsAssetsHeight . ' ' . $second_fraction;
                        $border_size_html =  $productOptions->fldOptionsAssetsWidth . ' ' . $first_fraction_val .' x ' .$productOptions->fldOptionsAssetsHeight  . ' ' .$second_fraction_val;
                      ?>

                      <?php

                      if($productOptions->fldProductOptionsPrice == null || $productOptions->fldProductOptionsPrice == ''){
                          $productOptions->fldProductOptionsPrice = 0;
                      }
                      $this_expensive_cost = $array_expensive_costs[$photo_size_key];
                      $frame_cost = $productOptions->fldProductOptionsPrice;

                      // Liner
                      $default_dataliner = "LN1BK";
                      if ( in_array($i, array('0')) ) {
                          $dataliner = "LN1BK";
                      } elseif ( in_array($i, array('1')) ) {
                          $dataliner = "LN2BK";
                      } else {
                          $dataliner = "LN3BK";
                      }
                    ?>
                        <input type="text" id="liner" name="liner" value="{{$default_dataliner}}" style="display:none;">

                    <label for="photo_size_{{$photo_size_key}}" class="uk-width-1-1">
                      <input type="radio" name="imageSize"
                      class="photo-size-selection-option photo-size-selection-option-{{$productOptions->fldProductOptionsID}}"
                       id="photo_size_{{$photo_size_key}}"
                        data-height= "{{ $productOptions->fldOptionsAssetsHeight }}"
                         data-width="{{ $productOptions->fldOptionsAssetsWidth }}"
                          data-price="{{ $productOptions->fldProductOptionsPrice }}"
                           data-frame_border_size="{{$border_size}}"
                            data-shipping="" data-defaultlocost="{{!empty($defaultCostPrint) ? $defaultCostPrint->framelow_cost : 0 }}"
                             data-defaulthicost="{{!empty($defaultCostPrint) ? $defaultCostPrint->framehigh_cost : 0 }}"
                             data-arrange="{{$queryOptions->fldOptionsAssetsPosition}}"
                             data-sequence="{{$ii}}" data-widthfraction="{{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsWidthFraction)}}" data-heightfraction="{{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsHeightFraction)}}" onchange="generateNewImageFrame()" value="{{ $productOptions->fldProductOptionsID }}" {{($i == 0)? "checked='checked'" : ""}} data-addtnl_cost="{{$this_expensive_cost}}" data-frame_cost="{{$frame_cost}}" data-liner="{{$dataliner}}"><span class="uk-display-inline-block photo-size-selection-option-lbl-{{$productOptions->fldProductOptionsID}}" >{!!$border_size_html!!}</span></label>

                    <?php
                    $price_html_temp .= '<label class="uk-width-1-1 uk-display-block">$ <span class="price-start price-start-'.$productOptions->fldProductOptionsID.'">'.$productOptions->fldProductOptionsPrice.'</span></label>';
                    ?>

                    <?php $i++; $ii++; ?>
                    @endif
              @endforeach
        @else
              @php $counter_if = 0; @endphp
              @foreach($productOption as $photo_size_key => $productOptions)
                <?php

                $queryOptions = \App\Models\OptionsAssets::where( 'fldOptionsAssetsID', $productOptions->fldProductOptionsAssetsID )->first();
                ?>
                @if( !empty($queryOptions) )
                <?php 
                  // echo $productOptions->fldOptionsAssetsWidth.': '.$productOptions->fldProductOptionsPrice.'<br>';

                  if($productOptions->fldProductOptionsPricePrint == null || $productOptions->fldProductOptionsPricePrint == ''){

                      $productOptions->fldProductOptionsPricePrint = 0;
                      
                  }

                  $first_fraction = $product_option_class->frameFraction($productOptions->fldOptionsAssetsWidthFraction);
                  $first_fraction_val = fractionized($first_fraction);
                  $second_fraction = $product_option_class->frameFraction($productOptions->fldOptionsAssetsHeightFraction);
                  $second_fraction_val = fractionized($second_fraction);
                  $border_size =  $productOptions->fldOptionsAssetsWidth . ' ' . $first_fraction .' x ' .$productOptions->fldOptionsAssetsHeight . ' ' . $second_fraction;
                  $border_size_html =  $productOptions->fldOptionsAssetsWidth . ' ' . $first_fraction_val .' x ' .$productOptions->fldOptionsAssetsHeight  . ' ' .$second_fraction_val;
                ?>
                  
                  <?php

                  $this_expensive_cost = $array_expensive_costs[$photo_size_key];

                  $frame_cost = $productOptions->fldProductOptionsPricePrint;

                  // Liner
                  $default_dataliner = "LN1BK";
                  if ( in_array($i, array('0')) ) {
                      $dataliner = "LN1BK";
                  } elseif ( in_array($i, array('1')) ) {
                      $dataliner = "LN2BK";
                  } else {
                      $dataliner = "LN3BK";
                  }

                ?>
              <input type="text" id="liner" name="liner" value="{{$default_dataliner}}" style="display:none;">

                @if($productOptions->fldProductOptionsPricePrint == null || $productOptions->fldProductOptionsPricePrint == '')
               
                @else
                <?php $counter_if++;?>
                <label for="photo_size_{{$photo_size_key}}" class="uk-width-1-1">
                  <input type="radio" name="imageSize"
                    class="photo-size-selection-option photo-size-selection-option-{{$productOptions->fldProductOptionsID}}"
                    id="photo_size_{{$photo_size_key}}"
                    data-height= "{{ $productOptions->fldOptionsAssetsHeight }}"
                    data-width="{{ $productOptions->fldOptionsAssetsWidth }}"
                    data-price="{{ $productOptions->fldProductOptionsPricePrint }}"
                    data-frame_border_size="{{$border_size}}"
                    data-shipping=""
                    data-defaultlocost="{{$lowcost[$ii]}}"
                    data-defaulthicost="{{$highcost[$ii]}}"
                    data-sequence="{{$ii}}"
                    data-widthfraction="{{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsWidthFraction)}}"
                    data-heightfraction="{{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsHeightFraction)}}"
                    onchange="generateNewImageFrame()" value="{{ $productOptions->fldProductOptionsID }}"
                    {{($i == 0)? "checked='checked'" : ""}}
                    data-addtnl_cost="{{$this_expensive_cost}}"
                    data-frame_cost="{{$frame_cost}}"
                    data-liner="{{$dataliner}}"
                    data-arrange="{{$queryOptions->fldOptionsAssetsPosition}}">

                  <span class="uk-display-inline-block photo-size-selection-option-lbl-{{$productOptions->fldProductOptionsID}}">{!!$border_size_html!!}
                  
                  </span>
                </label>
                @endif

                <?php

                  if($productOptions->fldProductOptionsPricePrint == null || $productOptions->fldProductOptionsPricePrint == ''){

                        
                      
                  }
                  else
                  {
                        $price_html_temp .= '<label class="uk-width-1-1 uk-display-block">$ <span class="price-start price-start-'.$productOptions->fldProductOptionsID.'">'.$productOptions->fldProductOptionsPricePrint.'</span></label>';
                  }

                // $price_html_temp .= '<label class="uk-width-1-1 uk-display-block">$ <span class="price-start price-start-'.$productOptions->fldProductOptionsID.'">'.$productOptions->fldProductOptionsPrice.' ('.$arrayShipProcFee[$i].')</span></label>';
                ?>

                <?php $i++; $ii++; ?>
                @endif
              @endforeach
              @if($counter_if == 0)
                Not available right now.
                <input type="text" hidden name="counter_if">
              @endif
        @endif
      </div>
    </div>

    <div class="uk-width-medium-1-2 uk-width-3-10 uk-padding-remove">
      <div class="radio-option-wrapper uk-md-large">
       {!!$price_html_temp!!}
      </div>
    </div>
  </div>
  
    <input type="text" id="liner_color_code" name="liner_color_code" value="BK" style="display:none;">
    
  <div class="full-width bg-grey uk-margin uk-margin-large-top" id="toggle-frame-details">
    <div class="full-width padding-small border-bottom">
            <!-- <span class="light frame-description-lbl uk-display-inline-block uk-margin-small-right frame-details-lbl notPrint">Frame: &nbsp;</span> <span class="bold text-uppercase  frame-description-text uk-display-inline-block uk-margin-right frame-details-val removeFrameVal notPrint"></span>
            <span class="light frame-color-lbl uk-display-inline-block uk-margin-small-right frame-details-lbl frame-details-lbl notPrint"> Color: &nbsp;</span> <span class="bold text-uppercase  frame-color-text uk-display-inline-block uk-margin-right frame-details-val removeFrameVal notPrint"></span>
            <span class="light frame-style-lbl uk-margin-small-right frame-details-lbl frame-details-lbl notPrint">Style: &nbsp;</span> 
            <span class="bold text-uppercase  frame-style-text uk-display-inline-block frame-details-val removeStyleSpan notPrint"></span>  
            <span class="light frame-liner-lbl uk-display-inline-block uk-margin-small-right frame-details-lbl removeLinerOnPrints">Liner: &nbsp;</span>
            <span class="bold text-uppercase  frame-liner-text uk-display-inline-block frame-details-val">Black Linen Liner</span>
	    <span class="bold text-uppercase  frame-liner-text uk-display-inline-block frame-details-val removeLinerVal removeLinerOnPrints"></span> -->

            <span class="light frame-print-lbl uk-display-inline-block uk-margin-small-right frame-details-lbl uk-hidden">Print: &nbsp;</span>
            <span class="bold text-uppercase  frame-print-text uk-display-inline-block frame-details-val uk-hidden removePrintsVal"></span>

            <span class="light photo-size-lbl uk-display-inline-block uk-margin-small-right frame-details-lbl">Photo Size: &nbsp;</span>
            <span class="bold text-uppercase  photo-size-text uk-display-inline-block frame-details-val"></span>
            <span class="light photo-size-lbl uk-display-inline-block uk-margin-small-right frame-details-lbl">&nbsp;</span>
            <!-- <span class="uk-display-inline-block frame-details-val">*Photo Size For Print. Add 8-10 inches for Frame and Liner.</span> -->
    </div>
  </div>
  

</div> <!-- <div class="product-settings"> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <script src="https://davidstutz.de/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script> -->
<!-- <link href="https://davidstutz.de/bootstrap-multiselect/dist/css/bootstrap-multiselect.css" rel="stylesheet"/> -->
<!-- <link href="https://davidstutz.de/bootstrap-multiselect/docs/css/bootstrap-3.3.2.min.css" rel="stylesheet"/>
<script src="https://davidstutz.de/bootstrap-multiselect/docs/js/bootstrap-3.3.2.min.js"></script> -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<script>
$(function() {
$('.removeLinerVal').html('Black Linen Liner');
//$('#printsselection option:eq(0)').prop('selected', true);
$("#printsselection").change();

var getOpt = $( 'input[name=opt]:checked' ).val();
if ( getOpt == "FRAMEX") {
 $('#frame_selection').prop('required', true);
 $('#liner_selection').prop('required', true);
 $('#printsselection').prop('required', false);

 $('#liner_selection option:eq(0)').prop('disabled', true);
 $('#frame_selection option:eq(0)').prop('disabled', true);
 $('#printsselection option:eq(0)').prop('disabled', true);

} else if ( getOpt == "PRINTSX" ) {
 $('#frame_selection').prop('required', false);
 $('#liner_selection').prop('required', false);
 $('#printsselection').prop('required', true);

 $('#liner_selection option:eq(0)').prop('disabled', true);
 $('#frame_selection option:eq(0)').prop('disabled', true);
 //$('#printsselection option:eq(0)').prop('disabled', true);

}


$("#printsDiv").hide();
    $('.categoryOpt').change(function(){
        var value = $( 'input[name=opt]:checked' ).val();
        if( value == "FRAMEX" ) {
	    $("#printsDiv").hide();
        $("#frameDiv").show();
        $("#linerDiv").show();

	$(".removeLinerTitle").show();

          $('#liner').val('{{$default_dataliner}}');
          $('#liner_color_code').val('BK');

          $('#frame_selection option:eq(5)').prop('selected', true);
          $("#frame_selection").change();  

          $('#liner_selection option:eq(1)').prop('selected', true);
          $("#liner_selection").change(); 
	

	        $('#printsselection option:eq(0)').prop('selected', true);
        	$("#printsselection").change();  
          $('#frame-selection').show();
	        $('.removePrintsVal').html('');

        	$('#frame_selection').prop('required', true);
          $('#liner_selection').prop('required', true);
          $('#printsselection').prop('required', false);

          $('#liner_selection option:eq(0)').prop('disabled', true);
          $('#frame_selection option:eq(0)').prop('disabled', true);
          $('#printsselection option:eq(0)').prop('disabled', true);

          $(".removeLinerOnPrints").attr('style','');
          $(".notPrint").attr('style','');


        } else if ( value == "PRINTSX" ) {
            $("#printsDiv").show();
            $("#frameDiv").hide();
            $('#frame_selection option:eq(0)').prop('selected', true);
            $('.removeFrameVal').html('Not Available');
            $("#frame_selection").change();  

            $(".removeLinerOnPrints").attr('style','display:none !important;');
            $(".notPrint").attr('style','display:none !important;');


            $("#linerDiv").hide();
            $('#liner_selection option:eq(0)').prop('selected', true);
                
            $("#liner_selection").change(); 
            $('#frame-selection').hide();

            $('#frame_selection').prop('required', false);
            $('#liner_selection').prop('required', false);
            $('#printsselection').prop('required', true);

            $('#liner_selection option:eq(0)').prop('disabled', true);
            $('#frame_selection option:eq(0)').prop('disabled', true);
            //$('#printsselection option:eq(0)').prop('disabled', true);
      }
    });


    var print_id = "{{$print_id}}";

    if ( print_id != "10001" && print_id != 0 ) {
        $("#radio2").prop("checked", true);
        $("#radio2").change();
    }
    
    if ( print_id == 0 ) {
      $("#radio1").prop("checked", true);
        $("#radio1").change();
    }

    $(".OptionsFrames").on('click',function(){
    	  
    	// alert('frame clicked');

        if(print_id == 1 || print_id == 2 || print_id == 3)
        {
	        // alert('no load');

	        var id = $(this).attr('data-id');
          	if(id == '10001' || id == 0)
          	{
          		location.href="?print_id="+id;
          	}
        }
        else
        {
        	var id = $(this).attr('data-id');
        	location.href="?print_id="+id;
        }

	  var id = $(this).attr('data-id');
	  var to_print_name = 0;
	  if(id == 1)
	  {
	  	to_print_name = 'Acrylic Prints';
      //alert('acrylic');
	  }
	  else if(id == 2)
	  {
		to_print_name = 'Metallic Prints';
	  }
	  else if(id == 3)
	  {
	  	to_print_name = 'Canvas Prints';
	  }
	  else
	  {
        to_print_name = '';
        id = 10001;

        window.location = window.location.href.split("?")[0];
	  }

	  $('#print_name').val(to_print_name);
      $('#print_id_add_cart').val(id);
   
    });

});

// $('#photo_size_3').removeAttr('checked');
// $('#photo_size_2').prop("checked", false);
// $('#photo_size_0').prop("checked", true);
</script>