  
          <ul class="ui-tabs-nav">
            <?php
            if ($focus_new != null) {
              foreach ($focus_new as $r) {?>
              <li class="ui-tabs-nav-item" id="nav-fragment-<?php echo $r -> id ?>">
                <a href="#fragment-<?php echo $r -> id ?>">
                  <img src="resources/images/1.jpg" width="167" height="145" />
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
         foreach ($focus_new as $r) {
          echo '
          <div id="fragment-'. $r -> id .'" class="ui-tabs-panel ui-tabs-hide" style="">
          <img src="resources/images/2.jpg"  width="460" height="434"/>
          <div class="info" >
          <h2><a href="#" >'.trim_text(htmlspecialchars_decode($r -> title),10).'</a></h2>
          <p>'.trim_text(htmlspecialchars_decode($r -> content),10).'
          <a href="#"  style="color:red";>Read more</a>      
          </p>
          </div>
          </div>'
          ;
        }
      }
      ?>
       <script type="text/javascript">
  $(document).ready(function(){
    $("#featured > ul").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
  });
  </script>