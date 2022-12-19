@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
       <div class="col1">
	       {!! Html::link('/dnradmin/client','Clients') !!}  &raquo; Update client   
        </div>   
    </div>
    
  	
    
   {!! Form::open(array('url' => '/dnradmin/client/edit/'.$client->fldClientID, 'method' => 'post', 'id' => 'pageform', 'files' => true)) !!}
    @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif    
     @if(Session::has('email_error')) 
      <div class="error_text">{!!Session::get('email_error')!!}</div>
    @endif
     @if(Session::has('username_error')) 
      <div class="error_text">{!!Session::get('username_error')!!}</div>
    @endif  	
      <ul>
        <li>Client Information</li>
        
        <li class=boxfields>
          <dl>
            <dt>First name</dt>
            <dd>{!! Form::text('firstname',$client->fldClientFirstname,array('size'=>'50','class'=>'required','required')) !!}
                 @if($errors->client->first('firstname'))
                    <div class="error">{!!$errors->client->first('firstname')!!}</div>
                 @endif
            </dd>
          </dl> 
           <dl>
            <dt>Last name</dt>
            <dd>{!! Form::text('lastname',$client->fldClientLastname,array('size'=>'50','class'=>'required','required')) !!}
                 @if($errors->client->first('lastname'))
                    <div class="error">{!!$errors->client->first('lastname')!!}</div>
                 @endif
            </dd>
          </dl> 
          <dl>
            <dt>Phone Number</dt>
            <dd>
		{!! Form::text('phone',$client->fldClientContact,array('size'=>'50','pattern'=>'\d{3}[\-]\d{3}[\-]\d{4}','class'=>'required','required')) !!} <span>eg 123-456-7890</span></dd>

                 @if($errors->client->first('phone'))
                    <div class="error">{!!$errors->client->first('phone')!!}</div>
                 @endif
            </dd>
          </dl>
           <dl>
            <dt>Email Address</dt>
            <dd>{!! Form::email('email',$client->fldClientEmail,array('size'=>'50','class'=>'required','id'=>'email','required')) !!}
                  @if($errors->client->first('email'))
                    <div class="error">{!!$errors->client->first('email')!!}</div>
                 @endif
            </dd>
          </dl> 
          
           <dl>
            <dt>Password</dt>
            <dd>
                 <input type="password" name="password" id="password-fld" size=50>
                <table border=0>
                    <tr>
                        <td style="padding-right:5px;"> <i class="uk-icon uk-icon-check-circle icon-color" id="passveryweak"></i> at least 8 char</td>
                        <td style="padding-right:5px;"> <i class="uk-icon uk-icon-check-circle icon-color" id="passweak"></i> an uppercase</td>
                        <td style="padding-right:5px;"> <i class="uk-icon uk-icon-check-circle icon-color" id="passmedium"></i> a number</td>
                        <td style="padding-right:5px;"> <i class="uk-icon uk-icon-check-circle icon-color" id="passstrong"></i> special char</td>
                    </tr>  
                </table> 
                 @if($errors->client->first('password'))
                    <div class="error">{!!$errors->client->first('password')!!}</div>
                 @endif 
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
  {!! Html::style('_admin/assets/plugins/password/strength.css') !!}
@stop

@section('extracodes')
   {!! Html::style('_front/plugins/uikit/css/uikit.css') !!}
   {!! Html::script('_front/plugins/uikit/js/uikit.js','') !!}

	<script>
		var mypath = "{!! url('/') !!}";
	</script>
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js','') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
    {!! Html::script('_admin/assets/js/customValidation.js','') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js','') !!}
    {!! Html::script('_admin/plugins/password/strength.js','') !!}
    <script>
      $(document).ready(function($) {  
          $('#password-fld').strength({
              strengthClass: 'strength',
              strengthMeterClass: 'strength_meter',
              strengthButtonClass: 'button_strength',
              strengthButtonText: 'Show Password',
              strengthButtonTextToggle: 'Hide Password'
          });
      });
    </script>         
    
@stop