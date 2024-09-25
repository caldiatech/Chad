@extends('layouts._front.new_collection.layouts.app')

@section('content')
<div class="main-part">
    <section class="banner-part" style="background: url('{{ url(PAGES_IMAGE_PATH.$pages->fldPagesImage)}}') no-repeat center center; background-size:cover;">
        <div class="container">
            <div class="banner-inner">
                <h2>{!! $pages->fldPagesTitle == "" ? $pages->fldPagesName : $pages->fldPagesTitle !!}</h2>
                @if($pages->fldPagesSubTitle != '')<h2 class="sub-title">{!! $pages->fldPagesSubTitle !!}</h2>@endif                       
            </div>
        </div>
    </section>
    <section class="contact-part">
        <div class="container">
            <div class="contact-inner">
                <div class="main-title">
                    <h2>{!! $pages->fldPagesDescription !!}</h2>
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
                                    {!! Form::open(array('url' => '/connect', 'method' => 'post',  'class' => '')); !!}
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-field">
                                                    <input type="text" id="firstname" name="firstname" class="" placeholder="First Name *" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-field">
                                                    <input type="text" id="lastname" name="lastname" class="" placeholder="Last Name *" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-field">
                                                    <input type="text" id="company" name="company" class="" placeholder="Company">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-field">
                                                    <input type="email" id="email" name="email" class="" placeholder="Email Address *" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-field">
                                                    <input type="text" id="phone" name="phone" class=" phone_us" placeholder="Phone Number">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-field">
                                                    <textarea id="message" name="message" class=" text" placeholder="Write Message"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-field">
                                                    <button type="submit" name="send" class="theme-btn">SEND</button>
                                                </div>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
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


@section('headercodes')
@stop

@section('extracodes')
<script type="text/javascript">
function loadScript(src, callback) {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = src;
    script.onload = callback;
    document.head.appendChild(script);
}

$(document).ready(function() {
    loadScript("{!! url('_front/assets/js/mask.js') !!}", function() {
        $('.phone_us').mask('(000) 000-0000');
    });
});
</script>
@stop