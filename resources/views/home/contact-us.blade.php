@extends('layouts._front.pages')

@section('content')


        <div class="uk-width-1-1 uk-margin-large  uk-margin-large-top">
             <div class="uk-container uk-container-center uk-margin-medium-bottom">
                <article id="main" role="main">
                    <div class="uk-grid">
                        <!--<div class="uk-width-medium-6-10 uk-width-1-1">-->
                        <div class="contact-form uk-width-1-1">
                            {!! $pages->fldPagesDescription !!}

                            <? /* <h2 class="uk-h2 text-uppercase">We'd like to hear from you!</h2>
                            <p>Contact us using the form below.</p> */ ?>

                        <? /* {!! Form::open(array('url' => '/contact-us', 'method' => 'post',  'class' => 'row-fluid input-100 bill-info')); !!} */ ?>
                        {!! Form::open(array('url' => '/connect', 'method' => 'post',  'class' => 'row-fluid input-100 bill-info')); !!}
                        {{-- @if(isset($error))
                            <div class="alert alert-danger"> {!! $error !!}</div>
                        @endif --}}
                            <div class="uk-grid">
                                <div class = "uk-width-large-1-2  uk-width-small-1-2 uk-margin-top">
                                    {!! Form::label('firstname', '* First Name',array( )); !!}
                                    {!! Form::text('firstname',"",array('id'=>'firstname','required','class'=>'form-control')) !!}
                                    {{-- @if ($errors->has('firstname'))
                                        <div id="" style="" class="uk-alert uk-alert-danger uk-alert-error"> {!! $errors->first('firstname') !!} </div>
                                    @endif --}}

                                </div >
                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                    {!! Form::label('lastname', '* Last Name',array( )); !!}
                                    {!! Form::text('lastname',"",array('id'=>'lastname','required','class'=>'form-control')) !!}
                                    {{-- @if ($errors->has('lastname'))
                                        <div id="" style="" class="uk-alert uk-alert-danger uk-alert-error"> {!! $errors->first('lastname') !!} </div>
                                    @endif --}}
                                </div >
                                <div class = "uk-width-1-1 uk-margin-top">
                                    {!! Form::label('company', 'Company',array()); !!}
                                    {!! Form::text('company',"",array('id'=>'company','class'=>'form-control')) !!}
                                </div >
                                <div class = "uk-width-large-1-2 uk-width-small-1-2 uk-margin-top">
                                    {!! Form::label('email', '* Email Address',array( )); !!}
                                    {!! Form::email('email',"",array('id'=>'email','required','class'=>'form-control')) !!}
                                    {{-- @if ($errors->has('email'))
                                        <div id="" style="" class="uk-alert uk-alert-danger uk-alert-error"> {!! $errors->first('email') !!} </div>
                                    @endif --}}
                                </div >

                                <div class = "uk-width-large-1-2 uk-width-small-1-2  uk-margin-top" >
                                    {!! Form::label('phone', 'Phone Number',array( )); !!}
                                    {!! Form::text('phone',"",array('id'=>'phone','class'=>'form-control phone_us')) !!}
                                    {{-- @if ($errors->has('phone'))
                                        <div id="" style="" class="uk-alert uk-alert-danger uk-alert-error"> {!! $errors->first('phone') !!} </div>
                                    @endif --}}
                                </div >

                                <div class = "uk-width-1-1  uk-margin-top" >
                                    {!! Form::label('message', 'Message',array( )); !!}
                                    {!! Form::textarea('message',"",array('id'=>'message','class'=>'form-control text')) !!}
                                </div >

                                <div class = "uk-width-1-1 uk-margin-large-top">
                                 {!! Form::submit('Send',array('name'=>'send','class'=>'uk-button uk-button-primary uk-max-width'))!!}
                                </div>
                            </div><!--row -->
                        {!! Form::close() !!}
                    </div>
                   <!-- <div class="uk-width-medium-4-10 uk-width-1-1 uk-margin-top">
                        <h2 class="uk-h2 text-uppercase">Company Information</h2>
                        <p>Check our contact details</p>

                        <div style="border: 1px solid #e4e4e4; padding: 20px 20px 40px">

                            <div class="uk-vertical-align uk-panel uk-panel-box" style="height: 50px;">
                                <div class="uk-vertical-align-middle uk-width-medium-1-1">
                                    <p style="margin-bottom: 0; padding-bottom: 0">
                                        <a href="tel:369-852-147" class="icon-box">
                                            <i class="uk-icon-phone uk-icon-justify uk-margin-right"></i>
                                            <span class="icon-box-text">369-852-147</span>
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <div class="uk-vertical-align uk-panel uk-panel-box" style="height: 50px;">
                                <div class="uk-vertical-align-middle uk-width-medium-1-1">
                                    <p style="margin-bottom: 0; padding-bottom: 0">
                                        <a href="mailto:support@clarkin-collections.com" class="icon-box">
                                            <i class="uk-icon-envelope uk-icon-justify uk-margin-right"></i>
                                        <span class="icon-box-text">support@clarkin-collections.com</span>
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <div class="uk-vertical-align uk-panel uk-panel-box" style="height: 50px;">
                                <div class="uk-vertical-align-middle uk-width-medium-1-1">
                                    <p style="margin-bottom: 0; padding-bottom: 0">
                                        <a href="https://www.google.com/maps?ll=32.892612,-117.194755&z=18&t=m&hl=en-GB&gl=PH&mapclient=embed&cid=10114221298398407697" target="_blank" class="icon-box">
                                         <i class="uk-icon-map-marker uk-icon-justify uk-margin-right"></i>
                                         <span class="icon-box-text">Oberlin Drive, San Diego Califonia, USA 92021</span>
                                        </a>
                                    </p>
                                </div>
                            </div>

                        </div>


                            <div class="box-bordered padding-medium ">
                                <h4>Company Information</h4>
                                <i class="uk-icon-phone green uk-icon-justify"></i> <span class="uk-margin-small-left">369-852-1478</span><br/>
                                <i class="uk-icon-envelope green uk-icon-justify"></i> <span class="uk-margin-small-left">support@clarkin-collections.com</span><br/>
                                <i class="uk-icon-map-marker green uk-icon-justify"></i> <span class="uk-margin-small-left">Oberlin Drive, San Diego Califonia,</span><br/>
                                <i class="uk-icon-map-marker opacity-0 uk-icon-justify"></i> <span class="uk-margin-small-left">USA 92021</span><br/>

                                {!! $pages->description !!}

                            </div>
-->
                    <!-- </div> 4-10 -->
                </div><!--row -->
            </div>
            </div>


            <!--<div class="google-maps uk-margin-top" style="padding-bottom: 350px">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d837.5395621517777!2d-117.19375913493856!3d32.893984026270765!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8c5ceeaef6ba2c11!2sDog+and+Rooster%2C+Inc!5e0!3m2!1sen!2sph!4v1413163396392" width="555" height="350" frameborder="0" style="border:0; margin:0; height: 350px"></iframe>
           </div>google-maps -->

@stop

@section('headercodes')
@stop

@section('extracodes')
<script type="text/javascript">
$(document).ready(function() {
    loadScript("{!!url('_front/assets/js/mask.js')!!}", function(){
        $('.phone_us').mask('(000) 000-0000');
    });
});
</script>
@stop