<!-- JQUERY SELECT2 INPUT -->
<script src="<?php echo $this->basePath(); ?>/public/admin/js/plugin/select2/select2.min.js" type="text/javascript"></script>
<script language="javascript">	
	//Common Page Setup
	pageSetUp();
	
	//Add space in empty td
	$(document).ready(function(){
		$("td:empty").html("&nbsp;");
	});
</script>
<script src="<?php echo $this->basePath(); ?>/public/admin/global_js/variables.js"></script>
<script src="<?php echo $this->basePath(); ?>/public/admin/global_js/events.js"></script>
<script src="<?php echo $this->basePath(); ?>/public/admin/global_js/functions.js"></script>
