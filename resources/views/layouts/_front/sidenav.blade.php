<ul class="list-unstyled menu">
		<li class="device-menu">&nbsp;</li>
        @foreach(PagesManagement::displayMenu() as $menus)
        	@if(isset($menus['subpage']) )	        	
                <li>{{ HTML::link($menus['isCMS'] == 1 ? "/pages/".$menus['slug'] : $menus['filename'],$menus['pagename']) }}</li>                @foreach($menus['subpage'] as $submenu)
                	@if(isset($submenu['thirdpage']) )
                	   <li>{{ HTML::link($submenu['isCMS'] == 1 ? "/pages/".$submenu['slug'] : $submenu['filename'],'&nbsp;&nbsp;&raquo; '.$submenu['pagename']) }}</li>
                       @foreach($submenu['thirdpage'] as $thirdmenu)
                          <li>{{ HTML::link($thirdmenu['isCMS'] == 1 ? "/pages/".$thirdmenu['slug'] : $thirdmenu['filename'],'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo; '.$thirdmenu['pagename']) }}</li>
                       @endforeach 
                    @else
                    	<li>{{ HTML::link($submenu['isCMS'] == 1 ? "/pages/".$submenu['slug'] : $submenu['filename'],'&nbsp;&nbsp;&raquo; '.$submenu['pagename']) }}</li>
                    @endif
                @endforeach
            @else 
            	<li>{{ HTML::link($menus['isCMS'] == 1 ? "/pages/".$menus['slug'] : $menus['filename'],$menus['pagename']) }}</li>
            @endif    
            
        @endforeach
		
        <li>{{ HTML::link("shopping-cart","Shopping Cart") }}</li>    
        
        @if(Session::has('client_id'))        
            <li>{{ HTML::link("user-account","My Account") }}</li>    
            <li>{{ HTML::link("logout","Logout") }}</li>    
        @else         	
            <li>{{ HTML::link("login","Login") }}</li>    
        @endif
</ul>
