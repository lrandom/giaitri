<div id="funny">
         <script type="text/javascript">
          jQuery(document).ready(function($) {

            function load_slider(data){
              $.ajax({
                type:'post',
                dataType:'html',
                data:data,
                url:'<?php echo base_url()?>home/load_funy',
                beforeSend:function(){
            //dang load cave
          },
          success:function(data){
            //bo anh
            $('#funny').html(data);
          }
        })
            }
            load_slider({data:'video'});
            $('.news-3').click(function(){
              load_slider({data:'news-3'});
            });
            $('.views-3').click(function(){
              load_slider({data:'views-3'});
            });
          });

          </script>
    </div>
    <!--end funny-->
     
     </div>
  <!--end news--> 
</div>
    <!--end left-content-->
