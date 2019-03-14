<?php echo $this->load->view('Layout/header'); ?>
<div class="container">
		<div>
		<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSckLyEh5_RYQpZ9dME3nZXcmAZMY8sCu6Xyu3Ir0kGM5KS3dQ/viewform?embedded=true" width="100%" height="1311">Loading Password Reset Form ...</iframe>
		</div>
</div>
<script type="text/javascript">
	$("#submit").click(function(){
		$("form").submit();
	});
</script>
<?php echo $this->load->view('Layout/footer');?>