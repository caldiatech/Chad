@extends('layouts._admin.base')

@section('content')
   <article>
    <div id=page_control>

       <div class="col1">
        {!! Html::link('/dnradmin/pages','Page Management') !!}  &raquo; Update page
       </div>
    </div>
    
      
    
   {!! Form::open(array('url' => '/dnradmin/pages/edit/'.$page->fldPagesID, 'method' => 'post', 'id' => 'pageform', 'files' => true)) !!}
     @if (Session::has('success'))
           <div class="success">{!!Session::get('success')!!}</div>
    @endif    
     @if($errors->pages->first('image') && $errors->pages->first('image')=="validation.img_min_size")
        <div class="error_text">{!!IMAGES_DIMENSION_ERROR!!}</div>
    @endif
    @if (Session::has('success_image'))
           <div class="error_text">{!!Session::get('success_image')!!}</div>
    @endif 
      <ul>
        <li>Page Information</li>
        
         
        <li class=boxfields>
          @if($page->fldPagesID != 32)
          <dl>
            <dt>Main Menu</dt>
            <dd>{!! Form::select('main_id',array('0' => 'Select one')+$pagelist,$page->fldPagesMainID) !!}</dd>
          </dl>   
          @endif
          <dl>
            <dt>Page Name</dt>
            <dd>{!! Form::text('name',$page->fldPagesName,array('size'=>'50','id'=>'name')) !!}
                @if($errors->pages->first('name'))
                    <div class="error">{!!$errors->pages->first('name')!!}</div>
                 @endif
              <br />
              <span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>
          </dl>      
        
          <dl>
            <dt>Page Title</dt>
            <dd>{!! Form::text('title',$page->fldPagesTitle,array('size'=>'50','class'=>'required','id'=>'page_title')) !!}
               @if($errors->pages->first('title'))
                    <div class="error">{!!$errors->pages->first('title')!!}</div>
                 @endif
              <br />
              <span id="title_text" style="font-weight:bold; color:#F00"></span> Remaining characters
            </dd>            
          </dl> 

          @if($page->fldPagesID == 73)
            <dl>
                <dt>Page Sub Title</dt>
                <dd>
                  {!! Form::text('page_sub_title',$page->fldPagesSubTitle,array('size'=>'50','class'=>'required','id'=>'page_sub_title')) !!}
                     @if($errors->pages->first('page_sub_title'))
                        <div class="error">{!!$errors->pages->first('page_sub_title')!!}</div>
                     @endif
                  <br />
                  <span id="sub_title_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                </dd>            
            </dl>
          @endif

          @if($page->fldPagesID == 32)
             <dl>
                <dt>Page Sub Title</dt>
                <dd>
                  {!! Form::text('page_sub_title',$page->fldPagesSubTitle,array('size'=>'50','class'=>'required','id'=>'page_sub_title')) !!}
                     @if($errors->pages->first('page_sub_title'))
                        <div class="error">{!!$errors->pages->first('page_sub_title')!!}</div>
                     @endif
                  <br />
                  <span id="sub_title_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                </dd>            
            </dl>
            <dl>
                <dt>Page Sub Title Button</dt>
                <dd>
                  {!! Form::text('page_button',$page->fldPagesButton,array('size'=>'50','class'=>'required','id'=>'page_button')) !!}
                     @if($errors->pages->first('page_button'))
                        <div class="error">{!!$errors->pages->first('page_button')!!}</div>
                     @endif
                  <br />
                  <span id="page_button_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                </dd>            
            </dl>
            <dl>
                <dt>Page Sub Title Button Links</dt>
                <dd>
                  {!! Form::text('page_button_links',$page->fldPagesButtonLinks,array('size'=>'50','class'=>'required','id'=>'page_button_links')) !!}                     
                </dd>            
            </dl>
	    	
          @endif
           <dl>
            <dt>URL</dt>
            <dd>
              @if($page->fldPagesFilename != "")
                  {!! Html::link($page->filename,url($page->fldPagesFilename),array('target'=>'_blank')) !!}
                @else
                  @if($page->fldPagesID  == 32) 
                     {!! Html::link(url(),url(),array('target'=>'_blank')) !!}
                  @else
                   {!! Html::link($page->fldPagesSlug,url("/".$page->fldPagesSlug),array('target'=>'_blank')) !!}
                  @endif    
                @endif
            </dd>            
          </dl> 
           
          
          @if($page->fldPagesFilename == "" && $page->fldPagesID != 32)
          <dl>
            <dt>Image</dt>
            <dd>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                      @if($page->fldPagesImage != "")
                        {!! Html::image(PAGES_IMAGE_PATH.MEDIUM_IMAGE.$page->fldPagesImage,'',array( 'width' => 200 )) !!}
                      @endif  
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                  <div>
                    <span class="btn btn-default btn-file">
                      <span class="fileinput-new">Select image</span>
                      <span class="fileinput-exists">Change</span>
                      <input type="file" name="image"></span>
                      @if($page->fldPagesImage != "")
                        <a href="{!!url('dnradmin/pages/remove_image/'.$page->fldPagesID)!!}" class="btn btn-danger">Remove</a>
                      @endif  
                  </div>
                </div>                
              <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB &bull; <strong>Min Dimension</strong>: <span id="dimension">{{ PAGES_IMAGE_WIDTH }}px x {{ PAGES_IMAGE_HEIGHT }}px</span>
                 @if($errors->pages->first('image') && $errors->pages->first('image')!="validation.img_min_size")
                    <div class="error">{!!$errors->pages->first('image')!!}</div>
                 @endif
            </dd>            
          </dl>
          @endif

          @if($page->fldPagesID != 32) 
            <dl>
              <dt>Show to Navigation</dt>
              
              <dd>{!! Form::checkbox('isVisible', 1,$checked = $page->fldPagesIsVisible == 1 ? true : false)!!}</dd>
            </dl>  
            
            <dl>
              <dt>CMS</dt>
              
              <dd>{!! Form::checkbox('isCMS', 1,$checked = $page->fldPagesIsCMS == 1 ? true : false)!!}</dd>
            </dl>
            
            <dl>
              <dt>Filename</dt>
              <dd>{!! Form::text('filename',$page->fldPagesFilename,array('size'=>'50','id'=>'filename')) !!}</dd>            
            </dl>    
          @endif   
	  @if($page->fldPagesID == 72) 
            <dl>
              <dt>&nbsp;</dt>
                  <a href="{!!url('dnradmin/slider')!!}" class="btn btn-danger">Bottom Slider</a>
              <dd></dd>
            </dl>
          @endif
        </li>        
      </ul>
      
      
      

     
       

       @if($page->fldPagesID == 72) 
      <ul>
        <li>Page Content</li>
        <li class=boxfields>
          {!! Form::textarea('description',$page->fldPagesDescription,array('id'=>'mods2')) !!}          
        </li>
        @if($errors->first('description'))
        <li class="error">
           {!! $errors->first('description') !!}
        </li>
        @endif
      </ul>
	<ul>
        <li>Page Content</li>
        <li class=boxfields>
          {!! Form::textarea('description2',$page->fldPagesDescription2,array('id'=>'mods3')) !!}          
        </li>
       
      </ul>

      @endif	
	
      @if($page->fldPagesID != 32 && $page->fldPagesID != 72) 
      <ul>
        <li>Page Content</li>
        <li class=boxfields>
          {!! Form::textarea('description',$page->fldPagesDescription,array('id'=>'mods2')) !!}
        </li>
        @if($errors->first('description'))
        <li class="error">
           {!! $errors->first('description') !!}
        </li>
        @endif
      </ul>
      @endif

      <div class=clear><!-- Clear Section --></div>  
        {!! Form::hidden('Id',$page->fldPagesID) !!} 
        {!! Form::submit('',array('name'=>'saveinfo'))!!}
        <input type="hidden" name="isLive" value="1">
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
    {!! Html::script('_admin/assets/js/assets/js/jquery.pagination.js') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js') !!}
   @if($page->fldPagesID == 72)   {!! Html::script('_admin/manager/tinymce/styles/mods3.js') !!} @endif
    {!! Html::script('_admin/assets/js/count_char.js') !!}
    {!! Html::script('_admin/plugins/jasny/js/jasny-bootstrap.min.js') !!}

   <script>         
    var elem1 = $("#name_text");
    var elem2 = $("#title_text");
    var elem3 = $("#sub_title_text");
    var elem4 = $("#page_button_text");
    
    $("#name").limiter(50, elem1);
    $("#page_title").limiter(22, elem2);
    @if($page->fldPagesID == 73)
      $("#page_sub_title").limiter(150, elem3);
    @else 
      $("#page_sub_title").limiter(76, elem3);
    @endif  
    $("#page_button").limiter(19, elem4);
    
    
   </script>     
    
@stop