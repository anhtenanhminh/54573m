<?php echo $this->load->view('Layout/header'); ?>
<div class="container">
	<div class="row">
		<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSenHCosnqVuM3D2EusVKd7ZqbUp6iIF1ZtAEqi2jBr4MV5uKA/viewform?embedded=true" width="100%" height="1840">Loading Group Address Creation Form ...</iframe>
	</div>	
</div>
<script type="text/javascript">
	$("#submit").click(function(){
		$("form").submit();
	});
</script>
<?php echo $this->load->view('Layout/footer');?>