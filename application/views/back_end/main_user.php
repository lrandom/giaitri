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
							<a href="<?php echo base_url() ?>user">Tất cả các người dùng</a>
						</li>
						<li>
							<a href="<?php echo base_url() ?>user/?show=reg_today">Người đăng kí ngày hôm nay</a>
						</li>
						<li>
							<a href="<?php echo base_url() ?>user/?show=disabled">Người dùng bị disabled</a>
						</li>
						<li>
							<a href="<?php echo base_url()?>user/?show=log_today">Đăng nhập ngày hôm nay</a>
						</li>
					</ul>
				</div>

				<div class="btn-group">

					<div class="input-append">
						<select class="btn option-search">
							<option value="id">ID</option>
							<option value="user_name">Tên đăng nhập</option>
							<option value="full_name">Họ tên</option>
							<option value="email">Email</option>
							<option value="phone">Phone</option>
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
							location.href ="<?php echo base_url()?>user?key_q=" + key_q + "&q=" + q;
						}
					}
				})
				</script>

				<div class="btn-group">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Hiển thị theo<span class="caret"></span> </a>
					<ul class="dropdown-menu">
						<li>
							<a href="<?php echo base_url().'user/?per_page=5&order='.$sort ?>">5 bản ghi/trang</a>
						</li>
						<li>
							<a href="<?php echo base_url().'user/?per_page=10&order='.$sort ?>">10 bản ghi/trang</a>
						</li>
						<li>
							<a href="<?php echo base_url().'user/?per_page=15&order='.$sort ?>">15 bản ghi/trang</a>
						</li>
						<li>
							<a href="<?php echo base_url().'user/?per_page=20&order='.$sort ?>">20 bản ghi/trang</a>
						</li>
					</ul>
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
							<th><a href="<?php echo base_url().'admin/dash_board/user/?order='.$next_sort ?>">Mã thành viên</a></th>
							<th>Tên đăng nhập</th>
							<th>Ảnh đại diện</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Ngày tham gia</th>
							<th>Đăng nhập lần cuối</th>
							<th>Vai trò</th>
							<th>Trạng thái</th>
							<th>Thao tác</th>
						</tr>
					</thead>

					<tbody>
						<?php
						if (isset($user_list)) {
							foreach ($user_list as $r) {
								echo '<tr>
								<td>' . $r -> user_id . '</td>
								<td>' . $r -> user_name . '</td>
								<td><img src="' . $r -> avts . '"/></td>
								<td>' . $r -> email . '</td>
								<td>' . $r -> phone . '</td>
								<td>' . $r -> date_join . '</td>
								<td>' . $r -> last_login . '</td>
								<td>' . $r -> name . '</td>';

								echo '<td>';
								if($r->user_state==1){
									echo 'Kích hoạt';
								}else{
									echo 'Khóa';
								}
								echo '</td>
								<td><a class="btn btn-info"  href="' . $edit_link. $r -> user_id . '">Sửa</a></td>
								<td><a class="btn btn-danger" href="'.$delete_link.$r -> user_id.'" onclick="return confirm(\'Bạn thực sự muốn xóa\')">Xóa</a></td>
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