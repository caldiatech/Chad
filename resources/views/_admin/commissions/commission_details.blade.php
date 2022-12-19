@extends('layouts._admin.base')

@section('content') 
    <article>
      <div id=page_control>
      </div>

    
    <br style="clear:both;" />
    <input type='hidden' id='current_page' />  
    <input type='hidden' id='show_per_page' />  
    <input type='hidden' id='number_of_items' />        
   
    <table id="page_manager" class="parennt-table uk-table-hover">
      <thead>
        <tr class="headers nodrag uk-table">
            <th width="15%" data-sort="string"> <span class="id">Transaction ID</span> <div class="sort"></div> </th>  
            <th width="15%" data-sort="string"> <span class="id">Client Info</span> <div class="sort"></div> </th>
            <th width="15%" data-sort="string"> <span class="id">Email</span> <div class="sort"></div> </th>
            <th width="10%"> <span class="id">Contact</span> </th>
            <th width="10%" data-sort="string"> <span class="id">City</span> <div class="sort"></div> </th>
            <th width="10%" data-sort="string"> <span class="id">State</span> <div class="sort"></div> </th>
            <th width="10%" data-sort="float"> <span class="id">Commission $</span> <div class="sort"></div> </th>
            <th width="15%" align="right">Date Transacted</th>
        </tr>
      </thead>
      
      <tbody id="Searchresult">
        @if (count($commissions)==0)                        
            <tr>
                <td class="error" colspan="8" align="center"> No Record Found</td>
            </tr>
        @endif                      
        
        @foreach ($commissions as $commission)
            <tr>
                <td>{!! $commission->orderCode !!}</td>
                <td>{!! '('.$commission->fldClientID.') '.$commission->fldClientFirstname.' '.$commission->fldClientLastname !!}</td>
                <td>{!! $commission->fldClientEmail !!}</td>
                <td>{!! $commission->fldClientContact !!}</td>
                <td>@if (isset($commission->fldClientCity)) {!! $commission->fldClientCity !!} @else - - - @endif</td>
                <td>@if (isset($commission->fldClientState)) {!! $commission->fldClientState !!} @else - - - @endif</td>
                <td>{!! number_format($commission->commissionAmount, 2) !!}</td>
                <td>{!! date('F d, Y', strtotime($commission->commissionDate)) !!}</td>
            </tr>
        @endforeach
     
      </tbody>

        @if (count($commissions) > 30) 
        <tfoot>
            <th colspan="8" align="right" height="30">
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
    {!! Html::script('_admin/assets/js/FilterPagination/filter.js','') !!}
    {!! Html::script('_admin/assets/js/jquery.tablednd.js','') !!}
    {!! Html::script('_admin/assets/js/stupidtable.min.js','') !!}
    {!! Html::script('_admin/assets/js/sorted.js','') !!}

    <script>
         showPagination(30,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));                 
    </script>   
@stop