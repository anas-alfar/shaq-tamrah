<div class="tab-pane" id="education_detail">
<div class="tabs-main-heading">	
	<span class="tabs-title">Education Detail Info </span>
	<button id="btnSaveEducationDetail" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Save
	</button>
	<button id="btnNextFromEducationDetail" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Next
	</button>
	</div>

	<div id="tabs">
		<ul class="nav nav-tabs" id="langFormIDEducationDetail">
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
     	<form id="frmEducationDetail" name="frmEducationDetail">
			<div class="tab-content mt20">
			<div id="edu-tabs-<?php echo $this->global_locale_id; ?>" class="tab-pane fade in active">
				<div class="row">
					<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Beneficiary Profile Family<span>*</span></label>
							<select class="select2" id="beneficiary_profile_family_id" name="beneficiary_profile_family_id" type="select">														
								<option value="0">Select Beneficiary Profile Family</option>
							</select> 
					</div>
				</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Institute Name<span>*</span></label>
							<input type="text" class="form-control" name="institute_name_<?php echo $this->global_locale_id; ?>" id="institute_name_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">School Name<span>*</span></label>
							<input type="text" class="form-control" name="school_name_<?php echo $this->global_locale_id; ?>" id="school_name_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>					
				</div>
				<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Level Name<span>*</span></label>
							<input type="text" class="form-control" name="level_name_<?php echo $this->global_locale_id; ?>" id="level_name_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Major Name<span>*</span></label>
							<input type="text" class="form-control" name="major_name_<?php echo $this->global_locale_id; ?>" id="major_name_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Class Name<span>*</span></label>
							<input type="text" class="form-control" name="class_name_<?php echo $this->global_locale_id; ?>" id="class_name_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>					
				</div>
				<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">School Type<span>*</span></label>
							<select type="select" class="select2" name="school_type" id="school_type">
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
						<div class="form-group">
							<label class="control-label">Final Grade<span>*</span></label>
							<input type="text" class="form-control" name="final_grade_<?php echo $this->global_locale_id; ?>" id="final_grade_<?php echo $this->global_locale_id; ?>"/>
						</div>						
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Start At<span>*</span></label>
							<input type="text" class="form-control" name="start_at" id="start_at"/>
						</div>
						<div class="form-group">
							<label class="control-label">End At<span>*</span></label>
							<input type="text" class="form-control" name="end_at" id="end_at"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Address<span></span></label>
							<textarea type="text" class="description form-control" name="address_<?php echo $this->global_locale_id; ?>" id="address_<?php echo $this->global_locale_id; ?>"></textarea>
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
					<div id="edu-tabs-<?php echo $locale['id']; ?>" class="tab-pane fade">
						<div class="row">
							<section class="col-md-4">
								<div class="form-group">
									<label class="control-label">Institute Name<span>*</span></label>
									<input type="text" class="form-control" name="institute_name_<?php echo $locale['id']; ?>" id="institute_name_<?php echo $locale['id']; ?>"/>
								</div>
							</section>
							<section class="col-md-4">
								<div class="form-group">
									<label class="control-label">School Name<span>*</span></label>
									<input type="text" class="form-control" name="school_name_<?php echo $locale['id']; ?>" id="school_name_<?php echo $locale['id']; ?>"/>
								</div>
							</section>
							<section class="col-md-4">
								<div class="form-group">
									<label class="control-label">Level Name<span>*</span></label>
									<input type="text" class="form-control" name="level_name_<?php echo $locale['id']; ?>" id="level_name_<?php echo $locale['id']; ?>"/>
								</div>
							</section>
						</div>
						<div class="row">
							<section class="col-md-4">
								<div class="form-group">
									<label class="control-label">Major Name<span>*</span></label>
									<input type="text" class="form-control" name="major_name_<?php echo $locale['id']; ?>" id="major_name_<?php echo $locale['id']; ?>"/>
								</div>
								<div class="form-group">
									<label class="control-label">Final Grade<span>*</span></label>
									<input type="text" class="form-control" name="final_grade_<?php echo $locale['id']; ?>" id="final_grade_<?php echo $locale['id']; ?>"/>
								</div>
							</section>
							<section class="col-md-4">
								<div class="form-group">
									<label class="control-label">Class Name<span>*</span></label>
									<input type="text" class="form-control" name="class_name_<?php echo $locale['id']; ?>" id="class_name_<?php echo $locale['id']; ?>"/>
								</div>
							</section>	
							<section class="col-md-4">
								<div class="form-group">
									<label class="control-label">Address<span></span></label>
									<textarea type="text" class="description form-control" name="address_<?php echo $locale['id']; ?>" id="address_<?php echo $locale['id']; ?>"></textarea>
								</div>
							</section>
						</div>
					</div>
					<?php 
				}
			?>
		</div>
		</form>
		<table id="tblMasterListEducationDetail" class="table table-striped table-bordered mt30" width="100%">	
	<thead>		
		<tr>
			<th>Id</th>
			<th data-class="expand">Beneficiary Name</th>
			<th data-hide="phone,tablet">School Type</th>
			<th data-hide="phone,tablet">Start At</th>
			<th data-hide="phone,tablet">End At</th>
			<th data-hide="phone,tablet">Institute Name</th>
			<th data-hide="phone,tablet">Final Grade</th>
			<th data-hide="phone" class="action">Action</th>
		</tr>
	</thead>							
	<tbody></tbody>							
</table>
		</section>
	</div>
</div> 												 
<script language="javascript">
	var gridDataEducationDetail = [];
	var oTableEducationDetail;
	var strActionModeEducationDetail = 'ADD';
	var iActiveEducationDetailID = 0;
	function fetch_grid_data_educationDetail()
	{
		resetFormLocales('frmEducationDetail','langFormIDEducationDetail');
		strActionModeEducationDetail = 'ADD';
		iActiveEducationDetailID = 0;
		
		var objFormData = { 
			beneficiaryID : beneficiaryID,
		}
		$.ajax({
		  type: "POST",
		  url: "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'listEducationDetail'));?>",
		  data: objFormData,
		  dataType: "json",
		  success: function(data){
				gridDataEducationDetail = data.aaData;
				$("#tblMasterListEducationDetail").find("tbody").html("");
				oTableEducationDetail.clear().draw();
				oTableEducationDetail.rows.add(gridDataEducationDetail); // Add new data
				oTableEducationDetail.columns.adjust().draw(); // Redraw the DataTable
				
		  }
		});		
	}
	function educationDetailJsFunctions()
	{
		var responsiveHelper_tblMasterListEducationDetail = undefined;			
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		oTableEducationDetail = $('#tblMasterListEducationDetail').DataTable({
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
				if (!responsiveHelper_tblMasterListEducationDetail) {
					responsiveHelper_tblMasterListEducationDetail = new ResponsiveDatatablesHelper($('#tblMasterListEducationDetail'), breakpointDefinition);
					
				}
			},				
			"createdRow": function( nRow, data, dataIndex ) {
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_tblMasterListEducationDetail.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_tblMasterListEducationDetail.respond();
			},	
			"aaData": gridDataEducationDetail,
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
		$("#tblMasterListEducationDetail").delegate('a.edit', 'click', function (e) {
			e.preventDefault();		
			strActionModeEducationDetail = 'EDIT';
			iActiveEducationDetailID = $(this).attr("row-id");
			resetFormLocales('frmEducationDetail','langFormIDEducationDetail');
			populateEditEntriesDetail(iActiveEducationDetailID,'frmEducationDetail',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getrecEducationDetail'));?>");
			$('ul#langFormIDEducationDetail li').each(function(){
			   $(this).find('i').removeClass('fa-check').removeClass('fa-times');
			});			
		});
		fnDeleteDetail('tblMasterListEducationDetail','education_detail',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'deleteEducationDetail'));?>");
		
		$('#btnSaveEducationDetail').click(function(e){
			 e.preventDefault();
			 $("#frmEducationDetail").submit();			 			
		});
		$('#btnNextFromEducationDetail').click(function(e){
			 e.preventDefault();
			 callNextTab('education_detail');			 			
		});
		
		$('#frmEducationDetail').bootstrapValidator({
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
						institute_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter institute name '						
								}
							}
						},
						school_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter school name '						
								}
							}
						},
						level_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter level name '						
								}
							}
						},
						major_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter major name '						
								}
							}
						},
						final_grade_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter final grade '						
								},
								numeric: {
									message: 'The construction area in square meter is not valid',
									decimalSeparator: '.'
								}
							}
						},
						class_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter class name '						
								}
							}
						},
						
						<?php 
					} 
				?>
				school_type: {
					validators: {
					   callback: {
							message: 'Please select school type',
							callback: function (value, validator, $field) {
							   return (value != 0 && value != null && value != '');
							}
						}
					}
				},
				end_at: {
					validators : {
						notEmpty : {
							message : 'Please enter end at '						
						}
					}
				},
				start_at : {
					validators : {
						notEmpty : {
							message : 'Please enter start at '						
						}
					}
				}
						
				
			}
		}) 
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmEducationDetailData();
		});
		$("#start_at").datepicker();
		$("#end_at").datepicker();
	}	
	function savefrmEducationDetailData()
	{		
		//Validate  duplicate
		/*var objFormData = {
			ssn : $("#frmEducationDetail").find("#ssn").val(),
		}
		var isDuplicate = fn_validate_duplicate_multiple('beneficiary_profile_family',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'validateduplicateDetail'));?>",iActiveEducationDetailID,objFormData)
		if (isDuplicate) {
			mySmallAlert('Duplicate Error...!', 'Duplicate Found. SSN is Already exists !', 0);
			return false;
		}*/
				
		var $form = $('#frmEducationDetail');
		var objMasterData = $form.serializeObject();
		
		if (strActionModeEducationDetail == 'ADD')
			$.extend(objMasterData, { MASTER_KEY_ID: 0});
		else
			$.extend(objMasterData, { MASTER_KEY_ID: iActiveEducationDetailID});
		
		objMasterData = JSON.stringify(objMasterData);

		var objFormData =
		{
			FORM_DATA: objMasterData,
			beneficiaryID : beneficiaryID,
			pAction : strActionModeEducationDetail,
		};
		hideShowLoaderActive(true);
		var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'saveEducationDetail'));?>", objFormData);
		if (objMyPost.ERR_NO === 0) {
			if (objMyPost.DATA.DBStatus === 'OK') {
				//resetFormLocales('frmEducationDetail','langFormIDEducationDetail');
				strActionModeEducationDetail = 'ADD';
				iActiveEducationDetailID = 0;
				fetch_grid_data_educationDetail();
				hideShowLoaderActive(false);
			}
		}
		else {
			hideShowLoaderActive(false);
			mySmallAlert('Error...!', 'There was an error', 0);
		}
	}
</script>