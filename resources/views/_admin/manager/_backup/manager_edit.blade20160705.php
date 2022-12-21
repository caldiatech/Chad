@extends('layouts._admin.base')

@section('content')
   <article>
    <div id=page_control>
      <div class="col1">
    
          {!! Html::link('/dnradmin/manager',' Sales Manager') !!} &raquo; Update Sales Manager
    
       </div>
    </div>
    
    
    
   {!! Form::open(array('url' => '/dnradmin/manager/edit/'.$manager->fldManagerID, 'method' => 'post', 'id' => 'pageform', 'files' => true)) !!}
     @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif    
     @if(Session::has('email_error')) 
      <div class="error_text">{!!Session::get('email_error')!!}</div>
    @endif
     
     
      <ul>
        <li>Sales Manager Information</li>
        
        <li class=boxfields >
         
        <dl>
            <dt>First name</dt>
            <dd>{!! Form::text('firstname',$manager->fldManagerFirstname,array('size'=>'50','class'=>'required')) !!}
                @if($errors->manager->first('firstname'))
                    <div class="error">{!!$errors->manager->first('firstname')!!}</div>
                 @endif
            </dd>
          </dl> 
           <dl>
            <dt>Last name</dt>
            <dd>{!! Form::text('lastname',$manager->fldManagerLastname,array('size'=>'50','class'=>'required')) !!}
                @if($errors->manager->first('lastname'))
                    <div class="error">{!!$errors->manager->first('lastname')!!}</div>
                 @endif
            </dd>
          </dl> 
           <dl>
            <dt>Email Address</dt>
            <dd>{!! Form::email('email',$manager->fldManagerEmail,array('size'=>'50','class'=>'required')) !!}
                 @if($errors->manager->first('email'))
                    <div class="error">{!!$errors->manager->first('email')!!}</div>
                 @endif
            </dd>
          </dl>                       
           <dl>
            <dt>Password</dt>
            <dd>
                <input type="password" name="password" id="password-fld" size="50">
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
            <dd>{!! Form::text('phone',$manager->fldManagerPhoneNo,array('size'=>'50','pattern'=>'\d{3}[\-]\d{3}[\-]\d{4}')) !!} <span>eg 123-456-7890</span></dd>
          </dl>
          <dl>
            <dt>Address</dt>
            <dd>{!! Form::text('address',$manager->fldManagerAddress,array('size'=>'50')) !!}
                @if($errors->manager->first('address'))
                    <div class="error">{!!$errors->manager->first('address')!!}</div>
                 @endif
            </dd>
          </dl>
          <dl>
            <dt>Gender</dt>
            <dd>{!! Form::radio('gender', 'Male',$manager->fldManagerGender=='Male' ? 1 :0) !!} Male {!! Form::radio('gender', 'Female',$manager->fldManagerGender=='Female' ? 1 :0) !!} Female</dd>
          </dl>
          <dl>
            <dt>Birthdate</dt>
            <dd><input type="text" data-uk-datepicker="{format:'YYYY-MM-DD'}" name="bday" size="50" value="{{$manager->fldManagerBirthDate == "0000-00-00" ? "" : $manager->fldManagerBirthDate}}"></dd>
          </dl>
           <dl>
            <dt>Status</dt>
            <dd>{!! Form::radio('status', 1,$manager->fldManagerStatus==1 ? 1 :0) !!} Pending {!! Form::radio('status',2,$manager->fldManagerStatus==2 ? 1 :0) !!} Active</dd>
          </dl>
                                    
          </li>
      </ul>

      @if(isset($braintreeMerchant->funding['routingNumber']))
          <ul>
        <li>Banking Information</li>
        
        <li class=boxfields >
         
        <dl>
            <dt>Bank Name</dt>
            <dd>{!! Form::text('bankname',$manager->fldManagerBankName,array('size'=>'50','class'=>'required','disabled')) !!}               
            </dd>
          </dl> 
           <dl>
            <dt>Account Number</dt>
            <dd>{!! Form::text('accno',isset($braintreeMerchant->funding['accountNumberLast4']) ? '*******'.$braintreeMerchant->funding['accountNumberLast4'] : "",array('size'=>'50','class'=>'required','disabled')) !!}
                
            </dd>
          </dl> 
           <dl>
            <dt>Type Of Account</dt>
            <dd>{!! Form::email('typeacc',$manager->fldManagerTypeofAccount,array('size'=>'50','class'=>'required','disabled')) !!}
                 
            </dd>
          </dl> 

          <dl>
            <dt>Routing Number</dt>
            <dd>{!! Form::email('typeacc',isset($braintreeMerchant->funding['routingNumber']) ? $braintreeMerchant->funding['routingNumber'] : "",array('size'=>'50','class'=>'required','disabled')) !!}
                 
            </dd>
          </dl>                       
           
          <dl>
            <dt>Banking Address</dt>
            <dd>{!! Form::email('typeacc',isset($braintreeMerchant->individual['address']['streetAddress']) ? $braintreeMerchant->individual['address']['streetAddress'] : "",array('size'=>'50','class'=>'required','disabled')) !!}
                 
            </dd>
          </dl>  

          <dl>
            <dt>Banking City</dt>
            <dd>{!! Form::email('typeacc',isset($braintreeMerchant->individual['address']['locality']) ? $braintreeMerchant->individual['address']['locality'] : "",array('size'=>'50','class'=>'required','disabled')) !!}
                 
            </dd>
          </dl>  

          <dl>
            <dt>State</dt>
            <dd>{!! Form::email('typeacc',isset($braintreeMerchant->individual['address']['region']) ? $braintreeMerchant->individual['address']['region'] : "",array('size'=>'50','class'=>'required','disabled')) !!}
                 
            </dd>
          </dl>

          <dl>
            <dt>Zip</dt>
            <dd>{!! Form::email('typeacc',isset($braintreeMerchant->individual['address']['postalCode']) ? $braintreeMerchant->individual['address']['postalCode'] : "",array('size'=>'50','class'=>'required','disabled')) !!}
                 
            </dd>
          </dl>  
                                    
          </li>
      </ul>
      @endif

      @if(isset($braintreeClient->firstName))
          <ul>
        <li>Credit Card Information</li>
        
        <li class=boxfields >
         
        <dl>
            <dt>First name</dt>
            <dd>{!! Form::text('bankname',isset($braintreeClient->firstName) ? $braintreeClient->firstName : "",array('size'=>'50','class'=>'required','disabled')) !!}               
            </dd>
          </dl> 
           <dl>
            <dt>Last name</dt>
            <dd>{!! Form::text('accno',isset($braintreeClient->lastName) ? $braintreeClient->lastName : "",array('size'=>'50','class'=>'required','disabled')) !!}
                
            </dd>
          </dl> 
           <dl>
            <dt>Credit Card No</dt>
            <dd>{!! Form::email('typeacc',isset($braintreeClient->creditCards{0}->maskedNumber) ? $braintreeClient->creditCards{0}->maskedNumber : "",array('size'=>'50','class'=>'required','disabled')) !!}
                 
            </dd>
          </dl> 

          <dl>
            <dt>CVV</dt>
            <dd>{!! Form::email('typeacc',$manager->fldManagerCVV,array('size'=>'50','class'=>'required','disabled')) !!}
                 
            </dd>
          </dl>                       
           
          <dl>
            <dt>Expiration Date</dt>
            <dd>{!! Form::email('typeacc',isset($braintreeClient->creditCards{0}->expirationMonth) ? $braintreeClient->creditCards{0}->expirationMonth . '/' . $braintreeClient->creditCards{0}->expirationYear :  "",array('size'=>'50','class'=>'required','disabled')) !!}
                 
            </dd>
          </dl>  

          
                                    
          </li>
      </ul>
      @endif
  
      <div class=clear><!-- Clear Section --></div>   
        {!! Form::submit('',array('name'=>'saveinfo'))!!}
     
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
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js') !!}
    {!! Html::script('_admin/assets/js/customValidation.js') !!}
    
    {!! Html::script('_admin/manager/tinymce/styles/mods5.js') !!}
    {!! Html::script('_admin/assets/js/jquery-ui.js') !!}
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
   
   {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}
  {!! Html::script('_front/plugins/uikit/js/uikit.js') !!}
  {!! Html::script('_front/plugins/uikit/js/components/form-select.js') !!}
  {!! Html::script('_front/plugins/uikit/js/components/datepicker.js') !!}
  {!! Html::script('_front/plugins/uikit/js/components/autocomplete.min.js') !!} 
   
@stop