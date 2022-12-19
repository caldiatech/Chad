@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class="col1">
	       {!! Html::link('/dnradmin/staff','Staff') !!} &raquo; Create new staff
        </div>   
    </div>
    
    
    
   {!! Form::open(array('url' => '/dnradmin/staff/new', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
    @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif    
     @if(Session::has('error')) 
      <div class="error_text">{!!Session::get('error')!!}</div>
    @endif
      <ul>
        <li>Staff Information</li>
        
        <li class=boxfields>
          <dl>
            <dt>First name</dt>
            <dd>{!! Form::text('firstname','',array('size'=>'50','class'=>'required','id'=>'firstname')) !!}
            	<br />
            	<span id="firstname_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>
          </dl> 
           <dl>
            <dt>Last name</dt>
            <dd>{!! Form::text('lastname','',array('size'=>'50','class'=>'required','id'=>'lastname')) !!}
            	<br />
            	<span id="lastname_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>
          </dl> 
          <dl>
            <dt>Department</dt>
            <dd>{!! Form::text('department','',array('size'=>'50','id'=>'department')) !!}
            	<br />
            	<span id="department_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>
          </dl>                   
        </li>
        
      </ul>
            
      <ul>
        <li>Biography</li>
        <li class=boxfields>
        	{!! Form::textarea('description','',array('id'=>'description','cols'=>'110')) !!}
            <br />
            	<span id="description_text" style="font-weight:bold; color:#F00"></span> Remaining characters
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
                  <span class="fileinput-exists">Change</span><input type="file" name="image" class='required'></span>
                  <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
              </div>
             <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">218px x 330px</span>
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
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js','') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
    {!! Html::script('_admin/assets/js/customValidation.js','') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js','') !!}    
    {!! Html::script('_admin/assets/js/count_char.js','') !!}
    {!! Html::script('_admin/plugins/jasny/js/jasny-bootstrap.min.js','') !!}
    <script>				
		var elem1 = $("#firstname_text");
		$("#firstname").limiter(30, elem1);
		
		var elem2 = $("#lastname_text");
		$("#lastname").limiter(30, elem2);
		
		var elem3 = $("#department_text");
		$("#department").limiter(50, elem3);
		
		var elem4 = $("#description_text");
		$("#description").limiter(450, elem4);
	</script> 
    
@stop