@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class="col1">
	       {{ HTML::link('/dnradmin/payment',' Payment') }}    &raquo; Authorize.net
        </div>
    </div>



    @if($payment)
       {{ Form::open(array('url' => '/dnradmin/authorize/edit/'.$payment->id, 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
    @else
       {{ Form::open(array('url' => '/dnradmin/authorize', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
    @endif

    @if($success == 1)
           <div class="success">Record successfully saved</div>
    @endif
      <ul>
        <li>Authorize.net Information</li>

        <li class=boxfields>
          <dl>
            <dt>Login Key</dt>
            <dd>
            	@if($payment)
            		{{ Form::text('login_key',$payment->login_key,array('size'=>'50','class'=>'required')) }}
                @else
                	{{ Form::text('login_key','',array('size'=>'50','class'=>'required')) }}
                @endif
            </dd>
          </dl>
          <dl>
            <dt>Transaction Key</dt>
            <dd>
            	@if($payment)
            		{{ Form::text('tran_key',$payment->tran_key,array('size'=>'50','class'=>'required')) }}
                @elseif
                	{{ Form::text('tran_key','',array('size'=>'50','class'=>'required')) }}
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
