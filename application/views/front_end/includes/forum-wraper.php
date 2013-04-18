<div id="cat">

</div><!--end Wrapper-->

<script type="text/javascript">
jQuery(document).ready(function($) {
	var first=0;
	var offset=9;

	function load_slider(data){
		$.ajax({
			type: "POST",
			dataType:'html',
			data : data,
			url: '<?php echo base_url()?>category/load_new',
			success: function(data){
				$("#cat").html(data);
			}
		});

	}

	load_slider({first:first,offset:offset});

	$('.button').click(function(){
		first+=offset;
        load_slider({first:first,offset:offset});
	});
});
</script>

<div class="button" style="cursor:pointer">
	<img src="<?php echo base_url() ?>resources/button.png" /><b>Xem Thêm</b>
</div><!--end button-->

