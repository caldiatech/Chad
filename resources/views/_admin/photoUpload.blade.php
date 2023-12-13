@extends('layouts._admin.base')

@section('content')
   {!! Form::open(array('url' => '/collection', 'method' => 'post', 'id' => 'pageform', 'class' => 'row-fluid bill-info')) !!}
	<div class="uk-container uk-container-center uk-margin-medium-bottom">
  <article id="main" role="main">
    <div class="uk-grid">
      <div class="uk-width-1-1 uk-margin-medium-bottom">
        <div class="uk-grid">
            <div class="uk-width-medium-6-10 filter-section uk-width-1-1 uk-width-medium-1-1 uk-margin-medium-top">
           <div class="uk-button-dropdown" data-uk-dropdown>
              <div class="uk-dropdown uk-dropdown-small">
                <ul id="products_category" class="uk-nav uk-nav-dropdown bg-dark filter-btn">
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </article>
</div><!--container -->
{!! Form::close() !!}

<div class="gallery-style-1">
  <div class="uk-grid oading-products"  id="products">
        <div class="uk-width-1-1 product-container uk-margin-medium-bottom uk-margin-medium-top horizontal-count-1">

    </div><!--row uk-grid-width-small-1-2 -->

       <div class="uk-width-1-1 uk-margin-large-bottom uk-margin-large-top">
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

</style>
	<script>
		var url = "{{ url('/') }}";
	</script>

@stop

@section('extracodes')
<div class="">
</div>
{!! HTML::script('_front/plugins/uikit/js/components/grid.min.js') !!}
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
@stop