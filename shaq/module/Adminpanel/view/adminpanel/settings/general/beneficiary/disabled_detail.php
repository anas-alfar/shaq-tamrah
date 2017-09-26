<div class="tab-pane" id="disabled_detail">
	<div class="tabs-main-heading">	
	<span class="tabs-title">Disabled Detail Info </span>
	<button id="btnSaveDisabledDetail" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Save
	</button>
	<button id="btnNextFromDisabledDetail" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Next
	</button>
	</div>
	<section>
	 <form id="frmDisabledDetail" name="frmDisabledDetail">
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
						<label class="control-label">Beneficiary Profile Disabled Type<span>*</span></label>
							<select class="select2" id="beneficiary_profile_disabled_type_id" name="beneficiary_profile_disabled_type_id"  type="select">														
								<option value="0">Select Beneficiary Profile Disabled Type</option>
							</select> 
					</div>
				</section>
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Beneficiary Profile Disabled Reason<span>*</span></label>
							<select class="select2" id="beneficiary_profile_disabled_reason_id" name="beneficiary_profile_disabled_reason_id" type="select">														
								<option value="0">Select Beneficiary Profile Disabled Reason</option>
							</select> 
					</div>
				</section>				
			 </div>
		</div>
 	 </form>
	 <table id="tblMasterListDisabledDetail" class="table table-striped table-bordered mt30" width="100%">	
	<thead>		
		<tr>
			<th>Id</th>
			<th data-class="expand">Beneficiary</th>
			<th data-hide="phone,tablet">Disabled Type</th>
			<th data-hide="phone,tablet">Disabled Reason</th>
			<th data-hide="phone" class="action">Action</th>
		</tr>
	</thead>							
	<tbody></tbody>							
</table>
	</section>
</div> 
<script language="javascript">
	var gridDataDisabledDetail = [];
	var oTableDisabledDetail;
	var strActionModeDisabledDetail = 'ADD';
	var iActiveDisabledDetailID = 0;
	function fetch_grid_data_disabledDetail()
	{
		resetFormSimple('frmDisabledDetail');
		strActionModeDisabledDetail = 'ADD';
		iActiveDisabledDetailID = 0;
		
		var objFormData = { 
			beneficiaryID : beneficiaryID,
		}
		$.ajax({
		  type: "POST",
		  url: "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'listDisabledDetail'));?>",
		  data: objFormData,
		  dataType: "json",
		  success: function(data){
				gridDataDisabledDetail = data.aaData;
				$("#tblMasterListDisabledDetail").find("tbody").html("");
				oTableDisabledDetail.clear().draw();
				oTableDisabledDetail.rows.add(gridDataDisabledDetail); // Add new data
				oTableDisabledDetail.columns.adjust().draw(); // Redraw the DataTable
				
		  }
		});		
	}
	function disabledDetailJsFunctions()
	{
		var responsiveHelper_tblMasterListDisabledDetail = undefined;			
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		oTableDisabledDetail = $('#tblMasterListDisabledDetail').DataTable({
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
				if (!responsiveHelper_tblMasterListDisabledDetail) {
					responsiveHelper_tblMasterListDisabledDetail = new ResponsiveDatatablesHelper($('#tblMasterListDisabledDetail'), breakpointDefinition);
					
				}
			},				
			"createdRow": function( nRow, data, dataIndex ) {
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_tblMasterListDisabledDetail.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_tblMasterListDisabledDetail.respond();
			},	
			"aaData": gridDataDisabledDetail,
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
		$("#tblMasterListDisabledDetail").delegate('a.edit', 'click', function (e) {
			e.preventDefault();		
			strActionModeDisabledDetail = 'EDIT';
			iActiveDisabledDetailID = $(this).attr("row-id");
			resetFormSimple('frmDisabledDetail');
			populateEditEntriesDetail(iActiveDisabledDetailID,'frmDisabledDetail',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getrecDisabledDetail'));?>");					
		});
		fnDeleteDetail('tblMasterListDisabledDetail','disabled_detail',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'deleteDisabledDetail'));?>");
		
		$('#btnSaveDisabledDetail').click(function(e){
			 e.preventDefault();
			 $("#frmDisabledDetail").submit();			 			
		});
		$('#btnNextFromDisabledDetail').click(function(e){
			 e.preventDefault();
			 callNextTab('disabled_detail');			 			
		});
		
		$('#frmDisabledDetail').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				beneficiary_profile_disabled_type_id: {
                    validators: {
                       callback: {
                            message: 'Please select beneficiary profile disabled type',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				currency: {
                    validators: {
                       callback: {
                            message: 'Please select currency ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				amount : {
					validators : {
						notEmpty : {
							message : 'Please enter disabled amount'						
						},
						digits : {
							message : 'The disabled amount is not valid'
						}
					}
				},
				currency_exchange_rate_id: {
                    validators: {
                       callback: {
                            message: 'Please select currency exchange rate  ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				frequency: {
                    validators: {
                       callback: {
                            message: 'Please select frequency  ',
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
			savefrmDisabledDetailData();
		});
		
		var disabled_type=$("#frmDisabledDetail").find("#beneficiary_profile_disabled_type_id");
		var disabled_type_array=[disabled_type];	
		populateOptionValuesBulk(disabled_type_array,"<?php echo $this->url('adminpanel/disabled-types', array('action'=>'getdisabletype'));?>","Select Beneficiary Profile Disabled Type");
		
		var profile_disabled_reason=$("#frmDisabledDetail").find("#beneficiary_profile_disabled_reason_id");
		var profile_disabled_reason_array=[profile_disabled_reason];
		populateOptionValuesBulk(profile_disabled_reason_array,"<?php echo $this->url('adminpanel/disabled-reasons', array('action'=>'getdisablereson'));?>","Select Beneficiary Profile Disabled Reason");

	}	
	function savefrmDisabledDetailData()
	{		
		//Validate  duplicate
		/*var objFormData = {
			ssn : $("#frmDisabledDetail").find("#ssn").val(),
		}
		var isDuplicate = fn_validate_duplicate_multiple('beneficiary_profile_disabled',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'validateduplicateDetail'));?>",iActiveDisabledDetailID,objFormData)
		if (isDuplicate) {
			mySmallAlert('Duplicate Error...!', 'Duplicate Found. SSN is Already exists !', 0);
			return false;
		}*/
				
		var $form = $('#frmDisabledDetail');
		var objMasterData = $form.serializeObject();
		
		if (strActionModeDisabledDetail == 'ADD')
			$.extend(objMasterData, { MASTER_KEY_ID: 0});
		else
			$.extend(objMasterData, { MASTER_KEY_ID: iActiveDisabledDetailID});
		
		objMasterData = JSON.stringify(objMasterData);

		var objFormData =
		{
			FORM_DATA: objMasterData,
			beneficiaryID : beneficiaryID,
			pAction : strActionModeDisabledDetail,
		};
		hideShowLoaderActive(true);
		var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'saveDisabledDetail'));?>", objFormData);
		if (objMyPost.ERR_NO === 0) {
			if (objMyPost.DATA.DBStatus === 'OK') {
				//resetFormSimple('frmDisabledDetail');
				strActionModeDisabledDetail = 'ADD';
				iActiveDisabledDetailID = 0;
				fetch_grid_data_disabledDetail();
				hideShowLoaderActive(false);
			}
		}
		else {
			hideShowLoaderActive(false);
			mySmallAlert('Error...!', 'There was an error', 0);
		}
	}
</script>