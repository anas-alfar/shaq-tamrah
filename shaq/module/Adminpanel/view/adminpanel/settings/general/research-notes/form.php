<section id="widForm" class="hide">	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Research Notes Info </h2>
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
								<div id="tabs-<?php echo $this->global_locale_id; ?>" class="tab-pane fade in active">
									<div class="row">
										<section class="col-md-4">
											<div class="form-group">
												<label class="control-label">Beneficiary<span>*</span></label>
													<select class="select2" id="beneficiary_id" name="beneficiary_id" type="select">														
														<option value="0">Select Beneficiary</option>
													</select> 
											</div>
										</section>
										<section class="col-md-4">
											<div class="form-group">
												<label class="control-label">Researcher Recommendations<span>*</span></label>
												<input type="text" class="form-control" name="researcher_recommendations_<?php echo $this->global_locale_id; ?>" id="researcher_recommendations_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>
										<section class="col-md-4">	
											<div class="form-group">
												<label class="control-label">Researcher Name<span>*</span></label>
												<input type="text" class="form-control" name="researcher_name_<?php echo $this->global_locale_id; ?>" id="researcher_name_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-4">
											<div class="form-group">
												<label class="control-label">Committee Recommendations<span>*</span></label>
												<input type="text" class="form-control" name="committee_recommendations_<?php echo $this->global_locale_id; ?>" id="committee_recommendations_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>
										<section class="col-md-4">	
											<div class="form-group">
												<label class="control-label">Committee Member Name<span>*</span></label>
												<input type="text" class="form-control" name="committee_member_name_<?php echo $this->global_locale_id; ?>" id="committee_member_name_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>
										<section class="col-md-4">
											<div class="form-group">
												<label class="control-label">Committee Manager Name<span>*</span></label>
												<input type="text" class="form-control" name="committee_manager_name_<?php echo $this->global_locale_id; ?>" id="committee_manager_name_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>
									</div>	
									<div class="row">
										<section class="col-md-4">
											<div class="form-group">
												<label class="control-label">Support Type<span>*</span></label>
												<select type="select" class="select2" name="support_type" id="support_type">
												<option value="0">Select Support Type</option>
												<option value="Frequent">Frequent</option>
												<option value="Emergency">Emergency</option>
												<option value="Medical">Medical</option>
												<option value="Educational">Educational</option>
												<option value="Other">Other</option>
												</select>
											</div>
										</section>
										<section class="col-md-4">
											<div class="form-group">
												<label class="control-label">Support Period<span>*</span></label>
												<select type="select" class="select2" name="support_period" id="support_period">
												<option value="0">Select Support Period</option>
												<option value="Permanent">Permanent</option>
												<option value="Once">Once</option>
												<option value="Until healing">Until healing</option>
												<option value="Until graduate">Until graduate</option>
												</select>
											</div>
										</section>
										<section class="col-md-4">
											<div class="form-group">
												<label class="control-label">Expected Support Period<span>*</span></label>
												<select type="select" class="select2" name="expected_support_period" id="expected_support_period">
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
										<section class="col-md-4">
											<div class="form-group">
												<label class="control-label">Support Modality<span>*</span></label>
												<select type="select" class="select2" name="support_modality" id="support_modality">
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
										<section class="col-md-4">
											<div class="form-group">
												<label class="control-label">Information Source<span>*</span></label>
												<select type="select" class="select2" name="information_source" id="information_source">
												<option value="0">Select Information Source</option>
												<option value="Official documents">Official documents</option>
												<option value="Work visit">Work visit</option>
												<option value="Home visit">Home visit</option>
												<option value="Trusted neighbors">Trusted neighbors</option>
												</select>
											</div>
										</section>
										<section class="col-md-4">	
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													Has Small Business Idea
													<span class="onoffswitch">															
														<input name="has_small_business_idea" class="onoffswitch-checkbox" id="has_small_business_idea" type="checkbox">
														<label class="onoffswitch-label" for="has_small_business_idea">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
												</label>
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Small Business Idea Description<span></span></label>
												<textarea type="text" class="description form-control" name="small_business_idea_description_<?php echo $this->global_locale_id; ?>" id="small_business_idea_description_<?php echo $this->global_locale_id; ?>"></textarea>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Notes<span></span></label>
												<textarea type="text" class="description form-control" name="notes_<?php echo $this->global_locale_id; ?>" id="notes_<?php echo $this->global_locale_id; ?>"></textarea>
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
										<div id="tabs-<?php echo $locale['id']; ?>" class="tab-pane fade">
											<div class="row">
												<section class="col-md-4">
													<div class="form-group">
														<label class="control-label">Researcher Recommendations<span>*</span></label>
														<input type="text" class="form-control" name="researcher_recommendations_<?php echo $locale['id']; ?>" id="researcher_recommendations_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
												<section class="col-md-4">	
													<div class="form-group">
														<label class="control-label">Researcher Name<span>*</span></label>
														<input type="text" class="form-control" name="researcher_name_<?php echo $locale['id']; ?>" id="researcher_name_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
												<section class="col-md-4">
													<div class="form-group">
														<label class="control-label">Committee Recommendations<span>*</span></label>
														<input type="text" class="form-control" name="committee_recommendations_<?php echo $locale['id']; ?>" id="committee_recommendations_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
											</div>	
											<div class="row">
												<section class="col-md-4">	
													<div class="form-group">
														<label class="control-label">Committee Member Name<span>*</span></label>
														<input type="text" class="form-control" name="committee_member_name_<?php echo $locale['id']; ?>" id="committee_member_name_<?php echo $locale['id']; ?>"/>
													</div>
													<div class="form-group">
														<label class="control-label">Committee Manager Name<span>*</span></label>
														<input type="text" class="form-control" name="committee_manager_name_<?php echo $locale['id']; ?>" id="committee_manager_name_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
												<section class="col-md-4">
													<div class="form-group">
														<label class="control-label">Notes<span></span></label>
														<textarea type="text" class="description form-control" name="notes_<?php echo $locale['id']; ?>" id="notes_<?php echo $locale['id']; ?>"></textarea>
													</div>
												</section>
												<section class="col-md-4">
													<div class="form-group">
														<label class="control-label">Small Business Idea Description<span></span></label>
														<textarea type="text" class="description form-control" name="small_business_idea_description_<?php echo $locale['id']; ?>" id="small_business_idea_description_<?php echo $locale['id']; ?>"></textarea>
													</div>
												</section>
											</div>
										</div>
										<?php 
									}
								?>
							</div>
						</form>
					 </div>	
				   </div>
				</div>
			 </div>
		</div>
	</div>
</section>	
								
