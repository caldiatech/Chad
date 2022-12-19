@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class="col1">
            {{ HTML::link('/dnradmin/settings','Settings') }} &raquo; Create new Administrator   
         </div>  
    </div>
    
  
    
   {{ Form::open(array('url' => '/dnradmin/settings/new', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
    @if($success == 1) 
           <div class="success">Record successfully save</div>
    @endif	
      <ul>
        <li>Administraotr Information</li>
        
        <li class=boxfields>
          <dl>
            <dt>Full name</dt>
            <dd>{{ Form::text('fullname','',array('size'=>'50','class'=>'required')) }}</dd>
          </dl>         
          <dl>
            <dt>Email address</dt>
            <dd>{{ Form::text('email','',array('size'=>'50','class'=>'required')) }}</dd>
          </dl> 
          <dl>
            <dt>Phone no</dt>
            <dd>{{ Form::text('phone','',array('size'=>'50','class'=>'required')) }}</dd>
          </dl> 
          <dl>
            <dt>Username</dt>
            <dd>{{ Form::text('username','',array('size'=>'50','class'=>'required')) }}</dd>
          </dl>
           <dl>
            <dt>Password</dt>
            <dd>{{ Form::password('password','',array('size'=>'50','class'=>'required')) }}</dd>
          </dl>                  
        </li>
        
      </ul>
            
      <ul>
        <li>Site Information</li>
        <li class=boxfields>
          <dl>
            <dt>Site name</dt>
            <dd>{{ Form::text('site_name','',array('size'=>'50')) }}</dd>
          </dl>
          <dl>
            <dt>Facebook</dt>
            <dd>{{ Form::text('facebook','',array('size'=>'50')) }}</dd>
          </dl> 
          <dl>
            <dt>Twitter</dt>
            <dd>{{ Form::text('twitter','',array('size'=>'50')) }}</dd>
          </dl>  
          <dl>
            <dt>LinkedIn</dt>
            <dd>{{ Form::text('linkedIn','',array('size'=>'50')) }}</dd>
          </dl>  
        </li>
      </ul>
      
     
            

      <div class=clear><!-- Clear Section --></div>   
      	{{ Form::submit('',array('name'=>'saveinfo'))}} &nbsp; {{ Form::reset('',array('name'=>'reset'))}} 
        
    {{ Form::close() }}
    
  </article>
  

@stop

@section('headercodes')    
  {{ HTML::style('_admin/assets/js/jq-ui/jquery-ui.css') }}  
  {{ HTML::script('_admin/assets/js/jquery-ui.js','') }}
@stop

@section('extracodes')

    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js','') }}
    {{ HTML::script('_admin/assets/js/customValidation.js','') }}

   
@stop