@extends('layouts._admin.base')

@section('content')
<article>
    {!! Form::open(array('url' => '/dnradmin/add/CustomImage/store', 'method' => 'post', 'id' => 'pageform', 'files' =>
    true,'class'=>'uk-form')); !!}
    @if(Session::has('success'))
        <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
    @endif
    @if(Session::has('error'))
        <div class="uk-alert uk-alert-danger">{!!Session::get('error')!!}</div>
    @endif
  
    @if(Session::has('upload_error'))
        <div class="uk-alert uk-alert-danger"><strong>Alert:</strong> The following image does not fit the proper file
            dimensions and could not be uploaded, please check the image requirements again. <br><br>
            {!!Session::get('upload_error')!!}</div>
    @endif
<div class="uk-grid">
        <div class="uk-width-large-7-10 uk-width-small-1-1  product-settings-section" id="product-settings-section">
            <ul>
                <li>Image Information</li>
                <li class="boxfields">
                    <div class="required-notification uk-display-block"></div>
                    <div class="uk-grid">
                        <div class="uk-width-large-2-10 uk-width-small-1-1">Image Name</div>
                        <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                            {!! Form::text('name','',array('size'=>'50','class'=>'required','id'=>'name','required'))
                            !!}
                            @if($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                            <br />
                            <span id="name_text" style="font-weight:bold; color:#F00"></span> Remaining characters
                        </div>
                    </div>

                    <div class="uk-grid">
                        {{-- <div class="uk-width-large-2-10 uk-width-small-1-1">Price Range $</div> --}}
                        <div class="uk-width-large-2-10 uk-width-small-1-1">Credit</div>
                        <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                        {{-- {!!
                            Form::text('startPrice','',array('size'=>'50','class'=>'required','style' => 'width: 30%;','placeholder'=>'starting price')) !!}  -  {!!
                            Form::text('endPrice','',array('size'=>'50','class'=>'required','style' => 'width: 30%;','placeholder'=>'ending price')) !!}
                            @if($errors->has('startPrice'))
                                <div class="error">{{ $errors->first('startPrice') }}</div>
                            @endif
                            @if($errors->has('endPrice'))
                                <div class="error">{{ $errors->first('endPrice') }}</div>
                            @endif
                           --}}
                           <select class="required" id="credit_options" name="credit_options" required>
                                <option value="" selected disabled>Select credit</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="6">6</option>
                                <option value="12">12</option>
                            </select>
                            @if($errors->has('credit_options'))
                                <div class="error">{{ $errors->first('credit_options') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="uk-grid">
                        <div class="uk-width-large-1-2 uk-width-small-1-1  uk-padding-remove">
                            <ul>
                                <li>Edited Image (thumbnail)</li>
                                <li class="boxfields">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                            style="width: 200px; height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Select
                                                    image</span>
                                                <span class="fileinput-exists">Change</span><input type="file"
                                                    class="required" name="image" required="required"
                                                    onchange="image_changed()" accept="image/png, image/gif, image/jpeg"></span>
                                            <a href="#" class="btn btn-default fileinput-exists"
                                                data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                    {{-- <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB
                                    &bull; <strong>Min Dimension</strong>: <span
                                        id="dimension">{{ PRODUCT_IMAGE_WIDTH }}px x {{ PRODUCT_IMAGE_HEIGHT }}px</span>
                                    @if($errors->has('image'))
                                            <div class="error">{{ $errors->first('image') }}</div>
                                    @endif --}}
                                </li>
                            </ul>
                        </div>
                        <div class="uk-width-large-1-2 uk-width-small-1-1">
                            <div class="uk-grid option-section-wrapper">
                                <div class="uk-width-small-1-1 product-options-section ">
                                    <ul id="">
                                        <li>Unedited Image (thumbnail)</li>
                                        <li class="boxfields">
                                            <div class="uk-display-block"></div>
                                            <div id="uneditedThumbnail"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="uk-width-large-1-2 uk-width-small-1-1  uk-padding-remove">
                            <ul>
                                <li>Upload RAW Files</li>
                                <li class="boxfields">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview uploadRAWFile" data-trigger="fileinput"
                                            style="width: 200px; height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Select
                                                    RAW File</span>
                                                <span class="fileinput-exists">Change</span><input type="file"
                                                    class="required" name="uploadRAWFile" required="required"
                                                    onchange="image_changed()" accept="image/png, image/gif, image/jpeg"></span>
                                            <a href="#" class="btn btn-default fileinput-exists"
                                                data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                    {{-- <br><strong>Formats</strong>: png, gif, jpg &bull; <strong>Max Size</strong>: 2MB
                                    &bull; <strong>Min Dimension</strong>: <span
                                        id="dimension">{{ PRODUCT_IMAGE_WIDTH }}px x {{ PRODUCT_IMAGE_HEIGHT }}px</span>
                                    @if($errors->has('image'))
                                            <div class="error">{{ $errors->first('image') }}</div>
                                    @endif --}}
                                </li>
                            </ul>
                        </div>

                        <div class="uk-grid">
                            <div class="uk-width-large-1-1 uk-width-small-1-1">
                                <ul>
                                    <li>Description</li>
                                    <li class="boxfields">
                                        {!! Form::textarea('description','',array('id'=>'mods2')) !!}
                                        @if($errors->has('description'))
                                            <div class="error">{{ $errors->first('description') }}</div>
                                         @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                </li>
            </ul>
        </div>
    </div>



    <div class=clear>
        <!-- Clear Section -->
    </div>
    {!! Form::button('Save Record',array('name'=>'saveinfo','class'=>'uk-button uk-button-success',
    'id'=>'saveinfo_product'))!!} &nbsp; {!! Form::reset('Reset',array('name'=>'reset','class'=>'uk-button
    uk-button-danger'))!!}
    {!! Form::close() !!}


</article>


@stop

    @section('headercodes')
    {!! Html::style('_admin/plugins/jasny/css/jasny-bootstrap.min.css') !!}

    @stop

        @section('extracodes')
        <script>
            var mypath = "{!! url('/') !!}";
            var product_id = "0";
            
        </script>
        {!! Html::script('_admin/manager/tinymce/tiny_mce.js') !!}
        {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}
        {!! Html::script('_admin/assets/js/customValidation.js') !!}
        {!! Html::script('_admin/manager/tinymce/styles/mods5.js') !!}
        {!! Html::script('_admin/assets/js/count_char.js') !!}
        {!! Html::script('_admin/plugins/jasny/js/jasny-bootstrap.min.js') !!}
        <script language="javascript">
            var elem1 = $("#name_text");
            $("#name").limiter(50, elem1);

        </script>
        <script>
    function image_changed() {
        var fileInput = document.querySelector('input[type="file"]');
        var file = fileInput.files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            var image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');

                // Set the desired thumbnail width and height
                var thumbnailWidth = 150;
                var thumbnailHeight = 150;

                canvas.width = thumbnailWidth;
                canvas.height = thumbnailHeight;

                ctx.drawImage(image, 0, 0, thumbnailWidth, thumbnailHeight);
                
                // Display the thumbnail in the 'uneditedThumbnail' section
                var uneditedThumbnail = document.getElementById('uneditedThumbnail');
                uneditedThumbnail.innerHTML = '';
                uneditedThumbnail.appendChild(canvas);  
            };
        };

        reader.readAsDataURL(file);
    }
    $('#saveinfo_product').on('click', function(){
		        console.log('saveinfo clciked');
		        $this_notification_id = 'product-settings-section';
			    var required_flds_empty = true;
			    $('#pageform .required').each(function(){
			    	var this_fld_item = $(this);
                    console.log("required feilds : ", this_fld_item.val());
			    	if($.trim(this_fld_item.val()) == ''){
			    		required_flds_empty = false;
			    		this_fld_item.addClass('uk-form-danger');
			    		this_fld_item.removeClass('uk-form-success');
			    		if(this_fld_item.attr('name') == 'image'){
			    			$('.fileinput-preview.thumbnail').addClass('uk-form-danger');
			    		}
			    	}else{
			    		this_fld_item.addClass('uk-form-success');
			    		this_fld_item.removeClass('uk-form-danger');
			    		if(this_fld_item.attr('name') == 'image'){
			    			$('.fileinput-preview.thumbnail').removeClass('uk-form-danger');
			    		}
			    	}
			    });
                if(required_flds_empty === true){	
			       
				            $('.required-notification').html('');
				            $('#pageform').submit();
				            return true;
			    }
			  
			    show_notification($this_notification_id);
			    return false;
		      });

              function show_notification(div_id){
		      	var s_html = '<div class="uk-alert uk-alert-danger">Please enter values for required fields.</div>';
		        $('#'+div_id+' .required-notification').html(s_html);
		          UIkit.Utils.scrollToElement(UIkit.$('#'+div_id));
		      }
</script>
        @stop
