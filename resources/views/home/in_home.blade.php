<?php session_start(); ?>
@extends('layouts._front.home') @section('content')
<style type="text/css">
    .centerimg {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50% !important;
    }
</style>

 <section class="country-house">
        <div class="container">
                <div class="col-flex">
                    <div class="col-md-4">
                        <div class="left-text">
                            <h2>Country House</h2>
                            <p>Escape to the most captivating locations around the globe. 
                            Illuminate your interior with incredible imagery of the outside world.</p>
                            <a href="#">Shop Now</a>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-7">
                        <div class="right-images">
                            <a href="{!! asset('products/details/natures-canvas') !!}">
                                <img src="{!! asset('upload/products/natures-canvas/medium/divine-intervention-11-20-21.jpg') !!}" style="height: 400px;">
                            </a>
                        </div>
                    </div>
                </div>       
        </div>
    </section>
    <!-- <div class="carousel-slider"> 
        <div class="container-fluid">        
            <div id="myCarousel" class="carousel slide" data-ride="carousel"> -->
                <!-- Indicators -->           
                <!-- Wrapper for slides -->
                <!--  <div class="carousel-inner">
                    @foreach($productImage as $image)
                    <div class="item active">
                        <a href="{{ url('image/details/'.$image['id'])}}">
                            <img src="{!! asset('storage/'. $image['thumbnail_image']) !!}" style="width:100%;">
                        </a>
                        <h2><a href="#">{{$image['image_name']}}</a></h2>
                    </div>
                    @endforeach -->

                <!-- <div class="item">
                    <a href="{{ url('products/details/'.$productImage[0]['Id']) }}">
                        <img src="{!! asset('_front/assets/images/img-3.jpg') !!}" style="width:100%;">
                        <div class="overlay">
                            <img src="{!! asset('_front/assets/images/img-3_1.jpg') !!}">
                        </div>
                    </a>
                    <h2><a href="#">Autumn Jewel</a></h2>
                </div>
                
                <div class="item">
                    <a href="{{ url('products/details/'.$productImage[0]['Id'])}}">
                        <img src="{!! asset('_front/assets/images/img-2.jpg') !!}" style="width:100%;">
                        <div class="overlay">
                            <img src="{!! asset('_front/assets/images/img-1_1.png') !!}">
                        </div>
                    </a>
                    <h2><a href="#">Autumn Jewel</a></h2>
                </div> -->
                <!-- </div> -->
            
                <!-- Left and right controls -->
                <!-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="fa fa-chevron-left"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="fa fa-chevron-right"></span>
                <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div> -->
    <div class="two-column-home">
        <div class="container">
                <div class="col-md-10">
                    <div class="left">
                        <a href="{!! asset('products/details/banff-grandeur') !!}">
                            <img src="{!! asset('_front/assets/images/img-4.jpg') !!}">
                            <div class="overlay">
                                <!-- <img src="{!! asset('_front/assets/images/img-4_1.jpg') !!}"> -->
                                <img src="{!! asset('upload/products/banff-grandeur/medium/banff-grandeur-4-2.jpg') !!}">
                            </div>
                        </a>
                        <h2><a href="#">Tuscan Dreams, Limited Edition 200</a></h2>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="right">
                        <!-- <a href="#"><img src="{!! asset('_front/assets/images/img-4_right.jpg') !!}"></a> -->
                        <a href="{!! asset('products/details/ancestral') !!}"><img src="{!! asset('upload/products/ancestral/medium/ancestral-8-14.jpg') !!}"></a>
                        <h2><a href="{{ url('products/details/'.$productImage[0]['Id']">Harmony Lane</a></h2>
                    </div>
                </div>
        </div>
    </div>
    <div class="collection-block-combo">
        <div class="container">
                <div class="top-row">
                    <div class="col-md-4">
                        <h2>
                            Camargue the Romance of Wild Horses
                        </h2>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-7">
                            <div class="right-images">
                                <a href="#">
                                    <img src="{!! asset('_front/assets/images/img-5.jpg') !!}">
                                    <div class="overlay">
                                        <!-- <img src="{!! asset('_front/assets/images/img-5_1.jpg') !!}"> -->
                                        <a href="{!! asset('products/details/smathers') !!}"><img src="{!! asset('upload/products/smathers/medium/relax-5-3-554.jpg') !!}"></a>
                                    </div>
                                </a>
                                <h3><a href="#">Wanderlust</a></h3>
                            </div>
                    </div>
                </div>
                <div class="bottom-row">
                    <div class="col-md-3 padding-right">                        
                            <div class="left">                            
                                <!-- <a href="#"><img src="{!! asset('_front/assets/images/img-6.png') !!}"></a> -->
                                <a href="{!! asset('products/details/lunar-departure') !!}"><img src="{!! asset('upload/products/lunar-departure/medium/lunar-departure-11-22-21.jpg') !!}"></a>
                                    <div class="overlay">
                                        <h2><a href="#">Shop Now</a></h2>
                                    </div>                            
                            </div>
                        
                    </div>
                    <div class="col-md-4 padding-left">
                        <div class="center">
                            <!-- <img src="{!! asset('_front/assets/images/img-6_right.jpg') !!}"> -->
                            <a href="{!! asset('products/details/narrow-passage') !!}"><img src="{!! asset('upload/products/narrow-passage/medium/narrow-passage-4-17-21.jpg') !!}"></a>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="right">
                            <p>
                                Roaming Southern France for centuries, the raw power and sheer beauty of the Camargue
                                horses is captured in this emotive series. This is the Cheval Collection.
                            </p>
                        </div>
                    </div>
                </div>                
        </div>
    </div>
    <section class="collection-block-stacked">
            <div class="container">
                    <div class="top-row">
                        <div class="col-md-4">
                            <div class="left">
                                <h2>Open Editions</h2>
                                <p>Breathe life into any space with stunning images from the new Open Editon Collection. All LIK Fine Art Open Editions are signed and unnumbered.</p>
                                <a href="#">Shop Now</a>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-7">
                            <div class="right-images">
                                <a href="{!! asset('products/details/no-way-out') !!}">
                                    <img src="{!! asset('_front/assets/images/img-7.jpg') !!}">
                                    <div class="overlay">
                                        <!-- <img src="{!! asset('_front/assets/images/img-7_1.jpg') !!}"> -->
                                        <img src="{!! asset('upload/products/no-way-out/medium/no-way-out-6-19-web.jpg') !!}">
                                    </div>
                                </a>
                                <h3><a href="#">Open Editions - Starting at $1,895</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="bottom-row">
                            <img src="{!! asset('_front/assets/images/img-8.jpg') !!}">
                            <div class="overlay">
                                <!-- <img src="{!! asset('_front/assets/images/img-8_1.jpg') !!}"> -->
                                <a href="{!! asset('products/details/storm-bringer') !!}">
                                    <img class="centerimg" src="{!! asset('upload/products/storm-bringer/medium/storm-bringer-7-25-21.jpg') !!}">
                                </a>
                            </div>
                            <h2><a href="#">OE 0019</a></h2>
                        </div>
                    </div>
            </div>
    </section>
@stop @section('headercodes')

 {!! Html::script('_front/assets/js/cart.js') !!}
@stop @section('extracodes') {{-- */ /* */ /* --}}

@stop