@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class="col1">
    
       	  {{ HTML::link('/dnradmin/sales_business',' Shops / Business') }} &raquo; Add Shops / Business
    
       </div>
    </div>
    
  	
    
   {{ Form::open(array('url' => '/dnradmin/sales_business/new', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
    @if($success == 1) 
           <div class="success">Record successfully saved</div>
    @endif	
     @if($error == 1) 
           <div class="error">Email address already in used</div>
    @endif    
     @if($error == 2) 
           <div class="error">Account no already in used</div>
    @endif	
    @if($error == 3) 
           <div class="error">Paypal email address already in used</div>
    @endif	
    @if($error ==4) 
           <div class="error">{{ $errorMessage }}</div>
    @endif		
     
      <table border="0" width="1000px;" style="margin-bottom:10px; padding:10px 10px">
      	 <tr>
         	<td style="width:725px; margin-right:10px;" valign="top">
            
                      <ul style="width:725px;" id="salesrep">
                        <li style="width:705px;">Business Information</li>
                        
                        <li class=boxfields style="width:705px;" >                          
                          <dl>
                            <dt>First name</dt>
                            <dd>{{ Form::text('firstname','',array('size'=>'50','class'=>'required')) }}</dd>
                          </dl> 
                           <dl>
                            <dt>Last name</dt>
                            <dd>{{ Form::text('lastname','',array('size'=>'50','class'=>'required')) }}</dd>
                          </dl> 
                          <dl>
                            <dt>Birthdate</dt>
                            <dd>{{ Form::text('bday','',array('size'=>'50','id'=>'birthdate')) }}</dd>
                          </dl>
                          <dl>
                            <dt>Company name</dt>
                            <dd>{{ Form::text('name','',array('size'=>'50')) }}</dd>
                          </dl> 
                           <dl>
                            <dt>Email Address</dt>
                            <dd>{{ Form::email('email','',array('size'=>'50','class'=>'required')) }}</dd>
                          </dl>                       
                           <dl>
                            <dt>Password</dt>
				            <dd><input type="password" name="password" value="" class="required" size="50"></dd>
                          </dl> 
                          <dl>
                            <dt>Mobile no</dt>
                            <dd>{{ Form::text('phone','',array('size'=>'50','pattern'=>'\d{3}[\-]\d{3}[\-]\d{4}')) }} <span>eg 123-456-7890</span></dd>
                          </dl>                         
                           <dl>
                            <dt>Location</dt>
                            <dd>{{ Form::text('country','',array('size'=>'50')) }}</dd>
                          </dl>  
                         
                          <dl>
                            <dt>Email Alerts</dt>
                            <dd>{{ Form::radio('email_alerts', '1') }} ON {{ Form::radio('email_alerts', '0') }} OFF</dd>
                          </dl> 
                          <dl>
                            <dt>Mobile Alerts</dt>
                            <dd>{{ Form::radio('mobile_alerts', '1') }} ON {{ Form::radio('mobile_alerts', '0') }} OFF</dd>
                          </dl>    
                           <dl>
                            <dt>Territory</dt>
                            <dd>
                                <select name="territory">                        	
                                     @foreach($databaseConfig as $databaseConfigs)
                                           <option value="{{$databaseConfigs->fldDatabaseCity}}">{{$databaseConfigs->fldDatabaseCity}}</option>
                                     @endforeach    
                               </select>
                            </dd>
                          </dl>                           
                            <dl>
                                <dt>Promo Code</dt>
                                <dd><strong>{{ $promocode }}</strong></dd>
                             </dl>  
                              {{ Form::hidden('promocode',$promocode) }} 
                          </li>
                         
                      </ul>

					<? /*
				      <ul style="width:725px;" id="salesrep">
				        <li style="width:705px;">Address Information</li>
				        <li class=boxfields style="width:705px;">          
				       	 <dl>
				            <dt>Street Address </dt>
				            <dd>{{ Form::text('address','',array('size'=>'50','class'=>'required')) }}</dd>
				          </dl> 
				           <dl>
				            <dt>City</dt>
				            <dd>{{ Form::text('city','',array('size'=>'50','class'=>'required')) }}</dd>
				          </dl> 
				           <dl>
				            <dt>State</dt>
				            <dd>{{ Form::text('state','',array('size'=>'50','class'=>'required')) }}</dd>
				          </dl>                       
				           <dl>
				            <dt>Postal Code</dt>
				            <dd>{{ Form::text('postal_code','',array('size'=>'50','class'=>'required')) }}</dd>
				          </dl>          
				          </li>
				      </ul>

                      <ul style="width:725px;" id="salesrep">
                        <li style="width:705px;">Banking Information</li>
                        <li class=boxfields style="width:705px;">          
                         <dl>
                            <dt>Bank Name </dt>
                            <dd>{{ Form::text('bank_name','',array('size'=>'50')) }}</dd>
                          </dl> 
                           <dl>
                            <dt>Account Number</dt>
                            <dd>{{ Form::text('account_no','',array('size'=>'50','pattern'=>'\d*')) }}</dd>
                          </dl> 
                           <dl>
                            <dt>Type of Account</dt>
                            <dd>{{ Form::text('type_account','',array('size'=>'50')) }}</dd>
                          </dl>                       
                           <dl>
                            <dt>Routing Number</dt>
                            <dd>{{ Form::text('routing_no','',array('size'=>'50','pattern'=>'\d*')) }}</dd>
                          </dl>          
                          </li>
                      </ul>
					*/ ?>

                     </td>
           <td style="width:265px; vertical-align:top">
            		                   
                   <div style="background:#fff; border:#ccc 1px solid; width:245px; min-height:100px; margin-bottom:10px;">
                    	<p style="padding:5px 5px; background:#666; color:#fff"><strong>Referred By</strong></p>                        	
                            {{ Form::radio('referred_by', '1',false) }} Recruiter<br />
                            {{ Form::radio('referred_by', '3',false) }} Sales Rep<br />
                            {{ Form::radio('referred_by', '4',false) }} Marketing<br />
                            {{ Form::radio('referred_by', '5',false) }} Distributor<br />
			        </div>
                    <div style="background:#fff; border:#ccc 1px solid; width:245px; height:406px; margin-bottom:10px;">
                    	<p style="padding:5px 5px; background:#666; color:#fff"><strong><span id="referedby">Recruiter</span></strong></p>
                        <p style="padding:5px 5px;"><input type="text" name="search" id="search" value="" placeholder="Search" style="width:220px;" /></p>
                        <div id="searchResult" style="height:327px;width:245px; overflow:scroll">
                        </div>
                        	
			        </div>    
          </td>
          </tr>
          </table>

      <?
	  /*
      <ul>
        <li>Paypal Account Info</li>
        
        <li class=boxfields >          
       	 <dl>
            <dt>Registered Paypal Email Address: </dt>
            <dd>{{ Form::email('paypal_email','',array('size'=>'50')) }}</dd>
          </dl>              
          </li>
      </ul>
	  */ ?>
            
            
      <div class=clear><!-- Clear Section --></div>   
      	{{ Form::submit('',array('name'=>'saveinfo'))}}
		 &nbsp; 
		{{ Form::reset('',array('name'=>'reset'))}} 
        

    {{ Form::close() }}
  </article>
  

@stop

@section('headercodes')    
  {{ HTML::style('_admin/assets/js/jq-ui/jquery-ui.css') }}   
  <style>
  	 #salesrep li dl { width:705px;}
	 #salesrep li dl dt {width:100px;}
	 #salesrep li dl dd {width:525px;}
  </style>
@stop

@section('extracodes')
	<script>
		var mypath = "{{ $pageURL }}";
	</script>
    {{ HTML::script('_admin/manager/tinymce/tiny_mce.js') }}
    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js') }}
    {{ HTML::script('_admin/assets/js/customValidation.js') }}
    
    {{ HTML::script('_admin/manager/tinymce/styles/mods5.js') }}
    {{ HTML::script('_admin/assets/js/jquery-ui.js') }}
    <script>
		var mypath = "{{ $pageURL }}";
		var category_id = "0";
	</script>
    {{ HTML::script('_admin/assets/js/news.js') }} 
    
	<script>			
	  $(function() {
		$( "#birthdate" ).datepicker({ dateFormat: 'mm-dd-yy' });
	  });
	  
	  $('#searchResult').load(mypath+'dnradmin/sales_manager/display');
	  
	  $("input[name='referred_by']").change(function(){
		 
		  if($(this).val()==1) {			 
			 $('#searchResult').load(mypath+'dnradmin/sales_manager/display', function() {
					$('#referedby').html("Recruiter");
				});
			 
		  } else if($(this).val()==2) {
			  $('#searchResult').load(mypath+'dnradmin/sales_manager/display', function() {
					$('#referedby').html("Recruiter");
				});
		  }  else if($(this).val()==3) {
			  $('#searchResult').load(mypath+'dnradmin/sales_user/user/1', function() {
					$('#referedby').html("Sales Rep");
				});
		  }  else if($(this).val()==4) {
			  $('#searchResult').load(mypath+'dnradmin/sales_user/user/2', function() {
					$('#referedby').html("Marketing Partners");
				});	
		  }  else if($(this).val()==5) {
			  $('#searchResult').load(mypath+'dnradmin/sales_user/user/4', function() {
					$('#referedby').html("Distributor");
				});	 			
			  /*
			  $('#searchResult').load(mypath+'/dnradmin/sales_user/recruiter', function() {
					$('#referedby').html("Recruiter");
				});
			*/	
			  
		  }
		  
		  
    
	 });
	 
	 $('#search').keyup(function(event) {

		 if (event.keyCode == 27 || $(this).val() == '') {      
		      $(this).val('');                   
      		  $('#searchResult table tr').removeClass('visible').show().addClass('visible');
			  
	    } else {
			 filter('#searchResult table tr', $(this).val());
		}
	 });
	 
	 function filter(selector, query) {
		  query =   $.trim(query); //trim white space
		  query = query.replace(/ /gi, '|'); //add OR for regex query
		 
		  $(selector).each(function() {
			($(this).text().search(new RegExp(query, "i")) < 0) ? $(this).hide().removeClass('visible') : $(this).show().addClass('visible');
		  });
		}
	  	  		
	</script> 
   
   
   
@stop