@extends('layouts._admin.base')

@section('content')
    <article>
    <div id="page_control">   
       <div class="col2">
	       {{ HTML::image_link('/dnradmin/news/new/'.$category_id,'_admin/assets/images/icons/icon_add.png',' Add News') }}
       </div>
       <div class="col1">
       		{{ HTML::link('/dnradmin/news','News') }}
       		 &raquo; {{ $newsDisp->name }} 
       </div>    
    </div>
    
    
    
    <br style="clear:both;" />
       
       <input type='hidden' id='current_page' />  
	  <input type='hidden' id='show_per_page' />  
      <input type='hidden' id='number_of_items' />   		
	  <label for="search">Search:</label> <input type="text" id="search" value="" style="height:20px;"/>	
        
    {{ Form::open(array('url' => '/dnradmin/news/', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}
         
    <table id="page_manager">
      <thead>
        <tr class="headers">
          <th width="70" data-sort="int"> <span class="id">ID</span> <div class="sort"></div> </th>  
          <th width="450" data-sort="string"><span class="id">Name</span> <div class="sort"></div></th>            
          <th width="150" data-sort="date" ><span class="id">Date</span> <div class="sort"></div></th>
        
          <th width="150" align="right">Action</th>
        </tr>
      </thead>
      
      <tbody id="Searchresult">     
					@if ($news->isEmpty()) 
                    	<tr>
                        	<td class="error" colspan="5" align="center"> No Record Found</td>
                        </tr>
                    @endif    

                    
          			@foreach ($news as $newss)
                      
                    <tr>
                       <td>{{ $newss->id }}</td>  
                       <td>{{ $newss->name }} </td>
                       <td>{{ date('F d, Y',strtotime($newss->news_date)) }} </td>
                       
                                 
                       <td align="right">                                                                            
                         {{ HTML::image_link('/dnradmin/news/edit/'.$newss->id.'/'.$category_id,'_admin/assets/images/icons/page_modify.png','',' Modify News') }}                         
                         {{ HTML::image_link_delete('/dnradmin/news/delete/'.$newss->id.'/'.$category_id,'_admin/assets/images/icons/page_delete.png') }}                                                                      
                       </td>
                    </tr>
                      
                    @endforeach
                    
                  
      </tbody>
      @if (!$news->isEmpty()) 
      <tfoot>
        <th colspan="4" align="right" height="30">

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
    {{ HTML::script('_admin/assets/js/stupidtable.min.js','') }}
    {{ HTML::script('_admin/assets/js/sorted.js','') }}

    <script>
		showPagination(20,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));				
	</script>   
    
@stop