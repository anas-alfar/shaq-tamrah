<section id="widFormDetail" class="hide">	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Beneficiary Details Info </h2>
					<div class="widget-toolbar">
								
								<button id="btnBackFromSteps" type="button" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<?php /*?><button id="btnSave" type="submit" class="right btn btnSave  addEventBtn ">
									   <i class="fa fa-floppy-o"></i> &nbsp;Save
							    </button><?php */?>
					</div>
				</header>
				<div>
					<div class="widget-body" id="beneficiary-tabs">				  
						<div class="clear"></div>
						  <div class="tabbable tabs-left">
								<ul class="nav nav-tabs" id="beneficiryDetailSteps" style="margin-bottom: 20px;">
								  <li id="ap_details"><a href="#basic_detail" data-toggle="tab">Basic Details<i class="fa fa-spinner fa-right"></a></i></li>
								  <li id="ap_family"><a href="#family_detail" data-toggle="tab">Family Details<i class="fa fa-ban fa-right"></a></i></li>
								  <li id="ap_family_flag"><a href="#family_extra_detail" data-toggle="tab">Family Extra Details<i class="fa fa-ban fa-right"></a></i></li>
								  <li id="ap_income"><a href="#income_detail" data-toggle="tab" >Income Details<i class="fa fa-ban fa-right"></a></i></li>
								  <li id="ap_spending"><a href="#spending_detail" data-toggle="tab">Spending Details<i class="fa fa-ban fa-right"></a></i></li>
								  <li id="ap_home"><a href="#home_detail" data-toggle="tab">Home Details<i class="fa fa-ban fa-right"></a></i></li>
								  <li id="ap_asset"><a href="#all_owned_assets" data-toggle="tab">All Owned Assets<i class="fa fa-ban fa-right"></a></i></li>
								  <li id="ap_asset_required"><a href="#all_required_assets" data-toggle="tab">All Required Assets<i class="fa fa-ban fa-right"></a></i></li>
								  <li id="ap_disabled"><a href="#disabled_detail" data-toggle="tab">Disabled Details<i class="fa fa-ban fa-right"></a></i></li>
								  <li id="ap_medical"><a href="#medical_condition" data-toggle="tab">Medical Conditions<i class="fa fa-ban fa-right"></a></i></li>
								  <li id="ap_medical_examination"><a href="#medical_extra_detail" data-toggle="tab">Medical Extra Details<i class="fa fa-ban fa-right"></a></i></li>
								  <li id="ap_education"><a href="#education_detail" data-toggle="tab">Education Details<i class="fa fa-ban fa-right"></a></i></li>
								  <li id="ap_volunteer"><a href="#lay_reader_detail" data-toggle="tab">Lay Reader Details<i class="fa fa-ban fa-right"></a></i></li>
								  <li id="ap_gallery"><a href="#media_gallery" data-toggle="tab">Media Gallery<i class="fa fa-ban fa-right"></a></i></li>
								  <li id="ap_research_notes"><a href="#research_notes" data-toggle="tab">Researcher Notes<i class="fa fa-ban fa-right"></a></i></li>
								</ul>
									<fieldset>
										<div class="panel panel-hovered panel-stacked mb30">
											<div class="panel-body pt0">
												<div class="tab-content">
													 <?php include("basic_detail.php");?>
													 <?php include("family_detail.php");?>
													 <?php include("family_extra_detail.php");?>
													 <?php include("income_detail.php");?>
													 <?php include("spending_detail.php");?>
													 <?php include("home_detail.php");?>
													 <?php include("all_owned_assets.php");?>
													 <?php include("all_required_assets.php");?>
													 <?php include("disabled_detail.php");?>
													 <?php include("medical_condition.php");?>
													 <?php include("medical_extra_detail.php");?>
													 <?php include("education_detail.php");?>
													 <?php include("lay_reader_detail.php");?>
													 <?php include("media_gallery.php");?>
													 <?php include("research_notes.php");?>												 
												</div>
											</div>
										</div>
									</fieldset>
								</form>
						  </div> 		
					   </div>
				</div>
			  </div>
		</div>
	</div>
</section>	
<script language="javascript">
	var iActiveDetailID;
	var lastTabKey1='';
	function loadJsForDetailForm()
	{
		$("#beneficiryDetailSteps > li").each(function(){
			 $(this).click(function(e){			 	
				 e.preventDefault();				 
				 if($(this).hasClass('disabled'))
				 {
					return false;
				 }
			 });
		});
		basicDetailJsFunctions();
		familyDetailJsFunctions();
		familyExtraDetailJsFunctions();
		incomeDetailJsFunctions();
		spendingDetailJsFunctions();
		homeDetailJsFunctions();
		allOwnedAssetsJsFunctions();
		allRequiredAssetsJsFunctions();
		disabledDetailJsFunctions();
		medicalConditionJsFunctions();
		medicalExtraDetailJsFunctions();
		educationDetailJsFunctions();
		layReaderDetailJsFunctions();
		researcherNotesJsFunctions();
		mediaGalleryJsFunctions();
	}
	function callNextTab(currentTabID)
	{		
		var nextTab;				 	
		var isCurrent = false;
		if(currentTabID == lastTabKey1)
		{
			
			visibleControl('widGrid', true);
			visibleControl('widFormDetail', false);
			fetch_grid_data();
			
		}
		$("#beneficiryDetailSteps > li").each(function(){
			if(isCurrent == true)
			{
				if(!($(this).hasClass('hide')))
				{
					nextTab = $(this).find('a');
					$(this).removeClass('disabled');
					nextTab.find('i').removeClass('fa-ban').addClass('fa-spinner');
					nextTab.trigger('click');
					isCurrent = false;
				}
			}				 
			if($(this).find('a').attr('href') == '#'+currentTabID)
			{
				isCurrent = true;				
				$(this).find('a').find('i').removeClass('fa-spinner').addClass('fa-check');
				$(this).addClass('bg-success');
			}
			 
		});
	}
	function showProfileDetailTabs(ALLOWED_PROFILE_LIST)
	{
		hideShowLoaderActive(true);
		$("#beneficiryDetailSteps > li").each(function(){
			 $(this).removeClass('active').removeClass('disabled').addClass('hide');
		});
	
		var isFirstActivated = false;
		$.each(ALLOWED_PROFILE_LIST, function(key, value) {
			if(value == 'Yes')
			{
				if(isFirstActivated == false){
					isFirstActivated = true;
					$("#ap_"+key).removeClass('hide');
					$("#ap_"+key).find('a').trigger('click');
				}
				else {
					$("#ap_"+key).addClass('disabled').removeClass('hide');
				}
				if(key != 'published')
				{
					lastTabKey1=key	;
				}
				getStepData(key);					
			}
		});
		hideShowLoaderActive(false);
	}
	function resetFormLocales(formID,tabID)
	{			
		clearForm(formID);
		$('#'+formID).bootstrapValidator("resetForm",true);    
		$('#'+tabID+' a:first').tab('show').trigger('click');
	}
	function resetFormSimple(formID)
	{		
		clearForm(formID);
		$('#'+formID).bootstrapValidator("resetForm",true);   		
	}
	function populateFamilyDP()
	{			 
		var profile_family=$("#frmFamilyExtraDetail").find("#beneficiary_profile_family_id");
		var profile_family1=$("#frmDisabledDetail").find("#beneficiary_profile_family_id");
		var profile_family2=$("#frmMedicalCondition").find("#beneficiary_profile_family_id");
		var profile_family3=$("#frmMedicalExtraDetail").find("#beneficiary_profile_family_id");
		var profile_family4=$("#frmEducationDetail").find("#beneficiary_profile_family_id");
		var profile_family5=$("#frmMediaGallery").find("#beneficiary_profile_family_id");
		var profile_family6=$("#frmMediaYoutubeGallery").find("#beneficiary_profile_family_id");
		var objData = { beneficiaryID : beneficiaryID };
		var profile_family_array=[profile_family,profile_family1,profile_family2,profile_family3,profile_family4,profile_family5,profile_family6];
		populateDependentOptionValuesObjectBulk(profile_family_array,"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getFamilyDetail'));?>","Select Beneficiary Profile Family",objData);		
	}
	function getStepData(step)
	{
		switch(step)
		{
			case 'details' :
				setStepFormData('frmBasicDetail',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getBasicDetail'));?>");
				break;
			case 'family' :
				fetch_grid_data_familyDetail();
				break;
			case 'family_flag' :
				fetch_grid_data_familyExtraDetail();
				break;
			case 'income' :
				fetch_grid_data_incomeDetail();
				break;
			case 'spending' :
				fetch_grid_data_spendingDetail();
				break;
			case 'home' : 
				setStepFormData('frmHomeDetail',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getHomeDetail'));?>");
				break;
			case 'asset' :
				fetch_grid_data_allOwnedDetail();
				break;
			case 'asset_required' :
				fetch_grid_data_allRequiredAssets();
				break;
			case 'education' :
				fetch_grid_data_educationDetail();
				break;
			case 'medical' :
				fetch_grid_data_medicalCondition();
				break;
			case 'medical_examination' :
				fetch_grid_data_medicalExtraDetail();
				break;
			case 'disabled' :
				fetch_grid_data_disabledDetail();
				break;
			case 'volunteer' :
				setStepFormData('frmLayReaderDetail',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getLayReaderDetail'));?>");
				break;
			case 'gallery' :
				fetch_grid_data_mediaGallery();
				fetch_grid_data_mediaYoutubeGallery();
				break;
			case 'research_notes' :
				setStepFormData('frmResearcherNotes',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getResearchNotes'));?>");
				break;
			default :
				return;
		}
	}
</script>