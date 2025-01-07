@extends('layouts._front.new_collection.layouts.app')
    
@section('content')
        <div class="main-part">
            @if(empty($pages->fldPagesImage)) <?php $pages->fldPagesImage = 'about-us-header.jpg'; ?> @endif
            <section class="banner-part" style="background: url('uploads/pages/{{$pages->fldPagesImage}}') no-repeat center center; background-size:cover;">
                <div class="container">
                    <div class="banner-inner">                        
                        <h2 class="text-uppercase">{!! $pages->fldPagesTitle == "" ? $pages->fldPagesName : $pages->fldPagesTitle !!}</h2>
                        @if($pages->fldPagesSubTitle != '')<h2 class="sub-title">{!! $pages->fldPagesSubTitle !!}</h2>@endif                       
                    </div>
                </div>
            </section>
            <section class="about-part">
                <div class="container">
                    <div class="about-inner">
                        {!! $pages->fldPagesDescription !!}
                        <blockquote>
                            {!! $pages->fldPagesDescription2 !!}
                        </blockquote>
                        <div class="shipping-part">
                            <div class="shipping-logo">
                                <img src="{{ asset('_new_collection/assets/images/logo-blue.png') }}" alt="">
                            </div>
                            <table>
                                <thead>
                                    <th>Photo (only) Size (inches)</th>
                                    <th>Price:</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>55"</td>
                                        <td>No Charge</td>
                                    </tr>
                                    <tr>
                                        <td>55" - 70"</td>
                                        <td>$14.50</td>
                                    </tr>
                                    <tr>
                                        <td>71" - 90"</td>
                                        <td>$29.50</td>
                                    </tr>
                                    <tr>
                                        <td>90" - 120"</td>
                                        <td>$200.00</td>
                                    </tr>
                                    <tr>
                                        <td>> 120"</td>
                                        <td>$275.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection