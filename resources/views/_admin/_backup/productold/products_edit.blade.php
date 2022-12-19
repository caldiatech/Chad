@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class=col1>          

          <a href="{!!url('dnradmin/products/view/'.$maincat->fldCategoryID)!!}"> Products</a> &raquo; Update Products

          </div>
    </div>
    

    
    {!! Form::open(array('url' => '/dnradmin/products/edit/'.$products->fldProductID, 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
   @if(Session::has('success')) 
           <div class="success">{!!Session::get('success')!!}</div>
    @endif
    @if(Session::has('error')) 
           <div class="success">{!!Session::get('error')!!}</div>
    @endif
      <table border="0" width="1000px;" style="margin-bottom:10px; padding:10px 10px">
      	 <tr>
         	<td style="width:725px; margin-right:10px;">
            	
        			<ul style="width:725px;">
                        <li style="width:705px;">Product Information</li>
                        
                        <li class=boxfields style="width:705px;">
                          <dl style="width:705px;">
                            <dt style="width:100px;">Product Name</dt>
                            <dd style="width:525px;">{!! Form::text('name',$products->fldProductName,array('size'=>'50','class'=>'required','id'=>'name')) !!}
                            	<br />
				            	<span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                            </dd>
                          </dl>   
                           <dl style="width:725px;">
                            <dt style="width:100px;">Old Price $</dt>
                            <dd style="width:525px;">{!! Form::text('old_price',$products->fldProductOldPrice,array('size'=>'50')) !!}</dd>
                          </dl>  
                           <dl style="width:725px;">
                            <dt style="width:100px;">Price $</dt>
                            <dd style="width:525px;">{!! Form::text('price',$products->fldProductPrice,array('size'=>'50','class'=>'required')) !!}</dd>                
                          </dl>  
                             <dl style="width:725px;">
                            <dt style="width:100px;">Weight</dt>
                            <dd style="width:525px;">{!! Form::text('weight',$products->fldProductWeight,array('size'=>'50','class'=>'required')) !!}</dd>
                          </dl>  
                          
                          <dl style="width:725px;">
                            <dt style="width:100px;">Featured</dt>
                            <dd style="width:525px;">{!! Form::checkbox('isFeatured',1,$products->fldProductIsFeatured == 1 ? true : false) !!}</dd>
                          </dl>                  
        				</li>        
     				 </ul>
            
                      <ul style="width:725px;">
                        <li style="width:705px;">Description</li>
                        <li class=boxfields style="width:705px;">
                            {!! Form::textarea('description',$products->fldProductDescription,array('id'=>'mods2')) !!}
                        </li>
                      </ul>
      
                      <ul style="width:725px;">
                        <li style="width:705px;">Image</li>
                        <li class=boxfields style="width:705px;">
                                                    

                          <dl>
                            <dt></dt>
                            <dd>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                      @if($products->fldProductImage != "")
                                        {!! Html::image('upload/products/'.$products->fldProductID.'/'.$products->fldProductImage) !!}
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

                              <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">600px x 350px</span>
                              
                                

                            </dd>
                          </dl>
                                    
                          
                        </li>
                      </ul>
      
                      <ul style="width:725px;">
                        <li style="width:705px;">Multiple Image</li>
                        <li class=boxfields style="width:705px;">
                          
                          <dl>
                            
                            <dd>{!! Form::file('images[]',array('multiple')) !!}
                            	<br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">600px x 350px</span>
                            	<br /><br />
                                <table border="0" width="50%">                
                                    
                                            <? $ctr=0;?>
                                            @foreach($additional_image as $additional_images)                 	                	
                                              <? $ctr=$ctr+1;?>
                                                @if($ctr==1)<tr>@endif          
                                                <td>
                                                    <table border="0" width="100" style="border:1px solid #CCC;">
                                                    <tr>
                                                        <td align="center" style="padding-top:10px;">{!! Html::image('upload/products/'.$products->fldProductID.'/others/_75_'.$additional_images->fldAdditionalProductIDImage) !!}</td>
                                                    </tr>    
                                                    <tr>
                                                        <td align="center" style="padding-bottom:10px;">                                                        
                                                        <a href="{!!url('dnradmin/products/delete1/'.$products->fldProductID.'/'.$additional_images->fldAdditionalProductID)!!}" alt="Delete Products" onClick="return confirm(&quot;Are you sure you want to remove this Product?\n\nPress OK to delete.\nPress Cancel to go back without deleting the Product.\n&quot;)"><img src="{!!url('_admin/assets/images/icons/page_delete.png')!!}"></a>
                                                        </td>
                                                    </tr>
                                                    </table>
                                                </td>                                                
                                                <? if($ctr==7) { $ctr=0; ?>
                                                    </tr>
                                                <? } ?>
                                            @endforeach
                                    
                                </table>
                            </dd>
                          </dl>
                                    
                          
                        </li>
                      </ul>

                      <div class=clear><!-- Clear Section --></div>                          
                        {!! Form::submit('',array('name'=>'saveinfo'))!!}
                
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
						
                        
                    <div style="background:#fff; border:#ccc 1px solid; width:245px; min-height:200px; margin-bottom:10px; {!! DB::table('tblProductOptions')->where('fldProductOptionsOptionsID','=',$option->fldOptionsID)->where('fldProductOptionsProductID','=',$products->fldProductID)->count()>=1 ? "" : "display:none;" !!}" id="options{!!$option->fldOptionsID!!}">
                    	<p style="padding:5px 5px; background:#666; color:#fff"><strong>{!!$option->fldOptionsName!!}</strong></p>
                        	<span id="product_options_assets{!!$option->fldOptionsID!!}"></span>
			        </div> 
                    
                    <script>
						
					</script>
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
		var mypath = "{!! url('/') !!}";
		var category_id = "{!! $maincat->fldCategoryMainID !!}";
		var product_id = "{!! $products->fldProductID !!}";
	</script>
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js','') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
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
			$("#name").limiter(50, elem1);
		</script>     
    
@stop