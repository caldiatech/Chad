@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class="col1">
	       {{ HTML::link('/dnradmin/payment',' Payment') }} &raquo; Paypal
        </div>
    </div>



    @if($payment)
       {{ Form::open(array('url' => '/dnradmin/paypal/edit/'.$payment->id, 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
    @else
       {{ Form::open(array('url' => '/dnradmin/paypal', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
    @endif

    @if($success == 1)
           <div class="success">Record successfully saved</div>
    @endif
      <ul>
        <li>Paypal Information</li>

        <li class=boxfields>
          <dl>
            <dt>Paypal email address</dt>
            <dd>
            	@if($payment)
	            	{{ Form::text('email',$payment->email,array('size'=>'50','class'=>'required')) }}
                @else
                	{{ Form::text('email','',array('size'=>'50','class'=>'required')) }}
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


    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js') }}
    {{ HTML::script('_admin/assets/js/jquery-latest.min.js') }}
    {{ HTML::script('_admin/assets/js/customValidation.js') }}




@stop
