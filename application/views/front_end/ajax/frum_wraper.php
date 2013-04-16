 		<?php
 		if ($new!=null) {
 			foreach ($new as $r) {?>
 			<div class="sumary">
 				<div class="image">
 					<img src="<?php echo base_url().$r -> thumb;?>" width="178" height="148">
 					<dd class="tittle"><a href="#"><p><?php echo trim_text(htmlspecialchars_decode($r -> title),10);?></p></a></dd>
 				</div>
 			</div>
 			<?php
 		}
 	}
 	?>