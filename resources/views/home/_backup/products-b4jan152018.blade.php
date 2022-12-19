@extends('layouts._front.category')

@section('content')
   {{-- */$nctr = 0; $products_modal_array = array(); $product_category_array = array();  $category_array = array(); $products_modal_string ='' ; /* --}}
   {{-- Form::open(array('url' => '/images', 'method' => 'post', 'id' => 'pageform', 'class' => 'row-fluid bill-info')) --}}
   {!! Form::open(array('url' => '/collection', 'method' => 'post', 'id' => 'pageform', 'class' => 'row-fluid bill-info')) !!}
	<div class="uk-container uk-container-center uk-margin-medium-bottom">
  <article id="main" role="main">
    <div class="uk-grid">
      <div class="uk-width-1-1 uk-margin-medium-bottom">
        <div class="uk-grid">
          <div class="uk-width-medium-6-10 filter-section uk-width-1-1 uk-width-medium-1-1 uk-margin-medium-top">
           <label class="uk-display-inline uk-margin-medium-right light light-grey">Search By: </label>
           <div class="uk-button-dropdown" data-uk-dropdown>
              <button class="uk-button lato uk-button-trans " type="button">{{ $slug== "" ? "Category" : $category_details->fldCategoryName  }}<i class="ion ion-android-arrow-dropdown uk-margin-small-left"></i></button>
              <div class="uk-dropdown uk-dropdown-small">
                <ul id="products_category" class="uk-nav uk-nav-dropdown bg-dark filter-btn">

            @if($slug!= "")
    			<li class="uk-active" data-uk-sort="my-category" onclick="location.href='{{url("collection")}}';">
    				<a href="{!!url('images')!!}">Category</a>
    			</li>
            @endif

            @foreach($category as $category_item)
                <!--<li class="uk-active" data-uk-sort="my-category">-->
                <li class="uk-active" data-uk-filter="{{$category_item->fldCategorySlug}}" onclick="location.href='{{url("collection/".$category_item->fldCategorySlug)}}';">
                    @if($category_item->fldCategorySlug!=$slug)
                        <!--<a href="{!!url('images/'.$category_item->fldCategorySlug)!!}">{{$category_item->fldCategoryName}}</a>-->
                        <a href="javascript:void(0)">{{$category_item->fldCategoryName}}</a>
                    @endif
                </li>
                <?php $category_array[$category_item->fldCategoryID] = $category_item->fldCategorySlug; ?>
            @endforeach

                </ul>
              </div>
            </div>
            <div class="uk-button-dropdown  uk-margin-small-left" data-uk-dropdown>
              <button class="uk-button uk-button-trans lato"  type="button">Default Sorting <i class="ion ion-android-arrow-dropdown uk-margin-small-left"></i></button>
              <div class="uk-dropdown uk-dropdown-small">
                <ul id="products_sort" class="uk-nav uk-nav-dropdown bg-dark filter-btn">
                  <li class="uk-active" data-uk-sort="my-category"><a href="#">Product Name (A-Z)</a></li>
                  <li data-uk-sort="my-category:desc"><a href="#">Product Name (Z-A)</a></li>
                </ul>
              </div>
            </div>

          </div>

          <div class="uk-width-medium-4-10  uk-width-1-1 bg-black input-100 uk-margin-medium-top">
            <div class="text-wrapper uk-width-small-1-2 uk-width-1-1 uk-float-right">

                {!! Form::text('search',"",array('id'=>'search','required','class'=>'uk-padding-medium-left','placeholder'=>'Search By Name')) !!}
                <button class="input-go" type="submit" name="find"><i class="ion-ios-search ion"></i></button>

            </div>
          </div>

        </div>
      </div>

    </div>
  </article>
</div><!--container -->
{!! Form::close() !!}
<?php 
  $product_counter = 0;
  function generate_product_figure($product_id = 0, $product_name = '', $product_subtitle = '', $product_slug = '', $product_image = '', $product_isvert = 0, $product_price_from = 0,
    $product_price_to = '', $category_slug = '', $this_counter = 0 ){
    $product_figure_html = '<div class="product-list-item product-list-item-'.$this_counter.'  product-type-'.$product_isvert.'"  data-my-category="'.$product_name.'" data-my-category2="'.$product_price_from.'" data-uk-filter="'.$category_slug.'">';

      $product_figure_html .= '<input id="product_id'.$this_counter.'" name="product_id" type="hidden" value="'.$product_id.'">';
      $product_figure_html .= '<div class="uk-overlay-hover  uk-cover-background  uk-scrollspy-inview uk-animation-fade" >';
        $product_image_slug = url('uploads/photos/16/447x397-sample-2.jpg');
        $image_folder_name = 'landscape';  
        if($product_isvert == 1){
           $image_folder_name = 'medium';                                  
        }  
        if($product_image != "" && (File::exists(PRODUCT_IMAGE_PATH.$product_slug.'/'.$image_folder_name.'/'.$product_image))) {
          $product_image_slug = url(PRODUCT_IMAGE_PATH.$product_slug.'/'.$image_folder_name.'/'.$product_image);
        } 
      $product_figure_html .= '<figure class="uk-overlay" style="background-image:url(\''.$product_image_slug.'\')">';
          $product_figure_html .= '<img src="'.url('_front/assets/images/ajax-loader.gif').'" width="50" height="50">';
        $product_figure_html .= '<figcaption class="uk-overlay-panel  uk-overlay-background uk-overlay-slide-bottom uk-overlay-bottom">';
          $product_figure_html .= '<h3 class="uk-h3">'.$product_name.'</h3>';
          $product_figure_html .= '<div class="sub-title roboto light-grey uk-margin-small-bottom">'.$product_subtitle.'</div>';
          $product_figure_html .= '<div class="price">From';
            $product_figure_html .= '<span class="bold">$'.number_format($product_price_from,2).'</span> <span class="price-range-to">to</span>';
            $product_figure_html .= '<span class="bold">$'.number_format($product_price_to,2).'</span>';
          $product_figure_html .= '</div>';
        $product_figure_html .= '</figcaption>';
        $product_figure_html .= '<a class="uk-position-cover"  href="'.url('products/details/'.$product_slug) .'"></a>';
      $product_figure_html .= '</figure>';
      $product_figure_html .= '</div>';
    $product_figure_html .= '</div>';
    return $product_figure_html;
  }

  function get_vertical_products($product_vertical, $v_counter){
    $v_html = '';
    if(count($product_vertical) > 0){
      foreach($product_vertical as $product_vertical_item){
        $v_html .= generate_product_figure($product_vertical_item->fldProductID, $product_vertical_item->fldProductName, $product_vertical_item->fldProductSubTitle, $product_vertical_item->fldProductSlug, $product_vertical_item->fldProductImage, $product_vertical_item->fldProductIsVertical, $product_vertical_item->fldProductOldPrice, $product_vertical_item->fldProductPrice, $product_vertical_item->fldCategorySlug, $v_counter);
        $v_counter++;
      }
      return $v_html;
    }
  }

?>
<div class="gallery-style-1">
  <div class="uk-grid oading-products"  id="products"> 
        <div class="uk-width-1-1 product-container uk-margin-medium-bottom uk-margin-medium-top horizontal-count-{{count($product_vertical)}}">
           @if (count($product) > 0)
             <div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 tm-grid-heights uk-masonry-gallery" data-uk-grid="{gutter: 20, controls: '.filter-btn'}">
              @foreach($product as $products)                    
                    <?php                        
                      echo generate_product_figure($products->fldProductID, $products->fldProductName, $products->fldProductSubTitle, $products->fldProductSlug, $products->fldProductImage, $products->fldProductIsVertical, $products->fldProductOldPrice, $products->fldProductPrice, $products->fldCategorySlug, $product_counter);
                      $product_counter++;
                    ?>
              @endforeach
              </div><!--row uk-grid-width-small-1-2 -->       
           @elseif (count($product_vertical) > 0)
            <div class="uk-grid tm-grid-heights uk-masonry-gallery" data-uk-grid="{gutter: 40, controls: '.filter-btn'}">              
              {!!get_vertical_products($product_vertical)!!}             
            </div><!--row uk-grid-width-small-1-2 -->
          @else
            <div class="alert alert-danger uk-text-center fsize-30 bold uk-margin-large-top  uk-margin-large-bottom full-width">No Products Found</div>
          @endif


    </div><!--row uk-grid-width-small-1-2 -->

       <div class="uk-width-1-1 uk-margin-large-bottom uk-margin-large-top">

             <ul class="uk-pagination">
             @if($product->total()  > 1)
                <li><a href="{{ $slug != "" ? url('/collection/'.$slug.'?page=1') : url('/collection?page=1') }}"> <i class="uk-icon uk-icon-chevron-left  pe-7s-angle-left"></i> </a></li>
             @endif
             @for($i=1;$i<=$product->lastPage();$i++)
                @if($i==$product->currentPage())
                    <li class='uk-active'><span>{{ $i }}</span></li>
                @else
                  <li><a href="{{ $slug != "" ? url('/collection/'.$slug.'?page='.$i) : url('/collection?page='.$i) }}">{{ $i }}</a></li>
                @endif
             @endfor

              @if($product->total()  > 1)
                <li><a href="{{ $slug != "" ? url('/collection/'.$slug.'?page='.$product->lastItem()) : url('/collection?page='.$product->lastPage()) }}"> <i class="uk-icon uk-icon-chevron-right  pe-7s-angle-right"></i> </a></li>
              @endif
             </ul>


      </div>
  </div><!--row top5 -->
</div><!--row gallery-style-1 -->
@stop

@section('headercodes')
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
    background-color: #191919;
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

</style>
	<script>
		var url = "{{ url('/') }}";
	</script>

@stop

@section('extracodes')
<div class="">
  {!!$products_modal_string!!}
</div>

@if (count($product) > 0)

{!! HTML::script('_front/plugins/uikit/js/components/grid.min.js') !!}
{!! HTML::script('_front/assets/js/cart.js') !!}
<script>
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

@endif

@stop