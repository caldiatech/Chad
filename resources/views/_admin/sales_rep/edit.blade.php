@extends('layouts._admin.base')

@section('content')
   <article>
    <div id=page_control>
      <div class="col2">
    
          {!! Html::link('/dnradmin/sales-rep',SALESREP_MANAGEMENT) !!} &raquo; Update {{ SALESREP_MANAGEMENT }}
    
       </div>
    </div>
    
    
    
   {!! Form::open(array('url' => '/dnradmin/sales-rep/edit/'.$manager->fldManagerID, 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')) !!}
     @if (Session::has('success'))
           <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
    @endif    
     @if(Session::has('email_error')) 
      <div class="uk-alert uk-alert-danger">{!!Session::get('email_error')!!}</div>
    @endif
    
    <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>{{ SALESREP_MANAGEMENT }} Information</li>
               <li class="boxfields">

                     <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">First name</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::text('firstname',$manager->fldManagerFirstname,array('size'=>'50','class'=>'required')) !!}
                          @if($errors->manager->first('firstname'))
                              <div class="error">{!!$errors->manager->first('firstname')!!}</div>
                           @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Last name</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::text('lastname',$manager->fldManagerLastname,array('size'=>'50','class'=>'required')) !!}
                          @if($errors->manager->first('lastname'))
                              <div class="error">{!!$errors->manager->first('lastname')!!}</div>
                           @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Email Address</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                        {!! Form::email('email',$manager->fldManagerEmail,array('size'=>'50','class'=>'required')) !!}
                         @if($errors->manager->first('email'))
                            <div class="error">{!!$errors->manager->first('email')!!}</div>
                         @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Password</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
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
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Phone no</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                        {!! Form::text('phone',$manager->fldManagerPhoneNo,array('size'=>'50','pattern'=>'\d{3}[\-]\d{3}[\-]\d{4}')) !!} <small>eg 123-456-7890</small>
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Address</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                        {!! Form::text('address',$manager->fldManagerAddress,array('size'=>'50')) !!}
                          @if($errors->manager->first('address'))
                              <div class="error">{!!$errors->manager->first('address')!!}</div>
                           @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Gender</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 radio-cat">
                        {!! Form::radio('gender', 'Male',$manager->fldManagerGender=='Male' ? 1 :0) !!} Male {!! Form::radio('gender', 'Female',$manager->fldManagerGender=='Female' ? 1 :0) !!} Female
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Birthdate</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1">
                        <input type="text" data-uk-datepicker="{format:'YYYY-MM-DD'}" name="bday" size="50" value="{{$manager->fldManagerBirthDate == "0000-00-00" ? "" : $manager->fldManagerBirthDate}}">
                      </div>
                   </div>


               </li>
            </ul>
        </div>
    </div>  

     @if(isset($braintreeMerchant->funding['routingNumber']))
         <div class="uk-grid">
            <div class="uk-width-large-1-1 uk-width-small-1-1">
                <ul>
                   <li>Banking Information</li>
                   <li class="boxfields">

                         <div class="uk-grid">
                            <div class="uk-width-large-1-10 uk-width-small-1-1">Bank Name</div>
                            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                              {!! Form::text('bankname',$manager->fldManagerBankName,array('size'=>'50','class'=>'required','disabled')) !!}
                            </div>
                         </div>

                          <div class="uk-grid">
                            <div class="uk-width-large-1-10 uk-width-small-1-1">Account Number</div>
                            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                               {!! Form::text('accno',isset($braintreeMerchant->funding['accountNumberLast4']) ? '*******'.$braintreeMerchant->funding['accountNumberLast4'] : "",array('size'=>'50','class'=>'required','disabled')) !!}
                            </div>
                         </div>

                         <div class="uk-grid">
                            <div class="uk-width-large-1-10 uk-width-small-1-1">Type Of Account</div>
                            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                               {!! Form::email('typeacc',$manager->fldManagerTypeofAccount,array('size'=>'50','class'=>'required','disabled')) !!}
                            </div>
                         </div>

                         <div class="uk-grid">
                            <div class="uk-width-large-1-10 uk-width-small-1-1">Routing Number</div>
                            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                               {!! Form::email('typeacc',isset($braintreeMerchant->funding['routingNumber']) ? $braintreeMerchant->funding['routingNumber'] : "",array('size'=>'50','class'=>'required','disabled')) !!}
                            </div>
                         </div>

                         <div class="uk-grid">
                            <div class="uk-width-large-1-10 uk-width-small-1-1">Banking Address</div>
                            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                                {!! Form::email('typeacc',isset($braintreeMerchant->individual['address']['streetAddress']) ? $braintreeMerchant->individual['address']['streetAddress'] : "",array('size'=>'50','class'=>'required','disabled')) !!}
                            </div>
                         </div>

                          <div class="uk-grid">
                            <div class="uk-width-large-1-10 uk-width-small-1-1">Banking City</div>
                            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                                {!! Form::email('typeacc',isset($braintreeMerchant->individual['address']['locality']) ? $braintreeMerchant->individual['address']['locality'] : "",array('size'=>'50','class'=>'required','disabled')) !!}
                            </div>
                         </div>

                         <div class="uk-grid">
                            <div class="uk-width-large-1-10 uk-width-small-1-1">State</div>
                            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                               {!! Form::email('typeacc',isset($braintreeMerchant->individual['address']['region']) ? $braintreeMerchant->individual['address']['region'] : "",array('size'=>'50','class'=>'required','disabled')) !!}
                            </div>
                         </div>

                         <div class="uk-grid">
                            <div class="uk-width-large-1-10 uk-width-small-1-1">Zip</div>
                            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                               {!! Form::email('typeacc',isset($braintreeMerchant->individual['address']['postalCode']) ? $braintreeMerchant->individual['address']['postalCode'] : "",array('size'=>'50','class'=>'required','disabled')) !!}
                            </div>
                         </div>


                   </li>
                </ul>
            </div>
         </div>                    
     
     @endif

     @if(isset($braintreeClient->firstName))

         <div class="uk-grid">
            <div class="uk-width-large-1-1 uk-width-small-1-1">
                <ul>
                   <li>Credit Card Information</li>
                   <li class="boxfields">

                        <div class="uk-grid">
                            <div class="uk-width-large-1-10 uk-width-small-1-1">First name</div>
                            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                               {!! Form::text('bankname',isset($braintreeClient->firstName) ? $braintreeClient->firstName : "",array('size'=>'50','class'=>'required','disabled')) !!}  
                            </div>
                         </div>

                         <div class="uk-grid">
                            <div class="uk-width-large-1-10 uk-width-small-1-1">Last name</div>
                            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                               {!! Form::text('accno',isset($braintreeClient->lastName) ? $braintreeClient->lastName : "",array('size'=>'50','class'=>'required','disabled')) !!}
                            </div>
                         </div>

                         <div class="uk-grid">
                            <div class="uk-width-large-1-10 uk-width-small-1-1">Credit Card No</div>
                            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                               {!! Form::email('typeacc',isset($braintreeClient->creditCards{0}->maskedNumber) ? $braintreeClient->creditCards{0}->maskedNumber : "",array('size'=>'50','class'=>'required','disabled')) !!}
                            </div>
                         </div>

                         <div class="uk-grid">
                            <div class="uk-width-large-1-10 uk-width-small-1-1">CVV</div>
                            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                                 {!! Form::email('typeacc',$manager->fldManagerCVV,array('size'=>'50','class'=>'required','disabled')) !!}
                            </div>
                         </div>

                          <div class="uk-grid">
                            <div class="uk-width-large-1-10 uk-width-small-1-1">Expiration Date</div>
                            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                                 {!! Form::email('typeacc',isset($braintreeClient->creditCards{0}->expirationMonth) ? $braintreeClient->creditCards{0}->expirationMonth . '/' . $braintreeClient->creditCards{0}->expirationYear :  "",array('size'=>'50','class'=>'required','disabled')) !!}
                            </div>
                         </div>

                   </li>
                </ul>
            </div>
         </div>       


     @endif
     


   
  
      <div class=clear><!-- Clear Section --></div>   
        {!! Form::submit('Save Record',array('name'=>'saveinfo','class'=>'uk-button uk-button-success'))!!} 
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