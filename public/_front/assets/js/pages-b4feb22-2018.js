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
$(document).ready(function () {
  $('.vertical-img').height($('.uk-overlay').height());
  $(window).resize(function () {
  $('.vertical-img').height($('.uk-overlay').height());
  });
});