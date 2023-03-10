@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
       <div class="col2">
	       {!! Html::link('/dnradmin/contact',Contact) !!} &raquo; Create new {{ Contact }}
        </div>   
    </div>
    

    
   {!! Form::open(array('url' => '/dnradmin/contact/new', 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')); !!}
    @if (Session::has('success'))
           <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
    @endif 
    @if (Session::has('error'))
           <div class="uk-alert uk-alert-danger">{!!Session::get('error')!!}</div>
    @endif     	

     <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>Contact Information</li>
               <li class="boxfields">

                  <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">First name</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::text('firstname','',array('size'=>'50','class'=>'required','id'=>'firstname','maxlength'=>"50")) !!}
                           @if($errors->contact->first('firstname'))
                              <div class="error">{!!$errors->contact->first('firstname')!!}</div>
                           @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Last name</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::text('lastname','',array('size'=>'50','class'=>'required','id'=>'lastname','maxlength'=>"50")) !!}
                         @if($errors->contact->first('lastname'))
                            <div class="error">{!!$errors->contact->first('lastname')!!}</div>
                         @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Email Address</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::email('email','',array('size'=>'50','class'=>'required','id'=>'email')) !!}
                           @if($errors->contact->first('email'))
                              <div class="error">{!!$errors->contact->first('email')!!}</div>
                           @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Phone no</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::text('phone','',array('size'=>'50','pattern'=>'\d{3}[\-]\d{3}[\-]\d{4}')) !!} <small>eg 123-456-7890</small>
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Subject</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::text('subject','',array('size'=>'50')) !!}
                         @if($errors->contact->first('subject'))
                            <div class="error">{!!$errors->contact->first('subject')!!}</div>
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
               <li>Comments</li>
               <li class="boxfields">
                   {!! Form::textarea('comments','',array('id'=>'mods2')) !!}
                     @if($errors->contact->first('comments'))
                          <div class="error">{!!$errors->contact->first('comments')!!}</div>
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
       
    
@stop