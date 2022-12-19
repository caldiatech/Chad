@extends('layouts._admin.base')

@section('content')
<?php
$array_of_sort = array(
  array('fldStyleDescription/ASC', 'Product Name (A-Z)'),
  array('fldStyleDescription/DESC', 'Product Name (Z-A)'),
  //array('tblStyles.fldStylePopularity/DESC', 'Most Popular (Highest to Lowest)'),
  //array('tblStyles.fldStylePopularity/ASC', 'Most Popular (Lowest  to Highest)'),
  array('tblStyles.fldStyleCode/ASC', 'Style Code (Lowest  to Highest)'),
  array('tblStyles.fldStyleCode/DESC', 'Style Code (Highest to Lowest)'),
  array('InventoryStock/ASC', 'Inventory Stock (Lowest  to Highest)'),
  array('InventoryStock/DESC', 'Inventory Stock (Highest to Lowest)')
);

$this_mod_url = url('dnradmin/products');
if(Input::get('review') != NULL){
  $review_value = Input::get('review');
  $this_mod_url = url('dnradmin/products?review='.$review_value);
}
?>
<div class="searcha">{!! Form::open(array('url' => '/dnradmin/products', 'method' => 'post', 'id' => 'search-form')); !!}<i class="pe-7s-search searchicon"></i><input type="text" name="search_input" id="search" value="{{$keyword}}" style="height:20px;"/><input type="submit" class="uk-hidden"><input type="hidden" name="searchon" value="products" class="uk-hidden">

<select name="sort_by" id="sort_by" onChange="submitme('search-form')" class="sort-select">
  @foreach($array_of_sort as $array_of_sort_item)
    <?php 
    $selected_option = '';
    if($array_of_sort_item[0] == $sort_by_fld){
        $selected_option = ' selected = "selected" ';
    }
    ?>
      <option value="{{$array_of_sort_item[0]}}" {{$selected_option}}>{{$array_of_sort_item[1]}}</option>
  @endforeach
</select>{!! Form::close() !!} 
</div>

<article class="dawnproduct">
    <div id="page_control">
      <div class="col1">
      </div>
      <div class="col2">
        <a href="javascript:void(0)" class="download_sample_file" style="margin-left: 15px"><i class="pe-7s-config uk-text-large"></i> Download Bulk Update Sample File</a>
        <a href="javascript:void(0)" class="open_upload_price_inventory_status_modal" style="margin-left: 15px"><i class="pe-7s-config uk-text-large"></i> Upload Bulk Update</a>
        <a href="{!!url('dnradmin/products/product-options')!!}" style="margin-left: 15px"><i class="pe-7s-config uk-text-large"></i> Bulk Update </a>
        <a href="{!!url('dnradmin/inventory')!!}" style="margin-left: 15px"><i class="pe-7s-map uk-text-large"></i> Inventory Settings </a>
        <a href="{!!url('dnradmin/products/new')!!}" class="uk-hidden" style="margin-left: 15px"><img src="{!!url('_admin/assets/images/icons/icon_add.png')!!}"> Add {{ PRODUCT_MANAGEMENT }}</a>
      </div>
    </div>

    <br style="clear:both;" />
      <input type='hidden' id='current_page' />
    <input type='hidden' id='show_per_page' />
      <input type='hidden' id='number_of_items' />
      @if(isset($keyword) && $keyword != '')
       <div class="uk-with-1-1 uk-text-primary ">Results of products with {!! $keyword !!}</div>
      @endif
    <div class="uk-hidden">
      {!! Form::open(array('url' => '/dnradmin/import-productoptions', 'method' => 'post', 'id' => 'import-pageform', 'files' => true, 'class'=> ' uk-hidden')); !!}
      <div class="form-import">
        <input type="file" name="import_file">
        <input type="submit" name="submit" value="Submit">
      </div>
      {!! Form::close() !!}
    </div>
<!--    <label for="search">Search:</label> <input type="text" id="search" value="" style="height:20px;"/>  -->

    {!! Form::open(array('url' => $this_mod_url, 'method' => 'post', 'id' => 'pageform', 'files' => true)); !!}
    @if(Session::has('success'))
             <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
        @endif
    <table id="page_manager" class="uk-table-hover">
      <thead>
        <tr class="headers nodrag uk-table">
          <th width="70" data-sort="int"> <span class="id">ID</span> <div class="sort"></div> </th>
          <th width="70" data-sort="string"> <span class="id">Category</span> <div class="sort"></div> </th>
          <th width="70" data-sort="string"> <span class="id">Brand</span> <div class="sort"></div> </th>
          <th width="350" data-sort="string"><span class="id">Product Name</span> <div class="sort"></div></th>
          <th width="70" data-sort="string"><span class="id">Style Code</span> <div class="sort"></div></th>
          <th width="70" data-sort="int"><span class="id">Price</span> <div class="sort"></div></th>
          <!--<th width="70" data-sort="int"><span class="id">Position (Popularity)</span> <div class="sort"></div></th>-->
          <th width="70" data-sort="string"><span class="id">On Sale</span> <div class="sort"></div></th>
          <th width="70" data-sort="string"><span class="id">Featured</span> <div class="sort"></div></th>
          <th width="70" data-sort="int"><span class="id"><i class="uk-icon uk-icon-star action-icon"></i></span> <div class="sort"></div></th>
          <th width="70" data-sort="int"><span class="id">Reviews</span> <div class="sort"></div></th>
          <th width="70" align="right">Action</th>
        </tr>
      </thead>

      <tbody id="Searchresult">
              @if ($product->isEmpty())
                      <tr>
                          <td class="error" colspan="5" align="center"> No Record Found</td>
                        </tr>
                    @endif

                        @foreach ($product as $products)

                        <tr id="{{$products->fldStyleID.'_'.$products->ProductPopularityCounter.'_'.$category_id}}" class="product-item-row" data-productid="{{$products->fldStyleID}}">
                            <td>{{ $products->fldStyleID }}</td>
                            <td>{{ $products->fldCategoryName }}</td>
                            <td>{{ $products->MillDescription }}</td>
                            <td><a href="{!!url('dnradmin/products/edit/'.$products->fldStyleID)!!}" style="color:#777">{{ $products->fldStyleDescription}}</a> </td>
                            <td>{{ $products->fldStyleCode }}</td>
                            <td>{{ $products->CasePrice }}</td>
                          
                          <!-- <td class=" ">
                               <span class="ProductPopularityCounter_{{ $products->fldStyleID }}-lbl">{!! $products->ProductPopularityCounter !!}</span>
                               <span class="edit-fld" data-target="ProductPopularityCounter_{{ $products->fldStyleID }}"><i class="pe-7s-edit"></i></span></span>
                               {!! Form::text(
                               'ProductPopularityCounter',
                               $products->ProductPopularityCounter,
                               array(
                                    'id'=>'ProductPopularityCounter_'.$products->fldStyleID,
                                    'required',
                                    'placeholder'=>' Product Popularity Counter',
                                    'class'=>'uk-hidden editable-fld',
                                    'data-product-id' => $products->fldStyleID
                                )) !!}
                           </td>-->
                            <td>@if($products->isSale == 1) <i class="pe-7s-check action-icon"></i> @else <i class="pe-7s-close action-icon"></i> @endif</td>
                            <td>@if($products->isFeatured == 1) <i class="pe-7s-check action-icon"></i> @else <i class="pe-7s-close action-icon"></i> @endif</td>
                            <td class="star-rate"><strong class="star-rate-average">0</strong> / 5</td>
                           <td class="reviews-counter">
                                0
                           </td>

                           <td align="right">
                              <a href="{!!url('dnradmin/products/edit/'.$products->fldStyleID)!!}"><i class="pe-7s-pen action-icon"></i></a>
                              <a href="{!!url('dnradmin/products/delete/'.$products->fldStyleID.'/'.$category_id)!!}" alt="Delete Products" onClick="return confirm(&quot;Are you sure you want to remove this Product?\n\nPress OK to delete.\nPress Cancel to go back without deleting the Product.\n&quot;)"><i class="pe-7s-trash action-icon del"></i></a>

                           </td>
                        </tr>

                        @endforeach

      </tbody>
      
      @if (!$product->isEmpty())     
      <tfoot>
        <th colspan="6" align="right" height="30">            
              {!! $product->appends(Request::capture()->except('page','_token'))->render() !!}
        </th>

      </tfoot>
     @endif
    </table>
     {!! Form::close() !!}
  </article>
  <input type="hidden" value="{{$this_mod_url}}" id="this_mod_url" />

<div id="modal-sections" class="uk-modal" uk-modal esc-close="false" bg-close="false">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title" style="color:#666;">Upload Price, Inventory, Status</h2>
        </div>
        <div class="uk-modal-body">
            <form class="uk-form uk-text-center" id="upload_price_inventory_status_form">
                <div style="display: none;" class="upload-success uk-overflow-container uk-margin-large-top uk-container-center uk-width-medium-1-1 uk-alert uk-alert-success">S</div>
                <div style="display: none;" class="upload-error uk-overflow-container uk-margin-large-top uk-container-center uk-width-medium-1-1 uk-alert uk-alert-danger">E</div>
                <div style="display: none;" class="upload-warning uk-overflow-container uk-margin-large-top uk-container-center uk-width-medium-1-1 uk-alert uk-alert-warning">W</div>
                {{csrf_field()}}
                <div class="uk-alert uk-alert-warning status_warning" style="display:none;"></div>
                <input type="file" name="product_csv" placeholder="Excel File">

            </form>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close close-btn" type="button">Cancel</button>
            <button class="uk-button uk-button-primary upload_price_inventory_status_btn" type="button">Save</button>
        </div>
    </div>
</div>
<form action="{{ url('/dnradmin/products/download_sample_file') }}" method="POST" style="display:none" id="download_sample_file_form">
    <input type="text" value="" name="filepath">
</form>
@stop

@section('headercodes')
  {!! Html::style('_admin/assets/css/pagination.css') !!}
  <style type="text/css">
    #Searchresult tr td.reviews-counter:after {
      content: '\e668';
      font-family: Pe-icon-7-stroke;
      font-size: 20px;    position: relative;
      left: 6px;
    }
    .sort-select{
      
      padding: 6px;
      border-radius: 22px;
      position: relative;
      top: 7px;
      color: #333333;
      border-color: rgba(0,0,0,0.2);

      }

  </style>
@stop

@section('extracodes')

    {!! Html::script('_admin/assets/js/jquery.tablednd.js','') !!}
    {!! Html::script('_admin/assets/js/stupidtable.min.js','') !!}
    {!! Html::script('_admin/assets/js/sorted.js','') !!}

    <script>

      {{--$('#page_manager').tableDnD({--}}
         {{--onDrop: function(table, row) {--}}
           {{--$.ajax({--}}
             {{--type: "get",--}}
             {{--url: "{!! url('dnradmin/products/update-position') !!}",--}}
             {{--data: $.tableDnD.serialize(),--}}
             {{--cache: false,--}}
             {{--success: function(data){--}}
               {{--location.href = "{!! $this_mod_url !!}";--}}
             {{--}--}}

           {{--});--}}
         {{--}--}}
      {{--});--}}

      $(document).ready(function(){
        count_reviews();

          $('.edit-fld').on('click', function(){
              var get_this_target = $(this).attr('data-target');
              $('#'+get_this_target).removeClass('uk-hidden');
//              $('.'+get_this_target+'-lbl').addClass('uk-hidden');
              $('#'+get_this_target).focus();
      });
          $('.editable-fld').blur(function(){
              var get_this_target = $(this).attr('id');
//              $('.'+get_this_target+'-lbl').removeClass('uk-hidden');
              $('#'+get_this_target).addClass('uk-hidden');
              if ($('.'+get_this_target+'-lbl').text() != $(this).val()) {
                  $('.'+get_this_target+'-lbl').text($(this).val());
                  updateRank($(this), $(this).attr('data-product-id'));
              }
          }).on('keyup', function(e){
              if (e.keyCode == 13) {
                  $(this).trigger('blur');
              }
          });

          input_numeric($('.editable-fld'));
      });
      var timeout_clearer;

      function updateRank (uiRankField, iProductID) {
          var oParams = {
              fldProductID : iProductID,
              ProductPopularityCounter : $(uiRankField).val()
          };
          var modal_saving = '';

          $.ajax({
              url: '{{url("dnradmin/products/update-rank")}}',
              data: oParams,
              type: 'POST',
              beforeSend: function () {
                  modal_saving = UIkit.modal.blockUI('<div class="uk-alert uk-alert-warning"> Updating... </div>');
              },
              complete: function () {
                  modal_saving.hide();
              },
              success:  function(data){
                  console.log(data);
                  var modal_saved = UIkit.modal.blockUI('<div class="uk-alert uk-alert-success"> Product Rank Updated! </div>');
                  clearTimeout(timeout_clearer);
                  timeout_clearer = setTimeout(function(){
                      modal_saved.hide();
                  }, 1500);

              }
          });
      }
      function input_numeric (uiElement){
          if(typeof(uiElement) != 'undefined')
          {
              uiElement.off('keydown.input_numeric').on('keydown.input_numeric', function (e){
                  // Allow: backspace, delete, tab, escape, enter and .
                  if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110/*, 190*/]) !== -1 ||
                      // Allow: Ctrl+A
                      (e.keyCode == 65 && e.ctrlKey === true) ||
                      // Allow: Ctrl+C
                      (e.keyCode == 67 && e.ctrlKey === true) ||
                      // Allow: Ctrl+X
                      (e.keyCode == 88 && e.ctrlKey === true) ||
                      // Allow: Ctrl+R
                      (e.keyCode == 82 && e.ctrlKey === true) ||
                      // Allow: Ctrl+V
                      (e.keyCode == 86 && e.ctrlKey === true) ||
                      // Allow: home, end, left, right
                      (e.keyCode >= 35 && e.keyCode <= 39)) {
                      // let it happen, don't do anything
                      return;
                  }
                  // Ensure that it is a number and stop the keypress
                  if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                      e.preventDefault();
                  }
              });
          }
      }

      function count_reviews(){
        var array_of_productids = new Array();
        var array_of_product_review = {};
        $.each($('tr.product-item-row'), function(){
          //console.log();
          var data_product_id = $(this).attr('data-productid');
          array_of_productids.push(data_product_id);
          array_of_product_review[data_product_id] = new Array();
          array_of_product_review[data_product_id]['star'] = 0;
          array_of_product_review[data_product_id]['review_counter'] = 0;
        });
        $.ajax({
            type: "GET",
            url: "{{url('dnradmin/products/count-product-review')}}",
            data: { product_ids: array_of_productids },
            cache: false,
            success: function(data){
              var this_data = JSON.parse(data); 
              console.log('this_data');
              console.log(this_data); 
              $.each(this_data, function( review_item_fld,  review_item_fld_value ) {
                  
                array_of_product_review[review_item_fld_value.fldPRProductID]['star'] += review_item_fld_value.fldPRStars;
                array_of_product_review[review_item_fld_value.fldPRProductID]['review_counter']++;

              });

              $.each(array_of_product_review, function( review_item_index,  review_item_value ) {

                console.log('review_item_index');
                console.log(review_item_index);
                console.log('review_item_value');
                console.log(review_item_value);
                console.log('review_item_value[star]');
                console.log(review_item_value['star']);
                console.log('review_item_value[review_counter]');
                console.log(review_item_value['review_counter']);
                if(review_item_value['star'] > 0 && review_item_value['review_counter'] > 0){
                  var average_rate = review_item_value['star'] / review_item_value['review_counter'];
                  console.log('average_rate');
                  console.log(average_rate);
                  $('tr.product-item-row[data-productid="'+review_item_index+'"] .reviews-counter').text(review_item_value['review_counter']);
                  $('tr.product-item-row[data-productid="'+review_item_index+'"] .star-rate-average').text(precisionRound(average_rate,1));
                }
                

              });
            }
        });
      }

      function precisionRound(number, precision) {
        var factor = Math.pow(10, precision);
        return Math.round(number * factor) / factor;
      }


      function submitme(form_id){
        $('#'+form_id).submit();
      }

      /*Randall*/
      $(document).ready(function () {
          var currentRequest = null;

          $('.close-btn').on('click', function () {
              if (currentRequest != null) {
                  currentRequest.abort();
                  $('.upload_price_inventory_status_btn').css({'pointer-events': 'auto', 'opacity': '1'}).find('.fa-spinner').remove();
              }
          });

          $('.download_sample_file').on('click', function () {
              $('#download_sample_file_form').submit();
          });

          var uiUploadPriceInventoryStatus = UIkit.modal($('#modal-sections'), {});

          $('.open_upload_price_inventory_status_modal').on('click', function () {
              hideMsgs();
              uiUploadPriceInventoryStatus.show();
          });

          // We can attach the `fileselect` event to all file inputs on the page with :file selector
          $(document).on('change', '[name="product_csv"]', function () {
              var input = $(this),
                  numFiles = input.get(0).files ? input.get(0).files.length : 1,
                  label = input.val().replace(/\\/g, '/').replace(/.*\//, ''),
                  sValue = $(this).val(),
                  ext = sValue.substring(sValue.lastIndexOf('.') + 1).toLowerCase();

              fileselect($(this), numFiles, label, ext);
          });

          function fileselect(element, numFiles, label, ext) {
              var input = $(element).parents('.input-group').find(':text'),
                  log = numFiles > 1 ? numFiles + ' files selected' : label;

              if (ext == 'csv' || ext == 'xls' || ext == 'xlsx') {
                  if (input.length) {
                      input.val(log);
                  } else {
                      if (log) console.log(log);
                  }
              }
              else {
                  var uiForm = $('#upload_price_inventory_status_form');
                  renderErrorMsg(uiForm, 'The upload file must be a file of type: csv, xls, xlsx.');
                  input.val('');
                  $(element).val('');
              }
          }

          $('#upload_price_inventory_status_form').on('submit', function (e) {
              e.preventDefault();
          });

          $('.upload_price_inventory_status_btn').on('click', function (e) {
              if ($('[name="product_csv"]').val() != '') {
                  uploadPriceInventoryStatus($(this));
              }
              else {
                  var uiForm = $('#upload_price_inventory_status_form');
                  renderErrorMsg(uiForm, 'Please choose a file.');
              }
          });

          function uploadPriceInventoryStatus (uiBtn) {
              hideMsgs();
              var uiForm = $('#upload_price_inventory_status_form');
              uiForm.find('.has-error').removeClass('has-error');
              var formData = new FormData();
              formData.append("product_csv", uiForm.find('[name="product_csv"]')[0].files[0]);

              currentRequest = $.ajax({
                  'type': 'POST',
                  'url': '<?php echo url("dnradmin/products/upload_price_inventory_status"); ?>',
                  'data': formData,
                  'cache': false,
                  'processData': false,
                  'dataType': "json",
                  'contentType': false,
                  'headers': {'X-CSRF-TOKEN': uiForm.find('[name="_token"]').val()},
                  'beforeSend': function() {
                      if(currentRequest != null) {
                          currentRequest.abort();
                      }
                      uiBtn.css({
                          'pointer-events': 'none',
                          'opacity': '0.5'
                      }).append(' <i class="fa fa-spinner fa-pulse"></i>');
                  },
                  'complete': function() {
                      uiBtn.css({
                          'pointer-events': 'auto',
                          'opacity': '1'
                      }).find('.fa-spinner').remove();
                  },
                  'success': function(oData) {
                      console.log(oData);
                      if (oData.status) {
                          var sMsgs = 'Price, Inventory, Status Information successfully saved!';
                          var title = 'Success!';
                          var type = 'success';

                          if (oData.rows_skipped.length > 0) {
                              sMsgs = 'Price, Inventory, Status Information successfully saved but there are rows that are skipped';
                              sMsgs += '<div class="text-left">';
                              title = 'Warning!';
                              type = 'warning';
                              for (var x in oData.rows_skipped) {
                                  var row = oData.rows_skipped[x];
                                  sMsgs += '<br>Row '+ row.row + ':';
                                  for (var i in row.message) {
                                      var msg = row.message[i];
                                      sMsgs += '<p style="font-size:14px;">'+ msg[0] + '</p>';
                                  }
                              }
                              sMsgs += '</div>';
                              renderWarningMsg(uiForm, sMsgs);
                          } else {
                              renderSuccessMsg(uiForm, sMsgs);
                          }
                      } else {
                          if (typeof(oData.errors) != 'undefined') {
                              var sMsgs = '';
                              $.each(oData.errors, function(key, value) {
                                  sMsgs += value + '<br>';

//                                  if (typeof(uiForm) != 'undefined') {
//                                      uiForm.find('[name="'+key+'"]').addClass('has-error');
//                                  }
                              });
                              renderErrorMsg(uiForm, sMsgs);
                          }
                      }
                  },
                  'error': function(jqXhr, json, errorThrown) {
                      console.log(jqXhr);
                      if (jqXhr.hasOwnProperty('responseJSON')) {
                          if (jqXhr.responseJSON.hasOwnProperty('errors')) {
                              var errors = jqXhr.responseJSON.errors;
                              var sMsgs = '';
                              $.each(errors, function(key, value) {
                                  sMsgs += value + '<br>';

//                                  if (typeof(uiForm) != 'undefined') {
//                                      uiForm.find('[name="'+key+'"]').addClass('has-error');
//                                  }
                              });
                              renderErrorMsg(uiForm, sMsgs);
                          }
                      }
                  }
              });
          }

          function hideMsgs () {
              var uiForm = $('#upload_price_inventory_status_form');
              uiForm.find('.upload-error').html('').hide();
              uiForm.find('.upload-success').html('').hide();
              uiForm.find('.upload-warning').html('').hide();
          }
          function renderErrorMsg (uiForm, sMsg) {
              uiForm.find('.upload-error').html(sMsg).show();
          }

          function renderSuccessMsg (uiForm, sMsg) {
              uiForm.find('.upload-success').html(sMsg).show();

          }
          function renderWarningMsg (uiForm, sMsg) {
              uiForm.find('.upload-warning').html(sMsg).show();
          }
      });
  </script>

@stop