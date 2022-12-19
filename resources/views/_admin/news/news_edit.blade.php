@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
    	<div class="col1">
        @if($category_id != 0) 
           {!! Html::link('/dnradmin/news/display/'.$category_id,' News') !!} 
               @if($newsDisp)
                    &raquo;  {!! Html::link('/dnradmin/news/display/'.$newsDisp->fldNewsCategoryID,$newsDisp->fldNewsCategoryName) !!} 
               @endif
               &raquo; Update news
           @else
              {!! Html::link('/dnradmin/news',' News') !!} &raquo; Update news
           @endif    
        </div>
    </div>
    
  	<h2 class=line>News - Update News</h2>    
    
   {!! Form::open(array('url' => '/dnradmin/news/edit/'.$news->fldNewsID, 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
   @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif 
     <table border="0" width="1000px;" style="margin-bottom:10px; padding:10px 10px">
      	 <tr>
         	<td style="width:725px; margin-right:10px;">
              <ul style="width:725px;">
                <li style="width:705px;">News Information</li>
        
        <li class=boxfields style="width:705px;">
           <dl style="width:705px;">
            <dt style="width:100px;">Title</dt>
            <dd style="width:525px;">{!! Form::text('title',$news->fldNewsName,array('size'=>'50')) !!}</dd>
          </dl> 
          <dl style="width:705px;">
            <dt style="width:100px;">Date</dt>
            <dd style="width:525px;">{!! Form::text('news_date',$news->fldNewsNewsDate,array('size'=>'50','id'=>'news_date')) !!}</dd>
          </dl>                    
        </li>
        
      </ul>
            
      <ul style="width:725px;">
        <li style="width:705px;">Description</li>
        <li class=boxfields style="width:705px;">
        	{!! Form::textarea('description',$news->fldNewsDescription,array('id'=>'mods2')) !!}
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
      	{!! Form::submit('',array('name'=>'saveinfo'))!!} 
        
    {!! Form::close() !!}
    
  </article>
  

@stop

@section('headercodes')    
   {!! Html::style('_admin/assets/js/jq-ui/jquery-ui.css') !!}    
@stop

@section('extracodes')
	<script>
		var mypath = "{!! url('/') !!}";
	</script>
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js','') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods5.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-ui.js','') !!}
    <script>
		var mypath = "{!! url('/') !!}";
		var category_id = "{!! $category_id !!}";
	</script>
    {!! Html::script('_admin/assets/js/news.js','') !!}
	 
     <script>
	 $(function() {
		$( "#news_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
	  });
	</script>      
    
@stop