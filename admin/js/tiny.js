tinymce.init({ 
    
   force_br_newlines : true,
  force_p_newlines : false,
  forced_root_block : '',
  file_browser_callback: function(field_name, url, type, win) {
    win.document.getElementById(field_name).value = url;
  },
   selector: '#editor',
  height: "400",
  theme: 'modern',


  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
  ],
  toolbar1: 'undo redo | insert | fontselect | fontsizeselect | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
   
    '//www.tinymce.com/css/codepen.min.css'
  ],
    image_title: true, 
	relative_urls : false,
remove_script_host : true,
document_base_url : "http://localhost:8888/mrev/",
  // enable automatic uploads of images represented by blob or data URIs
  images_upload_handler: function (blobInfo, success, failure) {
    var xhr, formData;

    xhr = new XMLHttpRequest();
    xhr.withCredentials = false;
    xhr.open('POST', 'http://localhost:8888/mrev/postAcceptor.php');

    xhr.onload = function() {
      var json;

      if (xhr.status != 200) {
        failure('HTTP Error: ' + xhr.status);
        return;
      }

      json = JSON.parse(xhr.responseText);

      if (!json || typeof json.location != 'string') {
        failure('Invalid JSON: ' + xhr.responseText);
        return;
      }

      success(json.location);
    };

    formData = new FormData();
    formData.append('file', blobInfo.blob(), blobInfo.filename());

	
    xhr.send(formData);
  }

});

tinyMCE.triggerSave();