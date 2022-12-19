@extends('layouts._admin.base')

@section('content')	
		
    <article>
    <div id="page_control">      
    	<div class="col1">
        	Payment Gateway
        </div>
    </div>
    

    
    <br style="clear:both;" />
      <input type='hidden' id='current_page' />  
	  <input type='hidden' id='show_per_page' />  
      <input type='hidden' id='number_of_items' />   		
	  <label for="search">Search:</label> <input type="text" id="search" value="" style="height:20px;"/>	
   
    {!! Form::open(array('url' => '/dnradmin/payment/', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
         
    <table id="page_manager">
      <thead>
        <tr class="headers">
          <td width="70"> ID </td>  
          <td width="450">Name</td>
          <td width="450">Active</td>
          <td width="150" align="right">Action</td>
        </tr>
      </thead>
      
      <tbody id="Searchresult">
      			
                        @foreach ($payment as $payments)
                          
                        <tr>
                           <td>{!! $payments->fldPaymentID !!}</td>  
                           <td>{!! $payments->fldPaymentName!!} </td>
                           <td>
                           		@if($payments->fldPaymentIsActive == 1) 
                                	
                                  <a href="{{url('dnradmin/payment/edit/'.$payments->fldPaymentID)}}"><img src="{{url('_admin/assets/images/icons/icon_active.png')}}"></a>
                                @else                                	
                                  <a href="{{url('dnradmin/payment/edit/'.$payments->fldPaymentID)}}"><img src="{{url('_admin/assets/images/icons/icon_hidden.png')}}"></a>
                                @endif
                           </td>
                                     
                           <td align="right">           
                                <a href="{{url('dnradmin/payment/view/'.$payments->fldPaymentID)}}"><img src="{{url('_admin/assets/images/icons/folder.png')}}"></a>                             	 
                                                                      
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


    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
    {!! Html::script('_admin/assets/js/FilterPagination/filter.js','') !!}

    <script>
		 showPagination(20,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));
	</script>   
    
@stop