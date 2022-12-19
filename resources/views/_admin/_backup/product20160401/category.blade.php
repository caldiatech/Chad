@extends('layouts._admin.base')

@section('content')	
		
    <article>
    <div id="page_control">      
    	<div class="col2">    	                    
          <a href="{{url('dnradmin/category/new/'.$category_id.'/2')}}"><img src="{{url('_admin/assets/images/icons/icon_add.png')}}"> {{ $category_id == 0 ? "Add Main Category" : "Add Sub Category" }} </a>
          <a href="{{url('dnradmin/products/new')}}"><img src="{{url('_admin/assets/images/icons/icon_add.png')}}"> Add Products</a>       
       </div>
       <div class="col1">
       	
       	@if($category_id) 
        	{!! Html::link('/dnradmin/category','Category') !!} &raquo; {!! $maincat->fldCategoryName !!}
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
   
    {!! Form::open(array('url' => '/dnradmin/category/', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
         
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
                          
                        <tr id="{!!$categories->fldCategoryID.'_'.$categories->fldCategoryPosition!!}">
                           <td>{!! $categories->fldCategoryID !!}</td>  
                           <td>
                           		@if($categories->fldCategoryImage != "") 
	                           		{!! Html::image(CATEGORY_IMAGE_PATH.$categories->fldCategorySlug.'/'.THUMB_IMAGE.$categories->fldCategoryImage) !!}
                                @else
                                	 {!! Html::image('http://placehold.it/75') !!}
                                @endif    
                            </td>  
                           <td>{!! $categories->fldCategoryName!!} </td>
                           <td>
                                  {!! Html::image('_admin/assets/images/icons/updown.png') !!}                        			
                                  <span style="border:1px #999999 solid; padding:5px 10px;">{!! $categories->fldCategoryPosition !!}</span>	
                           </td>
                                     
                           <td align="right">           
                             @if($category_id)                              	 
                               <a href="{{url('dnradmin/products/view/'.$categories->fldCategoryID)}}"><img src="{{url('_admin/assets/images/icons/folder.png')}}"></a>
                             @else                                                               	                             
                               <a href="{{url('dnradmin/category/view/'.$categories->fldCategoryID)}}"><img src="{{url('_admin/assets/images/icons/folder.png')}}"></a>
                             @endif   
                              
                                <a href="{{url('dnradmin/category/edit/'.$categories->fldCategoryID)}}"><img src="{{url('_admin/assets/images/icons/page_modify.png')}}"></a>              	                               
                                <a href="{{url('dnradmin/category/delete/'.$categories->fldCategoryID)}}" alt="Delete CAtegory" onClick="return confirm(&quot;Are you sure you want to remove this Category?\n\nPress OK to delete.\nPress Cancel to go back without deleting the Category.\n&quot;)"><img src="{{url('_admin/assets/images/icons/page_delete.png')}}"></a>

                           
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
							url: "{!! url('/dnradmin/category/update-position') !!}",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){							
								location.href = "{!! url('/dnradmin/category/view/'.$category_id) !!}";																					
							}
							
						});	
					}
			});
	</script>   
    
@stop