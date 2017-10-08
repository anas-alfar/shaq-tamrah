<div class="tab-pane" id="all_required_assets">
<div class="tabs-main-heading">	
	<span class="tabs-title">All Required Assets Info </span>
	<button id="btnSaveAllRequiredAssets" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Save
	</button>
	<button id="btnNextFromAllRequiredAssets" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Next
	</button>
	</div>

	<section>
      <form id="frmAllRequiredAssets" name="frmAllRequiredAssets">
		<div class="tab-content">
			<div class="row">
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Asset<span>*</span></label>
							<select class="select2" id="asset_id" name="asset_id" type="select">														
								<option value="0">Select Asset</option>
							</select> 
					</div>
				</section>
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Asset Type<span>*</span></label>
							<select class="select2" id="asset_type_id" name="asset_type_id" type="select">														
								<option value="0">Select Asset Type</option>
							</select> 
					</div>
				</section>
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Asset Unit<span>*</span></label>
							<select class="select2" id="asset_unit_id" name="asset_unit_id" type="select">														
								<option value="0">Select Asset Unit</option>
							</select> 
					</div>
				</section>
			</div>
			<div class="row">
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Asset Condition<span>*</span></label>
							<select class="select2" id="asset_condition_id" name="asset_condition_id" type="select">														
								<option value="0">Select Asset Condition</option>
							</select> 
					</div>
				</section>
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Asset Quantity<span>*</span></label>
							<input type="text" class="form-control" name="asset_quantity" id="asset_quantity"/>
					</div>	
				</section>
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Status<span>*</span></label>
							<select class="select2" id="status" name="status" type="select">														
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
							<select class="select2" id="beneficiary_profile_asset_received_id" name="beneficiary_profile_asset_received_id" type="select">														
								<option value="0">Select Beneficiary Profile Asset Received</option>
							</select> 
					</div>
				</section>
				<section class="col-md-6">
					<div class="form-group">
						<label class="control-label">Beneficiary Profile Asset Received Date<span></span></label>
							<input type="text" class="form-control" name="beneficiary_profile_asset_received_date" id="beneficiary_profile_asset_received_date"/>
					</div>	
				</section>
			</div>
		</div>
	  </form>	
	  <table id="tblMasterListAllRequiredAssets" class="table table-striped table-bordered mt30" width="100%">	
		<thead>		
			<tr>
				<th>Id</th>
				<th data-class="expand">Asset</th>
				<th data-hide="phone,tablet">Asset Type</th>
				<th data-hide="phone,tablet">Asset Unit</th>
				<th data-hide="phone,tablet">Asset Condition</th>
				<th data-hide="phone,tablet">Asset Quantity</th>
				<th data-hide="phone,tablet">Status</th>
				<th data-hide="phone" class="action">Action</th>
			</tr>
		</thead>							
		<tbody></tbody>							
	</table>
	</section>
 </div> 
<script language="javascript">
	var gridDataAllRequiredAssets = [];
	var oTableAllRequiredAssets;
	var strActionModeAllRequiredAssets = 'ADD';
	var iActiveAllRequiredAssetsID = 0;
	function fetch_grid_data_allRequiredAssets()
	{
		resetFormSimple('frmAllRequiredAssets');
		strActionModeAllRequiredAssets = 'ADD';
		iActiveAllRequiredAssetsID = 0;
		
		var objFormData = { 
			beneficiaryID : beneficiaryID,
		}
		$.ajax({
		  type: "POST",
		  url: "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'listAllRequiredAssets'));?>",
		  data: objFormData,
		  dataType: "json",
		  success: function(data){
				gridDataAllRequiredAssets = data.aaData;
				$("#tblMasterListAllRequiredAssets").find("tbody").html("");
				oTableAllRequiredAssets.clear().draw();
				oTableAllRequiredAssets.rows.add(gridDataAllRequiredAssets); // Add new data
				oTableAllRequiredAssets.columns.adjust().draw(); // Redraw the DataTable
				
		  }
		});		
	}
	function allRequiredAssetsJsFunctions()
	{
		var responsiveHelper_tblMasterListAllRequiredAssets = undefined;			
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		oTableAllRequiredAssets = $('#tblMasterListAllRequiredAssets').DataTable({
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
				if (!responsiveHelper_tblMasterListAllRequiredAssets) {
					responsiveHelper_tblMasterListAllRequiredAssets = new ResponsiveDatatablesHelper($('#tblMasterListAllRequiredAssets'), breakpointDefinition);
					
				}
			},				
			"createdRow": function( nRow, data, dataIndex ) {
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_tblMasterListAllRequiredAssets.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_tblMasterListAllRequiredAssets.respond();
			},	
			"aaData": gridDataAllRequiredAssets,
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
		$("#tblMasterListAllRequiredAssets").delegate('a.edit', 'click', function (e) {
			e.preventDefault();		
			strActionModeAllRequiredAssets = 'EDIT';
			iActiveAllRequiredAssetsID = $(this).attr("row-id");
			resetFormSimple('frmAllRequiredAssets');
			populateEditEntriesDetail(iActiveAllRequiredAssetsID,'frmAllRequiredAssets',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getrecAllRequiredAssets'));?>");					
		});
		fnDeleteDetail('tblMasterListAllRequiredAssets','all_required_assets',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'deleteAllRequiredAssets'));?>");
		
		$('#btnSaveAllRequiredAssets').click(function(e){
			 e.preventDefault();
			 $("#frmAllRequiredAssets").submit();			 			
		});
		$('#btnNextFromAllRequiredAssets').click(function(e){
			 e.preventDefault();
			 callNextTab('all_required_assets');			 			
		});
		
		$('#frmAllRequiredAssets').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				asset_type_id: {
                    validators: {
                       callback: {
                            message: 'Please select asset type',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				asset_id: {
                    validators: {
                       callback: {
                            message: 'Please select asset ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				asset_unit_id: {
                    validators: {
                       callback: {
                            message: 'Please select asset unit',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				asset_condition_id: {
                    validators: {
                       callback: {
                            message: 'Please select asset condition ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				status: {
                    validators: {
                       callback: {
                            message: 'Please select status ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				/*beneficiary_profile_asset_received_id: {
                    validators: {
                       callback: {
                            message: 'Please select beneficiary profile asset received  ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },*/
				asset_quantity: {
                    validators: {
						notEmpty : {
							message : 'Please enter asset quantity'						
						},
                        numeric: {
                            message: 'The asset quantity is not valid',
                            decimalSeparator: '.'
                        }
                    }
                }
				
			}
		}) 
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmAllRequiredAssetsData();
		});
		
		var asset_type=$("#frmAllRequiredAssets").find("#asset_type_id");
		var asset_type1=$("#frmFormDonation").find("#asset_type_id");
		var asset_type2=$("#frmFormManageAsset").find("#asset_type_id");
		var asset_type3=$("#frmAllOwnedAssets").find("#asset_type_id");
		var asset_type_array=[asset_type,asset_type1,asset_type2,asset_type3];	
		populateOptionValuesBulk(asset_type_array,"<?php echo $this->url('adminpanel/asset-type', array('action'=>'getassettype'));?>","Select Asset Type");
		
		var asset=$("#frmAllRequiredAssets").find("#asset_id");
		var asset1=$("#frmFormDonation").find("#asset_id");
		var asset2=$("#frmFormManageAsset").find("#asset_id");
		var asset3=$("#frmAllOwnedAssets").find("#asset_id");
		var asset_array=[asset,asset1,asset2,asset3];
		populateOptionValuesBulk(asset_array,"<?php echo $this->url('adminpanel/asset', array('action'=>'getasset'));?>","Select Asset");
		
		var asset_condition=$("#frmAllRequiredAssets").find("#asset_condition_id");
		var asset_condition1=$("#frmAllOwnedAssets").find("#asset_condition_id");
		var asset_condition2=$("#frmFormDonation").find("#asset_condition_id");
		var asset_condition3=$("#frmFormManageAsset").find("#asset_condition_id");
		var asset_condition_array=[asset_condition,asset_condition1,asset_condition2,asset_condition3];
		populateOptionValuesBulk(asset_condition_array,"<?php echo $this->url('adminpanel/asset-conditions', array('action'=>'getcondition'));?>","Select Asset Condition");	
		
		$("#beneficiary_profile_asset_received_date").datepicker();
		var asset_unit=$("#frmAllRequiredAssets").find("#asset_unit_id");
		var asset_unit1=$("#frmFormDonation").find("#asset_unit_id");
		var asset_unit2=$("#frmFormManageAsset").find("#asset_unit_id");
		var asset_unit_array=[asset_unit,asset_unit1,asset_unit2];
		populateOptionValuesBulk(asset_unit_array,"<?php echo $this->url('adminpanel/asset-unit-types', array('action'=>'getassetunit'));?>","Select Asset Unit");

	}	
	function savefrmAllRequiredAssetsData()
	{		
		//Validate  duplicate
		/*var objFormData = {
			ssn : $("#frmAllRequiredAssets").find("#ssn").val(),
		}
		var isDuplicate = fn_validate_duplicate_multiple('beneficiary_profile_asset_required',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'validateduplicateDetail'));?>",iActiveAllRequiredAssetsID,objFormData)
		if (isDuplicate) {
			mySmallAlert('Duplicate Error...!', 'Duplicate Found. SSN is Already exists !', 0);
			return false;
		}*/
				
		var $form = $('#frmAllRequiredAssets');
		var objMasterData = $form.serializeObject();
		
		if (strActionModeAllRequiredAssets == 'ADD')
			$.extend(objMasterData, { MASTER_KEY_ID: 0});
		else
			$.extend(objMasterData, { MASTER_KEY_ID: iActiveAllRequiredAssetsID});
		
		objMasterData = JSON.stringify(objMasterData);

		var objFormData =
		{
			FORM_DATA: objMasterData,
			beneficiaryID : beneficiaryID,
			pAction : strActionModeAllRequiredAssets,
		};
		hideShowLoaderActive(true);
		var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'saveAllRequiredAssets'));?>", objFormData);
		if (objMyPost.ERR_NO === 0) {
			if (objMyPost.DATA.DBStatus === 'OK') {
				//resetFormSimple('frmAllRequiredAssets');
				strActionModeAllRequiredAssets = 'ADD';
				iActiveAllRequiredAssetsID = 0;
				fetch_grid_data_allRequiredAssets();
				hideShowLoaderActive(false);
			}
		}
		else {
			hideShowLoaderActive(false);
			mySmallAlert('Error...!', 'There was an error', 0);
		}
	}
</script>