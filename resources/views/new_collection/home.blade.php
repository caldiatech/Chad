@extends('new_collection.layouts.app')
    
@section('content')
        <div class="main-part">
            <section class="hero-part">
                <div class="owl-carousel owl-theme" data-items="1" data-tablet="1" data-large-mobile="1" data-mobile="1" data-nav="false" data-dots="true" data-autoplay="true" data-speed="1000" data-autotime="5000" data-margin="0" data-loop="true">
                    <div class="item" style="background: url('{{ asset('_new_collection/assets/images/slide1.jpg') }}') no-repeat center center; background-size: cover;">
                        <div class="item-inner">
                            <div class="container">
                                <div class="item-inner-info">
                                    <h2>Seascapes</h2>
                                    <a href="#" class="theme-btn">EXPLORE CLARKIN COLLECTION</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item" style="background: url('{{ asset('_new_collection/assets/images/slide2.jpg') }}') no-repeat center center; background-size: cover;">
                        <div class="item-inner">
                            <div class="container">
                                <div class="item-inner-info">
                                    <h2>Rivers & Waterfalls</h2>
                                    <a href="#" class="theme-btn">EXPLORE CLARKIN COLLECTION</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item" style="background: url('{{ asset('_new_collection/assets/images/slide3.jpg') }}') no-repeat center center; background-size: cover;">
                        <div class="item-inner">
                            <div class="container">
                                <div class="item-inner-info">
                                    <h2>Lakes</h2>
                                    <a href="#" class="theme-btn">EXPLORE CLARKIN COLLECTION</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <section class="feature-part">
                <div class="container">
                    <div class="feature-inner">
                        <div class="main-title">
                            <h2>Featured Photos</h2>
                        </div>
                        <div class="feature-blog-row">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
                                    <div class="feature-inner-left">
                                        <img src="{{ asset('_new_collection/assets/images/img1.png ') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
                                    <div class="feature-inner-right">
                                        <h6>From $325.00 to $1,775.00</h6>
                                        <h3>Allure</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and  typesetting industry. Lorem Ipsum has been the industry's standard dummy  text ever since the 1500s, when an unknown printer took a galley of  type and scrambled it to make a type specimen book.</p>
                                        <p>It was popularised in the 1960s with the release of Letraset sheets  containing Lorem Ipsum passages, and more recently with desktop  publishing software like Aldus PageMaker including versions of Lorem  Ipsum. Lorem Ipsum is simply dummy text of the printing and  typesetting industry. Lorem Ipsum has been</p>
                                        <a href="#" class="theme-btn theme-btn-arrow"><span>EXPLORE COLLECTION</span><img src="{{ asset('_new_collection/assets/images/arrow.png ') }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="feature-blog-row feature-blog-switch">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
                                    <div class="feature-inner-left">
                                        <img src="{{ asset('_new_collection/assets/images/img2.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
                                    <div class="feature-inner-right">
                                        <h6>From $325.00 to $1,775.00</h6>
                                        <h3>Autumn Snow</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and  typesetting industry. Lorem Ipsum has been the industry's standard dummy  text ever since the 1500s, when an unknown printer took a galley of  type and scrambled it to make a type specimen book.</p>
                                        <p>It was popularised in the 1960s with the release of Letraset sheets  containing Lorem Ipsum passages, and more recently with desktop  publishing software like Aldus PageMaker including versions of Lorem  Ipsum. Lorem Ipsum is simply dummy text of the printing and  typesetting industry. Lorem Ipsum has been</p>
                                        <a href="#" class="theme-btn theme-btn-arrow"><span>EXPLORE COLLECTION</span><img src="{{ asset('_new_collection/assets/images/arrow.png') }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="feature-blog-row">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
                                    <div class="feature-inner-left">
                                        <img src="{{ asset('_new_collection/assets/images/img3.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
                                    <div class="feature-inner-right">
                                        <h6>From $325.00 to $1,775.00</h6>
                                        <h3>May Snow</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and  typesetting industry. Lorem Ipsum has been the industry's standard dummy  text ever since the 1500s, when an unknown printer took a galley of  type and scrambled it to make a type specimen book.</p>
                                        <p>It was popularised in the 1960s with the release of Letraset sheets  containing Lorem Ipsum passages, and more recently with desktop  publishing software like Aldus PageMaker including versions of Lorem  Ipsum. Lorem Ipsum is simply dummy text of the printing and  typesetting industry. Lorem Ipsum has been</p>
                                        <a href="#" class="theme-btn theme-btn-arrow"><span>EXPLORE COLLECTION</span><img src="{{ asset('_new_collection/assets/images/arrow.png') }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="feature-blog-row feature-blog-switch">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
                                    <div class="feature-inner-left">
                                        <img src="{{ asset('_new_collection/assets/images/img4.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
                                    <div class="feature-inner-right">
                                        <h6>From $325.00 to $1,775.00</h6>
                                        <h3>Sea Breeze</h3>
                                        <p>Lorem Ipsum is simply dummy text of the printing and  typesetting industry. Lorem Ipsum has been the industry's standard dummy  text ever since the 1500s, when an unknown printer took a galley of  type and scrambled it to make a type specimen book.</p>
                                        <p>It was popularised in the 1960s with the release of Letraset sheets  containing Lorem Ipsum passages, and more recently with desktop  publishing software like Aldus PageMaker including versions of Lorem  Ipsum. Lorem Ipsum is simply dummy text of the printing and  typesetting industry. Lorem Ipsum has been</p>
                                        <a href="#" class="theme-btn theme-btn-arrow"><span>EXPLORE COLLECTION</span><img src="{{ asset('_new_collection/assets/images/arrow.png') }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="feature-collection">
                            <a href="#" class="theme-btn">View Collections</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection