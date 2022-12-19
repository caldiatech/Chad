@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
       <div class="col2">
	       {!! Html::link('/dnradmin/homeslides',HOMESLIDE_MANAGEMENT) !!}  &raquo; Update {{ HOMESLIDE_MANAGEMENT }}   
        </div>  
    </div>
    
  	
    
   {!! Form::open(array('url' => '/dnradmin/homeslides/edit/'.$homeslide->fldHomeSlideID, 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')); !!}
   @if (Session::has('success'))
           <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
    @endif    
    @if($errors->homeslide->first('image') && $errors->homeslide->first('image')=="validation.img_min_size")
        <div class="uk-alert uk-alert-danger">{!!IMAGES_DIMENSION_ERROR!!}</div>
    @endif
   

     <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>Home Slide Information</li>
               <li class="boxfields">

                     <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Slide Name</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::text('name',$homeslide->fldHomeSlideName,array('size'=>'50','id'=>'name')) !!}
                             @if($errors->homeslide->first('name'))
                                <div class="error">{!!$errors->homeslide->first('name')!!}</div>
                             @endif
                          <br />
                          <span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Slide Links</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          {!! Form::text('links',$homeslide->fldHomeSlideLinks,array('size'=>'50')) !!}
                           @if($errors->homeslide->first('links'))
                              <div class="error">{!!$errors->homeslide->first('links')!!}</div>
                           @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Slide Link Text</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                           {!! Form::text('linkname',$homeslide->fldHomeSlideLinkText,array('size'=>'50')) !!}
                            @if($errors->homeslide->first('linkname'))
                                <div class="error">{!!$errors->homeslide->first('linkname')!!}</div>
                             @endif
                      </div>
                   </div>
                
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
                      <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                          @if($homeslide->fldHomeSlideImage != "")
                            {!! Html::image(HOME_SLIDE_IMAGE_PATH.$homeslide->fldHomeSlideImage,'',array( 'width' => 200 )) !!}
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

                  <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Min Dimension</strong>: <span id="dimension">{{ HOMESLIDE_IMAGE_WIDTH }}px x {{ HOMESLIDE_IMAGE_HEIGHT }}px</span>
                  
                     @if($errors->homeslide->first('image') && $errors->homeslide->first('image')!="validation.img_min_size")
                        <div class="error">{!!$errors->homeslide->first('image')!!}</div>
                     @endif
               </li>
            </ul>
        </div>
     </div>
    
     
     

    <div class=clear><!-- Clear Section --></div>   
        {!! Form::submit('Save Record',array('name'=>'saveinfo','class'=>'uk-button uk-button-success'))!!}
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
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js','') !!}
    {!! Html::script('_admin/assets/js/count_char.js','') !!}
    {!! Html::script('_admin/plugins/jasny/js/jasny-bootstrap.min.js','') !!}
    <script>				
		var elem1 = $("#name_text");
		$("#name").limiter(50, elem1);
	</script>      
    
@stop