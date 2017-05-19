<script language="javascript">	
	//Common Page Setup
	pageSetUp();
	//Scrollbar style
	//$('#site-nav').perfectScrollbar();
		//Waves ripple effet
		var ripple = function() {
			Waves.attach(".btn"),
			Waves.init({
			duration: 900,
			delay: 300
		}),
		Waves.attach(".nav-wrap .site-nav .nav-list li"),
		Waves.attach(".md-button:not(.md-no-ink)")
	}();
	//mobile navigation
	$('.nav-trigger').click(function(){
		$("#site-nav").toggleClass("nav-offcanvas");
	});
	//Add space in empty td
	$(document).ready(function(){
		$("td:empty").html("&nbsp;");
		$(".nav-trigger").click(function(){
		   $(".site-head").toggleClass("off-cnvs");
		  });
	});
</script>
<script src="<?php echo $this->basePath(); ?>/public/admin/global_js/variables.js"></script>
<script src="<?php echo $this->basePath(); ?>/public/admin/global_js/events.js"></script>
<script src="<?php echo $this->basePath(); ?>/public/admin/global_js/functions.js"></script>
