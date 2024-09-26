@extends('layouts._front.new_collection.layouts.app')
    
@section('content')
        <div class="main-part">
            <section class="banner-part" style="background: url('{{ url(PAGES_IMAGE_PATH.$pages->fldPagesImage)}}') no-repeat center center; background-size:cover;">
                <div class="container">
                    <div class="banner-inner">
                        <h2 class="text-uppercase">{!! $pages->fldPagesTitle == "" ? $pages->fldPagesName : $pages->fldPagesTitle !!}</h2>
                        @if($pages->fldPagesSubTitle != '')<h2 class="sub-title">{!! $pages->fldPagesSubTitle !!}</h2>@endif                       
                        {{-- <h2>{!! $slug == "" ? $pages->fldPagesTitle == "" ? $pages->fldPagesName : $pages->fldPagesTitle : $category_details->fldCategoryName !!}</h2> --}}
                    </div>
                </div>
            </section>
            <section class="about-part">
                <div class="container">
                    <div class="about-inner">
                       {!! $pages->fldPagesDescription !!}
                    </div>
                </div>
            </section>
        </div>
@endsection