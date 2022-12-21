@extends('layouts._admin.base')

@section('content')
		<?
        //$queries = DB::getQueryLog();

		//print_r($queries);
		//die();
		?>

    <article>
    <div id="page_control" class="col1">
       {{ HTML::image_link('/dnradmin/category/view/'.$mainid->main_id,'_admin/assets/images/icons/icon_add.png',' Back to Category') }}
       {{ HTML::image_link('/dnradmin/products/new','_admin/assets/images/icons/icon_add.png',' Add Products') }}
    </div>

    <h2 class="line">Products</h2>

    <br style="clear:both;" />
      <input type='hidden' id='current_page' />
	  <input type='hidden' id='show_per_page' />
      <input type='hidden' id='number_of_items' />
	  <label for="search">Search:</label> <input type="text" id="search" value="" style="height:20px;"/>

    {{ Form::open(array('url' => '/dnradmin/products/', 'method' => 'post', 'id' => 'pageform', 'files' => true)); }}

    <table id="page_manager">
      <thead>
        <tr class="headers nodrag">
          <th width="70" data-sort="int"> <span class="id">ID</span> <div class="sort"></div> </th>
          <th width="150">  </th>
          <th width="400" data-sort="string"><span class="id">Product Name</span> <div class="sort"></div></th>
		  <th width="150" data-sort="int"><span class="id">Price</span> <div class="sort"></div></th>
          <th width="120" data-sort="int"><span class="id">Position</span> <div class="sort"></div></th>

          <th width="150" align="right">Action</th>
        </tr>
      </thead>

      <tbody id="Searchresult">
      				@if ($product->isEmpty())
                    	<tr>
                        	<td class="error" colspan="6" align="center"> No Record Found</td>
                        </tr>
                    @endif

                        @foreach ($product as $products)

                        <tr id="{{$products->id.'_'.$products->position}}">
                           <td>{{ $products->id }}</td>
                           <td>
                           		@if($products->image != "")
	                           		{{ HTML::image('upload/products/'.$products->id.'/_75_'.$products->image) }}
                                @else
                                	 {{ HTML::image('http://placehold.it/75') }}
                                @endif
                            </td>
                           <td>{{ $products->name}} </td>
                           <td>{{ '$'.number_format($products->price,2)}} </td>
                           <td>
                                  {{ HTML::image('_admin/assets/images/icons/updown.png') }}
                                  <span style="border:1px #999999 solid; padding:5px 10px;">{{ $products->position }}</span>
                           </td>

                           <td align="right">
                             {{ HTML::image_link('/dnradmin/products/edit/'.$products->id,'_admin/assets/images/icons/page_modify.png','',' Modify Category') }}
                             {{ HTML::image_link_delete('/dnradmin/products/delete/'.$products->id.'/'.$category_id,'_admin/assets/images/icons/page_delete.png') }}
                           </td>
                        </tr>

                        @endforeach

      </tbody>
      @if (!$product->isEmpty())
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

    <script>
		showPagination(20,$('#page_manager tbody>tr').size(),$('#page_manager tbody>tr'));

			$('#page_manager').tableDnD({
					onDrop: function(table, row) {
						$.ajax({
							type: "get",
							url: "{{ $pageURL }}/dnradmin/products/update-position",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){
								location.href = "{{ $pageURL }}/dnradmin/products/view/<?=$category_id?>";
							}

						});
					}
			});
	</script>

@stop
