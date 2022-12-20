@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control class=col1>
    	<div class="col1">
        	{!! Html::link('/dnradmin/category',' Category') !!} &raquo; Add new product   
        </div>
          
    </div>
    
   
    
   {!! Form::open(array('url' => '/dnradmin/products/new', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
    @if(Session::has('success')) 
           <div class="success">{!!Session::get('success')!!}</div>
    @endif
    @if(Session::has('error')) 
           <div class="error_text">{!!Session::get('error')!!}</div>
    @endif
    @if($errors->product->first('image') && $errors->product->first('image')=="validation.img_min_size")
      <div class="error_text">{!!IMAGES_DIMENSION_ERROR!!}</div>
    @endif
    @if(Session::has('upload_error')) 
           <div class="error_text"><strong>Alert:</strong> The following image does not fit the proper file dimensions and could not be uploaded, please check the image requirements again. <br><br> {!!Session::get('upload_error')!!}</div>
    @endif
   
      <table border="0" width="1000px;" style="margin-bottom:10px; padding:10px 10px">
      	 <tr>
         	<td style="width:725px; margin-right:10px;" valign="top">
            	
        			<ul style="width:725px;">
                        <li style="width:705px;">Product Information</li>
                        
                        <li class=boxfields style="width:705px;">
                          <dl style="width:705px;">
                            <dt style="width:100px;">Product Name</dt>
                            <dd style="width:525px;">{!! Form::text('name','',array('size'=>'50','class'=>'required','id'=>'name')) !!}
                              @if($errors->product->first('name'))
                                   <div class="error">{!!$errors->product->first('name')!!}</div>
                              @endif  
                            	<br />
				            	<span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                            </dd>
                          </dl>   
                          <dl style="width:705px;">
                            <dt style="width:100px;">Sub Title</dt>
                            <dd style="width:525px;">{!! Form::text('sub_title','',array('size'=>'50','class'=>'required','id'=>'sub_title')) !!}
                              @if($errors->product->first('sub_title'))
                                   <div class="error">{!!$errors->product->first('sub_title')!!}</div>
                              @endif  
                              <br />
                               <span id="sub_title_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                            </dd>
                          </dl>
                           <dl style="width:725px;">
                            <dt style="width:100px;">Old Price $</dt>
                            <dd style="width:525px;">{!! Form::text('old_price','',array('size'=>'50')) !!}
                                @if($errors->product->first('old_price'))
                                   <div class="error">{!!$errors->product->first('old_price')!!}</div>
                                @endif 
                            </dd>
                          </dl>  
                           <dl style="width:725px;">
                            <dt style="width:100px;">Price $</dt>
                            <dd style="width:525px;">{!! Form::text('price','',array('size'=>'50','class'=>'required')) !!}
                                 @if($errors->product->first('price'))
                                   <div class="error">{!!$errors->product->first('price')!!}</div>
                                @endif 
                            </dd>                
                          </dl>  
                             <dl style="width:725px;">
                            <dt style="width:100px;">Weight</dt>
                            <dd style="width:525px;">{!! Form::text('weight','',array('size'=>'50','class'=>'required')) !!}
                                 @if($errors->product->first('weight'))
                                   <div class="error">{!!$errors->product->first('weight')!!}</div>
                                @endif
                            </dd>
                          </dl>  
                          <dl style="width:725px;">
                            <dt style="width:100px;">Featured</dt>
                            <dd style="width:525px;"> {!! Form::checkbox('isFeatured',1) !!}</dd>
                          </dl>                  
        				</li>        
     				 </ul>
            
                      <ul style="width:725px;">
                        <li style="width:705px;">Description</li>
                        <li class=boxfields style="width:705px;">
                            {!! Form::textarea('description','',array('id'=>'mods2')) !!}
                               @if($errors->product->first('description'))
                                   <div class="error">{!!$errors->product->first('description')!!}</div>
                                @endif
                        </li>
                      </ul>
      
                      <ul style="width:725px;">
                        <li style="width:705px;">Image</li>
                        <li class=boxfields style="width:705px;">
                                                    

                          <dl>
                            <dt></dt>
                            <dd>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                <div>
                                  <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                                  <span class="fileinput-exists">Change</span><input type="file" name="image"></span>
                                  <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                              </div>
                             <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Min Dimension</strong>: <span id="dimension">{{ PRODUCT_IMAGE_WIDTH }}px x {{ PRODUCT_IMAGE_HEIGHT }}px</span>
                             @if($errors->product->first('image') && $errors->product->first('image')!="validation.img_min_size")
                                <div class="error">{!!$errors->product->first('image')!!}</div>
                             @endif
                           </dd>
                          </dl>
                                    
                          
                        </li>
                      </ul>
      
                      <ul style="width:725px;">
                        <li style="width:705px;">Multiple Images</li>
                        <li class=boxfields style="width:705px;">
                          
                          <dl>                           
                            	<dd>{!! Form::file('images[]',array('multiple')) !!}
                                <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Min Dimension</strong>: <span id="dimension">{{ PRODUCT_IMAGE_WIDTH }}px x {{ PRODUCT_IMAGE_HEIGHT }}px</span>
                            </dd>
                          </dl>
                                    
                          
                        </li>
                      </ul>

                      <div class=clear><!-- Clear Section --></div>   
                        @if(isset($category_id)) 
                          {!! Form::hidden('category_id', $category_id)!!}
                        @endif  
                        {!! Form::submit('',array('name'=>'saveinfo'))!!} &nbsp; {!! Form::reset('',array('name'=>'reset'))!!} 
                
            </td>
           <td style="width:265px; vertical-align:top">
            		                   
                   <div style="background:#fff; border:#ccc 1px solid; width:245px; min-height:200px; margin-bottom:10px;">
                    	<p style="padding:5px 5px; background:#666; color:#fff"><strong>Category</strong></p>
                        	<span id="category"></span>
			        </div>   
                   
                  
                   
                    <div style="background:#fff; border:#ccc 1px solid; width:245px; min-height:200px; margin-bottom:10px;">
                    	<p style="padding:5px 5px; background:#666; color:#fff"><strong>Options</strong></p>
                        	<span id="product_options"></span>
			        </div> 
                    @foreach($options as $option)
                    <div style="background:#fff; border:#ccc 1px solid; width:245px; min-height:200px; margin-bottom:10px; display:none;" id="options{!!$option->fldOptionsID!!}">
                    	<p style="padding:5px 5px; background:#666; color:#fff"><strong>{!!$option->fldOptionsName!!}</strong></p>
                        	<span id="product_options_assets{!!$option->fldOptionsID!!}"></span>
			        </div> 
                    @endforeach
                    
                   
           </td>
		 </tr>
      </table>   
      
        
    {!! Form::close() !!}
    
  </article>
  

@stop

@section('headercodes')    
  {!! Html::style('_admin/assets/css/pagination.css') !!}
  {!! Html::style('_admin/plugins/jasny/css/jasny-bootstrap.min.css') !!}      
@stop

@section('extracodes')
	<script>
		var category_id = "0";
		var mypath = "{!! url('/') !!}";
		var product_id = "0";
	</script>
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js') !!}
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