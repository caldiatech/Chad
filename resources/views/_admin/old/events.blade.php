@extends('layouts._admin.base')

@section('content')
    <article>
    <div id="page_control" class="col1">
       {{ HTML::image_link('/dnradmin/events/new','_admin/assets/images/icons/icon_add.png',' Add Events') }}
    </div>

    <h2 class="line">Events</h2>

    <br style="clear:both;" />

       <input type='hidden' id='current_page' />
	  <input type='hidden' id='show_per_page' />
      <input type='hidden' id='number_of_items' />
	  <label for="search">Search:</label> <input type="text" id="search" value="" style="height:20px;"/>

    {{ Form::open(array('url' => '/dnradmin/events/', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}

    <table id="page_manager">
      <thead>
        <tr class="headers">
          <td width="70"> ID </td>
          <td width="150">Title</td>
          <td width="450">Date</td>

          <td width="150" align="center">Action</td>
        </tr>
      </thead>

      <tbody id="Searchresult">
					@if ($events->isEmpty())
                    	<tr>
                        	<td class="error" colspan="4" align="center"> No Record Found</td>
                        </tr>
                    @endif


          			@foreach ($events as $eventss)

                    <tr>
                       <td>{{ $eventss->id }}</td>
                       <td>{{ $eventss->name }} </td>
                       <td>{{ date('F d, Y',strtotime($eventss->events_date)) }} </td>


                       <td align="center">
                         {{ HTML::image_link('/dnradmin/events/edit/'.$eventss->id,'_admin/assets/images/icons/page_modify.png','',' Modify Events') }}

                         {{ HTML::image_link_delete('/dnradmin/events/delete/'.$eventss->id,'_admin/assets/images/icons/page_delete.png') }}
                       </td>
                    </tr>

                    @endforeach


      </tbody>

      @if (!$events->isEmpty())
      <tfoot>
        <th colspan="4" align="right" height="30">

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

    <script>
		showPagination(20,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));
	</script>

@stop
