		<ul class="nav nav-pills">
  			<li {{ $active1 }}>{!! Html::link('/user-account',"Account Information") !!}</li>
            <li {{ $active2 }}>{!! Html::link('/user-billing',"Billing Information") !!}</li>
        </ul>    
        <ul class="nav nav-pills">
            <li {{ $active3 }}>{!! Html::link('/user-shipping',"Shipping Information") !!}</li>
            <li {{ $active4 }}>{!! Html::link('/user-orders',"Order History") !!}</li>
        </ul>
        <ul class="nav nav-pills">    
            <li {{ $active5 }}>{!! Html::link('/user-change-password',"Change Password") !!}</li>
        </ul>    
		