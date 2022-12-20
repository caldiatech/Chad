@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class="col1">
	      {!! Html::link('/dnradmin/pages/edit/72','The works page') !!}  &raquo; {!! Html::link('/dnradmin/slider','Slider') !!}  &raquo; Add new Slider           
        </div>   
    </div>
    

    
   {!! Form::open(array('url' => '/dnradmin/slider/new', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
   @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif    
    @if($errors->slider->first('image') && $errors->slider->first('image')=="validation.img_min_size")
        <div class="error_text">{!!IMAGES_DIMENSION_ERROR!!}</div>
    @endif
   
    
      <ul>
        <li>Slider Information</li>
        
        <li class=boxfields>
          <dl>
            <dt>Slider Name</dt>
            <dd>{!! Form::text('name','',array('size'=>'50','class'=>'required','id'=>'name')) !!}
                 @if($errors->slider->first('name'))
                    <div class="error">{!!$errors->slider->first('name')!!}</div>
                 @endif
              <br />
              <span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>
          </dl> 
          <dl>
            <dt>Slider Button Links</dt>
            <dd>{!! Form::text('links','',array('size'=>'50')) !!}
                 @if($errors->slider->first('links'))
                    <div class="error">{!!$errors->slider->first('links')!!}</div>
                 @endif
            </dd>
          </dl> 
          <dl>
            <dt>Slider Button Text</dt>
            <dd>{!! Form::text('linkname','',array('size'=>'50')) !!}
                 @if($errors->slider->first('linkname'))
                    <div class="error">{!!$errors->slider->first('linkname')!!}</div>
                 @endif
            </dd>
          </dl>                
        </li>
        
      </ul>
            
      <ul>
        <li>Left Content</li>
        <li class=boxfields>
        	  <dl>
              <dt>Title</dt>
              <dd>{!! Form::text('title1','',array('size'=>'50','class'=>'required','id'=>'title1')) !!}
                   @if($errors->slider->first('title1'))
                      <div class="error">{!!$errors->slider->first('title1')!!}</div>
                   @endif              
              </dd>
            </dl> 
            <dl>
              <dt>Description</dt>
              <dd>{!! Form::textarea('description1','',array('style'=>'width:320px;height:100px;','class'=>'required','id'=>'title1')) !!}
                   @if($errors->slider->first('description1'))
                      <div class="error">{!!$errors->slider->first('description1')!!}</div>
                   @endif              
              </dd>
            </dl> 
        </li>
      </ul>

      <ul>
        <li>Center Content</li>
        <li class=boxfields>
            <dl>
              <dt>Title</dt>
              <dd>{!! Form::text('title2','',array('size'=>'50','class'=>'required','id'=>'title2')) !!}
                   @if($errors->slider->first('title2'))
                      <div class="error">{!!$errors->slider->first('title2')!!}</div>
                   @endif              
              </dd>
            </dl> 
            <dl>
              <dt>Description</dt>
              <dd>{!! Form::textarea('description2','',array('style'=>'width:320px;height:100px;','class'=>'required','id'=>'description2')) !!}
                   @if($errors->slider->first('description2'))
                      <div class="error">{!!$errors->slider->first('description2')!!}</div>
                   @endif              
              </dd>
            </dl> 
        </li>
      </ul>

      <ul>
        <li>Right Content</li>
        <li class=boxfields>
            <dl>
              <dt>Title</dt>
              <dd>{!! Form::text('title3','',array('size'=>'50','class'=>'required','id'=>'title3')) !!}
                   @if($errors->slider->first('title3'))
                      <div class="error">{!!$errors->slider->first('title3')!!}</div>
                   @endif              
              </dd>
            </dl> 
            <dl>
              <dt>Description</dt>
              <dd>{!! Form::textarea('description3','',array('style'=>'width:320px;height:100px;','class'=>'required','id'=>'description3')) !!}
                   @if($errors->slider->first('description3'))
                      <div class="error">{!!$errors->slider->first('description3')!!}</div>
                   @endif              
              </dd>
            </dl> 
        </li>
      </ul>
      
      <ul>
        <li>Image</li>
        <li class=boxfields>
          
          <dl>
            <dt></dt>
            <dd>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                <div>
                  <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                  <span class="fileinput-exists">Change</span><input type="file" name="image"></span>
                  <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
              </div>
             <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Min Dimension</strong>: <span id="dimension">{{ SLIDER_IMAGE_WIDTH }}px x {{ SLIDER_IMAGE_HEIGHT }}px</span>
                 @if($errors->slider->first('image') && $errors->slider->first('image')!="validation.img_min_size")
                    <div class="error">{!!$errors->slider->first('image')!!}</div>
                 @endif
           </dd>
          </dl>
                    
          
        </li>
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
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}
    {!! Html::script('_admin/assets/js/customValidation.js') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js') !!}
    {!! Html::script('_admin/assets/js/count_char.js') !!}
    {!! Html::script('_admin/plugins/jasny/js/jasny-bootstrap.min.js') !!}
    <script>				
		var elem1 = $("#name_text");
		$("#name").limiter(50, elem1);
	</script>     
    
@stop