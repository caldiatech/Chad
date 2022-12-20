@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control class=col1>
    	<div class="col2">
        	{!! Html::link('/dnradmin/category',PRODUCT_MANAGEMENT) !!} &raquo; Add new {{ PRODUCT_MANAGEMENT }}   
        </div>
          
    </div>
    
   
    
   {!! Form::open(array('url' => '/dnradmin/products/new', 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')); !!}
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

    
    <div class="uk-grid">
        <div class="uk-width-large-7-10 uk-width-small-1-1  product-settings-section" id="product-settings-section">
            <ul>
               <li>Product Information</li>
               <li class="boxfields">
                  <div class="required-notification uk-display-block"></div>
                   <div class="uk-grid">
                      <div class="uk-width-large-2-10 uk-width-small-1-1">Product Name</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                              {!! Form::text('name','',array('size'=>'50','class'=>'required','id'=>'name','required')) !!}
                              @if($errors->product->first('name'))
                                   <div class="error">{!!$errors->product->first('name')!!}</div>
                              @endif  
                              <br />
                               <span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                      </div>
                   </div>

                   <div class="uk-grid uk-hidden">
                      <div class="uk-width-large-2-10 uk-width-small-1-1">Sub Title</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                            {!! Form::text('sub_title','',array('size'=>'50','class'=>'','id'=>'sub_title')) !!}
                              @if($errors->product->first('sub_title'))
                                   <div class="error">{!!$errors->product->first('sub_title')!!}</div>
                              @endif  
                              <br />
                               <span id="sub_title_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-2-10 uk-width-small-1-1">Weight</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                           {!! Form::text('weight','',array('size'=>'50','class'=>'')) !!}
                            @if($errors->product->first('weight'))
                               <div class="error">{!!$errors->product->first('weight')!!}</div>
                            @endif
                      </div>
                   </div>

                    <div class="uk-grid">
                      <div class="uk-width-large-2-10 uk-width-small-1-1">Featured - Home Page</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                           {!! Form::checkbox('isFeatured',1, false, ['class' => 'check-select']) !!}
                      </div>
                   </div>

                    <div class="uk-grid">
                      <div class="uk-width-large-2-10 uk-width-small-1-1">On Featured Images Page</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                           {!! Form::checkbox('isOnFeatured',1, false, ['class' => 'check-select']) !!}
                      </div>
                   </div>



                    <div class="uk-grid">
                        <div class="uk-width-large-1-2 uk-width-small-1-1  uk-padding-remove">
                            <ul>
                               <li>Image</li>
                               <li class="boxfields">
                                   <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                                <div>
                                                  <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                                                  <span class="fileinput-exists">Change</span><input type="file" class="required" name="image" required="required" onchange="image_changed()"></span>
                                                  <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </div>
                                              </div>
                                             <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Min Dimension</strong>: <span id="dimension">{{ PRODUCT_IMAGE_WIDTH }}px x {{ PRODUCT_IMAGE_HEIGHT }}px</span>
                                             @if($errors->product->first('image') && $errors->product->first('image')!="validation.img_min_size")
                                                <div class="error">{!!$errors->product->first('image')!!}</div>
                                             @endif
                               </li>
                            </ul>
                        </div>
                        <div class="uk-width-large-1-2 uk-width-small-1-1">
                          <div class="uk-grid option-section-wrapper uk-hidden">
                            <div class="uk-width-small-1-1 product-options-section ">                          
                                <ul id="required_options">
                                   <li>Options</li>
                                   <li class="boxfields"><div class="required-notification uk-display-block"></div><div id="product_options"></div></li>
                                </ul> 
                            </div> 
                            <div class="uk-width-small-1-1 product-options-section ">
                               @foreach($options as $option)
                                  <ul id="required_option_assets">
                                   <li>Size Options</li>
                                   <li class="boxfields">
                                    <div class="required-notification uk-display-block"></div>
                                    <div id="options{!!$option->fldOptionsID!!}" {!! DB::table('tblProductOptions')->where('fldProductOptionsOptionsID','=',$option->fldOptionsID)->count()>=1 ? "" : "display:none;" !!}" id="options{!!$option->fldOptionsID!!}></div> 
                                      <p style="padding:5px 5px; background:#666; color:#fff"><strong>{!!$option->fldOptionsName!!}</strong></p>
                                      <span id="product_options_assets{!!$option->fldOptionsID!!}"></span>
                                   </li>
                                  </ul>   
                                  @endforeach
                               
                            </div>
                          </div>
                        </div>

                   <div class="uk-grid  uk-hidden">
                        <div class="uk-width-large-1-1 uk-width-small-1-1">
                            <ul>
                               <li>Description</li>
                               <li class="boxfields">
                                   {!! Form::textarea('description','',array('id'=>'mods2')) !!}
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
           
            <?php /* 
            <div class=clear><!-- Clear Section --></div>   

            <ul>
               <li>Shipping Cost</li>
               <li class="boxfields">
                    Shipping Cost 1: <input type="text" name="shipping_cost1" value="110.00"> <br> &nbsp;
               </li>
               <li class="boxfields">
                    Shipping Cost 2: <input type="text" name="shipping_cost2" value="120.00"> <br> &nbsp;
               </li>
               <li class="boxfields">
                    Shipping Cost 3: <input type="text" name="shipping_cost3" value="305.00"> <br> &nbsp;
               </li>
               <li class="boxfields">
                    Shipping Cost 4: <input type="text" name="shipping_cost4" value="320.00"> <br> &nbsp;
               </li>
               <li class="boxfields">
                    Shipping Cost 5: <input type="text" name="shipping_cost5" value=""> <br> &nbsp;
               </li>
               <li class="boxfields">
                    Shipping Cost 6: <input type="text" name="shipping_cost6" value=""> <br> &nbsp;
               </li>
               <li class="boxfields">
                    Shipping Cost 7: <input type="text" name="shipping_cost7" value=""> <br> &nbsp;
               </li>
               <li class="boxfields">
                    Shipping Cost 8: <input type="text" name="shipping_cost8" value=""> <br> &nbsp;
               </li>
            </ul> */ ?>


            <div class=clear><!-- Clear Section --></div>   
            <ul>
               <li>Low End Frame - Graphik Cost</li>
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
            </ul>

            <?php /*
            <div class=clear><!-- Clear Section --></div>   
            <ul>
               <li>High End Frame - Graphik Cost</li>
               <li class="boxfields">
                    Frame Size 1: <input type="text" name="framehigh_1" value="{{old('framehigh_1')}}"> <br> &nbsp;
               </li>
               <li class="boxfields">
                    Frame Size 2: <input type="text" name="framehigh_2" value="{{old('framehigh_2')}}"> <br> &nbsp;
               </li>
               <li class="boxfields">
                    Frame Size 3: <input type="text" name="framehigh_3" value="{{old('framehigh_3')}}"> <br> &nbsp;
               </li>
               <li class="boxfields">
                    Frame Size 4: <input type="text" name="framehigh_4" value="{{old('framehigh_4')}}"> <br> &nbsp;
               </li>
               <li class="boxfields">
                    Frame Size 5: <input type="text" name="framehigh_5" value="{{old('framehigh_5')}}"> <br> &nbsp;
               </li>
               <li class="boxfields">
                    Frame Size 6: <input type="text" name="framehigh_6" value="{{old('framehigh_6')}}"> <br> &nbsp;
               </li>
               <li class="boxfields">
                    Frame Size 7: <input type="text" name="framehigh_7" value="{{old('framehigh_7')}}"> <br> &nbsp;
               </li>
               <li class="boxfields">
                    Frame Size 8: <input type="text" name="framehigh_8" value="{{old('framehigh_8')}}"> <br> &nbsp;
               </li>
            </ul>
            */ ?>

        </div> 

    </div>            

     
      
      <div class=clear><!-- Clear Section --></div>   
                        @if(isset($category_id)) 
                          {!! Form::hidden('category_id', $category_id)!!}
                        @endif  
       {!! Form::button('Save Record',array('name'=>'saveinfo','class'=>'uk-button uk-button-success', 'id'=>'saveinfo_product'))!!} &nbsp; {!! Form::reset('Reset',array('name'=>'reset','class'=>'uk-button uk-button-danger'))!!}         
    {!! Form::close() !!}
      
  
  </article>
  

@stop

@section('headercodes')    
  {!! Html::style('_admin/plugins/jasny/css/jasny-bootstrap.min.css') !!}      
  
@stop

@section('extracodes')
	<script>
		var category_id = "0";
		var mypath = "{!! url('/') !!}";
		var product_id = "0";
	</script>
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}
    {!! Html::script('_admin/assets/js/customValidation.js') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods5.js') !!}
    {!! Html::script('_admin/assets/js/count_char.js') !!}
	  {!! Html::script('_admin/assets/js/category.js') !!} 	  

    {!! Html::script('_admin/plugins/jasny/js/jasny-bootstrap.min.js') !!}    
		<script language="javascript">				    						
			var elem1 = $("#name_text");
      var elem2 = $("#sub_title_text");
			$("#name").limiter(50, elem1);
                        $("#sub_title").limiter(50, elem2);
		</script>     
    
@stop