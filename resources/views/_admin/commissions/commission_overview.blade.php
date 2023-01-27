@extends('layouts._admin.base')

@section('content')	
    

<style>
    #search_form {
        display: inline-block;
        width: 100%;
        margin-left: 19px;
        font-size: 16px;
        font-weight: 400;
    }
    .search {
        position: relative;
        top: 1px;
        font-size: 21px;
    }

    #search_form input {
        height: 25px;
        margin-right: 10px;
        margin-left: 10px;
        padding: 1px 10px;
    }

    #search_form h4 {
        position: relative;
        display: inline-block;
        margin: 0;
        top: 4px;
        width: 77px;
        color: #2d2d2d;
        font-weight: 600;
    }
    #search_form div {
        margin-top: 19px;
    }

    .xls {
        float: right;
    }
    .ctabtn {
        margin-right: 37px;
        width: 165px;
        height: 40px;
        background-color: #292929;
        color: #fff !important;
        border: 1px solid #292929;
        padding: 6px 24px;
        text-transform: uppercase;
        font-weight: 600;
        cursor: pointer;
    }
    .ctabtn:hover {
        background-color: #db1a20;
        border: 1px solid #db1a20;
    }

    .search {
        margin: 10px 0 0 17px;
        color: #666;
        font-size: 25px;
        font-weight: 700;
    }
</style>
    <?php /* <a class="searcha"><i class="pe-7s-search searchicon"></i><input type="text" id="search" value="" style="height:20px;"/></a> */ ?>

    <br style="clear:both;" />
    <h3 class="search">Search</h3>

    <form name="search_form" id="search_form" method="POST">
        <div>
            <h4>By Name</h4> <input type="text" name="search_name" value="<?=(isset($_POST['search_name']))? trim($_POST['search_name']):'';?>" id="search_name"/> &nbsp; 
            
            <h4>By City</h4> <input type="text" name="search_city" value="<?=(isset($_POST['search_city']))? trim($_POST['search_city']):'';?>" id="search_city"/> &nbsp; 

            <h4>By State</h4><input type="text" name="search_state" value="<?=(isset($_POST['search_state']))? trim($_POST['search_state']):'';?>" id="search_state"/> &nbsp; 
        </div>

        <div>
            <h4>Date From</h4> <input type="text" name="search_date_from" value="<?=(isset($_POST['search_date_from']))? trim($_POST['search_date_from']):'';?>" id="search_date_from" data-uk-datepicker="{format:'YYYY-MM-DD'}" /> &nbsp; 
            <h4>Date To</h4> <input type="text" name="search_date_to" value="<?=(isset($_POST['search_date_to']))? trim($_POST['search_date_to']):'';?>" id="search_date_to" data-uk-datepicker="{format:'YYYY-MM-DD'}" /> &nbsp;
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div>
            <button name="submit_search" id="submit_search" class="ctabtn">Submit</button>

            <button name="submit_export" id="submit_export" class="ctabtn xls">Export to XLS</button>
        </div>
    </form>

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
            <th width="70" data-sort="int"> <span class="id">ID</span> <div class="sort"></div> </th>  
            <th width="150" data-sort="string"> <span class="id">Name</span> <div class="sort"></div> </th>
            <th width="150" data-sort="string"> <span class="id">Email</span> <div class="sort"></div> </th>
            <th width="150" data-sort="string"> <span class="id">Type</span> <div class="sort"></div> </th>
            <th width="250" data-sort="string"> <span class="id">City</span> <div class="sort"></div> </th>
            <th width="150" data-sort="string"> <span class="id">State</span> <div class="sort"></div> </th>            
            <th width="150" data-sort="float"> <span class="id">Commission $</span> <div class="sort"></div> </th>
            <th width="150" align="right">View Details</th>
        </tr>
      </thead>
      
      <tbody id="Searchresult">
        @if (count($commissions)==0)                    	
            <tr>
                <td class="error" colspan="7" align="center"> No Record Found</td>
            </tr>
        @endif                     	
        
        @foreach ($commissions as $commission)

	@if(!empty($commission->ID))
            <tr>
                <td>{!! $commission->ID !!}</td>
                <td>{!! ucwords($commission->firstName.' '.$commission->lastName) !!}</td>
                <td>{!! $commission->email !!}</td>
                <td>{!! ucwords($commission->type) !!}</td>
                <td>{!! ucwords($commission->city) !!}</td>
                <td>{!! ucwords($commission->state) !!}</td>  
                <td>{!! number_format($commission->totalCommission,2)!!}</td>
                <td align="right">
                    @if (!empty($_POST['search_date_from']) && !empty($_POST['search_date_to']))
                        <a href="{{url('dnradmin/commissions/details/'.$commission->type.'/'.$commission->ID.'/'.$datefromstr.'-'.$datetostr)}}" alt="Commission Details" title="Commission Details"><i class="pe-7s-angle-right-circle action-icon"></i></a>
                    @else
                        <a href="{{url('dnradmin/commissions/display/'.$commission->type.'/'.$commission->ID)}}" alt="Commission Details" title="Commission Details"><i class="pe-7s-angle-right-circle action-icon"></i></a>
                    @endif
                </td>
            </tr>
	@endif
        @endforeach
     
      </tbody>

        @if (count($commissions) > 40) 
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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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

    {!! Html::script('_front/plugins/uikit/js/components/datepicker.js') !!}

    <script>
		 showPagination(40,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));					
	</script>   
@stop