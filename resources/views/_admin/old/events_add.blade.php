@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control class=col1>
       {{ HTML::image_link('/dnradmin/events','_admin/assets/images/icons/icon_arrow.png',' Go to Events') }}
    </div>

  	<h2 class=line>Events - Add Events</h2>

   {{ Form::open(array('url' => '/dnradmin/events/new', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
    @if($success == 1)
           <div class="success">Record successfully save</div>
    @endif
      <ul>
        <li>Events Information</li>

        <li class=boxfields>
          <dl>
            <dt>Title</dt>
            <dd>{{ Form::text('title','',array('size'=>'50','class'=>'required')) }}</dd>
          </dl>
          <dl>
            <dt>Date</dt>
            <dd>{{ Form::text('events_date','',array('size'=>'50','id'=>'events_date')) }}</dd>
          </dl>
        </li>

      </ul>

      <ul>
        <li>Description</li>
        <li class=boxfields>
        	{{ Form::textarea('description','',array('id'=>'mods2')) }}
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
	<script>
		var mypath = "{{ $pageURL }}";
	</script>
    {{ HTML::script('_admin/manager/tinymce/tiny_mce.js') }}
    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js') }}
    {{ HTML::script('_admin/assets/js/customValidation.js') }}
    {{ HTML::script('_admin/manager/tinymce/styles/mods2.js') }}


	<script>
	 $(function() {
		$( "#events_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
	  });
	</script>


@stop
