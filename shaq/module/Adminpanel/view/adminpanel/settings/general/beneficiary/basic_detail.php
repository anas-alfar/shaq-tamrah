<div class="tab-pane active" id="basic_detail">
	<div class="tabs-main-heading">	
	<span class="tabs-title">Basic Detail Info </span>
	<button id="btnSaveBasicDetail" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Next
	</button>
	</div>
	<section>	
	<form id="frmBasicDetail" name="frmBasicDetail">
	<div class="tab-content">
		<div class="row">
			<section class="col-md-6">
				<div class="form-group">
					<label class="control-label">Number of Sons<span>*</span></label>
						<input type="number" class="form-control" name="number_of_sons" id="number_of_sons"/>
				</div>	
			</section>
			<section class="col-md-6">
				<div class="form-group">
					<label class="control-label">Number of Daughters<span>*</span></label>
						<input type="number" class="form-control" name="number_of_daughters" id="number_of_daughters"/>
				</div>	
			</section>
		</div>
		<div class="row">
			<section class="col-md-6">
				<div class="form-group">
					<label class="control-label">Spending Total<span>*</span></label>
						<input type="text" class="form-control" name="spending_total" id="spending_total"/>
				</div>	
			</section>
			<section class="col-md-6">
				<div class="form-group">
					<label class="control-label">Income Total<span>*</span></label>
						<input type="text" class="form-control" name="income_total" id="income_total"/>
				</div>	
			</section>
		</div>
		<div class="row">
			<section class="col-md-6">
				<div class="form-group">
					<label>&nbsp;</label>
					<label class="customwidth">
						<span class="onoffswitch">															
							<input type="checkbox" name="has_paterfamilias"  id="has_paterfamilias" class="onoffswitch-checkbox" />
							<label class="onoffswitch-label" for="has_paterfamilias">
								<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
								<span class="onoffswitch-switch"></span>
							</label>
						</span>
						Has Paterfamilias
					</label>
				</div>
			</section>
			<section class="col-md-6">
				<div class="form-group">
					<label>&nbsp;</label>
					<label class="customwidth">
						<span class="onoffswitch">															
							<input name="has_family_members" class="onoffswitch-checkbox" id="has_family_members" type="checkbox">
							<label class="onoffswitch-label" for="has_family_members">
								<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
								<span class="onoffswitch-switch"></span>
							</label>
						</span>
							Has Family Members
					</label>
				</div>
			</section>
		</div>
		<div class="row">
			<section class="col-md-6">
				<div class="form-group">
					<label>&nbsp;</label>
					<label class="customwidth">
						<span class="onoffswitch">															
							<input name="is_father_alive" class="onoffswitch-checkbox" id="is_father_alive" type="checkbox">
							<label class="onoffswitch-label" for="is_father_alive">
								<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
								<span class="onoffswitch-switch"></span>
							</label>
						</span>
						Is Father Alive
					</label>
				</div>
			</section>
			<section class="col-md-6">
				<div class="form-group">
					<label>&nbsp;</label>
					<label class="customwidth">
						<span class="onoffswitch">															
							<input name="is_mother_alive" class="onoffswitch-checkbox" id="is_mother_alive" type="checkbox">
							<label class="onoffswitch-label" for="is_mother_alive">
								<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
								<span class="onoffswitch-switch"></span>
							</label>
						</span>
							Is Mother Alive
					</label>
				</div>
			</section>
		</div>
		<div class="row">
			<section class="col-md-6">
				<div class="form-group">
					<label>&nbsp;</label>
					<label class="customwidth">
						<span class="onoffswitch">															
							<input name="has_supplies_card" class="onoffswitch-checkbox" id="has_supplies_card" type="checkbox">
							<label class="onoffswitch-label" for="has_supplies_card">
								<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
								<span class="onoffswitch-switch"></span>
							</label>
						</span>
						
						Has Supplies Card
					</label>
				</div>
			</section>
			
		</div>
	</div>
	</form>
</section>
</div>
<script language="javascript">
	function basicDetailJsFunctions()
	{
		$('#btnSaveBasicDetail').click(function(e){
			 e.preventDefault();
			 $("#frmBasicDetail").submit();			
		});
		function savefrmBasicDetailData()
		{
			var $form = $('#frmBasicDetail');
			var objMasterData = $form.serializeObject();
			
			objMasterData = JSON.stringify(objMasterData);

			var objFormData =
			{
				FORM_DATA: objMasterData,
				beneficiaryID : beneficiaryID,
			};
			hideShowLoaderActive(true);
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'saveBasicDetail'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					hideShowLoaderActive(false);		
					callNextTab('basic_detail');
				}
			}
			else {
				hideShowLoaderActive(false);
				mySmallAlert('Error...!', 'There was an error', 0);
			}
		}
		$('#frmBasicDetail').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				number_of_sons: {
                    validators: {
                       notEmpty : {
							message : 'Please enter number of sons'
						},
						callback: {
							message: 'Invalid value',
							callback: function (value, validator, $field) {
							   return (value >= 0);
							}
                       	}
                    }
                },
				number_of_daughters: {
                    validators: {
					   notEmpty : {
							message : 'Please enter number of daughters'
						},
						callback: {
							message: 'Invalid value',
							callback: function (value, validator, $field) {
							   return (value >= 0);
							}
                       	}
					},
                },
				spending_total: {
                    validators: {
					   notEmpty : {
							message : 'Please enter total spending'
						},
						callback: {
							message: 'Invalid value',
							callback: function (value, validator, $field) {
							   return (value >= 0);
							}
                       	}
					},
                },
				income_total: {
                    validators: {
					   notEmpty : {
							message : 'Please enter total income'
						},
						callback: {
							message: 'Invalid value',
							callback: function (value, validator, $field) {
							   return (value >= 0);
							}
                       	}
					},
                },
			}
		}) 
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmBasicDetailData();
		});
	}
</script>