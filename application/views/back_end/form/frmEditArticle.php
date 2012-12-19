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
					<a href="#article-tabcontent" data-toggle="tab">Bài viết</a>
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
				<div class="tab-pane active" id="article-tabcontent">
					<form class="form-horizontal">
						<fieldset>
							<legend>
								Đăng bài viết
							</legend>
							<div class="control-group">
								<label class="control-label" for="txtTitle">Tiêu đề</label>
								<div class="controls">
									<input type="text" id="txtTitle" placeholder="Tiêu đề"/>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="selectCategory">Chuyên mục</label>
								<div class="controls">
									<select id="selectCategory">
										<option value="">Chuyên mục 1</option>
										<option value="">Chuyên mục 2</option>
									</select>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="txtSource">Nguồn</label>
								<div class="controls">
									<input type="text"  id="txtSource" placeholder="Nguồn">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="txtAuthor">Tác giả</label>
								<div class="controls">
									<input type="text" id="txtAuthor" placeholder="Tác giả"/>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="txtLabel"></label>
								<div class="controls">
									<input type="text" id="txtAuthor" placeholder="Tác giả" />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="txtContent">Nội dung</label>
								<div class="controls">
									<textarea id="txtContent">
					                </textarea>
								</div>
							</div>

							<div class="control-group">
								<div class="controls">
									<button type="button" class="btn">
										Đăng
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
				<!--end tab content article-->

				<div class="tab-pane" id="images-tabcontent">
					<fieldset>
						<legend>
							Đăng ảnh vui
						</legend>
						<form class="form-horizontal">
							<div class="control-group">
								<label class="control-label" for="txtTitle">Tiêu đề</label>
								<div class="controls">
									<input type="text" id="txtTitle" placeholder="Tiêu đề"/>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="txtSource">Nguồn</label>
								<div class="controls">
									<input type="text" id="txtSource" placeholder="Nguồn"/>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="txtAuthor">Tác giả</label>
								<div class="controls">
									<input type="text" id="txtAuthor" placeholder="Tác giả"/>
								</div>
							</div>

							<div class="control-group">
								<div class="controls">
									<button type="button" class="btn">
										Đăng
									</button>
									<button type="button" class="btn">
										Quay lại
									</button>
								</div>
							</div>
						</form>
					</fieldset>
				</div>
				<!--end tab content images-->

				<div class="tab-pane" id="clip-tabcontent">
					<fieldset>
						<legend>
							Đăng clip vui
						</legend>
						<form class="form-horizontal">
							<div class="control-group">
								<label class="control-label" for="txtTitle">Tiêu đề</label>
								<div class="controls">
									<input type="text" id="txtTitle" placeholder="Tiêu đề"/>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="txtSource">Nguồn</label>
								<div class="controls">
									<input type="text" id="txtSource" placeholder="Nguồn"/>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="txtAuthor">Tác giả</label>
								<div class="controls">
									<input type="text" id="txtAuthor" placeholder="Tác giả"/>
								</div>
							</div>

							<div class="control-group">
								<div class="controls">
									<button type="button" class="btn">
										Đăng
									</button>
									<button type="button" class="btn">
										Quay lại
									</button>
								</div>
							</div>
						</form>
					</fieldset>
				</div>

				<div class="tab-pane" id="embed-youtube-clip-tabcontent">
					<fieldset>
						<legend>
							Nhúng clip vui youtube
						</legend>
						<form class="form-horizontal">
							<div class="control-group">
								<label class="control-label" for="txtTitle">Tiêu đề</label>
								<div class="controls">
									<input type="text" id="txtTitle" placeholder="Tiêu đề"/>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="txtSource">Nguồn</label>
								<div class="controls">
									<input type="text" id="txtSource" placeholder="Nguồn"/>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="txtAuthor">Tác giả</label>
								<div class="controls">
									<input type="text" id="txtAuthor" placeholder="Tác giả"/>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="txtEmbedCode">Mã nhúng</label>
								<div class="controls">
									<input type="text" id="txtEmbedCode" placeholder="Mã nhúng"/>
								</div>
							</div>

							<div class="control-group">
								<div class="controls">
									<button type="button" class="btn">
										Đăng
									</button>
									<button type="button" class="btn">
										Quay lại
									</button>
								</div>
							</div>
						</form>
					</fieldset>
				</div>
				<!--end tab content video-->

			</div>
		</div>
		<!--end container fluid-->
	</body>
</html>