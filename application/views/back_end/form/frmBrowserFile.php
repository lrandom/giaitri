<?php
$CI = &get_instance();
?>
<!DOCTYPE html>
<html>
<?php
$CI -> load -> view('back_end/includes/header.php');
?>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>jqplugin/ui/css/smoothness/jquery-ui-1.9.2.custom.css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>jqplugin/ui/js/jquery-ui-1.8.17.custom.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>jqplugin/elfinder/css/elfinder.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>jqplugin/elfinder/js/elfinder.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>jqplugin/tiny_mce/tiny_mce_popup.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>jqplugin/elfinder/css/theme.css"/>
<script type="text/javascript">
var type=null;
var FileBrowserDialogue = {
  init: function() {
  },
  mySubmit: function (URL) {
    var win = tinyMCEPopup.getWindowArg('window');
      // pass selected file path to TinyMCE
      win.document.getElementById(tinyMCEPopup.getWindowArg('input')).value = URL;
      // are we an image browser?
      if (typeof(win.ImageDialog) != 'undefined') {
        // update image dimensions
        if (win.ImageDialog.getImageData) {
          win.ImageDialog.getImageData();
        }
        // update preview if necessary
        if (win.ImageDialog.showPreviewImage) {
          win.ImageDialog.showPreviewImage(URL);
        }
      }
      // close popup window
      tinyMCEPopup.close();
    },
    type:tinyMCEPopup.getWindowArg('type'), //Video||Image
    inputID:tinyMCEPopup.getWindowArg('input')
  }

  tinyMCEPopup.onInit.add(FileBrowserDialogue.init, FileBrowserDialogue);
  $().ready(function() {
    switch (FileBrowserDialogue.type){
      case '<?php echo VIDEO_UPLOAD_LABEL ?>':
          //set up elfinder
          var elf = $('#file_container').elfinder({
            url : '<?php echo $file_browser_init_controller.$type; ?>',
            getFileCallback: function(url) { // editor callback
              url=url.replace(/\\/g, "/");
            FileBrowserDialogue.mySubmit(url); // pass selected file path to TinyMCE 
          },
          onlyMimes: ["video"],
          commands : ['search'],
          swfPlayer:'<?php echo $swf_jwplayer_path; ?>',
          handlers:{
            upload:function(event,instance){
              var uploadedFiles = event.data.added;
              for (i in uploadedFiles) {
                var file = uploadedFiles[i];
                alert(JSON.stringify(file));
              }
            }
          }
        }).elfinder('instance');
    //end set elfinder
    break;

    case '<?php echo IMAGE_UPLOAD_LABEL ?>':
                 //set up elfinder
              var elf = $('#file_container').elfinder({
              url : '<?php echo $file_browser_init_controller.$type; ?>',
              getFileCallback: function(url) { // editor callback
              FileBrowserDialogue.mySubmit(url); // pass selected file path to TinyMCE 
            },
            //player for video view
            swfPlayer:'<?php echo $swf_jwplayer_path; ?>',
            onlyMimes: ["image"],
            commands: ['upload','search'],
            handlers:{

            }
          }).elfinder('instance');
    //end set elfinder
    break;
  }
});
</script>

<body>
  <div class="container-fluid wrapper">
    <div id="file_container"></div>
  </div>
  <!--/.fluid-container-->
</body>
<style type="text/css">
 p:only-of-type
</style>
</html>
