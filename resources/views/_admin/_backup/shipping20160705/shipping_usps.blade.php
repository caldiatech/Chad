@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
       <div class="col1">
	       {!! Html::link('/dnradmin/shipping',' Shipping') !!} &raquo; USPS
        </div>
    </div>



    @if($shipping)
       {!! Form::open(array('url' => '/dnradmin/shipping_usps/edit/'.$shipping->fldUSPSID, 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
    @else
       {!! Form::open(array('url' => '/dnradmin/shipping_usps', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
    @endif

    @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif
      <ul>
        <li>USPS Information</li>

        <li class=boxfields>
          <dl>
            <dt>Username</dt>
            <dd>
            	 @if($shipping)
	            	{!! Form::text('username',$shipping->fldUSPSUsername,array('size'=>'50','class'=>'required')) !!}
                 @else
                 	{!! Form::text('username','',array('size'=>'50','class'=>'required')) !!}
                 @endif
                   @if($errors->usps->first('username'))
                      <div class="error">{!!$errors->usps->first('username')!!}</div>
                 @endif
            </dd>
          </dl>
          <dl>
            <dt>Zip</dt>
            <dd>
            	 @if($shipping)
	            	{!! Form::text('zip',$shipping->fldUSPSZip,array('size'=>'50','class'=>'required')) !!}
                 @else
                 	{!! Form::text('zip','',array('size'=>'50','class'=>'required')) !!}
                 @endif
                 @if($errors->usps->first('zip'))
                      <div class="error">{!!$errors->usps->first('zip')!!}</div>
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


    {!! Html::script('_admin/assets/js/cufon_avantgarde.js') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}
    {!! Html::script('_admin/assets/js/customValidation.js') !!}




@stop
