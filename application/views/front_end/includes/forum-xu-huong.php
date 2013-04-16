<div id="slider">
	<?php
	if ($forum_xu!=null) {
		foreach ($forum_xu as $r) {?>
		
				<div class="slider-img">
					<div class="img-">
						<img src="<?php echo base_url().$r -> thumb;?>" width="130" height="100" />
					</div>
					<div class="a">
						<a href="#"><?php echo trim_text(htmlspecialchars_decode($r -> title),8);?></a>
					</div>
					<span>Tải lên 20 phút trước</span>
				</div>
				<div class="cleafix">
					<a href="#"></a>
				</div>
				<?php
		}
	}?>
			</div><!--end slider-->