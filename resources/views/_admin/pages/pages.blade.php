@extends('layouts._admin.base')

@section('content')
<?php
$hide_pages_id = array(44, 81, 82, 87, 102);
?>

  <a class="searcha"><i class="pe-7s-search searchicon"></i><input type="text" id="search" value="" style="height:20px;"/></a>

    <article class="dawnpage">

    <div id="page_control">
         @if($mainid!=555)
           <div class="col1">
              {!! Html::link('/dnradmin/pages/view/'.$mainid,PAGE_MANAGEMENT) !!}
                @if($mainpage != "")
                  <i class="pe-7s-angle-right"></i> {!! Html::link('/dnradmin/pages/view/'.$mainpage->fldPagesID,$mainpage->fldPagesName) !!}
                @endif
              <i class="pe-7s-angle-right"></i> {!!$page_display->fldPagesName!!}
           </div>
        @endif

        <div class="col2">
            <a href="{{url('dnradmin/pages/new')}}"><img src="{{url('_admin/assets/images/icons/icon_add.png')}}"> Add {{ PAGE_MANAGEMENT }}</a>
       </div>
    </div>

    <br style="clear:both;" />
    <input type='hidden' id='current_page' />
    <input type='hidden' id='show_per_page' />
    <input type='hidden' id='number_of_items' />

    {!! Html::flash_msg_admin() !!}

    <table id="page_manager" class="parennt-table uk-table-hover">
      <thead>
        <tr class="headers nodrag uk-table">
          <th width="70" data-sort="int"><span class="id">ID</span> <div class="sort"></div></th>
          <th width="170" data-sort="string"><span class="id">Page Name</span> <div class="sort"></div></th>
          <th width="300" data-sort="string"><span class="id">URL</span> <div class="sort"></div></th>
          <th width="170">&nbsp;<? /* Show in Navigation */ ?></th>
          <th width="70">CMS</td>
          <th width="70" data-sort="int" class="sorting-asc"><span class="id">Position</span> <div class="ascending"></div></th>
          <th width="100" align="right">Action</th>
        </tr>
      </thead>

      <tbody id="Searchresult">
		@if ($page->isEmpty())
        	<tr>
            	<td class="error" colspan="7" align="center"> No Record Found</td>
            </tr>
        @endif

			@foreach ($page as $pages)
        <?php
          if(in_array($pages->fldPagesID, $hide_pages_id)){
            continue;
          }
        ?>
        <tr id="{{$pages->fldPagesID.'_'.$pages->fldPagesPosition}}">
           <td>{{ $pages->fldPagesID }}</td>
           <td>{{ $pages->fldPagesName}} </td>
           <td>
           		@if($pages->fldPagesFilename != "")
                	{!! Html::link($pages->fldPagesFilename,url($pages->fldPagesFilename),array('target'=>'_blank')) !!}
                @else
                	@if($pages->fldPagesID == 32)
                    	{!! Html::link(url("/"),url("/")."/",array('target'=>'_blank')) !!}
                    @else
                    	{!! Html::link($pages->fldPagesSlug,url("/".$pages->fldPagesSlug),array('target'=>'_blank')) !!}
                    @endif
                @endif
           </td>
           <td> &nbsp;
			 <!--
       			{{-- @if($pages->fldPagesIsVisible == 1)
                	{!! Html::image('_admin/assets/images/icons/icon_active.png',' On ') !!}
                @else
                	{!! Html::image('_admin/assets/images/icons/icon_hidden.png',' Off ') !!}
                @endif --}}
             -->
           </td>
            <td>
        		@if($pages->fldPagesIsCMS == 1)
                	{!! Html::image('_admin/assets/images/icons/icon_active.png',' On ') !!}
                @else
                	{!! Html::image('_admin/assets/images/icons/icon_hidden.png',' Off ') !!}
                @endif
            </td>
           <td>
                  {!! Html::image('_admin/assets/images/icons/updown.png') !!}
                  <span style="border:1px #999999 solid; padding:5px 10px;">{!! $pages->fldPagesPosition !!}</span>
            </td>
           <td align="right">
               @if($pages->fldPagesMainID != "" && $pages->fldPagesID != 32 )
                 <?php /* <a href="{{url('dnradmin/pages/view/'.$pages->fldPagesID)}}" alt="Display Sub Category"><i class="pe-7s-photo-gallery action-icon"></i></a> */ ?>
               @endif

                 <a href="{{url('dnradmin/pages/edit/'.$pages->fldPagesID)}}" alt="Modify Page"><i class="pe-7s-pen action-icon"></i></a>
                 <a href="{{url('dnradmin/pages/delete/'.$pages->fldPagesID)}}" alt="Delete Page" onClick="return confirm(&quot;Are you sure you want to remove this Page?\n\nPress OK to delete.\nPress Cancel to go back without deleting the Page.\n&quot;)"><i class="pe-7s-trash action-icon del"></i></a>

           </td>
        </tr>
        @endforeach
      </tbody>

      @if (count($page) > 20)
      <tfoot>
        <th colspan="7" align="right" height="30">
	          <div id='page_navigation' class="pagination"></div>
        </th>
      </tfoot>
      @endif

    </table>
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
						url: "{!! url('dnradmin/pages/update-position') !!}",
						data: $.tableDnD.serialize(),
						cache: false,
						success: function(data){
							location.href = "{!! url('dnradmin/pages/view/'.$pageid) !!}";
						}

					});
				}
			});

			$('#page_manager1').tableDnD({
				onDrop: function(table, row) {
					$.ajax({

						type: "get",
						url: "{!! url('dnradmin/pages/sub-update-position') !!}",
						data: $.tableDnD.serialize(),
						cache: false,
						success: function(data){
							location.href = "{!! url('dnradmin/pages/view/'.$pageid) !!}";
						}

					});
				}
			});

			$('#page_manager2').tableDnD({
				onDrop: function(table, row) {
					$.ajax({

						type: "get",
						url: "{!! url('/') !!}/dnradmin/pages/third-update-position",
						data: $.tableDnD.serialize(),
						cache: false,
						success: function(data){
							location.href = "{!! url('dnradmin/pages/view/'.$pageid) !!}";
						}

					});
				}
			});

	</script>

@stop
