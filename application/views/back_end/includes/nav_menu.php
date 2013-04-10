	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
				<a class="brand" href="#">Administrator</a>

				<div class="nav-collapse collapse">

                   <!-- Load user box -->
					<?php
					 $CI =& get_instance();
				     $CI->load->view('back_end/includes/user_box');
					?>
					
					<ul class="nav">
						<li class="active dropdown">
							<a href="<?php echo base_url() ?>article" >Bài đăng <span class="badge badge-info">8</span></a>

						</li>

						<li class="dropdown">
							<a href="<?php echo base_url() ?>admin/category">Chuyên mục</a>
						</li>

						<li class="dropdown">
							<a href="#about">Vai trò & người dùng</a>
							<ul class="dropdown-menu">
								<li>
									<a href="<?php echo base_url()?>admin/role"> Vai trò & quyền</a>
								</li>
								<li>
									<a href="<?php echo base_url()?>admin/func"> Chức năng</a>
								</li>
								<li>
									<a href="<?php echo base_url()?>user"> Người dùng</a>
								</li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="<?php echo base_url() ?>admin/comment">Bình luận</a>
						</li>

						<li>
							<a href="<?php echo base_url()?>admin/logo">Logo</a>
						</li>

						<li>
							<a href="<?php echo base_url()?>admin/adverstment">Quảng cáo</a>
						</li>
						<li>
							<a href="<?php echo base_url() ?>admin/file_manager">File</a>
						</li>
						<li>
							<a href="<?php echo base_url() ?>admin/setting">Cài đặt</a>
						</li>
						<li>
							<a href="#">Thống kê google</a>
						</li>

					</ul>
				</div>
				<!--/.nav-collapse -->

			</div>
		</div>
	</div>
	<!--end nav bar-->
