@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class=col1>
          {{ HTML::image_link('/dnradmin/products/view/'.$maincat->id,'Products') }} &raquo; Update Products
          </div>
    </div>
    

    
    {{ Form::open(array('url' => '/dnradmin/products/edit/'.$products->id, 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
    @if($success == 1) 
           <div class="success">Record successfully saved</div>
    @endif	
   @if($error == 1) 
    	<div class="error">Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!</div>
    @endif
      <table border="0" width="1000px;" style="margin-bottom:10px; padding:10px 10px">
      	 <tr>
         	<td style="width:725px; margin-right:10px;">
            	
        			<ul style="width:725px;">
                        <li style="width:705px;">Product Information</li>
                        
                        <li class=boxfields style="width:705px;">
                          <dl style="width:705px;">
                            <dt style="width:100px;">Product Name</dt>
                            <dd style="width:525px;">{{ Form::text('name',$products->name,array('size'=>'50','class'=>'required','id'=>'name')) }}
                            	<br />
				            	<span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                            </dd>
                          </dl>   
                           <dl style="width:725px;">
                            <dt style="width:100px;">Old Price $</dt>
                            <dd style="width:525px;">{{ Form::text('old_price',$products->old_price,array('size'=>'50')) }}</dd>
                          </dl>  
                           <dl style="width:725px;">
                            <dt style="width:100px;">Price $</dt>
                            <dd style="width:525px;">{{ Form::text('price',$products->price,array('size'=>'50','class'=>'required')) }}</dd>                
                          </dl>  
                             <dl style="width:725px;">
                            <dt style="width:100px;">Weight</dt>
                            <dd style="width:525px;">{{ Form::text('weight',$products->weight,array('size'=>'50','class'=>'required')) }}</dd>
                          </dl>  
                          
                          <dl style="width:725px;">
                            <dt style="width:100px;">Featured</dt>
                            <dd style="width:525px;">{{ Form::checkbox('isFeatured',1,$products->isFeatured == 1 ? true : false) }}</dd>
                          </dl>                  
        				</li>        
     				 </ul>
            
                      <ul style="width:725px;">
                        <li style="width:705px;">Description</li>
                        <li class=boxfields style="width:705px;">
                            {{ Form::textarea('description',$products->description,array('id'=>'mods2')) }}
                        </li>
                      </ul>
      
                      <ul style="width:725px;">
                        <li style="width:705px;">Image</li>
                        <li class=boxfields style="width:705px;">
                          
                          <dl>
                            
                            <dd>{{ Form::file('image') }}
                            	<br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">600px x 350px</span>
                            	@if ($products->image != "") 
                                    <br />
                                    {{ HTML::image('upload/products/'.$products->id.'/_75_'.$products->image) }}
                               @endif
                            </dd>
                          </dl>
                                    
                          
                        </li>
                      </ul>
      
                      <ul style="width:725px;">
                        <li style="width:705px;">Multiple Image</li>
                        <li class=boxfields style="width:705px;">
                          
                          <dl>
                            
                            <dd>{{ Form::file('images[]',array('multiple')) }}
                            	<br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">600px x 350px</span>
                            	<br /><br />
                                <table border="0" width="50%">                
                                    <tr>
                                            @foreach($additional_image as $additional_images)                 	                	
                                                <td>
                                                    <table border="0" width="100" style="border:1px solid #CCC;">
                                                    <tr>
                                                        <td align="center" style="padding-top:10px;">{{ HTML::image('upload/products/'.$products->id.'/others/_75_'.$additional_images->image) }}</td>
                                                    </tr>    
                                                    <tr>
                                                        <td align="center" style="padding-bottom:10px;">
                                                        {{ HTML::image_delete_text('/dnradmin/products/delete1/'.$products->id.'/'.$additional_images->id,'Delete') }}
                                                        </td>
                                                    </tr>
                                                    </table>
                                                </td>
                                            @endforeach
                                    </tr>
                                </table>
                            </dd>
                          </dl>
                                    
                          
                        </li>
                      </ul>

                      <div class=clear><!-- Clear Section --></div>                          
                        {{ Form::submit('',array('name'=>'saveinfo'))}} &nbsp; {{ Form::reset('',array('name'=>'reset'))}} 
                
            </td>
           <td style="width:265px; vertical-align:top">
            		<div style="background:#fff; border:#ccc 1px solid; width:245px; min-height:200px; margin-bottom:10px;">
                    	<p style="padding:5px 5px; background:#666; color:#fff"><strong>Main Category</strong></p>
                        	<span id="category"></span>
			        </div>   
                   
                   <div style="background:#fff; border:#ccc 1px solid; width:245px; min-height:200px; margin-bottom:10px;">
                    	<p style="padding:5px 5px; background:#666; color:#fff"><strong>Sub Category</strong></p>
                        <div id="subcategory"></div> 
                        
                   </div>
                   
                    <div style="background:#fff; border:#ccc 1px solid; width:245px; min-height:200px; margin-bottom:10px;">
                    	<p style="padding:5px 5px; background:#666; color:#fff"><strong>Options</strong></p>
                        	<span id="product_options"></span>
			        </div> 
                    
                    @foreach($options as $option)
						
                        
                    <div style="background:#fff; border:#ccc 1px solid; width:245px; min-height:200px; margin-bottom:10px; {{ DB::table('products_options')->where('option_id','=',$option->id)->where('product_id','=',$products->id)->count()>=1 ? "" : "display:none;" }}" id="options{{$option->id}}">
                    	<p style="padding:5px 5px; background:#666; color:#fff"><strong>{{$option->name}}</strong></p>
                        	<span id="product_options_assets{{$option->id}}"></span>
			        </div> 
                    
                    <script>
						
					</script>
                    @endforeach
                   
           </td>
		 </tr>
      </table>   
      
        
    {{ Form::close() }}
    
  </article>
  

@stop

@section('headercodes')    
  {{ HTML::style('_admin/assets/css/pagination.css') }}  
@stop

@section('extracodes')
	<script>
		var mypath = "{{ $pageURL }}";
		var category_id = "{{ $maincat->main_id }}";
		var product_id = "{{ $products->id }}";
	</script>
    {{ HTML::script('_admin/manager/tinymce/tiny_mce.js','') }}
    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js','') }}
    {{ HTML::script('_admin/assets/js/jquery-latest.min.js','') }}
    {{ HTML::script('_admin/assets/js/customValidation.js','') }}
    {{ HTML::script('_admin/manager/tinymce/styles/mods5.js','') }}
    {{ HTML::script('_admin/assets/js/count_char.js','') }}
    {{ HTML::script('_admin/assets/js/category.js','') }} 	      
    
    @foreach($options as $option)
				{{ $countOptions = DB::table('products_options')->where('option_id','=',$option->id)->where('product_id','=',$products->id)->count();}}
				@if($countOptions >=1)
                	<script>
						displayOptionsAssets({{ $option->id }},true,product_id);
					</script>	
				@endif	
	@endforeach
            				
		<script language="javascript">		
			
			$('#subcategory').load(mypath+'/dnradmin/sub-category/{{ $maincat->main_id }}/{{ $products->id }}');
			
			var elem1 = $("#name_text");
			$("#name").limiter(50, elem1);
		</script>     
    
@stop