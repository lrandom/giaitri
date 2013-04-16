	<?php
	if ($forum_funny!=null) {
		foreach ($forum_funny as $r) {?>
				<div class="Folk">
					<div class="img-folk">
						<img src="<?php echo base_url().$r -> thumb;?>" width="130" height="130" />
					</div>
					<div class="for-iteam">
						<a href="#"><h5><?php echo trim_text(htmlspecialchars_decode($r -> title),5);?> <m>(13:48 04/01/2013)</m></h5></a><span>Đăng bởi <m>Trần Tuấn Dũng</m></span>
						<p><?php echo trim_text(htmlspecialchars_decode($r -> intro),20);?></p>
						<a href="#"><i>Xem tiếp...</i></a>
					</div>
				</div>
				<?php
			}}?>