<footer> 
<div class="uk-container uk-container-center uk-margin-large-top  uk-margin-medium-bottom ">   
    <div class="uk-grid">
                <!--<div class="uk-width-large-1-3 uk-width-medium-4-10  uk-width-1-1 social-media-footer footer-widget"> &nbsp;
                    <h3>CONNECT</h3> 
                     <a href="{{$settings->fldAdministratorTwitter == "" ? "#" : $settings->fldAdministratorTwitter}}"><i class="uk-icon-twitter"></i></a> 
                     <a href="{{$settings->fldAdministratorFacebook == "" ? "#" : $settings->fldAdministratorFacebook}}"><i class="uk-icon-facebook"></i></a>  
                     <a href="{{$settings->fldAdministratorTwitter == "" ? "#" : $settings->fldAdministratorTwitter}}"><i class="uk-icon-linkedin icon-boxed"></i></a>  
                     <a href="{{$settings->fldAdministratorTwitter == "" ? "#" : $settings->fldAdministratorTwitter}}"><i class="uk-icon-pinterest-p"></i></a>  
                     <a href="{{$settings->fldAdministratorTwitter == "" ? "#" : $settings->fldAdministratorTwitter}}"><i class="ion-social-googleplus-outline ion"></i></a>    
                </div>-->
            <div class="uk-width-large-1-2 uk-width-medium-6-10   uk-width-small-1-2 uk-width-1-1  support-links-footer footer-widget">
              
                     <h3>SUPPORT</h3>
                    <div class="uk-grid">
                     <div class="uk-width-small-1-1 uk-width-1-1 first-row">
                        {!! Html::link('/about','About', array('class'=>'uk-display-inline-block')) !!}
                        {!! Html::link('/collection','Collection', array('class'=>'uk-display-inline-block')) !!}
                        {!! Html::link('/framing','Framing', array('class'=>'uk-display-inline-block')) !!}
                        {!! Html::link('/shipping','Shipping', array('class'=>'uk-display-inline-block')) !!}
                        <!--<p>– Shipping and packaging are included in all pricing. All pieces are carefully and securely wrapped for shipping. Please inspect the packaging for holes or damage. Should you feel the outside box has sufficient enough damage, that may have compromised your product, please open at the time of delivery and make note of any damages with the delivery personnel.</p>-->
                        <!--{!! Html::link('/returns','Returns', array('class'=>'full-width')) !!}-->
                        {!! Html::link('/connect','Connect', array('class'=>'uk-display-inline-block')) !!}
                        <!--<p>immediately if your image has been compromised.</p>-->
                        <!--{!! Html::link('tel:(866) 467-9694','(866) 467-9694', array('class'=>'full-width')) !!}-->
                     </div>
                    </div>
            </div>
            <div class="uk-width-large-1-2 uk-width-1-1  uk-text-center  logo-footer footer-widget">
               <a href="{!!url()!!}"> <img src="{!!url('_front/assets/images/logo-clarkin.png')!!}"  alt="clarkin collections" width="156" height="133" /></a>
            </div>

               
        </div>  
        <div class="uk-width-1-1 footer-small-links uk-margin-large-top  footer-smaller-links">
                <div class="roboto full-width  uk-margin-medium-top">
                    {!! Html::link('/privacy-policy','Privacy Policy') !!}
                    {!! Html::link('/terms-and-conditions','Terms') !!}
                </div>
        </div>  
  </div>  <!-- uk-container-center--> 
</footer>



<!-- INT/EXT JAVASCRIPT -->
 {!! HTML::script('_front/assets/js/plugins.js') !!}
<script>
$(document).ready(function(){
    loadcssfile('https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700|Lato:400,300,700','css');
   /*  loadcssfile('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css','css'); 
        // removed fontawesome: uikit uses font awesome icons already :
        Sample usage:
            FontAwesome: fa fa-pencil
            UIKIT: uk-icon-pencil 
    */
    loadcssfile('http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css','css');
});

</script>
