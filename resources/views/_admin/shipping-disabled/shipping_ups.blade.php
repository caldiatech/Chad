

@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
       <div class="col2">
	       {!! Html::link('/dnradmin/shipping',' Shipping') !!} &raquo; {{ SHIPPING_UPS }}  
        </div>
    </div>
    
    
     
    @if($shipping)   	   
       {!! Form::open(array('url' => '/dnradmin/shipping_ups/edit/'.$shipping->fldUPSID, 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')); !!}	
    @else
       {!! Form::open(array('url' => '/dnradmin/shipping_ups', 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')); !!}
    @endif   
    
     @if (Session::has('success'))
           <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
    @endif

     <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>UPS Information</li>
               <li class="boxfields">

                  <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">UPS XML Access Key</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          @if($shipping) 
                            {!! Form::text('xml_access_key',$shipping->fldUPSXmlAccessKey,array('size'=>'50','class'=>'required')) !!}
                             @else
                              {!! Form::text('xml_access_key','',array('size'=>'50','class'=>'required')) !!}
                             @endif   
                             @if($errors->ups->first('xml_access_key'))
                                  <div class="error">{!!$errors->ups->first('xml_access_key')!!}</div>
                             @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">UPS User Id</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                           @if($shipping)
                            {!! Form::text('user_id',$shipping->fldUPSUserID,array('size'=>'50','class'=>'required')) !!}
                            @else
                               {!! Form::text('user_id','',array('size'=>'50','class'=>'required')) !!}
                            @endif   
                              @if($errors->ups->first('user_id'))
                                  <div class="error">{!!$errors->ups->first('user_id')!!}</div>
                             @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">UPS Password</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          @if($shipping)
                          {!! Form::text('password',$shipping->fldUPSPassword,array('size'=>'50','class'=>'required')) !!}
                          @else
                            {!! Form::text('password','',array('size'=>'50','class'=>'required')) !!}
                          @endif    
                           @if($errors->ups->first('password'))
                                <div class="error">{!!$errors->ups->first('password')!!}</div>
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
               <li>Shipper Address Information</li>
               <li class="boxfields">

                    <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">City</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          @if($shipping) 
                          {!! Form::text('city',$shipping->fldUPSCity,array('size'=>'50','class'=>'required')) !!}
                           @else
                            {!! Form::text('city','',array('size'=>'50','class'=>'required')) !!}
                           @endif   
                            @if($errors->ups->first('city'))
                                <div class="error">{!!$errors->ups->first('city')!!}</div>
                           @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">State</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                           @if($shipping) 
                             {!! Form::select('state',array('0' => 'Select one')+App\Models\State::displayState(),$shipping->fldUPSState,array('id'=>'state','data-placeholder'=>'Select State')) !!} 
                            @else
                              {!! Form::select('state',array('0' => 'Select one')+App\Models\State::displayState(),'0',array('id'=>'state','data-placeholder'=>'Select State')) !!} 
                            @endif 
                            @if($errors->ups->first('state'))
                                  <div class="error">{!!$errors->ups->first('state')!!}</div>
                             @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Zip</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                            @if($shipping) 
                              {!! Form::text('zip',$shipping->fldUPSZip,array('size'=>'50','class'=>'required')) !!}
                               @else
                                {!! Form::text('zip','',array('size'=>'50','class'=>'required')) !!}
                               @endif  
                               @if($errors->ups->first('zip'))
                                    <div class="error">{!!$errors->ups->first('zip')!!}</div>
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