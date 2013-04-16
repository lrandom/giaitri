 <div id="xu-huong">
          <script type="text/javascript">
          jQuery(document).ready(function($) {

            function load_slider(data){
              $.ajax({
                type:'post',
                dataType:'html',
                data:data,
                url:'<?php echo base_url()?>home/load_xu_huong',
                beforeSend:function(){
            //dang load cave
          },
          success:function(data){
            //bo anh
            $('#xu-huong').html(data);
          }
        })
            }
            load_slider({data:'video'});
            $('.news-2').click(function(){
              load_slider({data:'news-2'});
            });
            $('.views-2').click(function(){
              load_slider({data:'views-2'});
            });
          });

          </script>
      </div><!--end xu huong-->