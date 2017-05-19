<!-- CUSTOM NOTIFICATION -->
<script src="<?php echo $this->basePath(); ?>/public/admin/js/notification/SmartNotification.min.js" type="text/javascript"></script>

<!-- JARVIS WIDGETS -->
<script src="<?php echo $this->basePath(); ?>/public/admin/js/smartwidgets/jarvis.widget.min.js" type="text/javascript"></script>

<!-- EASY PIE CHARTS -->
<?php /*?><script src="<?php echo $this->basePath(); ?>/public/admin/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script><?php */?>

<!-- SPARKLINES -->
<?php /*?><script src="<?php echo $this->basePath(); ?>/public/admin/js/plugin/sparkline/jquery.sparkline.min.js"></script><?php */?>

<!-- JQUERY VALIDATE -->
<script src="<?php echo $this->basePath(); ?>/public/admin/js/plugin/jquery-validate/jquery.validate.min.js" type="text/javascript"></script>

<!-- JQUERY MASKED INPUT -->
<script src="<?php echo $this->basePath(); ?>/public/admin/js/plugin/masked-input/jquery.maskedinput.min.js" type="text/javascript"></script>

<!-- JQUERY UI + Bootstrap Slider -->
<?php /*?><script src="<?php echo $this->basePath(); ?>/public/admin/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script><?php */?>

<!-- browser msie issue fix -->
<script src="<?php echo $this->basePath(); ?>/public/admin/js/plugin/msie-fix/jquery.mb.browser.min.js" type="text/javascript"></script>

<!-- FastClick: For mobile devices: you can disable this in app.js -->
<script src="<?php echo $this->basePath(); ?>/public/admin/js/plugin/fastclick/fastclick.min.js" type="text/javascript"></script>

<!-- For demo purpose (change screen layout) -->
<script src="<?php echo $this->basePath(); ?>/public/admin/js/demo.min.js" type="text/javascript"></script>

<!--[if IE 8]>
	<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
<![endif]-->

<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- Voice command : plugin -->
<?php /*?><script src="<?php echo $this->basePath(); ?>/public/admin/js/speech/voicecommand.min.js"></script><?php */?>

<!-- SmartChat UI : plugin -->
<?php /*?><script src="<?php echo $this->basePath(); ?>/public/admin/js/smart-chat-ui/smart.chat.ui.min.js"></script>
<script src="<?php echo $this->basePath(); ?>/public/admin/js/smart-chat-ui/smart.chat.manager.min.js"></script><?php */?>

<!-- Your GOOGLE ANALYTICS CODE Below -->
<?php /*?><script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
  _gaq.push(['_trackPageview']);

  (function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script><?php */?>


<script src="<?php echo $this->basePath(); ?>/public/admin/js/perfect-scrollbar.min.js"></script>
<script src="<?php echo $this->basePath(); ?>/public/admin/js/waves.min.js"></script>

<script language="javascript">
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