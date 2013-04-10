<?php
$CI = &get_instance();
?>
<!DOCTYPE html>
<html>
<?php
$CI -> load -> view('back_end/includes/header.php');
?>
<body>
	<?php
	$CI -> load -> view('back_end/includes/nav_menu');
	?>
	<div class="container-fluid wrapper">
		<div class="navbar">
			<div class="navbar-inner">
				<div class="btn-group">
					<a class="btn" href="<?php echo $add_link; ?>"> Thêm </a>
				</div>

				<div class="btn-group">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Hiển thị<span class="caret"></span> </a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo base_url() ?>admin/category">Tất cả các chuyên mục</a>
						</li>
						<li>
							<a href="<?php echo base_url() ?>admin/category?show=disabled">Chuyên mục bị khóa</a>
						</li>
						<li>
							<a href="<?php echo base_url() ?>admin/category?show=actived">Chuyên mục đang hoạt động</a>
						</li>
					</ul>
				</div>

				<div class="btn-group">
					<div class="input-append">
						<select class="btn option-search">
							<option value="id">ID</option>
							<option value="name">name</option>
						</select>
						<input class="span2 input-medium search-query" id="appendedInputButton" type="text">
					</div>
				</div>
				
				<script type="text/javascript">
				$('.search-query').keypress(function(e) {
					var code = (e.keyCode ? e.keyCode : e.which);
					if (code == 13) {
						var key_q = $('.option-search option:selected').val();
						var q = $('.search-query').val();
						if (key_q != "" && q != "") {
							location.href ="<?php echo base_url()?>admin/category?key_q=" + key_q + "&q=" + q;
						}
					}
				})
				</script>
				
				
			</div>
		</div>
		<!--show alert messager-->
		<?php
		if(isset($alert_state)){
			?>
			<div class='alert alert-<?php echo $alert_state; ?>'>
				<button type="button" class="close" data-dismiss="alert">
					&times;
				</button>
				<?php echo $alert_msg; ?>
			</div>
			<?php
		}
		?>
		<!--end show alert messager-->
		<div class="row-fluid wrapper">
			<div class="span12 ">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Vị trí trên top menu</th>
							<th>Trạng thái</th>
						</tr>
					</thead>

					<tbody>
						<?php
						if (isset($cat_list)) {
							foreach ($cat_list as $r) {
								echo '<tr>
								<td>' . $r -> id . '</td>
								<td>' . $r -> name . '</td>
								<td>'.$r->order_top_menu.'</td>
								<td>' . $r -> state . '</td>
								<td><a class="btn btn-info"  href="' . base_url() . 'admin/category/edit/' . $r -> id . '">Sửa</a></td>
								<td><a class="btn btn-danger" href="' . base_url() . 'admin/category/?action=delete&id=' . $r -> id . '">Xóa</a></td>
								</tr>';
							}
						}
						?>
					</tbody>
				</table>
				<?php
				if (isset($page_link)) {
					echo $page_link;
				}
				?>
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