<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>jqplugin/ui/css/smoothness/jquery-ui-1.9.2.custom.css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>jqplugin/ui/js/jquery-ui-1.8.17.custom.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>jqplugin/elfinder/css/elfinder.min.css">
<script type="text/javascript" src="<?php echo base_url(); ?>jqplugin/elfinder/js/elfinder.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>jqplugin/elfinder/css/theme.css"/>
<!-- Include jQuery, jQuery UI, elFinder (REQUIRED) -->
<script type="text/javascript">
$().ready(function() {
 var elf = $('#file_container').elfinder({
   // set your elFinder options here
   url : '<?php echo $file_browser_init_controller.$type; ?>',
   commands : ['upload'],
   getFileCallback: function(url) { // editor callback
	 $('#thumb').attr('src',url); // pass selected file path to TinyMCE
	 $('#thumb-data').val(url);
	 $('#thumbModal').modal('hide')
 }
}).elfinder('instance');
});
</script>

<div class="container-fluid wrapper">
	<div id="file_container"></div>
</div>
<!--/.fluid-container-->
