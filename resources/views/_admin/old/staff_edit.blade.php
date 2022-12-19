@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
       <div class="col1">
	       {{ HTML::link('/dnradmin/staff','Staff') }} &raquo; Update staff
        </div> 
    </div>
    
  	
    
   {{ Form::open(array('url' => '/dnradmin/staff/edit/'.$staff->id, 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
     @if($success == 1) 
           <div class="success">Record successfully saved</div>
    @endif
      @if($error == 1) 
    	<div class="error">Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!</div>
    @endif		
      <ul>
        <li>Staff Information</li>
        
        <li class=boxfields>
           <dl>
            <dt>First name</dt>
            <dd>{{ Form::text('firstname',$staff->firstname,array('size'=>'50','id'=>'firstname')) }}
            	<br />
            	<span id="firstname_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>
          </dl> 
           <dl>
            <dt>Last name</dt>
            <dd>{{ Form::text('lastname',$staff->lastname,array('size'=>'50','id'=>'lastname')) }}
            	<br />
            	<span id="lastname_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>
          </dl> 
          <dl>
            <dt>Department</dt>
            <dd>{{ Form::text('department',$staff->department,array('size'=>'50','id'=>'department')) }}
            	<br />
            	<span id="department_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>
          </dl>                  
        </li>
        
      </ul>
            
      <ul>
        <li>Biography</li>
        <li class=boxfields>
        	{{ Form::textarea('description',$staff->description,array('id'=>'description','cols'=>'110')) }}
            <br />
          	<span id="description_text" style="font-weight:bold; color:#F00"></span> Remaining characters
        </li>
      </ul>
      
      <ul>
        <li>Image</li>
        <li class=boxfields>
          
          <dl>
            <dt>Image</dt>
            <dd>{{ Form::file('image') }}
            	<br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">218px x 330px</span>
            	@if ($staff->image != "") 
                	<br />
                	{{ HTML::image('upload/staff/'.$staff->id.'/_75_'.$staff->image) }}
               @endif
                

            </dd>
          </dl>
                    
          
        </li>
      </ul>
      
      
      <div class=clear><!-- Clear Section --></div>   
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
    {{ HTML::script('_admin/manager/tinymce/styles/mods2.js','') }}
     {{ HTML::script('_admin/assets/js/count_char.js','') }}
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