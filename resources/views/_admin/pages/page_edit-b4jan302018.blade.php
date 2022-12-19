@extends('layouts._admin.base')

@section('content')
   <article>
    <div id=page_control>

       <div class="col2">
        {!! Html::link('/dnradmin/pages',PAGE_MANAGEMENT) !!} <i class="pe-7s-angle-right"></i> Update page
       </div>
    </div>
    
      
    
   {!! Form::open(array('url' => '/dnradmin/pages/edit/'.$page->fldPagesID, 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')) !!}
    
    {!! Html::flash_msg_admin() !!}

     <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>Page Information</li>
               <li class="boxfields">

               		<? /*
                    @if($page->fldPagesID != 32)
                       <div class="uk-grid">
                          <div class="uk-width-large-1-10 uk-width-small-1-1">Main Menu</div>
                          <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                             {!! Form::select('main_id',array('0' => 'Select one')+$pagelist,$page->fldPagesMainID) !!}
                          </div>
                       </div>
                   @endif
					*/ ?>
					
                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Page Name</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::text('name',$page->fldPagesName,array('size'=>'50','class'=>'required','id'=>'name')) !!}
                           @if($errors->pages->first('name'))
                              <div class="error">{!!$errors->pages->first('name')!!}</div>
                           @endif
                           <br />
                           <span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                      </div>
                   </div>

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Page Title</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                             {!! Form::text('title',$page->fldPagesTitle,array('size'=>'50','id'=>'page_title')) !!}
                             @if($errors->pages->first('title'))
                                <div class="error">{!!$errors->pages->first('title')!!}</div>
                             @endif
                          <br />
                          <span id="title_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                      </div>
                   </div> 

                   <? /* @if($page->fldPagesID == 73) */ ?>
                      <div class="uk-grid">
                          <div class="uk-width-large-1-10 uk-width-small-1-1">Page Sub Title</div>
                          <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                                  {!! Form::text('page_sub_title',$page->fldPagesSubTitle,array('size'=>'50','class'=>'required','id'=>'page_sub_title')) !!}
                                     @if($errors->pages->first('page_sub_title'))
                                        <div class="error">{!!$errors->pages->first('page_sub_title')!!}</div>
                                     @endif
                                  <br />
                                  <span id="sub_title_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                          </div>
                       </div> 
                   <? /* @endif */ ?>

                   @if($page->fldPagesID == 32)
                        <div class="uk-grid">
                          <div class="uk-width-large-1-10 uk-width-small-1-1">Page Sub Title</div>
                          <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                                 {!! Form::text('page_sub_title',$page->fldPagesSubTitle,array('size'=>'50','class'=>'required','id'=>'page_sub_title')) !!}
                                   @if($errors->pages->first('page_sub_title'))
                                      <div class="error">{!!$errors->pages->first('page_sub_title')!!}</div>
                                   @endif
                                <br />
                                <span id="sub_title_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                          </div>
                       </div> 

                       <div class="uk-grid">
                          <div class="uk-width-large-1-10 uk-width-small-1-1">Page Sub Title Button</div>
                          <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                                 {!! Form::text('page_button',$page->fldPagesButton,array('size'=>'50','class'=>'required','id'=>'page_button')) !!}
                                   @if($errors->pages->first('page_button'))
                                      <div class="error">{!!$errors->pages->first('page_button')!!}</div>
                                   @endif
                                <br />
                                <span id="page_button_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                          </div>
                       </div> 

                        <div class="uk-grid">
                          <div class="uk-width-large-1-10 uk-width-small-1-1">Page Sub Title Button Links</div>
                          <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                               {!! Form::text('page_button_links',$page->fldPagesButtonLinks,array('size'=>'50','class'=>'required','id'=>'page_button_links')) !!} 
                          </div>
                       </div> 

                   @endif

                   <div class="uk-grid">
                          <div class="uk-width-large-1-10 uk-width-small-1-1">URL</div>
                          <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                            @if($page->fldPagesFilename != "")
                                {!! Html::link($page->fldPagesFilename,url($page->fldPagesFilename),array('target'=>'_blank')) !!}
                            @else
                                @if($page->fldPagesID  == 32) 
                                    {!! Html::link(url(),url(),array('target'=>'_blank')) !!}
                                @else
                                    {!! Html::link($page->fldPagesSlug,url("/".$page->fldPagesSlug),array('target'=>'_blank')) !!}
                                @endif
                            @endif
                          </div>
                       </div> 

                        <? /* @if($page->fldPagesFilename == "" && $page->fldPagesID != 32) */ ?>
                        @if(in_array($page->fldPagesID, array(32))) 
                            <!-- Do not display Image upload -->
                        @else
                            <div class="uk-grid">
                                <div class="uk-width-large-1-10 uk-width-small-1-1">Image</div>
                                <div class="uk-width-large-6-10 uk-width-small-1-1 ">
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
                                </div>
                             </div> 
                        @endif


                        <? /* @if($page->fldPagesID != 32) */ ?>
                        @if(in_array($page->fldPagesID, array(32,73))) 
                            <!-- Do not display Filename -->
                        @else
                        	   <? /*
                              <div class="uk-grid">
                                  <div class="uk-width-large-1-10 uk-width-small-1-1">Show to Navigation</div>
                                  <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                                      {!! Form::checkbox('isVisible', 1,$checked = $page->fldPagesIsVisible == 1 ? true : false, ['class' => "check-select"])!!}
                                  </div>
                               </div>
                                <div class="uk-grid">
                                  <div class="uk-width-large-1-10 uk-width-small-1-1">CMS</div>
                                  <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                                      {!! Form::checkbox('isCMS', 1,$checked = $page->fldPagesIsCMS == 1 ? true : false, ['class' => "check-select"])!!}
                                  </div>
                               </div> 
                                */ ?>

                               <div class="uk-grid">
                                  <div class="uk-width-large-1-10 uk-width-small-1-1">Filename</div>
                                  <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                                      {!! Form::text('filename',$page->fldPagesFilename,array('size'=>'50','id'=>'filename')) !!}
                                      <br>
                                      * Enter filename, if using a custom page template
                                  </div>
                               </div> 

                                <? /*
                                @if($page->fldPagesID == 72) 
                                     <div class="uk-grid">
                                          <div class="uk-width-large-1-10 uk-width-small-1-1">&nbsp;</div>
                                          <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                                              <a href="{!!url('dnradmin/slider')!!}" class="btn btn-danger">Bottom Slider</a>
                                          </div>
                                       </div> 
                                @endif
                                */ ?>
                        @endif


               </li>
            </ul>
        </div>
     </div>           


    @if(in_array($page->fldPagesID, array(32,73,102))) 
        <!-- Do not display Page Content -->
    @else
    <? /* @if($page->fldPagesID == 72) */ ?>
          <div class="uk-grid">
                <div class="uk-width-large-1-1 uk-width-small-1-1">
                    <ul>
                       <li>Page Content</li>
                        @if($errors->first('description'))
                            <li class="error">{!! $errors->first('description'); !!}</li>           
                        @endif
                       <li class="boxfields">
                            {!! Form::textarea('description',$page->fldPagesDescription,array('id'=>'mods2')) !!} 
                       </li>
                    </ul>
                </div>
             </div>

            <? /*
             <div class="uk-grid">
                <div class="uk-width-large-1-1 uk-width-small-1-1">
                    <ul>
                       <li>Page Content</li>
                        @if($errors->first('description'))
                            <li class="error">{!! $errors->first('description'); !!}</li>           
                        @endif
                       <li class="boxfields">
                            {!! Form::textarea('description2',$page->fldPagesDescription2,array('id'=>'mods3')) !!} 
                       </li>
                    </ul>
                </div>
             </div>
            */ ?>
    @endif

    @if(in_array($page->fldPagesID, array(74,85,88,102))) 
      <div class="uk-grid">
            <div class="uk-width-large-1-1 uk-width-small-1-1">
                <ul>
                    <li><?=($page->fldPagesID == 74)? 'Framing Samples': 'Page Content 2';?>
                    </li>
                    <li class="boxfields">
                        {!! Form::textarea('description2',$page->fldPagesDescription2,array('id'=>'mods6')) !!}
                    </li>
                </ul>
            </div>
         </div>
    @endif

    <? /*     
      @if($page->fldPagesID != 32 && $page->fldPagesID != 72)
          <div class="uk-grid">
                <div class="uk-width-large-1-1 uk-width-small-1-1">
                    <ul>
                        <li>Page Content 
                        @if($errors->first('description'))
                            <div class="error">* {!! $errors->first('description'); !!}</div>
                        @endif
                        </li>
                        <li class="boxfields">
                            {!! Form::textarea('description',$page->fldPagesDescription,array('id'=>'mods')) !!}
                        </li>
                    </ul>
                </div>
             </div>
      @endif
    */ ?> 
       

        <div class=clear><!-- Clear Section --></div>  
        {!! Form::hidden('Id',$page->fldPagesID) !!} 
        <input type="hidden" name="isLive" value="1">
        {!! Form::submit('Save Record',array('name'=>'saveinfo','class'=>'uk-button uk-button-success'))!!}

        <input type="hidden" name="isLive" value="1">
    {!! Form::close() !!}
    
  </article>
  

@stop

@section('headercodes')    
  {!! Html::style('_admin/plugins/jasny/css/jasny-bootstrap.min.css') !!}  
@stop

@section('extracodes')
  <script>
    var mypath = "{!! url('/') !!}";
  </script>
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
    {!! Html::script('_admin/assets/js/assets/js/jquery.pagination.js','') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js','') !!}

    @if(in_array($page->fldPagesID, array(74,85,88,102)))  {!! Html::script('_admin/manager/tinymce/styles/mods6.js','') !!} @endif

    <? /* @if($page->fldPagesID == 72)   {!! Html::script('_admin/manager/tinymce/styles/mods3.js','') !!} @endif */ ?>

    {!! Html::script('_admin/assets/js/count_char.js','') !!}
    {!! Html::script('_admin/plugins/jasny/js/jasny-bootstrap.min.js','') !!}

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