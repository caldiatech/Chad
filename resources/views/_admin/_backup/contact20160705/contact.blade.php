@extends('layouts._admin.base')

@section('content')
    <article>
    <div id="page_control">                    
    	<div class="col2">	       
         <a href="{{url('dnradmin/contact/new')}}"><img src="{{url('_admin/assets/images/icons/icon_add.png')}}"> Add Contact </a>
        </div>
        <div class="col1">
        	Contact
        </div>   
    </div>
    
    
    
    <br style="clear:both;" />
      <input type='hidden' id='current_page' />  
	  <input type='hidden' id='show_per_page' />  
      <input type='hidden' id='number_of_items' />   		
	  <label for="search">Search:</label> <input type="text" id="search" value="" style="height:20px;"/>	
   
  
         
    <table id="page_manager">
      <thead>
        <tr class="headers">
          <th width="70" data-sort="int"> <span class="id">ID</span> <div class="sort"></div> </th>            
          <th width="450" data-sort="string"><span class="id">Name</span> <div class="sort"></div></th>   
          <th width="450" data-sort="string"><span class="id">Email address</span> <div class="sort"></div></th>        
          <th width="150" align="right">Action</th>
        </tr>
      </thead>
      
      <tbody id="Searchresult">     
					

                    @if ($contact->isEmpty())                    	
                    	<tr>
                        	<td class="error" colspan="4" align="center"> No Record Found</td>
                        </tr>
                    @endif 
                    
          			@foreach ($contact as $contacts)
                      
                    <tr>
                       <td>{{ $contacts->fldContactID }}</td>                         
                       <td>{{ $contacts->fldContactFirstname . ' ' . $contacts->fldContactLastname}} </td>                                                     
                       <td>{{ $contacts->fldContactEmail}} </td>                                                     
                       <td align="right">                                                                            

                         <a href="{{url('dnradmin/contact/edit/'.$contacts->fldContactID)}}" alt="Modify Contact"><img src="{{url('_admin/assets/images/icons/page_modify.png')}}"></a>                         
                         <a href="{{url('dnradmin/contact/delete/'.$contacts->fldContactID)}}" alt="Delete Contact" onClick="return confirm(&quot;Are you sure you want to remove this Record?\n\nPress OK to delete.\nPress Cancel to go back without deleting the Record.\n&quot;)"><img src="{{url('_admin/assets/images/icons/page_delete.png')}}"></a>                         

                       </td>
                    </tr>
                      
                    @endforeach
                    
                  
      </tbody>
      @if (! $contact->isEmpty())  
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
  {!! Html::style('_admin/assets/css/pagination.css') !!}  
@stop

@section('extracodes')

    {!! Html::script('_admin/assets/js/cufon_avantgarde.js','') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js','') !!}
    {!! Html::script('_admin/assets/js/FilterPagination/filter.js','') !!}
    {!! Html::script('_admin/assets/js/stupidtable.min.js','') !!}
    {!! Html::script('_admin/assets/js/sorted.js','') !!}

     <script>
		showPagination(20,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));
	</script>  
@stop