@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
      <div class="col1">

      @if($backid==0)
	       {{ HTML::links('/dnradmin/products/new','Back') }}   &raquo; Update category
        @elseif($backid==1)
        	{{ HTML::links('/dnradmin/products/edit/'.$backid,' Back') }}
        @else
       	   {{ HTML::link('/dnradmin/category/',' Category') }}  &raquo; {{ HTML::link('/dnradmin/category/view/'.$main_cat->id, $main_cat->name) }}  &raquo; Update category
        @endif
         </div>
    </div>



   {{ Form::open(array('url' => '/dnradmin/category/edit/'.$category->id, 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
     @if($success == 1)
           <div class="success">Record successfully save</div>
    @endif
     @if($error == 1)
    	<div class="error">Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!</div>
    @endif
      <ul>
        <li>Category Information</li>

        <li class=boxfields>
           <dl>
            <dt>Title</dt>
            <dd>{{ Form::text('name',$category->name,array('size'=>'50','id'=>'name')) }}
            	<br />
            	<span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>
          </dl>
        </li>

      </ul>

      <ul>
        <li>Description</li>
        <li class=boxfields>
        	{{ Form::textarea('description',$category->description,array('id'=>'mods2')) }}
        </li>
      </ul>

      <ul>
        <li>Image</li>
        <li class=boxfields>

          <dl>
            <dt>Image</dt>
            <dd>{{ Form::file('image') }}
            	<br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">248px × 113px</span>
            	@if ($category->image != "")
                	<br />
                	{{ HTML::image('upload/category/'.$category->id.'/_75_'.$category->image) }}
               @endif


            </dd>
          </dl>


        </li>
      </ul>


      <div class=clear><!-- Clear Section --></div>
        {{ Form::hidden('backid', $backid)}}
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
    {{ HTML::script('_admin/manager/tinymce/styles/mods2.js') }}
      {{ HTML::script('_admin/assets/js/count_char.js') }}
    <script>
		var elem1 = $("#name_text");
		$("#name").limiter(50, elem1);
	</script>

@stop
