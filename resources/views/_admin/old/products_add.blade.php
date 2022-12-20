@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control class=col1>
    	<div class="col1">
        	{{ HTML::link('/dnradmin/category',' Category') }} &raquo; Add new product
        </div>

    </div>



   {{ Form::open(array('url' => '/dnradmin/products/new', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
    @if($success == 1)
           <div class="success">Record successfully saved</div>
    @endif
    @if($error == 1)
    	<div class="error">Alert: your image does not fit the proper file format and could not be uploaded, please check the image requirements again!</div>
    @endif

      <table border="0" width="1000px;" style="margin-bottom:10px; padding:10px 10px">
      	 <tr>
         	<td style="width:725px; margin-right:10px;" valign="top">

        			<ul style="width:725px;">
                        <li style="width:705px;">Product Information</li>

                        <li class=boxfields style="width:705px;">
                          <dl style="width:705px;">
                            <dt style="width:100px;">Product Name</dt>
                            <dd style="width:525px;">{{ Form::text('name','',array('size'=>'50','class'=>'required','id'=>'name')) }}
                            	<br />
				            	<span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                            </dd>
                          </dl>
                           <dl style="width:725px;">
                            <dt style="width:100px;">Old Price $</dt>
                            <dd style="width:525px;">{{ Form::text('old_price','',array('size'=>'50')) }}</dd>
                          </dl>
                           <dl style="width:725px;">
                            <dt style="width:100px;">Price $</dt>
                            <dd style="width:525px;">{{ Form::text('price','',array('size'=>'50','class'=>'required')) }}</dd>
                          </dl>
                             <dl style="width:725px;">
                            <dt style="width:100px;">Weight</dt>
                            <dd style="width:525px;">{{ Form::text('weight','',array('size'=>'50','class'=>'required')) }}</dd>
                          </dl>
                          <dl style="width:725px;">
                            <dt style="width:100px;">Featured</dt>
                            <dd style="width:525px;"> {{ Form::checkbox('isFeatured',1) }}</dd>
                          </dl>
        				</li>
     				 </ul>

                      <ul style="width:725px;">
                        <li style="width:705px;">Description</li>
                        <li class=boxfields style="width:705px;">
                            {{ Form::textarea('description','',array('id'=>'mods2')) }}
                        </li>
                      </ul>

                      <ul style="width:725px;">
                        <li style="width:705px;">Image</li>
                        <li class=boxfields style="width:705px;">

                          <dl>
                            <dd>{{ Form::file('image') }}
                            	<br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">600px x 350px</span>
                            </dd>
                          </dl>


                        </li>
                      </ul>

                      <ul style="width:725px;">
                        <li style="width:705px;">Multiple Image</li>
                        <li class=boxfields style="width:705px;">

                          <dl>
                            	<dd>{{ Form::file('images[]',array('multiple')) }}
                                <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">600px x 350px</span>
                            </dd>
                          </dl>


                        </li>
                      </ul>

                      <div class=clear><!-- Clear Section --></div>
                        {{ Form::hidden('category_id', $category_id)}}
                        {{ Form::submit('',array('name'=>'saveinfo'))}} &nbsp; {{ Form::reset('',array('name'=>'reset'))}}

            </td>
           <td style="width:265px; vertical-align:top">

                   <div style="background:#fff; border:#ccc 1px solid; width:245px; min-height:200px; margin-bottom:10px;">
                    	<p style="padding:5px 5px; background:#666; color:#fff"><strong>Main Category</strong></p>
                        	<span id="category"></span>
			        </div>

                   <div style="background:#fff; border:#ccc 1px solid; width:245px; min-height:200px; margin-bottom:10px;">
                    	<p style="padding:5px 5px; background:#666; color:#fff"><strong>Sub Category</strong></p>
                        <div id="subcategory"></div>

                   </div>

                    <div style="background:#fff; border:#ccc 1px solid; width:245px; min-height:200px; margin-bottom:10px;">
                    	<p style="padding:5px 5px; background:#666; color:#fff"><strong>Options</strong></p>
                        	<span id="product_options"></span>
			        </div>
                    @foreach($options as $option)
                    <div style="background:#fff; border:#ccc 1px solid; width:245px; min-height:200px; margin-bottom:10px; display:none;" id="options{{$option->id}}">
                    	<p style="padding:5px 5px; background:#666; color:#fff"><strong>{{$option->name}}</strong></p>
                        	<span id="product_options_assets{{$option->id}}"></span>
			        </div>
                    @endforeach


           </td>
		 </tr>
      </table>


    {{ Form::close() }}

  </article>


@stop

@section('headercodes')
  {{ HTML::style('_admin/assets/css/pagination.css') }}
@stop

@section('extracodes')
	<script>
		var category_id = "0";
		var mypath = "{{ $pageURL }}";
		var product_id = "0";
	</script>
    {{ HTML::script('_admin/manager/tinymce/tiny_mce.js') }}
    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js') }}
    {{ HTML::script('_admin/assets/js/jquery-latest.min.js') }}
    {{ HTML::script('_admin/assets/js/customValidation.js') }}
    {{ HTML::script('_admin/manager/tinymce/styles/mods5.js') }}
    {{ HTML::script('_admin/assets/js/count_char.js') }}
	{{ HTML::script('_admin/assets/js/category.js') }}

		<script language="javascript">
			var elem1 = $("#name_text");
			$("#name").limiter(50, elem1);
		</script>

@stop
