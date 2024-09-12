@extends('layouts._front.new_collection.layouts.app')
    
@section('content')
        <div class="main-part">
            <section class="banner-part" style="background: url('{{ url(PAGES_IMAGE_PATH.$pages->fldPagesImage)}}') no-repeat center center; background-size:cover;">
                <div class="container">
                    <div class="banner-inner">
                        <h2>{!! $slug == "" ? $pages->fldPagesTitle == "" ? $pages->fldPagesName : $pages->fldPagesTitle : $category_details->fldCategoryName !!}</h2>
                    </div>
                </div>
            </section>
            <section class="feature-list-part">
                <div class="container">
                    <div class="feature-list-inner">
                        @php $nctr = 0; $products_modal_array = array(); $product_category_array = array();  $category_array = array(); $products_modal_string ='' ; @endphp
                        {!! Form::open(array('url' => '/collection', 'method' => 'post', 'id' => 'pageform', 'class' => 'row-fluid bill-info')) !!}
                            <div class="feature-list-search">
                                <div class="feature-list-search-left">
                                    <!-- Categories Dropdown -->
                                    <select id="category-select" onchange="window.location.href=this.value;">
                                        <option data-uk-sort="my-category" value="{{ url('collection') }}">Category</option>
                                        @foreach($category as $category_item)
                                            <option value="{{ url('collection/'.$category_item->fldCategorySlug) }}" data-uk-filter="{{$category_item->fldCategorySlug}}">
                                                {{ $category_item->fldCategoryName }}
                                            </option>
                                        @endforeach
                                    </select>

                                   <!-- Alphabetical Dropdown -->
                                    {{--<select id="sort-select" onchange="window.location.href=this.value;">
                                        <option value="{{ url('collection') }}" {{ empty($slug) || $slug != 'za' ? 'selected' : '' }}>Product Name (A-Z)</option>
                                        <option value="{{ url('collection/za') }}" {{ $slug == 'za' ? 'selected' : '' }}>Product Name (Z-A)</option>
                                    </select>--}}

                                    <!-- Alphabetical Dropdown -->
                                    <select id="sort-select" data-uk-dropdown>
                                        <option value="">Alphabetical</option>
                                        <?php if (empty($slug) || $slug=='za') { ?>
                                            <option onclick="azOrder();">Product Name (A-Z)</option>
                                            <option onclick="zaOrder();">Product Name (Z-A)</option>
                                        <?php } else { ?>
                                            <option data-uk-sort="my-category">Product Name (A-Z)</option>
                                            <option data-uk-sort="my-category:desc">Product Name (Z-A)</option>
                                        <?php } ?>
                                    </select>

                                </div>
                                <div class="feature-list-search-right">
                                    <!-- <input type="search" name="search" placeholder="Search by name"> -->
                                    {!! Form::text('search', '', ['id' => 'search', 'required', 'placeholder' => 'Search By Name']) !!}
                                    <button class="input-go" type="submit" name="find"><i class="ion-ios-search ion"></i></button>
                                    {{--{!! Form::text('search', "", array('id' => 'search', 'required', 'placeholder' => 'Search By Name')) !!}
                                    <button class="input-go" type="submit" name="find">
                                        <i class="ion-ios-search ion"></i>
                                    </button>--}}
                                </div>
                            </div>
                        {!! Form::close() !!}
                        <div class="feature-list-show">
                            <div class="row">
                                @if (count($product) > 0)
                                    @foreach($product as $products)
                                        <?php
                                            $fldProductPrice = $products->fldProductPrice;
                                            $lowest_price = $highest_price = 0;
                                            $fldProductID = $products->fldProductID;

                                            if(isset($product_array_highest_prices[$fldProductID])){
                                                $highest_price = $product_array_highest_prices[$fldProductID];
                                            }
                                            if(isset($product_array_lowest_prices[$fldProductID])){
                                                $lowest_price = $product_array_lowest_prices[$fldProductID];
                                            }
                                            if($lowest_price > 0 && $highest_price > 0){
                                                // Price range logic
                                            } else if(isset($product_array_prices[$fldProductID])){
                                                $lowest_price = $product_array_prices[$fldProductID];
                                                $highest_price = 0;
                                            }

                                            $product_image_slug = url('uploads/photos/16/447x397-sample-2.jpg');
                                            $image_folder_name = 'medium'; // Default value
                                            if ($products->fldProductIsVertical == 1) {
                                                $image_folder_name = 'medium'; // Vertical image setting
                                            }
                                            if ($products->fldProductImage != "" && File::exists(PRODUCT_IMAGE_PATH . $products->fldProductSlug . '/' . $image_folder_name . '/' . $products->fldProductImage)) {
                                                $product_image_slug = url(PRODUCT_IMAGE_PATH . $products->fldProductSlug . '/' . $image_folder_name . '/' . $products->fldProductImage);
                                            }
                                        ?>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <a href="{{ url('product/' . $products->fldProductSlug) }}" class="float-anchor"></a>
                                            <div class="feature-list-blog">
                                                <div class="feature-list-blog-bg" style="background:url('{{ $product_image_slug }}') no-repeat center center;" data-my-category="{{ $products->fldProductName }}" data-my-category2="{{ $lowest_price }}" data-uk-filter="{{ $products->fldCategorySlug }}"></div>
                                                <div class="feature-list-blog-title">
                                                    <h6>{{ $products->fldProductName }}</h6>
                                                    <p>
                                                        @if ($lowest_price > 0)
                                                            @if ($highest_price > 0 && $highest_price != $lowest_price)
                                                                From ${{ number_format($lowest_price, 2) }} to ${{ number_format($highest_price, 2) }}
                                                            @else
                                                                ${{ number_format($lowest_price, 2) }}
                                                            @endif
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-danger uk-text-center fsize-30 bold uk-margin-large-top uk-margin-large-bottom full-width">No Products Found</div>
                                @endif                              
                            </div>
                        </div>
                        <div class="pagination-wrap">
                            <ul>
                                <!-- Previous Button -->
                                @if($product->total() > 1)
                                    @if($product->currentPage() > 1)
                                        <li class="pagination-prev"><a href="{{ $slug != '' ? url('/featured-images/'.$slug.'?page=' . ($product->currentPage() - 1)) : url('/featured-images?page=' . ($product->currentPage() - 1)) }}"> <i class="uk-icon uk-icon-chevron-left pe-7s-angle-left"></i></a></li>
                                    @else
                                        <li class="pagination-prev disabled"><a href="#"><i class="uk-icon uk-icon-chevron-left pe-7s-angle-left"></i></a></li>
                                    @endif
                                @endif

                                <!-- Pagination Links -->
                                @php
                                    $startPage = max(1, $product->currentPage() - 2);
                                    $endPage = min($product->lastPage(), $product->currentPage() + 2);
                                @endphp

                                @for($i = $startPage; $i <= $endPage; $i++)
                                    @if($i == $product->currentPage())
                                        <li class="active"><span>{{ $i }}</span></li>
                                    @else
                                        <li><a href="{{ $slug != '' ? url('/featured-images/'.$slug.'?page=' . $i) : url('/featured-images?page=' . $i) }}">{{ $i }}</a></li>
                                    @endif
                                @endfor

                                @if($product->lastPage() > 5 && $endPage < $product->lastPage())
                                    <li><span>.....</span></li>
                                @endif

                                <!-- Next Button -->
                                @if($product->total() > 1)
                                    @if($product->currentPage() < $product->lastPage())
                                        <li class="pagination-next"><a href="{{ $slug != '' ? url('/featured-images/'.$slug.'?page=' . ($product->currentPage() + 1)) : url('/featured-images?page=' . ($product->currentPage() + 1)) }}"> <i class="uk-icon uk-icon-chevron-right pe-7s-angle-right"></i></a></li>
                                    @else
                                        <li class="pagination-next disabled"><a href="#"><i class="uk-icon uk-icon-chevron-right pe-7s-angle-right"></i></a></li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script>
            function zaOrder() {
                window.location.href = "{{ url('collection/za') }}";
            }
            function azOrder() {
                // window.location.replace("https://clarkincollection.com/collection");
                window.location.href = "{{ url('collection') }}";
            }
        </script>
@endsection