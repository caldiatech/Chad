@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
       <div class="col2">
	       {!! Html::link('/dnradmin/shipping',' Shipping') !!} &raquo; {{ SHIPPING_USPS }}  
        </div>
    </div>
    
  
     
    @if($shipping)   	   
       {!! Form::open(array('url' => '/dnradmin/shipping_usps/edit/'.$shipping->fldUSPSID, 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')); !!}	
    @else
       {!! Form::open(array('url' => '/dnradmin/shipping_usps', 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')); !!}
    @endif   
    
    @if (Session::has('success'))
           <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
    @endif  

    <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>USPS Information</li>
               <li class="boxfields">

                    <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Username</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                           @if($shipping) 
                            {!! Form::text('username',$shipping->fldUSPSUsername,array('size'=>'50','class'=>'required')) !!}
                             @else
                              {!! Form::text('username','',array('size'=>'50','class'=>'required')) !!}
                             @endif   
                               @if($errors->usps->first('username'))
                                  <div class="error">{!!$errors->usps->first('username')!!}</div>
                             @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Zip</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                            @if($shipping) 
                            {!! Form::text('zip',$shipping->fldUSPSZip,array('size'=>'50','class'=>'required')) !!}
                             @else
                              {!! Form::text('zip','',array('size'=>'50','class'=>'required')) !!}
                             @endif  
                             @if($errors->usps->first('zip'))
                                  <div class="error">{!!$errors->usps->first('zip')!!}</div>
                             @endif 
                      </div>
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
  {!! Html::style('_admin/assets/css/pagination.css') !!}  
@stop

@section('extracodes')

    
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
    {!! Html::script('_admin/assets/js/customValidation.js','') !!}
    
    
    
	
@stop