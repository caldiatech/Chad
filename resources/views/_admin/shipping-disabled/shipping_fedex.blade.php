@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class="col2">
	       {!! Html::link('/dnradmin/shipping',' Shipping') !!}  &raquo; {{ SHIPPING_FEDEX }}  
         </div>  
    </div>
    
  
     
    @if($shipping)   	   
       {!! Form::open(array('url' => '/dnradmin/shipping_fedex/edit/'.$shipping->fldFedexID, 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')); !!}	
    @else
       {!! Form::open(array('url' => '/dnradmin/shipping_fedex', 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')); !!}
    @endif   
    
    @if (Session::has('success'))
           <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
    @endif 	

    <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>Fedex Information</li>
               <li class="boxfields">

                    <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Access Key</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          @if($shipping) 
                              {!! Form::text('access_key',$shipping->fldFedexApKey,array('size'=>'50','class'=>'required')) !!}
                               @else
                                {!! Form::text('access_key','',array('size'=>'50','class'=>'required')) !!}
                               @endif   
                               @if($errors->fedex->first('access_key'))
                                    <div class="error">{!!$errors->fedex->first('access_key')!!}</div>
                               @endif
                      </div>
                   </div>

                    <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Password</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                            @if($shipping)
                            {!! Form::text('password',$shipping->fldFedexPassword,array('size'=>'50','class'=>'required')) !!}
                            @else
                              {!! Form::text('password','',array('size'=>'50','class'=>'required')) !!}
                            @endif    
                             @if($errors->fedex->first('password'))
                                  <div class="error">{!!$errors->fedex->first('password')!!}</div>
                             @endif
                      </div>
                   </div>

                    <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Account Number</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                            @if($shipping)
                            {!! Form::text('account_no',$shipping->fldFedexAccountNo,array('size'=>'50','class'=>'required','pattern'=>'\d*')) !!}
                            @else
                              {!! Form::text('account_no','',array('size'=>'50','class'=>'required','pattern'=>'\d*')) !!}
                            @endif    
                             @if($errors->fedex->first('account_no'))
                                  <div class="error">{!!$errors->fedex->first('account_no')!!}</div>
                             @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Meter Number</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                            @if($shipping)
                            {!! Form::text('meter_no',$shipping->fldFedexMeterNo,array('size'=>'50','class'=>'required','pattern'=>'\d*')) !!}
                            @else
                              {!! Form::text('meter_no','',array('size'=>'50','class'=>'required','pattern'=>'\d*')) !!}
                            @endif    
                            @if($errors->fedex->first('meter_no'))
                                  <div class="error">{!!$errors->fedex->first('meter_no')!!}</div>
                             @endif
                      </div>
                   </div>

               </li>
            </ul>
        </div>
    </div>          

     <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>Fedex Shipper Information</li>
               <li class="boxfields">

                    <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Address</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                           @if($shipping) 
                            {!! Form::text('address',$shipping->fldFedexAddress,array('size'=>'50','class'=>'required')) !!}
                             @else
                              {!! Form::text('address','',array('size'=>'50','class'=>'required')) !!}
                             @endif   
                              @if($errors->fedex->first('address'))
                                  <div class="error">{!!$errors->fedex->first('address')!!}</div>
                             @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">City</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          @if($shipping) 
                            {!! Form::text('city',$shipping->fldFedexCity,array('size'=>'50','class'=>'required')) !!}
                             @else
                              {!! Form::text('city','',array('size'=>'50','class'=>'required')) !!}
                             @endif   
                               @if($errors->fedex->first('city'))
                                  <div class="error">{!!$errors->fedex->first('city')!!}</div>
                             @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">State</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          @if($shipping) 
                             {!! Form::select('state',array('0' => 'Select one')+App\Models\State::displayState(),$shipping->fldFedexState,array('id'=>'state','data-placeholder'=>'Select State')) !!} 
                            @else
                              {!! Form::select('state',array('0' => 'Select one')+App\Models\State::displayState(),'0',array('id'=>'state','data-placeholder'=>'Select State')) !!} 
                            @endif    
                             @if($errors->fedex->first('state'))
                                  <div class="error">{!!$errors->fedex->first('state')!!}</div>
                             @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Zip</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          @if($shipping) 
                          {!! Form::text('zip',$shipping->fldFedexZip,array('size'=>'50','class'=>'required')) !!}
                           @else
                            {!! Form::text('zip','',array('size'=>'50','class'=>'required')) !!}
                           @endif   
                            @if($errors->fedex->first('zip'))
                                <div class="error">{!!$errors->fedex->first('zip')!!}</div>
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

    
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}
    {!! Html::script('_admin/assets/js/customValidation.js') !!}
    
    
    
	
@stop