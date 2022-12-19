@extends('layouts._admin.base')

@section('content')
    <article>
    <div id="page_control" class="col1">
	                       
       {{ HTML::image_link('/dnradmin/pages/new','_admin/assets/images/icons/icon_add.png',' Add Page') }}
    </div>
    
    <h2 class="line">Page Management</h2>
    
    <br style="clear:both;" />
       	 <input type='hidden' id='current_page' />  
		 <input type='hidden' id='show_per_page' />   
         <input type='hidden' id='number_of_items' />             		
	  <label for="search">Search:</label> <input type="text" id="search" value="" style="height:20px;"/>	
    <table id="page_manager">
      <thead>
        <tr class="headers">
          <td width="70"> ID </td>            
          <td width="350">Page Name</td>
           <td width="70">Position</td>     	
          <td width="150" align="center">Action</td>
        </tr>
      </thead>
      
      <tbody id="Searchresult">  
      				@if ($page->isEmpty()) 
                    	<tr>
                        	<td class="error" colspan="4" align="center"> No Record Found</td>
                        </tr>
                    @endif   
                       
          			@foreach ($page as $pages)
                      
                    <tr id="{{$pages->id.'_'.$pages->position}}">
                       <td>{{ $pages->id }}</td>  
                       <td>{{ $pages->name}} </td>
                       <td>
                                  {{ HTML::image('_admin/assets/images/icons/updown.png') }}                        			
                                  <span style="border:1px #999999 solid; padding:5px 10px;">{{ $pages->position }}</span>	
                        </td>          
                       <td align="center">  
                                                 
                         {{ HTML::image_link('/dnradmin/pages/edit/'.$pages->id,'_admin/assets/images/icons/page_modify.png','',' Modify Page') }}
                         
                         {{ HTML::image_link_delete('/dnradmin/pages/delete/'.$pages->id,'_admin/assets/images/icons/page_delete.png') }}                                                                      
                       </td>                                                
                    </tr>
                    	{{-- */
                         	$subpage = PagesManagement::where('main_id','=',$pages->id)->orderby('position')->get();                        /* --}}
                         @if (!$subpage->isEmpty()) 
							<tr>
                            	<td colspan="4" align="right">
                                	  <table width="75%" id="page_manager1">                                      		
                                              <tbody>
                                                  <tr>
                                                  	<td colspan="4"><strong>Second Level - {{ $pages->name}}</strong></td>
                                                  </tr>
                                             @foreach($subpage as $subpages) 
                                              	<tr id="{{$subpages->id.'_'.$subpages->position}}">
                                                   <td>{{ $subpages->id }}</td>  
                                                   <td>{{ $subpages->name}} </td>
                                                   <td>
                                                              {{ HTML::image('_admin/assets/images/icons/updown.png') }}                        			
                                                              <span style="border:1px #999999 solid; padding:5px 10px;">{{ $subpages->position }}</span>	
                                                    </td>          
                                                   <td align="center">  
                                                                             
                                                     {{ HTML::image_link('/dnradmin/pages/edit/'.$subpages->id,'_admin/assets/images/icons/page_modify.png','',' Modify Page') }}
                                                     
                                                     {{ HTML::image_link_delete('/dnradmin/pages/delete/'.$subpages->id,'_admin/assets/images/icons/page_delete.png') }}                                                                      
                                                   </td>                                                
                                                </tr>
                                                
                                                {{-- */
                         							$thirdpage = PagesManagement::where('main_id','=',$subpages->id)->orderby('position')->get();                      /* --}}
                                                    
                                                 @if (!$thirdpage->isEmpty())   
                                                 <tr>
					                            	<td colspan="4" align="right">   
                                                    	<table width="75%" id="page_manager2">                                      					 <tbody>   
                                                        	<tr>
                                                                <td colspan="4"><strong>Third Level - {{ $pages->name}}</strong></td>
                                                             </tr>                                          			 
                                            			 	@foreach($thirdpage as $thirdpages) 
                                                            	<tr id="{{$thirdpages->id.'_'.$thirdpages->position}}">
                                                                       <td>{{ $thirdpages->id }}</td>  
                                                                       <td>{{ $thirdpages->name}} </td>
                                                                       <td>
                                                                                  {{ HTML::image('_admin/assets/images/icons/updown.png') }}                        			
                                                                                  <span style="border:1px #999999 solid; padding:5px 10px;">{{ $thirdpages->position }}</span>	
                                                                        </td>          
                                                                       <td align="center">  
                                                                                                 
                                                                         {{ HTML::image_link('/dnradmin/pages/edit/'.$thirdpages->id,'_admin/assets/images/icons/page_modify.png','',' Modify Page') }}
                                                                         
                                                                         {{ HTML::image_link_delete('/dnradmin/pages/delete/'.$thirdpages->id,'_admin/assets/images/icons/page_delete.png') }}                                                                      
                                                                       </td>                                                
                                                                    </tr>
                                                            @endforeach
                                                         </tbody>
                                                       </table>     
                                                    </td>
                                                 </tr>   
                                                @endif 
                                                    
                                                
                                              @endforeach  
                                              </tbody>
                                      </table>
                                </td>
                            </tr>                            	
                         @endif 
                      
                    @endforeach
      </tbody>
      @if (!$page->isEmpty()) 
      <tfoot>
        <th colspan="4" align="right" height="30">
	          <div id='page_navigation' class="pagination"></div>      
        </th>
      </tfoot>
      @endif
    </table>
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
    
 
    <script>
		showPagination(20,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));
		
		$('#page_manager').tableDnD({
					onDrop: function(table, row) {						
						$.ajax({			
					
							type: "get",
							url: "/dnradmin/dnradmin/pages/update-position",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){							
								location.href = "/dnradmin/dnradmin/pages/view/<?=$pageid?>";																					
							}
							
						});	
					}
			});
			
			$('#page_manager1').tableDnD({
					onDrop: function(table, row) {						
						$.ajax({			
					
							type: "get",
							url: "/dnradmin/dnradmin/pages/sub-update-position",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){							
								location.href = "/dnradmin/dnradmin/pages/view/<?=$pageid?>";																					
							}
							
						});	
					}
			});
			
			$('#page_manager2').tableDnD({
					onDrop: function(table, row) {						
						$.ajax({			
					
							type: "get",
							url: "/dnradmin/dnradmin/pages/third-update-position",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){							
								location.href = "/dnradmin/dnradmin/pages/view/<?=$pageid?>";																					
							}
							
						});	
					}
			});
	</script>   
    
@stop