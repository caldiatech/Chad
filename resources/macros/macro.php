<?php

	Html::macro('flash_msg_admin', function(){
		if(Session::has('flash.alert')):
	        // return '<div class="alert alert-'.Session::get('flash.alert').'">'.Session::get('flash.msg') .'</div>';
	        return '<div class="uk-alert uk-alert-'.Session::get('flash.alert').'">'.Session::get('flash.msg') .'</div>';
	    endif;
	});

	Html::macro('flash_msg_front', function(){
		if(Session::has('flash.alert')):
	        // return '<div class="alert alert-'.Session::get('flash.alert').'">'.Session::get('flash.msg') .'</div>';
	        return '<div id="emailValidation" class="uk-text-large uk-alert uk-alert-'.Session::get('flash.alert').'">'.Session::get('flash.msg') .'</div>';
	    endif;
	});

?>
