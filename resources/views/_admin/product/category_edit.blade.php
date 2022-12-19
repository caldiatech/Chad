@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
      <div class="col2">
           	
      @if($backid==0) 
	       {!! Html::links('/dnradmin/products/new','Back') !!}   &raquo; Update {{ CATEGORY_MANAGEMENT }}      
        @elseif($backid==1) 
        	{!! Html::links('/dnradmin/products/edit/'.$backid,' Back') !!}    
        @else 
           @if($main_cat->fldCategoryMainID==0)  
              {!! Html::link('/dnradmin/category/',CATEGORY_MANAGEMENT) !!} &raquo; Update {{ CATEGORY_MANAGEMENT }}       
           @else   
       	      {!! Html::link('/dnradmin/category/',CATEGORY_MANAGEMENT) !!}  &raquo; {!! Html::link('/dnradmin/category/view/'.$main_cat->fldCategoryMainID, $main_cat->fldCategoryName) !!}  &raquo; Update {{ CATEGORY_MANAGEMENT }}      
            @endif              
        @endif   
         </div>
    </div>
    
  	
    
   {!! Form::open(array('url' => '/dnradmin/category/edit/'.$category->fldCategoryID, 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')); !!}
      @if(Session::has('success')) 
           <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
    @endif  
    @if($errors->category->first('image') && $errors->category->first('image')=="validation.img_min_size")
        <div class="uk-alert uk-alert-danger">{!!IMAGES_DIMENSION_ERROR!!}</div>
    @endif

    <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>Contact Information</li>
               <li class="boxfields">

                     <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Title</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                           {!! Form::text('name',$category->fldCategoryName,array('size'=>'50','id'=>'name')) !!}
                            @if($errors->category->first('name'))
                                <div class="error">{!!$errors->category->first('name')!!}</div>
                             @endif
                          <br />
                          <span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Sub Title</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                           {!! Form::text('sub_title',$category->fldCategorySubTitle,array('size'=>'50','class'=>'required','id'=>'sub_title')) !!}
                             @if($errors->category->first('sub_title'))
                                <div class="error">{!!$errors->category->first('sub_title')!!}</div>
                             @endif
                          <br />
                          <span id="sub_title_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                      </div>
                   </div>

               </li>
           </ul>
        </div>
    </div>            

   <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>Description</li>
               <li class="boxfields">
                   {!! Form::textarea('description',$category->fldCategoryDescription,array('id'=>'mods2')) !!}
                   @if($errors->category->first('description'))
                     <div class="error">{!!$errors->category->first('description')!!}</div>
                   @endif
               </li>
            </ul>
        </div>
     </div>

     <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>Image</li>
               <li class="boxfields">
                   <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                          @if($category->fldCategoryImage != "")
                            {!! Html::image(CATEGORY_IMAGE_PATH.$category->fldCategorySlug.'/'.$category->fldCategoryImage) !!}
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

                  <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Min Dimension</strong>: <span id="dimension">{{ CATEGORY_IMAGE_WIDTH }}px × {{ CATEGORY_IMAGE_HEIGHT }}px</span>
                  
                    @if($errors->category->first('image') && $errors->category->first('image')!="validation.img_min_size")
                        <div class="error">{!!$errors->category->first('image')!!}</div>
                     @endif
               </li>
            </ul>
        </div>
     </div>
            
      
      
      
      <div class=clear><!-- Clear Section --></div>  
        {!! Form::hidden('backid', $backid)!!} 
      	{!! Form::submit('Save Record',array('name'=>'saveinfo','class'=>'uk-button uk-button-success'))!!} 
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
    var elem2 = $("#sub_title_text");
    $("#name").limiter(50, elem1);
    $("#sub_title").limiter(150, elem2);
	</script>   
    
@stop