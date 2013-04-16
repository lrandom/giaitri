<div id="news">
<div id="featured"> 
    
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
          $('.most_news').click(function(){
            load_slider({data:'most_news'});
          });
          $('.most_views').click(function(){
            load_slider({data:'most_views'});
          });
        });
          
        </script>
        </div>