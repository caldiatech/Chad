function loadcssfile(filename,filetype){var fileref=document.createElement("link")
fileref.setAttribute("rel","stylesheet")
fileref.setAttribute("type","text/css")
fileref.setAttribute("href",filename)
document.getElementsByTagName("head")[0].appendChild(fileref);}function loadScript(url,callback){var script=document.createElement("script")
script.type="text/javascript";if(script.readyState){script.onreadystatechange=function(){if(script.readyState=="loaded"||script.readyState=="complete"){script.onreadystatechange=null;callback();}};}else{script.onload=function(){callback();};}script.src=url;document.getElementsByTagName("footer")[0].appendChild(script);}var window_width=$(window).innerWidth();var window_height=$(window).innerHeight();var first_load=0;$(function(){$('#toggle').click(function(){$(this).next('.nav').toggleClass("is-collapsed-mobile");});$(document).ready(function(){$('.content img.w100').each(function(){if($(this).attr('width')){var this_max_width=$(this).attr('width');$(this).css('max-width',this_max_width+'px');}});$('.load-bg-img').each(function(index,element){var this_img_url=$(this).attr('data-url');$(this).css('background-image','url('+this_img_url+')');$(this).removeClass('load-bg-img');});$('.load-img').each(function(index,element){var this_img_url=$(this).attr('data-url');$(this).attr('src',this_img_url);$(this).removeClass('load-img');});$('span.custom-toggle').click(function(){var this_toggle=$(this);var this_toggle_target=this_toggle.attr('data-custom-toggle');console.log(this_toggle_target);$(this_toggle_target).each(function(){$(this).toggleClass('uk-hidden');});});$('input.custom-toggle').change(function(){var this_toggle=$(this);var this_toggle_target=this_toggle.attr('data-custom-toggle');$('.toggle-me').each(function(){if($(this).hasClass(this_toggle_target)){$(this).addClass('uk-active-toggle');$(this).removeClass('uk-hidden');}else{$(this).addClass('uk-hidden');}});console.log(this_toggle_target);});$('[data-uk-toggle]').click(function(){var this_toggle_btn=$(this);var this_toggle_text=this_toggle_btn.html();if(this_toggle_btn.attr('data-change-text')&&($(this).attr('data-change-text')!='')){var this_replcetext=this_toggle_btn.attr('data-change-text')
this_toggle_btn.html(this_replcetext);this_toggle_btn.attr('data-change-text',this_toggle_text);}});var resizeId;doneResizing();$(window).resize(function(){clearTimeout(resizeId);resizeId=setTimeout(doneResizing,500);});function doneResizing(){window_width=$(window).innerWidth();window_height=$(window).innerHeight();if(window_width<767){if(window_width>window_height){$('body').addClass('landscape-mode-on');$('body').removeClass('normal-mode-on');}else{$('body').removeClass('landscape-mode-on');$('body').addClass('normal-mode-on');}}}});});


(function($) {

    var allPanels = $('.accordion > dd').hide();

    $('.accordion > dt > a').click(function() {
      allPanels.slideUp();
      $(this).parent().next().slideDown();
      return false;
    });

  })(jQuery);