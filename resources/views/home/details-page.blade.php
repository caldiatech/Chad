<?php
 session_start();?>
@extends('layouts._front.home') 
@section('content')
<style>

    .product-detail{
        padding: 40px 0;
        color: #333333;
    }
    .product-detail .left .breadcrumbs{
        margin-bottom: 20px;
    }
    .product-detail .left .breadcrumbs ul{
        display: flex;
        padding: 0;
    }
    .product-detail .left .breadcrumbs ul li{
        list-style-type: none;
        position: relative;
    }
    .product-detail .left .breadcrumbs ul li::after{
        position: absolute;
        content: ">";
        right: 0;
        width: 20px;
        bottom: 0;
    }
    .product-detail .left .breadcrumbs ul li:last-child::after{
        display: none;
    }
    .product-detail .left .breadcrumbs ul li a{
        color: #333333;
        margin-right: 5px;  
        padding-right: 30px;      
    }

    .product-detail .left .images{
        border: solid 1px #eee;
        padding: 10px;  
        margin-bottom: 20px;  
        
    }
    .product-detail .left .images img{
        width: 100%;  
        padding: 0 30%;
    }
    .product-detail .left .images a.overlay{
        background-color: #e7e4df;
        display: block;
    }
    .product-detail .right .product-title{
        font-size: 30px;
    }
    .product-detail .right .product-price{
        margin-top: 10px;
    }
    .product-detail .right .product-price h2{
       font-weight: normal;
       font-size: 18px;
       border-bottom: solid 1px #e7e4df;
       padding-bottom: 10px;
       margin-bottom: 20px;
    }
    .product-detail .right .product-price ul{
       padding: 0;
       display: flex;
       flex-direction: column;
    }
    .product-detail .right .product-price ul li{
       list-style-type: none;
       margin-bottom: 5px;
       display: flex;
    }
    .product-detail .right .product-price ul li input[type="radio"]{
       margin-top: -5px;
    }
    .product-detail .right .product-price ul li label{
       font-weight: normal;
       margin-left: 5px;
       font-size: 15px;
    }
    .product-detail .right .product-button{
       margin-top: 20px;
    }
    .product-detail .right .product-button a.btn-primary{
        background-color: #333333;
        color: #fff;
        border: none;
        border-radius: 0;
        text-transform: uppercase;
        padding: 10px 30px;
        font-size: 15px;
    }
    .product-detail .right .product-button a.btn-primary:hover{
        background-color: #000;
    }
  </style>
 <div class="product-detail">
<div class="container">
    @if(Session::has('success'))
        <div class="uk-alert uk-alert-success">{!!Session::get('success')!!}</div>
    @endif
    @if(Session::has('error'))
        <div class="uk-alert uk-alert-danger">{!!Session::get('error')!!}</div>
    @endif
{!! Form::open(array('url' => '/add/cart', 'method' => 'post', 'class'=>'uk-form')); !!}

            <div class="col-md-5">
                <div class="left">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="#">Collection</a></li>
                            <li><a href="#">Canyons</a></li>
                            <li><a href="#">Ancestral</a></li>
                        </ul>
                    </div>
                    <div class="images">
                        <a href="#" class="overlay"><img src="{!! asset('storage/'. $productImage['orignal_image']) !!}"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            
            <div class="col-md-6">
                <div class="right">
                    <div class="product-title">
                    {{$productImage['image_name']}}
                        <input type="hidden" value="Ancestral" name="print_name">
                        <input type="hidden" value="{{$productImage['Id']}}" name="product_id">
                    </div>
                    <?php
                    $walletAmount = 0;
                    if(Session::has('client_id')) {
                        $walletAmount = \App\Models\userWallet::where('user_id', Session::get('client_id'))->value('amount');
                    } else {
                        $walletAmount = 0;
                    }
                    ?>
                    @if(!empty($walletAmount))
                    <div class="product-button">
                        <input type="hidden" name="walletPurchase" value="1">
                    {!! Form::button('Buy',array('name'=>'buy','class'=>'btn btn-primary','type' => 'submit'))!!} 
                    </div>
                    @else
                    <div class="product-price">
                        <h2>Price</h2>
                        <ul>
                            <li><input type="radio" value="8" name="image_price"> <label>1 Credit for $ 8</label></li>
                            <li><input type="radio" value="14" name="image_price"> <label>2 Credit for $ 14 And Save $2</label></li>
                            <li><input type="radio" value="20" name="image_price"> <label>3 Credit for $ 20 And Save $4</label></li>
                            <li><input type="radio" value="38" name="image_price"> <label>6 Credit for $ 38 And Save $10</label></li>
                            <li><input type="radio" value="70" name="image_price"> <label>12 Credit for $ 70 And Save $26</label></li>
                        </ul>
                    </div>
                    <div class="product-button">
                    {!! Form::button('Add to Cart',array('name'=>'addtoCart','class'=>'btn btn-primary','type' => 'submit'))!!} 
                    </div>
                    @endif
                </div>
            </div>
            {!! Form::close() !!}

        </div>
</div>
@stop
@section('headercodes')

 {!! Html::script('_front/assets/js/cart.js') !!}
@stop
