<ul>
                                <li class='featured-images @if(isset($pages->fldPagesTitle) && ($pages->fldPagesTitle == "Featured Images")) active @endif'>
                                    <a href="{{ url('featured-images') }}">FEATURED IMAGES</a>
                                </li>
                                
                                <?php $mctr = 0; ?>
                                @foreach(App\Models\Pages::displayMenu() as $menus)
                                    <?php $mctr = $mctr + 1; ?>
                                    @if(isset($menus['subpage']))
                                        <li class="dropdown @if(isset($pages->fldPagesSlug) && ($menus['slug'] == $pages->fldPagesSlug)) active @endif">
                                            <a href="{{ URL::asset($menus['isCMS'] == 1 ? url("/".$menus['slug']) : $menus['filename'],$menus['pagename']) }}" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                                                {{ strtoupper($menus['pagename']) }}
                                                <i class="uk-icon-angle-down"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                @foreach($menus['subpage'] as $submenu)
                                                    @if(isset($submenu['thirdpage']))
                                                        <li>
                                                            {!! Html::link($submenu['isCMS'] == 1 ? "/".$submenu['slug'] : $submenu['filename'],$submenu['pagename'],['class'=>'dropdown-toggle', 'data-toggle'=>'dropdown']) !!}
                                                        </li>
                                                    @else
                                                        <li>
                                                            {!! Html::link($submenu['isCMS'] == 1 ? "/".$submenu['slug'] : $submenu['filename'],$submenu['pagename']) !!}
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li class='{{$menus["slug"]}} {{ $mctr > 7 ? "hidden" : "" }} @if(isset($pages->fldPagesSlug) && ($menus['slug'] == $pages->fldPagesSlug)) active @endif'>
                                            <a href="{{ URL::asset($menus['slug']) }}">{{ strtoupper($menus['pagename']) }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>