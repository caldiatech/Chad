@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
        <div class="col2">
	       {!! Html::link('/dnradmin/coupon_code',COUPONCODE_MANAGEMENT) !!} &raquo; Create new {{ COUPONCODE_MANAGEMENT }}
        </div>
    </div>
    
  	 
    
   {!! Form::open(array('url' => '/dnradmin/coupon_code/new', 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')); !!}
    @if (Session::has('success'))
           <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
    @endif	
   @if(Session::has('coupon_error')) 
      <div class="uk-alert uk-alert-danger">{!!Session::get('coupon_error')!!}</div>
    @endif

    <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>{{ COUPONCODE_MANAGEMENT }} Information</li>
               <li class="boxfields">

                    <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Coupon Code Name</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::text('name','',array('size'=>'50','class'=>'required')) !!}
                         @if($errors->couponcode->first('name'))
                            <div class="error">{!!$errors->couponcode->first('name')!!}</div>
                         @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Coupon Code</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          {!! Form::text('code','',array('size'=>'50','class'=>'required')) !!}
                           @if($errors->couponcode->first('code'))
                              <div class="error">{!!$errors->couponcode->first('code')!!}</div>
                           @endif
                      </div>
                   </div>

                    <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Discount Price $</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          {!! Form::text('amount','',array('size'=>'50')) !!}
                          @if($errors->couponcode->first('amount'))
                              <div class="error">{!!$errors->couponcode->first('amount')!!}</div>
                           @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Discount Percentage</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          {!! Form::text('percentage','',array('size'=>'50')) !!} %
                           @if($errors->couponcode->first('percentage'))
                              <div class="error">{!!$errors->couponcode->first('percentage')!!}</div>
                           @endif
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Free Shipping</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          {!! Form::checkbox('isFreeShipping',1,0,['class'=>'check-select']) !!}
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Expiration Date</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                          <input type="text" data-uk-datepicker="{format:'YYYY-MM-DD'}" name="expiration_date">
                           @if($errors->couponcode->first('expiration_date'))
                              <div class="error">{!!$errors->couponcode->first('expiration_date')!!}</div>
                           @endif
                      </div>
                   </div>

               </li>
            </ul>
        </div>
    </div>            
                
      <div class=clear><!-- Clear Section --></div>   
        {!! Form::submit('Save Record',array('name'=>'saveinfo','class'=>'uk-button uk-button-success'))!!} &nbsp; {!! Form::reset('Reset',array('name'=>'reset','class'=>'uk-button uk-button-danger'))!!}         
    {!! Form::close() !!}
    
  </article>
  

@stop

@section('headercodes')    
  {!! Html::style('_admin/assets/css/pagination.css') !!}
  {!! Html::style('_front/plugins/uikit/css/uikit.min.css') !!}
  {!! Html::style('_front/plugins/uikit/css/components/datepicker.css') !!}
  {!! Html::style('_front/plugins/uikit/css/components/autocomplete.min.css') !!}   
@stop

@section('extracodes')
	<script>
		var mypath = "{!! url('/') !!}";
	</script>
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js','') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
    {!! Html::script('_admin/assets/js/customValidation.js','') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js','') !!}

    {!! Html::script('_front/plugins/uikit/js/uikit.min.js','') !!}
    {!! Html::script('_front/plugins/uikit/js/components/datepicker.js','') !!}
    {!! Html::script('_front/plugins/uikit/js/components/autocomplete.min.js','') !!}
       
    
@stop