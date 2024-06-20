<nav class="uk-navbar  uk-float-right">
    <ul class="uk-navbar-nav uk-hidden-small">
       @section('menunav')

        <li class='featured-images @if(isset($pages->fldPagesTitle) && ($pages->fldPagesTitle == "Featured Images")) uk-active @endif'>
            <a href="{{ url('featured-images') }}" >Featured Images</a>
        </li>
        <!-- <li class='featured-images @if(isset($pages->fldPagesTitle) && ($pages->fldPagesTitle == "Plans")) uk-active @endif'> <a href="{{ url('unedited-digital-files') }}">Unedited Digital Files</a></li> -->
        <!-- <li> <a href="{{ url('in-home') }}">In-Home</a></li> -->
          <?php $mctr=0; ?>
        @foreach(App\Models\Pages::displayMenu() as $menus)
            <?php $mctr=$mctr+1;?>
            @if(isset($menus['subpage']))
                <li data-uk-dropdown="" class="uk-parent dropdown" aria-haspopup="true" aria-expanded="false">a<a href="{{ URL::asset($menus['isCMS'] == 1 ? url("/".$menus['slug']) : $menus['filename'],$menus['pagename']) }}" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">{{ $menus['pagename'] }} <i class="uk-icon-angle-down white"></i> </a>
                    <div class="uk-dropdown uk-dropdown-navbar uk-dropdown-bottom" style="top: 40px; left: 0px;">
                    <ul class="uk-nav uk-nav-navbar">
                        @foreach($menus['subpage'] as $submenu)
                            @if(isset($submenu['thirdpage']) )
                                <li>b{!! Html::link($submenu['isCMS'] == 1 ? "/".$submenu['slug'] : $submenu['filename'],$submenu['pagename'],array('class'=>'dropdown-toggle', 'data-toggle'=>'dropdown')) !!}
                                </li>
                            @else
                                <li>c{!! Html::link($submenu['isCMS'] == 1 ? "/".$submenu['slug'] : $submenu['filename'],$submenu['pagename']) !!}</li>
                            @endif
                        @endforeach
                       
                    </ul>
                </div>

                </li>

            @else
                <!-- <li class="uk-active"> -->
                <li class='{{$menus["slug"]}} uk-{{ $mctr > 7 ? "hidden-medium" : "" }} @if(isset($pages->fldPagesSlug) && ($menus['slug'] == $pages->fldPagesSlug)) uk-active @endif'>
                    <a href="{{ URL::asset($menus['slug']) }}" >{{ $menus['pagename'] }}</a>
                </li>
            @endif
        @endforeach
         @stop
         @section('menunav')
         @show
    </ul>
    <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small white" data-uk-offcanvas></a>
</nav>
