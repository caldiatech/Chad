@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class="col2">
    	@if($backid==0) 
	       {!! Html::link('/dnradmin/products/new',CATEGORY_MANAGEMENT) !!}  &raquo; Add new {{ CATEGORY_MANAGEMENT }}
        @elseif($backid==1) 
        	{!! Html::link('/dnradmin/products/edit/'.$backid,' Category') !!}  &raquo; Add new {{ CATEGORY_MANAGEMENT }}   
        @elseif (empty($category)) 
           {!! Html::link('/dnradmin/category/',CATEGORY_MANAGEMENT) !!}  &raquo;  Add new {{ CATEGORY_MANAGEMENT }}      
        @else
            {!! Html::link('/dnradmin/category/',CATEGORY_MANAGEMENT) !!}  &raquo; {!! Html::link('/dnradmin/category/view/'.$category_id, $category->fldCategoryName) !!}  &raquo; Add new {{ CATEGORY_MANAGEMENT }}      
        @endif   
        </div>
    </div>
    
  	
    
   {!! Form::open(array('url' => '/dnradmin/category/new/'.$category_id.'/'.$backid, 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')); !!}
    @if(Session::has('success')) 
           <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
    @endif	
    @if($errors->category->first('image') && $errors->category->first('image')=="validation.img_min_size")
        <div class="uk-alert uk-alert-danger">{!!IMAGES_DIMENSION_ERROR!!}</div>
    @endif

     <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>Contact Information</li>
               <li class="boxfields">

                     <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Title</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                            {!! Form::text('name','',array('size'=>'50','class'=>'required','id'=>'name')) !!}
                             @if($errors->category->first('name'))
                                <div class="error">{!!$errors->category->first('name')!!}</div>
                             @endif
                          <br />
                          <span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                      </div>
                   </div>

                    <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Sub Title</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                            {!! Form::text('sub_title','',array('size'=>'50','class'=>'required','id'=>'sub_title')) !!}
                               @if($errors->category->first('sub_title'))
                                  <div class="error">{!!$errors->category->first('sub_title')!!}</div>
                               @endif
                            <br />
                            <span id="sub_title_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                      </div>
                   </div>
                  
               </li>
            </ul>
        </div>
     </div>           

     <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>Description</li>
               <li class="boxfields">
                   {!! Form::textarea('description','',array('id'=>'mods2')) !!}
                    @if($errors->category->first('description'))
                        <div class="error">{!!$errors->category->first('description')!!}</div>
                    @endif 
               </li>
            </ul>
        </div>
     </div>

     <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>Image</li>
               <li class="boxfields">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                      <div>
                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span><input type="file" name="image"></span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                      </div>
                    </div>
                   <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Min Dimension</strong>: <span id="dimension">{{ CATEGORY_IMAGE_WIDTH }}px x {{ CATEGORY_IMAGE_HEIGHT }}px</span>
                      @if($errors->category->first('image') && $errors->category->first('image')!="validation.img_min_size")
                          <div class="error">{!!$errors->category->first('image')!!}</div>
                       @endif
               </li>
            </ul>
        </div>
     </div>

      
    
      
     

      <div class=clear><!-- Clear Section --></div>   
      	{!! Form::hidden('main_id', $category_id)!!}
        {!! Form::hidden('backid', $backid)!!}
              
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
    var elem2 = $("#sub_title_text");
		$("#name").limiter(50, elem1);
    $("#sub_title").limiter(150, elem2);
	</script> 
    
@stop