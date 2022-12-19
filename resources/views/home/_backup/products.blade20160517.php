@extends('layouts._front.category')

@section('content')
   {{-- */$nctr = 0; $products_modal_array = array(); $product_category_array = array();  $category_array = array(); $products_modal_string ='' ; /* --}}  
	<div class="uk-container uk-container-center uk-margin-medium-bottom">
  <article id="main" role="main">
    <div class="uk-grid"> 
      <div class="uk-width-1-1 uk-margin-medium-bottom"> 
        <div class="uk-grid"> 
          <div class="uk-width-medium-6-10 filter-section uk-width-1-1 uk-width-medium-1-1 uk-margin-medium-top">
           <label class="uk-display-inline text-uppercase uk-margin-medium-right light light-grey">Search By</label>  
           <div class="uk-button-dropdown" data-uk-dropdown>
              <button class="uk-button lato uk-button-trans ">{{ $slug== "" ? "Category" : $category_details->fldCategoryName  }}<i class="ion ion-android-arrow-dropdown uk-margin-small-left"></i></button>
              <div class="uk-dropdown uk-dropdown-small">
                <ul id="products_category" class="uk-nav uk-nav-dropdown bg-dark">
		   @if($slug!= "")
			<li class="uk-active" data-uk-sort="my-category">
				 <a href="{!!url('image-galleries')!!}">Category</a>
			</li>
		   @endif	
                   @foreach($category as $category_item)  
                   <li class="uk-active" data-uk-sort="my-category">
			 @if($category_item->fldCategorySlug!=$slug)
                             <a href="{!!url('image-galleries/'.$category_item->fldCategorySlug)!!}">{!!$category_item->fldCategoryName!!}</a>
                         @endif  
		   </li>
                   <?php $category_array[$category_item->fldCategoryID] = $category_item->fldCategorySlug; ?>
                   @endforeach
                </ul>
              </div>
            </div> 
            <div class="uk-button-dropdown  uk-margin-small-left" data-uk-dropdown>
              <button class="uk-button uk-button-trans lato">Default Sorting <i class="ion ion-android-arrow-dropdown uk-margin-small-left"></i></button>
              <div class="uk-dropdown uk-dropdown-small">
                <ul id="products_sort" class="uk-nav uk-nav-dropdown bg-dark">
                  <li class="uk-active" data-uk-sort="my-category"><a href="#">Product Name (Asc)</a></li>
                  <li data-uk-sort="my-category:desc"><a href="#">Product Name (Desc)</a></li>
                  <li data-uk-sort="my-category2"><a href="#">Price (Asc)</a></li>
                  <li data-uk-sort="my-category2:desc"><a href="#">Price (Desc)</a></li>
                </ul>
              </div>
            </div>       
           
          </div>
          <div class="uk-width-medium-4-10  uk-width-1-1 bg-black input-100 uk-margin-medium-top">
            <div class="text-wrapper uk-width-small-1-2 uk-width-1-1 uk-float-right">             
              {!! Form::text('search',"",array('id'=>'search','required','class'=>'','placeholder'=>'SEARCH')) !!}
              <button class="input-go" type="submit" name="find"><i class="ion-ios-search ion"></i></button>
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
           @if (count($product) == 0)  
                    <div class="alert alert-danger uk-text-center fsize-30 bold uk-margin-large-top  uk-margin-large-bottom full-width">No Products Found</div>
           @else  

            <div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 tm-grid-heights uk-masonry-gallery" data-uk-grid="{gutter: 20, controls: '#products_sort'}">          

               @foreach($product as $products)       
                    <div class="product-list-item"  data-my-category="{{ $products->fldProductName }}" data-my-category2="{{ $products->fldProductPrice }}" >
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
                        <div class="sub-title roboto light-grey uk-margin-small-bottom">{{ $products->fldProductSubTitle }}</div>
                        <div class="price">From @if($products->fldProductOldPrice != '')<span class="uk-text-line-through">${{ number_format($products->fldProductOldPrice,2)}}</span>@endif <span class="bold">${{ number_format($products->fldProductPrice,2)}}</span></div></figcaption>
                              <a class="uk-position-cover"  href="#modal_{!!$products->fldProductID!!}" data-uk-modal=''></a>
                         <? /*<button class="add-to-cart"  onClick="addtoCart({!!$nctr!!})" ><i class="uk-icon-shopping-cart">&nbsp;</i><span class="uk-hidden">Add {!!$products->fldProductName!!} To Cart</span></button>*/ ?>
                              
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
      
       <div class="uk-width-1-1 uk-margin-medium-bottom uk-margin-medium-top">
            
             <ul class="uk-pagination">
             @for($i=1;$i<=$product->lastPage();$i++)
                @if($i==$product->currentPage()) 
                    <li class='uk-active'><span>{{ $i }}</span></li>
                @else 
                  <li><a href="{{ $slug != "" ? url('/image-galleries/'.$slug.'?page='.$i) : url('/image-galleries?page='.$i) }}">{{ $i }}</a></li>
                @endif  
             @endfor
             </ul>

          
      </div>  
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

@if (count($product) > 0)  

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