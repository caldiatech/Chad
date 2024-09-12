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
                         {!! Form::open(array('route' => 'searchProduct', 'method' => 'post', 'id' => 'pageform', 'class' => 'row-fluid bill-info')) !!}
                            <div class="feature-list-search">
                                <div class="feature-list-search-left">
                                    {{--<ul id="products_category" class="uk-nav uk-nav-dropdown bg-dark filter-btn">

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

                                    </ul>--}}

                                    <select id="category-select" onchange="window.location.href=this.value;">
                                        <option data-uk-sort="my-category" value="{{ url('collection') }}">Category</option>
                                        @foreach($category as $category_item)
                                            <option value="{{ url('collection/'.$category_item->fldCategorySlug) }}" {{ $slug && $slug != '' && $slug == $category_item->fldCategorySlug ? 'selected' : '' }} data-uk-filter="{{$category_item->fldCategorySlug}}">
                                                {{ $category_item->fldCategoryName }}
                                            </option>
                                        @endforeach
                                    </select>

                                    {{--<ul id="sort-select" data-slug="{{ $slug }}">
                                        <?php if (empty($slug) || $slug=='za') { ?>
                                            <li class="uk-active"><a href="javascript:void(0)" onclick="azOrder();">Product Name (A-Z)</a></li>
                                            <li><a href="javascript:void(0)" onclick="zaOrder();">Product Name (Z-A)</a></li>
                                        <?php } else { ?>
                                            <li class="uk-active" data-uk-sort="my-category"><a onclick="azOrder('{{ $slug }}');" href="javascript:void(0)">Product Name (A-Z)</a></li>
                                            <li data-uk-sort="my-category:desc"><a onclick="zaOrder('{{ $slug }}');" href="javascript:void(0)">Product Name (Z-A)</a></li>
                                        <?php } ?>
                                    </ul>--}}

                                    <select id="sort-select" onchange="handleSortChange()">
                                        <option value="">Alphabetical</option>
                                        @if (empty($slug) || $slug == 'za')
                                            <option value="">Product Name (A-Z)</option>
                                            <option value="za">Product Name (Z-A)</option>
                                        @else
                                            <option value="" data-slug="{{ $slug }}">Product Name (A-Z)</option>
                                            <option value="za" data-slug="{{ $slug }}">Product Name (Z-A)</option>
                                        @endif
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
                                        <li class="pagination-prev"><a href="{{ $slug != '' ? url('/collection/'.$slug.'?page=' . ($product->currentPage() - 1)) : url('/collection?page=' . ($product->currentPage() - 1)) }}"> <i class="uk-icon uk-icon-chevron-left pe-7s-angle-left"></i></a></li>
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
                                        <li><a href="{{ $slug != '' ? url('/collection/'.$slug.'?page=' . $i) : url('/collection?page=' . $i) }}">{{ $i }}</a></li>
                                    @endif
                                @endfor

                                @if($product->lastPage() > 5 && $endPage < $product->lastPage())
                                    <li><span>.....</span></li>
                                @endif

                                <!-- Next Button -->
                                @if($product->total() > 1)
                                    @if($product->currentPage() < $product->lastPage())
                                        <li class="pagination-next"><a href="{{ $slug != '' ? url('/collection/'.$slug.'?page=' . ($product->currentPage() + 1)) : url('/collection?page=' . ($product->currentPage() + 1)) }}"> <i class="uk-icon uk-icon-chevron-right pe-7s-angle-right"></i></a></li>
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
        @if (count($product) > 0)
        <script>
            function zaOrder(slug = null) {
                const redirectUrl = (slug && slug !== '') ? `collection/${slug}?sort=za` : 'collection?sort=za';
                window.location.href = `{{ url('') }}/${redirectUrl}`;
            }

            function azOrder(slug = null) {
                const redirectUrl = (slug && slug !== '') ? `collection/${slug}` : 'collection';
                window.location.href = `{{ url('') }}/${redirectUrl}`;
            }

            function handleSortChange() {
                const selectElement = document.getElementById('sort-select');
                const selectedValue = selectElement.value;
                const selectedOption = selectElement.options[selectElement.selectedIndex];
                const slug = selectedOption.getAttribute('data-slug');

                let redirectUrl = 'collection';
                if (slug) {
                    redirectUrl += '/' + slug;
                }

                if (selectedValue) {
                    redirectUrl += '?sort=' + selectedValue;
                }

                window.location.href = `{{ url('') }}/${redirectUrl}`;
            }
        </script>

        @endif
@endsection