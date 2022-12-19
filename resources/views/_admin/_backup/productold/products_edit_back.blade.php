@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control class=col1>
       {{ HTML::image_link('/dnradmin/products/view/'.$products->category_id,'_admin/assets/images/icons/icon_arrow.png',' Go to Products Management') }}    
    </div>
    
  	<h2 class=line>Products Management - Update Products</h2>    
    
   {{ Form::open(array('url' => '/dnradmin/products/edit/'.$products->id, 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
    
      <ul>
        <li>Products Information</li>
        
        <li class=boxfields>
          <dl>
            <dt>Product Name</dt>
            <dd>{{ Form::text('name',$products->name,array('size'=>'50')) }}</dd>
          </dl>
          <dl>
            <dt>Price $</dt>
            <dd>{{ Form::text('price',$products->price,array('size'=>'50','class'=>'required')) }}</dd>
          </dl>  
          <dl>
            <dt>Old Price $</dt>
            <dd>{{ Form::text('old_price',$products->old_price,array('size'=>'50','class'=>'required')) }}</dd>
          </dl> 
             <dl>
            <dt>Weight</dt>
            <dd>{{ Form::text('weight',$products->weight,array('size'=>'50','class'=>'required')) }}</dd>
          </dl>    
          <dl>
            <dt>isNew</dt>
            <dd>{{ Form::checkbox('isNew',1,$products->isNew == 1 ? true : false) }}</dd>
          </dl>
          <dl>
            <dt>isFeatured</dt>
            <dd>{{ Form::checkbox('isFeatured',1,$products->isFeatured == 1 ? true : false) }}</dd>
          </dl>          
        </li>
        
      </ul>
            
      <ul>
        <li>Photo Description</li>
        <li class=boxfields>
        	{{ Form::textarea('description',$products->description,array('id'=>'mods2')) }}
        </li>
      </ul>
      
      <ul>
        <li>Image</li>
        <li class=boxfields>
          
          <dl>
            <dt>Image</dt>
            <dd>{{ Form::file('image') }}
            	@if ($products->image != "") 
                	<br />
                	{{ HTML::image('upload/products/'.$products->id.'/_75_'.$products->image) }}
               @endif
                

            </dd>
          </dl>
                    
          
        </li>
      </ul>
      
       <ul>
        <li>Multiple Image</li>
        <li class=boxfields>
          
          <dl>
            <dt>Image</dt>
            <dd>{{ Form::file('images[]',array('multiple')) }}
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
      	{{ Form::submit('',array('name'=>'saveinfo'))}}
        
    {{ Form::close() }}
    
  </article>
  

@stop

@section('headercodes')    
  {{ HTML::style('_admin/assets/css/pagination.css') }}  
@stop

@section('extracodes')

    {{ HTML::script('_admin/manager/tinymce/tiny_mce.js','') }}
    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js','') }}
    {{ HTML::script('_admin/assets/js/jquery-latest.min.js','') }}
    {{ HTML::script('_admin/assets/js/assets/js/jquery.pagination.js','') }}
    {{ HTML::script('_admin/manager/tinymce/styles/mods2.js','') }}
       
    
@stop