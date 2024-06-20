<li class="uk-icon-right @if( $pages->slug == '' || $pages->slug == 'index' ) uk-active @endif">
	<a href="{{url('dashboard/'.$pages->category)}}"><i class="uk-icon-bar-chart uk-icon-justify"></i> 
	<span class="menu-item-text">Dashboard</span></a> </li> 
<li class="uk-icon-right @if($pages->slug == 'edit-profile' || $pages->slug == 'profile') uk-active @endif">
	<a href="{{url('dashboard/'.$pages->category.'/profile')}}"><i class="uk-icon-user uk-icon-justify"></i> <span class="menu-item-text">Profile</span></a>  </li>
<li class="uk-icon-right @if($pages->slug == 'sales-activities') uk-active @endif">
	<a href="{{url('dashboard/'.$pages->category.'/sales-activities')}}"><i class="uk-icon-lock ion ion-ios-locked uk-icon-justify icon-stack-parent white "><i class="uk-icon-check-circle-o icon-small-append icon-bottom icon-right"></i></i> <span class="menu-item-text">Sales Activities</span></a>  </li>
<li class="uk-icon-right @if($pages->slug == 'order-history') uk-active @endif"><a href="{{url('dashboard/'.$pages->category.'/order-history')}}"><i class="uk-icon-usd uk-icon-button uk-icon-button-small uk-icon-justify"></i>  <span class="menu-item-text">Order History</span></a>  </a> </li>
<li class="uk-icon-right @if($pages->slug == 'accounts') uk-active @endif"><a href="{{url('dashboard/'.$pages->category.'/accounts')}}"><i class="uk-icon-lock ion ion-ios-locked-outline  uk-icon-justify"></i> <span class="menu-item-text">Accounts</span></a> </li>
<li class="uk-icon-right @if($pages->slug == 'coupon-codes') uk-active @endif"><a href="{{url('dashboard/'.$pages->category.'/coupon-codes')}}"><i class="ion-scissors uk-icon-bordered-dot ion uk-icon-justify"></i> <span class="menu-item-text">Coupon Codes</span></a> </li>