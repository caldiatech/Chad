@extends('layouts._admin.base')

@section('content')
   <article>
    <div id=page_control >
       <div class="col2">
            {!! Html::link('/dnradmin/settings/edit/'.$settings->fldAdministratorID,'Settings') !!} &raquo; Update Administrator   
         </div>  
    </div>
    
  
    
   {!! Form::open(array('url' => '/dnradmin/settings/edit/'.$settings->fldAdministratorID, 'method' => 'post', 'id' => 'pageform', 'files' => true)) !!}
      {!! Html::flash_msg_admin() !!}

      <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">

            <ul>
               <li>Administrator Information</li>
               <li class="boxfields">

                <div class="uk-grid">
                    <div class="uk-width-large-1-10 uk-width-small-1-1">Full Name</div>
                    <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                       {!! Form::text('fullname',$settings->fldAdministratorFullname,array('size'=>'50','class'=>'required')) !!}
                       {!! $errors->first('fullname', '<div class="uk-text-danger uk-text-small">:message</div>') !!}
                    </div>
                </div>

                <div class="uk-grid">
                    <div class="uk-width-large-1-10 uk-width-small-1-1">Email address</div>
                    <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                       {!! Form::email('email',$settings->fldAdministratorEmail,array('size'=>'50','class'=>'required')) !!}
                       {!! $errors->first('email', '<div class="uk-text-danger uk-text-small">:message</div>') !!}
                    </div>
                </div>

                <div class="uk-grid">
                    <div class="uk-width-large-1-10 uk-width-small-1-1">Phone no</div>
                    <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                       {!! Form::text('phone',$settings->fldAdministratorPhone,array('size'=>'50','pattern'=>'\d{3}[\-]\d{3}[\-]\d{4}')) !!} <span>eg 123-456-7890</span>
                       {!! $errors->first('phone', '<div class="uk-text-danger uk-text-small">:message</div>') !!}
                    </div>
                </div>

                <div class="uk-grid">
                    <div class="uk-width-large-1-10 uk-width-small-1-1">Username</div>
                    <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                       {!! Form::text('username',$settings->fldAdministratorUsername,array('size'=>'50','class'=>'required')) !!}
                       {!! $errors->first('username', '<div class="uk-text-danger uk-text-small">:message</div>') !!}
                    </div>
                </div>

                <div class="uk-grid">
                    <div class="uk-width-large-1-10 uk-width-small-1-1">Password</div>
                    <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                       <input type="password" name="password" id="password-fld" size="50" required>
                        <table border=0>
                            <tr>
                                <td style="padding-right:5px;"> <i class="uk-icon uk-icon-check-circle icon-color" id="passveryweak"></i> at least 8 char</td>
                                <td style="padding-right:5px;"> <i class="uk-icon uk-icon-check-circle icon-color" id="passweak"></i> an uppercase</td>
                                <td style="padding-right:5px;"> <i class="uk-icon uk-icon-check-circle icon-color" id="passmedium"></i> a number</td>
                                <td style="padding-right:5px;"> <i class="uk-icon uk-icon-check-circle icon-color" id="passstrong"></i> special char</td>
                            </tr>  
                        </table> 
                       {!! $errors->first('username', '<div class="uk-text-danger uk-text-small">:message</div>') !!}
                    </div>
                </div>

               </li>
          </ul>


          <ul>
               <li>Site Information</li>
               <li class="boxfields">

                <div class="uk-grid">
                    <div class="uk-width-large-1-10 uk-width-small-1-1">Site Name</div>
                    <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                       {!! Form::text('site_name',$settings->fldAdministratorSiteName,array('size'=>'50')) !!}
                       {!! $errors->first('site_name', '<div class="uk-text-danger uk-text-small">:message</div>') !!}
                    </div>
                </div>

                <div class="uk-grid">
                    <div class="uk-width-large-1-10 uk-width-small-1-1">Facebook</div>
                    <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                       {!! Form::text('facebook',$settings->fldAdministratorFacebook,array('size'=>'50')) !!}
                       {!! $errors->first('facebook', '<div class="uk-text-danger uk-text-small">:message</div>') !!}
                    </div>
                </div>

                <div class="uk-grid">
                    <div class="uk-width-large-1-10 uk-width-small-1-1">Twitter</div>
                    <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                       {!! Form::text('twitter',$settings->fldAdministratorTwitter,array('size'=>'50')) !!}
                       {!! $errors->first('twitter', '<div class="uk-text-danger uk-text-small">:message</div>') !!}
                    </div>
                </div>

                <div class="uk-grid">
                    <div class="uk-width-large-1-10 uk-width-small-1-1">LinkedIn</div>
                    <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                       {!! Form::text('linkedIn',$settings->fldAdministratorLinkedIn,array('size'=>'50')) !!}
                       {!! $errors->first('linkedIn', '<div class="uk-text-danger uk-text-small">:message</div>') !!}
                    </div>
                </div>

              </li>
          </ul>

        </div>
      </div>

      <div class="clear"><!-- Clear Section --></div>

      {!! Form::submit('Save Record', array('name'=>'saveinfo', 'class' => "uk-button uk-button-primary"))!!}
        
    {!! Form::close() !!}
    
  </article>
  

@stop

@section('headercodes')    
  {!! Html::style('_admin/assets/js/jq-ui/jquery-ui.css') !!}  
  {!! Html::style('_admin/assets/plugins/password/strength.css') !!}  
  {!! Html::script('_admin/assets/js/jquery-ui.js') !!}
@stop

@section('extracodes')
    {!! Html::style('_front/plugins/uikit/css/uikit.css') !!}
    {!! Html::script('_front/plugins/uikit/js/uikit.js') !!}
    {!! Html::script('_admin/assets/js/customValidation.js') !!}
    {!! Html::script('_admin/plugins/password/strength.js') !!}

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