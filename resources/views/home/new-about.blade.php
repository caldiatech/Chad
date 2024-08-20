@extends('layouts._front.new-pages')
    
@section('content')
        <div class="main-part">
            <section class="banner-part" style="background: url('{{ asset('_new_collection/assets/images/banner1.png') }}') no-repeat center center; background-size:cover;">
                <div class="container">
                    <div class="banner-inner">
                        <h2>About</h2>
                    </div>
                </div>
            </section>
            <section class="about-part">
                <div class="container">
                    <div class="about-inner">
                        <div class="about-inner-row">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
                                    <div class="about-inner-left">
                                        <img src="{{ asset('_new_collection/assets/images/img5.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 align-self-center">
                                    <div class="about-inner-right">
                                        <img src="{{ asset('_new_collection/assets/images/logo-blue.png') }}" alt="">
                                        <p>Welcome to The Clarkin Collection and thank you for taking a look  through my last eight years of exploration and landscape photography.  The question is often asked, where the desire to get involved in  landscape photography emanated from. I can say it didn't, initially,  arise out of an ambition for photography itself, but rather a desire to  share and communicate my adventures through the spiritually evocative  scenes Mother Nature afforded me, along my photographic journeys.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! $pages->fldPagesDescription !!}
                    </div>
                </div>
            </section>
        </div>
@endsection