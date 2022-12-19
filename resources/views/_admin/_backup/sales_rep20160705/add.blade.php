@extends('layouts._admin.base')

@section('content')
   <article>
    <div id=page_control>
      <div class="col1">
    
          {!! Html::link('/dnradmin/sales-rep',' Sales Rep') !!} &raquo; Add Sales Rep
    
       </div>
    </div>
    
    
    
   {!! Form::open(array('url' => '/dnradmin/sales-rep/new', 'method' => 'post', 'id' => 'pageform', 'files' => true)) !!}
     @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif    
     @if(Session::has('email_error')) 
      <div class="error_text">{!!Session::get('email_error')!!}</div>
    @endif
     
     
      <ul>
        <li>Sales Rep Information</li>
        
        <li class=boxfields >
         
        <dl>
            <dt>First name</dt>
            <dd>{!! Form::text('firstname','',array('size'=>'50','class'=>'required')) !!}
                 @if($errors->manager->first('firstname'))
                    <div class="error">{!!$errors->manager->first('firstname')!!}</div>
                 @endif
            </dd>
          </dl> 
           <dl>
            <dt>Last name</dt>
            <dd>{!! Form::text('lastname','',array('size'=>'50','class'=>'required')) !!}
                 @if($errors->manager->first('lastname'))
                    <div class="error">{!!$errors->manager->first('lastname')!!}</div>
                 @endif
            </dd>
          </dl> 
           <dl>
            <dt>Email Address</dt>
            <dd>{!! Form::email('email','',array('size'=>'50','class'=>'required')) !!}
                 @if($errors->manager->first('email'))
                    <div class="error">{!!$errors->manager->first('email')!!}</div>
                 @endif
            </dd>
          </dl>                       
           <dl>
            <dt>Password</dt>
            <dd>
                <input type="password" name="password" id="password-fld" size=50 class="required">
                <table border=0>
                    <tr>
                        <td style="padding-right:5px;"> <i class="uk-icon uk-icon-check-circle icon-color" id="passveryweak"></i> at least 8 char</td>
                        <td style="padding-right:5px;"> <i class="uk-icon uk-icon-check-circle icon-color" id="passweak"></i> an uppercase</td>
                        <td style="padding-right:5px;"> <i class="uk-icon uk-icon-check-circle icon-color" id="passmedium"></i> a number</td>
                        <td style="padding-right:5px;"> <i class="uk-icon uk-icon-check-circle icon-color" id="passstrong"></i> special char</td>
                    </tr>  
                </table>  
                 @if($errors->manager->first('password'))
                    <div class="error">{!!$errors->manager->first('password')!!}</div>
                 @endif
            </dd>
          </dl> 
          <dl>
            <dt>Phone no</dt>
            <dd>{!! Form::text('phone','',array('size'=>'50','pattern'=>'\d{3}[\-]\d{3}[\-]\d{4}')) !!} <span>eg 123-456-7890</span></dd>
          </dl>
          <dl>
            <dt>Address</dt>
            <dd>{!! Form::text('address','',array('size'=>'50')) !!}
                 @if($errors->manager->first('address'))
                    <div class="error">{!!$errors->manager->first('address')!!}</div>
                 @endif
            </dd>
          </dl>
          <dl>
            <dt>Gender</dt>
            <dd>{!! Form::radio('gender', 'Male',1) !!} Male {!! Form::radio('gender', 'Female') !!} Female</dd>
          </dl>
          <dl>
            <dt>Birthdate</dt>
            <dd><input type="text" data-uk-datepicker="{format:'YYYY-MM-DD'}" name="bday" size="50"></dd>
          </dl>          
          <dl>              
            <dt>Promo Code</dt>
            <dd><strong>{!! $promocode !!}</strong></dd>
          </dl>  
          {!! Form::hidden('promocode',$promocode) !!}
          </li>

      </ul>

  
      <div class=clear><!-- Clear Section --></div>   
        {!! Form::submit('',array('name'=>'saveinfo'))!!}
     &nbsp; 
    {!! Form::reset('',array('name'=>'reset'))!!} 
        
    {!! Form::close() !!}
    
  </article>
  

@stop

@section('headercodes')    
  {!! Html::style('_admin/assets/js/jq-ui/jquery-ui.css') !!}   
  {!! Html::style('_front/plugins/uikit/css/uikit.css') !!} 
  {!! Html::style('_front/plugins/uikit/css/components/form-select.css') !!}
  {!! Html::style('_front/plugins/uikit/css/components/datepicker.css') !!}
  {!! Html::style('_front/plugins/uikit/css/components/autocomplete.min.css') !!}
@stop

@section('extracodes')
  <script>
    var mypath = "{!! url('/') !!}";
  </script>
     

    {!! Html::script('_admin/manager/tinymce/tiny_mce.js','') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
    {!! Html::script('_admin/assets/js/customValidation.js','') !!}
    
    {!! Html::script('_admin/manager/tinymce/styles/mods5.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-ui.js','') !!}
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
   
  {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
  {!! Html::script('_front/plugins/uikit/js/uikit.js','') !!}
  {!! Html::script('_front/plugins/uikit/js/components/form-select.js','') !!}
  {!! Html::script('_front/plugins/uikit/js/components/datepicker.js','') !!}
  {!! Html::script('_front/plugins/uikit/js/components/autocomplete.min.js','') !!}


   
   
@stop