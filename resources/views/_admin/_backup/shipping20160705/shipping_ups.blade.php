

@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
       <div class="col1">
	       {!! Html::link('/dnradmin/shipping',' Shipping') !!} &raquo; UPS  
        </div>
    </div>
    
    
     
    @if($shipping)   	   
       {!! Form::open(array('url' => '/dnradmin/shipping_ups/edit/'.$shipping->fldUPSID, 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}	
    @else
       {!! Form::open(array('url' => '/dnradmin/shipping_ups', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
    @endif   
    
     @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif 	
      <ul>
        <li>UPS Information</li>
        
        <li class=boxfields>
          <dl>
            <dt>UPS XML Access Key</dt>
            <dd>
            	 @if($shipping) 
	            	{!! Form::text('xml_access_key',$shipping->fldUPSXmlAccessKey,array('size'=>'50','class'=>'required')) !!}
                 @else
                 	{!! Form::text('xml_access_key','',array('size'=>'50','class'=>'required')) !!}
                 @endif   
                 @if($errors->ups->first('xml_access_key'))
                      <div class="error">{!!$errors->ups->first('xml_access_key')!!}</div>
                 @endif
            </dd>
          </dl> 
          <dl>
            <dt>UPS User Id</dt>
            <dd>
            	@if($shipping)
	            	{!! Form::text('user_id',$shipping->fldUPSUserID,array('size'=>'50','class'=>'required')) !!}
                @else
	                 {!! Form::text('user_id','',array('size'=>'50','class'=>'required')) !!}
                @endif   
                  @if($errors->ups->first('user_id'))
                      <div class="error">{!!$errors->ups->first('user_id')!!}</div>
                 @endif
            </dd>
          </dl> 
          <dl>
            <dt>UPS Password</dt>
            <dd>
            	@if($shipping)
            		{!! Form::text('password',$shipping->fldUPSPassword,array('size'=>'50','class'=>'required')) !!}
                @else
                	{!! Form::text('password','',array('size'=>'50','class'=>'required')) !!}
                @endif    
                 @if($errors->ups->first('password'))
                      <div class="error">{!!$errors->ups->first('password')!!}</div>
                 @endif
                </dd>
          </dl> 
        </li>
        
      </ul>
      
      <ul>
        <li>Shipper Address Information</li>
        
        <li class=boxfields>          
          <dl>
            <dt>City</dt>
            <dd>
            	 @if($shipping) 
	            	{!! Form::text('city',$shipping->fldUPSCity,array('size'=>'50','class'=>'required')) !!}
                 @else
                 	{!! Form::text('city','',array('size'=>'50','class'=>'required')) !!}
                 @endif   
                  @if($errors->ups->first('city'))
                      <div class="error">{!!$errors->ups->first('city')!!}</div>
                 @endif
            </dd>
          </dl>  
          <dl>
            <dt>State</dt>
            <dd>
            	@if($shipping) 
	            	 {!! Form::select('state',array('0' => 'Select one')+App\Models\State::displayState(),$shipping->fldUPSState,array('id'=>'state','data-placeholder'=>'Select State')) !!} 
                @else
                	{!! Form::select('state',array('0' => 'Select one')+App\Models\State::displayState(),'0',array('id'=>'state','data-placeholder'=>'Select State')) !!} 
                @endif 
                @if($errors->ups->first('state'))
                      <div class="error">{!!$errors->ups->first('state')!!}</div>
                 @endif
            </dd>
          </dl>  
          <dl>
            <dt>Zip</dt>
            <dd>
            	 @if($shipping) 
	            	{!! Form::text('zip',$shipping->fldUPSZip,array('size'=>'50','class'=>'required')) !!}
                 @else
                 	{!! Form::text('zip','',array('size'=>'50','class'=>'required')) !!}
                 @endif  
                 @if($errors->ups->first('zip'))
                      <div class="error">{!!$errors->ups->first('zip')!!}</div>
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