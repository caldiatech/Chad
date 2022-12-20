@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control >
       <div class="col1">
            {{ HTML::link('/dnradmin/settings','Settings') }} &raquo; Update Administrator
         </div>
    </div>



   {{ Form::open(array('url' => '/dnradmin/settings/edit/'.$settings->id, 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}

      <ul>
        <li>Administraotr Information</li>

        <li class=boxfields>
          <dl>
            <dt>Full name</dt>
            <dd>{{ Form::text('fullname',$settings->fullname,array('size'=>'50','class'=>'required')) }}</dd>
          </dl>
          <dl>
            <dt>Email address</dt>
            <dd>{{ Form::text('email',$settings->email,array('size'=>'50','class'=>'required')) }}</dd>
          </dl>
          <dl>
            <dt>Phone no</dt>
            <dd>{{ Form::text('phone',$settings->phone,array('size'=>'50')) }}</dd>
          </dl>
          <dl>
            <dt>Username</dt>
            <dd>{{ Form::text('username',$settings->username,array('size'=>'50','class'=>'required')) }}</dd>
          </dl>
           <dl>
            <dt>Password</dt>
            <dd>{{ Form::password('password','',array('size'=>'50')) }}</dd>
          </dl>
        </li>

      </ul>

      <ul>
        <li>Site Information</li>
        <li class=boxfields>
          <dl>
            <dt>Site name</dt>
            <dd>{{ Form::text('site_name',$settings->site_name,array('size'=>'50')) }}</dd>
          </dl>
          <dl>
            <dt>Facebook</dt>
            <dd>{{ Form::text('facebook',$settings->facebook,array('size'=>'50')) }}</dd>
          </dl>
          <dl>
            <dt>Twitter</dt>
            <dd>{{ Form::text('twitter',$settings->twitter,array('size'=>'50')) }}</dd>
          </dl>
          <dl>
            <dt>LinkedIn</dt>
            <dd>{{ Form::text('linkedIn',$settings->linkedIn,array('size'=>'50')) }}</dd>
          </dl>
        </li>
      </ul>




      <div class=clear><!-- Clear Section --></div>
      	{{ Form::submit('',array('name'=>'saveinfo'))}} &nbsp; {{ Form::reset('',array('name'=>'reset'))}}

    {{ Form::close() }}

  </article>


@stop

@section('headercodes')
  {{ HTML::style('_admin/assets/js/jq-ui/jquery-ui.css') }}
  {{ HTML::script('_admin/assets/js/jquery-ui.js') }}
@stop

@section('extracodes')

    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js') }}
    {{ HTML::script('_admin/assets/js/customValidation.js') }}


@stop
