@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
       <div class="col1">
	       {!! Html::link('/dnradmin/contact','Contact') !!} &raquo; Update contact
        </div>
    </div>
    
  
    
   {!! Form::open(array('url' => '/dnradmin/contact/edit/'.$contact->fldContactID, 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
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
            <dd>{!! Form::text('firstname',$contact->fldContactFirstname,array('size'=>'50','class'=>'required')) !!}
                 @if($errors->contact->first('firstname'))
                    <div class="error">{!!$errors->contact->first('firstname')!!}</div>
                 @endif
            </dd>
          </dl> 
           <dl>
            <dt>Last name</dt>
            <dd>{!! Form::text('lastname',$contact->fldContactLastname,array('size'=>'50','class'=>'required')) !!}
                @if($errors->contact->first('lastname'))
                    <div class="error">{!!$errors->contact->first('lastname')!!}</div>
                 @endif
            </dd>
          </dl> 
          <dl>
            <dt>Email Address</dt>
            <dd>{!! Form::email('email',$contact->fldContactEmail,array('size'=>'50','class'=>'required')) !!}
                @if($errors->contact->first('email'))
                    <div class="error">{!!$errors->contact->first('email')!!}</div>
                 @endif
            </dd>
          </dl> 
           <dl>
            <dt>Phone no</dt>
            <dd>{!! Form::text('phone',$contact->fldContactPhone,array('size'=>'50','pattern'=>'\d{3}[\-]\d{3}[\-]\d{4}')) !!} <span>eg 123-456-7890</span></dd>
          </dl> 
          <dl>
            <dt>Subject</dt>
            <dd>{!! Form::text('subject',$contact->fldContactSubject,array('size'=>'50')) !!}
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
        	{!! Form::textarea('comments',$contact->fldContactComments,array('id'=>'mods2')) !!}
                 @if($errors->contact->first('comments'))
                    <div class="error">{!!$errors->contact->first('comments')!!}</div>
                 @endif
        </li>
      </ul>
      
   
      
      
      <div class=clear><!-- Clear Section --></div>   
      	{!! Form::submit('',array('name'=>'saveinfo'))!!}
        
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
    {!! Html::script('_admin/assets/js/assets/js/jquery.pagination.js','') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js','') !!}
       
    
@stop