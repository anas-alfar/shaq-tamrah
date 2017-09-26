<div class="tab-pane" id="family_extra_detail">
	<div class="tabs-main-heading">	
	<span class="tabs-title">Family Extra Detail Info </span>
	<button id="btnSaveFamilyExtraDetail" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Save
	</button>
	<button id="btnNextFromFamilyExtraDetail" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Next
	</button>
	</div>

	<section>
	  <form id="frmFamilyExtraDetail" name="frmFamilyExtraDetail">
		<div class="tab-content">
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
						<label class="control-label">Beneficiary Profile Family Flag<span>*</span></label>
							<select class="select2" id="beneficiary_profile_family_flag_id" name="beneficiary_profile_family_flag_id" type="select">														
								<option value="0">Select Beneficiary Profile Family Flag</option>
							</select> 
					</div>
				</section>
				<section class="col-md-4">
					<div class="form-group">
						<label>&nbsp;</label>
						<label class="customwidth">
							<span class="onoffswitch">															
								<input name="flag_value" class="onoffswitch-checkbox" id="flag_value" type="checkbox"/>
								<label class="onoffswitch-label" for="flag_value">
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
	  </form>
	  <table id="tblMasterListFamilyExtraDetail" class="table table-striped table-bordered mt30" width="100%">	
	<thead>		
		<tr>
			<th>Id</th>
			<th data-class="expand">Family Name</th>
			<th data-hide="phone,tablet">Flag</th>
			<th data-hide="phone,tablet">Flag Value</th>
			<th data-hide="phone" class="action">Action</th>
		</tr>
	</thead>							
	<tbody></tbody>							
</table>
	</section>
</div>
<script language="javascript">
	var gridDataFamilyExtraDetail = [];
	var oTableFamilyExtraDetail;
	var strActionModeFamilyExtraDetail = 'ADD';
	var iActiveFamilyExtraDetailID = 0;
	function fetch_grid_data_familyExtraDetail()
	{
		resetFormSimple('frmFamilyExtraDetail');
		strActionModeFamilyExtraDetail = 'ADD';
		iActiveFamilyExtraDetailID = 0;
		
		var objFormData = { 
			beneficiaryID : beneficiaryID,
		}
		$.ajax({
		  type: "POST",
		  url: "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'listFamilyExtraDetail'));?>",
		  data: objFormData,
		  dataType: "json",
		  success: function(data){
				gridDataFamilyExtraDetail = data.aaData;
				$("#tblMasterListFamilyExtraDetail").find("tbody").html("");
				oTableFamilyExtraDetail.clear().draw();
				oTableFamilyExtraDetail.rows.add(gridDataFamilyExtraDetail); // Add new data
				oTableFamilyExtraDetail.columns.adjust().draw(); // Redraw the DataTable
				
		  }
		});		
	}
	function familyExtraDetailJsFunctions()
	{
		var responsiveHelper_tblMasterListFamilyExtraDetail = undefined;			
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		oTableFamilyExtraDetail = $('#tblMasterListFamilyExtraDetail').DataTable({
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
				if (!responsiveHelper_tblMasterListFamilyExtraDetail) {
					responsiveHelper_tblMasterListFamilyExtraDetail = new ResponsiveDatatablesHelper($('#tblMasterListFamilyExtraDetail'), breakpointDefinition);
					
				}
			},				
			"createdRow": function( nRow, data, dataIndex ) {
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_tblMasterListFamilyExtraDetail.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_tblMasterListFamilyExtraDetail.respond();
			},	
			"aaData": gridDataFamilyExtraDetail,
			"aoColumns": [
				{ "bSearchable": false, "bVisible": false },                  
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
		$("#tblMasterListFamilyExtraDetail").delegate('a.edit', 'click', function (e) {
			e.preventDefault();		
			strActionModeFamilyExtraDetail = 'EDIT';
			iActiveFamilyExtraDetailID = $(this).attr("row-id");
			resetFormSimple('frmFamilyExtraDetail');
			populateEditEntriesDetail(iActiveFamilyExtraDetailID,'frmFamilyExtraDetail',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getrecFamilyExtraDetail'));?>");					
		});
		fnDeleteDetail('tblMasterListFamilyExtraDetail','family_extra_detail',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'deleteFamilyExtraDetail'));?>");
		
		$('#btnSaveFamilyExtraDetail').click(function(e){
			 e.preventDefault();
			 $("#frmFamilyExtraDetail").submit();			 			
		});
		$('#btnNextFromFamilyExtraDetail').click(function(e){
			 e.preventDefault();
			 callNextTab('family_extra_detail');			 			
		});
		
		$('#frmFamilyExtraDetail').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				beneficiary_profile_family_flag_id: {
                    validators: {
                       callback: {
                            message: 'Please select beneficiary profile family flag',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				beneficiary_profile_family_id: {
                    validators: {
                       callback: {
                            message: 'Please select beneficiary profile family ',
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
			savefrmFamilyExtraDetailData();
		});
		
		var profile_family_flag=$("#frmFamilyExtraDetail").find("#beneficiary_profile_family_flag_id");
		var profile_family_flag_array=[profile_family_flag];	
		populateOptionValuesBulk(profile_family_flag_array,"<?php echo $this->url('adminpanel/family-flags', array('action'=>'getprofilefamilyflag'));?>","Select Beneficiary Profile Family Flag");
	
		
		

	}	
	function savefrmFamilyExtraDetailData()
	{		
		//Validate  duplicate
		/*var objFormData = {
			ssn : $("#frmFamilyExtraDetail").find("#ssn").val(),
		}
		var isDuplicate = fn_validate_duplicate_multiple('beneficiary_profile_family',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'validateduplicateDetail'));?>",iActiveFamilyExtraDetailID,objFormData)
		if (isDuplicate) {
			mySmallAlert('Duplicate Error...!', 'Duplicate Found. SSN is Already exists !', 0);
			return false;
		}*/
				
		var $form = $('#frmFamilyExtraDetail');
		var objMasterData = $form.serializeObject();
		
		if (strActionModeFamilyExtraDetail == 'ADD')
			$.extend(objMasterData, { MASTER_KEY_ID: 0});
		else
			$.extend(objMasterData, { MASTER_KEY_ID: iActiveFamilyExtraDetailID});
		
		objMasterData = JSON.stringify(objMasterData);

		var objFormData =
		{
			FORM_DATA: objMasterData,
			beneficiaryID : beneficiaryID,
			pAction : strActionModeFamilyExtraDetail,
		};
		hideShowLoaderActive(true);
		var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'saveFamilyExtraDetail'));?>", objFormData);
		if (objMyPost.ERR_NO === 0) {
			if (objMyPost.DATA.DBStatus === 'OK') {
				//resetFormSimple('frmFamilyExtraDetail');
				strActionModeFamilyExtraDetail = 'ADD';
				iActiveFamilyExtraDetailID = 0;
				fetch_grid_data_familyExtraDetail();
				hideShowLoaderActive(false);
			}
		}
		else {
			hideShowLoaderActive(false);
			mySmallAlert('Error...!', 'There was an error', 0);
		}
	}
</script>