@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>

       <div class="col1">
       	{!! Html::link('/dnradmin/pages','Page Management') !!}  &raquo; Update page
       </div>
    </div>
    
  	  
    
   {!! Form::open(array('url' => '/dnradmin/pages/edit/'.$page->fldPagesID, 'method' => 'post', 'id' => 'pageform', 'files' => true)) !!}
     @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif    
     @if(Session::has('error')) 
      <div class="error_text">{!!Session::get('error')!!}</div>
    @endif
    @if (Session::has('success_image'))
           <div class="error_text">{!!Session::get('success_image')!!}</div>
    @endif 
      
      <ul>
        <li>Page Information</li>
        
         
        <li class=boxfields>
          <dl>
            <dt>Main Menu</dt>
            <dd>{!! Form::select('main_id',array('0' => 'Select one')+$pagelist,$page->fldPagesMainID) !!}</dd>
          </dl> 	
          <dl>
            <dt>Page Name</dt>
            <dd>{!! Form::text('name',$page->fldPagesName,array('size'=>'50','id'=>'name')) !!}
            	<br />
            	<span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>
          </dl>      
          @if($errors->first('name'))
          <dl class="error_text">
          	<dt>&nbsp;</dt>
            <dd>{!! $errors->first('name') !!}</dd>
          </dl>
          @endif
          
          <dl>
            <dt>Page Title</dt>
            <dd>{!! Form::text('title',$page->fldPagesTitle,array('size'=>'50','class'=>'required','id'=>'page_title')) !!}
            	<br />
            	<span id="title_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>            
          </dl> 
           <dl>
            <dt>URL</dt>
            <dd>
            	@if($page->fldPagesFilename != "")
                  {!! Html::link($page->filename,url($page->fldPagesFilename)) !!}
                @else
                  @if($page->id == 32) 
                     {!! Html::link(url(),url()."/") !!}
                  @else
	                 {!! Html::link("pages/".$page->fldPagesSlug,url("/pages/".$page->fldPagesSlug)) !!}
                  @endif    
                @endif
            </dd>            
          </dl> 
           @if($page->fldPagesFilename == "")
           <dl>
            <dt>Preview</dt>
            <dd>
            	@if($page->id == 32) 
                   	{!! Html::link(url()."/preview",url()) !!}
                @else
	               {!! Html::link("preview/".$page->fldPagesSlug,url("/preview/".$page->fldPagesSlug)) !!}
                @endif    
                
            </dd>            
          </dl> 
          <dl>
            <dt>Live Mode</dt>
            
            <dd>{!! Form::checkbox('isLive', 1,$page->fldPagesIsLive == 1 ? true : false) !!}</dd>
          </dl>
          @endif
          
          @if($page->fldPagesFilename == "")
          <dl>
            <dt>Image</dt>
            <dd>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                      @if($page->fldPagesImage != "")
                        {!! Html::image('upload/pages/_400_'.$page->fldPagesImage,'',array( 'width' => 200 )) !!}
                      @endif  
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                  <div>
                    <span class="btn btn-default btn-file">
                      <span class="fileinput-new">Select image</span>
                      <span class="fileinput-exists">Change</span>
                      <input type="file" name="image"></span>
                      @if($page->fldPagesImage != "")
                        <a href="{!!url('dnradmin/pages/remove_image/'.$page->fldPagesID)!!}" class="btn btn-danger">Remove</a>
                      @endif  
                  </div>
                </div>                
            	<br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">750px x 250px</span>
                
            </dd>            
          </dl>
          @endif
          <dl>
            <dt>Show to Navigation</dt>
            
            <dd>{!! Form::checkbox('isVisible', 1,$checked = $page->fldPagesIsVisible == 1 ? true : false)!!}</dd>
          </dl>  
          
          <dl>
            <dt>CMS</dt>
            
            <dd>{!! Form::checkbox('isCMS', 1,$checked = $page->fldPagesIsCMS == 1 ? true : false)!!}</dd>
          </dl>
          
          <dl>
            <dt>Filename</dt>
            <dd>{!! Form::text('filename',$page->fldPagesFilename,array('size'=>'50','id'=>'filename')) !!}</dd>            
          </dl>     
        </li>        
      </ul>
      
      
      

     

      <ul>
        <li>Page Content</li>
        <li class=boxfields>
        	{!! Form::textarea('description',$page->fldPagesIsLive==1 ? $page->fldPagesDescription : $preview->fldPagesPreviewDescription,array('id'=>'mods2')) !!}
        </li>
        @if($errors->first('description'))
        <li class="error">
        	 {!! $errors->first('description') !!}
        </li>
        @endif
      </ul>

      <div class=clear><!-- Clear Section --></div>  
        {!! Form::hidden('Id',$page->fldPagesID) !!} 
      	{!! Form::submit('',array('name'=>'saveinfo'))!!}
        
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
    {!! Html::script('_admin/assets/js/assets/js/jquery.pagination.js','') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js','') !!}
    {!! Html::script('_admin/assets/js/count_char.js','') !!}
    {!! Html::script('_admin/plugins/jasny/js/jasny-bootstrap.min.js','') !!}

   <script>   			
		var elem1 = $("#name_text");
    var elem2 = $("#title_text");
		$("#name").limiter(50, elem1);
    $("#page_title").limiter(50, elem2);
    
   </script>     
    
@stop