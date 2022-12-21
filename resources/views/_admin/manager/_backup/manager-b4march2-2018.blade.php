@extends('layouts._admin.base')

@section('content')	

   <a class="searcha"><i class="pe-7s-search searchicon"></i><input type="text" id="search" value="" style="height:20px;"/></a>
		
    <article>
    <div id="page_control">      
    	<div class="col2">	       
         <a href="{{url('dnradmin/manager/new')}}"><img src="{{url('_admin/assets/images/icons/icon_add.png')}}"> Add new {{ SALESMANAGER_MANAGEMENT }}</a>
        </div>
        <div class="col1">
        	{{ SALESMANAGER_MANAGEMENT }}
        </div>   
       
    </div>
    
   
    
    <br style="clear:both;" />
      <input type='hidden' id='current_page' />  
	  <input type='hidden' id='show_per_page' />  
      <input type='hidden' id='number_of_items' />   		
	 
   
    {!! Form::open(array('url' => '/dnradmin/manager/', 'method' => 'post', 'id' => 'pageform', 'files' => true)) !!}
         
    <table id="page_manager"  class="parennt-table uk-table-hover">
      <thead>
        <tr class="headers nodrag uk-table">
          <th width="70" data-sort="int"> <span class="id">ID</span> <div class="sort"></div> </th>      
          <th width="400" data-sort="string"><span class="id">Name</span> <div class="sort"></div></th>
          <th width="250" data-sort="string"><span class="id">Email Address</span> <div class="sort"></div></th>          
          <th width="150" data-sort="string"><span class="id">Contact no</span> <div class="sort"></div></th>          
          <th width="100" data-sort="string"><span class="id">Status</span> <div class="sort"></div></th>          
          <th width="450" data-sort="float"><span class="id"><?=date('Y')?> Commission</span> <div class="sort"></div></th>          

          <th width="150" align="right">Action</td>
        </tr>
      </thead>
      
      <tbody id="Searchresult">
      				@if ($manager->isEmpty())                    	
                    	<tr>
                        	<td class="error-text" colspan="7" align="center"> No Record Found</td>
                        </tr>
                    @endif 
                    
                        @foreach ($manager as $managers)
                          
                        <tr>
                           <td>{{ $managers->fldManagerID }}</td>                           
                           <td>{{ $managers->fldManagerFirstname}} {{ $managers->fldManagerLastname}} </td>
                           <td>{{ $managers->fldManagerEmail}} </td>    
                           <td>{{ $managers->fldManagerPhoneNo}} </td>                           
                           <td>{!! $managers->fldManagerStatus == 1 ? "<span style='color:#F00'>Pending</span>" : "Active" !!} </td>                           
                           <td>
                              <? /*<strong>{{ number_format($managers->fldManagerCommission,2)  }}</strong>*/ ?>
                           		{!! Html::link('/dnradmin/manager/sales/'.$managers->fldManagerID,number_format($managers->fldManagerCommission,2)) !!} 
								 <br />
								  Merchant ID<br />
								  <b>{{ $managers->fldManagerBrainTreeMerchantID }}   </b>    
                           </td> 
                                     
                           <td align="right">                                                                     
                             <a href="{{url('dnradmin/manager/edit/'.$managers->fldManagerID)}}" alt="Modify Sales Manager"><i class="pe-7s-pen action-icon"></i></a>                         
                             <a href="{{url('dnradmin/manager/delete/'.$managers->fldManagerID)}}" alt="Delete Sales Manager" onClick="return confirm(&quot;Are you sure you want to remove this Sales Manager?\n\nPress OK to delete.\nPress Cancel to go back without deleting the Sales Manager.\n&quot;)"><i class="pe-7s-trash action-icon del"></i></a>                         
                           </td>
                        </tr>
                          
                        @endforeach
                   
      </tbody>
       @if (!$manager->isEmpty()) 
      <tfoot>
        <th colspan="7" align="right" height="30">

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

   {!! Html::script('_admin/manager/tinymce/tiny_mce.js') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}
    {!! Html::script('_admin/assets/js/FilterPagination/filter.js') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js') !!}
    {!! Html::script('_admin/assets/js/jquery.tablednd.js') !!}
    {!! Html::script('_admin/assets/js/stupidtable.min.js') !!}
    {!! Html::script('_admin/assets/js/sorted.js') !!}}
    
    <script>
		 showPagination(20,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));
				
	</script>   
    
@stop