@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class="col1">
    	@if($backid==0)
	       {!! Html::link('/dnradmin/products/new',' Category') !!}  &raquo; Add new category
        @elseif($backid==1)
        	{!! Html::link('/dnradmin/products/edit/'.$backid,' Category') !!}  &raquo; Add new category
        @elseif (empty($category))
           {!! Html::link('/dnradmin/category/',' Category') !!}  &raquo;  Add new category
        @else
            {!! Html::link('/dnradmin/category/',' Category') !!}  &raquo; {!! Html::link('/dnradmin/category/view/'.$category_id, $category->fldCategoryName) !!}  &raquo; Add new category
        @endif
        </div>
    </div>



   {!! Form::open(array('url' => '/dnradmin/category/new/'.$category_id.'/'.$backid, 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
    @if(Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif
    @if($errors->category->first('image') && $errors->category->first('image')=="validation.img_min_size")
        <div class="error_text">{!!IMAGES_DIMENSION_ERROR!!}</div>
    @endif
      <ul>
        <li>Category Information</li>

        <li class=boxfields>
          <dl>
            <dt>Title</dt>
            <dd>{!! Form::text('name','',array('size'=>'50','class'=>'required','id'=>'name')) !!}
                 @if($errors->category->first('name'))
                    <div class="error">{!!$errors->category->first('name')!!}</div>
                 @endif
            	<br />
            	<span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>
          </dl>
        </li>

      </ul>

      <ul>
        <li>Description</li>
        <li class=boxfields>
        	{!! Form::textarea('description','',array('id'=>'mods2')) !!}
            @if($errors->category->first('description'))
                <div class="error">{!!$errors->category->first('description')!!}</div>
            @endif
        </li>
      </ul>

      <ul>
        <li>Image</li>
        <li class=boxfields>


          <dl>
            <dt></dt>
            <dd>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                <div>
                  <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                  <span class="fileinput-exists">Change</span><input type="file" name="image"></span>
                  <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
              </div>
             <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Min Dimension</strong>: <span id="dimension">{{ CATEGORY_IMAGE_WIDTH }}px x {{ CATEGORY_IMAGE_HEIGHT }}px</span>
                @if($errors->category->first('image') && $errors->category->first('image')!="validation.img_min_size")
                    <div class="error">{!!$errors->category->first('image')!!}</div>
                 @endif
           </dd>
          </dl>


        </li>
      </ul>


      <div class=clear><!-- Clear Section --></div>
      	{!! Form::hidden('main_id', $category_id)!!}
        {!! Form::hidden('backid', $backid)!!}

      	{!! Form::submit('',array('name'=>'saveinfo'))!!} &nbsp; {!! Form::reset('',array('name'=>'reset'))!!}

    {!! Form::close() !!}

  </article>


@stop

@section('headercodes')
  {!! Html::style('_admin/assets/css/pagination.css') !!}
  {!! Html::style('_admin/plugins/jasny/css/jasny-bootstrap.min.css') !!}
@stop

@section('extracodes')
	<script>
		var mypath = "{!! url('/') !!}";
	</script>
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}
    {!! Html::script('_admin/assets/js/customValidation.js') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js') !!}
    {!! Html::script('_admin/assets/js/count_char.js') !!}
    {!! Html::script('_admin/plugins/jasny/js/jasny-bootstrap.min.js') !!}
    <script>
		var elem1 = $("#name_text");
		$("#name").limiter(50, elem1);
	</script>

@stop
