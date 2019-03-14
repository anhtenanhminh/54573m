<?php echo $this->load->view('Layout/header'); ?>
<div class="container">
	<div class="row">
		<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSeZfRzt6YjZ_SpfqQjN-D8BIZlM-LVXmiZiKBOUBgij9ipZBw/viewform?embedded=true" width = "100%" height = "900">Loading Hopslite ...</iframe>
	</div>
</div>
<script type="text/javascript">
	$("#submit").click(function(){
		$("form").submit();
	});
</script>
<?php echo $this->load->view('Layout/footer');?>