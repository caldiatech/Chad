function saveChangesPages(slug) {
  $(".saveAlert").show();
  $("#title").html(tinyMCE.get('title').getContent());
  console.debug(tinyMCE.get('description').getContent());
  var data = $('form#pageform').serializeArray();
  data.push({
    name: "title",
    value: tinyMCE.get('title').getContent()
  });
  data.push({
    name: "description",
    value: tinyMCE.get('description').getContent()
  });

  $.ajax({
    type: "POST",
    url: slug,
    data: $.param(data),
    success: function (data) {

      window.location.href = data;
    }

  });

}
// Resolve the height for vertical images
var window_height = 0, window_width = 0, container_height = 0, header_height = 0, footer_height = 0, doit;

$(window).on('load', function () {
// $(window).load(function () { 
  $(document).ready(function () {
    $('.vertical-img').height($('.uk-overlay').height());
    $(window).resize(function () {
    $('.vertical-img').height($('.uk-overlay').height());
    });
    set_container_height();
    function resizedw(){
      console.log('resizedw()');
      set_container_height();
      
    }

    function hide_frame_details(){
      if($('#toggle-frame-details') != undefined){
        $('#toggle-frame-details').addClass('uk-hidden');
      }
    }

    function set_container_height(){
      window_height = parseInt(window.innerHeight);
      window_width  = parseInt(window.innerWidth);
      console.log('window_height');
      console.log(window_height);
      footer_height = parseInt($('.footer').height());
      console.log('footer_height');
      console.log(footer_height);
      header_height = parseInt($('.wrap.header').height());
      console.log('header_height');
      console.log(header_height);
      container_height = window_height - footer_height - header_height;
      console.log('container_height');
      console.log(container_height);
      $('#container .wrap.content').css('min-height', container_height+'px');
      if(window_width <= 767){
        hide_frame_details();
      }

    }

    window.onresize = function(){
      clearTimeout(doit);
      doit = setTimeout(resizedw, 100);
    };

  });
});
