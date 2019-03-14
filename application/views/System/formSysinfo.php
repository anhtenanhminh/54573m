<?php echo $this->load->view('Layout/header'); ?>
<div class="container">
	<div class="row">
		<h3 class="panel-title">System Information</h3>
		<script type="text/javascript">
		var db = "172.19.41.230";
		document.write("Database: " + db);
		</script>
		<?php echo $db['default']['hostname']?>
		<?php echo phpinfo()?>
	</div>
</div>
<script type="text/javascript">
	$("#submit").click(function(){
		$("form").submit();
	});
</script>
<?php echo $this->load->view('Layout/footer');?>