
@extends('layouts._admin.base')

@section('content')	
		<a class="searcha"><i class="pe-7s-search searchicon"></i><input type="text" id="search" value="" style="height:20px;"/></a>


    <article class="dawnstudent">
    <div id="page_control">      
    	<div class="col2">	       
         <?php /*<a href="{{url('dnradmin/tax/others')}}"><img src="{{url('_admin/assets/images/icons/icon_add.png')}}"> Update Canada/San Diego</a>*/ ?>
         Tax
       </div>
      <div class="col1">
       	
      </div>   
       
    </div>

    <br style="clear:both;" />
    <input type='hidden' id='current_page' />  
    <input type='hidden' id='show_per_page' />  
    <input type='hidden' id='number_of_items' />   		
<!--    <label for="search">Search:</label> <input type="text" id="search" value="" style="height:20px;"/>	-->
   
    {!! Form::open(array('url' => '/dnradmin/state/', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}

    {!! Html::flash_msg_admin() !!}
    <table id="page_manager" class="uk-table-hover">
      <thead>
        <tr class="headers uk-table">
          <th width="250" data-sort="int"> <span class="id">ID</span> <div class="sort"></div> </th>      
          <th width="450" data-sort="string"><span class="id">State</span> <div class="sort"></div></th>
          <th width="250" data-sort="string"><span class="id">Tax</span> <div class="sort"></div></th>          
          <th width="150" align="right">Action</td>
        </tr>
      </thead>
      
      <tbody id="Searchresult">
				@if ($state->isEmpty())
        	<tr>
            	<td class="error" colspan="5" align="center"> No Record Found</td>
            </tr>
        @endif 

        @foreach ($state as $states)
          
          <tr>
            <td>{{ $states->fldStateID }}</td>
            <td><a href="{{url('dnradmin/tax/edit/'.$states->fldStateID )}}" style="color:#777">{{ $states->fldStateName}}</a> </td>
            <td><a href="{{url('dnradmin/tax/edit/'.$states->fldStateID )}}" style="color:#777">{{ $states->fldStateTax}}</a> %</td>
            
            <td align="right">
              <a href="{{url('dnradmin/state/edit/'.$states->fldStateID )}}" alt="Modify Tax"><i class="pe-7s-pen action-icon"></i></a>                                                      
              
            </td>
          </tr>
          
        @endforeach
         
      </tbody>
      @if (!$state->isEmpty())
        <tfoot>
          <th colspan="6" align="right" height="30">
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
    {!! Html::script('_admin/assets/js/sorted.js') !!}
    
    <script>
		 showPagination(20,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));
				
	</script>   
    
@stop