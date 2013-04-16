 <?php
        if($funny!=null){
          foreach ($funny as $r) {?>
          <div class="news-funny"> 
            <a href="#"> <i><img src="<?php echo base_url().$r -> thumb ?>" /></i>
              <h4><?php echo trim_text(htmlspecialchars_decode($r -> title),3)?></h4>
              <p><?php echo trim_text(htmlspecialchars_decode($r -> intro),5)?></p>
            </a> 
          </div>
          <!--end news-funny-->
          <?php
        }
      }
      ?>