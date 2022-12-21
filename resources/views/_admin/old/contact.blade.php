@extends('layouts._admin.base')

@section('content')
    <article>
    <div id="page_control">
    	<div class="col2">
	       {{ HTML::image_link('/dnradmin/contact/new','_admin/assets/images/icons/icon_add.png',' Add Contact') }}
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
                       <td>{{ $contacts->id }}</td>
                       <td>{{ $contacts->firstname . ' ' . $contacts->lastname}} </td>
                       <td>{{ $contacts->email}} </td>
                       <td align="right">
                         {{ HTML::image_link('/dnradmin/contact/edit/'.$contacts->id,'_admin/assets/images/icons/page_modify.png','',' Modify Contact') }}

                         {{ HTML::image_link_delete('/dnradmin/contact/delete/'.$contacts->id,'_admin/assets/images/icons/page_delete.png') }}
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
  {{ HTML::style('_admin/assets/css/pagination.css') }}
@stop

@section('extracodes')

    {{ HTML::script('_admin/assets/js/cufon_avantgarde.js') }}
    {{ HTML::script('_admin/assets/js/jquery-latest.min.js') }}
    {{ HTML::script('_admin/assets/js/FilterPagination/filter.js') }}
    {{ HTML::script('_admin/assets/js/stupidtable.min.js') }}
    {{ HTML::script('_admin/assets/js/sorted.js') }}

     <script>
		showPagination(20,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));
	</script>
@stop
