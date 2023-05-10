<footer> 
<div class="uk-container uk-container-center">   
    <div class="uk-grid">
               
            <div class="uk-width-medium-9-10 uk-width-8-10  uk-text-center support-links-footer footer-widget">
              
                     <h3>SUPPORT </h3>
                    <div class="uk-grid">
                     <div class="uk-width-small-1-1 uk-width-1-1 first-row">
                        {!! Html::link('/about','About', array('class'=>'uk-display-inline-block footer-link-menu')) !!}
                        {!! Html::link('/collection','Collection', array('class'=>'uk-display-inline-block footer-link-menu')) !!}
                        <!-- {!! Html::link('/framing','Framing', array('class'=>'uk-display-inline-block footer-link-menu')) !!} -->
                        {!! Html::link('/shipping-page','Shipping', array('class'=>'uk-display-inline-block footer-link-menu')) !!}
                        
                        {!! Html::link('/connect','Contact Us', array('class'=>'uk-display-inline-block footer-link-menu')) !!}
                        {!! Html::link('/privacy-policy','Privacy Policy', array('class'=>'uk-display-inline-block footer-link-menu')) !!}
                        {!! Html::link('/terms-and-conditions','Terms of Use', array('class'=>'uk-display-inline-block footer-link-menu')) !!}
                     </div>
                    </div>
            </div>
            <div class="uk-width-medium-1-10  uk-width-2-10  uk-text-center  logo-footer footer-widget">
               <a href="{!!url('/')!!}"></a>
            </div>
        </div>  
  </div>  <!-- uk-container-center--> 
</footer>



<!-- INT/EXT JAVASCRIPT -->
 {!! HTML::script('_front/assets/js/plugins.js') !!}
<script>
$(document).ready(function(){
    loadcssfile('https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700|Lato:400,300,700','css');   
    loadcssfile('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css','css');
});

</script>
