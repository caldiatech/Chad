@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control class=col1>
       {{ HTML::image_link('/dnradmin/pages','_admin/assets/images/icons/icon_arrow.png',' Go to Page') }}    
    </div>
    
  	<h2 class=line>Page - Update Page</h2>    
    
   {{ Form::open(array('url' => '/dnradmin/pages/edit/'.$page->id, 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
    @if($success == 1) 
           <div class="success">Record successfully save</div>
    @endif	
     @if($error == 1) 
    	<div class="error">Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!</div>
    @endif
      <ul>
        <li>Page Information</li>
        
         
        <li class=boxfields>
          <dl>
            <dt>Main Menu</dt>
            <dd>{{ Form::select('main_id',array('0' => 'Select one')+PagesManagement::pageList(),$page->main_id) }}</dd>
          </dl> 	
          <dl>
            <dt>Page Name</dt>
            <dd>{{ Form::text('name',$page->name,array('size'=>'50','id'=>'name')) }}
            	<br />
            	<span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>
          </dl>      
          @if($errors->first('name'))
          <dl class="error">
          	<dt>&nbsp;</dt>
            <dd>{{ $errors->first('name'); }}</dd>
          </dl>
          @endif
          <dl>
            <dt>Image</dt>
            <dd>{{ Form::file('image') }}
            	<br />
            	<br><small><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">750px x 250px</span></small>
                @if($page->image != "")
                	<br />
                	{{ HTML::image('upload/pages/_400_'.$page->image) }}
                @endif
            </dd>            
          </dl>
          <dl>
            <dt>Show to Navigation</dt>
            
            <dd>{{ Form::checkbox('isVisible', 1,$checked = $page->isVisible == 1 ? true : false);}}</dd>
          </dl>  
          
          <dl>
            <dt>CMS</dt>
            
            <dd>{{ Form::checkbox('isCMS', 1,$checked = $page->isCMS == 1 ? true : false);}}</dd>
          </dl>
          
          <dl>
            <dt>Filename</dt>
            <dd>{{ Form::text('filename',$page->filename,array('size'=>'50','id'=>'filename')) }}</dd>            
          </dl>     
        </li>        
      </ul>
      
      
      

     

      <ul>
        <li>Page Content</li>
        <li class=boxfields>
        	{{ Form::textarea('description',$page->description,array('id'=>'mods2')) }}
        </li>
        @if($errors->first('description'))
        <li class="error">
        	 {{ $errors->first('description'); }}
        </li>
        @endif
      </ul>

      <div class=clear><!-- Clear Section --></div>  
        {{ Form::hidden('Id',$page->id) }} 
      	{{ Form::submit('',array('name'=>'saveinfo'))}}
        
    {{ Form::close() }}
    
  </article>
  

@stop

@section('headercodes')    
  {{ HTML::style('_admin/assets/css/pagination.css') }}  
@stop

@section('extracodes')
	<script>
		var mypath = "{{ $pageURL }}";
	</script>
    {{ HTML::script('_admin/manager/tinymce/tiny_mce.js','') }}
    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js','') }}
    {{ HTML::script('_admin/assets/js/jquery-latest.min.js','') }}
    {{ HTML::script('_admin/assets/js/assets/js/jquery.pagination.js','') }}
    {{ HTML::script('_admin/manager/tinymce/styles/mods2.js','') }}
    {{ HTML::script('_admin/assets/js/count_char.js','') }}

   <script>   			
		var elem1 = $("#name_text");
		$("#name").limiter(50, elem1);
   </script>     
    
@stop