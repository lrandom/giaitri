<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php echo $title; ?></title>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>cssframework/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>cssframework/bootstrap/css/bootstrap-responsive.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/admin/main.css">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>cssframework/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		//Add Hover effect to menus
		jQuery('ul.nav li.dropdown').hover(function() {
			jQuery(this).find('.dropdown-menu').stop(true, true).delay(0).fadeIn();
		}, function() {
			jQuery(this).find('.dropdown-menu').stop(true, true).delay(0).fadeOut();
		});
		$('.dropdown-toggle').dropdown();
		$('#article-tab a').click(function(e) {
			e.preventDefault();
			$(this).tab('show');
		})
	})
</script>
</head>
