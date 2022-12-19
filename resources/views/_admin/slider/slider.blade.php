@extends('layouts._admin.base')

@section('content')
    <article>
    <div id="page_control"> 
    	<div class="col2">                   	       
         <a href="{{url('dnradmin/slider/new')}}"><img src="{{url('_admin/assets/images/icons/icon_add.png')}}"> Add Slider</a>
        </div>   
        <div class="col1">        	
          {!! Html::link('/dnradmin/pages/edit/72','The works page') !!}  &raquo; Slider
        </div>
    </div>
    

    
    <br style="clear:both;" />
      <input type='hidden' id='current_page' />  
	  <input type='hidden' id='show_per_page' />  
      <input type='hidden' id='number_of_items' />   		
	  <label for="search">Search:</label> <input type="text" id="search" value="" style="height:20px;"/>	
   
    {!! Form::open(array('url' => '/dnradmin/slider/', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
         
    <table id="page_manager">
      <thead>
        <tr class="headers nodrag">
          <th width="70" data-sort="int"> <span class="id">ID</span> <div class="sort"></div> </th>  
          <th width="150">  </th>            
          <th width="450" data-sort="string"><span class="id">Slide Name</span> <div class="sort"></div></th>
          <th width="70" data-sort="int"><span class="id">Position</span> <div class="sort"></div></th>
        
          <th width="150" align="right">Action</th>
        </tr>
      </thead>
      
      <tbody id="Searchresult">     
      				@if ($slider->isEmpty()) 
                    	<tr>
                        	<td class="error" colspan="5" align="center"> No Record Found</td>
                        </tr>
                    @endif   
                    	
          			@foreach ($slider as $sliders)
                      
                    <tr id="{!!$sliders->fldSliderID.'_'.$sliders->fldSliderPosition!!}">
                       <td>{!! $sliders->fldSliderID !!}</td>  
                       <td>
                       		@if($sliders->fldSliderImage != "") 
	                       		{!! Html::image(SLIDER_IMAGE_PATH.THUMB_IMAGE.$sliders->fldSliderImage) !!}
                            @else 
                                {!! Html::image('http://placehold.it/75') !!}
                            @endif    
                        </td>  
                       <td>{!! $sliders->fldSliderName!!} </td>
                       <td>
                              {!! Html::image('_admin/assets/images/icons/updown.png') !!}                        			
                              <span style="border:1px #999999 solid; padding:5px 10px;">{!! $sliders->fldSliderPosition !!}</span>	
                       </td>
                                 
                       <td align="right">        
                         <a href="{{url('dnradmin/slider/edit/'.$sliders->fldSliderID)}}" alt="Modify Slider"><img src="{{url('_admin/assets/images/icons/page_modify.png')}}"></a>                         
                             <a href="{{url('dnradmin/slider/delete/'.$sliders->fldSliderID)}}" alt="Delete Slider" onClick="return confirm(&quot;Are you sure you want to remove this Slider?\n\nPress OK to delete.\nPress Cancel to go back without deleting the Slider.\n&quot;)"><img src="{{url('_admin/assets/images/icons/page_delete.png')}}"></a>                                                                                                                      
                       </td>
                    </tr>
                      
                    @endforeach
      </tbody>
      @if (!$slider->isEmpty()) 
      <tfoot>
        <th colspan="5" align="right" height="30">

          	 <div id='page_navigation' class="pagination"></div>    
        </th>        
      </tfoot>
      @endif
    </table>
     {!! Form::close() !!}
  </article>
  

@stop

@section('headercodes')    
  {!! Html::style('_admin/assets/css/pagination.css') !!}  
@stop

@section('extracodes')

    {!! Html::script('_admin/manager/tinymce/tiny_mce.js','') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
    {!! Html::script('_admin/assets/js/FilterPagination/filter.js','') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js','') !!}
    {!! Html::script('_admin/assets/js/jquery.tablednd.js','') !!}
    {!! Html::script('_admin/assets/js/stupidtable.min.js','') !!}
    {!! Html::script('_admin/assets/js/sorted.js','') !!}

    <script>
		showPagination(20,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));
		
			$('#page_manager').tableDnD({
					onDrop: function(table, row) {						
						$.ajax({	
							type: "get",
							url: "{!! url('/dnradmin/slider/update-position') !!}",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){
								location.href = "{!! url('/dnradmin/slider') !!}";																					
							}
							
						});	
					}
			});
			
			
			
	</script>   
    
@stop