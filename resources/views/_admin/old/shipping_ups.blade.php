@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
       <div class="col1">
	       {{ HTML::link('/dnradmin/shipping',' Shipping') }} &raquo; UPS  
        </div>
    </div>
    
    
     
    @if($shipping)   	   
       {{ Form::open(array('url' => '/dnradmin/shipping_ups/edit/'.$shipping->id, 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}	
    @else
       {{ Form::open(array('url' => '/dnradmin/shipping_ups', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
    @endif   
    
    @if($success == 1) 
           <div class="success">Record successfully saved</div>
    @endif	
      <ul>
        <li>UPS Information</li>
        
        <li class=boxfields>
          <dl>
            <dt>UPS XML Access Key</dt>
            <dd>
            	 @if($shipping) 
	            	{{ Form::text('xml_access_key',$shipping->xml_access_key,array('size'=>'50','class'=>'required')) }}
                 @else
                 	{{ Form::text('xml_access_key','',array('size'=>'50','class'=>'required')) }}
                 @endif   
            </dd>
          </dl> 
          <dl>
            <dt>UPS User Id</dt>
            <dd>
            	@if($shipping)
	            	{{ Form::text('user_id',$shipping->user_id,array('size'=>'50','class'=>'required')) }}
                @else
	                 {{ Form::text('user_id','',array('size'=>'50','class'=>'required')) }}
                @endif   
            </dd>
          </dl> 
          <dl>
            <dt>UPS Password</dt>
            <dd>
            	@if($shipping)
            		{{ Form::text('password',$shipping->password,array('size'=>'50','class'=>'required')) }}
                @else
                	{{ Form::text('password','',array('size'=>'50','class'=>'required')) }}
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
	            	{{ Form::text('city',$shipping->city,array('size'=>'50','class'=>'required')) }}
                 @else
                 	{{ Form::text('city','',array('size'=>'50','class'=>'required')) }}
                 @endif   
            </dd>
          </dl>  
          <dl>
            <dt>State</dt>
            <dd>
            	@if($shipping) 
	            	 {{ Form::select('state',array('0' => 'Select one')+StateManagement::displayState(),$shipping->state,array('id'=>'state','data-placeholder'=>'Select State')) }} 
                @else
                	{{ Form::select('state',array('0' => 'Select one')+StateManagement::displayState(),'0',array('id'=>'state','data-placeholder'=>'Select State')) }} 
                @endif 
            </dd>
          </dl>  
          <dl>
            <dt>Zip</dt>
            <dd>
            	 @if($shipping) 
	            	{{ Form::text('zip',$shipping->zip,array('size'=>'50','class'=>'required')) }}
                 @else
                 	{{ Form::text('zip','',array('size'=>'50','class'=>'required')) }}
                 @endif   
            </dd>
          </dl>  
        </li>
        
      </ul>
                
      <div class=clear><!-- Clear Section --></div>       
      	{{ Form::submit('',array('name'=>'saveinfo'))}}
        
    {{ Form::close() }}
    
  </article>
  

@stop

@section('headercodes')    
  {{ HTML::style('_admin/assets/css/pagination.css') }}  
@stop

@section('extracodes')

    
    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js','') }}
    {{ HTML::script('_admin/assets/js/jquery-latest.min.js','') }}
    {{ HTML::script('_admin/assets/js/customValidation.js','') }}
    
    
    
	
@stop