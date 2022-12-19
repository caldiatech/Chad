@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
		<div class="col1">
	       {!! Html::link('/dnradmin/photos','Photos') !!}  &raquo; Update photos  
        </div>    
    </div>
    
  	
    
   {!! Form::open(array('url' => '/dnradmin/photos/edit/'.$photo->fldPhotoGalleryID, 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
    @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif    
     @if(Session::has('error')) 
      <div class="error_text">{!!Session::get('error')!!}</div>
    @endif
      <ul>
        <li>Photo Information</li>
        
        <li class=boxfields>
          <dl>
            <dt>Photo Name</dt>
            <dd>{!! Form::text('name',$photo->fldPhotoGalleryName,array('size'=>'50','id'=>'name')) !!}
	            <br />
            	<span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>
          </dl>
                    
        </li>
        
      </ul>
            
      <ul>
        <li>Photo Description</li>
        <li class=boxfields>
        	{!! Form::textarea('description',$photo->fldPhotoGalleryDescription,array('id'=>'mods2')) !!}
        </li>
      </ul>
      
      <ul>
        <li>Image</li>
        <li class=boxfields>
          
          

          <dl>
            <dt></dt>
            <dd>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                      @if($photo->fldPhotoGalleryImage != "")
                        {!! Html::image('upload/photos/'.$photo->fldPhotoGalleryID.'/'.$photo->fldPhotoGalleryImage) !!}
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

              <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">990px x 450px</span>
              
                

            </dd>
          </dl>
                    
          
        </li>
      </ul>
      
       <ul>
        <li>Multiple Images</li>
        <li class=boxfields>
          
          <dl>
            <dt>Image</dt>
            <dd>{!! Form::file('images[]',array('multiple')) !!}
            	<br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">990px x 450px</span>
                <br /><br />
                <table border="0" width="50%">                
                	<tr>
                            @foreach($additional_photos as $additional_photoss)                 	                	
                            	<td>
                                	<table border="0" width="100" style="border:1px solid #CCC;">
                                    <tr>
		                                <td align="center" style="padding-top:10px;">{!! Html::image('upload/photos/'.$photo->fldPhotoGalleryID.'/others/_75_'.$additional_photoss->fldAdditionalPhotoGalleryImage) !!}</td>
                                    </tr>    
                                    <tr>
                                    	<td align="center" style="padding-bottom:10px;">                                        
                                           <a href="{{url('dnradmin/photos/delete1/'.$photo->fldPhotoGalleryID.'/'.$additional_photoss->fldAdditionalPhotoGalleryID)}}" alt="Delete"><img src="{{url('_admin/assets/images/icons/page_delete.png')}}"></a>                                                       
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
      	{!! Form::submit('',array('name'=>'saveinfo'))!!}
        
    {!! Form::close() !!}
    
  </article>
  

@stop

@section('headercodes')    
  {!! Html::style('_admin/assets/css/pagination.css') !!}
  {!! Html::style('_admin/plugins/jasny/css/jasny-bootstrap.min.css') !!}      
@stop

@section('extracodes')

    {!! Html::script('_admin/manager/tinymce/tiny_mce.js','') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js','') !!}
    {!! Html::script('_admin/assets/js/count_char.js','') !!}
    {!! Html::script('_admin/plugins/jasny/js/jasny-bootstrap.min.js','') !!}
    <script>				
		var elem1 = $("#name_text");
		$("#name").limiter(50, elem1);
	</script>   
    
@stop