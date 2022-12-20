@extends('layouts._admin.base')

@section('content')
	  <a class="searcha"><i class="pe-7s-search searchicon"></i><input type="text" id="search" value="" style="height:20px;"/></a>

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
          <th width="150" data-sort="string"> <span class="id">Order Code</span> <div class="sort"></div> </th>
          <th width="150" data-sort="string"> <span class="id">Client Name</span> <div class="sort"></div> </th>
          <th width="250" data-sort="date"> <span class="id">Order Date</span> <div class="sort"></div> </th>
          <th width="250" data-sort="date"> <span class="id">Checkout Type</span> <div class="sort"></div> </th>
          <th width="70" data-sort="float"> <span class="id">Total $</span> <div class="sort"></div> </th>
          <th width="150" align="right">Action</th>
        </tr>
      </thead>

      <tbody id="Searchresult">
		  @if (count($orderData)==0)
          	<tr>
            	<td class="error" colspan="5" align="center"> No Record Found</td>
            </tr>
          @endif

          @foreach ($orderData as $orderDatas)
          <tr>
             <td>{!! $orderDatas['order_no'] !!}</td>
             <td>{!! $orderDatas['client_name'] !!} <br><small style="color: blue;">{!! $orderDatas['client_email'] !!}</small></td>
             <td>{!! date('M d, Y',strtotime($orderDatas['order_date'])) !!}</td>
              <td>{!! $orderDatas['client_type'] !!}</td>
             <td>{!! number_format($orderDatas['total'],2)!!}</td>
             <td align="right">
                <a href="{{url('dnradmin/orders/display/'.$orderDatas['order_no'])}}" alt="Open Orders Details" title="Open Orders Details">
                  <i class="pe-7s-search action-icon"></i>
                </a>
             </td>
          </tr>
          @endforeach

      </tbody>

       @if (!count($orderData)==0)
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
