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

						<div class="input-append">
							<select class="btn option-search">
								<option value="id">ID</option>
								<option value="desc">Tên chức năng</option>
								<option value="code">Mã code</option>
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
										location.href ="<?php echo base_url()?>admin/func?key_q=" + key_q + "&q=" + q;
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
								<th>No ID</th>
								<th>Chức năng</th>
								<th>Mã</th>
								<th>Cập nhật</th>
								<th>Thao tác</th>
							</tr>
						</thead>

						<tbody>

							<?php
							if (isset($func_list)) {
								foreach ($func_list as $r) {
									echo '<tr>
<td>' . $r -> id . '</td>
<td>' . $r -> desc . '</td>
<td>' . $r -> code . '</td>
<td>' . $r -> last_update . '</td>
<td><a class="btn btn-info"  href="' . base_url() . 'admin/func/edit/' . $r -> id .'">Sửa</a></td>
</tr>';
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<!--end row fluid-->
			<?php
			if (isset($page_link)) {
				echo $page_link;
			}
			?>
			<hr>
			<?php
			$CI = &get_instance();
			$CI -> load -> view('back_end/includes/footer');
			?>
		</div><!--/.fluid-container-->
	</body>
</html>