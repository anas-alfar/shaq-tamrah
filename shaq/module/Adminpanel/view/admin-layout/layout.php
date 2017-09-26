<?php if(isset($_GET['HTTP_REFERER']) && $_GET['HTTP_REFERER'] == 'aula_ajax') { ?>
	<?php echo $this->content; ?>
<?php } else {?>
<?php echo $this->doctype() ?>
<html lang="en">
    <?php include("site_head.php");?>	
    <body id="body-main" class="smart-style-0 desktop-detected">
		<?php include("top_header.php");?>	
			
		<?php include("left_menu.php");?>	
			
		<!-- #MAIN PANEL -->
		<div id="main" role="main">
			<div class="body_overlay_dark hide"></div>
			<div class="common_loader hide"><img src="<?php echo $this->basePath(); ?>/public/img/loading1.gif"></div>
			<?php echo $this->content ?>
		</div>
		<!-- END #MAIN PANEL -->

		<?php include("bottom_footer.php");?>	

		<?php include("site_shortcut_area.php");?>	

		<!--================================================== -->
		<?php include("site_scripts_include.php");?>	

	</body>
</html>
<?php } ?>