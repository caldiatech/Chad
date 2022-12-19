@extends('layouts._admin.login')

@section('content')
   
   
   <form method="post" id="loginpanel" class="edge">

  	<div class='col1 right'>
      <h2><!-- ACM-II Powered by Dog and Rooster, Inc. --></h2>
      <h3><!-- Welcome to ACM-II --></h3>
      <p>Please enter your login credentials to start your Manager session. Your username and password are case-sensitive, so please enter them carefully.</p>
    </div>
   
    <div class=col2>
    	@if($error) 
        	<div class="error" style="background:#FFF; padding:10px 10px;">{{ $error }}</div>
        @endif 
    	<ul>
      	<li class=un>
            <label id="username">Username</label>
            <input type="text" name="username" id="username" required>            
        </li>
        <li class=pw>        	
            <label id="password">Password</label>
            <input type="password" id="password" required name="password">            
         </li>   
        <li class=sc>
            <label id="security_code">security code</label>            
            <input type="hidden" name="security" value="" id="security">
          <script language="javascript" type="text/javascript">showImage();</script>           
           <input type="text" name="code" id="code" maxlength="7">
        </li>
      </ul>
    </div>
    
    <div class=clear><!-- Clear Section --></div>
    {!! csrf_field() !!}
    <input type="submit" name="userlogin" id="validate-user" value="">
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