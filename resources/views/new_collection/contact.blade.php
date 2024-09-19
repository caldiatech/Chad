@extends('new_collection.layouts.app')

@section('content')
        <div class="main-part">
            <section class="banner-part" style="background: url('{{ asset('_new_collection/assets/images/banner1.png') }}') no-repeat center center; background-size:cover;">
                <div class="container">
                    <div class="banner-inner">
                        <h2>Connect</h2>
                    </div>
                </div>
            </section>
            <section class="contact-part">
                <div class="container">
                    <div class="contact-inner">
                        <div class="main-title">
                            <h2>Contact us using the form below.</h2>
                        </div>
                        <div class="contact-box-wrap">
                            <div class="contact-box-top">
                                <div class="row">
                                    <div class="col-md-5 col-sm-12 col-xs-12">
                                        <div class="contact-box-left">
                                            <img src="{{ asset('_new_collection/assets/images/map.png') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <div class="contact-box-right">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-field">
                                                        <input type="text" name="txt" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-field">
                                                        <input type="text" name="txt" placeholder="Last Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-field">
                                                        <input type="text" name="txt" placeholder="Company">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-field">
                                                        <input type="email" name="email" placeholder="Email Address">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-field">
                                                        <input type="tel" name="tel" placeholder="Phone Number">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-field">
                                                        <textarea placeholder="Write Message"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-field">
                                                        <button class="theme-btn">Add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="contact-box-bottom">
                                <div class="contact-box-row">
                                    <div class="contact-box-icon">
                                        <img src="{{ asset('_new_collection/assets/images/phone.png') }}" alt="">
                                    </div>
                                    <div class="contact-box-info">
                                        <a href="#">
                                            <strong>Phone</strong>
                                            <span>+61 235 668746</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="contact-box-row">
                                    <div class="contact-box-icon">
                                        <img src="{{ asset('_new_collection/assets/images/mail.png') }}" alt="">
                                    </div>
                                    <div class="contact-box-info">
                                        <a href="#">
                                            <strong>E-MAIL</strong>
                                            <span>info@company.com</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="contact-box-row">
                                    <div class="contact-box-icon">
                                        <img src="{{ asset('_new_collection/assets/images/mail.png') }}" alt="">
                                    </div>
                                    <div class="contact-box-info">
                                        <a href="#">
                                            <strong>HELPDESK</strong>
                                            <span>https://helpdesk.com</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection