<head>
        <meta charset="utf-8">
        <?php echo $this->headTitle('Shaq Tamrah Adminpanel')->setSeparator(' - ')->setAutoEscape(false) ?>

        <?php echo $this->headMeta()
            ->appendName('viewport', 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no')
            ->appendHttpEquiv('X-UA-Compatible', 'IE=edge')
        ?>
		
		<!-- Le styles -->
        <?php echo $this->headLink(['rel' => 'shortcut icon', 'type' => 'image/vnd.microsoft.icon', 'href' => $this->basePath() . '/public/admin/img/favicon/favicon.ico'])
            ->prependStylesheet($this->basePath('public/admin/css/custom-style.css'))
			->prependStylesheet($this->basePath('public/admin/css/demo.min.css'))
			->prependStylesheet($this->basePath('public/admin/css/waves.css'))
            ->prependStylesheet($this->basePath('public/admin/css/smartadmin-rtl.min.css'))	
			->prependStylesheet($this->basePath('public/admin/css/smartadmin-skins.min.css'))	
            ->prependStylesheet($this->basePath('public/admin/css/smartadmin-production.min.css'))
            ->prependStylesheet($this->basePath('public/admin/css/smartadmin-production-plugins.min.css'))	
            ->prependStylesheet($this->basePath('public/admin/css/font-awesome.min.css'))
            ->prependStylesheet($this->basePath('public/admin/css/bootstrap.min.css'))
        ?>			
		
		<!-- #GOOGLE FONT -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		<!-- #APP SCREEN / ICONS -->
		<!-- Specifying a Webpage Icon for Web Clip 
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
		<link rel="apple-touch-icon" href="<?php echo $this->basePath(); ?>/public/admin/img/splash/sptouch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $this->basePath(); ?>/public/admin/img/splash/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $this->basePath(); ?>/public/admin/img/splash/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $this->basePath(); ?>/public/admin/img/splash/touch-icon-ipad-retina.png">
		
		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		
		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="<?php echo $this->basePath(); ?>/public/admin/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="<?php echo $this->basePath(); ?>/public/admin/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="<?php echo $this->basePath(); ?>/public/admin/img/splash/iphone.png" media="screen and (max-device-width: 320px)">
		
		<!-- #PLUGINS -->
		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="<?php echo $this->basePath(); ?>/public/admin/js/libs/jquery-2.1.1.min.js" type="text/javascript"><\/script>');
			}
		</script>
		
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="<?php echo $this->basePath(); ?>/public/admin/js/libs/jquery-ui-1.10.3.min.js" type="text/javascript"><\/script>');
			}
		</script>
		
		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)
		<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?php echo $this->basePath(); ?>/public/admin/js/plugin/pace/pace.min.js"></script>-->
		
		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
		<script src="<?php echo $this->basePath(); ?>/public/admin/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js" type="text/javascript"></script> 
		
		<!-- BOOTSTRAP JS -->
		<script src="<?php echo $this->basePath(); ?>/public/admin/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>		
		
		<!-- BOOTSTRAP wizard -->
		
		
		<!-- IMPORTANT: APP CONFIG -->
		<script language="javascript">
			var navAjaxMainUrl = '<?php echo $this->url('adminpanel',['action' => 'index']); ?>';
		</script>
		
		<script src="<?php echo $this->basePath(); ?>/public/admin/js/app.config.js" type="text/javascript"></script>

		<!-- MAIN APP JS FILE -->
		<script src="<?php echo $this->basePath(); ?>/public/admin/js/app.min.js" type="text/javascript"></script>


    </head>