  <ul class="ui-tabs-nav">
            <?php
            if ($focus_new != null) {
              foreach ($focus_new as $r) {?>
              <li class="ui-tabs-nav-item" id="nav-fragment-<?php echo $r -> id ?>">
                <a href="#fragment-<?php echo $r -> id ?>">
                  <img src="<?php echo base_url().$r -> thumb ?>" width="167" height="145" />
                  <span><?php echo trim_text(htmlspecialchars_decode($r -> title),10) ?></span>
                </a>
              </li>

              <?php
            }
          }
          ?>
        </ul>
        <!-- First Content -->
        <?php
        if ($focus_new != null) {
         foreach ($focus_new as $r) {?>
          <div id="fragment-<?php echo $r -> id ?>" class="ui-tabs-panel ui-tabs-hide" style="">
          <img src=" <?php echo base_url(). $r -> thumb ?> "  width="460" height="434"/>
          <div class="info" >
          <h2><a href="#" ><?php echo trim_text(htmlspecialchars_decode($r -> title),10) ?></a></h2>
          <p><?php echo trim_text(htmlspecialchars_decode($r -> content),10)?>
          <a href="#"  style="color:red";>Read more</a>      
          </p>
          </div>
          </div>
          <?php
        }
      }
      ?>
       <script type="text/javascript">
  $(document).ready(function(){
    $("#featured > ul").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
  });
  </script>