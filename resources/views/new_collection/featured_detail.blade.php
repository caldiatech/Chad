@extends('new_collection.layouts.app')

@section('content') 
    <main>
        <div class="main-part">
            <section class="banner-part" style="background: url('{{ asset('_new_collection/assets/images/banner1.png') }}') no-repeat center center; background-size:cover;">
                <div class="container">
                    <div class="banner-inner">
                        <h2>Featured Detail</h2>
                    </div>
                </div>
            </section>
            <section class="bread-crumb-part">
                <div class="container">
                    <div class="bread-crumb-inner">
                        <ul>
                            <li><a href="#">Collection</a></li>
                            <li><a href="#">Rivers / Waterfalls</a></li>
                            <li class="active"><a href="#">Cascade</a></li>
                        </ul>
                    </div>
                </div>
            </section>
            <section class="feature-detail-part">
                <div class="container">
                    <div class="feature-detail-inner">
                        <div class="row">
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <div class="feature-detail-left parent-container">
                                    <div class="slider slider-for">
                                        <div class="item-slider-for">
                                            <a href="{{ asset('_new_collection/assets/images/slider4.png') }}"><img src="{{ asset('_new_collection/assets/images/slider4.png') }}" alt=""></a>
                                        </div>
                                        <div class="item-slider-for">
                                            <a href="{{ asset('_new_collection/assets/images/slider5.jpg') }}"><img src="{{ asset('_new_collection/assets/images/slider5.jpg') }}" alt=""></a>
                                        </div>
                                        <div class="item-slider-for">
                                            <a href="{{ asset('_new_collection/assets/images/slider6.jpg') }}"><img src="{{ asset('_new_collection/assets/images/slider6.jpg') }}" alt=""></a>
                                        </div>
                                        <div class="item-slider-for">
                                            <a href="{{ asset('_new_collection/assets/images/slider7.jpg') }}"><img src="{{ asset('_new_collection/assets/images/slider7.jpg') }}" alt=""></a>
                                        </div>
                                        <div class="item-slider-for">
                                            <a href="{{ asset('_new_collection/assets/images/slider4.png') }}"><img src="{{ asset('_new_collection/assets/images/slider4.png') }}" alt=""></a>
                                        </div>
                                        <div class="item-slider-for">
                                            <a href="{{ asset('_new_collection/assets/images/slider5.jpg') }}"><img src="{{ asset('_new_collection/assets/images/slider5.jpg') }}" alt=""></a>
                                        </div>
                                        <div class="item-slider-for">
                                            <a href="{{ asset('_new_collection/assets/images/slider6.jpg') }}"><img src="{{ asset('_new_collection/assets/images/slider6.jpg') }}" alt=""></a>
                                        </div>
                                        <div class="item-slider-for">
                                            <a href="{{ asset('_new_collection/assets/images/slider7.jpg') }}"><img src="{{ asset('_new_collection/assets/images/slider7.jpg') }}" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="slider slider-nav">
                                        <div class="item-slider-nav">
                                            <img src="{{ asset('_new_collection/assets/images/thumb1.png') }}" alt="">
                                        </div>
                                        <div class="item-slider-nav">
                                            <img src="{{ asset('_new_collection/assets/images/thumb2.png') }}" alt="">
                                        </div>
                                        <div class="item-slider-nav">
                                            <img src="{{ asset('_new_collection/assets/images/thumb3.png') }}" alt="">
                                        </div>
                                        <div class="item-slider-nav">
                                            <img src="{{ asset('_new_collection/assets/images/thumb4.png') }}" alt="">
                                        </div>
                                        <div class="item-slider-nav">
                                            <img src="{{ asset('_new_collection/assets/images/thumb1.png') }}" alt="">
                                        </div>
                                        <div class="item-slider-nav">
                                            <img src="{{ asset('_new_collection/assets/images/thumb2.png') }}" alt="">
                                        </div>
                                        <div class="item-slider-nav">
                                            <img src="{{ asset('_new_collection/assets/images/thumb3.png') }}" alt="">
                                        </div>
                                        <div class="item-slider-nav">
                                            <img src="{{ asset('_new_collection/assets/images/thumb4.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <div class="feature-detail-right">
                                    <div class="feature-detail-right-inner">
                                        <h2>Cascade</h2>
                                        <h4>YOUR TOTAL: <span>$1175.00</span></h4>
                                        <div class="add-btn-wrap">
                                            <input type="text" name="txt">
                                            <button class="theme-btn">Add to cart</button>
                                        </div>
                                        <div class="select-blog">
                                            <div class="select-blog-inline">
                                                <label class="lbl-rdo">Acrylic Prints
                                                  <input type="radio" name="radio1">
                                                  <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="select-blog-inline">
                                                <label class="lbl-rdo">Metallic Prints
                                                  <input type="radio" name="radio1">
                                                  <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <table>
                                            <thead>
                                                <th>Photo (only) Size (inches)</th>
                                                <th>Price:</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="lbl-rdo">10 x 30
                                                          <input type="radio" name="radio">
                                                          <span class="checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>$1175</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="lbl-rdo">30 x 90
                                                          <input type="radio" name="radio">
                                                          <span class="checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>$1475</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="lbl-rdo">60 x 20
                                                          <input type="radio" name="radio">
                                                          <span class="checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>$2175</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="lbl-rdo">40 x 16
                                                          <input type="radio" name="radio">
                                                          <span class="checkmark"></span>
                                                        </label>
                                                    </td>
                                                    <td>$2925</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection