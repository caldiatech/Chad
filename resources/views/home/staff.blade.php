@extends('layouts._front.staff')

@section('content')

	<div class="uk-grid"> 
      <div class="uk-width-1-1">
             <ul class="uk-breadcrumb uk-margin-top">
                    <li>{!! Html::link('/','Home') !!}<span class="divider"></span></li>
                    <li class="active">Staff</li>
             </ul>
    	</div>
    </div>
    
    <h1>Staff</h1>
          
    <div class="uk-grid">  	  
      <div class="uk-width-1-1">
            @foreach($staff as $staffs) 
                <div class="view_staff view-tenth">
                     {!! Html::image('upload/staff/'.$staffs->fldStaffID.'/'.$staffs->fldStaffImage,'',array('id'=>'image')) !!}
                     <div class="staff_info">
                        <h4>{{ $staffs->fldStaffFirstname . ' ' . $staffs->fldStaffLastname }} </h4>
                        <h3>{{ $staffs->fldStaffDepartment }}</h3>
                        
                     </div>                     
                        <div class="mask">
                           <p class="uk-align-center">{!! $staffs->fldStaffDescription !!}</p>
                        </div>
                </div>
            @endforeach
      </div>
  </div>	
      

@stop

@section('headercodes')
	<script>
		var mobileHover = function () {
			$('*').on('touchstart', function () {
				$(this).trigger('hover');
			}).on('touchend', function () {
				$(this).trigger('hover');
			});
		};
		
		mobileHover();
	</script>
@stop