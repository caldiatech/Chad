@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
        <div class="col1">
	       {{ HTML::link('/dnradmin/coupon_code','Coupon Code') }} &raquo; Create new coupon code
        </div>
    </div>



   {{ Form::open(array('url' => '/dnradmin/coupon_code/new', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
    @if($success == 1)
           <div class="success">Record successfully saved</div>
    @endif
      <ul>
        <li>Product Information</li>

        <li class=boxfields>
          <dl>
            <dt>Coupon Code Name</dt>
            <dd>{{ Form::text('name','',array('size'=>'50','class'=>'required')) }}</dd>
          </dl>
          <dl>
            <dt>Coupon Code</dt>
            <dd>{{ Form::text('code','',array('size'=>'50','class'=>'required')) }}</dd>
          </dl>
           <dl>
            <dt>Discount Price $</dt>
            <dd>{{ Form::text('amount','',array('size'=>'50')) }}</dd>
          </dl>
           <dl>
            <dt>Discount Percentage </dt>
            <dd>{{ Form::text('percentage','',array('size'=>'50')) }} %</dd>
          </dl>
          <dl>
            <dt>Free Shipping</dt>
            <dd>{{ Form::checkbox('isFreeShipping',1) }}</dd>
          </dl>
        </li>

      </ul>


      <div class=clear><!-- Clear Section --></div>
      	{{ Form::submit('',array('name'=>'saveinfo'))}} &nbsp; {{ Form::reset('',array('name'=>'reset'))}}

    {{ Form::close() }}

  </article>


@stop

@section('headercodes')
  {{ HTML::style('_admin/assets/css/pagination.css') }}
@stop

@section('extracodes')
	<script>
		var mypath = "{{ $pageURL }}";
	</script>
    {{ HTML::script('_admin/manager/tinymce/tiny_mce.js') }}
    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js') }}
    {{ HTML::script('_admin/assets/js/jquery-latest.min.js') }}
    {{ HTML::script('_admin/assets/js/customValidation.js') }}
    {{ HTML::script('_admin/manager/tinymce/styles/mods2.js') }}


@stop
