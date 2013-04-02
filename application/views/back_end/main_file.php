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
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>jqplugin/elfinder/css/theme.css"/>
<script type="text/javascript" charset="utf-8">
	$().ready(function() {
		var elf = $('#file_container').elfinder({
		  height:'1000px',
		  swfPlayer:'<?php echo base_url(); ?>player/player.swf',
		  url :'<?php echo base_url(); ?>admin/file_manager/elfinder_init'
		}).elfinder('instance');
	});
</script>
<body>
   	    <?php
		 $CI -> load -> view('back_end/includes/nav_menu');
		?>
    <div class="container-fluid wrapper">
      <div id="file_container"></div>
    </div>
    <!--/.fluid-container-->
</body>
</html>