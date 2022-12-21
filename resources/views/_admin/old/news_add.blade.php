@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class="col1">
    	@if($category_id != 0)
	       {{ HTML::link('/dnradmin/news/display/'.$category_id,' News') }}
           @if($newsDisp)
           		&raquo;  {{ HTML::link('/dnradmin/news/display/'.$newsDisp->id,$newsDisp->name) }}
           @endif
           &raquo; Add news
       @else
       	  {{ HTML::link('/dnradmin/news',' News') }} &raquo; Add news
       @endif
       </div>
    </div>



   {{ Form::open(array('url' => '/dnradmin/news/new', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
    @if($success == 1)
           <div class="success">Record successfully saved</div>
    @endif
     <table border="0" width="1000px;" style="margin-bottom:10px; padding:10px 10px">
      	 <tr>
         	<td style="width:725px; margin-right:10px;">
      <ul style="width:725px;">
        <li style="width:705px;">News Information</li>

        <li class=boxfields style="width:705px;">
          <dl style="width:705px;">
            <dt style="width:100px;">Title</dt>
            <dd style="width:525px;">{{ Form::text('title','',array('size'=>'50','class'=>'required','id'=>'title')) }}
            </dd>
          </dl>
          <dl style="width:705px;">
            <dt style="width:100px;">Date</dt>
            <dd style="width:525px;">{{ Form::text('news_date','',array('size'=>'50','id'=>'news_date')) }}</dd>
          </dl>
        </li>

      </ul>

      <ul style="width:725px;">
        <li style="width:705px;" >Description</li>
        <li class=boxfields style="width:705px;">
        	{{ Form::textarea('description','',array('id'=>'mods2')) }}
        </li>
      </ul>
      </td>
     <td style="width:265px; vertical-align:top">
     	<div style="background:#fff; border:#ccc 1px solid; width:245px; min-height:200px; margin-bottom:10px;">
                    	<p style="padding:5px 5px; background:#666; color:#fff"><strong>News Category</strong></p>
                        	<span id="news_category"></span>
        </div>
     </td>
     </tr>
     </table>



      <div class=clear><!-- Clear Section --></div>
      	{{ Form::submit('',array('name'=>'saveinfo'))}} &nbsp; {{ Form::reset('',array('name'=>'reset'))}}

    {{ Form::close() }}

  </article>


@stop

@section('headercodes')
  {{ HTML::style('_admin/assets/js/jq-ui/jquery-ui.css') }}

@stop

@section('extracodes')
	<script>
		var mypath = "{{ $pageURL }}";
	</script>
    {{ HTML::script('_admin/manager/tinymce/tiny_mce.js') }}
    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js') }}
    {{ HTML::script('_admin/assets/js/customValidation.js') }}

    {{ HTML::script('_admin/manager/tinymce/styles/mods5.js') }}
    {{ HTML::script('_admin/assets/js/jquery-ui.js') }}
    <script>
		var mypath = "{{ $pageURL }}";
		var category_id = "0";
	</script>
    {{ HTML::script('_admin/assets/js/news.js') }}

	<script>
	 $(function() {
		$( "#news_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
	  });

	</script>



@stop
