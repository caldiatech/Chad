@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
       <div class="col1">
	       {{ HTML::link('/dnradmin/photos','Photos') }}  &raquo; Create new photos
        </div>
    </div>



   {{ Form::open(array('url' => '/dnradmin/photos/new', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
    @if($success == 1)
           <div class="success">Record successfully saved</div>
    @endif
     @if($error == 1)
    	<div class="error">Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!</div>
    @endif
      <ul>
        <li>Photo Information</li>

        <li class=boxfields>
          <dl>
            <dt>Photo Name</dt>
            <dd>{{ Form::text('name','',array('size'=>'50','class'=>'required','id'=>'name')) }}
            	<br />
            	<span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>
          </dl>
        </li>

      </ul>

      <ul>
        <li>Photo Description</li>
        <li class=boxfields>
        	{{ Form::textarea('description','',array('id'=>'mods2')) }}
        </li>
      </ul>

      <ul>
        <li>Image</li>
        <li class=boxfields>

          <dl>
            <dt>Image</dt>
            <dd>{{ Form::file('image',array('class'=>'required')) }}
            	<br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">990px x 450px</span>
            </dd>
          </dl>


        </li>
      </ul>

      <ul>
        <li>Multiple Images</li>
        <li class=boxfields>

          <dl>
            <dt>Image</dt>
            <dd>{{ Form::file('images[]',array('multiple')) }}
            	<br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">990px x 450px</span>
            </dd>
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

    {{ HTML::script('_admin/manager/tinymce/tiny_mce.js') }}
    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js') }}
    {{ HTML::script('_admin/assets/js/jquery-latest.min.js') }}
    {{ HTML::script('_admin/assets/js/customValidation.js') }}
    {{ HTML::script('_admin/manager/tinymce/styles/mods2.js') }}
    {{ HTML::script('_admin/assets/js/count_char.js') }}
    <script>
		var elem1 = $("#name_text");
		$("#name").limiter(50, elem1);
	</script>

@stop
