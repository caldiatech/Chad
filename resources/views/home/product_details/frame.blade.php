<?php
$get_frames_ctr = 0; $frame_row_counter = 0;
$array_expensive_costs = get_expensive_costs(); // can be updated in config/constants.php
$array_expensive_costs = array_values($array_expensive_costs);
$i = 0; $ii = 1;
$this_expensive_cost = $cheap_cost_counter = 0;
$default_dataliner = "LN1BK";
?>

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

<!-- Graphik Cost Est --> <input type="hidden" name="defaultcost" id="defaultcost" value="">  
<!-- Frame Sequence --> <input type="hidden" name="frame_sequence" id="frame_sequence" value="1">

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

@if( $print_id == 0 || $print_id == 10001)
<br><br><br><br><br>
@endif

<!-- <h3>Print Only :</h3> -->
<?php
$count = 0;
?>
<div class="select-blog">
    @foreach(App\Models\Prints::get() as $print)
        <div class="select-blog-inline">
            <label class="lbl-rdo" for="OptionsFrames{{$print->id}}" >
                {!! $print->name !!}
                <input type="radio" data-sequence="{{$count}}" id="OptionsFrames{{$print->id}}" name="OptionsFrames" data-id="{{$print->id}}" class="OptionsFrames" value="{{$print->id}}"
                {{ $print_id == $print->id ? 'checked' : '' }}>
                <span class="checkmark"></span>
            </label>
        </div>
        <?php $count++; ?>
    @endforeach
</div>

<table>
    <thead>
        <tr>
            <th>Photo (only) Size (inches)</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php 
          $price_html_temp = ''; 
          $lowcost = []; $highcost = [];
          if (isset($defaultcosts)) {
            foreach ($defaultcosts as $dcost) {
              $lowcost[$dcost->sequence] = $dcost->framelow_cost;
              $highcost[$dcost->sequence] = $dcost->framehigh_cost;
            }
          }          
        ?>

        @if($print_id == "10001")
            @foreach($productOption as $photo_size_key => $productOptions)
                <?php 
                    $first_fraction = $product_option_class->frameFraction($productOptions->fldOptionsAssetsWidthFraction);
                    $first_fraction_val = fractionized($first_fraction);
                    $second_fraction = $product_option_class->frameFraction($productOptions->fldOptionsAssetsHeightFraction);
                    $second_fraction_val = fractionized($second_fraction);
                    $border_size = $productOptions->fldOptionsAssetsWidth . ' ' . $first_fraction .' x ' .$productOptions->fldOptionsAssetsHeight . ' ' . $second_fraction;
                    $border_size_html = $productOptions->fldOptionsAssetsWidth . ' ' . $first_fraction_val .' x ' .$productOptions->fldOptionsAssetsHeight . ' ' .$second_fraction_val;                                       
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

                <tr>
                    <td>
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
                        data-heightfraction="{{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsHeightFraction)}}" onchange="generateNewImageFrame()" value="{{ $productOptions->fldProductOptionsID }}" {{($i == 0)? "checked='checked'" : "b"}} data-addtnl_cost="{{$this_expensive_cost}}" data-frame_cost="{{$frame_cost}}" data-liner="{{$dataliner}}"><span class="uk-display-inline-block photo-size-selection-option-lbl-{{$productOptions->fldProductOptionsID}}" >{!!$border_size_html!!}</span>
                        <span class="checkmark"></span>
                        </label>   
                    </td>
                    <td>
                        <label class="uk-display-block">
                            $<span class="price-start price-start-{{$productOptions->fldProductOptionsID}}">{{$productOptions->fldProductOptionsPrice}}</span>
                        </label>
                    </td>
                </tr>

                <?php 
                    $price_html_temp .= '<label class="uk-width-1-1 uk-display-block">$ <span class="price-start price-start-'.$productOptions->fldProductOptionsID.'">'.$productOptions->fldProductOptionsPrice.'</span></label>';
                    $i++; 
                    $ii++;
                ?>
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

                    <tr>
                        <td>
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
                                    data-sequence="{{$ii}}" data-widthfraction="{{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsWidthFraction)}}" data-heightfraction="{{ \App\Models\ProductOptions::frameFraction($productOptions->fldOptionsAssetsHeightFraction)}}" onchange="generateNewImageFrame()" value="{{ $productOptions->fldProductOptionsID }}" {{($i == 0)? "checked='checked'" : ""}} data-addtnl_cost="{{$this_expensive_cost}}" data-frame_cost="{{$frame_cost}}" data-liner="{{$dataliner}}"><span class="uk-display-inline-block photo-size-selection-option-lbl-{{$productOptions->fldProductOptionsID}}" >{!!$border_size_html!!}</span>
                                    <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>
                            <label class="uk-display-block">
                                $<span class="price-start price-start-{{$productOptions->fldProductOptionsID}}">{{$productOptions->fldProductOptionsPrice}}</span>
                            </label>
                        </td>
                    </tr>

                    <?php 
                        $price_html_temp .= '<label class="uk-width-1-1 uk-display-block">$ <span class="price-start price-start-'.$productOptions->fldProductOptionsID.'">'.$productOptions->fldProductOptionsPrice.'</span></label>';
                        $i++; 
                        $ii++;
                    ?>
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

                    <tr>
                        <td>
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
                                    <span class="checkmark"></span>
                                </label>
                            @endif
                        </td>
                        <td>
                            <label class="uk-display-block">
                                $<span class="price-start price-start-{{$productOptions->fldProductOptionsID}}">{{$productOptions->fldProductOptionsPrice}}</span>
                            </label>
                        </td>
                    </tr>

                    <?php 
                        if($productOptions->fldProductOptionsPricePrint == null || $productOptions->fldProductOptionsPricePrint == ''){                        
                        
                        }
                        else
                        {
                            $price_html_temp .= '<label class="uk-width-1-1 uk-display-block">$ <span class="price-start price-start-'.$productOptions->fldProductOptionsID.'">'.$productOptions->fldProductOptionsPricePrint.'</span></label>';
                        }
                    ?>
                    <?php $i++; $ii++; ?>
                @endif
            @endforeach
            @if($counter_if == 0)
                Not available right now.
                <input type="text" hidden name="counter_if">
              @endif
        @endif
    </tbody>
</table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> -->
<!-- Optional theme -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css"> -->
<!-- Latest compiled and minified JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> -->

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
</script>