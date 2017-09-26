<head>
<link href="../public/admin/css/jquery.steps.css" media="screen" rel="stylesheet" type="text/css">
<link href="../public/admin/css/mvpready-admin.css" media="screen" rel="stylesheet" type="text/css">
</head>
<section id="widForm" class="hide">	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Beneficiary Info </h2>
					<div class="widget-toolbar">
								
								<button id="btnBack" type="submit" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<button id="btnSave" type="submit" class="right btn btnSave  addEventBtn ">
									   <i class="fa fa-floppy-o"></i> &nbsp;Save
							    </button>
					</div>
				</header>
				<div>
					<div class="widget-body">
						<div id="tabs">
							<ul class="nav-tabs" id="langFormTabs">
								<li class="active">
									<a href="#tabs-<?php echo $this->global_locale_id; ?>" data-toggle="tab"><?php echo $this->globalLocalName;?>&nbsp;<i class="fa"></i></a>
								</li>
								<?php 
									foreach($this->activeLocalesArray as $locale)
									{
										if($locale['id'] == $this->global_locale_id)
											continue;
										?>
										<li>
											<a href="#tabs-<?php echo $locale['id']; ?>" data-toggle="tab"><?php echo $locale['name'];?>&nbsp;<i class="fa"></i></a>
										</li>
										<?php 
									}
								?>
							</ul>
						 <form id="frmForm"  enctype="multipart/form-data" name="frmForm"> 
						   <div class="tab-content">	
							<div class="tab-pane active panel panel-hovered panel-stacked mb30">
								<div id="tabs-<?php echo $this->global_locale_id; ?>">
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Family Name<span>*</span></label>
												<input type="text" class="form-control" name="family_name_<?php echo $this->global_locale_id; ?>" id="family_name_<?php echo $this->global_locale_id; ?>"/>
											</div>
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													Visibility
													<span class="onoffswitch">															
														<input name="visibility" class="onoffswitch-checkbox" id="visibility" type="checkbox">
														<label class="onoffswitch-label" for="visibility">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
												</label>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Intro Text<span></span></label>
												<textarea type="text" id="intro_text_<?php echo $this->global_locale_id; ?>" name="intro_text_<?php echo $this->global_locale_id; ?>" class="description form-control"  ></textarea>
											</div>
										</section>
										
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Sequence<span>*</span></label>
													<input type="number" class="form-control" name="sequence" id="sequence"/>
											</div>	
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Family Book Number<span>*</span></label>
													<input type="number" class="form-control" name="family_book_number" id="family_book_number"/>
											</div>	
										</section>
									</div>
									<div class="row">								
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Status<span>*</span></label>
													<select class="select2" id="status" name="status" type="select">														
														<option value="0">Select Status</option>
														<option value="New">New</option>
														<option value="Draft">Draft</option>
														<option value="Review">In Review</option>
														<option value="Moved">Moved</option>
														<option value="Approved">Approved</option>
														<option value="Rejected">Rejected</option>
														<option value="Duplicate">Duplicate</option>
														<option value="Deleted">Deleted</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Country<span>*</span></label>
													<select class="select2" id="country_id" name="country_id" type="select">														
														<option value="0">Select Country</option>
													</select> 
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Notes<span></span></label>
												<textarea type="text"  class="description form-control" name="notes" id="notes" ></textarea>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Options<span></span></label>
												<textarea type="text" id="options" name="options" class="description form-control" ></textarea>
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
										<div id="tabs-<?php echo $locale['id']; ?>">
											<div class="row">
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Family Name<span>*</span></label>
														<input type="text" class="form-control" name="family_name_<?php echo $locale['id']; ?>" id="family_name_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Intro Text<span></span></label>
														<textarea type="text" id="intro_text_<?php echo $locale['id']; ?>" name="intro_text_<?php echo $locale['id']; ?>" class="description form-control"></textarea>
													</div>
												</section>
											</div>
										</div>
										<?php 
									}
								?>
							</div>
						</div>
					  	</form>
					</div>
				   </div>
				   	<div class="widget-body" id="beneficiary-tabs">
					
					  <div class="tabbable  tabs-left">
						<ul class="nav nav-tabs">
						  <li class="active"><a href="#tab1" data-toggle="tab">Section 1</a></li>
						  <li><a href="#tab2" data-toggle="tab">Section 2</a></li>
						</ul>
						<div class="tab-content">
						  <div class="tab-pane active" id="tab1">
							<p>I'm in Section 1.</p>
						  </div>
						  <div class="tab-pane" id="tab2">
							<p>I'm in Section 2.</p>
							<div class="span8">
							<div class="tabbable tabs-left">
							<ul class="nav nav-tabs">
							  <li class="active"><a href="#tab3" data-toggle="tab">Section 3</a></li>
							  <li><a href="#tab4" data-toggle="tab">Section 4</a></li>
							</ul>
							<div class="tab-content">
							  <div class="tab-pane active" id="tab3">
								<p>I'm in Section 3.</p>
							  </div>
							  <div class="tab-pane" id="tab4">
								<p>I'm in Section 4.</p>
							  </div>
							</div>
							</div>
						  </div>      
						  </div>
						</div>
					  </div>
						
					  <div class="tabbable tabs-left">
							<ul class="nav nav-tabs" style="margin-bottom: 20px;">
							  <li class="active"><a href="#basic_details" data-toggle="tab">Basic Details</a></li>
							  <li><a href="#fmly_xtra_dtl" data-toggle="tab">Family Extra Details</a></li>
							  <li><a href="#incm_dtl" data-toggle="tab" >Income Details</a></li>
							  <li><a href="#spending_dtl" data-toggle="tab">Spending Details</a></li>
							  <li><a href="#all_own_asset" data-toggle="tab">All Owned Assets</a></li>
							  <li><a href="#all_required_asset" data-toggle="tab">All Required Assets</a></li>
							  <li><a href="#disabled_dtl" data-toggle="tab">Disabled Details</a></li>
							  <li><a href="#fmly_dtl" data-toggle="tab">Family Details</a></li>
							  <li><a href="#home_dtl" data-toggle="tab">Home Details</a></li>
							  <li><a href="#medical_conditions" data-toggle="tab">Medical Conditions</a></li>
							  <li><a href="#medical_extra_dtl" data-toggle="tab">Medical Extra Details</a></li>
							  <li><a href="#education_dtl" data-toggle="tab">Education Details</a></li>
							  <li><a href="#lay_reader_dtl" data-toggle="tab">Lay Reader Details</a></li>
							  <li><a href="#researcher_notes" data-toggle="tab">Researcher Notes</a></li>
							  <li><a href="#media_gallery" data-toggle="tab">Media Gallery</a></li>
							</ul>
							<form id="frmFormBeneficiary"  enctype="multipart/form-data" name="frmForm"> 
								<fieldset>
									<div class="panel panel-hovered panel-stacked mb30">
										<div class="panel-body">
											<div class="tab-content">
												 <div class="tab-pane active" id="basic_details">
													<section>
														<div class="tab-content">
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Number of Sons<span>*</span></label>
																			<input type="number" class="form-control" name="dtl_number_of_sons" id="dtl_number_of_sons"/>
																	</div>	
																</section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Number of Daughters<span>*</span></label>
																			<input type="number" class="form-control" name="dtl_number_of_daughters" id="dtl_number_of_daughters"/>
																	</div>	
																</section>
															</div>
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Spending Total<span>*</span></label>
																			<input type="text" class="form-control" name="dtl_spending_total" id="dtl_spending_total"/>
																	</div>	
																</section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Income Total<span>*</span></label>
																			<input type="text" class="form-control" name="dtl_income_total" id="dtl_income_total"/>
																	</div>	
																</section>
															</div>
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label>&nbsp;</label>
																		<label class="customwidth">
																			<span class="onoffswitch">															
																				<input name="dtl_has_paterfamilias" class="onoffswitch-checkbox" id="dtl_has_paterfamilias" type="checkbox">
																				<label class="onoffswitch-label" for="dtl_has_paterfamilias">
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
																				<input name="dtl_has_family_members" class="onoffswitch-checkbox" id="dtl_has_family_members" type="checkbox">
																				<label class="onoffswitch-label" for="dtl_has_family_members">
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
																				<input name="dtl_is_father_alive" class="onoffswitch-checkbox" id="dtl_is_father_alive" type="checkbox">
																				<label class="onoffswitch-label" for="dtl_is_father_alive">
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
																				<input name="dtl_is_mother_alive" class="onoffswitch-checkbox" id="dtl_is_mother_alive" type="checkbox">
																				<label class="onoffswitch-label" for="dtl_is_mother_alive">
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
																				<input name="dtl_has_supplies_card" class="onoffswitch-checkbox" id="dtl_has_supplies_card" type="checkbox">
																				<label class="onoffswitch-label" for="dtl_has_supplies_card">
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
													</section>
												 </div>
												 <div class="tab-pane" id="fmly_xtra_dtl">
													<section>
														<div class="tab-content">
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Beneficiary Profile Family Flag<span>*</span></label>
																			<select class="select2" id="fed_beneficiary_profile_family_flag_id" name="fed_beneficiary_profile_family_flag_id" type="select">														
																				<option value="0">Select Beneficiary Profile Family Flag</option>
																			</select> 
																	</div>
																</section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Beneficiary Profile Family<span>*</span></label>
																			<select class="select2" id="fed_beneficiary_profile_family_id" name="fed_beneficiary_profile_family_id" type="select">														
																				<option value="0">Select Beneficiary Profile Family</option>
																			</select> 
																	</div>
																</section>
															</div>
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label>&nbsp;</label>
																		<label class="customwidth">
																			<span class="onoffswitch">															
																				<input name="fed_flag_value" class="onoffswitch-checkbox" id="fed_flag_value" type="checkbox"/>
																				<label class="onoffswitch-label" for="fed_flag_value">
																					<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
																					<span class="onoffswitch-switch"></span>
																				</label>
																			</span>
																				Flag Value
																		</label>
																	</div>
																</section>
															</div>
														</div>
													</section>
												 </div>
												 <div class="tab-pane " id="incm_dtl">
													<section>
														<div class="tab-content">
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Beneficiary Profile Income Type<span>*</span></label>
																			<select class="select2" id="incm_beneficiary_profile_income_type_id" name="incm_beneficiary_profile_income_type_id" type="select">														
																				<option value="0">Select Beneficiary Profile Income Type</option>
																			</select> 
																	</div>
																</section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Income Amount<span>*</span></label>
																			<input type="text" class="form-control" name="incm_amount" id="incm_amount"/>
																	</div>	
																</section>
															</div>
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Currency<span>*</span></label>
																			<select class="select2" id="incm_currency" name="incm_currency" type="select">														
																				<option value="0">Select Currency</option>
																			</select> 
																	</div>
																</section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Currency Exchange Rate<span>*</span></label>
																			<select class="select2" id="incm_currency_exchange_rate_id" name="incm_currency_exchange_rate_id" type="select">														
																				<option value="0">Select Currency Exchange Rate</option>
																			</select> 
																	</div>
																</section>
															</div>
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Frequency<span>*</span></label>
																			<select class="select2" id="incm_frequency" name="incm_frequency" type="select">														
																				<option value="0">Select Frequency</option>
																				<option value="Daily">Daily</option>
																				<option value="Weekly">Weekly</option>
																				<option value="Monthly">Monthly</option>
																				<option value="Quarterly">Quarterly</option>
																				<option value="Annual">Annualy</option>
																			</select> 
																	</div>
																</section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Status<span>*</span></label>
																			<select class="select2" id="incm_status" name="incm_status" type="select">														
																				<option value="0">Select Status</option>
																				<option value="Active">Active</option>
																				<option value="Inactive">Inactive</option>
																			</select> 
																	</div>
																</section>
															</div>
														</div>
													</section>
												 </div>
												 <div class="tab-pane" id="spending_dtl">
													<section>
														<div class="tab-content">
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Beneficiary Profile Spending Type<span>*</span></label>
																			<select class="select2" id="sd_beneficiary_profile_spending_type_id" name="sd_beneficiary_profile_spending_type_id" type="select">														
																				<option value="0">Select Beneficiary Profile Spending Type</option>
																			</select> 
																	</div>
																</section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Income Amount<span>*</span></label>
																			<input type="text" class="form-control" name="sd_amount" id="sd_amount"/>
																	</div>	
																</section>
															</div>
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Currency<span>*</span></label>
																			<select class="select2" id="sd_currency" name="sd_currency" type="select">														
																				<option value="0">Select Currency</option>
																			</select> 
																	</div>
																</section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Currency Exchange Rate<span>*</span></label>
																			<select class="select2" id="sd_currency_exchange_rate_id" name="sd_currency_exchange_rate_id" type="select">														
																				<option value="0">Select Currency Exchange Rate</option>
																			</select> 
																	</div>
																</section>
															</div>
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Frequency<span>*</span></label>
																			<select class="select2" id="sd_frequency" name="sd_frequency" type="select">														
																				<option value="0">Select Frequency</option>
																				<option value="Daily">Daily</option>
																				<option value="Weekly">Weekly</option>
																				<option value="Monthly">Monthly</option>
																				<option value="Quarterly">Quarterly</option>
																				<option value="Annual">Annualy</option>
																			</select> 
																	</div>
																</section>
															</div>
														</div>
													</section>
												 </div>
												 <div class="tab-pane" id="all_own_asset">
													<section>
														<div class="tab-content">
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Type<span>*</span></label>
																			<select class="select2" id="oa_asset_type_id" name="oa_asset_type_id" type="select">														
																				<option value="0">Select Asset Type</option>
																			</select> 
																	</div>
																</section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset<span>*</span></label>
																			<select class="select2" id="oa_asset_id" name="oa_asset_id" type="select">														
																				<option value="0">Select Asset</option>
																			</select> 
																	</div>
																</section>
															</div>
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Condition<span>*</span></label>
																			<select class="select2" id="oa_asset_condition_id" name="oa_asset_condition_id" type="select">														
																				<option value="0">Select Asset Condition</option>
																			</select> 
																	</div>
																</section>
															</div>
														</div>
													</section>
												 </div>
												 <div class="tab-pane" id="all_required_asset">
													<section>
														<div class="tab-content">
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset<span>*</span></label>
																			<select class="select2" id="ra_asset_id" name="ra_asset_id" type="select">														
																				<option value="0">Select Asset</option>
																			</select> 
																	</div>
																</section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Type<span>*</span></label>
																			<select class="select2" id="ra_asset_type_id" name="ra_asset_type_id" type="select">														
																				<option value="0">Select Asset Type</option>
																			</select> 
																	</div>
																</section>
															</div>
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Unit<span>*</span></label>
																			<select class="select2" id="ra_asset_unit_id" name="ra_asset_unit_id" type="select">														
																				<option value="0">Select Asset Unit</option>
																			</select> 
																	</div>
																</section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Condition<span>*</span></label>
																			<select class="select2" id="ra_asset_condition_id" name="ra_asset_condition_id" type="select">														
																				<option value="0">Select Asset Condition</option>
																			</select> 
																	</div>
																</section>
															 </div>	
															<div class="row">	
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Quantity<span>*</span></label>
																			<input type="text" class="form-control" name="ra_asset_quantity" id="ra_asset_quantity"/>
																	</div>	
																</section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Status<span>*</span></label>
																			<select class="select2" id="ra_status" name="ra_status" type="select">														
																				<option value="0">Select Status</option>
																				<option value="Pending">Pending</option>
																				<option value="Approved">Approved</option>
																				<option value="Rejected">Rejected</option>
																				<option value="Out of Stock">Out of Stock</option>
																				<option value="Received">Received</option>
																			</select>
																	</div>
																</section>	
															</div>
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Beneficiary Profile Asset Received<span>*</span></label>
																			<select class="select2" id="ra_beneficiary_profile_asset_received_id" name="ra_beneficiary_profile_asset_received_id" type="select">														
																				<option value="0">Select Beneficiary Profile Asset Received</option>
																			</select> 
																	</div>
																</section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Beneficiary Profile Asset Received Date<span>*</span></label>
																			<input type="text" class="form-control" name="ra_beneficiary_profile_asset_received_date" id="ra_beneficiary_profile_asset_received_date"/>
																	</div>	
																</section>
															</div>
														</div>
													</section>
												 </div>
												 <div class="tab-pane" id="disabled_dtl">
													<section>
														<div class="tab-content">
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Beneficiary Profile Disabled Type<span>*</span></label>
																			<select class="select2" id="dsbl_beneficiary_profile_disabled_type_id" name="dsbl_beneficiary_profile_disabled_type_id"  type="select">														
																				<option value="0">Select Beneficiary Profile Disabled Type</option>
																			</select> 
																	</div>
																</section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Beneficiary Profile Disabled Reason<span>*</span></label>
																			<select class="select2" id="dsbl_beneficiary_profile_disabled_reason_id" name="dsbl_beneficiary_profile_disabled_reason_id" type="select">														
																				<option value="0">Select Beneficiary Profile Disabled Reason</option>
																			</select> 
																	</div>
																</section>
															</div>
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Beneficiary Profile Family<span>*</span></label>
																			<select class="select2" id="dsbl_beneficiary_profile_family_id" name="dsbl_beneficiary_profile_family_id" type="select">														
																				<option value="0">Select Beneficiary Profile Family</option>
																			</select> 
																	</div>
																</section>
															 </div>
														</div>
													</section>
												 </div>
												 <div class="tab-pane" id="fmly_dtl">
														<div id="fmly-tabs">
															<ul class="nav nav-tabs" id="fmly-langFormTabs">
																<li class="active">
																	<a href="#fmly-tabs-<?php echo $this->global_locale_id; ?>" data-toggle="tab"><?php echo $this->globalLocalName;?>&nbsp;<i class="fa"></i></a>
																</li>
																<?php 
																	foreach($this->activeLocalesArray as $locale)
																	{
																		if($locale['id'] == $this->global_locale_id)
																			continue;
																		?>
																		<li>
																			<a href="#fmly-tabs-<?php echo $locale['id']; ?>" data-toggle="tab"><?php echo $locale['name'];?>&nbsp;<i class="fa"></i></a>
																		</li>
																		<?php 
																	}
																?>
															</ul>
															<section>
															<div class="tab-content">
																<div id="#fmly-tabs-<?php echo $this->global_locale_id; ?>">
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">First Name<span>*</span></label>
																				<input type="text" class="form-control" name="fmly_first_name_<?php echo $this->global_locale_id; ?>" id="fmly_first_name_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Second Name<span>*</span></label>
																				<input type="text" class="form-control" name="fmly_second_name_<?php echo $this->global_locale_id; ?>" id="fmly_second_name_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">	
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Third Name<span>*</span></label>
																				<input type="text" class="form-control" name="fmly_third_name_<?php echo $this->global_locale_id; ?>" id="fmly_third_name_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Last Name<span>*</span></label>
																				<input type="text" class="form-control" name="last_name_<?php echo $this->global_locale_id; ?>" id="last_name_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">	
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Address<span></span></label>
																				<textarea type="text" id="fmly_address_<?php echo $this->global_locale_id; ?>" name="fmly_address_<?php echo $this->global_locale_id; ?>" class="description form-control"  ></textarea>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Ssn<span>*</span></label>
																				<input type="text" class="form-control" name="fmly_ssn" id="fmly_ssn"/>
																			</div>
																			<div class="form-group">
																				<label class="control-label">phone Number<span>*</span></label>
																				<input type="text" class="form-control" name="fmly_phone_number" id="fmly_phone_number"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Mobile Number<span>*</span></label>
																					<input type="text" class="form-control" name="fmly_mobile_number" id="fmly_mobile_number"/>
																			</div>	
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Email<span>*</span></label>
																					<input type="text" class="form-control" name="fmly_email" id="fmly_email"/>
																			</div>	
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Nationality<span>*</span></label>
																					<select class="select2" id="fmly_nationality_id" name="fmly_nationality_id" type="select">														
																						<option value="0">Select Nationality</option>
																					</select> 
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Country<span>*</span></label>
																					<select class="select2" id="fmly_country_id" name="fmly_country_id" type="select">														
																						<option value="0">Select Country</option>
																					</select> 
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">City<span>*</span></label>
																					<select class="select2" id="fmly_city_id" name="fmly_city_id" type="select">														
																						<option value="0">Select City</option>
																					</select> 
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Date of Birth<span>*</span></label>
																					<input type="text" class="form-control" name="fmly_date_of_birth" id="fmly_date_of_birth"/>
																			</div>	
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Avatar<span></span></label>
																				<textarea type="text" id="fmly_options" name="fmly_options" class="description form-control" ></textarea>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Beneficiary Relation<span>*</span></label>
																					<select class="select2" id="fmly_beneficiary_relation_id" name="fmly_beneficiary_relation_id" type="select">														
																						<option value="0">Select Beneficiary Relation</option>
																					</select> 
																			</div>	
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Marital Status<span>*</span></label>
																					<select class="select2" id="fmly_marital_status_id" name="fmly_marital_status_id" type="select">														
																						<option value="0">Select Marital Status</option>
																					</select> 
																			</div>	
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Education Level<span>*</span></label>
																					<select class="select2" id="fmly_education_level_id" name="fmly_education_level_id" type="select">														
																						<option value="0">Select Education Level</option>
																					</select> 
																			</div>	
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Medical Condition<span>*</span></label>
																					<select class="select2" id="fmly_medical_condition_id" name="fmly_medical_condition_id" type="select">														
																						<option value="0">Select Medical Condition</option>
																					</select> 
																			</div>	
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Beneficiary Profile Family Profession<span>*</span></label>
																					<select class="select2" id="fmly_beneficiary_profile_family_profession_id" name="fmly_beneficiary_profile_family_profession_id" type="select">														
																						<option value="0">Select Beneficiary Profile Family Profession</option>
																					</select> 
																			</div>	
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Death Date<span>*</span></label>
																					<input type="text" class="form-control" name="fmly_death_date" id="fmly_death_date"/>
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
																		<div id="fmly-tabs-<?php echo $locale['id']; ?>">
																			<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">First Name<span>*</span></label>
																				<input type="text" class="form-control" name="fmly_first_name_<?php echo $locale['id']; ?>" id="fmly_first_name_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Second Name<span>*</span></label>
																				<input type="text" class="form-control" name="fmly_second_name_<?php echo $locale['id']; ?>" id="fmly_second_name_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">	
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Third Name<span>*</span></label>
																				<input type="text" class="form-control" name="fmly_third_name_<?php echo $locale['id']; ?>" id="fmly_third_name_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Last Name<span>*</span></label>
																				<input type="text" class="form-control" name="fmly_last_name_<?php echo $locale['id']; ?>" id="fmly_last_name_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">	
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Address<span></span></label>
																				<textarea type="text" id="fmly_address_<?php echo $locale['id']; ?>" name="fmly_address_<?php echo $locale['id']; ?>" class="description form-control"  ></textarea>
																			</div>
																		</section>
																		
																	</div>
																		</div>
																		<?php 
																	}
																?>
															</div>
															</section>
														</div>
												 </div>
												 <div class="tab-pane" id="home_dtl">
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
															<div class="tab-content">
																<div id="home-tabs-<?php echo $this->global_locale_id; ?>">
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Description<span>*</span></label>
																				<textarea type="text" class="description form-control" name="home_description_<?php echo $this->global_locale_id; ?>" id="home_description_<?php echo $this->global_locale_id; ?>"/></textarea>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Building Owner Name<span>*</span></label>
																				<input type="text" class="form-control" name="home_building_owner_name_<?php echo $this->global_locale_id; ?>" id="home_building_owner_name_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																			<div class="form-group">
																				<label class="control-label">Beneficiary Profile Home Contract Type<span>*</span></label>
																					<select class="select2" id="home_beneficiary_profile_home_contract_type_id" name="home_beneficiary_profile_home_contract_type_id" type="select">														
																						<option value="0">Select Beneficiary Profile Home Contract Type</option>
																					</select> 
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Construction Area in Square Meter<span>*</span></label>
																				<input type="text" class="form-control" name="home_construction_area_in_square_meter" id="home_construction_area_in_square_meter"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Number of Floors<span>*</span></label>
																				<input type="text" class="form-control" name="home_number_of_floors" id="home_number_of_floors"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Number of Rooms<span>*</span></label>
																					<input type="text" class="form-control" name="home_number_of_rooms" id="home_number_of_rooms"/>
																			</div>
																		</section>	
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Number of Residents<span>*</span></label>
																				<input type="text" class="form-control" name="home_number_of_residents" id="home_number_of_residents"/>
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
																		<div id="home-tabs-<?php echo $locale['id']; ?>">
																			<div class="row">
																				<section class="col-md-6">
																					<div class="form-group">
																						<label class="control-label">Description<span>*</span></label>
																						<textarea type="text" class="description form-control" name="home_description_<?php echo $locale['id']; ?>" id="home_description_<?php echo $locale['id']; ?>"></textarea>
																					</div>
																				</section>
																				<section class="col-md-6">
																					<div class="form-group">
																						<label class="control-label">Building Owner Name<span>*</span></label>
																						<input type="text" class="form-control" name="home_building_owner_name_<?php echo $locale['id']; ?>" id="home_building_owner_name_<?php echo $locale['id']; ?>"/>
																					</div>
																				</section>
																			</div>
																		</div>
																		<?php 
																	}
																?>
															</div>
															</section>
														</div>
												 </div>
												 <div class="tab-pane" id="medical_conditions">
														<div id="tabs">
															<ul class="nav nav-tabs" id="langFormTabs">
																<li class="active">
																	<a href="#mc-tabs-<?php echo $this->global_locale_id; ?>" data-toggle="tab"><?php echo $this->globalLocalName;?>&nbsp;<i class="fa"></i></a>
																</li>
																<?php 
																	foreach($this->activeLocalesArray as $locale)
																	{
																		if($locale['id'] == $this->global_locale_id)
																			continue;
																		?>
																		<li>
																			<a href="#mc-tabs-<?php echo $locale['id']; ?>" data-toggle="tab"><?php echo $locale['name'];?>&nbsp;<i class="fa"></i></a>
																		</li>
																		<?php 
																	}
																?>
															</ul>
															<section>
															<div class="tab-content">
																<div id="mc-tabs-<?php echo $this->global_locale_id; ?>">
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Current Medical Condition<span>*</span></label>
																				<input type="text" class="form-control" name="mc_current_medical_condition_<?php echo $this->global_locale_id; ?>" id="mc_current_medical_condition_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Medical History<span>*</span></label>
																				<input type="text" class="form-control" name="mc_medical_history_<?php echo $this->global_locale_id; ?>" id="mc_medical_history_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">	
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Surgical History<span>*</span></label>
																				<input type="text" class="form-control" name="mc_surgical_history_<?php echo $this->global_locale_id; ?>" id="mc_surgical_history_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Family History<span>*</span></label>
																				<input type="text" class="form-control" name="mc_family_history_<?php echo $this->global_locale_id; ?>" id="mc_family_history_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">	
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Treatment History<span>*</span></label>
																				<input type="text" class="form-control" name="mc_treatment_history_<?php echo $this->global_locale_id; ?>" id="mc_treatment_history_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Lab Results History<span>*</span></label>
																				<input type="text" class="form-control" name="mc_lab_results_history_<?php echo $this->global_locale_id; ?>" id="mc_lab_results_history_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">	
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Prescription History<span>*</span></label>
																				<input type="text" class="form-control" name="mc_prescription_history_<?php echo $this->global_locale_id; ?>" id="mc_prescription_history_<?php echo $this->global_locale_id; ?>"/>
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
																		<div id="mc-tabs-<?php echo $locale['id']; ?>">
																			<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Current Medical Condition<span>*</span></label>
																				<input type="text" class="form-control" name="mc_current_medical_condition_<?php echo $locale['id']; ?>" id="mc_current_medical_condition_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Medical History<span>*</span></label>
																				<input type="text" class="form-control" name="mc_medical_history_<?php echo $locale['id']; ?>" id="mc_medical_history_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">	
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Surgical History<span>*</span></label>
																				<input type="text" class="form-control" name="mc_surgical_history_<?php echo $locale['id']; ?>" id="mc_surgical_history_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Family History<span>*</span></label>
																				<input type="text" class="form-control" name="mc_family_history_<?php echo $locale['id']; ?>" id="mc_family_history_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">	
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Treatment History<span>*</span></label>
																				<input type="text" class="form-control" name="mc_treatment_history_<?php echo $locale['id']; ?>" id="mc_treatment_history_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Lab Results History<span>*</span></label>
																				<input type="text" class="form-control" name="mc_lab_results_history_<?php echo $locale['id']; ?>" id="mc_lab_results_history_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">	
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Prescription History<span>*</span></label>
																				<input type="text" class="form-control" name="mc_prescription_history_<?php echo $locale['id']; ?>" id="mc_prescription_history_<?php echo $locale['id']; ?>"/>



																			</div>
																		</section>
																	</div>
																		</div>
																		<?php 
																	}
																?>
															</div>
															</section>
														</div>
												 </div>
												 <div class="tab-pane" id="medical_extra_dtl">
														<div id="tabs">
															<ul class="nav nav-tabs" id="langFormTabs">
																<li class="active">
																	<a href="#med-tabs-<?php echo $this->global_locale_id; ?>" data-toggle="tab"><?php echo $this->globalLocalName;?>&nbsp;<i class="fa"></i></a>
																</li>
																<?php 
																	foreach($this->activeLocalesArray as $locale)
																	{
																		if($locale['id'] == $this->global_locale_id)
																			continue;
																		?>
																		<li>
																			<a href="#med-tabs-<?php echo $locale['id']; ?>" data-toggle="tab"><?php echo $locale['name'];?>&nbsp;<i class="fa"></i></a>
																		</li>
																		<?php 
																	}
																?>
															</ul>
															<section>
															<div class="tab-content">
																<div id="med-tabs-<?php echo $this->global_locale_id; ?>">
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Doctor Name<span>*</span></label>
																				<input type="text" class="form-control" name="med_doctor_name_<?php echo $this->global_locale_id; ?>" id="med_doctor_name_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																			<div class="form-group">
																				<label class="control-label">Complaint<span>*</span></label>
																				<input type="text" class="form-control" name="med_complaint_<?php echo $this->global_locale_id; ?>" id="med_complaint_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Doctor Address<span>*</span></label>
																				<textarea type="text" class="description form-control" name="med_doctor_addressy_<?php echo $this->global_locale_id; ?>" id="med_doctor_address_<?php echo $this->global_locale_id; ?>"></textarea>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Examination<span>*</span></label>
																				<input type="text" class="form-control" name="med_examination_<?php echo $this->global_locale_id; ?>" id="med_examination_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Treatment<span>*</span></label>
																				<input type="text" class="form-control" name="med_treatment_<?php echo $this->global_locale_id; ?>" id="med_treatment_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Lab Results<span>*</span></label>
																				<input type="text" class="form-control" name="med_lab_results_<?php echo $this->global_locale_id; ?>" id="med_lab_results_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>	
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Prescription<span>*</span></label>
																				<input type="text" class="form-control" name="med_prescription_<?php echo $this->global_locale_id; ?>" id="med_prescription_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Procedure<span>*</span></label>
																				<input type="text" class="form-control" name="med_procedure_<?php echo $this->global_locale_id; ?>" id="med_procedure_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Comment<span>*</span></label>
																				<input type="text" class="form-control" name="med_comment_<?php echo $this->global_locale_id; ?>" id="med_comment_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Doctor Mobile Number<span>*</span></label>
																				<input type="text" class="form-control" name="med_doctor_mobile_number" id="med_doctor_mobile_number"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Doctor Phone Number<span>*</span></label>
																				<input type="text" class="form-control" name="med_doctor_phone_number" id="med_doctor_phone_number"/>
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
																		<div id="med-tabs-<?php echo $locale['id']; ?>">
																			<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Doctor Name<span>*</span></label>
																				<input type="text" class="form-control" name="med_doctor_name_<?php echo $locale['id']; ?>" id="med_doctor_name_<?php echo $locale['id']; ?>"/>
																			</div>
																			<div class="form-group">
																				<label class="control-label">Complaint<span>*</span></label>
																				<input type="text" class="form-control" name="med_complaint_<?php echo $locale['id']; ?>" id="med_complaint_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Doctor Address<span>*</span></label>
																				<textarea type="text" class="description form-control" name="med_doctor_addressy_<?php echo $locale['id']; ?>" id="med_doctor_address_<?php echo $locale['id']; ?>"></textarea>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Examination<span>*</span></label>
																				<input type="text" class="form-control" name="med_examination_<?php echo $locale['id']; ?>" id="med_examination_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>	
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Treatment<span>*</span></label>
																				<input type="text" class="form-control" name="med_treatment_<?php echo $locale['id']; ?>" id="med_treatment_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Lab Results<span>*</span></label>
																				<input type="text" class="form-control" name="med_lab_results_<?php echo $locale['id']; ?>" id="med_lab_results_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>	
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Prescription<span>*</span></label>
																				<input type="text" class="form-control" name="med_prescription_<?php echo $locale['id']; ?>" id="med_prescription_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Procedure<span>*</span></label>
																				<input type="text" class="form-control" name="med_procedure_<?php echo $locale['id']; ?>" id="med_procedure_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Comment<span>*</span></label>
																				<input type="text" class="form-control" name="med_comment_<?php echo $locale['id']; ?>" id="med_comment_<?php echo $locale['id']; ?>>"/>
																			</div>
																		</section>
																	</div>
																		</div>
																		<?php 
																	}
																?>
															</div>
															</section>
														</div>
												 </div>
												 <div class="tab-pane" id="education_dtl">
														<div id="tabs">
															<ul class="nav nav-tabs" id="langFormTabs">
																<li class="active">
																	<a href="#edu-tabs-<?php echo $this->global_locale_id; ?>" data-toggle="tab"><?php echo $this->globalLocalName;?>&nbsp;<i class="fa"></i></a>
																</li>
																<?php 
																	foreach($this->activeLocalesArray as $locale)
																	{
																		if($locale['id'] == $this->global_locale_id)
																			continue;
																		?>
																		<li>
																			<a href="#edu-tabs-<?php echo $locale['id']; ?>" data-toggle="tab"><?php echo $locale['name'];?>&nbsp;<i class="fa"></i></a>
																		</li>
																		<?php 
																	}
																?>
															</ul>
															<section>
															<div class="tab-content">
																<div id="edu-tabs-<?php echo $this->global_locale_id; ?>">
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Institute Name<span>*</span></label>
																				<input type="text" class="form-control" name="edu_institute_name_<?php echo $this->global_locale_id; ?>" id="edu_institute_name_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">School Name<span>*</span></label>
																				<input type="text" class="form-control" name="edu_school_name_<?php echo $this->global_locale_id; ?>" id="edu_school_name_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Level Name<span>*</span></label>
																				<input type="text" class="form-control" name="edu_level_name_<?php echo $this->global_locale_id; ?>" id="edu_level_name_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Major Name<span>*</span></label>
																				<input type="text" class="form-control" name="edu_major_name_<?php echo $this->global_locale_id; ?>" id="edu_major_name_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Class Name<span>*</span></label>
																				<input type="text" class="form-control" name="edu_class_name_<?php echo $this->global_locale_id; ?>" id="edu_class_name_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																			<div class="form-group">
																				<label class="control-label">Final Grade<span>*</span></label>
																				<input type="text" class="form-control" name="edu_final_grade_<?php echo $this->global_locale_id; ?>" id="edu_final_grade_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>	
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Address<span>*</span></label>
																				<textarea type="text" class="description form-control" name="edu_address_<?php echo $this->global_locale_id; ?>" id="edu_address_<?php echo $this->global_locale_id; ?>"></textarea>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">School Type<span>*</span></label>
																				<select type="select" class="select2" name="edu_school_type" id="edu_school_type">
																				<option value="0">Select School Type</option>
																				<option value="Pre KG">Pre KG</option>
																				<option value="KG">KG</option>
																				<option value="Elementary School">Elementary School</option>
																				<option value="Intermediate School">Intermediate School</option>
																				<option value="High School">High School</option>
																				<option value="Industrial Education">Industrial Education</option>
																				<option value="Diploma">Diploma</option>
																				<option value="University">University</option>
																				<option value="Academy">Academy</option>
																				</select>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Start At<span>*</span></label>
																				<input type="text" class="form-control" name="edu_start_at" id="edu_start_at"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">End At<span>*</span></label>
																				<input type="text" class="form-control" name="edu_end_at" id="edu_end_at"/>
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
																		<div id="edu-tabs-<?php echo $locale['id']; ?>">
																			<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Institute Name<span>*</span></label>
																				<input type="text" class="form-control" name="edu_institute_name_<?php echo $locale['id']; ?>" id="edu_institute_name_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">School Name<span>*</span></label>
																				<input type="text" class="form-control" name="edu_school_name_<?php echo $locale['id']; ?>" id="edu_school_name_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Level Name<span>*</span></label>
																				<input type="text" class="form-control" name="edu_level_name_<?php echo $locale['id']; ?>" id="edu_level_name_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Major Name<span>*</span></label>
																				<input type="text" class="form-control" name="edu_major_name_<?php echo $locale['id']; ?>" id="edu_major_name_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Class Name<span>*</span></label>
																				<input type="text" class="form-control" name="edu_class_name_<?php echo $locale['id']; ?>" id="edu_class_name_<?php echo $locale['id']; ?>"/>
																			</div>
																			<div class="form-group">
																				<label class="control-label">Final Grade<span>*</span></label>
																				<input type="text" class="form-control" name="edu_final_grade_<?php echo $locale['id']; ?>" id="edu_final_grade_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>	
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Address<span>*</span></label>
																				<textarea type="text" class="description form-control" name="edu_address_<?php echo $locale['id']; ?>" id="edu_address_<?php echo $locale['id']; ?>"></textarea>
																			</div>
																		</section>
																	</div>
																		</div>
																		<?php 
																	}
																?>
															</div>
															</section>
														</div>
												 </div>
												 <div class="tab-pane" id="lay_reader_dtl">
														<div id="tabs">
															<ul class="nav nav-tabs" id="langFormTabs">
																<li class="active">
																	<a href="#lrd-tabs-<?php echo $this->global_locale_id; ?>" data-toggle="tab"><?php echo $this->globalLocalName;?>&nbsp;<i class="fa"></i></a>
																</li>
																<?php 
																	foreach($this->activeLocalesArray as $locale)
																	{
																		if($locale['id'] == $this->global_locale_id)
																			continue;
																		?>
																		<li>
																			<a href="#lrd-tabs-<?php echo $locale['id']; ?>" data-toggle="tab"><?php echo $locale['name'];?>&nbsp;<i class="fa"></i></a>
																		</li>
																		<?php 
																	}
																?>
															</ul>
															<section>
															<div class="tab-content">
																<div id="lrd-tabs-<?php echo $this->global_locale_id; ?>">
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Institute Name<span>*</span></label>
																				<input type="text" class="form-control" name="lrd_details_<?php echo $this->global_locale_id; ?>" id="lrd_details_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																			<div class="form-group">
																				<label class="control-label">Volunteer Type<span>*</span></label>
																				<select type="select" class="select2" name="lrd_volunteer_type_id" id="lrd_volunteer_type_id">
																				<option value="0">Select Volunteer Type</option>
																				</select>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Address<span>*</span></label>
																				<textarea type="text" class="description form-control" name="lrd_edu_address_<?php echo $this->global_locale_id; ?>" id="lrd_edu_address_<?php echo $this->global_locale_id; ?>"></textarea>
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
																		<div id="lrd-tabs-<?php echo $locale['id']; ?>">
																			<div class="row">
																				<section class="col-md-6">
																					<div class="form-group">
																						<label class="control-label">Institute Name<span>*</span></label>
																						<input type="text" class="form-control" name="lrd_details_<?php echo $locale['id']; ?>" id="lrd_details_<?php echo $locale['id']; ?>"/>
																					</div>
																				</section>
																				<section class="col-md-6">
																					<div class="form-group">
																						<label class="control-label">Address<span>*</span></label>
																						<textarea type="text" class="description form-control" name="lrd_address_<?php echo $locale['id']; ?>" id="lrd_address_<?php echo $locale['id']; ?>"></textarea>
																					</div>
																				</section>
																			</div>
																		</div>
																		<?php 
																	}
																?>
															</div>
															</section>
														</div>
												 </div>
												 <div class="tab-pane" id="researcher_notes">
														<div id="tabs">
															<ul class="nav nav-tabs" id="langFormTabs">
																<li class="active">
																	<a href="#rn-tabs-<?php echo $this->global_locale_id; ?>" data-toggle="tab"><?php echo $this->globalLocalName;?>&nbsp;<i class="fa"></i></a>
																</li>
																<?php 
																	foreach($this->activeLocalesArray as $locale)
																	{
																		if($locale['id'] == $this->global_locale_id)
																			continue;
																		?>
																		<li>
																			<a href="#rn-tabs-<?php echo $locale['id']; ?>" data-toggle="tab"><?php echo $locale['name'];?>&nbsp;<i class="fa"></i></a>
																		</li>
																		<?php 
																	}
																?>
															</ul>
															<section>
															<div class="tab-content">
																<div id="rn-tabs-<?php echo $this->global_locale_id; ?>">
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Small Business Idea Description<span>*</span></label>
																				<textarea type="text" class="description form-control" name="rn_small_business_idea_description_<?php echo $this->global_locale_id; ?>" id="rn_small_business_idea_description_<?php echo $this->global_locale_id; ?>"></textarea>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Researcher Recommendations<span>*</span></label>
																				<input type="text" class="form-control" name="rn_researcher_recommendations_<?php echo $this->global_locale_id; ?>" id="rn_researcher_recommendations_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																			<div class="form-group">
																				<label class="control-label">Researcher Name<span>*</span></label>
																				<input type="text" class="form-control" name="rn_researcher_name_<?php echo $this->global_locale_id; ?>" id="rn_researcher_name_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																	</div>	
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Notes<span>*</span></label>
																				<textarea type="text" class="description form-control" name="rn_notes_<?php echo $this->global_locale_id; ?>" id="rn_notes_<?php echo $this->global_locale_id; ?>"></textarea>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Committee Recommendations<span>*</span></label>
																				<input type="text" class="form-control" name="rn_committee_recommendations_<?php echo $this->global_locale_id; ?>" id="rn_committee_recommendations_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																			<div class="form-group">
																				<label class="control-label">Committee Member Name<span>*</span></label>
																				<input type="text" class="form-control" name="rn_committee_member_name_<?php echo $this->global_locale_id; ?>" id="rn_committee_member_name_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Committee Manager Name<span>*</span></label>
																				<input type="text" class="form-control" name="rn_committee_manager_name_<?php echo $this->global_locale_id; ?>" id="rn_committee_manager_name_<?php echo $this->global_locale_id; ?>"/>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Support Type<span>*</span></label>
																				<select type="select" class="select2" name="rn_support_type" id="rn_support_type">
																				<option value="0">Select Support Type</option>
																				<option value="Frequent">Frequent</option>
																				<option value="Emergency">Emergency</option>
																				<option value="Medical">Medical</option>
																				<option value="Educational">Educational</option>
																				<option value="Other">Other</option>
																				</select>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Support Period<span>*</span></label>
																				<select type="select" class="select2" name="rn_support_period" id="rn_support_period">
																				<option value="0">Select Support Period</option>
																				<option value="Permanent">Permanent</option>
																				<option value="Once">Once</option>
																				<option value="Until healing">Until healing</option>
																				<option value="Until graduate">Until graduate</option>
																				</select>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Expected Support Period<span>*</span></label>
																				<select type="select" class="select2" name="rn_expected_support_period" id="rn_expected_support_period">
																				<option value="0">Select Expected Support Period</option>
																				<option value="Permanent">Permanent</option>
																				<option value="Once">Once</option>
																				<option value="Until healing">Until healing</option>
																				<option value="Until graduate">Until graduate</option>
																				</select>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Support Modality<span>*</span></label>
																				<select type="select" class="select2" name="rn_support_modality" id="rn_support_modality">
																				<option value="0">Select Support Modality</option>
																				<option value="Money">Money</option>
																				<option value="In-kind">In-kind</option>
																				<option value="Money and in-kind">Money and in-kind</option>
																				<option value="Volunteer">Volunteer</option>
																				<option value="By hand">By hand</option>
																				<option value="Educate a family member">Educate a family member</option>
																				<option value="Employ a family member">Employ a family member</option>
																				<option value="Other">Other</option>
																				</select>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Information Source<span>*</span></label>
																				<select type="select" class="select2" name="rn_information_source" id="rn_information_source">
																				<option value="0">Select Information Source</option>
																				<option value="Official documents">Official documents</option>
																				<option value="Work visit">Work visit</option>
																				<option value="Home visit">Home visit</option>
																				<option value="Trusted neighbors">Trusted neighbors</option>
																				</select>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label>&nbsp;</label>
																				<label class="customwidth">
																					Has Small Business Idea
																					<span class="onoffswitch">															
																						<input name="rn_has_small_business_idea" class="onoffswitch-checkbox" id="rn_has_small_business_idea" type="checkbox">
																						<label class="onoffswitch-label" for="rn_has_small_business_idea">
																							<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
																							<span class="onoffswitch-switch"></span>
																						</label>
																					</span>
																				</label>
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
																		<div id="rn-tabs-<?php echo $locale['id']; ?>">
																			<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Small Business Idea Description<span>*</span></label>
																				<textarea type="text" class="description form-control" name="rn_small_business_idea_description_<?php echo $locale['id']; ?>" id="rn_small_business_idea_description_<?php echo $locale['id']; ?>"></textarea>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Researcher Recommendations<span>*</span></label>
																				<input type="text" class="form-control" name="rn_researcher_recommendations_<?php echo $locale['id']; ?>" id="rn_researcher_recommendations_<?php echo $locale['id']; ?>"/>
																			</div>
																			<div class="form-group">
																				<label class="control-label">Researcher Name<span>*</span></label>
																				<input type="text" class="form-control" name="rn_researcher_name_<?php echo $locale['id']; ?>" id="rn_researcher_name_<?php echo $locale['id']; ?>>"/>
																			</div>
																		</section>
																	</div>	
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Notes<span>*</span></label>
																				<textarea type="text" class="description form-control" name="rn_notes_<?php echo $locale['id']; ?>" id="rn_notes_<?php echo $locale['id']; ?>"></textarea>
																			</div>
																		</section>
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Committee Recommendations<span>*</span></label>
																				<input type="text" class="form-control" name="rn_committee_recommendations_<?php echo $locale['id']; ?>" id="rn_committee_recommendations_<?php echo $locale['id']; ?>>"/>
																			</div>
																			<div class="form-group">
																				<label class="control-label">Committee Member Name<span>*</span></label>
																				<input type="text" class="form-control" name="rn_committee_member_name_<?php echo $locale['id']; ?>" id="rn_committee_member_name_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																	</div>
																	<div class="row">
																		<section class="col-md-6">
																			<div class="form-group">
																				<label class="control-label">Committee Manager Name<span>*</span></label>
																				<input type="text" class="form-control" name="rn_committee_manager_name_<?php echo $locale['id']; ?>" id="rn_committee_manager_name_<?php echo $locale['id']; ?>"/>
																			</div>
																		</section>
																			</div>
																		</div>
																		<?php 
																	}
																?>
															</div>
															</section>
														</div>
												 </div>
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
								
