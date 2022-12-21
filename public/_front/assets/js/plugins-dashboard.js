
// Place any jQuery/helper plugins in here.
function loadcssfile(filename, filetype){	
		var fileref=document.createElement("link")
        fileref.setAttribute("rel", "stylesheet")
        fileref.setAttribute("type", "text/css")
        fileref.setAttribute("href", filename)
        document.getElementsByTagName("head")[0].appendChild(fileref);       
}
function loadScript(url, callback){
    var script = document.createElement("script")
    script.type = "text/javascript";
    if (script.readyState){  //IE
        script.onreadystatechange = function(){
            if (script.readyState == "loaded" ||
                    script.readyState == "complete"){
                script.onreadystatechange = null;
                callback();
            }
        };
    } else {  //Others
        script.onload = function(){
            callback();
        };
    }

    script.src = url;
    document.getElementsByTagName("footer")[0].appendChild(script);
}

/*globalvarialbles */
var window_width = $(window).innerWidth();
var window_height = $(window).innerHeight();
var first_load = 0; 
$(function() {
 $('#toggle').click(function() {
        $(this).next('.nav').toggleClass("is-collapsed-mobile");
      });
  $(document).ready(function(){
      $('.content img.w100').each(function(){
        if($(this).attr('width')){
            var this_max_width = $(this).attr('width');
            $(this).css('max-width',this_max_width+'px');
        }
    });

     $('.load-bg-img').each(function(index, element) { 
        var this_img_url = $(this).attr('data-url');    
        $(this).css('background-image','url('+this_img_url+')'); 
        $(this).removeClass('load-bg-img'); 
    });
      $('.load-img').each(function(index, element) { 
        var this_img_url = $(this).attr('data-url');    
        $(this).attr('src',this_img_url); 
        $(this).removeClass('load-img'); 
    }); 



    
    showOffCanvas();
    $('.uk-toggle-offcanvas').click(function(){
        if(window_width > 1024){
            $("body").toggleClass('desktop-style');
        }
    });
    $('a[data-uk-toggle] > i.uk-icon-angle-up').click(function(){
        $(this).toggleClass("toggled");
    });
    $( window ).resize(function() {
        showOffCanvas();
        
            
        
    }); /* end of $( window ).resize */

    function showOffCanvas(){
        window_width = $(window).innerWidth();
        window_height = $(window).innerHeight();
        $("body").css({'height':window_height+'px'});
        if(window_width <= 1024){
            $("body:not('.uk-offcanvas-page')").css({'width':'auto', 'margin-left':'0px'});
            $("body:not('.uk-offcanvas-page') #offcanvas-dashboard").removeClass("uk-active");
            $("body.uk-offcanvas-page #offcanvas-dashboard").addClass("uk-active");
            $('body').removeClass("desktop-style");
            if(first_load == 0){
                $('#offcanvas-dashboard').removeClass("uk-active"); first_load++;            
            }
        }else{
            $("body").css({'margin-left':'270px'});
            $("body:not('.desktop-style') #offcanvas-dashboard").addClass("uk-active");
            $('body').removeClass('uk-offcanvas-page');
        }
    } /* end of showOffCanvas() */

     
 });

  
});
