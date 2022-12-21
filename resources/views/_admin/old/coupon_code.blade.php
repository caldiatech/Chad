@extends('layouts._admin.base')

@section('content')
    <article>
    <div id="page_control">
    	<div class="col2">
	       {{ HTML::image_link('/dnradmin/coupon_code/new/','_admin/assets/images/icons/icon_add.png',' Add Coupon Code') }}
        </div>
        <div class="col1">
        	Coupon Code
        </div>
    </div>



    <br style="clear:both;" />
      <input type='hidden' id='current_page' />
	  <input type='hidden' id='show_per_page' />
      <input type='hidden' id='number_of_items' />
	  <label for="search">Search:</label> <input type="text" id="search" value="" style="height:20px;"/>

    {{ Form::open(array('url' => '/dnradmin/coupon_code/', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}

    <table id="page_manager">
      <thead>
        <tr class="headers">
          <th width="70" data-sort="int"> <span class="id">ID</span> <div class="sort"></div> </th>
          <th width="450" data-sort="string"><span class="id">Coupon Name</span> <div class="sort"></div></th>
		  <th width="150" data-sort="string"><span class="id">Coupon Code</span> <div class="sort"></div></th>
          <th width="150" align="right">Action</th>
        </tr>
      </thead>

      <tbody id="Searchresult">
      				@if ($coupon->isEmpty())
                    	<tr>
                        	<td class="error" colspan="6" align="center"> No Record Found</td>
                        </tr>
                    @endif

                        @foreach ($coupon as $coupons)

                        <tr>
                           <td>{{ $coupons->id }}</td>
                           <td>{{ $coupons->name}} </td>
                           <td>{{ $coupons->code}} </td>
                           <td align="right">
                             {{ HTML::image_link('/dnradmin/coupon_code/edit/'.$coupons->id,'_admin/assets/images/icons/page_modify.png','',' Modify Coupon Code') }}
                             {{ HTML::image_link_delete('/dnradmin/coupon_code/delete/'.$coupons->id,'_admin/assets/images/icons/page_delete.png') }}
                           </td>
                        </tr>

                        @endforeach

      </tbody>
      @if (!$coupon->isEmpty())
      <tfoot>
        <th colspan="6" align="right" height="30">

          	 <div id='page_navigation' class="pagination"></div>
        </th>

      </tfoot>
     @endif
    </table>
     {{ Form::close() }}
  </article>


@stop

@section('headercodes')
  {{ HTML::style('_admin/assets/css/pagination.css') }}
@stop

@section('extracodes')

    {{ HTML::script('_admin/manager/tinymce/tiny_mce.js') }}
    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js') }}
    {{ HTML::script('_admin/assets/js/jquery-latest.min.js') }}
    {{ HTML::script('_admin/assets/js/FilterPagination/filter.js') }}
    {{ HTML::script('_admin/manager/tinymce/styles/mods2.js') }}
    {{ HTML::script('_admin/assets/js/jquery.tablednd.js') }}
    {{ HTML::script('_admin/assets/js/stupidtable.min.js') }}
    {{ HTML::script('_admin/assets/js/sorted.js') }}

@stop
