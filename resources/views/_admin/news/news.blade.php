@extends('layouts._admin.base')

@section('content')
    <article>
    <div id="page_control">   
       <div class="col2">	       
         <a href="{{url('dnradmin/pages/new/'.$category_id)}}"><img src="{{url('_admin/assets/images/icons/icon_add.png')}}"> Add News</a>
       </div>
       <div class="col1">
       		{!! Html::link('/dnradmin/news','News') !!}
       		 &raquo; {!! $newsDisp->fldNewsCategoryName !!} 
       </div>    
    </div>
    
    
    
    <br style="clear:both;" />
       
       <input type='hidden' id='current_page' />  
	  <input type='hidden' id='show_per_page' />  
      <input type='hidden' id='number_of_items' />   		
	  <label for="search">Search:</label> <input type="text" id="search" value="" style="height:20px;"/>	
        
    {!! Form::open(array('url' => '/dnradmin/news/', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
         
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
                       <td>{!! $newss->fldNewsID !!}</td>  
                       <td>{!! $newss->fldNewsName !!} </td>
                       <td>{!! date('F d, Y',strtotime($newss->fldNewsNewsDate)) !!} </td>
                       
                                 
                       <td align="right">                                                                                                     
                          <a href="{{url('dnradmin/news/edit/'.$newss->fldNewsID.'/'.$category_id)}}" alt="Modify News"><img src="{{url('_admin/assets/images/icons/page_modify.png')}}"></a>                         
                          <a href="{{url('dnradmin/news/delete/'.$newss->fldNewsID)}}" alt="Delete News" onClick="return confirm(&quot;Are you sure you want to remove this News?\n\nPress OK to delete.\nPress Cancel to go back without deleting the News.\n&quot;)"><img src="{{url('_admin/assets/images/icons/page_delete.png')}}"></a>                         

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
    {!! Html::script('_admin/assets/js/stupidtable.min.js','') !!}
    {!! Html::script('_admin/assets/js/sorted.js','') !!}

    <script>
		showPagination(20,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));				
	</script>   
    
@stop