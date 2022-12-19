<!doctype Html>
<!--[if lte IE 8]><Html class="msie no-js no-svg" lang="en"><![endif]-->
<!--[if gte IE 9]><!-->
<Html class="no-js no-svg" lang="en">
<!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> {{ $pages->fldPagesMetaTitle != "" ? $pages->fldPagesMetaTitle : $settings->fldAdministratorSiteName }} </title>
  @if($pages->fldPagesMetaKeywords != "")
  <meta name="keywords" content="{{ $pages->fldPagesMetaKeywords }}"> @endif @if($pages->fldPagesMetaDescription != "")
  <meta name="description" content="{{ $pages->fldPagesMetaDescription }}"> @endif
  <meta name="description" content="...">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
  <link href="{!! asset('_front/assets/icons/Icon.png') !!}" rel="apple-touch-icon">
  <link href="{!! asset('_front/assets/icons/favicon.png') !!}" type="image/png" rel="shortcut icon">

  {!! Html::style('_front/assets/css/bootstrap.min.css') !!}
  {!! Html::style('_front/plugins/uikit/css/uikit.min.css') !!}
  {!! Html::style('_front/assets/css/core.css')!!}
  {!! Html::script('_front/assets/js/jquery-1.9.1.min.js') !!}
  {!! HTML::script('_front/plugins/uikit/js/uikit.min.js')!!}

  @section('headercodes') @show
  <? /*
 {{ $google->google_analytics != "" ? $google->google_analytics : "" }}
 {{ $google->google_conversion != "" ? $google->google_conversion : "" }}
  */
 ?>

</head>

<body>
  <div id="container">
    <!-- HEADER START-->
    <div class="wrap header">
      @include("layouts._front.header")
    </div>
    <!-- HEADER END-->

    <!-- SLIDE PANEL START-->
    <!-- ACCORDION -->
    <div class="home-slide uk-panel full-width">
      @php $slide_ctr = 1; $slide_acc_ctr = 0; $slide_item_ctr = 0; $slide_item_array = array(); $slider_accordion = array();
      $slider_accordion_string = $first_three_class= $slideshow_bullet = ''; $homeslide_href = ''; $homeslide_textlink =
      ''; @endphp

      @foreach($homeslide as $homeslides)
      <?php $slider_accordion_string .=
                '<div class="slide-'.$slide_ctr.' uk-text-left slide-acc-item " style="background-image:url('.url(HOME_SLIDE_IMAGE_PATH.LARGE_IMAGE.$homeslides->fldHomeSlideImage).')">
                      <div class="uk-overlay-panel  uk-overlay-center">
                        <h3 '.($pageEditable == true ? "class='editable' id='title'" : "").'> '.strip_tags($homeslides->fldHomeSlideName).'</h3>'.
                        '<div class=" full-width '.($pageEditable == true ? "editable" : "").' slide-desc text-uppercase" id="description">
                        <div class="home-slide-link full-width uk-margin-large-top">';
                        if($homeslides->fldHomeSlideLinks != '' && $homeslides->fldHomeSlideLinkText != ''){
                          $homeslide_href = $homeslides->fldHomeSlideLinks;
                          $homeslide_textlink = $homeslides->fldHomeSlideLinkText;
                        }else{
                          $homeslide_href = url('the-work');
                          $homeslide_textlink = 'EXPLORE <span class="black">CLARKIN COLLECTIONS</span>';
                        }
                         $slider_accordion_string .= '<a href="'.$homeslide_href.'">'.$homeslide_textlink.'</a>';
                         $slider_accordion_string .= '</div>
                         </div>'.

                    '</div>
                <a href="'.$homeslide_href.'" class="absolute_href"></a>
               </div>';
          $slide_ctr++;
          $slider_accordion[$slide_acc_ctr] = $slider_accordion_string; $slide_item_ctr++;
          $slide_item_array[$slide_acc_ctr]  = $slide_item_ctr;
          if($slide_ctr == 4){
            $slide_acc_ctr++; $slider_accordion_string = ''; $slide_ctr = 1;  $slide_item_ctr=0;
          }
          ?> @endforeach
      <?php  $slide_acc_ctr = 0; $slide_item_counter = 1;  ?>

      <!-- ADD ACCORDION ON SLIDER -->
      <div class="uk-slidenav-position onstart" id="homeslideshow" data-uk-slideshow="{animation: 'slice-down'}">
        <ul class="uk-slideshow">
          @foreach($slider_accordion as $slider_accordion_item)
          <li class="{{ $first_three_class }} item-count-{{ $slide_item_array[$slide_acc_ctr] }} slide-item-{{$slide_item_counter}}"
            data-itemno="{{$slide_item_counter}}" data-count="{{ $slide_item_array[$slide_acc_ctr] }}">
            <div class="uk-text-center">
              <section class="aw-accordion">
                {!! $slider_accordion_item !!}
              </section>
            </div>
          </li>
          <?php ?>
          {{-- */ $first_three_class= 'opacity-0'; $slide_item_counter++; $slideshow_bullet .= '
          <li data-uk-slideshow-item="'.$slide_acc_ctr.'">
            <a href="javascript:void(0)"></a>
          </li>'; $slide_acc_ctr++; /* --}}
          @endforeach
        </ul>
        <div class="uk-slideshow-bullet-wrapper uk-panel full-width uk-text-center" data-total-count="{{$slide_item_ctr}}">
          <div class="uk-container uk-container-center">
            <ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center">
              {!!$slideshow_bullet!!}
            </ul>
          </div>
        </div>

      </div>
      <!-- SLIDE PANEL END-->

    </div>
    <!-- home slide -->
    <!-- CONTENTS START-->
    <div class="wrap content">
      <article id="main" role="main">
        @yield('content')
      </article>
    </div>
  </div>
  <div class="push"></div>
  <!-- CONTENTS END-->

  </div>
  <!--#container -->
  <!-- FOOTER START-->
  <div class="wrap footer">
    @include("layouts._front.footer")
  </div>
  <!-- FOOTER END-->


  @section('extracodes') @show @include("layouts._front.nav-mobile")

</body>

</Html>
