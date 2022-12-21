tinymce.init({
  selector: 'h1.editable',
  mode : "specific_textareas",
  editor_selector : "mceEditor",
  inline: true,
  toolbar: 'undo redo',
  menubar: false
});

tinymce.init({
  selector: 'h3.editable',
  mode : "specific_textareas",
  editor_selector : "mceEditor",
  inline: true,
  toolbar: 'undo redo',
  menubar: false
});

tinymce.init({
  selector: 'div.editable',
  mode : "specific_textareas",
  editor_selector : "mceEditor",
  inline: true,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste'
  ],
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
});