@extends('layouts._front.dashboard')

@section('content')
    <section id="profile" class="section">
    	<h2 class="section-header uk-h2"><i class="uk-icon-user uk-icon-justify"></i> <span class="title-text">Info</span> <a href="javascript:void(0)" class=" white uk-float-right light" data-uk-toggle="{target:'#profile-panel'}"  class="icon-button-wrapper white uk-float-right light"><i class="uk-icon-justify uk-margin-small-left white uk-icon-angle-up"></i></a> <a href="{{url('dashboard/'.$pages->category.'/edit-info')}}" class="icon-button-wrapper white uk-float-right light"><i class=" icon-image uk-icon-pencil ion ion-edit uk-icon-justify"></i> <span class="light">Edit</span></a>  </h2>
    	<div class="section-content" id="profile-panel">
			<div class="uk-grid" >
	            <div class="uk-width-large-6-10 uk-width-small-1-1 ">
	                <div class="uk-panel uk-panel-box">
	                    <h3 class="uk-panel-title light uk-h1 light">Needed Mock Up / Actual Content</h3>
	                    
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
   
@stop


@section('headercodes')
 
@stop

 
@section('extracodes')  
 {{-- */ /* */ /* --}}
	<script>
		$(document).ready(function(){
						
			
		
			
		});
	</script>
@stop
