@extends('layouts._admin.base')

@section('content')
    <article>
    <div id="page_control">           
    	<div class="col2">         	       
         <a href="{{url('dnradmin/staff/new')}}"><img src="{{url('_admin/assets/images/icons/icon_add.png')}}"> Add Staff </a>
        </div>
        <div class="col1">
        	Staff
        </div>   
    </div>
    
    
    
    <br style="clear:both;" />
      <input type='hidden' id='current_page' />  
	  <input type='hidden' id='show_per_page' />  
      <input type='hidden' id='number_of_items' />   		
	  <label for="search">Search:</label> <input type="text" id="search" value="" style="height:20px;"/>	
   
    {!! Form::open(array('url' => '/dnradmin/staff/', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
         
    <table id="page_manager">
      <thead>
        <tr class="headers nodrag">
          <th width="70" data-sort="int"> <span class="id">ID</span> <div class="sort"></div> </th>  
          <th width="150">  </th>            
          <th width="450" data-sort="string"><span class="id">Name</span> <div class="sort"></div></th>
          <th width="70" data-sort="int"><span class="id">Position</span> <div class="sort"></div></th>
        
          <th width="150" align="right">Action</th>
        </tr>
      </thead>
      
      <tbody id="Searchresult">     
					 @if ($staff->isEmpty()) 
                    	<tr>
                        	<td class="error" colspan="5" align="center"> No Record Found</td>
                        </tr>
                    @endif    

                    
          			@foreach ($staff as $staffs)
                      
                    <tr id="{!!$staffs->fldStaffID.'_'.$staffs->fldStaffPosition!!}">
                       <td>{!! $staffs->fldStaffID !!}</td>  
                       <td>
                       		@if($staffs->fldStaffImage != "")
		                       	{!! Html::image('upload/staff/'.$staffs->fldStaffID.'/_75_'.$staffs->fldStaffImage) !!}
                            @else
                            	 {!! Html::image('http://placehold.it/75') !!}
                            @endif    
                       </td>  
                       <td>{!! $staffs->fldStaffFirstname . ' ' . $staffs->fldStaffLastname!!} </td>
                       <td>
                       		{!! Html::image('_admin/assets/images/icons/updown.png') !!}                        			
                            <span style="border:1px #999999 solid; padding:5px 10px;"><?=$staffs->fldStaffPosition?></span>
                       </td>
                                 
                       <td align="right">                                                                            

                         <a href="{{url('dnradmin/staff/edit/'.$staffs->fldStaffID)}}" alt="Modify Staff"><img src="{{url('_admin/assets/images/icons/page_modify.png')}}"></a>                         
                         <a href="{{url('dnradmin/staff/delete/'.$staffs->fldStaffID)}}" alt="Delete Staff" onClick="return confirm(&quot;Are you sure you want to remove this Record?\n\nPress OK to delete.\nPress Cancel to go back without deleting the Record.\n&quot;)"><img src="{{url('_admin/assets/images/icons/page_delete.png')}}"></a>                         

                       </td>
                    </tr>
                      
                    @endforeach
                    
                  
      </tbody>
      @if (!$staff->isEmpty()) 
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
							url: "{!! url('/dnradmin/staff/update-position') !!}",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){
								location.href = "{!! url('/dnradmin/staff') !!}";																					
							}
							
						});	
					}
			});
	</script>   
    
@stop