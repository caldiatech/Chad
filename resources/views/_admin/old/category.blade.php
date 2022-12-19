@extends('layouts._admin.base')

@section('content')	
		
    <article>
    <div id="page_control">      
    	<div class="col2">    	            
        {{ HTML::image_link('/dnradmin/category/new/'.$category_id.'/2','_admin/assets/images/icons/icon_add.png',' Add Category') }} 
       {{ HTML::image_link('/dnradmin/products/new','_admin/assets/images/icons/icon_add.png',' Add Products') }}
       </div>
       <div class="col1">
       	
       	@if($category_id) 
        	{{ HTML::link('/dnradmin/category','Category') }} &raquo; {{ $maincat->name }}
        @else
        	Category    
        @endif
       </div>
    </div>
    

    
    <br style="clear:both;" />
      <input type='hidden' id='current_page' />  
	  <input type='hidden' id='show_per_page' />  
      <input type='hidden' id='number_of_items' />   		
	  <label for="search">Search:</label> <input type="text" id="search" value="" style="height:20px;"/>	
   
    {{ Form::open(array('url' => '/dnradmin/category/', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
         
    <table id="page_manager">
      <thead>
        <tr class="headers nodrag">
          <th width="70" data-sort="int"> <span class="id">ID</span> <div class="sort"></div> </th>  
          <th width="150">  </th>            
          <th width="450" data-sort="string"><span class="id">Category Name</span> <div class="sort"></div></th>
          <th width="70" data-sort="int"><span class="id">Position</span> <div class="sort"></div></th>        
          <th width="150" align="right">Action</th>
        </tr>
      </thead>
      
      <tbody id="Searchresult">
      				@if ($category->isEmpty())                    	
                    	<tr>
                        	<td class="error" colspan="5" align="center"> No Record Found</td>
                        </tr>
                    @endif 
                    
                        @foreach ($category as $categories)
                          
                        <tr id="{{$categories->id.'_'.$categories->position}}">
                           <td>{{ $categories->id }}</td>  
                           <td>
                           		@if($categories->image != "") 
	                           		{{ HTML::image('upload/category/'.$categories->id.'/_75_'.$categories->image) }}
                                @else
                                	 {{ HTML::image('http://placehold.it/75') }}
                                @endif    
                            </td>  
                           <td>{{ $categories->name}} </td>
                           <td>
                                  {{ HTML::image('_admin/assets/images/icons/updown.png') }}                        			
                                  <span style="border:1px #999999 solid; padding:5px 10px;">{{ $categories->position }}</span>	
                           </td>
                                     
                           <td align="right">           
                             @if($category_id) 
                             	 {{ HTML::image_link('/dnradmin/products/view/'.$categories->id,'_admin/assets/images/icons/folder.png','',' Display Products') }} 	
                             @else                                                               
	                             {{ HTML::image_link('/dnradmin/category/view/'.$categories->id,'_admin/assets/images/icons/folder.png','',' Open Sub Category') }}
                             @endif   
                              
                                              	                         
                              {{ HTML::image_link('/dnradmin/category/edit/'.$categories->id,'_admin/assets/images/icons/page_modify.png','',' Modify Category') }}                         
                             {{ HTML::image_link_delete('/dnradmin/category/delete/'.$categories->id.'/'.$categories->main_id."/dashboard",'_admin/assets/images/icons/page_delete.png') }}                                                                      
                           
                           </td>
                        </tr>
                          
                        @endforeach
                   
      </tbody>
       @if (!$category->isEmpty()) 
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
							url: "{{ $pageURL }}/dnradmin/category/update-position",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){							
								location.href = "{{ $pageURL }}/dnradmin/category/view/<?=$category_id?>";																					
							}
							
						});	
					}
			});
	</script>   
    
@stop