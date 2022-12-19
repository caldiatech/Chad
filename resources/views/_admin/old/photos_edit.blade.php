@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
		<div class="col1">
	       {{ HTML::link('/dnradmin/photos','Photos') }}  &raquo; Update photos  
        </div>    
    </div>
    
  	
    
   {{ Form::open(array('url' => '/dnradmin/photos/edit/'.$photo->id, 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
     @if($success == 1) 
           <div class="success">Record successfully saved</div>
    @endif
     @if($error == 1) 
    	<div class="error">Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!</div>
    @endif	
      <ul>
        <li>Photo Information</li>
        
        <li class=boxfields>
          <dl>
            <dt>Photo Name</dt>
            <dd>{{ Form::text('name',$photo->name,array('size'=>'50','id'=>'name')) }}
	            <br />
            	<span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>
          </dl>
                    
        </li>
        
      </ul>
            
      <ul>
        <li>Photo Description</li>
        <li class=boxfields>
        	{{ Form::textarea('description',$photo->description,array('id'=>'mods2')) }}
        </li>
      </ul>
      
      <ul>
        <li>Image</li>
        <li class=boxfields>
          
          <dl>
            <dt>Image</dt>
            <dd>{{ Form::file('image') }}
            	<br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">990px x 450px</span>
            	@if ($photo->image != "") 
                	<br />
                	{{ HTML::image('upload/photos/'.$photo->id.'/_75_'.$photo->image) }}
               @endif
                

            </dd>
          </dl>
                    
          
        </li>
      </ul>
      
       <ul>
        <li>Multiple Images</li>
        <li class=boxfields>
          
          <dl>
            <dt>Image</dt>
            <dd>{{ Form::file('images[]',array('multiple')) }}
            	<br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">990px x 450px</span>
                <br /><br />
                <table border="0" width="50%">                
                	<tr>
                            @foreach($additional_photos as $additional_photoss)                 	                	
                            	<td>
                                	<table border="0" width="100" style="border:1px solid #CCC;">
                                    <tr>
		                                <td align="center" style="padding-top:10px;">{{ HTML::image('upload/photos/'.$photo->id.'/others/_75_'.$additional_photoss->image) }}</td>
                                    </tr>    
                                    <tr>
                                    	<td align="center" style="padding-bottom:10px;">
                                        {{ HTML::image_delete_text('/dnradmin/photos/delete1/'.$photo->id.'/'.$additional_photoss->id,'Delete') }}
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
    {{ HTML::script('_admin/manager/tinymce/styles/mods2.js','') }}
    {{ HTML::script('_admin/assets/js/count_char.js','') }}
    <script>				
		var elem1 = $("#name_text");
		$("#name").limiter(50, elem1);
	</script>   
    
@stop