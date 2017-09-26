<div class="tab-pane" id="spending_detail">
	<div class="tabs-main-heading">	
	<span class="tabs-title">Spending Detail Info </span>
	<button id="btnSaveSpendingDetail" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Save
	</button>
	<button id="btnNextFromSpendingDetail" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Next
	</button>
	</div>

	<section>
	 <form id="frmSpendingDetail" name="frmSpendingDetail">
		<div class="tab-content">
			<div class="row">
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Beneficiary Profile Spending Type<span>*</span></label>
							<select class="select2" id="beneficiary_profile_spending_type_id" name="beneficiary_profile_spending_type_id" type="select">														
								<option value="0">Select Beneficiary Profile Spending Type</option>
							</select> 
					</div>
				</section>
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Spending Amount<span>*</span></label>
							<input type="text" class="form-control" name="amount" id="amount"/>
					</div>	
				</section>
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Currency<span>*</span></label>
							<select class="select2" id="currency" name="currency" type="select">														
								<option value="0">Select Currency</option>
							</select> 
					</div>
				</section>
			</div>
			<div class="row">
				<section class="col-md-6">
					<div class="form-group">
						<label class="control-label">Currency Exchange Rate<span>*</span></label>
							<select class="select2" id="currency_exchange_rate_id" name="currency_exchange_rate_id" type="select">														
								<option value="0">Select Currency Exchange Rate</option>
							</select> 
					</div>
				</section>
				<section class="col-md-6">
					<div class="form-group">
						<label class="control-label">Frequency<span>*</span></label>
							<select class="select2" id="frequency" name="frequency" type="select">														
								<option value="0">Select Frequency</option>
								<option value="Daily">Daily</option>
								<option value="Weekly">Weekly</option>
								<option value="Monthly">Monthly</option>
								<option value="Quarterly">Quarterly</option>
								<option value="Annual">Annualy</option>
							</select> 
					</div>
				</section>
			</div>
		</div>
   </form>
   <table id="tblMasterListSpendingDetail" class="table table-striped table-bordered mt30" width="100%">	
	<thead>		
		<tr>
			<th>Id</th>
			<th data-class="expand">Spending Type</th>
			<th data-hide="phone,tablet">Spending Amount</th>
			<th data-hide="phone,tablet">Currency</th>
			<th data-hide="phone,tablet">Exchange Rate</th>
			<th data-hide="phone,tablet">Frequency</th>
			<th data-hide="phone" class="action">Action</th>
		</tr>
	</thead>							
	<tbody></tbody>							
</table>
	</section>
</div>
<script language="javascript">
	var gridDataSpendingDetail = [];
	var oTableSpendingDetail;
	var strActionModeSpendingDetail = 'ADD';
	var iActiveSpendingDetailID = 0;
	function fetch_grid_data_spendingDetail()
	{
		resetFormSimple('frmSpendingDetail');
		strActionModeSpendingDetail = 'ADD';
		iActiveSpendingDetailID = 0;
		
		var objFormData = { 
			beneficiaryID : beneficiaryID,
		}
		$.ajax({
		  type: "POST",
		  url: "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'listSpendingDetail'));?>",
		  data: objFormData,
		  dataType: "json",
		  success: function(data){
				gridDataSpendingDetail = data.aaData;
				$("#tblMasterListSpendingDetail").find("tbody").html("");
				oTableSpendingDetail.clear().draw();
				oTableSpendingDetail.rows.add(gridDataSpendingDetail); // Add new data
				oTableSpendingDetail.columns.adjust().draw(); // Redraw the DataTable
				
		  }
		});		
	}
	function spendingDetailJsFunctions()
	{
		var responsiveHelper_tblMasterListSpendingDetail = undefined;			
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		oTableSpendingDetail = $('#tblMasterListSpendingDetail').DataTable({
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
				if (!responsiveHelper_tblMasterListSpendingDetail) {
					responsiveHelper_tblMasterListSpendingDetail = new ResponsiveDatatablesHelper($('#tblMasterListSpendingDetail'), breakpointDefinition);
					
				}
			},				
			"createdRow": function( nRow, data, dataIndex ) {
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_tblMasterListSpendingDetail.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_tblMasterListSpendingDetail.respond();
			},	
			"aaData": gridDataSpendingDetail,
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
		$("#tblMasterListSpendingDetail").delegate('a.edit', 'click', function (e) {
			e.preventDefault();		
			strActionModeSpendingDetail = 'EDIT';
			iActiveSpendingDetailID = $(this).attr("row-id");
			resetFormSimple('frmSpendingDetail');
			populateEditEntriesDetail(iActiveSpendingDetailID,'frmSpendingDetail',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getrecSpendingDetail'));?>");					
		});
		fnDeleteDetail('tblMasterListSpendingDetail','spending_detail',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'deleteSpendingDetail'));?>");
		
		$('#btnSaveSpendingDetail').click(function(e){
			 e.preventDefault();
			 $("#frmSpendingDetail").submit();			 			
		});
		$('#btnNextFromSpendingDetail').click(function(e){
			 e.preventDefault();
			 callNextTab('spending_detail');			 			
		});
		
		$('#frmSpendingDetail').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				beneficiary_profile_spending_type_id: {
                    validators: {
                       callback: {
                            message: 'Please select beneficiary profile spending type',
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
							message : 'Please enter spending amount'						
						},
						digits : {
							message : 'The spending amount is not valid'
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
			savefrmSpendingDetailData();
		});
		
		var profile_spending=$("#frmSpendingDetail").find("#beneficiary_profile_spending_type_id");
		var profile_spending_spending_array=[profile_spending];	
		populateOptionValuesBulk(profile_spending_spending_array,"<?php echo $this->url('adminpanel/spending-types', array('action'=>'getspending'));?>","Select Beneficiary Profile Spending Type");
		
		var currency=$("#frmSpendingDetail").find("#currency");
		var currency_array=[currency];	
		populateOptionValuesBulk(currency_array,"<?php echo $this->url('adminpanel/currencies', array('action'=>'getcurrency'));?>","Select Currency");
		
		var currency_exchange=$("#frmSpendingDetail").find("#currency_exchange_rate_id");
		var currency_exchange_array=[currency_exchange];		
		currency.change(function()
		{
			var currency =$(this).val();
			
			if(currency > 0)
			{
				var objFormData = {
						from_currency    : currency
				}				
				populateDependentOptionValuesObject(currency_exchange,"<?php echo $this->url('adminpanel/currency-exchange-rate', array('action'=>'getexchangerate'));?>","Select Currency Exchange Rate",objFormData);
			}
		});

	}	
	function savefrmSpendingDetailData()
	{		
		//Validate  duplicate
		/*var objFormData = {
			ssn : $("#frmSpendingDetail").find("#ssn").val(),
		}
		var isDuplicate = fn_validate_duplicate_multiple('beneficiary_profile_spending',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'validateduplicateDetail'));?>",iActiveSpendingDetailID,objFormData)
		if (isDuplicate) {
			mySmallAlert('Duplicate Error...!', 'Duplicate Found. SSN is Already exists !', 0);
			return false;
		}*/
				
		var $form = $('#frmSpendingDetail');
		var objMasterData = $form.serializeObject();
		
		if (strActionModeSpendingDetail == 'ADD')
			$.extend(objMasterData, { MASTER_KEY_ID: 0});
		else
			$.extend(objMasterData, { MASTER_KEY_ID: iActiveSpendingDetailID});
		
		objMasterData = JSON.stringify(objMasterData);

		var objFormData =
		{
			FORM_DATA: objMasterData,
			beneficiaryID : beneficiaryID,
			pAction : strActionModeSpendingDetail,
		};
		hideShowLoaderActive(true);
		var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'saveSpendingDetail'));?>", objFormData);
		if (objMyPost.ERR_NO === 0) {
			if (objMyPost.DATA.DBStatus === 'OK') {
				//resetFormSimple('frmSpendingDetail');
				strActionModeSpendingDetail = 'ADD';
				iActiveSpendingDetailID = 0;
				fetch_grid_data_spendingDetail();
				hideShowLoaderActive(false);
			}
		}
		else {
			hideShowLoaderActive(false);
			mySmallAlert('Error...!', 'There was an error', 0);
		}
	}
</script>