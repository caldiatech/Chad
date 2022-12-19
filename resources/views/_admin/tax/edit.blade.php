@extends('layouts._admin.base')

@section('content')
   <article>
  	<div id=page_control>
       <div class="col2">
	       {!! Html::link('/dnradmin/state',"Tax") !!} <i class="pe-7s-angle-right"></i> Update Tax
        </div>
    </div>
    
  
    
   {!! Form::open(array('url' => '/dnradmin/state/edit/'.$state->fldStateID, 'method' => 'post', 'id' => 'pageform', 'files' => true,'class'=>'uk-form')); !!}
     @if (Session::has('success'))
           <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
    @endif
      @if (Session::has('error'))
           <div class="uk-alert uk-alert-danger">{!!Session::get('error')!!}</div>
     @endif  

     <div class="uk-grid">
        <div class="uk-width-large-1-1 uk-width-small-1-1">
            <ul>
               <li>Tax Information</li>
               <li class="boxfields">
                    

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">State</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                           {{ $state->fldStateName . "( ".$state->fldStateID . " )" }}
                      </div>
                   </div> 

                   <div class="uk-grid">
                      <div class="uk-width-large-1-10 uk-width-small-1-1">Tax</div>
                      <div class="uk-width-large-6-10 uk-width-small-1-1 ">
                           {!! Form::text('tax',$state->fldStateTax,array('size'=>'50','class'=>'required')) !!}  %                          
                      </div>
                   </div> 

                  


               </li>
            </ul>
        </div>
     </div>  

            
      
      <div class=clear><!-- Clear Section --></div>   
      	{!! Form::submit('Save Record',array('name'=>'saveinfo','class'=>'uk-button uk-button-success'))!!}
        
    {!! Form::close() !!}
    
  </article>
  

@stop

@section('headercodes')    
  {!! Html::style('_admin/assets/css/pagination.css') !!}  
@stop

@section('extracodes')
	<script>
		var mypath = "{!! url('/') !!}";
	</script>
    {!! Html::script('_admin/manager/tinymce/tiny_mce.js','') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
    {!! Html::script('_admin/assets/js/assets/js/jquery.pagination.js','') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js','') !!}
       
    
@stop