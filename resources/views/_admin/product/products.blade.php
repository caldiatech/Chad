@extends('layouts._admin.base')

@section('content')
  <a class="searcha"><i class="pe-7s-search searchicon"></i><input type="text" id="search" value="" style="height:20px;"/></a>

    <article>
    <div id="page_control">
      <div class="col2">
       <a href="{!!url('dnradmin/category/view/'.$mainid->fldCategoryMainID)!!}">&laquo; Back to {{ CATEGORY_MANAGEMENT }}</a>
       <a href="{!!url('dnradmin/products/new/'.$category_id)!!}"><img src="{!!url('_admin/assets/images/icons/icon_add.png')!!}"> Add {{ PRODUCT_MANAGEMENT }}</a>
     </div>
    </div>


    <br style="clear:both;" />
      <input type='hidden' id='current_page' />
	  <input type='hidden' id='show_per_page' />
      <input type='hidden' id='number_of_items' />


    {!! Form::open(array('url' => '/dnradmin/products/', 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}

    <table id="page_manager" class="parennt-table uk-table-hover">
      <thead>
        <tr class="headers nodrag uk-table">
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

                        <tr id="{{$products->fldProductID.'_'.$products->fldProductPosition}}">
                           <td>{{ $products->fldProductID }}</td>
                           <td>
                           @php
                             $imagesize = 0;
                             $imagesize = ($products->fldProductIsVertical == 1)? THUMB_IMAGE: SMALL_IMAGE;
                             @endphp
                           		@if($products->fldProductImage != "")
	                           		{!! Html::image(PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/'.$imagesize.$products->fldProductImage) !!}
                                @else
                                	{!! Html::image('http://placehold.it/75') !!}
                                @endif
                            </td>
                           <td>{{ $products->fldProductName}} </td>
                           <td>{{ ($products->lowest_price > 0)? '$ '.number_format($products->lowest_price,2): '- - -'}} </td>
                           <td>
                                  {!! Html::image('_admin/assets/images/icons/updown.png') !!}
                                  <span style="border:1px #999999 solid; padding:5px 10px;">{!! $products->fldProductPosition !!}</span>
                           </td>

                           <td align="right">
                              <a href="{!!url('dnradmin/products/edit/'.$products->fldProductID)!!}"><i class="pe-7s-pen action-icon"></i></a>
                              <a href="{!!url('dnradmin/products/delete/'.$products->fldProductID.'/'.$category_id)!!}" alt="Delete Products" onClick="return confirm(&quot;Are you sure you want to remove this Product?\n\nPress OK to delete.\nPress Cancel to go back without deleting the Product.\n&quot;)"><i class="pe-7s-trash action-icon del"></i></a>

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

			$('#page_manager').tableDnD({
					onDrop: function(table, row) {
						$.ajax({
							type: "get",
							url: "{!! url('dnradmin/products/update-position') !!}",
							data: $.tableDnD.serialize(),
							cache: false,
							success: function(data){
								location.href = "{!! url('dnradmin/products/view/'.$category_id) !!}";
							}

						});
					}
			});
	</script>

@stop
