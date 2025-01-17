@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class="col2">

          <a href="{!!url('dnradmin/products/view/'.$maincat->fldCategoryID)!!}"> {{ PRODUCT_MANAGEMENT }}</a> &raquo; Update {{ PRODUCT_MANAGEMENT }}

          </div>
    </div>



  {!! Form::open(array('url' => '/dnradmin/products/edit/'.$products->fldProductID, 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')); !!}
   @if(Session::has('success'))
           <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
    @endif
     @if(Session::has('error'))
           <div class="uk-alert uk-alert-danger">{!!Session::get('error')!!}</div>
    @endif
     @if($errors->product->first('image') && $errors->product->first('image')=="validation.img_min_size")
      <div class="uk-alert uk-alert-danger">{!!IMAGES_DIMENSION_ERROR!!}</div>
    @endif
    @if(Session::has('upload_error'))
           <div class="uk-alert uk-alert-danger"><strong>Alert:</strong> The following image does not fit the proper file dimensions and could not be uploaded, please check the image requirements again. <br><br> {!!Session::get('upload_error')!!}</div>
    @endif

    <?php
    $image_width = $image_height = 0; $image_path = '';
    $c_size_class = 'horizontal';
    if($products->fldProductImage != ""){
      $image_path = __DIR__.'/../../../'.PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/medium/'.$products->fldProductImage;
      if (file_exists($image_path)) {
          list($image_width, $image_height) = getimagesize($image_path);
      }
    }
    if($image_width < $image_height){
      $c_size_class = 'vertical';
    }
    ?>

    <div class="uk-grid">
        <div class="uk-width-large-7-10 uk-width-small-1-1">
            <ul>
               <li>Product Information</li>
               <li class="boxfields">
                     <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Product Name</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                              {!! Form::text('name',$products->fldProductName,array('size'=>'50','class'=>'required','id'=>'name')) !!}
                              @if($errors->product->first('name'))
                                   <div class="error">{!!$errors->product->first('name')!!}</div>
                              @endif
                              <br />
                               <span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                      </div>
                   </div>

                   <div class="uk-grid uk-hidden">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Sub Title</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                              {!! Form::text('sub_title',$products->fldProductSubTitle,array('size'=>'50','id'=>'sub_title')) !!}
                              @if($errors->product->first('sub_title'))
                                   <div class="error">{!!$errors->product->first('sub_title')!!}</div>
                              @endif
                              <br />
                               <span id="sub_title_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                      </div>
                   </div>
                   <!-- <div class="uk-grid">
                        <div class="uk-width-large-1-10 uk-width-small-1-1">Price $</div>
                        <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                            {!!Form::text('price',$products->fldProductPrice,array('size'=>'50','class'=>'required')) !!}
                            @if($errors->product->first('price'))
                                <div class="error">{!!$errors->product->first('price')!!}</div>
                            @endif
                        </div>
                    </div> -->
                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Weight</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                             {!! Form::text('weight',$products->fldProductWeight,array('size'=>'50','class'=>'')) !!}
                                 @if($errors->product->first('weight'))
                                     <div class="error">{!!$errors->product->first('weight')!!}</div>
                                 @endif
                      </div>
                   </div>

                    <div class="uk-grid">
                      <div class="uk-width-large-2-10 uk-width-small-1-1">Featured - Home Page</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          {!! Form::checkbox('isFeatured',1,$products->fldProductIsFeatured == 1 ? true : false, ['class'=>'check-select']) !!}
                      </div>
                   </div>
                   <div class="uk-width-large-1-2 uk-width-small-1-1  uk-padding-remove" id="FeaturedHomePageImage" style="display: none;">
                            <ul>
                                <li>Featured - Home Page Image</li>
                                <li class="boxfields">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                            style="width: 200px; height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Select
                                                    image</span>
                                                <span class="fileinput-exists">Change</span><input type="file"
                                                    name="isFeaturedImage" required="required"
                                                    onchange="image_changed()"></span>
                                            <a href="#" class="btn btn-default fileinput-exists"
                                                data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                    <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB
                                    &bull; <strong>Min Dimension</strong>: <span
                                        id="dimension">{{ PRODUCT_IMAGE_WIDTH }}px x {{ PRODUCT_IMAGE_HEIGHT }}px</span>
                                    @if($errors->product->first('image'))
                                        <div class="error">{!!$errors->product->first('image')!!}</div>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    <div class="uk-grid">
                      <div class="uk-width-large-2-10 uk-width-small-1-1">On Featured Images Page</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          {!! Form::checkbox('isOnFeatured',1,$products->fldProductFeaturedPage != 0 ? true : false, ['class'=>'check-select']) !!}
                          <!--  {!! Form::checkbox('isOnFeatured',1,$products->fldProductFeaturedPage == 1 ? true : false, ['class'=>'check-select']) !!}-->
                      </div>
                   </div>

                     <div class="uk-grid">
                        <div class="uk-width-large-1-2 uk-width-small-1-1 uk-padding-remove">
                            <ul>
                               <li>Image</li>
                               <li class="boxfields">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            @if($products->fldProductImage != "")
                                                <img src="{{url(PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/medium/'.$products->fldProductImage)}}" id="uploadedImage" class="{{$c_size_class}}">
                                            @endif
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                          <span class="btn btn-default btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="image" onchange="image_changed()"></span>
                                        </div>
                                      </div>

                                    <br>
                                    <strong>Formats</strong>: png, gif, jpg &bull;
                                    <strong>Max Size</strong>: 2MB &bull;
                                    <strong>Recommended Min Dimension</strong>: <span id="dimension">{{ PRODUCT_IMAGE_WIDTH }}px x {{ PRODUCT_IMAGE_HEIGHT }}px</span>

                                      @if($errors->product->first('image') && $errors->product->first('image')!="validation.img_min_size")
                                          <div class="error">{!!$errors->product->first('image')!!}</div>
                                      @endif
                               </li>
                            </ul>
                        </div>
                        <div class="uk-width-large-1-2 uk-width-small-1-1">

                          @if($products->fldProductImage != "")
                           <div class="uk-grid option-section-wrapper option-{{$c_size_class}}">
                            <div class="uk-width-small-1-1 product-options-section ">

                                <ul id="required_options">
                                   <li>Options</li>
                                   <li class="boxfields"><div class="required-notification uk-display-block"></div><div id="product_options"></div></li>
                                </ul>


                            </div>
                            <div class="uk-width-small-1-1 product-options-section ">
                               @foreach($options as $option)
                                  <ul id="required_option_assets">
                                   <li>Size Options &nbsp; &nbsp; &nbsp; <small>WIDTH x HEIGHT</small></li>
                                   <li class="boxfields">
                                      <div class="required-notification uk-display-block"></div>
                                      <div id="options{!!$option->fldOptionsID!!}"
                                        {!! DB::table('tblProductOptions')->where('fldProductOptionsOptionsID','=',$option->fldOptionsID)->where('fldProductOptionsProductID','=',$products->fldProductID)->count()>=1 ? "" : "display:none;" !!}" id="options{!!$option->fldOptionsID!!}
                                      ></div>
                                      <p style="padding:5px 5px; background:#666; color:#fff">
                                           {{--  <strong>{!!$option->fldOptionsName!!}</strong>  --}}
                                        </p>
                                      <span id="product_options_assets{!!$option->fldOptionsID!!}"></span>
                                   </li>
                                  </ul>
                                  @endforeach

                            </div>
                           </div>
                          @else
                            <div class="uk-width-large-3-10 uk-width-small-1-1 product-options uk-hidden">
                                <ul id="required_category">
                                   <li>Please Upload image to set size</li>
                                </ul>
                            </div>
                          @endif
                        </div>

                     </div>


                    <div class="uk-grid">
                        <div class="uk-width-large-1-1 uk-width-small-1-1">
                            <ul>
                               <li>Description</li>
                               <li class="boxfields">
                                   {!! Form::textarea('description',$products->fldProductDescription,array('id'=>'mods2')) !!}
                                   @if($errors->product->first('description'))
                                           <div class="error">{!!$errors->product->first('description')!!}</div>
                                   @endif
                               </li>
                            </ul>
                        </div>
                     </div>


               </li>
            </ul>
        </div>

        <div class="uk-width-large-3-10 uk-width-small-1-1">
        <ul id="required_category">
               <li>Categories</li>
               <li class="boxfields"><div class="required-notification uk-display-block"></div><div id="category"></div> </li>
            </ul>
        <!-- <ul id="required_category">
               <li>Categories</li>
               <li class="boxfields"><div class="required-notification uk-display-block"></div>
               <select name="category" id="category" required>
                    <option value="0">Select Category</option>
                    @foreach($category as $category_item)
                    <option value="{{$category_item->fldCategoryID}}" <?php if ($cat->fldProductCategoryCategoryID == $category_item->fldCategoryID) echo "selected='selected'";?>>{{$category_item->fldCategoryName;}}</option>
                    @endforeach
               </select>
           </li>
            </ul> -->
            <!-- <input type='hidden'  value='{{$category_id}}' name="category"/> -->

{{--             <ul id="prints_container">
                <li>Prints</li>
                <li class="boxfields">

                    <div class="print_list_container">
                        <table id="page_manager" class="uk-table">
                            <tbody>
                            @foreach(App\Models\Prints::get() as $print)
                                <tr>
                                    <td style="text-indent: 2px !important;width:100px">{{$print->name}}</td>
                                    <td style="text-indent: 2px !important;width:100px">${{$print->price}}</td>
                                    <td style="text-indent: 2px !important;width:25px" class="edit_print">
                                        <a href="javascript:void(0)" data-print_name="{{$print->name}}" data-print_price="{{$print->price}}" data-print_id="{{$print->id}}">
                                            <img src="{{url('_admin/assets/images/icons/page_modify.png')}}">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="print_container" style="display: none;">
                        <form method="POST" action="{{url('/dnradmin/edit_print')}}" accept-charset="UTF-8" id="form_print" style="clear: both;border: 1px solid #eee;background: #fff;position: relative;top: 10px;margin-bottom: 50px;padding: 40px 30px;">
                            <table border="0">
                                <tbody>
                                <tr>
                                    <td style="padding:5px 5px;">
                                        Name:&nbsp;
                                        <input type="text" name="print_name" style="width:150px;" id="print_name">
                                        <input type="hidden" name="print_id" style="width:150px;" id="print_id">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:5px 5px;">
                                        Price:&nbsp;
                                        <input type="text" name="print_price" style="width:150px;" id="print_price">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:5px 5px">
                                        <button type="button" class="uk-button uk-button-success update_print">Update Print</button>
                                        <button type="button" class="uk-button uk-button-dark cancel_print">Cancel</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </li>
            </ul> --}}

            <div class=clear><!-- Clear Section --></div>
            <ul>
               <li>Shipping Cost</li>
               <li class="boxfields">Shipping Cost 1:
                <input type="text" name="shipping_cost1" value="{{number_format($products->shipping_proc_fee1,2)}}"> <br> &nbsp;
               </li>
               <li class="boxfields">Shipping Cost 2:
                <input type="text" name="shipping_cost2" value="{{number_format($products->shipping_proc_fee2,2)}}"> <br> &nbsp;
               </li>
               <li class="boxfields">Shipping Cost 3:
                <input type="text" name="shipping_cost3" value="{{number_format($products->shipping_proc_fee3,2)}}"> <br> &nbsp;
               </li>
               <li class="boxfields">Shipping Cost 4:
                <input type="text" name="shipping_cost4" value="{{number_format($products->shipping_proc_fee4,2)}}"> <br> &nbsp;
               </li>
               <li class="boxfields">Shipping Cost 5:
                <input type="text" name="shipping_cost5" value="{{number_format($products->shipping_proc_fee5,2)}}"> <br> &nbsp;
               </li>
               <li class="boxfields">Shipping Cost 6:
                <input type="text" name="shipping_cost6" value="{{number_format($products->shipping_proc_fee6,2)}}"> <br> &nbsp;
               </li>
               <li class="boxfields">Shipping Cost 7:
                <input type="text" name="shipping_cost7" value="{{number_format($products->shipping_proc_fee7,2)}}"> <br> &nbsp;
               </li>
               <li class="boxfields">Shipping Cost 8:
                <input type="text" name="shipping_cost8" value="{{number_format($products->shipping_proc_fee8,2)}}"> <br> &nbsp;
               </li>
            </ul>

            <ul style="display:none;">
               <li>Shipping Cost Global</li>
                <?php
                $shippingFee = \App\Models\ShippingFee::all();
                // print_r($shippingFee);
                foreach ($shippingFee as $shipfee) {
                    ?>
                   <li class="boxfields">Shipping Cost {{$shipfee->fldShippingSequence}}:
                    <input type="text" name="shipfee{{$shipfee->fldShippingSequence}}" value="{{number_format($shipfee->fldShippingFee,2)}}"> <br> &nbsp;
                   </li>
                    <?php
                    // echo $shipfee->fldShippingFee;
                }
                ?>
            </ul>

            <div class=clear><!-- Clear Section --></div>
            <ul>
               <li>Low End Frame - Graphik Cost</li>

                @if(count($defaultcosts) > 0)

                    <?php $i = 1; ?>
                    @foreach ($defaultcosts as $cost)
                    
                       <li class="boxfields">
                            Frame Size {{$i}}: <input type="text" name="framelow_{{$i}}" value="{{number_format($cost['framelow_cost'],2)}}"> <br> &nbsp;
                       </li>
                       <?php $i++; ?>
                    @endforeach
                @else

                   <li class="boxfields">
                        Frame Size 1: <input type="text" name="framelow_1" value="{{old('framelow_1')}}"> <br> &nbsp;
                   </li>
                   <li class="boxfields">
                        Frame Size 2: <input type="text" name="framelow_2" value="{{old('framelow_2')}}"> <br> &nbsp;
                   </li>
                   <li class="boxfields">
                        Frame Size 3: <input type="text" name="framelow_3" value="{{old('framelow_3')}}"> <br> &nbsp;
                   </li>
                   <li class="boxfields">
                        Frame Size 4: <input type="text" name="framelow_4" value="{{old('framelow_4')}}"> <br> &nbsp;
                   </li>
                   <li class="boxfields">
                        Frame Size 5: <input type="text" name="framelow_5" value="{{old('framelow_5')}}"> <br> &nbsp;
                   </li>
                   <li class="boxfields">
                        Frame Size 6: <input type="text" name="framelow_6" value="{{old('framelow_6')}}"> <br> &nbsp;
                   </li>
                   <li class="boxfields">
                        Frame Size 7: <input type="text" name="framelow_7" value="{{old('framelow_7')}}"> <br> &nbsp;
                   </li>
                   <li class="boxfields">
                        Frame Size 8: <input type="text" name="framelow_8" value="{{old('framelow_8')}}"> <br> &nbsp;
                   </li>

                @endif

            </ul>
          
            <?php /*
            <div class=clear><!-- Clear Section --></div>
            <ul>
               <li>High End Frame - Graphik Cost</li>

                @if(count($defaultcosts) > 0)

                   <?php $i = 1; ?>
                   @foreach ($defaultcosts as $cost)
                       <li class="boxfields">
                            Frame Size {{$i}}: <input type="text" name="framehigh_{{$i}}" value="{{number_format($cost->framehigh_cost,2)}}" readonly> <br> &nbsp;
                       </li>
                   <?php $i++; ?>
                   @endforeach

                @else

                   <li class="boxfields">
                        Frame Size 1: <input type="text" name="framehigh_1" value="{{old('framehigh_1')}}" readonly> <br> &nbsp;
                   </li>
                   <li class="boxfields">
                        Frame Size 2: <input type="text" name="framehigh_2" value="{{old('framehigh_2')}}" readonly> <br> &nbsp;
                   </li>
                   <li class="boxfields">
                        Frame Size 3: <input type="text" name="framehigh_3" value="{{old('framehigh_3')}}" readonly> <br> &nbsp;
                   </li>
                   <li class="boxfields">
                        Frame Size 4: <input type="text" name="framehigh_4" value="{{old('framehigh_4')}}" readonly> <br> &nbsp;
                   </li>
                   <li class="boxfields">
                        Frame Size 5: <input type="text" name="framehigh_5" value="{{old('framehigh_5')}}" readonly> <br> &nbsp;
                   </li>
                   <li class="boxfields">
                        Frame Size 6: <input type="text" name="framehigh_6" value="{{old('framehigh_6')}}" readonly> <br> &nbsp;
                   </li>
                   <li class="boxfields">
                        Frame Size 7: <input type="text" name="framehigh_7" value="{{old('framehigh_7')}}" readonly> <br> &nbsp;
                   </li>
                   <li class="boxfields">
                        Frame Size 8: <input type="text" name="framehigh_8" value="{{old('framehigh_8')}}" readonly> <br> &nbsp;
                   </li>
                @endif
            </ul>
            */ ?>

        </div>

    </div>

   <div class=clear><!-- Clear Section --></div>
    @if(isset($category_id))
      {!! Form::hidden('category_id', $category_id)!!}
    @endif
    {!! Form::button('Save Record',array('name'=>'saveinfo','class'=>'uk-button uk-button-success','id'=> "saveinfo_product"))!!}
    {!! Form::close() !!}
  </article>

@stop
@section('headercodes')
  {!! Html::style('_admin/plugins/jasny/css/jasny-bootstrap.min.css') !!}
  <style type="text/css">
  </style>
@stop

@section('extracodes')

	<script>
		var mypath = "{!! url('/') !!}";
		var category_id = "{!! $category_id !!}";
        console.log(category_id);
		var product_id = "{!! $products->fldProductID !!}";
	</script>
   

    {!! Html::script('_admin/manager/tinymce/tiny_mce.js') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}
    {!! Html::script('_admin/assets/js/customValidation.js') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods5.js') !!}
    {!! Html::script('_admin/assets/js/count_char.js') !!}
    {!! Html::script('_admin/assets/js/category.js') !!}
    {!! Html::script('_admin/plugins/jasny/js/jasny-bootstrap.min.js') !!}
   
    @foreach($options as $option)
				{!! $countOptions = DB::table('tblProductOptions')->where('fldProductOptionsOptionsID','=',$option->fldOptionsID)->where('fldProductOptionsProductID','=',$products->fldProductID)->count();!!}
				@if($countOptions >=1)
          <script>
						displayOptionsAssets({!! $option->fldOptionsID !!},true,product_id);
					</script>
				@endif
	@endforeach

		<script language="javascript">

			$('#subcategory').load(mypath+'/dnradmin/sub-category/{!! $maincat->fldCategoryMainID !!}/{!! $products->fldProductID !!}');

			var elem1 = $("#name_text");
                        var elem2 = $("#sub_title_text");
			$("#name").limiter(50, elem1);
			$("#sub_title").limiter(50, elem2);

		</script>
    @if(Input::get('new') != null)
     <script >
      $(document).ready(function(){
       UIkit.Utils.scrollToElement(UIkit.$('#required_options'));
      });
     </script>
    @endif

    <script>
        $(document).ready(function() {
            $(".edit_print a").click(function(evt) {
                evt.preventDefault();

                var name = $(this).data('print_name');
                var price = $(this).data('print_price');
                var id = $(this).data('print_id');

                $('#print_name').val(name);
                $('#print_price').val(price);
                $('#print_id').val(id);

                $('.print_container').show();
                $('.print_list_container').hide();
            });

            $(".cancel_print").on('click',function(){
                $('.print_container').hide();
                $('.print_list_container').show();
            });

            $('.update_print').on('click',function(){

                $.ajax({
                    type: 'POST',
                    url: 'http://54.68.88.28/clarkin123/dnradmin/edit_print',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        name:  $('#print_name').val(),
                        price: $('#print_price').val(),
                        id: $('#print_id').val()
                    },
                    success: function () {
                        location.reload();
                    }
                });

            });

        });
        $(document).ready(function() {
            // Listen for change event on the checkbox
            $('.check-select').on('change', function() {
                console.log('here',$(this).is(':checked'));
                if ($(this).is(':checked')) {
                    // Show the div when checkbox is checked
                    $('#FeaturedHomePageImage').show();
                } else {
                    // Hide the div when checkbox is unchecked
                    $('#FeaturedHomePageImage').hide();
                }
            });
        });
    </script>

@stop
