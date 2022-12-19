@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	
        <div  class=col1>
        	{!! Html::link('/dnradmin/pages','Page Management') !!}  &raquo; Add new page
		</div>
    </div>
    
  	 
    
   {!! Form::open(array('url' => '/dnradmin/pages/new', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
     @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif  	
     @if(Session::has('error')) 
    	<div class="error_text">{!!Session::get('error')!!}</div>
    @endif
      <ul>
        <li>Page Information</li>
        
        <li class=boxfields>
          <dl>
            <dt>Main Menu</dt>
            <dd>{!! Form::select('main_id',array('0' => 'No Main Menu')+$pagelist,'0') !!}</dd>
          </dl>      
            	
          <dl>
            <dt>Page Name</dt>
            <dd>{!! Form::text('name','',array('size'=>'50','class'=>'required','id'=>'name')) !!}
            	<br />
            	<span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>            
          </dl>          
          @if($errors->first('name'))
          <dl class="error">
          	<dt>&nbsp;</dt>
            <dd>{!! $errors->first('name'); !!}</dd>
          </dl>
          @endif
          <dl>
            <dt>Page Title</dt>
            <dd>{!! Form::text('title','',array('size'=>'50','class'=>'required','id'=>'page_title')) !!}
            	<br />
            	<span id="title_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>            
          </dl>   
          <dl>
            <dt>Image</dt>
            <dd>
               <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                <div>
                  <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                  <span class="fileinput-exists">Change</span><input type="file" name="image"></span>
                  <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
              </div>
            	<br />
            	<br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">750px x 250px</span>
            </dd>            
          </dl>
       
          <dl>
            <dt>Show to Navigation</dt>
            <dd>{!! Form::checkbox('isVisible', 1);!!}</dd>
          </dl>  
          
          <dl>
            <dt>CMS</dt>
            <dd>{!! Form::checkbox('isCMS', 1);!!}</dd>
          </dl>
          
          <dl>
            <dt>Filename</dt>
            <dd>{!! Form::text('filename','',array('size'=>'50','id'=>'filename')) !!}</dd>            
          </dl>          
          
              
        </li> 
        
      </ul>
      
      
    
     

      <ul>
        <li>Page Content</li>
        <li class=boxfields>
        	{!! Form::textarea('description','',array('id'=>'mods2')) !!}
        </li>
        @if($errors->first('description'))
        <li class="error">
        	 {!! $errors->first('description'); !!}
        </li>
        @endif
      </ul>

      <div class=clear><!-- Clear Section --></div>   
      	{!! Form::submit('',array('name'=>'saveinfo'))!!} &nbsp; {!! Form::reset('',array('name'=>'reset'))!!} 
        
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
	</script>
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js','') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
    {!! Html::script('_admin/assets/js/customValidation.js','') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js','') !!}
    {!! Html::script('_admin/assets/js/count_char.js','') !!}
    {!! Html::script('_admin/plugins/jasny/js/jasny-bootstrap.min.js','') !!}

   <script>   			
		var elem1 = $("#name_text");
		$("#name").limiter(50, elem1);
		var elem1 = $("#title_text");
		$("#page_title").limiter(50, elem1);
   </script>    
@stop