<div class="tab-pane" id="researcher_notes">
<div class="tabs-main-heading">	
	<span class="tabs-title">Researcher Notes Info </span>
	<button id="btnSaveResearcherNotes" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Next
	</button>
	</div>

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
     	<form id="frmResearcherNotes" name="frmResearcherNotes">
		<div class="tab-content mt20">
			<div id="rn-tabs-<?php echo $this->global_locale_id; ?>" class="tab-pane fade in active">
				<div class="row">
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
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Committee Recommendations<span>*</span></label>
							<input type="text" class="form-control" name="committee_recommendations_<?php echo $this->global_locale_id; ?>" id="committee_recommendations_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>
				</div>	
				<div class="row">
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
				</div>
				<div class="row">
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
				</div>
				<div class="row">
					
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
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Small Business Idea Description<span></span></label>
							<textarea type="text" class="description form-control" name="small_business_idea_description_<?php echo $this->global_locale_id; ?>" id="small_business_idea_description_<?php echo $this->global_locale_id; ?>"></textarea>
						</div>
					</section>
					<section class="col-md-4">
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
					<div id="rn-tabs-<?php echo $locale['id']; ?>" class="tab-pane fade">
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
							<input type="text" class="form-control" name="researcher_name_<?php echo $locale['id']; ?>" id="researcher_name_<?php echo $locale['id']; ?>>"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Committee Recommendations<span>*</span></label>
							<input type="text" class="form-control" name="committee_recommendations_<?php echo $locale['id']; ?>" id="committee_recommendations_<?php echo $locale['id']; ?>>"/>
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
		</section>
	</div>
</div>
 <script language="javascript">
	function savefrmResearcherNotesData()
	{
		
				callNextTab('researcher_notes');
			
	}
	function researcherNotesJsFunctions()
	{
		$('#btnSaveResearcherNotes').click(function(e){
			 e.preventDefault();
			 $("#frmResearcherNotes").submit();			
		});
		
		$('#frmResearcherNotes').bootstrapValidator({
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
						researcher_recommendations_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter researcher recommendations '						
								}
							}
						},
						researcher_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter researcher name '						
								}
							}
						},
						committee_recommendations_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter committee recommendations '						
								}
							}
						},
						committee_member_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter committee member name '						
								}
							}
						},
						committee_manager_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter committee manager name '						
								}
							}
						},
						<?php 
					} 
				?>
				support_type: {
					validators: {
					   callback: {
							message: 'Please select support type ',
							callback: function (value, validator, $field) {
							   return (value != 0 && value != null && value != '');
							}
						}
					}
				},
				support_period: {
					validators: {
					   callback: {
							message: 'Please select support period',
							callback: function (value, validator, $field) {
							   return (value != 0 && value != null && value != '');
							}
						}
					}
				},
				expected_support_period: {
					validators: {
					   callback: {
							message: 'Please select expected support period',
							callback: function (value, validator, $field) {
							   return (value != 0 && value != null && value != '');
							}
						}
					}
				},
				support_modality: {
					validators: {
					   callback: {
							message: 'Please select support modality',
							callback: function (value, validator, $field) {
							   return (value != 0 && value != null && value != '');
							}
						}
					}
				},
				information_source: {
					validators: {
					   callback: {
							message: 'Please select information source',
							callback: function (value, validator, $field) {
							   return (value != 0 && value != null && value != '');
							}
						}
					}
				}
			}
		}) 
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmResearcherNotesData();
		});
		
	}
</script>												 
												 