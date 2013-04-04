<?php
  if(isset($_SESSION[LOGIN_KEY_SESSION])){
    $data=$_SESSION[LOGIN_KEY_SESSION];
?>
<ul class="nav pull-right">
    <li >
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Xin chào <?php echo $data[0]->user_name;?>
			<b class="caret"></b>
	    </a>
		<ul class="dropdown-menu">
			<li>
				<a>Thay đổi thông tin cá nhân</a>
			</li>
			<li>
				<a>Thay đổi mật khẩu</a>
			</li>
			<li>
				<a href="<?php echo base_url()?>dash/log_out">Thoát</a>
			</li>
		</ul>
	</li>
</ul>
<?php
  }
?>
