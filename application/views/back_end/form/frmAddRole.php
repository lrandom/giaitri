<?php
$CI = &get_instance();
?>
<!DOCTYPE html5>
<html>
	<?php
	$CI -> load -> view('back_end/includes/header.php');
	?>

	<body>
		<?php
		$CI -> load -> view('back_end/includes/nav_menu');
		?>
		<div class="container-fluid wrapper">
			<ul class="nav nav-tabs" id="article-tab">
				<li class="active">
					<a href="#article-tabcontent" data-toggle="tab">Nhóm</a>
				</li>
				<li>
					<a href="#images-tabcontent" data-toggle="tab">Ảnh</a>
				</li>
				<li>
					<a href="#clip-tabcontent" data-toggle="tab">Clip vui</a>
				</li>
				<li>
					<a href="#embed-youtube-clip-tabcontent" data-toggle="tab">Nhúng clip vui youtube</a>
				</li>
			</ul>
			<div class="tab-content">
		    </div>
		</div>
		<!--end row fluid-->

		<hr>
		<?php
		$CI = &get_instance();
		$CI -> load -> view('back_end/includes/footer');
		?>
		</div><!--/.fluid-container-->
	</body>
</html>