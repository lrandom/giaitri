<div id="Sibar">
<script type="text/javascript">
jQuery(document).ready(function($) {
	var first=0;
	var offset=4;

	function load_slider(data){
		$.ajax({
			type: "POST",
			dataType:'html',
			data : data,
			url: '<?php echo base_url()?>c_forum/load_new_funny',
			success: function(data){
				$("#Sibar").html(data);
			}
		});

	}

	load_slider({first:first,offset:offset});

	$('.button-1').click(function(){
		first+=offset;
		load_slider({first:first,offset:offset});
	});
});
</script>
</div><!--end sibar-->

<div class="button-1" style="cursor:pointer">
	<img src="resources/button.png" /><b>Xem Thêm</b>
</div><!--end button-->

</div><!--end Content-->
</div>


