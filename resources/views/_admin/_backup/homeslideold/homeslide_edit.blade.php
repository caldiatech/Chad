@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
       <div class="col1">
	       {!! Html::link('/dnradmin/homeslides','Home Slide') !!}  &raquo; Update Home Slide   
        </div>  
    </div>
    
  	
    
   {!! Form::open(array('url' => '/dnradmin/homeslides/edit/'.$homeslide->fldHomeSlideID, 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
   @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif    
     @if(Session::has('error')) 
      <div class="error_text">{!!Session::get('error')!!}</div>
    @endif
   
    
      <ul>
        <li>Home Slide Information</li>
        
        <li class=boxfields>
          <dl>
            <dt>Slide Name</dt>
            <dd>{!! Form::text('name',$homeslide->fldHomeSlideName,array('size'=>'50','id'=>'name')) !!}
            	<br />
            	<span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>
          </dl>
            <dl>
            <dt>Slide Links</dt>
            <dd>{!! Form::text('links',$homeslide->fldHomeSlideLinks,array('size'=>'50','class'=>'required')) !!}</dd>
          </dl>             
        </li>
        
      </ul>
            
      <ul>
        <li>Brief Description</li>
        <li class=boxfields>
        	{!! Form::textarea('description',$homeslide->fldHomeSlideDescription,array('id'=>'mods2')) !!}
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
                      @if($homeslide->fldHomeSlideImage != "")
                        {!! Html::image('uploads/home-sliders/'.$homeslide->fldHomeSlideImage,'',array( 'width' => 200 )) !!}
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

            	<br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">1920px x 715px</span>
            	
                

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
	<script>
		var mypath = "{!! url('/') !!}";
	</script>
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js','') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js','') !!}
    {!! Html::script('public/_admin/assets/js/count_char.js','') !!}
    {!! Html::script('_admin/plugins/jasny/js/jasny-bootstrap.min.js','') !!}
    <script>				
		var elem1 = $("#name_text");
		$("#name").limiter(50, elem1);
	</script>      
    
@stop