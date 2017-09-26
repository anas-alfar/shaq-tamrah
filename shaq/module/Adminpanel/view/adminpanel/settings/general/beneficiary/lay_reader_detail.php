<div class="tab-pane" id="lay_reader_detail">
<div class="tabs-main-heading">	
	<span class="tabs-title">Lay Reader Detail Info </span>
	<button id="btnSaveLayReaderDetail" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Next
	</button>
	</div>

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
     	<form id="frmLayReaderDetail" name="frmLayReaderDetail">
		<div class="tab-content mt20">
			<div id="lrd-tabs-<?php echo $this->global_locale_id; ?>" class="tab-pane fade in active">
				<div class="row">
					<section class="col-md-6">
						<div class="form-group">
							<label class="control-label">Volunteer Type<span>*</span></label>
							<select type="select" class="select2" name="volunteer_type_id" id="volunteer_type_id">
							<option value="0">Select Volunteer Type</option>
							</select>
						</div>
						<div class="form-group">
							<label class="control-label">Details<span>*</span></label>
							<input type="text" class="form-control" name="details_<?php echo $this->global_locale_id; ?>" id="details_<?php echo $this->global_locale_id; ?>"/>
						</div>						
					</section>
					<section class="col-md-6">
						<div class="form-group">
							<label class="control-label">Address<span></span></label>
							<textarea type="text" class="description form-control" name="address_<?php echo $this->global_locale_id; ?>" id="address_<?php echo $this->global_locale_id; ?>"></textarea>
						</div>
					</section>
				</div>
				<div class="row">
					<section class="col-md-6">
						<div class="form-group">
							<label class="control-label">Volunteer Activity<span>*</span></label>
							<input type="text" class="form-control" name="name_<?php echo $this->global_locale_id; ?>" id="name_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>
					<section class="col-md-6">
						<div class="form-group">
							<label class="control-label">Volunteer Activity Description<span></span></label>
							<textarea type="text" class="description form-control" name="description_<?php echo $this->global_locale_id; ?>" id="description_<?php echo $this->global_locale_id; ?>"></textarea>
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
					<div id="lrd-tabs-<?php echo $locale['id']; ?>" class="tab-pane fade">
						<div class="row">
							<section class="col-md-6">
								<div class="form-group">
									<label class="control-label">Details<span>*</span></label>
									<input type="text" class="form-control" name="details_<?php echo $locale['id']; ?>" id="details_<?php echo $locale['id']; ?>"/>
								</div>
							</section>
							<section class="col-md-6">
								<div class="form-group">
									<label class="control-label">Address<span></span></label>
									<textarea type="text" class="description form-control" name="address_<?php echo $locale['id']; ?>" id="address_<?php echo $locale['id']; ?>"></textarea>
								</div>
							</section>
						</div>
						<div class="row">
							<section class="col-md-6">
								<div class="form-group">
									<label class="control-label">Volunteer Activity<span>*</span></label>
									<input type="text" class="form-control" name="name_<?php echo $locale['id']; ?>" id="name_<?php echo $locale['id']; ?>"/>
								</div>
							</section>
							<section class="col-md-6">
								<div class="form-group">
									<label class="control-label">Volunteer Activity Description<span></span></label>
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
	function layReaderDetailJsFunctions()
	{
		$('#btnSaveLayReaderDetail').click(function(e){
			 e.preventDefault();
			 $("#frmLayReaderDetail").submit();			
		});
		
	$('#frmLayReaderDetail').bootstrapValidator({
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
						details_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter details '						
								}
							}
						},
						<?php 
					} 
				?>
				volunteer_type_id: {
					validators: {
					   callback: {
							message: 'Please select volunteer type ',
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
			savefrmLayReaderDetailData();
		});
		var volunteer_type=$("#frmLayReaderDetail").find("#volunteer_type_id");
		var volunteer_type_array=[volunteer_type];	
		populateOptionValuesBulk(volunteer_type_array,"<?php echo $this->url('adminpanel/volunteer-types', array('action'=>'getvolunteertype'));?>","Select Volunteer Type");
	}
	function savefrmLayReaderDetailData()
	{
		var $form = $('#frmLayReaderDetail');
		var objMasterData = $form.serializeObject();
		
		objMasterData = JSON.stringify(objMasterData);

		var objFormData =
		{
			FORM_DATA: objMasterData,
			beneficiaryID : beneficiaryID,
		};
		hideShowLoaderActive(true);
		var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'saveLayReaderDetail'));?>", objFormData);
		if (objMyPost.ERR_NO === 0) {
			if (objMyPost.DATA.DBStatus === 'OK') {
				hideShowLoaderActive(false);		
				callNextTab('lay_reader_detail');
			}
		}
		else {
			hideShowLoaderActive(false);
			mySmallAlert('Error...!', 'There was an error', 0);
		}
	}
</script>