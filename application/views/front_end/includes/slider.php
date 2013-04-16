 <script type="text/javascript">
    $(function() {
        $(".slider").jCarouselLite({
            btnNext: ".next",
            btnPrev: ".prev",
            visible: 5
        });
    });

    $(document).ready(function(){
      $('img.captify').captify({
        // all of these options are... optional
        // ---
        // speed of the mouseover effect
        speedOver: 'fast',
        // speed of the mouseout effect
        speedOut: 'normal',
        // how long to delay the hiding of the caption after mouseout (ms)
        hideDelay: 1000, 
        // 'fade', 'slide', 'always-on'
        animation: 'slide',   
        // text/html to be placed at the beginning of every caption
        prefix: '',   
        // opacity of the caption on mouse over
        opacity: '0.7',         
        // the name of the CSS class to apply to the caption box
        className: 'caption-bottom',  
        // position of the caption (top or bottom)
        position: 'bottom',
        // caption span % of the image
        spanWidth: '100%'
      });
    });

  </script>
   <div id="list">
      <a href="#"><div class="prev"></div></a>
      <div class="slider">
        <ul>
          <li> <a href="#" title=""><img src="resources/images/1.jpg" alt="Title 1" class="captify" />
            <div class="text">
            <h4>Đánh Cầu Lông</h4>
            <p><span>52556 </span>người chơi</p>
          </div>
            </a> </li>
          <li> <a href="#" title=""><img src="resources/images/2.jpg" alt="Title 2" class="captify" />
            <div class="text">
            <h4>Đánh Cầu Lông</h4>
            <p><span>52556 </span>người chơi</p>
          </div>
            </a> </li>
          <li> <a href="#" title=""><img src="resources/images/3.jpg" alt="Title 3" class="captify" />
            <div class="text">
            <h4>Đánh Cầu Lông</h4>
            <p><span>52556 </span>người chơi</p>
          </div>
            </a> </li>
          <li> <a href="#" title=""><img src="resources/images/4.jpg" alt="Title 4" class="captify" />
            <div class="text">
            <h4>Đánh Cầu Lông</h4>
            <p><span>52556 </span>người chơi</p>
          </div>
            </a> </li>
          <li> <a href="#" title=""><img src="resources/images/5.jpg" alt="Title 5" class="captify" />
            <div class="text">
            <h4>Đánh Cầu Lông</h4>
            <p><span>52556 </span>người chơi</p>
          </div>
            </a> </li>
          <li> <a href="#" title=""><img src="resources/images/6.jpg" alt="Title 6" class="captify" />
            <div class="text">
            <h4>Đánh Cầu Lông</h4>
            <p><span>52556 </span>người chơi</p>
          </div>
            </a> </li>
          <li> <a href="#" title=""><img src="resources/images/7.jpg" alt="Title 7" class="captify" />
            <div class="text">
            <h4>Đánh Cầu Lông</h4>
            <p><span>52556 </span>người chơi</p>
          </div>
            </a> </li>
        </ul>
      </div>
     <a href="#"> <div class="next"></div></a>
    </div>
  </div><!--end content-->
