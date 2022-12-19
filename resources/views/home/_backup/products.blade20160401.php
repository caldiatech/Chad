@extends('layouts._front.category')

@section('content')
   {{-- */$nctr = 0; $products_modal_array = array(); $product_category_array = array();  $category_array = array(); $products_modal_string ='' ; /* --}}  
	<div class="uk-container uk-container-center uk-margin-medium-bottom">
  <article id="main" role="main">
    <div class="uk-grid"> 
      <div class="uk-width-1-1"> 
          <div class="uk-width-1-1 uk-margin-medium-bottom uk-margin-medium-top">
            <div class="uk-button-dropdown" data-uk-dropdown>
              <button class="uk-button uk-button-trans text-uppercase">Category <i class="uk-icon-caret-down"></i></button>
              <div class="uk-dropdown uk-dropdown-small">
                <ul id="products_category" class="uk-nav uk-nav-dropdown">
                   @foreach($category as $category_item)  
                   <li class="uk-active" data-uk-sort="my-category"><a href="{!!url('image-galleries/'.$category_item->fldCategorySlug)!!}">{!!$category_item->fldCategoryName!!}</a></li>
                   <?php $category_array[$category_item->fldCategoryID] = $category_item->fldCategorySlug; ?>
                   @endforeach
                </ul>
              </div>
            </div>
             <div class="uk-button-dropdown  uk-margin-small-left" data-uk-dropdown>
              <button class="uk-button uk-button-trans text-uppercase">Default Sorting <i class="uk-icon-caret-down"></i></button>
              <div class="uk-dropdown uk-dropdown-small">
                <ul id="products_sort" class="uk-nav uk-nav-dropdown">
                  <li class="uk-active" data-uk-sort="my-category"><a href="#">Character (Asc)</a></li>
                  <li data-uk-sort="my-category:desc"><a href="#">Character (Desc)</a></li>
                  <li data-uk-sort="my-category2"><a href="#">Number (Asc)</a></li>
                  <li data-uk-sort="my-category2:desc"><a href="#">Number (Desc)</a></li>
                </ul>
              </div>
            </div>          
          </div>
      </div>

    </div>  
  </article>
</div><!--container -->
<div class="gallery-style-1">
  <div class="uk-grid uk-padding-remove "  id="products">        
        <div class="uk-width-1-1  uk-margin-medium-bottom uk-margin-medium-top">
           @if ($count_all == 0)  
                    <div class="alert alert-danger uk-text-center fsize-30 bold uk-margin-large-top  uk-margin-large-bottom full-width">No Products Found</div>
           @else  

            <div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 tm-grid-heights" data-uk-grid="{gutter: 20, controls: '#products_sort'}">          

               @foreach($product as $products)       
                    <div  data-my-category="a" data-my-category2="8" >
                    <?php $product_category_array[$nctr] = $products->fldProductCategoryCategoryID;  ?>
                    {{-- */$nctr = $nctr + 1;/* --}} 
                    {!! Form::hidden('product_id', $products->fldProductID, array('id' => 'product_id'.$nctr)) !!}                   
                        <div class="uk-overlay-hover  uk-cover-background  uk-scrollspy-inview uk-animation-fade" >
                          <figure class="uk-overlay">   
                              @if($products->fldProductImage != "" && (File::exists(PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/'.MEDIUM_IMAGE.$products->fldProductImage))) 
                                    {!! Html::image(PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/'.MEDIUM_IMAGE.$products->fldProductImage,$products->fldProductName,array('id'=>'image'.$nctr,'class'=>'uk-align-center w100 hauto pull-left','width'=>'456','height'=>'376')) !!}
                              @else
                                    {!! Html::image('uploads/photos/16/447x397-sample-2.jpg',$products->fldProductName,array('id'=>'image'.$nctr,'class'=>'uk-align-center w100 hauto pull-left','width'=>'456','height'=>'376')) !!}   
                              @endif
                          <figcaption class="uk-overlay-panel  uk-overlay-background uk-overlay-slide-bottom uk-overlay-bottom"><h3 class="uk-h3">{{ $products->fldProductName}}</h3>
                        <div class="sub-title roboto light-grey uk-margin-small-bottom">{!! substr($products->fldProductDescription, 0, 20) !!}</div>
                        <div class="price">From @if($products->fldProductOldPrice != '')<span class="uk-text-line-through">${{ number_format($products->fldProductOldPrice,2)}}</span>@endif <span class="bold">${{ number_format($products->fldProductPrice,2)}}</span></div></figcaption>
                              <a class="uk-position-cover"  href="#modal_{!!$products->fldProductID!!}" data-uk-modal=''></a>
                          <button class="add-to-cart"  onClick="addtoCart({!!$nctr!!})" ><i class="fa fa-shopping-cart">&nbsp;</i><span class="uk-hidden">Add {!!$products->fldProductName!!} To Cart</span></button>
                              
                          </figure>
                      </div>
                    </div>    
                    <?php $products_modal_string .= '<div id="modal_'.$products->fldProductID.'" class="uk-modal"><div class="uk-modal-dialog uk-modal-dialog-lightbox  uk-modal-dialog-large"><a href="" class="uk-modal-close uk-close uk-close-alt"></a>
                    <div class="uk-modal-header"><h2>'.$products->fldProductName.'</h2></div>';
                    if($products->fldProductImage != "" && (File::exists(PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/'.$products->fldProductImage))) {
                      $products_modal_string .= '<img src="'.url(PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/'.THUMB_IMAGE.$products->fldProductImage).'" alt="'.$products->fldProductImage.'" width="1920" height="800" class="uk-align-center w100 hauto pull-left load-img" data-url="'.url(PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/'.$products->fldProductImage).'" >';
                    }else{
                    $products_modal_string .= '<img src="'.url('uploads/photos/16/447x397-sample-2.jpg').'" alt="'.$products->fldProductImage.'" width="1920" height="800" class="uk-align-center w100 hauto pull-left" >';
                    }
                    $products_modal_string .= '
                    <div class="uk-modal-footer"><a href="'.url('products/details/'.$products->fldProductSlug).'">See Details</a></div>
                      </div>
                    </div> ';?>


                  @endforeach   
                   
                </div><!--row uk-grid-width-small-1-2 --> 
              @endif                

      
    </div><!--row uk-grid-width-small-1-2 --> 
 
 <?php 
        if($count_all > 0){

          $paginate_temp = $paginate;  
$prev_page = $paginate_temp-1; $counter_last_4 = 1;
$next_page = $paginate_temp+1;
$count_paginated = $paginate * $limit_end;
        ?>
          <div class="uk-width-1-1 uk-margin-medium-bottom uk-margin-medium-top">
      <ul class="uk-pagination">
    

  <?php      
      
  $pa = $limit_start;   
  $pa_counter = 1; 
  $pagination = ''; 
  $pa_start = 0; 
  $pa_to = $limit_end;
  $pagination_array = array();  $uk_enable = ''; $href= 'javascript:void(0);';
  $category_details->fldCategorySlug = $category_array[$product_category_array[$pa_counter]];
    if($paginate == 1){
       $uk_enable = 'uk-disabled';  $href= 'javascript:void(0);';
     }else{
      $uk_enable = ''; $href= url('image-galleries/'.$category_details->fldCategorySlug.'/'.$prev_page);
     }   
   echo stripslashes('<li class="'.$uk_enable.'"><a href="'.$href.'"  class="page-prev paginate-nav"><i class="">&nbsp;</i></a></li>');
  
    
  while($pa_start < $count_all){
    $activeclass="";
     $category_details->fldCategorySlug = $category_array[$product_category_array[$pa_counter]];
    if($paginate ==$pa_counter){
      $activeclass="uk-active";
       echo stripslashes('<li class="'.$activeclass.'"><span>'.$pa_counter.'</span></li>');
    }else{
      echo stripslashes('<li class=""><a href="'.url('image-galleries/'.$pa_counter).'">'.$pa_counter.'</a></li>');
    }
  
    $pa_start += $limit_end; 
    $pa_counter++;
    $pa +=  $limit_end;
    
  }
  
  if(($count_paginated  < $count_all) || (($count_paginated+$limit_end) < $count_all)){ 
    $uk_enable = '';     $href= url('image-galleries/'.$category_details->fldCategorySlug.'/'.$next_page);
    
  }else{ $uk_enable = 'uk-disabled';  $href= 'javascript:void(0);'; }
   echo stripslashes('<li><a  href="'. $href.'" class="page-next paginate-nav"><i class="">&nbsp;</i></a></li>');
   //next
?>
</ul>
    </div>
<?php }
  ?>
	
      
  </div><!--row top5 --> 
</div><!--row gallery-style-1 -->
@stop

@section('headercodes')
	<script>
		var url = "{{ url('/') }}";
	</script>

@stop

@section('extracodes')
<div class="">
  {!!$products_modal_string!!}
</div>

@if ($count_all > 0)  

{!! HTML::script('_front/plugins/uikit/js/components/grid.min.js') !!}
{!! HTML::script('_front/assets/js/cart.js') !!}
<script>

    $(document).ready(function(){      
      $('a[data-uk-modal]').on({
        'show.uk.modal': function(){
            console.log("Modal is visible.");
        },

        'hide.uk.modal': function(){
            console.log("Element is not visible.");
        }
    });
    });
    </script>

@endif   

@stop