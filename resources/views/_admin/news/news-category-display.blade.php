@extends('layouts._admin.base')

@section('content')
    <article>
    <div id="page_control" class="col1">   
    	<div class="col2">     	       
         <a href="{{url('dnradmin/news/new/0')}}"><img src="{{url('_admin/assets/images/icons/icon_add.png')}}"> Add News</a>
        </div>
        <div class="col1">
        	News
        </div>   
    </div>
    

    
    <br style="clear:both;" />
       
       <input type='hidden' id='current_page' />  
	  <input type='hidden' id='show_per_page' />  
      <input type='hidden' id='number_of_items' />   		
	  <label for="search">Search:</label> <input type="text" id="search" value="" style="height:20px;"/>	
        
    {!! Form::open(array('url' => '/dnradmin/news', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
         
    <table id="page_manager">
      <thead>
        <tr class="headers nodrag">
          <th width="70" data-sort="int"> <span class="id">ID</span> <div class="sort"></div> </th>  
          <th width="450" data-sort="string"><span class="id">Name</span> <div class="sort"></div></th>            
          <th width="150" data-sort="int"><span class="id">Position</span> <div class="sort"></div></th>
        
          <th width="150" align="center">Action</th>
        </tr>
      </thead>
      
      <tbody id="Searchresult">     
					@if ($news->isEmpty()) 
                    	<tr>
                        	<td class="error" colspan="5" align="center"> No Record Found</td>
                        </tr>
                    @endif    

                    
          			@foreach ($news as $newss)
                      
                    <tr id="{!!$newss->fldNewsCategoryID.'_'.$newss->fldNewsCategoryPosition!!}">
                       <td>{!! $newss->fldNewsCategoryID !!}</td>  
                       <td>{!! $newss->fldNewsCategoryName !!} </td>
                       <td>
                     		{!! Html::image('_admin/assets/images/icons/updown.png') !!}                        			
                            <span style="border:1px #999999 solid; padding:5px 10px;">{!! $newss->fldNewsCategoryPosition !!}</span>
                      </td>
                       
                                 
                       <td align="center">                                                                                                                                                                  
                            <a href="{{url('dnradmin/news/display/'.$newss->fldNewsCategoryID)}}"><img src="{{url('_admin/assets/images/icons/folder.png')}}"></a>
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

    {!! Html::script('_admin/assets/js/cufon_avantgarde.js') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}
    {!! Html::script('_admin/assets/js/FilterPagination/filter.js') !!}
    {!! Html::script('_admin/assets/js/jquery.tablednd.js') !!}
     {!! Html::script('_admin/assets/js/stupidtable.min.js') !!}
    {!! Html::script('_admin/assets/js/sorted.js') !!}

    <script>
		showPagination(20,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));				
		
		 $('#page_manager').tableDnD({
					onDrop: function(table, row) {						
						$.ajax({	
							type: "get",
							url: "{!! url('dnradmin/news-category/update-position') !!}",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){
								location.href = "{!! url('dnradmin/news') !!}";																					
							}
							
						});	
					}
			});
	</script>   
    
@stop