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
			<form class="form-horizontal">
				<fieldset>
					<legend>Thêm mới chuyên mục</legend>
				<div class="control-group">
					<label class="control-label" for="txtCategory">Tên chuyên mục</label>
					<div class="controls">
						<input type="text" id="txtCategory" placeholder="Tên chuyên mục">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="txtIndeMenu">Thứ tự trên menu top</label>
					<div class="controls">
						<input type="text"  id="txtIndexMenu" placeholder="Thứ tự trên menu">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="inputPassword">Cấp độ chuyên mục</label>
					<div class="controls">
						<input type="text" " id="txtLevel" placeholder="Cấp độ chuyên mục">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="txtTargetParent">Chuyên mục cha</label>
					<div class="controls">
						<select id="txtTargetParent">
							<option>Chuyên mục 1</option>
							<option>Chuyên mục 2</option>
						</select>
					</div>
				</div>
				
				<div class="control-group">
					 <label class="control-label" for="txtDesc">Miêu tả</label>
					 <div class="controls">
					   <textarea id="txtDesc">
					   	
					   </textarea>
					 </div>
				</div>

				<div class="control-group">
					<div class="controls">
						<button type="button" class="btn">
							Thêm
						</button>
						<button type="button" class="btn">
							Quay lại
						</button>
					</div>
				</div>
				</fieldset>
			</form>
			<!--end form-->
		</div>
		<!--end container fluid-->
	</body>
</html>