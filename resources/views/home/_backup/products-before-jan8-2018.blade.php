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
<div class="gallery-style-1">
  <div class="uk-grid uk-padding-remove loading-products"  id="products">
        <div class="uk-width-1-1 product-container uk-margin-medium-bottom uk-margin-medium-top">
           @if (count($product) == 0)
                    <div class="alert alert-danger uk-text-center fsize-30 bold uk-margin-large-top  uk-margin-large-bottom full-width">No Products Found</div>
           @else

            <div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 tm-grid-heights uk-masonry-gallery" data-uk-grid="{gutter: 20, controls: '.filter-btn'}">

               @foreach($product as $products)
                    <div class="product-list-item product-type-{{$products->fldProductIsVertical}}"  data-my-category="{{ $products->fldProductName }}" data-my-category2="{{ $products->fldProductPrice }}" data-uk-filter="{{$products->fldCategorySlug}}">
                    <?php $product_category_array[$nctr] = $products->fldProductCategoryCategoryID;  ?>
                    {{-- */$nctr = $nctr + 1;/* --}}
                    {!! Form::hidden('product_id', $products->fldProductID, array('id' => 'product_id'.$nctr)) !!}
                        <div class="uk-overlay-hover  uk-cover-background  uk-scrollspy-inview uk-animation-fade" >
                              <?php 
                              $product_image_slug = url('uploads/photos/16/447x397-sample-2.jpg');
                              $image_folder_name = 'landscape'; $imagewidth = 456;   $imageheight = 152;  
                              if($products->fldProductIsVertical == 1){
                                $imagewidth = 300;
                                $imageheight = 456; $image_folder_name = 'medium';                                  
                              }  
                              ?>

                              @if($products->fldProductImage != "" && (File::exists(PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/'.$image_folder_name.'/'.$products->fldProductImage)))                                
                                <?php 
                                  $product_image_slug = url(PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/'.$image_folder_name.'/'.$products->fldProductImage);                                   
                                ?>  
                              @endif
                              <figure class="uk-overlay"  style="background-image:url('{{$product_image_slug}}')">
                              {!! Html::image($product_image_slug,$products->fldProductName,array('id'=>'image'.$nctr,'class'=>'uk-align-center w100 hauto pull-left','width'=>$imagewidth,'height'=>$imageheight)) !!}
                          <figcaption class="uk-overlay-panel  uk-overlay-background uk-overlay-slide-bottom uk-overlay-bottom"><h3 class="uk-h3">{{ $products->fldProductName }}</h3>
                        <div class="sub-title roboto light-grey uk-margin-small-bottom">{{ $products->fldProductSubTitle }}</div>
                        <div class="price">From 
                          <?php /* if($products->fldProductOldPrice != '')<span class="uk-text-line-through">${{ number_format($products->fldProductOldPrice,2)}}</span>@endif */ ?>
                          <span class="bold">${{ number_format($products->fldProductPrice,2)}}</span> <span class="price-range-to">to</span> 
                          <span class="bold">${{ number_format($products->fldProductOldPrice,2)}}</span>
                        </div></figcaption>
                              <a class="uk-position-cover"  href="{{ url('products/details/'.$products->fldProductSlug) }}"></a>
                         <? /*<button class="add-to-cart"  onClick="addtoCart({!!$nctr!!})" ><i class="uk-icon-shopping-cart">&nbsp;</i><span class="uk-hidden">Add {!!$products->fldProductName!!} To Cart</span></button>*/ ?>

                          </figure>
                      </div>
                    </div>

                  @endforeach

                </div><!--row uk-grid-width-small-1-2 -->
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
}
.uk-masonry-gallery .product-list-item img {
    opacity: 0 !important;
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