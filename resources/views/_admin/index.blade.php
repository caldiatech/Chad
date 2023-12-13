@extends('layouts._admin.login')

@section('content')

   <form method="post" id="loginpanel" class="edge uk-panel uk-panel-box uk-form">
       <img class="uk-margin-bottom uk-border-circle" width="140" height="120" src="{{url('_admin/assets/images/clarking-adminlogo.png')}}" alt="">
       
       <h1 class="uk-text-center">Clarkin</h1>
       <h2 class="uk-text-center">Welcome Administrator</h2>
       <div class="uk-form-row">
           
         @if($error) 
           <div class="error" style="padding:10px 10px; color: #fb6958; margin-top: -30px;">{{ $error }}</div>
        @endif 
   
    
      <div class="uk-form-row un">
            <i class="pe-7s-user"></i>
            <input class="pad-left" type="text" name="username" id="username" placeholder="Username" required>    
        </div>
        <div class="uk-form-row pw">
            <i class="pe-7s-door-lock"></i>
            <input class="pad-left" type="password" id="password" required placeholder="Password" name="password">    
        </div>
        <div class="uk-form-row sc">
            <input type="hidden" name="security" value="" id="security">
            <script language="javascript" type="text/javascript">showImage();</script> 
            <i class="pe-7s-unlock secu-i" style="margin-top:5px !important;"></i>
            <input  class="pad-left" placeholder="Security Code" type="text" name="code" id="code" maxlength="7">    
        </div>
        
        {!! csrf_field() !!}
        
        <div class="uk-form-row">
           
            <button type="submit" name="userlogin" id="validate-user" value="">Signin</button>

        </div>
        <div class="uk-form-row">
            <h6>Please enter your login credentials to start your Manager session. Your username and password are case-sensitive, so please enter them carefully.</h6>
        </div>
    </div>
       
  </form>

@stop

@section('headercodes')
  <script language="javascript">
  var theImages = new Array() 
  var theValue = new Array() 
  theImages[0] = '_admin/assets/captcha/captcha1.jpg'
  theImages[1] = '_admin/assets/captcha/captcha2.jpg'
  theImages[2] = '_admin/assets/captcha/captcha3.jpg'
  theImages[3] = '_admin/assets/captcha/captcha4.jpg'
  theValue[0] = 'dog';
  theValue[1] = 'rooster';
  theValue[2] = 'design';
  theValue[3] = 'company';
  var j = 0
  var p = theImages.length;
  var preBuffer = new Array()
  for (i = 0; i < p; i++){
     preBuffer[i] = new Image()
     preBuffer[i].src = theImages[i]
  }
  var whichImage = Math.round(Math.random()*(p-1));
  
  function showImage(){    
    document.write('<img src={!!url("'+theImages[whichImage]+'")!!} class=captcha>');
    document.getElementById('security').value= theValue[whichImage];
  }
</script>



@stop