<div class="tab-pane" id="all_owned_assets">
<div class="tabs-main-heading">	
	<span class="tabs-title">All Owned Assets Info </span>
	<button id="btnSaveAllOwnedAssets" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Save
	</button>
	<button id="btnNextFromAllOwnedAssets" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Next
	</button>
	</div>

	<section>
      <form id="frmAllOwnedAssets" name="frmAllOwnedAssets">
		<div class="tab-content">
			<div class="row">
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
						<label class="control-label">Asset<span>*</span></label>
							<select class="select2" id="asset_id" name="asset_id" type="select">														
								<option value="0">Select Asset</option>
							</select> 
					</div>
				</section>
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Asset Condition<span>*</span></label>
							<select class="select2" id="asset_condition_id" name="asset_condition_id" type="select">														
								<option value="0">Select Asset Condition</option>
							</select> 
					</div>
				</section>
			</div>
		</div>
	 </form>	
	 <table id="tblMasterListAllOwnedDetail" class="table table-striped table-bordered mt30" width="100%">	
	<thead>		
		<tr>
			<th>Id</th>
			<th data-class="expand">Asset Type</th>
			<th data-hide="phone,tablet">Assets</th>
			<th data-hide="phone,tablet">Asset Condition</th>
			<th data-hide="phone" class="action">Action</th>
		</tr>
	</thead>							
	<tbody></tbody>							
</table>
	</section>
 </div> 
<script language="javascript">
	var gridDataAllOwnedDetail = [];
	var oTableAllOwnedDetail;
	var strActionModeAllOwnedDetail = 'ADD';
	var iActiveAllOwnedDetailID = 0;
	function fetch_grid_data_allOwnedDetail()
	{
		resetFormSimple('frmAllOwnedAssets');
		strActionModeAllOwnedDetail = 'ADD';
		iActiveAllOwnedDetailID = 0;
		
		var objFormData = { 
			beneficiaryID : beneficiaryID,
		}
		$.ajax({
		  type: "POST",
		  url: "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'listAllOwnedDetail'));?>",
		  data: objFormData,
		  dataType: "json",
		  success: function(data){
				gridDataAllOwnedDetail = data.aaData;
				$("#tblMasterListAllOwnedDetail").find("tbody").html("");
				oTableAllOwnedDetail.clear().draw();
				oTableAllOwnedDetail.rows.add(gridDataAllOwnedDetail); // Add new data
				oTableAllOwnedDetail.columns.adjust().draw(); // Redraw the DataTable
				
		  }
		});		
	}
	function allOwnedAssetsJsFunctions()
	{
		var responsiveHelper_tblMasterListAllOwnedDetail = undefined;			
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		oTableAllOwnedDetail = $('#tblMasterListAllOwnedDetail').DataTable({
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
				if (!responsiveHelper_tblMasterListAllOwnedDetail) {
					responsiveHelper_tblMasterListAllOwnedDetail = new ResponsiveDatatablesHelper($('#tblMasterListAllOwnedDetail'), breakpointDefinition);
					
				}
			},				
			"createdRow": function( nRow, data, dataIndex ) {
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_tblMasterListAllOwnedDetail.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_tblMasterListAllOwnedDetail.respond();
			},	
			"aaData": gridDataAllOwnedDetail,
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
		$("#tblMasterListAllOwnedDetail").delegate('a.edit', 'click', function (e) {
			e.preventDefault();		
			strActionModeAllOwnedDetail = 'EDIT';
			iActiveAllOwnedDetailID = $(this).attr("row-id");
			resetFormSimple('frmAllOwnedAssets');
			populateEditEntriesDetail(iActiveAllOwnedDetailID,'frmAllOwnedAssets',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getrecAllOwnedDetail'));?>");					
		});
		fnDeleteDetail('tblMasterListAllOwnedDetail','all_owned_assets',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'deleteAllOwnedDetail'));?>");
		
		$('#btnSaveAllOwnedAssets').click(function(e){
			 e.preventDefault();
			 $("#frmAllOwnedAssets").submit();			 			
		});
		$('#btnNextFromAllOwnedAssets').click(function(e){
			 e.preventDefault();
			 callNextTab('all_owned_assets');			 			
		});
		
		$('#frmAllOwnedAssets').bootstrapValidator({
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
				asset_condition_id: {
                    validators: {
                       callback: {
                            message: 'Please select asset condition ',
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
			savefrmAllOwnedAssetsData();
		});
		
		var asset_type=$("#frmAllOwnedAssets").find("#asset_type_id");
		var asset_type_array=[asset_type];	
		populateOptionValuesBulk(asset_type_array,"<?php echo $this->url('adminpanel/asset-type', array('action'=>'getassettype'));?>","Select Asset Type");
		
		var asset=$("#frmAllOwnedAssets").find("#asset_id");
		var asset_array=[asset];
		populateOptionValuesBulk(asset_array,"<?php echo $this->url('adminpanel/asset', array('action'=>'getasset'));?>","Select Asset");
		
		var asset_condition=$("#frmAllOwnedAssets").find("#asset_condition_id");
		var asset_condition_array=[asset_condition];
		populateOptionValuesBulk(asset_condition_array,"<?php echo $this->url('adminpanel/asset-conditions', array('action'=>'getcondition'));?>","Select Asset Condition");	

	}	
	function savefrmAllOwnedAssetsData()
	{		
		//Validate  duplicate
		/*var objFormData = {
			ssn : $("#frmAllOwnedAssets").find("#ssn").val(),
		}
		var isDuplicate = fn_validate_duplicate_multiple('beneficiary_profile_allOwned',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'validateduplicateDetail'));?>",iActiveAllOwnedDetailID,objFormData)
		if (isDuplicate) {
			mySmallAlert('Duplicate Error...!', 'Duplicate Found. SSN is Already exists !', 0);
			return false;
		}*/
				
		var $form = $('#frmAllOwnedAssets');
		var objMasterData = $form.serializeObject();
		
		if (strActionModeAllOwnedDetail == 'ADD')
			$.extend(objMasterData, { MASTER_KEY_ID: 0});
		else
			$.extend(objMasterData, { MASTER_KEY_ID: iActiveAllOwnedDetailID});
		
		objMasterData = JSON.stringify(objMasterData);

		var objFormData =
		{
			FORM_DATA: objMasterData,
			beneficiaryID : beneficiaryID,
			pAction : strActionModeAllOwnedDetail,
		};
		hideShowLoaderActive(true);
		var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'saveAllOwnedDetail'));?>", objFormData);
		if (objMyPost.ERR_NO === 0) {
			if (objMyPost.DATA.DBStatus === 'OK') {
				//resetFormSimple('frmAllOwnedAssets');
				strActionModeAllOwnedDetail = 'ADD';
				iActiveAllOwnedDetailID = 0;
				fetch_grid_data_allOwnedDetail();
				hideShowLoaderActive(false);
			}
		}
		else {
			hideShowLoaderActive(false);
			mySmallAlert('Error...!', 'There was an error', 0);
		}
	}
</script>