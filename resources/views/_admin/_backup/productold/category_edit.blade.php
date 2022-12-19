@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
      <div class="col1">
           	
      @if($backid==0) 
	       {!! Html::links('/dnradmin/products/new','Back') !!}   &raquo; Update category      
        @elseif($backid==1) 
        	{!! Html::links('/dnradmin/products/edit/'.$backid,' Back') !!}    
        @else 
           @if($main_cat->fldCategoryMainID==0)  
              {!! Html::link('/dnradmin/category/',' Category') !!} &raquo; Update category       
           @else   
       	      {!! Html::link('/dnradmin/category/',' Category') !!}  &raquo; {!! Html::link('/dnradmin/category/view/'.$main_cat->fldCategoryMainID, $main_cat->fldCategoryName) !!}  &raquo; Update category      
            @endif              
        @endif   
         </div>
    </div>
    
  	
    
   {!! Form::open(array('url' => '/dnradmin/category/edit/'.$category->fldCategoryID, 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
      @if(Session::has('success')) 
           <div class="success">{!!Session::get('success')!!}</div>
    @endif  
      @if(Session::has('error')) 
      <div class="error_text">{!!Session::get('error')!!}</div>
    @endif
      <ul>
        <li>Category Information</li>
        
        <li class=boxfields>
           <dl>
            <dt>Title</dt>
            <dd>{!! Form::text('name',$category->fldCategoryName,array('size'=>'50','id'=>'name')) !!}
            	<br />
            	<span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>
          </dl>                    
        </li>
        
      </ul>
            
      <ul>
        <li>Description</li>
        <li class=boxfields>
        	{!! Form::textarea('description',$category->fldCategoryDescription,array('id'=>'mods2')) !!}
        </li>
      </ul>
      
      <ul>
        <li>Image</li>
        <li class=boxfields>
          
         

          <dl>
            <dt></dt>
            <dd>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                      @if($category->fldCategoryImage != "")
                        {!! Html::image('upload/category/'.$category->fldCategoryID.'/'.$category->fldCategoryImage) !!}
                      @endif  
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                  <div>
                    <span class="btn btn-default btn-file">
                      <span class="fileinput-new">Select image</span>
                      <span class="fileinput-exists">Change</span>
                      <input type="file" name="image"></span>                     
                  </div>
                </div>        

              <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Dimension</strong>: <span id="dimension">248px × 113px</span>
              
                

            </dd>
          </dl>
                    
          
        </li>
      </ul>
      
      
      <div class=clear><!-- Clear Section --></div>  
        {!! Form::hidden('backid', $backid)!!} 
      	{!! Form::submit('',array('name'=>'saveinfo'))!!}
        
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
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js','') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js','') !!}
    {!! Html::script('_admin/assets/js/count_char.js','') !!}
    {!! Html::script('_admin/plugins/jasny/js/jasny-bootstrap.min.js','') !!}
    <script>				
		var elem1 = $("#name_text");
		$("#name").limiter(50, elem1);
	</script>   
    
@stop