@extends('layouts._admin.base')

@section('content')
   <article>
    <div id=page_control>
        <div class="col2">
           {!! Html::link('#','Unedited text') !!} 
        </div>   
    </div>
    
    <!-- @if(isset($uneditedText) && !empty($uneditedText)) -->
        {!! Form::open(array('url' => '/dnradmin/unedited-text-addedit', 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')); !!}
    <!-- @else
        {!! Form::open(array('url' => '/dnradmin/unedited-text-add', 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')); !!}
    @endif -->

     @if (Session::has('success'))
           <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
    @endif    
     @if(Session::has('email_error')) 
      <div class="uk-alert uk-alert-danger">{!!Session::get('email_error')!!}</div>
    @endif
     @if(Session::has('username_error')) 
      <div class="uk-alert uk-alert-danger">{!!Session::get('username_error')!!}</div>
    @endif  

    <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>Unedited Text Information</li>
               <li class="boxfields">
                    <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Text</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                         {!! Form::textarea('text', isset($uneditedText) && !empty($uneditedText) ? $uneditedText->text : '', array('class' => 'required', 'required', 'id' => 'text', 'rows' => 4, 'cols' => 50)) !!}

                         @if($errors->uneditedText->first('text'))
                            <div class="error">{!!$errors->uneditedText->first('text')!!}</div>
                         @endif
                      </div>
                   </div>
               </li>
            </ul>
        </div>
    </div>            

     
                
        <div class=clear><!-- Clear Section --></div>   
        {!! Form::submit('Save Record',array('name'=>'saveinfo','class'=>'uk-button uk-button-success'))!!} &nbsp; {!! Form::reset('Reset',array('name'=>'reset','class'=>'uk-button uk-button-danger'))!!}         
    {!! Form::close() !!}
    
  </article>
  

@stop

@section('headercodes')    
  {!! Html::style('_admin/assets/css/pagination.css') !!}
  {!! Html::style('_admin/assets/plugins/password/strength.css') !!}  
@stop

@section('extracodes')
   {!! Html::style('_front/plugins/uikit/css/uikit.css') !!}
   {!! Html::script('_front/uikit/plugins/js/uikit.js') !!}
    <script>
        var mypath = "{!! url('/') !!}";
    </script>
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}
    {!! Html::script('_admin/assets/js/customValidation.js') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js') !!}
    {!! Html::script('_admin/plugins/password/strength.js') !!}
    
    <script>
      $(document).ready(function($) {
  
          $('#password-fld').strength({
              strengthClass: 'strength',
              strengthMeterClass: 'strength_meter',
              strengthButtonClass: 'button_strength',
              strengthButtonText: 'Show Password',
              strengthButtonTextToggle: 'Hide Password'
          });

      });


    </script>      
    
@stop