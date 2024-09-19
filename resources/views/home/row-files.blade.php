<!doctype Html>
<!--[if lte IE 8]><Html class="msie no-js no-svg" lang="en"><![endif]-->
<!--[if gte IE 9]><!--><Html class="no-js no-svg" lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title> {!! $pages->fldPagesTitle !!} </title>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<link href="{!! asset('_front/assets/icons/Icon.png') !!}" rel="apple-touch-icon">
<link href="{!! asset('_front/assets/icons/favicon.png') !!}" type="image/png" rel="shortcut icon">

  {!! Html::style('_front/assets/css/bootstrap.min.css') !!} 
  {!! Html::style('_front/plugins/uikit/css/uikit.min.css') !!} 
  {!! Html::style('_front/assets/css/core.css') !!}  
  {!! Html::style('_front/assets/css/page.css') !!}  
  {!! Html::script('_front/assets/js/jquery-1.9.1.min.js') !!}
  {!! HTML::script('_front/plugins/uikit/js/uikit.min.js') !!}
  {!! HTML::script('_front/plugins/uikit/js/components/grid.min.js') !!}
<!--[if lt IE 9]>
  {!! Html::script('_front/assets/js/respond.min.js') !!}
  {!! Html::script('_front/assets/js/Html5shiv.js') !!}
<![endif]-->
@section('headercodes')
@show 
</head>
<body>
  {{-- @section('content') --}}
<div id="container">
  <!-- HEADER START-->
    <div class="wrap header">
        @include("layouts._front.header")
    </div>

    <?php
      $product_counter = 0;
      function generate_product_figure($product_id = 0, $product_name = '', $product_subtitle = '', $product_slug = '', $product_image = '', $product_isvert = 0, $product_price = 0, $category_slug = '', $this_counter = 0, $productID = 0, $products = [] ){
       //  $product_figure_html = '<main>
       //    <div id="happy"><p>Happy</p></div>
       //    <div id="sad"> <p>Sad</p></div>
       //    <div id="confused"><p>Confused</p></div>
       // </main>';
        $product_figure_html = '<div class="row" data-grid-prepared="true" style="padding: 20px;">';

        $product_figure_html .= '<div class="col-xs-4 col-md-4 product-list-item product-list-item-'.$this_counter.'  product-type-'.$product_isvert.'"  data-my-category="'.$product_name.'" data-my-category2="'.$product_price.'" data-uk-filter="'.$category_slug.'">';

          $product_figure_html .= '<input id="product_id'.$this_counter.'" name="product_id" type="hidden" value="'.$product_id.'">';
          $product_figure_html .= '<div class="uk-overlay-hover  uk-cover-background  uk-scrollspy-inview uk-animation-fade" >';
            $product_image_slug = url('uploads/photos/16/447x397-sample-2.jpg');
            //$image_folder_name = 'landscape';
            $image_folder_name = 'medium';
            if($product_isvert == 1){
              $image_folder_name = 'medium';
            }
            if($product_image != "" && (File::exists(CUSTOM_IMAGE_PATH.$product_image))) {
              $product_image_slug = url(CUSTOM_IMAGE_PATH.$product_image);
            }
            $product_figure_html .= '<figure class="uk-overlay" style="background-image:url(\''.$product_image_slug.'\')">';
            $product_figure_html .= '<img src="'.url('_front/assets/images/ajax-loader.gif').'" width="50" height="50">';
            $product_figure_html .= '<figcaption class="uk-overlay-panel  uk-overlay-background uk-overlay-slide-bottom uk-overlay-bottom">';
              $product_figure_html .= '<h3 class="uk-h3">'.$product_name.'</h3>';
              $product_figure_html .= '<div class="sub-title roboto light-grey uk-margin-small-bottom">'.$product_subtitle.'</div>';

              if (isset($product_price) && $product_price > 0) {
                $product_figure_html .= '<div class="price">Credit ';
                // $product_figure_html .= '<div class="price"> ';
                    {{-- if(is_numeric($product_price)){
                      $product_figure_html .= '<span class="bold">'.number_format($product_price,2).'</span>';
                    }else{ --}}
                      $product_figure_html .= '<span class="bold">'.$product_price.'</span>';
                    {{-- } --}}
                  $product_figure_html .= '</div>';
              }

              $thumbnailimage = "";
              if($products->thumbnail_image != ""){
                $thumbnailimage =  '<div class="image-container img-tag-container"><img src="'.url('storage/'. $products->thumbnail_image).'" class="fit-image"></div>';
              }

              $imagedesc = "";
              $imagedesc .=  '<div class="image-info"><label>Image Name: </label><p>'.$products->image_name.'</p></div>';
              $imagedesc .=  '<div class="image-info"><label>Price Range: </label><p>'.$products->price_range.'</p></div>';
              $imagedesc .=  '<div class="image-info"><label>Description: </label><p>'.$products->description.'</p></div>';

            $product_figure_html .= '</figcaption>';
            $product_figure_html .= '<a class="uk-position-cover"  href="'.url('/credit/details/'.$productID).'"></a>';
          $product_figure_html .= '</figure>';
          $product_figure_html .= '</div>';
        $product_figure_html .= '</div>';
        $product_figure_html .= '<div class="col-xs-4 col-md-4" >'.$thumbnailimage.'</div>';
        $product_figure_html .= '<div class="col-xs-4 col-md-4" >'.$imagedesc.'</div>';
        $product_figure_html .= '</div>';
        return $product_figure_html;
      }

      {{-- function get_vertical_products($product_vertical, $v_counter){
        $v_html = '';
        if(count($product_vertical) > 0){
          foreach($product_vertical as $product_vertical_item){
            $v_html .= generate_product_figure($product_vertical_item->fldProductID, $product_vertical_item->fldProductName, $product_vertical_item->fldProductSubTitle, $product_vertical_item->fldProductSlug, $product_vertical_item->fldProductImage, $product_vertical_item->fldProductIsVertical, $product_vertical_item->fldProductOldPrice, $product_vertical_item->fldProductPrice, $product_vertical_item->fldCategorySlug, $v_counter);
            $v_counter++;
          }
          return $v_html;
        }
      } --}}

    ?>

    <div class="gallery-style-1">
      <div class="uk-grid oading-products"  id="products">
          <div class="uk-width-1-1 product-container uk-margin-medium-bottom uk-margin-medium-top">
              @if (count($rowImgs) > 0)
                <div class="uk-grid-width-small-1-2 uk-grid-width-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 tm-grid-heights uk-masonry-gallery" data-uk-grid="{gutter: 20, controls: '.filter-btn'}">
                <div class="section">
                @foreach($rowImgs as $products)
                    <!-- $product_image_slug = url('uploads/photos/16/447x397-sample-2.jpg');
                    //$image_folder_name = 'landscape';
                    $image_folder_name = 'medium';
                    if($product_isvert == 1){
                      $image_folder_name = 'medium';
                    }
                    if($product_image != "" && (File::exists(PRODUCT_IMAGE_PATH.$product_slug.'/'.$image_folder_name.'/'.$product_image))) {
                      $product_image_slug = url(PRODUCT_IMAGE_PATH.$product_slug.'/'.$image_folder_name.'/'.$product_image);
                    } -->
                    {{-- <figure class="uk-overlay" style="background-image:url(\''.$product_image_slug.'\')">
                        <img src="{{url('_front/assets/images/ajax-loader.gif')}}" width="50" height="50">
                          <figcaption class="uk-overlay-panel  uk-overlay-background uk-overlay-slide-bottom uk-overlay-bottom">
                            <h3 class="uk-h3">product_name</h3>
                            <div class="sub-title roboto light-grey uk-margin-small-bottom">product_subtitle</div>
                          </figcaption> --}}
                          {{-- <a class="uk-position-cover"  href="{{url('products/details/'.$product_slug) }}"></a> --}}
                    {{-- </figure> --}}
                     <?php

                      $fldProductPrice = $products->price_range;
                      $lowest_price = $highest_price = 0;
                      $fldProductID = $products->fldProductID;
                      if(isset($product_array_highest_prices[$fldProductID])){
                        $highest_price = $product_array_highest_prices[$fldProductID];
                      }
                      if(isset($product_array_lowest_prices[$fldProductID])){
                        $lowest_price = $product_array_lowest_prices[$fldProductID];
                      }
                      if($lowest_price > 0 && $highest_price > 0){

                      }else if(isset($product_array_prices[$fldProductID])){
                        $lowest_price = $product_array_prices[$fldProductID];
                        $highest_price = 0;
                      }
                      echo generate_product_figure($products->fldProductID, $products->image_name, $products->fldProductSubTitle, $products->fldProductSlug, $products->thumbnail_image, $products->fldProductIsVertical, $fldProductPrice, $products->fldCategorySlug, $product_counter, $products->id, $products);
                      $product_counter++;
                    ?>
                @endforeach
              </div><!--row uk-grid-width-small-1-2 -->
            </div><!--row section -->
            @else
              <div class="alert alert-danger uk-text-center fsize-30 bold uk-margin-large-top  uk-margin-large-bottom full-width">No Products Found</div>
            @endif


          </div><!--row uk-grid-width-small-1-2 -->

          <div class="uk-width-1-1 uk-margin-large-bottom uk-margin-large-top">

                <ul class="uk-pagination">
                @if($rowImgs->total()  > 1)
                    <li><a href="{{ $slug != '' ? url('/unedited-digital-files/'.$slug.'?page=1') : url('/unedited-digital-files?page=1') }}"> <i class="uk-icon uk-icon-chevron-left  pe-7s-angle-left"></i> </a></li>
                @endif
                @for($i=1;$i<=$rowImgs->lastPage();$i++)
                    @if($i==$rowImgs->currentPage())
                        <li class='uk-active'><span>{{ $i }}</span></li>
                    @else
                      <li><a href="{{ $slug != '' ? url('/unedited-digital-files/'.$slug.'?page='.$i) : url('/unedited-digital-files?page='.$i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                  @if($rowImgs->total()  > 1)
                    <li><a href="{{ $slug != '' ? url('/unedited-digital-files/'.$slug.'?page='.$rowImgs->lastItem()) : url('/unedited-digital-files?page='.$rowImgs->lastPage()) }}"> <i class="uk-icon uk-icon-chevron-right  pe-7s-angle-right"></i> </a></li>
                  @endif
                </ul>
          </div>
      </div><!--row top5 -->
    </div><!--row gallery-style-1 -->
  </div>
  {{-- @stop --}}
  <div class="wrap footer">
      @include("layouts._front.footer")
  </div>
@section('extracodes')
@show 
@include("layouts._front.nav-mobile")
</body>
<style type="text/css" media="screen">
.product-container{
    margin: auto; width: 100%; max-width: 1800px;
}
div#products{ position: relative; overflow: hidden; }
div#products.loading-products > .product-container:before {
    content: 'Loading....';
    text-align: center;
    position: absolute;
    top: -50%;
    left: -50%;
    width: auto;
    display: block;
    right: -50%;
    bottom: -50%;
    margin: auto;
    height: 22px;
    z-index: 1;
}

figure.uk-overlay {
    background-position: center center;
    background-repeat: no-repeat;    background-size: contain;
    background-color: #edecec;

}
/*.gallery-style-1 #products .product-container .product-list-item.product-list-item-0 figure.uk-overlay,
.gallery-style-1 #products .product-container .product-list-item.product-list-item-1 figure.uk-overlay,
.gallery-style-1 #products .product-container .product-list-item.product-list-item-2  figure.uk-overlay{
 min-height: 410px;
}
.gallery-style-1 #products .product-container .product-list-item{
  width: 50%;
}
.gallery-style-1 #products .product-container .product-list-item.product-list-item-0 {
    width: 80%;
}
.gallery-style-1 #products .product-container.horizontal-count-1 .product-list-item.product-list-item-0{
  width: 90%;
}
.gallery-style-1 #products .product-container.horizontal-count-0 .product-list-item.product-list-item-0{
  width: 100%;
}
.gallery-style-1 #products .product-container .product-list-item.product-list-item-1, .gallery-style-1 #products .product-container .product-list-item.product-list-item-2 {
    width: 10%;
}*/
.uk-masonry-gallery .product-list-item img {
    opacity: 0 !important;     width: 100%; height: auto;
}
.section {
  width: 100%;
}

.image-info {
  display: flex;
  /*justify-content: space-between;
  align-items: center;*/
}

.image-info label {
  margin-right: 10px;
  font-weight: bold;
}

.image-info p {
  margin: 0;
}

.image-container {
  width: 100%; /* or any specific width */
  height: 300px; /* or any specific height */
  margin-bottom: 20px; /* space between divs for visual clarity */
}

/* Background image method */
./*background-image-container {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
*/
/* img tag method */
.img-tag-container {
  overflow: hidden;
}

.fit-image {
  width: 100%;
  height: 141%;
  object-fit: cover;
  object-position: center;
}

</style>
{{-- <script>
		var url = "{{ url('/') }}";
</script>

@stop

@section('extracodes')
<div class="">
  {!!$products_modal_string!!}
</div>

@if (count($rowImgs) > 0)


{!! HTML::script('_front/assets/js/cart.js') !!}
<script>

    function zaOrder() {
        window.location.replace("http://54.68.88.28/clarkin/collection/za");
    }
    function azOrder() {
        window.location.replace("http://54.68.88.28/clarkin/collection");
    }

  $(window).load(function(){
    $(document).ready(function(){
      $('#products').removeClass('loading-products');
    });
  });
    $(document).ready(function(){
        $('a[data-uk-modal]').on({
            'show.uk.modal': function(){
                console.log("Modal is visible.");
            },

            'hide.uk.modal': function(){
                console.log("Element is not visible.");
            }
        });

        // function changeURL(slug) {
        //     alert(slug);
        // }

    });

</script>
@endif --}}

</Html>