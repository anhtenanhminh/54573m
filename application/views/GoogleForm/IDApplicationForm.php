<?php echo $this->load->view('Layout/header'); ?>
<div class="container">
	<div class="row">
		<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSfU4QKIhwnyzC7yLhRVNspcXj0Z71mhvgjBUkWx7tAgLD0z6A/viewform?embedded=true" width="100%" height="4000">Loading ID Application Form ...</iframe>
	</div>
</div>
<script type="text/javascript">
	$("#submit").click(function(){
		$("form").submit();
	});
</script>
<?php echo $this->load->view('Layout/footer');?>