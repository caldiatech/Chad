		<ul class="uk-nav">
		    <li {{ $active1 }}>{!! Html::link('/user-account',"Account Information") !!}</li>
            <li {{ $active2 }}>{!! Html::link('/user-billing',"Billing Information") !!}</li>
            <li {{ $active3 }}>{!! Html::link('/user-shipping',"Shipping Information") !!}</li>
            <li {{ $active4 }}>{!! Html::link('/user-orders',"Order History") !!}</li>
            <li {{ $active5 }}>{!! Html::link('/user-change-password',"Change Password") !!}</li>
		</ul>