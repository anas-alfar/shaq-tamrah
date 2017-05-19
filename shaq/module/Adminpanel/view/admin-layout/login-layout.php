<!DOCTYPE html>
<html lang="en-us" id="lock-page">
	<?php include("site_head.php");?>
	<link rel="stylesheet" href="<?php echo $this->basePath(); ?>/public/admin/css/lockscreen.min.css">
	
	<body>

		<div id="main" role="main">

			<!-- MAIN CONTENT -->

			<form id="loginForm" class="lockscreen animated flipInY smart-form" action="#">
				<div class="logo">
					<h1 class="semi-bold"><img src="<?php echo $this->basePath(); ?>/public/admin/img/logo-o.png" alt="" /> SmartAdmin</h1>
				</div>
				<div>
					<div>
						<h1>Login Here</h1>

						<div class="form-group formlogin">
							<label class="control-label">Username</label>
							<label class="input"> <i class="icon-append fa fa-user"></i>
							<input class="form-control" type="text" placeholder="Username" name="login_name" id="login_name">
							</label>
						</div>
						<p></p>
						<div class="form-group formlogin">
							<label class="control-label">Password</label>
							<label class="input"> <i class="icon-append fa fa-lock"></i>
							<input class="form-control" type="password" placeholder="Password" name="login_password" id="login_password">
							
						</div>
						<div>
							<button type="submit" class="btn btn-primary singinbtn">
								Sign in
							</button>
						</div>	
						
					</div>

				</div>
				<p class="font-xs margin-top-5">
					Copyright SmartAdmin 2014-2020.

				</p>
			</form>

		</div>
<?php include("global_include.php");?>
<?php include("site_scripts_include.php");?>
		
<script language="javascript">	
					
	function loginfrmFormData()
	{				
		var $form = $('#loginForm');
		var objMasterData = $form.serializeObject();					
		objMasterData = JSON.stringify(objMasterData);
		
		var objFormData =
		{
			pAction    : strActionMode,
			FORM_DATA: objMasterData
		};
						
		var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/login',['action' => 'dologin']); ?>", objFormData);
		if (objMyPost.ERR_NO === 0) 
		{
			if (objMyPost.DATA.DBStatus === 'OK')
			{ //strActionMode = "EDIT";//
				mySmallAlert('Success...', 'Login successfully', 1);
				$("#login_name").val('');
				$("#login_password").val('');
				window.location.href="<?php echo $this->url('adminpanel', ['action' => 'index']);?>";
			}
			if (objMyPost.DATA.DBStatus === 'ERR')
			{ 						
				mySmallAlert('Error...!', objMyPost.DATA.DBMsg, 0);											
			}				
		}
		else {
			mySmallAlert('Error...!', 'There was an error', 0);
		}
		
	}
	
	var pagefunction = function() { 
	
	$('#loginForm').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				login_name: {
                    validators: {
                       notEmpty : {
								message : 'Please enter username'
							}
                        }
                    },
				login_password : {
						validators : {
							notEmpty : {
								message : 'Please enter password'
							}
						}
					}
				}	
		})
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			loginfrmFormData();
		}); 
	
	}
	loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/bootstrapvalidator/bootstrapValidator.min.js", pagefunction);
</script>
	</body>
</html>