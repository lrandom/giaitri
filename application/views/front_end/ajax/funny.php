 <?php
 if($vl!=null){
           foreach ($vl as $r) {?>
           <div class="img-xu-huong"> 
            <a href="#"> 
              <img src="<?php echo base_url().$r -> thumb ?>" />
              <p><?php echo trim_text(htmlspecialchars_decode($r -> title),10)?></p>
            </a> </div>
            <?php
          }
        }
        ?>