<div id="Wrapper">
  <script type="text/javascript">
  jQuery(document).ready(function($) {

    function load_slider(data){
      $.ajax({
        type:'post',
        dataType:'html',
        data:data,
        url:'<?php echo base_url()?>home/load_beet_slider',
        beforeSend:function(){
        },
        success:function(data){
            //bo anh
            $('#Wrapper').html(data);
          }
        })
    }
    load_slider({data:'video'});
    $('.news').click(function(){
      load_slider({data:'news'});
    });
    $('.views').click(function(){
      load_slider({data:'views'});
    });
  });

  </script>

        </div><!--end Wrapper-->
        