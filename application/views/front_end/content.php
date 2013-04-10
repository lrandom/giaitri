<?php $path = base_url();?>
<div id="container">
  <div id="content">
    <div id="left-content">
      <div id="menu-content">
        <ul class="ul-news-top">
          <li><a href="#">Video</a></li>
          <li class='most_news'><a href="#">Mới nhất</a></li>
          <li class='most_views'><a href="#">Xem nhiều</a></li>
        </ul>
        <ul class="ul-news-top" id="img-fun">
          <li><a href="#">Ảnh Vui</a></li>
          <li><a href="#">Mới nhất</a></li>
          <li><a href="#">Xem nhiều</a></li>
        </ul>
        <ul class="ul-news-top" id="ul-xu-huong">
          <li><a href="#">Xu Hướng</a></li>
          <li><a href="#">Mới nhất</a></li>
          <li><a href="#">Xem nhiều</a></li>
        </ul>
        <ul class="ul-news-top" id="ul-funny">
          <li><a href="#">Cười</a></li>
          <li><a href="#">Mới nhất</a></li>
          <li><a href="#">Xem nhiều</a></li>
        </ul>
      </div>
      <!--end menu-content-->
      <div id="news">
        <script type="text/javascript">
        jQuery(document).ready(function($) {

          function load_slider(data){
            $.ajax({
              type:'post',
              dataType:'html',
              data:data,
              url:'<?php echo base_url()?>home/load_top_slider',
              beforeSend:function(){
            //dang load cave
          },
          success:function(data){
            //bo anh
            $('#featured').html(data);
          }
        })
          }
          load_slider({data:'video'});
          $('.most_news > a').click(function(){
            load_slider({data:'most_news'});
          });
          $('.most_views > a').click(function(){
            load_slider({data:'most_views'});
          });
        });

        </script>
        <div id="featured"> 

        </div>

        <div id="Wrapper">
          <?php
          $index=0;
          if($new_img!=null){
            foreach ($new_img as $r) {
              echo '<div class="sumary">
              <div class="image">
              <img src="resources/images/1.jpg" width="178" height="148">
              <dd class="tittle">
              <a href="#"><p>'.$r -> title.'</p></a></dd>
              </div>
              </div>';
            }
          }
          $index++;
          ?>

        </div><!--end Wrapper-->
        <div id="xu-huong">
          <?php
          if($xu_huong!=null){
           foreach ($xu_huong as $r) {
            echo '

            <div class="img-xu-huong"> 
            <a href="#"> 
            <img src="resources/images/2.jpg" />
            <p>'.$r -> title.'</p>
            </a> </div>
            ';
          }
        }
        ?>
      </div><!--end xu huong-->

      <div id="funny">
        <?php
        if($funny!=null){
          foreach ($funny as $r) {
            echo ' <div class="news-funny"> 
            <a href="#"> <i><img src="resources/images/3.jpg" /></i>
            <h4>'.$r -> source.'</h4>
            <p>'.$r -> title.'</p>
            </a> 
            </div>
            <!--end news-funny-->
            ';   }
          }
          ?>

        </div>
        <!--end funny--> 

      </div>
      <!--end news--> 

    </div>
    <!--end left-content-->