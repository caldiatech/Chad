@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class="col2">
    
       	  {!! Html::link('/dnradmin/shop-owner',SHOPOWNER_MANAGEMENT) !!} &raquo; Update {{ SHOPOWNER_MANAGEMENT }}
    
       </div>
    </div>
    
  	
    
   {!! Form::open(array('url' => '/dnradmin/shop-owner/edit/'.$shopOwner->fldShopOwnerID, 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')) !!}
     @if (Session::has('success'))
           <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
    @endif    
     @if(Session::has('email_error')) 
      <div class="uk-alert uk-alert-danger">{!!Session::get('email_error')!!}</div>
    @endif


    <div class="uk-grid">
        <div class="uk-width-large-7-10 uk-width-small-1-1">
            <ul>
               <li>{{ SHOPOWNER_MANAGEMENT }}  Information</li>
               <li class="boxfields">

                    <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">First name</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::text('firstname',$shopOwner->fldShopOwnerFirstname,array('size'=>'50','class'=>'required','id'=>'firstname')) !!}
                         @if($errors->shopOwner->first('firstname'))
                            <div class="error">{!!$errors->shopOwner->first('firstname')!!}</div>
                         @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Last name</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::text('lastname',$shopOwner->fldShopOwnerLastname,array('size'=>'50','class'=>'required','id'=>'lastname')) !!}
                         @if($errors->shopOwner->first('lastname'))
                            <div class="error">{!!$errors->shopOwner->first('lastname')!!}</div>
                         @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Business name</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::text('business_name',$shopOwner->fldShopOwnerBusiness,array('size'=>'50')) !!}
                         @if($errors->shopOwner->first('business_name'))
                            <div class="error">{!!$errors->shopOwner->first('business_name')!!}</div>
                         @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Email Address</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::email('email',$shopOwner->fldShopOwnerEmail,array('size'=>'50','class'=>'required')) !!}
                         @if($errors->shopOwner->first('email'))
                            <div class="error">{!!$errors->shopOwner->first('email')!!}</div>
                         @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Password</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                           <input type="password" name="password" id="password-fld" size=50>
                            <table border=0>
                                <tr>
                                    <td style="padding-right:5px;"> <i class="uk-icon uk-icon-check-circle icon-color" id="passveryweak"></i> at least 8 char</td>
                                    <td style="padding-right:5px;"> <i class="uk-icon uk-icon-check-circle icon-color" id="passweak"></i> an uppercase</td>
                                    <td style="padding-right:5px;"> <i class="uk-icon uk-icon-check-circle icon-color" id="passmedium"></i> a number</td>
                                    <td style="padding-right:5px;"> <i class="uk-icon uk-icon-check-circle icon-color" id="passstrong"></i> special char</td>
                                </tr>  
                            </table>  
                             @if($errors->shopOwner->first('password'))
                                <div class="error">{!!$errors->shopOwner->first('password')!!}</div>
                             @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Phone no</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::text('phone',$shopOwner->fldShopOwnerPhoneNo,array('size'=>'50','class'=>'phone_us')) !!} 
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Address</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          {!! Form::text('address',$shopOwner->fldShopOwnerAddress,array('size'=>'50')) !!}
                          @if($errors->shopOwner->first('address'))
                              <div class="error">{!!$errors->shopOwner->first('address')!!}</div>
                           @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Gender</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 radio-cat">
                          {!! Form::radio('gender', 'Male',$shopOwner->fldShopOwnerGender=="Male" ? 1 : 0) !!} Male {!! Form::radio('gender', 'Female',$shopOwner->fldShopOwnerGender=="Female" ? 1 : 0) !!} Female
                      </div>
                   </div>

                    <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Birthdate</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          <input type="text" data-uk-datepicker="{format:'YYYY-MM-DD'}" name="bday" size="50" value="{{$shopOwner->fldShopOwnerBirthDate=="0000-00-00" ? "" : $shopOwner->fldShopOwnerBirthDate}}">
                      </div>
                   </div>


		  <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Promo Code</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         <strong>{{$shopOwner->fldShopOwnerPromoCode}}</strong>
                      </div>
                   </div>
	
                
               </li> 
            </ul>
        </div>

        <div class="uk-width-large-3-10 uk-width-small-1-1">
            <ul>
               <li>Sales Manager</li>
               <li class="boxfields"><div id="subcategory"></div>
                      <div id="searchResult" style="height:288px; overflow:scroll">
                          <table border="0" class="page_manager" style="width:292px !important; border:none; margin-top:-5px">  
                              @foreach($manager as $managers)
                                  <tr>
                                       <td class="radio-cat"><input type="radio" name="manager_id" value="{{$managers->fldManagerID}}" {{$managers->fldManagerID==$shopOwner->fldShopOwnerManagerID ? 'checked' : ""}} /> {{ $managers->fldManagerFirstname . ' ' . $managers->fldManagerLastname}}</td>
                                    </tr>
                              @endforeach
                           </table>
                      </div>     
                      
               </li>
            </ul>   
           
        </div>  
    </div>            
     
   
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
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js') !!}
    {!! Html::script('_admin/assets/js/customValidation.js') !!}
    
    {!! Html::script('_admin/manager/tinymce/styles/mods5.js') !!}
    {!! Html::script('_admin/assets/js/jquery-ui.js') !!}
    {!! Html::script('_admin/plugins/password/strength.js') !!}
    {!! Html::script('_front/assets/js/mask.js') !!}
	<script>			
	
	  $(document).ready(function($) {
  
          $('#password-fld').strength({
              strengthClass: 'strength',
              strengthMeterClass: 'strength_meter',
              strengthButtonClass: 'button_strength',
              strengthButtonText: 'Show Password',
              strengthButtonTextToggle: 'Hide Password'
          });

          isphone_valid = 0;
            $('.phone_us').mask('(000) 000-0000',{
              onComplete: function(cep) {
                $('.phone_us').css({'border':'1px solid green'});
                isphone_valid = 1;
              }, onInvalid: function(cep) {
                $('.phone_us').css({'border':'1px solid red'});
                isphone_valid = 0;
              }
            });

      }); 	  		
	</script> 
   
 {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}
  {!! Html::script('_front/plugins/uikit/js/uikit.js') !!}
  {!! Html::script('_front/plugins/uikit/js/components/form-select.js') !!}
  {!! Html::script('_front/plugins/uikit/js/components/datepicker.js') !!}
  {!! Html::script('_front/plugins/uikit/js/components/autocomplete.min.js') !!} 
   
   
@stop