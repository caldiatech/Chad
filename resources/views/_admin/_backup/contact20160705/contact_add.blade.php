@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
       <div class="col1">
	       {!! Html::link('/dnradmin/contact','Contact') !!} &raquo; Create new contact
        </div>   
    </div>
    

    
   {!! Form::open(array('url' => '/dnradmin/contact/new', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
    @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif 
     @if (Session::has('error'))
           <div class="error_text">{!!Session::get('error')!!}</div>
     @endif     	
      <ul>
        <li>Contact Information</li>
        
        
        
        
        <li class=boxfields>
          <dl>
            <dt>First name</dt>
            <dd>{!! Form::text('firstname','',array('size'=>'50','class'=>'required')) !!}
                 @if($errors->contact->first('firstname'))
                    <div class="error">{!!$errors->contact->first('firstname')!!}</div>
                 @endif
            </dd>
          </dl> 
           <dl>
            <dt>Last name</dt>
            <dd>{!! Form::text('lastname','',array('size'=>'50','class'=>'required')) !!}
                 @if($errors->contact->first('lastname'))
                    <div class="error">{!!$errors->contact->first('lastname')!!}</div>
                 @endif
            </dd>
          </dl> 
           <dl>
            <dt>Email Address</dt>
            <dd>{!! Form::email('email','',array('size'=>'50','class'=>'required','id'=>'email')) !!}
                 @if($errors->contact->first('email'))
                    <div class="error">{!!$errors->contact->first('email')!!}</div>
                 @endif
            </dd>
          </dl> 
           <dl>
            <dt>Phone no</dt>
            <dd>{!! Form::text('phone','',array('size'=>'50','pattern'=>'\d{3}[\-]\d{3}[\-]\d{4}')) !!} <span>eg 123-456-7890</span></dd>
          </dl> 
          <dl>
            <dt>Subject</dt>
            <dd>{!! Form::text('subject','',array('size'=>'50')) !!}
                 @if($errors->contact->first('subject'))
                    <div class="error">{!!$errors->contact->first('subject')!!}</div>
                 @endif
            </dd>
          </dl> 
                  
        </li>
        
      </ul>
            
      <ul>
        <li>Comments</li>
        <li class=boxfields>
        	{!! Form::textarea('comments','',array('id'=>'mods2')) !!}
               @if($errors->contact->first('comments'))
                    <div class="error">{!!$errors->contact->first('comments')!!}</div>
                 @endif
        </li>
      </ul>
      
      
            

      <div class=clear><!-- Clear Section --></div>   
      	{!! Form::submit('',array('name'=>'saveinfo'))!!} &nbsp; {!! Form::reset('',array('name'=>'reset'))!!} 
        
    {!! Form::close() !!}
    
  </article>
  

@stop

@section('headercodes')    
  {!! Html::style('_admin/assets/css/pagination.css') !!}  
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
       
    
@stop