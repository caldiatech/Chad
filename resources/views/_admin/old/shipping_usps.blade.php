@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
       <div class="col1">
	       {{ HTML::link('/dnradmin/shipping',' Shipping') }} &raquo; USPS  
        </div>
    </div>
    
  
     
    @if($shipping)   	   
       {{ Form::open(array('url' => '/dnradmin/shipping_usps/edit/'.$shipping->id, 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}	
    @else
       {{ Form::open(array('url' => '/dnradmin/shipping_usps', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
    @endif   
    
    @if($success == 1) 
           <div class="success">Record successfully saved</div>
    @endif	
      <ul>
        <li>USPS Information</li>
        
        <li class=boxfields>
          <dl>
            <dt>Username</dt>
            <dd>
            	 @if($shipping) 
	            	{{ Form::text('username',$shipping->username,array('size'=>'50','class'=>'required')) }}
                 @else
                 	{{ Form::text('username','',array('size'=>'50','class'=>'required')) }}
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