@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class="col1">
    
       	  {!! Html::link('/dnradmin/shop-owner',' Shop Owner') !!} &raquo; Update Shop Owner
    
       </div>
    </div>
    
  	
    
   {!! Form::open(array('url' => '/dnradmin/shop-owner/edit/'.$shopOwner->fldShopOwnerID, 'method' => 'post', 'id' => 'pageform', 'files' => true)) !!}
     @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif    
     @if(Session::has('email_error')) 
      <div class="error_text">{!!Session::get('email_error')!!}</div>
    @endif
     
    <table border="0" width="1000px;" style="margin-bottom:10px; padding:10px 10px">
         <tr>
          <td style="width:725px; margin-right:10px;" valign="top"> 
      <ul style="width:725px;">
        <li style="width:705px;">Shop Owner Information</li>
        
        <li class=boxfields style="width:705px;" >
         
        <dl>
            <dt>First name</dt>
            <dd style="width:547px !important;">{!! Form::text('firstname',$shopOwner->fldShopOwnerFirstname,array('size'=>'50','class'=>'required')) !!}
                 @if($errors->shopOwner->first('firstname'))
                    <div class="error">{!!$errors->shopOwner->first('firstname')!!}</div>
                 @endif
            </dd>
          </dl> 
           <dl>
            <dt>Last name</dt>
            <dd style="width:547px !important;">{!! Form::text('lastname',$shopOwner->fldShopOwnerLastname,array('size'=>'50','class'=>'required')) !!}
                 @if($errors->shopOwner->first('lastname'))
                    <div class="error">{!!$errors->shopOwner->first('lastname')!!}</div>
                 @endif
            </dd>
          </dl> 
           <dl>
            <dt>Email Address</dt>
            <dd style="width:547px !important;">{!! Form::email('email',$shopOwner->fldShopOwnerEmail,array('size'=>'50','class'=>'required')) !!}
                 @if($errors->shopOwner->first('email'))
                    <div class="error">{!!$errors->shopOwner->first('email')!!}</div>
                 @endif
            </dd>
          </dl>                       
           <dl>
            <dt>Password</dt>
            <dd style="width:547px !important;">
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
            </dd>
          </dl> 
          <dl>
            <dt>Phone no</dt>
            <dd style="width:547px !important;">{!! Form::text('phone',$shopOwner->fldShopOwnerPhoneNo,array('size'=>'50','pattern'=>'\d{3}[\-]\d{3}[\-]\d{4}')) !!} <span>eg 123-456-7890</span></dd>
          </dl>
          <dl>
            <dt>Address</dt>
            <dd style="width:547px !important;">{!! Form::text('address',$shopOwner->fldShopOwnerAddress,array('size'=>'50')) !!}
                @if($errors->shopOwner->first('address'))
                    <div class="error">{!!$errors->shopOwner->first('address')!!}</div>
                 @endif
            </dd>
          </dl>
          <dl>
            <dt>Gender</dt>
            <dd style="width:547px !important;">{!! Form::radio('gender', 'Male',$shopOwner->fldShopOwnerGender=="Male" ? 1 : 0) !!} Male {!! Form::radio('gender', 'Female',$shopOwner->fldShopOwnerGender=="Female" ? 1 : 0) !!} Female</dd>
          </dl>
          <dl>
            <dt>Birthdate</dt>
            <dd style="width:547px !important;"><input type="text" data-uk-datepicker="{format:'YYYY-MM-DD'}" name="bday" size="50" value="{{$shopOwner->fldShopOwnerBirthDate=="0000-00-00" ? "" : $shopOwner->fldShopOwnerBirthDate}}"></dd>
          </dl>          
          </li>
      </ul>
       </td>
           <td style="width:265px; vertical-align:top">
                                   
                   <div style="background:#fff; border:#ccc 1px solid; width:245px; min-height:100px; margin-bottom:10px;">
                      <p style="padding:5px 5px; background:#666; color:#fff"><strong>Sales Manager</strong></p>                          
                      <div id="searchResult" style="height:288px;width:245px; overflow:scroll">
                          <table border="0">  
                              @foreach($manager as $managers)
                                  <tr>
                                       <td><input type="radio" name="manager_id" value="{{$managers->fldManagerID}}" {{$managers->fldManagerID==$shopOwner->fldShopOwnerManagerID ? 'checked' : ""}} /> {{ $managers->fldManagerFirstname . ' ' . $managers->fldManagerLastname}}</td>
                                    </tr>
                              @endforeach
                           </table>
                      </div>      
                   </div>
                   
          </td>
          </tr>
          </table>

	
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