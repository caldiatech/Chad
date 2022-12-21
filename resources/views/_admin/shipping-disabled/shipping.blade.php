@extends('layouts._admin.base')

@section('content')	
		
    <a class="searcha"><i class="pe-7s-search searchicon"></i><input type="text" id="search" value="" style="height:20px;"/></a>

    <article>
    <div id="page_control">      
    	<div class="col2">
        	{{ SHIPPING_MANAGEMENT }}
        </div>
    </div>
    

    
    <br style="clear:both;" />
      <input type='hidden' id='current_page' />  
	  <input type='hidden' id='show_per_page' />  
      <input type='hidden' id='number_of_items' />   		
	  
   
    {!! Form::open(array('url' => '/dnradmin/shipping/', 'method' => 'post', 'id' => 'pageform', 'files' => true)) !!}
         
    <table id="page_manager" class="parennt-table uk-table-hover">
      <thead>
        <tr class="headers nodrag uk-table">
          <td width="70"> ID </td>  
          <td width="450">Name</td>
          <td width="450">Active</td>
          <td width="150" align="right">Action</td>
        </tr>
      </thead>
      
      <tbody id="Searchresult">
      			
                        @foreach ($shipping as $shippings)
                          
                        <tr>
                           <td>{!! $shippings->fldShippingID !!}</td>  
                           <td>{!! $shippings->fldShippingName!!} </td>
                           <td>
                           		@if($shippings->fldShippingIsActive == 1)                                 
                                <a href="{{url('dnradmin/shipping/edit/'.$shippings->fldShippingID)}}"><img src="{{url('_admin/assets/images/icons/icon_active.png')}}"></a>
                              @else
                                  <a href="{{url('dnradmin/shipping/edit/'.$shippings->fldShippingID)}}"><img src="{{url('_admin/assets/images/icons/icon_hidden.png')}}"></a>
                              @endif
                           </td>          
                           <td align="right">           
                               <a href="{{url('dnradmin/shipping/view/'.$shippings->fldShippingID)}}"><img src="{{url('_admin/assets/images/icons/folder.png')}}"></a>                             	 
                                                                      
                           </td>
                        </tr>
                          
                        @endforeach
                   
      </tbody>
      
      <tfoot>
        <th colspan="5" align="right" height="30">

          	 <div id='page_navigation' class="pagination"></div>    
        </th>      
      </tfoot>
      
       
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

    <script>
		 showPagination(20,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));
	</script>   
    
@stop