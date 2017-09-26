<div class="tab-pane" id="medical_extra_detail">
<div class="tabs-main-heading">	
	<span class="tabs-title">Medical Extra Detail Info </span>
	<button id="btnSaveMedicalExtraDetail" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Save
	</button>
	<button id="btnNextFromMedicalExtraDetail" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Next
	</button>
	</div>

	<div id="tabs">
		<ul class="nav nav-tabs" id="langFormIDMedicalExtraDetail">
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
		<form id="frmMedicalExtraDetail" name="frmMedicalExtraDetail">
			<div class="tab-content mt20">
			<div id="med-tabs-<?php echo $this->global_locale_id; ?>" class="tab-pane fade in active">
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
							<label class="control-label">Doctor Name<span>*</span></label>
							<input type="text" class="form-control" name="doctor_name_<?php echo $this->global_locale_id; ?>" id="doctor_name_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Complaint<span>*</span></label>
							<input type="text" class="form-control" name="complaint_<?php echo $this->global_locale_id; ?>" id="complaint_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Examination<span>*</span></label>
							<input type="text" class="form-control" name="examination_<?php echo $this->global_locale_id; ?>" id="examination_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>
				</div>
				<div class="row">
					
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Treatment<span>*</span></label>
							<input type="text" class="form-control" name="treatment_<?php echo $this->global_locale_id; ?>" id="treatment_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Lab Results<span>*</span></label>
							<input type="text" class="form-control" name="lab_results_<?php echo $this->global_locale_id; ?>" id="lab_results_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>	
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Prescription<span>*</span></label>
							<input type="text" class="form-control" name="prescription_<?php echo $this->global_locale_id; ?>" id="prescription_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>
				</div>
				<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Procedure<span>*</span></label>
							<input type="text" class="form-control" name="procedure_<?php echo $this->global_locale_id; ?>" id="procedure_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Comment<span>*</span></label>
							<input type="text" class="form-control" name="comment_<?php echo $this->global_locale_id; ?>" id="comment_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Doctor Mobile Number<span>*</span></label>
							<input type="text" class="form-control" name="doctor_mobile_number" id="doctor_mobile_number"/>
						</div>
					</section>
				</div>
				<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Doctor Phone Number<span>*</span></label>
							<input type="text" class="form-control" name="doctor_phone_number" id="doctor_phone_number"/>
						</div>
					</section>
					<section class="col-md-8">
						<div class="form-group">
							<label class="control-label">Doctor Address<span></span></label>
							<textarea type="text" class="description form-control" name="doctor_address_<?php echo $this->global_locale_id; ?>" id="doctor_address_<?php echo $this->global_locale_id; ?>"></textarea>
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
					<div id="med-tabs-<?php echo $locale['id']; ?>" class="tab-pane fade">
						<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Doctor Name<span>*</span></label>
							<input type="text" class="form-control" name="doctor_name_<?php echo $locale['id']; ?>" id="doctor_name_<?php echo $locale['id']; ?>"/>
						</div>
						
					</section>
					<section class="col-md-4">
					<div class="form-group">
							<label class="control-label">Complaint<span>*</span></label>
							<input type="text" class="form-control" name="complaint_<?php echo $locale['id']; ?>" id="complaint_<?php echo $locale['id']; ?>"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Examination<span>*</span></label>
							<input type="text" class="form-control" name="examination_<?php echo $locale['id']; ?>" id="examination_<?php echo $locale['id']; ?>"/>
						</div>
					</section>
				</div>
				<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Treatment<span>*</span></label>
							<input type="text" class="form-control" name="treatment_<?php echo $locale['id']; ?>" id="treatment_<?php echo $locale['id']; ?>"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Lab Results<span>*</span></label>
							<input type="text" class="form-control" name="lab_results_<?php echo $locale['id']; ?>" id="lab_results_<?php echo $locale['id']; ?>"/>
						</div>
					</section>	
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Prescription<span>*</span></label>
							<input type="text" class="form-control" name="prescription_<?php echo $locale['id']; ?>" id="prescription_<?php echo $locale['id']; ?>"/>
						</div>
					</section>
				</div>
				<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Procedure<span>*</span></label>
							<input type="text" class="form-control" name="procedure_<?php echo $locale['id']; ?>" id="procedure_<?php echo $locale['id']; ?>"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Comment<span>*</span></label>
							<input type="text" class="form-control" name="comment_<?php echo $locale['id']; ?>" id="comment_<?php echo $locale['id']; ?>"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Doctor Address<span></span></label>
							<textarea type="text" class="description form-control" name="doctor_address_<?php echo $locale['id']; ?>" id="doctor_address_<?php echo $locale['id']; ?>"></textarea>
						</div>
					</section>
				</div>
					</div>
					<?php 
				}
			?>
		</div>
		</form>
		<table id="tblMasterListMedicalExtraDetail" class="table table-striped table-bordered mt30" width="100%">	
			<thead>		
				<tr>
					<th>Id</th>
					<th data-class="expand">Doctor Name</th>
					<th data-hide="phone,tablet">Doctor Mobile Number</th>
					<th data-hide="phone,tablet">Complaint</th>
					<th data-hide="phone,tablet">Examination</th>
					<th data-hide="phone,tablet">Treatment</th>
					<th data-hide="phone" class="action">Action</th>
				</tr>
			</thead>							
			<tbody></tbody>							
		</table>
		</section>
	</div>
</div> 												 
<script language="javascript">
	var gridDataMedicalExtraDetail = [];
	var oTableMedicalExtraDetail;
	var strActionModeMedicalExtraDetail = 'ADD';
	var iActiveMedicalExtraDetailID = 0;
	function fetch_grid_data_medicalExtraDetail()
	{
		resetFormLocales('frmMedicalExtraDetail','langFormIDMedicalExtraDetail');
		strActionModeMedicalExtraDetail = 'ADD';
		iActiveMedicalExtraDetailID = 0;
		
		var objFormData = { 
			beneficiaryID : beneficiaryID,
		}
		$.ajax({
		  type: "POST",
		  url: "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'listMedicalExtraDetail'));?>",
		  data: objFormData,
		  dataType: "json",
		  success: function(data){
				gridDataMedicalExtraDetail = data.aaData;
				$("#tblMasterListMedicalExtraDetail").find("tbody").html("");
				oTableMedicalExtraDetail.clear().draw();
				oTableMedicalExtraDetail.rows.add(gridDataMedicalExtraDetail); // Add new data
				oTableMedicalExtraDetail.columns.adjust().draw(); // Redraw the DataTable
				
		  }
		});		
	}
	function medicalExtraDetailJsFunctions()
	{
		var responsiveHelper_tblMasterListMedicalExtraDetail = undefined;			
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		oTableMedicalExtraDetail = $('#tblMasterListMedicalExtraDetail').DataTable({
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
				if (!responsiveHelper_tblMasterListMedicalExtraDetail) {
					responsiveHelper_tblMasterListMedicalExtraDetail = new ResponsiveDatatablesHelper($('#tblMasterListMedicalExtraDetail'), breakpointDefinition);
					
				}
			},				
			"createdRow": function( nRow, data, dataIndex ) {
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_tblMasterListMedicalExtraDetail.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_tblMasterListMedicalExtraDetail.respond();
			},	
			"aaData": gridDataMedicalExtraDetail,
			"aoColumns": [
				{ "bSearchable": false, "bVisible": false },                  
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
		$("#tblMasterListMedicalExtraDetail").delegate('a.edit', 'click', function (e) {
			e.preventDefault();		
			strActionModeMedicalExtraDetail = 'EDIT';
			iActiveMedicalExtraDetailID = $(this).attr("row-id");
			resetFormLocales('frmMedicalExtraDetail','langFormIDMedicalExtraDetail');
			populateEditEntriesDetail(iActiveMedicalExtraDetailID,'frmMedicalExtraDetail',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getrecMedicalExtraDetail'));?>");
			$('ul#langFormIDMedicalExtraDetail li').each(function(){
			   $(this).find('i').removeClass('fa-check').removeClass('fa-times');
			});			
		});
		fnDeleteDetail('tblMasterListMedicalExtraDetail','medical_extra_detail',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'deleteMedicalExtraDetail'));?>");
		
		$('#btnSaveMedicalExtraDetail').click(function(e){
			 e.preventDefault();
			 $("#frmMedicalExtraDetail").submit();			 			
		});
		$('#btnNextFromMedicalExtraDetail').click(function(e){
			 e.preventDefault();
			 callNextTab('medical_extra_detail');			 			
		});
		
		$('#frmMedicalExtraDetail').bootstrapValidator({
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
						doctor_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter doctor name'						
								}
							}
						},
						complaint_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter complaint'						
								}
							}
						},
						examination_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter examination'						
								}
							}
						},
						treatment_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter treatment'						
								}
							}
						},
						lab_results_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter lab results'						
								}
							}
						},
						prescription_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter prescription'						
								}
							}
						},
						procedure_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter procedure '						
								}
							}
						},
						comment_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter comment '						
								}
							}
						},
						<?php 
					} 
				?>
				doctor_mobile_number: {
                    validators: {
						notEmpty : {
							message : 'Please enter doctor mobile number'						
						},
                        numeric: {
                            message: 'The doctor mobile number is not valid',
                        }
                    }
                },
				doctor_phone_number: {
                    validators: {
						notEmpty : {
							message : 'Please enter doctor phone number'						
						},
                        numeric: {
                            message: 'The doctor phone number is not valid',
                        }
                    }
                }
			}
		}) 
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmMedicalExtraDetailData();
		});
	}	
	function savefrmMedicalExtraDetailData()
	{		
		//Validate  duplicate
		/*var objFormData = {
			ssn : $("#frmMedicalExtraDetail").find("#ssn").val(),
		}
		var isDuplicate = fn_validate_duplicate_multiple('beneficiary_profile_family',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'validateduplicateDetail'));?>",iActiveMedicalExtraDetailID,objFormData)
		if (isDuplicate) {
			mySmallAlert('Duplicate Error...!', 'Duplicate Found. SSN is Already exists !', 0);
			return false;
		}*/
				
		var $form = $('#frmMedicalExtraDetail');
		var objMasterData = $form.serializeObject();
		
		if (strActionModeMedicalExtraDetail == 'ADD')
			$.extend(objMasterData, { MASTER_KEY_ID: 0});
		else
			$.extend(objMasterData, { MASTER_KEY_ID: iActiveMedicalExtraDetailID});
		
		objMasterData = JSON.stringify(objMasterData);

		var objFormData =
		{
			FORM_DATA: objMasterData,
			beneficiaryID : beneficiaryID,
			pAction : strActionModeMedicalExtraDetail,
		};
		hideShowLoaderActive(true);
		var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'saveMedicalExtraDetail'));?>", objFormData);
		if (objMyPost.ERR_NO === 0) {
			if (objMyPost.DATA.DBStatus === 'OK') {
				//resetFormLocales('frmMedicalExtraDetail','langFormIDMedicalExtraDetail');
				strActionModeMedicalExtraDetail = 'ADD';
				iActiveMedicalExtraDetailID = 0;
				fetch_grid_data_medicalExtraDetail();
				hideShowLoaderActive(false);
			}
		}
		else {
			hideShowLoaderActive(false);
			mySmallAlert('Error...!', 'There was an error', 0);
		}
	}
</script>												 