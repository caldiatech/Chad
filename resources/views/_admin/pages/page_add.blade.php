@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
      
        <div  class=col2>
          {!! Html::link('/dnradmin/pages',PAGE_MANAGEMENT) !!}  <i class="pe-7s-angle-right"></i> Add new page
    </div>
    </div>
    
  	 
    
   {!! Form::open(array('url' => '/dnradmin/pages/new', 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')); !!}
    
    {!! Html::flash_msg_admin() !!}
    
    <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>Page Information</li>
               <li class="boxfields">

               		<? /*
                    <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Main Menu</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::select('main_id',array('0' => 'No Main Menu')+$pagelist,'0') !!}
                      </div>
                   	</div>
                   	*/ ?>
                    {!! Form::hidden('main_id','0') !!}

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Page Name</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::text('name','',array('size'=>'50','class'=>'required','id'=>'name')) !!}
                           @if($errors->pages->first('name'))
                              <div class="error">{!!$errors->pages->first('name')!!}</div>
                           @endif
                           <br />
                           <span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Page Title</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::text('title','',array('size'=>'50','class'=>'required','id'=>'page_title')) !!}
                             @if($errors->pages->first('title'))
                                <div class="error">{!!$errors->pages->first('title')!!}</div>
                             @endif
                          <br />
                          <span id="title_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Image</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                              <div>
                                <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                                <span class="fileinput-exists">Change</span><input type="file" name="image"></span>
                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                              </div>
                            </div>
                            <br />
                            <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Min Dimension</strong>: <span id="dimension">{{ PAGES_IMAGE_WIDTH }}px x {{ PAGES_IMAGE_HEIGHT }}px</span>
                              @if($errors->pages->first('image'))
                                <div class="error">Please check image minimum required dimension</div>
                              @endif
                      </div>
                   </div>

                   	<? /*
                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Show to Navigation</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          {!! Form::checkbox('isVisible', 1, false, ['class' => "check-select"]);!!}
                      </div>
                   </div>
                    */ ?>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">CMS</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          {!! Form::checkbox('isCMS', 1, false, ['class' => "check-select"]);!!}
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Filename</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          {!! Form::text('filename','',array('size'=>'50','id'=>'filename')) !!}
                      </div>
                   </div>

               </li>
            </ul>
        </div>
    </div>

    <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>Page Content</li>
               <li class="boxfields">
                    {!! Form::textarea('description','',array('id'=>'mods2')) !!}
                    @if($errors->first('description'))
                        <li class="error">{!! $errors->first('description'); !!}</li>           
                    @endif
               </li>
            </ul>
        </div>
     </div>
      
     

     <div class=clear><!-- Clear Section --></div>   
        {!! Form::submit('Save Record',array('name'=>'saveinfo','class'=>'uk-button uk-button-success'))!!} &nbsp; {!! Form::reset('Reset',array('name'=>'reset','class'=>'uk-button uk-button-danger'))!!}         
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
		$("#page_title").limiter(22, elem1);
   </script>    
@stop