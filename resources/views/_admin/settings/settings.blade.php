@extends('layouts._admin.base')

@section('content')

    <a class="searcha"><i class="pe-7s-search searchicon"></i><input type="text" id="search" value="" style="height:20px;"/></a>

    <article>

        <div id="page_control">   
        	<div class="col2">                 	       
                <a href="{{url('dnradmin/settings/new')}}"><img src="{{url('_admin/assets/images/icons/icon_add.png')}}"> Add new Administrator</a>
            </div> 
        </div>
    
   
    
    <br style="clear:both;" />

    <input type='hidden' id='current_page' />  
    <input type='hidden' id='show_per_page' />  
    <input type='hidden' id='number_of_items' />   		
    
    {!! Html::flash_msg_admin() !!}

    <table id="page_manager" class="parennt-table uk-table-hover">
      <thead>
        <tr class="headers nodrag uk-table">
          <td width="70"> ID </td>  
          <td width="150">Real name</td>            
          <td width="450">Username</td>
          <td width="450">Email</td>
        
          <td width="150" align="right">Action</td>
        </tr>
      </thead>
      
      <tbody id="Searchresult">     
					@if ($settings->isEmpty())                    	
                    	<tr>
                        	<td class="error" colspan="5" align="center"> No Record Found</td>
                        </tr>
                    @endif    

                    
        			@foreach ($settings as $settingss)
                      
                  <tr>
                     <td>{!! $settingss->fldAdministratorID !!}</td>  
                     <td>{!! $settingss->fldAdministratorFullname !!} </td>
                     <td>{!! $settingss->fldAdministratorUsername !!} </td>
                     <td>{!! $settingss->fldAdministratorEmail !!} </td>
                     
                               
                     <td align="right">                                                                            
                                              
                        <a href="{{url('dnradmin/settings/edit/'.$settingss->fldAdministratorID)}}" alt="Modify Administrator"><i class="pe-7s-pen action-icon"></i></a>                          
                       <a href="{{url('dnradmin/settings/delete/'.$settingss->fldAdministratorID)}}" alt="Delete Administrator" onClick="return confirm(&quot;Are you sure you want to remove this Record?\n\nPress OK to delete.\nPress Cancel to go back without deleting the Record.\n&quot;)">
                       <i class="pe-7s-trash action-icon del"></i></a>                

                     </td>
                  </tr>
                      
              @endforeach
                    
                  
      </tbody>
      @if (!$settings->isEmpty()) 
      <tfoot>
        <th colspan="5" align="right" height="30">

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


    <script>
		showPagination(20,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));				
	</script>   
    
@stop