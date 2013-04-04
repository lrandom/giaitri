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
					<a href="<?php echo $add_link; ?>" class="btn"> Thêm </a>
				</div>
				<div class="btn-group">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Hiển thị <span class="caret"></span> </a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo base_url()?>admin/role">Tất cả các vai trò</a>
						</li>
						<li>
							<a href="<?php echo base_url()?>admin/role?show=actived">Vai trò có hiệu lực</a>
						</li>
						<li>
							<a href="<?php echo base_url()?>admin/role?show=disabled">Vai trò bị khóa</a>
						</li>

					</ul>
				</div>
				<div class="btn-group">
					<div class="input-append">
						<select class="btn option-search">
							<option value="id">ID</option>
							<option value="name">Tên</option>
						</select>
						<input class="span2 input-medium search-query" id="appendedInputButton" type="text">
					</div>
					<script type="text/javascript">
					$('.search-query').keypress(function(e) {
						var code = (e.keyCode ? e.keyCode : e.which);
						if (code == 13) {
							var key_q = $('.option-search option:selected').val();
							var q = $('.search-query').val();
							if (key_q != "" && q != "") {
								location.href ="<?php echo base_url()?>admin/role?key_q=" + key_q + "&q=" + q;
							}
						}
					})
					</script>
				</div>

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
							<th><a href="<?php echo base_url().'admin/dash_board/role/?order='.$next_sort ?>">Mã vai trò</a></th>
							<th>Tên vai trò</th>
							<th>Trạng thái</th>
							<th>Cập nhật lần cuối</th>
						</tr>
					</thead>

					<tbody>
						<?php
						if (isset($role_list)) {
							foreach ($role_list as $r) {
								echo '<tr>
								<td>' . $r -> id . '</td>
								<td>' . $r -> name . '</td>
								<td>' . $r -> state . '</td>
								<td>' . $r -> last_update . '</td>
								<td><a class="btn btn-info"  href="'.$change_permission_link.$r->id.'">Thay đổi quyền truy cập</a></td>
								<td><a class="btn btn-info"  href="' . base_url() . 'admin/role/edit/' . $r -> id . '">Sửa</a></td>
								<td><a class="btn btn-danger" href="' . base_url() . 'admin/role?action=delete&id=' . $r -> id . '&order=' . $sort . '" onclick="return confirm(\'Bạn thực sự muốn xóa\')">Xóa</a></td>
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
		$CI -> load -> view('back_end/includes/footer');
		?>
	</div><!--/.fluid-container-->
</body>
</html>