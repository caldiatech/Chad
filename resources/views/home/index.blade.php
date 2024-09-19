<?php session_start(); ?>
@extends('layouts._front.new_collection.layouts.app')
    
@section('content')
        <div class="main-part">
			<section class="hero-part">
				<div class="owl-carousel owl-theme" data-items="1" data-tablet="1" data-large-mobile="1" data-mobile="1" data-nav="false" data-dots="true" data-autoplay="true" data-speed="1000" data-autotime="5000" data-margin="0" data-loop="true">
					@foreach($homeslide as $slide)
						<div class="item" style="background: url('{{ url(HOME_SLIDE_IMAGE_PATH.LARGE_IMAGE.$slide->fldHomeSlideImage) }}') no-repeat center center; background-size: cover;">
							<div class="item-inner">
								<div class="container">
									<div class="item-inner-info">
										<h2>{{ $slide->fldHomeSlideName }}</h2>
										@php
											if ($slide->fldHomeSlideLinks != '' && $slide->fldHomeSlideLinkText != '') {
												$homeslide_href = $slide->fldHomeSlideLinks;
												$homeslide_textlink = $slide->fldHomeSlideLinkText;
											} else {
												$homeslide_href = url('the-work');
												$homeslide_textlink = 'EXPLORE <span class="black">CLARKIN COLLECTIONS</span>';
											}
										@endphp
										<a href="{{ $homeslide_href }}" class="theme-btn">
											{!! $homeslide_textlink !!}
										</a>
									</div>
								</div>
							</div>
							<a href="{{ $homeslide_href }}" class="absolute_href" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></a>
						</div>
					@endforeach
				</div>
			</section>
			<section class="feature-part">
				<div class="container">
					<div class="feature-inner">
						<div class="main-title">
							<h2>{!!$pages->fldPagesSubTitle!!}</h2>
						</div>

						@php
							function check_numeric($said_number){
								$said_number_to_numeric = 0;
								if(is_numeric($said_number)){
									$said_number_to_numeric = $said_number;
								}else{
									$said_number_to_numeric = 0;
								}
								return $said_number_to_numeric;
							}

						@endphp
						@if(count($product) > 0)
							@foreach($product as $index => $products)
							@php
								$fldProductPrice = $products->fldProductPrice;
								$lowest_price = $highest_price = 0;
								$fldProductID = $products->fldProductID;
								if(isset($product_array_highest_prices[$fldProductID])){
									$highest_price = $product_array_highest_prices[$fldProductID];
								}
								if(isset($product_array_lowest_prices[$fldProductID])){
									$lowest_price = $product_array_lowest_prices[$fldProductID];
								}
								if(isset($product_array_prices[$fldProductID])){
									$fldProductPrice = $product_array_prices[$fldProductID];
								}
							@endphp

							<div class="feature-blog-row {{ $index % 2 == 1 ? 'feature-blog-switch' : '' }} product-type-{{$products->fldProductIsVertical}} product-id-{{$products->fldProductID}}">
								<div class="row">
									<div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
										<div class="feature-inner-left">
											<img src="{{ url(PRODUCT_IMAGE_PATH.$products->fldProductSlug.'/'.MEDIUM_IMAGE.$products->fldProductImage) }}" alt="{{ $products->fldProductName }}">										</div>
									</div>
									<div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
										<div class="feature-inner-right">
											<h6>
												@if( ($lowest_price > 0 && $highest_price > 0) && ($lowest_price != $highest_price))
													From ${{ number_format(check_numeric($lowest_price),2) }} to ${{ number_format(check_numeric($highest_price),2) }}
												@else
													${{ number_format(check_numeric($fldProductPrice),2) }}
												@endif
											</h6>
											<h3>{{ $products->fldProductName }}</h3>
											<p>{{ $products->fldProductSubTitle }}</p>
											<p>{{ $products->fldProductDescription }}</p>
											<a href="{{ url('products/details/'.$products->fldProductSlug) }}" class="theme-btn theme-btn-arrow">
												<span>EXPLORE COLLECTION</span>
												<img src="{{ asset('_new_collection/assets/images/arrow.png') }}" alt="arrow">
											</a>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						@endif

						<div class="feature-collection">
							<a href="{{ $pages->fldPagesButtonLinks }}" class="theme-btn">{{ $pages->fldPagesButton }}</a>
						</div>
					</div>
				</div>
			</section>

        </div>
@endsection
