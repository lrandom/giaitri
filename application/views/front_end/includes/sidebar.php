<?php $path = base_url().'public/';?>

<div id="right-content">
  <ul class="news-hot">
    <h4>Tin Mới</h4>
    <?php
    if ($new!=null) {
     foreach ($new as $r) {
       echo '
       <li class="news-hot-1 first-child"> <a href="#"><img src="<?php echo $path ;?>img/cn/right-content/news-hot/img-news-hot.png" /></a>
       <div class="text-news-hot">
       <p><a href="#">'.$r -> author .'</a></p>
       <span>'.$r-> date_post .'  | <a href="#">'.$r-> name .'</a></span> </div>
       </li>

       <!--end news-hot-1-->
       '; 
     }
   }
   ?>         </ul>
   <!--end news-hot-->
   <div class="news-random">
     <h4>Xem nhiều</h4>
     <div class="blueberry">
      <ul class="slides">
        <li><img src="<?php echo $path ;?>images/1.jpg" /></li>
        <li><img src="<?php echo $path ;?>images/2.jpg" /></li>
        <li><img src="<?php echo $path ;?>images/3.jpg" /></li>
        <li><img src="<?php echo $path ;?>images/4.jpg" /></li>
      </ul> 
    </div>
    <li style='margin-left: 35px;'><a href="#">cung ngawms nhin</a></li>
  </div>
  <!--end news-random-->
  <script>
  $(window).load(function() {
    $('.blueberry').blueberry();
  });
  </script>

  <div class="top-view">
    <h4>Xem nhiều</h4>
    <ul class="news-top-view ul-first-child">
      <h1>01</h1>
      <img src="<?php echo $path ;?>img/cn/right-content/news-random/source.png" /> <a href="#">Tranh vui: Mẹ già trở lại</a>
      <p>1200 lượt xem</p>
    </ul>
    <!--end news-top-view-->

    <ul class="news-top-view">
      <h1>02</h1>
      <img src="<?php echo $path ;?>img/cn/right-content/news-random/source.png" /> <a href="#">Tranh vui: Mẹ già trở lại</a>
      <p>1200 lượt xem</p>
    </ul>
    <!--end news-top-view-->

    <ul class="news-top-view">
      <h1>03</h1>
      <img src="<?php echo $path ;?>img/cn/right-content/news-random/source.png" /> <a href="#">Tranh vui: Mẹ già trở lại</a>
      <p>1200 lượt xem</p>
    </ul>
    <!--end news-top-view-->

    <ul class="news-top-view">
      <h1>04</h1>
      <img src="<?php echo $path ;?>img/cn/right-content/news-random/source.png" /> <a href="#">Tranh vui: Mẹ già trở lại</a>
      <p>1200 lượt xem</p>
    </ul>
    <!--end news-top-view-->

    <ul class="news-top-view">
      <h1>05</h1>
      <img src="<?php echo $path ;?>img/cn/right-content/news-random/source.png" /> <a href="#">Tranh vui: Mẹ già trở lại</a>
      <p>1200 lượt xem</p>
    </ul>
    <!--end news-top-view-->

    <ul class="news-top-view">
      <h1>06</h1>
      <img src="<?php echo $path ;?>img/cn/right-content/news-random/source.png" /> <a href="#">Tranh vui: Mẹ già trở lại</a>
      <p>1200 lượt xem</p>
    </ul>
    <!--end news-top-view--> 

  </div>
  <!--end top-view--> 

</div><!--end right-content-->
