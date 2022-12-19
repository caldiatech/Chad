@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class="col1">
	       {!! Html::link('/dnradmin/shipping',' Shipping') !!}  &raquo; Fedex  
         </div>  
    </div>
    
  
     
    @if($shipping)   	   
       {!! Form::open(array('url' => '/dnradmin/shipping_fedex/edit/'.$shipping->fldFedexID, 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}	
    @else
       {!! Form::open(array('url' => '/dnradmin/shipping_fedex', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
    @endif   
    
    @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif 	
      <ul>
        <li>Fedex Information</li>
        
        <li class=boxfields>
          <dl>
            <dt>Access Key</dt>
            <dd>
            	 @if($shipping) 
	            	{!! Form::text('access_key',$shipping->fldFedexApKey,array('size'=>'50','class'=>'required')) !!}
                 @else
                 	{!! Form::text('access_key','',array('size'=>'50','class'=>'required')) !!}
                 @endif   
                 @if($errors->fedex->first('access_key'))
                      <div class="error">{!!$errors->fedex->first('access_key')!!}</div>
                 @endif
            </dd>
          </dl>           
          <dl>
            <dt>Password</dt>
            <dd>
            	@if($shipping)
            		{!! Form::text('password',$shipping->fldFedexPassword,array('size'=>'50','class'=>'required')) !!}
                @else
                	{!! Form::text('password','',array('size'=>'50','class'=>'required')) !!}
                @endif    
                 @if($errors->fedex->first('password'))
                      <div class="error">{!!$errors->fedex->first('password')!!}</div>
                 @endif
                </dd>
          </dl> 
           <dl>
            <dt>Account Number</dt>
            <dd>
            	@if($shipping)
            		{!! Form::text('account_no',$shipping->fldFedexAccountNo,array('size'=>'50','class'=>'required','pattern'=>'\d*')) !!}
                @else
                	{!! Form::text('account_no','',array('size'=>'50','class'=>'required','pattern'=>'\d*')) !!}
                @endif    
                 @if($errors->fedex->first('account_no'))
                      <div class="error">{!!$errors->fedex->first('account_no')!!}</div>
                 @endif
                </dd>
          </dl> 
          <dl>
            <dt>Meter Number</dt>
            <dd>
            	@if($shipping)
            		{!! Form::text('meter_no',$shipping->fldFedexMeterNo,array('size'=>'50','class'=>'required','pattern'=>'\d*')) !!}
                @else
                	{!! Form::text('meter_no','',array('size'=>'50','class'=>'required','pattern'=>'\d*')) !!}
                @endif    
                @if($errors->fedex->first('meter_no'))
                      <div class="error">{!!$errors->fedex->first('meter_no')!!}</div>
                 @endif
                </dd>
          </dl> 
        </li>
        
      </ul>
      <ul>
        <li>Fedex Shipper Information</li>
        
        <li class=boxfields>
          <dl>
            <dt>Address</dt>
            <dd>
            	 @if($shipping) 
	            	{!! Form::text('address',$shipping->fldFedexAddress,array('size'=>'50','class'=>'required')) !!}
                 @else
                 	{!! Form::text('address','',array('size'=>'50','class'=>'required')) !!}
                 @endif   
                  @if($errors->fedex->first('address'))
                      <div class="error">{!!$errors->fedex->first('address')!!}</div>
                 @endif
            </dd>
          </dl>  
          <dl>
            <dt>City</dt>
            <dd>
            	 @if($shipping) 
	            	{!! Form::text('city',$shipping->fldFedexCity,array('size'=>'50','class'=>'required')) !!}
                 @else
                 	{!! Form::text('city','',array('size'=>'50','class'=>'required')) !!}
                 @endif   
                   @if($errors->fedex->first('city'))
                      <div class="error">{!!$errors->fedex->first('city')!!}</div>
                 @endif
            </dd>
          </dl>  
          <dl>
            <dt>State</dt>
            <dd>
            	 @if($shipping) 
	            	 {!! Form::select('state',array('0' => 'Select one')+App\Models\State::displayState(),$shipping->fldFedexState,array('id'=>'state','data-placeholder'=>'Select State')) !!} 
                @else
                	{!! Form::select('state',array('0' => 'Select one')+App\Models\State::displayState(),'0',array('id'=>'state','data-placeholder'=>'Select State')) !!} 
                @endif    
                 @if($errors->fedex->first('state'))
                      <div class="error">{!!$errors->fedex->first('state')!!}</div>
                 @endif
            </dd>
          </dl>           
          <dl>
            <dt>Zip</dt>
            <dd>
            	 @if($shipping) 
	            	{!! Form::text('zip',$shipping->fldFedexZip,array('size'=>'50','class'=>'required')) !!}
                 @else
                 	{!! Form::text('zip','',array('size'=>'50','class'=>'required')) !!}
                 @endif   
                  @if($errors->fedex->first('zip'))
                      <div class="error">{!!$errors->fedex->first('zip')!!}</div>
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
@stop

@section('extracodes')

    
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
    {!! Html::script('_admin/assets/js/customValidation.js','') !!}
    
    
    
	
@stop