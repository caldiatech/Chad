@extends('layouts._admin.base')

@section('content')
    <article>
    <div id="page_control">  
    	<div class="col2">                  
	       {{ HTML::image_link('/dnradmin/photos/new','_admin/assets/images/icons/icon_add.png',' Add Photos') }}
        </div>
        <div class="col1">
        	Photos
        </div>   
    </div>
    
   
    
    <br style="clear:both;" />
      <input type='hidden' id='current_page' />  
	  <input type='hidden' id='show_per_page' />  
      <input type='hidden' id='number_of_items' />   		
	  <label for="search">Search:</label> <input type="text" id="search" value="" style="height:20px;"/>	
   
    {{ Form::open(array('url' => '/dnradmin/photos/', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
         
    <table id="page_manager">
      <thead>
        <tr class="headers nodrag">
          <th width="70" data-sort="int"> <span class="id">ID</span> <div class="sort"></div> </th>  
          <th width="150">  </th>            
          <th width="450" data-sort="string"><span class="id">Photo Name</span> <div class="sort"></div></th>
          <th width="70" data-sort="int"><span class="id">Position</span> <div class="sort"></div></th>
        
          <th width="150" align="right">Action</th>
        </tr>
      </thead>
      
      <tbody id="Searchresult">     
      				@if ($photo->isEmpty()) 
                    	<tr>
                        	<td class="error" colspan="5" align="center"> No Record Found</td>
                        </tr>
                    @endif   
                    	
          			@foreach ($photo as $photos)
                      
                    <tr id="{{$photos->id.'_'.$photos->position}}">
                       <td>{{ $photos->id }}</td>  
                       <td>
                       	  @if($photos->image != "")
                       		{{ HTML::image('upload/photos/'.$photos->id.'/_75_'.$photos->image) }}
                          @else
                          	 {{ HTML::image('http://placehold.it/75') }}
                          @endif  
                       </td>  
                       <td>{{ $photos->name}} </td>
                       <td>
                              {{ HTML::image('_admin/assets/images/icons/updown.png') }}                        			
                              <span style="border:1px #999999 solid; padding:5px 10px;">{{ $photos->position }}</span>	
                       </td>
                                 
                       <td align="right">                                                                            
                         {{ HTML::image_link('/dnradmin/photos/edit/'.$photos->id,'_admin/assets/images/icons/page_modify.png','',' Modify Photo') }}                         
                         {{ HTML::image_link_delete('/dnradmin/photos/delete/'.$photos->id,'_admin/assets/images/icons/page_delete.png') }}                                                                      
                       </td>
                    </tr>
                      
                    @endforeach
      </tbody>
      @if (!$photo->isEmpty()) 
      <tfoot>
        <th colspan="5" align="right" height="30">

          	 <div id='page_navigation' class="pagination"></div>    
        </th>        
      </tfoot>
      @endif
    </table>
     {{ Form::close() }}
  </article>
  

@stop

@section('headercodes')    
  {{ HTML::style('_admin/assets/css/pagination.css') }}  
@stop

@section('extracodes')

    {{ HTML::script('_admin/manager/tinymce/tiny_mce.js','') }}
    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js','') }}
    {{ HTML::script('_admin/assets/js/jquery-latest.min.js','') }}
    {{ HTML::script('_admin/assets/js/FilterPagination/filter.js','') }}
    {{ HTML::script('_admin/manager/tinymce/styles/mods2.js','') }}
    {{ HTML::script('_admin/assets/js/jquery.tablednd.js','') }}
    {{ HTML::script('_admin/assets/js/stupidtable.min.js','') }}
    {{ HTML::script('_admin/assets/js/sorted.js','') }}

    <script>
		showPagination(20,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));
		
			$('#page_manager').tableDnD({
					onDrop: function(table, row) {						
						$.ajax({	
							type: "get",
							url: "{{ $pageURL }}/dnradmin/photos/update-position",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){
								location.href = "{{ $pageURL }}/dnradmin/photos";																					
							}
							
						});	
					}
			});
	</script>   
    
@stop