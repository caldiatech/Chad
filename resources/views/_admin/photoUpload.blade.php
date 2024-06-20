@extends('layouts._admin.base')

@section('content')
    <article>
    <br>
    <br>
    @if(Session::has('success'))
        <div class="uk-alert uk-alert-danger">{!!Session::get('success')!!}</div>
    @endif
    @if(Session::has('error'))
        <div class="uk-alert uk-alert-danger">{!!Session::get('error')!!}</div>
    @endif
    <div id="page_control">
      <div class="col2">
       <a href="{{url('/dnradmin/add/CustomImage')}}"><img src="{!!url('_admin/assets/images/icons/icon_add.png')!!}"> Add Images</a>
     </div>
    </div>
    <br style="clear:both;" />
      <input type='hidden' id='current_page' />
	  <input type='hidden' id='show_per_page' />
      <input type='hidden' id='number_of_items' />

    <table id="page_manager" class="parennt-table uk-table-hover">
      <thead>
        <tr class="headers nodrag uk-table">
          <th width="70" data-sort="int"> <span class="id">ID</span> <div class="sort"></div> </th>
          <th width="150">Raw Image</th>
          <th width="200" data-sort="string"><span class="id">Image Name</span> <div class="sort"></div></th>
		  <th width="150" data-sort="int"><span class="id">Price Range</span> <div class="sort"></div></th>
          <th width="120" data-sort="int"><span class="id">Thumbnail Image</span> <div class="sort"></div></th>

          <th width="150" align="right">Action</th>
        </tr>
      </thead>

      <tbody id="Searchresult">
      				@if ($product->isEmpty())
                    	<tr>
                        	<td class="error" colspan="7" align="center"> No Record Found</td>
                        </tr>
                    @endif

                        @foreach ($product as $products)

                        <tr id="{{$products->Id}}">
                           <td>{{ $products->Id }}</td>
                           <td>
                           @php
                             $imagesize = 0;
                             $imagesize = THUMB_IMAGE;
                             @endphp
                           		@if($products->orignal_image != "")
                               <img src="{{ asset('storage/' . $products->orignal_image) }}" alt="Original Image">
                                 <!-- <img src="http://127.0.0.1:8000/upload/products/blaze-of-glory/small/blaze-of-glory-5-21-21-web.jpg"> -->
                                @else
                                	{!! Html::image('http://placehold.it/75') !!}
                                @endif
                            </td>
                           <td>{{ $products->image_name}} </td>
                           <td>{{ '$ '.$products->price_range}} </td>
                           <td>
                           @if($products->thumbnail_image != "")
                           <img src="{{ asset('storage/'. $products->thumbnail_image) }}" alt="Thumbnail Image">
                           @else
                                	{!! Html::image('http://placehold.it/75') !!}
                            @endif
                           </td>
                           <td align="right">
                              <a href="{!!url('dnradmin/CustomImage/edit/'.$products->Id)!!}"><i class="pe-7s-pen action-icon"></i></a>
                              <a href="{!!url('dnradmin/CustomImage/delete/'.$products->Id)!!}" alt="Delete Image" onClick="return confirm(&quot;Are you sure you want to remove this Image?\n\nPress OK to delete.\nPress Cancel to go back without deleting the Product.\n&quot;)"><i class="pe-7s-trash action-icon del"></i></a>

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
@stop
