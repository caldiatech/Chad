@extends('new_collection.layouts.app')
    
@section('content')
        <div class="main-part">
            <section class="banner-part" style="background: url('{{ asset('_new_collection/assets/images/banner1.png') }}') no-repeat center center; background-size:cover;">
                <div class="container">
                    <div class="banner-inner">
                        <h2>Shipping</h2>
                    </div>
                </div>
            </section>
            <section class="about-part">
                <div class="container">
                    <div class="about-inner">
                        <p>Committed to a WOW experience, we're proud to fulfill orders with the  fastest turn-around time in our industry. The vast majority of orders  are processed, produced and shipped within 2-3 business days!</p>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum  dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <blockquote>
                            <h4>I'm Ordering Something Large, Will There be Oversized Carrier Charges?</h4>
                            <p>For frames over 55" combined outside dimensions, an Oversized Carrier Charge is added. This reflects our shippers' surcharges for such large packages, as well as the additional packaging materials required to ensure that your oversized frame arrives just as beautiful as the day it left our workshop.</p>
                            <p>Please note that outside dimensions are different from frame size. Your frame's outside dimensions will be larger, taking into account the width of the moulding.</p>
                            <p><strong>Outside dimensions = Width + Height + (4x moulding width)</strong></p>
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