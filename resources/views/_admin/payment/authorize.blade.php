@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class="col1">
	       {!! Html::link('/dnradmin/payment',' Payment') !!}    &raquo; Authorize.net
        </div>
    </div>



    @if($payment)
       {!! Form::open(array('url' => '/dnradmin/authorize/edit/'.$payment->fldAuthorizeID, 'method' => 'post', 'id' => 'pageform', 'files' => true)) !!}
    @else
       {!! Form::open(array('url' => '/dnradmin/authorize', 'method' => 'post', 'id' => 'pageform', 'files' => true)) !!}
    @endif

     @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif
      <ul>
        <li>Authorize.net Information</li>

        <li class=boxfields>
          <dl>
            <dt>Login Key</dt>
            <dd>
            	  @if($payment)
            		  {!! Form::text('login_key',$payment->fldAuthorizeLoginKey,array('size'=>'50','class'=>'required')) !!}
                @else
                	{!! Form::text('login_key','',array('size'=>'50','class'=>'required')) !!}
                @endif
            </dd>
          </dl>
          <dl>
            <dt>Transaction Key</dt>
            <dd>
                @if($payment)
                  {!! Form::text('tran_key',$payment->fldAuthorizeTranKey,array('size'=>'50','class'=>'required')) !!}
                @else
                  {!! Form::text('tran_key','',array('size'=>'50','class'=>'required')) !!}
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
