@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
       <div class="col1">
	       {{ HTML::link('/dnradmin/contact','Contact') }} &raquo; Update contact
        </div>
    </div>



   {{ Form::open(array('url' => '/dnradmin/contact/edit/'.$contact->id, 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
     @if($success == 1)
           <div class="success">Record successfully saved</div>
    @endif
      <ul>
        <li>Contact Information</li>

        <li class=boxfields>
           <dl>
            <dt>First name</dt>
            <dd>{{ Form::text('firstname',$contact->firstname,array('size'=>'50','class'=>'required')) }}</dd>
          </dl>
           <dl>
            <dt>Last name</dt>
            <dd>{{ Form::text('lastname',$contact->lastname,array('size'=>'50','class'=>'required')) }}</dd>
          </dl>
          <dl>
            <dt>Email Address</dt>
            <dd>{{ Form::text('email',$contact->email,array('size'=>'50','class'=>'required')) }}</dd>
          </dl>
           <dl>
            <dt>Phone no</dt>
            <dd>{{ Form::text('phone',$contact->phone,array('size'=>'50')) }}</dd>
          </dl>
          <dl>
            <dt>Subject</dt>
            <dd>{{ Form::text('subject',$contact->subject,array('size'=>'50')) }}</dd>
          </dl>

        </li>

      </ul>

      <ul>
        <li>Biography</li>
        <li class=boxfields>
        	{{ Form::textarea('comments',$contact->comments,array('id'=>'mods2')) }}
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
	<script>
		var mypath = "{{ $pageURL }}";
	</script>
    {{ HTML::script('_admin/manager/tinymce/tiny_mce.js') }}
    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js') }}
    {{ HTML::script('_admin/assets/js/jquery-latest.min.js') }}
    {{ HTML::script('_admin/assets/js/assets/js/jquery.pagination.js') }}
    {{ HTML::script('_admin/manager/tinymce/styles/mods2.js') }}


@stop
