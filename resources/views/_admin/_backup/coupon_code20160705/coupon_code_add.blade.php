@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
        <div class="col1">
	       {!! Html::link('/dnradmin/coupon_code','Coupon Code') !!} &raquo; Create new coupon code
        </div>
    </div>
    
  	 
    
   {!! Form::open(array('url' => '/dnradmin/coupon_code/new', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
    @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif	
   @if(Session::has('coupon_error')) 
      <div class="error_text">{!!Session::get('coupon_error')!!}</div>
    @endif
      <ul>
        <li>Coupon Code Information</li>
        
        <li class=boxfields>
          <dl>
            <dt>Coupon Code Name</dt>
            <dd>{!! Form::text('name','',array('size'=>'50','class'=>'required')) !!}
                 @if($errors->couponcode->first('name'))
                    <div class="error">{!!$errors->couponcode->first('name')!!}</div>
                 @endif
            </dd>
          </dl> 
          <dl>
            <dt>Coupon Code</dt>
            <dd>{!! Form::text('code','',array('size'=>'50','class'=>'required')) !!}
                 @if($errors->couponcode->first('code'))
                    <div class="error">{!!$errors->couponcode->first('code')!!}</div>
                 @endif
            </dd>
          </dl>   
           <dl>
            <dt>Discount Price $</dt>
            <dd>{!! Form::text('amount','',array('size'=>'50')) !!}
                @if($errors->couponcode->first('amount'))
                    <div class="error">{!!$errors->couponcode->first('amount')!!}</div>
                 @endif
            </dd>
          </dl>  
           <dl>
            <dt>Discount Percentage </dt>
            <dd>{!! Form::text('percentage','',array('size'=>'50')) !!} %
                 @if($errors->couponcode->first('percentage'))
                    <div class="error">{!!$errors->couponcode->first('percentage')!!}</div>
                 @endif
            </dd>
          </dl>                     
          <dl>
            <dt>Free Shipping</dt>
            <dd>{!! Form::checkbox('isFreeShipping',1) !!}</dd>
          </dl>  
          <dl>
            <dt>Expiration Date</dt>
            <dd>
                <input type="text" data-uk-datepicker="{format:'YYYY-MM-DD'}" name="expiration_date">
                 @if($errors->couponcode->first('expiration_date'))
                    <div class="error">{!!$errors->couponcode->first('expiration_date')!!}</div>
                 @endif
            </dd>
          </dl>                         
        </li>
        
      </ul>
           

      <div class=clear><!-- Clear Section --></div>   
      	{!! Form::submit('',array('name'=>'saveinfo'))!!} &nbsp; {!! Form::reset('',array('name'=>'reset'))!!} 
        
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
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}
    {!! Html::script('_admin/assets/js/customValidation.js') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js') !!}

    {!! Html::script('_front/plugins/uikit/js/uikit.min.js') !!}
    {!! Html::script('_front/plugins/uikit/js/components/datepicker.js') !!}
    {!! Html::script('_front/plugins/uikit/js/components/autocomplete.min.js') !!}
       
    
@stop