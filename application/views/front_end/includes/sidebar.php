<?php $path = base_url().'public/';?>

<div id="right-content">
  <ul class="news-hot">
    <h4>Tin Mới</h4>
    <?php
    if ($view != null) {
      for ($i=0; $i <4 ; $i++) { 
       echo '

       <li class="news-hot-1 first-child"> <a href="#"><img src="../resources/images/3.jpg" /></a>
       <div class="text-news-hot">
       <p><a href="#">'.trim_text(htmlspecialchars_decode($view[$i][0] -> title),10).'</a></p>
       <span>'.$view[$i][0] -> date_post.'</span></div>
       </li>
       ';
     }
   }
   ?>
 </ul>
 <!--end news-hot-->
 <div class="news-random">
   <h4>Xem nhiều</h4>
   <div class="blueberry">
    <ul class="slides">
      <?php
      if ($slider_sibar!=null) {
        foreach ($slider_sibar as $r) {
          echo '
          <li><img src="../resources/images/cupcackes.jpg" /></li>';
        }
      }
      ?>

    </ul> 
  </div>

</div>
<!--end news-random-->
<script>
$(window).load(function() {
  $('.blueberry').blueberry();
});
</script>

<div class="top-view">
  <h4>Xem nhiều</h4>
  <div class="view-left">
   <div class="backgroud-number">01</div>
    <img src="../resources/source.png">
   <div class="backgroud-number">02</div>
   <img src="../resources/source.png">
   <div class="backgroud-number">03</div>
   <img src="../resources/source.png">
   <div class="backgroud-number">04</div>
   <img src="../resources/source.png">
   <div class="backgroud-number">05</div>
   <img src="../resources/source.png">
   <div class="backgroud-number">06</div>
   <img src="../resources/source.png">
 </div>
 <div class="view-right">
  <?php
    if ($top_view != null) {
      foreach ($top_view as $r) {
       echo '<div class="text"><a href="#">'.trim_text(htmlspecialchars_decode($r -> title),4).'</a>
    <p><span> '. $r  -> views_count .' luot xem</span></p></div>';
    }
  }
?>
</div>
</div>
<!--end top-view--> 

</div><!--end right-content-->
