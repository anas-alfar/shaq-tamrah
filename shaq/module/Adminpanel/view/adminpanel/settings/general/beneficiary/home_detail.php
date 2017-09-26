<div class="tab-pane" id="home_detail">
<div class="tabs-main-heading">	
	<span class="tabs-title">Home Detail Info </span>
	<button id="btnSaveHomeDetail" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Next
	</button>
	</div>
														<div id="tabs">
															<ul class="nav nav-tabs" id="langFormTabs">
																<li class="active">
																	<a href="#home-tabs-<?php echo $this->global_locale_id; ?>" data-toggle="tab"><?php echo $this->globalLocalName;?>&nbsp;<i class="fa"></i></a>
																</li>
																<?php 
																	foreach($this->activeLocalesArray as $locale)
																	{
																		if($locale['id'] == $this->global_locale_id)
																			continue;
																		?>
																		<li>
																			<a href="#home-tabs-<?php echo $locale['id']; ?>" data-toggle="tab"><?php echo $locale['name'];?>&nbsp;<i class="fa"></i></a>
																		</li>
																		<?php 
																	}
																?>
															</ul>
															<section>
	
														 <form id="frmHomeDetail" name="frmHomeDetail">
															<div class="tab-content mt20">
																<div id="home-tabs-<?php echo $this->global_locale_id; ?>" class="tab-pane fade in active">
																	<div class="row">
																		
																		<section class="col-md-4">
																			<div class="form-group">
																				<label class="control-label">Building Owner Name<span>*</span></label>
																				<input type="text" class="form-control" name="building_owner_name_<?php echo $this->global_locale_id; ?>" id="building_owner_name_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>	
																		<section class="col-md-4">	
																			<div class="form-group">
																				<label class="control-label">Building Phone Number<span>*</span></label>
																				<input type="text" class="form-control" name="building_owner_phone_number" id="building_owner_phone_number"/>
																			</div>
																		</section>	
																		<section class="col-md-4">	
																			<div class="form-group">
																				<label class="control-label">Beneficiary Profile Home Contract Type<span>*</span></label>
																					<select class="select2" id="beneficiary_profile_home_contract_type_id" name="beneficiary_profile_home_contract_type_id" type="select">														
																						<option value="0">Select Beneficiary Profile Home Contract Type</option>
																					</select> 
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-4">			
																			<div class="form-group">
																				<label class="control-label">Beneficiary Profile Home Construction Type<span>*</span></label>
																					<select class="select2" id="beneficiary_profile_home_construction_type_id" name="beneficiary_profile_home_construction_type_id" type="select">														
																						<option value="0">Select Beneficiary Profile Home Construction Type</option>
																					</select> 
																			</div>
																		</section>
																		<section class="col-md-4">
																			<div class="form-group">
																				<label class="control-label">Construction Area in Square Meter<span>*</span></label>
																				<input type="text" class="form-control" name="construction_area_in_square_meter" id="construction_area_in_square_meter"/>
																			</div>
																		</section>
																		<section class="col-md-4">	
																			<div class="form-group">
																				<label class="control-label">Number of Floors<span>*</span></label>
																				<input type="text" class="form-control" name="number_of_floors" id="number_of_floors"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-4">
																			<div class="form-group">
																				<label class="control-label">Number of Rooms<span>*</span></label>
																					<input type="text" class="form-control" name="number_of_rooms" id="number_of_rooms"/>
																			</div>
																		</section>	
																		<section class="col-md-4">
																			<div class="form-group">
																				<label class="control-label">Number of Residents<span>*</span></label>
																				<input type="text" class="form-control" name="number_of_residents" id="number_of_residents"/>
																			</div>
																		</section>
																		<section class="col-md-4">
																			<div class="form-group">
																				<label class="control-label">Description<span></span></label>
																				<textarea type="text" class="description form-control" name="description_<?php echo $this->global_locale_id; ?>" id="description_<?php echo $this->global_locale_id; ?>"/></textarea>
																			</div>
																		</section>
																	</div>
																</div>
																<?php 

																	foreach($this->activeLocalesArray as $locale)
																	{
																		if($locale['id'] == $this->global_locale_id)
																			continue;
																		?>
																		<div id="home-tabs-<?php echo $locale['id']; ?>" class="tab-pane fade">
																			<div class="row">
																				
																				<section class="col-md-6">
																					<div class="form-group">
																						<label class="control-label">Building Owner Name<span>*</span></label>
																						<input type="text" class="form-control" name="building_owner_name_<?php echo $locale['id']; ?>" id="building_owner_name_<?php echo $locale['id']; ?>"/>
																					</div>
																				</section>
																				<section class="col-md-6">
																					<div class="form-group">
																						<label class="control-label">Description<span></span></label>
																						<textarea type="text" class="description form-control" name="description_<?php echo $locale['id']; ?>" id="description_<?php echo $locale['id']; ?>"></textarea>
																					</div>
																				</section>
																			</div>
																		</div>
																		<?php 
																	}
																?>
															</div>
														 </form>
															</section>
														</div>
												 </div>
<script language="javascript">
	function homeDetailJsFunctions()
	{
		$('#btnSaveHomeDetail').click(function(e){
			 e.preventDefault();
			 $("#frmHomeDetail").submit();			
		});
		
	$('#frmHomeDetail').bootstrapValidator({
		message: 'This value is not valid',
		excluded: [':disabled'],
		feedbackIcons : {
			valid : 'glyphicon glyphicon-ok',
			invalid : 'glyphicon glyphicon-remove',
			validating : 'glyphicon glyphicon-refresh'
		},
		fields : {
			<?php
				foreach($this->activeLocalesArray as $locale)
				{
					?>
					building_owner_name_<?php echo $locale['id']?> : {
						validators : {
							notEmpty : {
								message : 'Please enter building owner name '						
							}
						}
					},
					
					<?php 
				} 
			?>
			building_owner_phone_number: {
			   validators: {
					notEmpty : {
						message : 'Please enter phone number'
					},
				   numeric: {
					   message: 'The phone number is not valid',
					   decimalSeparator: '.'
				   }
			   }
		   	},
			beneficiary_profile_home_contract_type_id: {
				validators: {
				   callback: {
						message: 'Please select beneficiary profile home contract type',
						callback: function (value, validator, $field) {
						   return (value != 0 && value != null && value != '');
						}
					}
				}
			},
			beneficiary_profile_home_construction_type_id: {
				validators: {
				   callback: {
						message: 'Please select beneficiary profile home construction type ',
						callback: function (value, validator, $field) {
						   return (value != 0 && value != null && value != '');
						}
					}
				}
			},
			number_of_floors : {
				validators : {
					notEmpty : {
						message : 'Please enter number of floors'						
					},
					digits : {
						message : 'The number of floors is not valid'
					}
				}
			},
			number_of_rooms : {
				validators : {
					notEmpty : {
						message : 'Please enter number of rooms'						
					},
					digits : {
						message : 'The number of rooms is not valid'
					}
				}
			},
			number_of_residents : {
				validators : {
					notEmpty : {
						message : 'Please enter number of residents'						
					},
					digits : {
						message : 'The number of residents is not valid'
					}
				}
			},
			 construction_area_in_square_meter: {
				validators: {
					notEmpty : {
						message : 'Please enter construction area in square meter'						
					},
					numeric: {
						message: 'The construction area in square meter is not valid',
						decimalSeparator: '.'
					}
				}
			}
		}
	}) 
	.on('success.form.bv', function(e) {
		// Prevent form submission
		e.preventDefault();
		savefrmHomeDetailData();
	});
		
		var contract_type=$("#frmHomeDetail").find("#beneficiary_profile_home_contract_type_id");
		var contract_type_array=[contract_type];	
		populateOptionValuesBulk(contract_type_array,"<?php echo $this->url('adminpanel/home-contract-types', array('action'=>'gethomecontract'));?>","Select Beneficiary Profile Contract Type");
		
		var contract_type=$("#frmHomeDetail").find("#beneficiary_profile_home_construction_type_id");
		var contract_type_array=[contract_type];	
		populateOptionValuesBulk(contract_type_array,"<?php echo $this->url('adminpanel/home-construction-types', array('action'=>'gethomeconstructiontype'));?>","Select Beneficiary Profile Home Construction Type");
	}
	function savefrmHomeDetailData()
	{
		var $form = $('#frmHomeDetail');
		var objMasterData = $form.serializeObject();
		
		objMasterData = JSON.stringify(objMasterData);

		var objFormData =
		{
			FORM_DATA: objMasterData,
			beneficiaryID : beneficiaryID,
		};
		hideShowLoaderActive(true);
		var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'saveHomeDetail'));?>", objFormData);
		if (objMyPost.ERR_NO === 0) {
			if (objMyPost.DATA.DBStatus === 'OK') {
				hideShowLoaderActive(false);		
				callNextTab('home_detail');
			}
		}
		else {
			hideShowLoaderActive(false);
			mySmallAlert('Error...!', 'There was an error', 0);
		}
	}
</script>