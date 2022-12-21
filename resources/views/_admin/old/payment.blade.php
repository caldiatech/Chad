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

    {{ Form::open(array('url' => '/dnradmin/payment/', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}

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
                           <td>{{ $payments->id }}</td>
                           <td>{{ $payments->name}} </td>
                           <td>
                           		@if($payments->isActive == 1)
                                	{{ HTML::image_link('dnradmin/payment/edit/'.$payments->id,'_admin/assets/images/icons/icon_active.png','',' On ') }}
                                @else
                                	{{ HTML::image_link('dnradmin/payment/edit/'.$payments->id,'_admin/assets/images/icons/icon_hidden.png','',' Off ') }}
                                @endif
                           </td>

                           <td align="right">

                             	 {{ HTML::image_link('/dnradmin/payment/view/'.$payments->id,'_admin/assets/images/icons/folder.png','',' Display Settings ') }}

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
     {{ Form::close() }}
  </article>


@stop

@section('headercodes')
  {{ HTML::style('_admin/assets/css/pagination.css') }}
@stop

@section('extracodes')


    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js') }}
    {{ HTML::script('_admin/assets/js/jquery-latest.min.js') }}
    {{ HTML::script('_admin/assets/js/FilterPagination/filter.js') }}

    <script>
		 showPagination(20,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));
	</script>

@stop
