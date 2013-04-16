 <div id="news">
 	<div id="Top-content">
 		<?php
 		if ($forum_slider!=null) {

 			foreach ($forum_slider as $r) {?>
 			<div class="slider">
 				<img src="<?php echo base_url().$r -> thumb ; ?>"  width="340" height="240"/>
 				<div class="believe">
 					<a href="#"><h5><?php echo trim_text(htmlspecialchars_decode($r -> title),10) ?></h5></a>
 					<p><?php echo trim_text(htmlspecialchars_decode($r -> intro),30) ?></p>
 					<?php
 				}}?>
 				<?php
 				if ($forum_slider!=null) {
 					foreach ($forum_title as $r) {?>
 					<ul>
 						<li><a href="#"><b>>></b> <?php echo trim_text(htmlspecialchars_decode($r -> title),10) ?> </a></li>
 					</ul>
 					<?php
 				}
 			}?>


 		</div><!--end slider-->
 		<div class="img-active">
 			<?php
 			if ($forum_img!=null) {
 				foreach ($forum_img as $r) {?>
 				<div class="ac">
 					<div class="img-1">
 						<a href="#"></a><img src="<?php echo base_url().$r -> thumb ;?>" width="145" height="100"></a>
 					</div>
 					<a href="#"><?php echo trim_text(htmlspecialchars_decode($r -> title),10) ?></a>
 				</div>
 				<?php
 			}
 		}
 		?>
 	</div><!--end img-active-->
 </div><!--end Top-content-->
</div>