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

      if($products->fldProductImage != ""){
        $image_path = __DIR__.'/../../../'.PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/medium/'.$products->fldProductImage;
        list($image_width, $image_height) = getimagesize($image_path);
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

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Sub Title</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                              {!! Form::text('sub_title',$products->fldProductSubTitle,array('size'=>'50','class'=>'required','id'=>'sub_title')) !!}
                              @if($errors->product->first('sub_title'))
                                   <div class="error">{!!$errors->product->first('sub_title')!!}</div>
                              @endif  
                              <br />
                               <span id="sub_title_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                      </div>
                   </div>
                  
                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Weight</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                             {!! Form::text('weight',$products->fldProductWeight,array('size'=>'50','class'=>'required')) !!}
                                 @if($errors->product->first('weight'))
                                     <div class="error">{!!$errors->product->first('weight')!!}</div>
                                 @endif  
                      </div>
                   </div>


                     <div class="uk-grid">
                        <div class="uk-width-large-1-1 uk-width-small-1-1">
                            <ul>
                               <li>Image</li>
                               <li class="boxfields">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            @if($products->fldProductImage != "")
                                                <img src="{{url(PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/medium/'.$products->fldProductImage)}}" width="{{$image_width}}" height="{{$image_height}}" id="uploadedImage">
                                            @endif  
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                          <span class="btn btn-default btn-file">
                                            <span class="fileinput-new">Select image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="image"></span>                     
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
                     </div>
                    @if($products->fldProductImage != "")
                     <div class="uk-grid">
                      <div class="uk-width-large-3-10 uk-width-small-1-1 product-options-section ">
                          
                          <ul id="required_options">
                             <li>Options</li>
                             <li class="boxfields"><div class="required-notification uk-display-block"></div><div id="product_options"></div></li>
                          </ul> 

                           
                      </div> 
                      <div class="uk-width-large-7-10 uk-width-small-1-1 product-options-section ">
                         @foreach($options as $option)
                            <ul id="required_option_assets">
                             <li>Size Options</li>
                             <li class="boxfields"><div class="required-notification uk-display-block"></div><div id="options{!!$option->fldOptionsID!!}" {!! DB::table('tblProductOptions')->where('fldProductOptionsOptionsID','=',$option->fldOptionsID)->where('fldProductOptionsProductID','=',$products->fldProductID)->count()>=1 ? "" : "display:none;" !!}" id="options{!!$option->fldOptionsID!!}></div> 
                                <p style="padding:5px 5px; background:#666; color:#fff"><strong>{!!$option->fldOptionsName!!}</strong></p>
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



                    <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Featured</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          {!! Form::checkbox('isFeatured',1,$products->fldProductIsFeatured == 1 ? true : false, ['class'=>'check-select']) !!}
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
    td.disabled {
        position: relative;
    }
    td.disabled:after {
      content: '';
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      background-color: rgba(255,255,255,0.5);
  }
    
  </style>    
@stop

@section('extracodes')
	<script>
		var mypath = "{!! url('/') !!}";
		var category_id = "{!! $maincat->fldCategoryMainID !!}";
		var product_id = "{!! $products->fldProductID !!}";
	</script>
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
    {!! Html::script('_admin/assets/js/customValidation.js','') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods5.js','') !!}
    {!! Html::script('_admin/assets/js/count_char.js','') !!}
    {!! Html::script('_admin/assets/js/category.js','') !!}   
    {!! Html::script('_admin/plugins/jasny/js/jasny-bootstrap.min.js','') !!} 	      
    
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
    @if(Input::get('is_new') != null)
     <script >
      $(document).ready(function(){
       UIkit.Utils.scrollToElement(UIkit.$('#required_options')); 
      });
     </script>
    @endif  
    
@stop