<script src="<?php echo base_url(); ?>js/jquery.js"></script>
<script src="<?php echo base_url(); ?>player/jwplayer.js"></script>
  <script>
    $(document).ready(function(){
      jwplayer("mediaplayer1").setup({
      'flashplayer': "<?php echo base_url();?>player/player.swf",
      'file': "<?php echo $link; ?>",
      'height': $(window).height(),
      <?php
        if(isset($autoplay) && $autoplay==1){
          echo 'autostart:true,';
        }
        if(isset($thumb)){
          echo 'image:"'.$thumb.'",';
        }
      ?>
      'width': $(window).width(),
      'skin': '<?php echo base_url();?>player/skins/stormtrooper.zip'
      });
    })
   </script>
<div id="mediaplayer1"></div>
