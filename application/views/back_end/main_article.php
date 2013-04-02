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
						<a class="btn" href="<?php echo $add_link ?>">
							Thêm
						</a>
					</div>

					<div class="btn-group">
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Hiển thị theo chuyên mục<span class="caret"></span> </a>
						<ul class="dropdown-menu">
						    <?php 
							  if(isset($cat_list))
							   {
							   	  foreach ($cat_list as $r) {
								    echo '<li><a href="">'.$r->name.'</a></li>';
							      }
							   }
							?>
						</ul>
					</div>

					<div class="btn-group">
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Hiển thị <span class="caret"></span> </a>
						<ul class="dropdown-menu">
						  							<li>
								<a href="<?php echo base_url() ?>article">Tất cả các bài đăng</a>
							</li>
							<li>
								<a href="<?php echo base_url() ?>article/?show=up_today">Đăng trong ngày</a>
							</li>
							<li>
								<a href="<?php echo base_url() ?>article/?show=disabled">Chờ duyệt </a>
							</li>
							<li>
								<a href="<?php echo base_url()?>article/?show=actived">Đã duyệt</a>
							</li>
						</ul>
					</div>

					<div class="btn-group">

						<div class="input-append">
							<select class="btn option-search">
								<option value="id">ID</option>
								<option value="title">Tiêu đề</option>
								<option value="content">Nội dung</option>
								<option value="uploader">Người đăng</option>
								<option value="source">Nguồn</option>
								<option value="pseu">Người đăng</option>
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
										location.href ="<?php echo base_url()?>article?key_q=" + key_q + "&q=" + q;
									}
								}
							})
				    </script>
                    
					</div>

				</div>

			</div>

			<div class="row-fluid wrapper">
				<div class="span12 ">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Tiêu đề</th>
								<th>Ảnh đại diện</th>
								<th>Giới thiệu</th>
								<th>Người viêt</th>
								<th>Người đăng</th>
								<th>Nguồn</th>
								<th>Ngày đăng</th>
								<th>Lượt xem</th>
								<th>Lượt bình luận</th>
								<th>Trạng thái</th>
							</tr>
						</thead>

						<tbody>
	                      <?php
							if (isset($article_list)) {
								foreach ($article_list as $r) {
									echo '<tr>
                                           <td>' . $r -> id . '</td>
                                           <td>' . $r -> title . '</td>
                                           <td><img src="'.base_url(). $r->thumb.'"></td>
                                           <td>' . $r->intro.'</td>
                                           <td>' . $r->author . '</td>
                                           <td>' . $r->user_id.'</td>
                                           <td>' . $r->source.'</td>
                                           <td>' .show_format_vi_date_time( $r->date_post).'</td>
                                           <td>' . $r->views_count.'</td>
                                           <td>' . $r->like_count.'</td>
                                           <td>' .(($r->state ==ACTIVED_STATE)? 'Chấp nhận':'Chờ duyệt') .'</td>
                                           <td><a class="btn btn-info"  href="' . base_url() . 'article/edit/' . $r -> id . '">'.EDIT_LABEL.'</a></td>
                                           <td><a class="btn btn-danger" href="' . base_url() . 'article?action=delete&id=' . $r -> id . '">'.DELETE_LABEL.'</a></td>
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