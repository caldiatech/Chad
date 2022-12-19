@extends('layouts._admin.base')

@section('content')
    <article>
    <div id="page_control"> 
    	<div class="col2">                   	       
         <a href="{{url('dnradmin/homeslides/new')}}"><img src="{{url('_admin/assets/images/icons/icon_add.png')}}"> Add Home Slide</a>
        </div>   
        <div class="col1">
        	Home Slide
        </div>
    </div>
    

    
    <br style="clear:both;" />
      <input type='hidden' id='current_page' />  
	  <input type='hidden' id='show_per_page' />  
      <input type='hidden' id='number_of_items' />   		
	  <label for="search">Search:</label> <input type="text" id="search" value="" style="height:20px;"/>	
   
    {!! Form::open(array('url' => '/dnradmin/homeslide/', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
         
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
      				@if ($homeslide->isEmpty()) 
                    	<tr>
                        	<td class="error" colspan="5" align="center"> No Record Found</td>
                        </tr>
                    @endif   
                    	
          			@foreach ($homeslide as $homeslides)
                      
                    <tr id="{{$homeslides->fldHomeSlideID.'_'.$homeslides->fldHomeSlidePosition}}">
                       <td>{{ $homeslides->fldHomeSlideID }}</td>  
                       <td>
                       		@if($homeslides->fldHomeSlideImage != "") 
	                       		{!! Html::image(HOME_SLIDE_IMAGE_PATH.THUMB_IMAGE.$homeslides->fldHomeSlideImage) !!}
                            @else 
                                {!! Html::image('http://placehold.it/75') !!}
                            @endif    
                        </td>  
                       <td>{{ $homeslides->fldHomeSlideName}} </td>
                       <td>
                              {!! Html::image('_admin/assets/images/icons/updown.png') !!}                        			
                              <span style="border:1px #999999 solid; padding:5px 10px;">{!! $homeslides->fldHomeSlidePosition !!}</span>	
                       </td>
                                 
                       <td align="right">        
                         <a href="{{url('dnradmin/homeslides/edit/'.$homeslides->fldHomeSlideID)}}" alt="Modify Home Slide"><img src="{{url('_admin/assets/images/icons/page_modify.png')}}"></a>                         
                             <a href="{{url('dnradmin/homeslides/delete/'.$homeslides->fldHomeSlideID)}}" alt="Delete Home Slide" onClick="return confirm(&quot;Are you sure you want to remove this Home Slide?\n\nPress OK to delete.\nPress Cancel to go back without deleting the Home Slide.\n&quot;)"><img src="{{url('_admin/assets/images/icons/page_delete.png')}}"></a>                                                                                                                      
                       </td>
                    </tr>
                      
                    @endforeach
      </tbody>
      @if (!$homeslide->isEmpty()) 
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
							url: "{!! url('/dnradmin/homeslides/update-position') !!}",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){
								location.href = "{!! url('/dnradmin/homeslides') !!}";																					
							}
							
						});	
					}
			});
			
			
			
	</script>   
    
@stop