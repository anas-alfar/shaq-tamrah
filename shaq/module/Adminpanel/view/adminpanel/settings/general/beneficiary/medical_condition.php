<div class="tab-pane" id="medical_condition">
<div class="tabs-main-heading">	
	<span class="tabs-title">Medical Condition Info </span>
	<button id="btnSaveMedicalCondition" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Save
	</button>
	<button id="btnNextFromMedicalCondition" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Next
	</button>
	</div>

	<div id="tabs">
		<ul class="nav nav-tabs" id="langFormIDMedicalCondition">
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
      <form id="frmMedicalCondition" name="frmMedicalCondition">
		<div class="tab-content mt20">
			<div id="mc-tabs-<?php echo $this->global_locale_id; ?>" class="tab-pane fade in active">
				<div class="row">
					<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Beneficiary Profile Family<span>*</span></label>
							<select class="select2" id="beneficiary_profile_family_id" name="beneficiary_profile_family_id" type="select">														
								<option value="0">Select Beneficiary Profile Family</option>
							</select> 
					</div>
				</section>
				</div>
				<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Current Medical Condition<span>*</span></label>
							<textarea class="form-control" name="current_medical_condition_<?php echo $this->global_locale_id; ?>" id="current_medical_condition_<?php echo $this->global_locale_id; ?>"></textarea>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Medical History<span>*</span></label>
							<textarea class="form-control" name="medical_history_<?php echo $this->global_locale_id; ?>" id="medical_history_<?php echo $this->global_locale_id; ?>"></textarea>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Surgical History<span>*</span></label>
							<textarea class="form-control" name="surgical_history_<?php echo $this->global_locale_id; ?>" id="surgical_history_<?php echo $this->global_locale_id; ?>"></textarea>
						</div>
					</section>
				</div>
				<div class="row">	
					
					<section class="col-md-6">
						<div class="form-group">
							<label class="control-label">Family History<span>*</span></label>
							<textarea class="form-control" name="family_history_<?php echo $this->global_locale_id; ?>" id="family_history_<?php echo $this->global_locale_id; ?>"></textarea>
						</div>
					</section>
					<section class="col-md-6">
						<div class="form-group">
							<label class="control-label">Treatment History<span>*</span></label>
							<textarea class="form-control" name="treatment_history_<?php echo $this->global_locale_id; ?>" id="treatment_history_<?php echo $this->global_locale_id; ?>"></textarea>
						</div>
					</section>
				</div>
				<div class="row">	
					
					<section class="col-md-6">
						<div class="form-group">
							<label class="control-label">Lab Results History<span>*</span></label>
							<textarea type="text" class="form-control" name="lab_results_history_<?php echo $this->global_locale_id; ?>" id="lab_results_history_<?php echo $this->global_locale_id; ?>"></textarea>
						</div>
					</section>
					<section class="col-md-6">
						<div class="form-group">
							<label class="control-label">Prescription History<span>*</span></label>
							<textarea class="form-control" name="prescription_history_<?php echo $this->global_locale_id; ?>" id="prescription_history_<?php echo $this->global_locale_id; ?>"></textarea>
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
					<div id="mc-tabs-<?php echo $locale['id']; ?>" class="tab-pane fade">
						<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Current Medical Condition<span>*</span></label>
							<textarea class="form-control" name="current_medical_condition_<?php echo $locale['id']; ?>" id="current_medical_condition_<?php echo $locale['id']; ?>"></textarea>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Medical History<span>*</span></label>
							<textarea class="form-control" name="medical_history_<?php echo $locale['id']; ?>" id="medical_history_<?php echo $locale['id']; ?>" ></textarea>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Surgical History<span>*</span></label>
							<textarea class="form-control" name="surgical_history_<?php echo $locale['id']; ?>" id="surgical_history_<?php echo $locale['id']; ?>" ></textarea>
						</div>
					</section>
				</div>
				<div class="row">
					<section class="col-md-6">
						<div class="form-group">
							<label class="control-label">Family History<span>*</span></label>
							<textarea class="form-control" name="family_history_<?php echo $locale['id']; ?>" id="family_history_<?php echo $locale['id']; ?>" ></textarea>
						</div>
					</section>
					<section class="col-md-6">
						<div class="form-group">
							<label class="control-label">Treatment History<span>*</span></label>
							<textarea class="form-control" name="treatment_history_<?php echo $locale['id']; ?>" id="treatment_history_<?php echo $locale['id']; ?>" ></textarea>
						</div>
					</section>
				</div>
				<div class="row">
					<section class="col-md-6">
						<div class="form-group">
							<label class="control-label">Lab Results History<span>*</span></label>
							<textarea class="form-control" name="lab_results_history_<?php echo $locale['id']; ?>" id="lab_results_history_<?php echo $locale['id']; ?>" ></textarea>
						</div>
					</section>	
					<section class="col-md-6">
						<div class="form-group">
							<label class="control-label">Prescription History<span>*</span></label>
							<textarea class="form-control" name="prescription_history_<?php echo $locale['id']; ?>" id="prescription_history_<?php echo $locale['id']; ?>" ></textarea>



						</div>
					</section>
				</div>
					</div>
					<?php 
				}
			?>
		</div>
	  </form>
	  <table id="tblMasterListMedicalCondition" class="table table-striped table-bordered mt30" width="100%">	
	<thead>		
		<tr>
			<th>Id</th>
			<th data-class="expand">Beneficiary Name</th>
			<th data-hide="phone,tablet">Current Medical Condition</th>
			<th data-hide="phone,tablet">Medical History</th>
			<th data-hide="phone,tablet">Surgical History</th>
			<th data-hide="phone,tablet">Family History</th>
			<th data-hide="phone,tablet">Treatment History</th>
			<th data-hide="phone" class="action">Action</th>
		</tr>
	</thead>							
	<tbody></tbody>							
</table>	
		</section>
	</div>
</div>
 
<script language="javascript">
	var gridDataMedicalCondition = [];
	var oTableMedicalCondition;
	var strActionModeMedicalCondition = 'ADD';
	var iActiveMedicalConditionID = 0;
	function fetch_grid_data_medicalCondition()
	{
		resetFormLocales('frmMedicalCondition','langFormIDMedicalCondition');
		strActionModeMedicalCondition = 'ADD';
		iActiveMedicalConditionID = 0;
		
		var objFormData = { 
			beneficiaryID : beneficiaryID,
		}
		$.ajax({
		  type: "POST",
		  url: "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'listMedicalCondition'));?>",
		  data: objFormData,
		  dataType: "json",
		  success: function(data){
				gridDataMedicalCondition = data.aaData;
				$("#tblMasterListMedicalCondition").find("tbody").html("");
				oTableMedicalCondition.clear().draw();
				oTableMedicalCondition.rows.add(gridDataMedicalCondition); // Add new data
				oTableMedicalCondition.columns.adjust().draw(); // Redraw the DataTable
				
		  }
		});		
	}
	function medicalConditionJsFunctions()
	{
		var responsiveHelper_tblMasterListMedicalCondition = undefined;			
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		oTableMedicalCondition = $('#tblMasterListMedicalCondition').DataTable({
			"bLengthChange": true,
			"bAutoWidth": true,
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>l>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"oLanguage": {
				"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
			},
			"bProcessing": false,
			"bServerSide": false,
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"autoWidth" : true,		
			"autoWidth" : true,
			"preDrawCallback" : function() {
				if (!responsiveHelper_tblMasterListMedicalCondition) {
					responsiveHelper_tblMasterListMedicalCondition = new ResponsiveDatatablesHelper($('#tblMasterListMedicalCondition'), breakpointDefinition);
					
				}
			},				
			"createdRow": function( nRow, data, dataIndex ) {
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_tblMasterListMedicalCondition.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_tblMasterListMedicalCondition.respond();
			},	
			"aaData": gridDataMedicalCondition,
			"aoColumns": [
				{ "bSearchable": false, "bVisible": false },                  
				null,
				null,
				null,
				null,
				null,
				null,
				{"bSearchable": false, "bSortable": false,
					"mRender" : function (data, type, full) {
						return detail_grid_buttons(full[0]);
					}
				}
			],
			"columnDefs": [
				{ className: "hidden", "targets": [ 0 ] }
			]	
		});	
		$("#tblMasterListMedicalCondition").delegate('a.edit', 'click', function (e) {
			e.preventDefault();		
			strActionModeMedicalCondition = 'EDIT';
			iActiveMedicalConditionID = $(this).attr("row-id");
			resetFormLocales('frmMedicalCondition','langFormIDMedicalCondition');
			populateEditEntriesDetail(iActiveMedicalConditionID,'frmMedicalCondition',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getrecMedicalCondition'));?>");
			$('ul#langFormIDMedicalCondition li').each(function(){
			   $(this).find('i').removeClass('fa-check').removeClass('fa-times');
			});			
		});
		fnDeleteDetail('tblMasterListMedicalCondition','medical_condition',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'deleteMedicalCondition'));?>");
		
		$('#btnSaveMedicalCondition').click(function(e){
			 e.preventDefault();
			 $("#frmMedicalCondition").submit();			 			
		});
		$('#btnNextFromMedicalCondition').click(function(e){
			 e.preventDefault();
			 callNextTab('medical_condition');			 			
		});
		
		$('#frmMedicalCondition').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
					beneficiary_profile_family_id: {
						validators: {
						   callback: {
								message: 'Please select beneficiary profile family ',
								callback: function (value, validator, $field) {
								   return (value != 0 && value != null && value != '');
								}
							}
						}
					},
				<?php
					foreach($this->activeLocalesArray as $locale)
					{
						?>
						current_medical_condition_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter current medical condition '						
								}
							}
						},
						medical_history_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter medical history '						
								}
							}
						},
						surgical_history_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter surgical history '						
								}
							}
						},
						family_history_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter family history '						
								}
							}
						},
						treatment_history_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter treatment history '						
								}
							}
						},
						lab_results_history_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter lab results history '						
								}
							}
						},
						prescription_history_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter prescription history '						
								}
							}
						},
						<?php 
					} 
				?>
			}
		}) 
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmMedicalConditionData();
		});
	}	
	function savefrmMedicalConditionData()
	{		
		//Validate  duplicate
		/*var objFormData = {
			ssn : $("#frmMedicalCondition").find("#ssn").val(),
		}
		var isDuplicate = fn_validate_duplicate_multiple('beneficiary_profile_family',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'validateduplicateDetail'));?>",iActiveMedicalConditionID,objFormData)
		if (isDuplicate) {
			mySmallAlert('Duplicate Error...!', 'Duplicate Found. SSN is Already exists !', 0);
			return false;
		}*/
				
		var $form = $('#frmMedicalCondition');
		var objMasterData = $form.serializeObject();
		
		if (strActionModeMedicalCondition == 'ADD')
			$.extend(objMasterData, { MASTER_KEY_ID: 0});
		else
			$.extend(objMasterData, { MASTER_KEY_ID: iActiveMedicalConditionID});
		
		objMasterData = JSON.stringify(objMasterData);

		var objFormData =
		{
			FORM_DATA: objMasterData,
			beneficiaryID : beneficiaryID,
			pAction : strActionModeMedicalCondition,
		};
		hideShowLoaderActive(true);
		var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'saveMedicalCondition'));?>", objFormData);
		if (objMyPost.ERR_NO === 0) {
			if (objMyPost.DATA.DBStatus === 'OK') {
				//resetFormLocales('frmMedicalCondition','langFormIDMedicalCondition');
				strActionModeMedicalCondition = 'ADD';
				iActiveMedicalConditionID = 0;
				fetch_grid_data_medicalCondition();
				hideShowLoaderActive(false);
			}
		}
		else {
			hideShowLoaderActive(false);
			mySmallAlert('Error...!', 'There was an error', 0);
		}
	}
</script>