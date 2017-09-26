<div class="tab-pane" id="income_detail">
	<div class="tabs-main-heading">	
	<span class="tabs-title">Income Detail Info </span>
	<button id="btnSaveIncomeDetail" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Save
	</button>
	<button id="btnNextFromIncomeDetail" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Next
	</button>
	</div>

	<section>
 	 <form id="frmIncomeDetail" name="frmIncomeDetail">
		<div class="tab-content">
			<div class="row">
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Beneficiary Profile Income Type<span>*</span></label>
							<select class="select2" id="beneficiary_profile_income_type_id" name="beneficiary_profile_income_type_id" type="select">														
								<option value="0">Select Beneficiary Profile Income Type</option>
							</select> 
					</div>
				</section>
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Income Amount<span>*</span></label>
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
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Currency Exchange Rate<span>*</span></label>
							<select class="select2" id="currency_exchange_rate_id" name="currency_exchange_rate_id" type="select">														
								<option value="0">Select Currency Exchange Rate</option>
							</select> 
					</div>
				</section>
				<section class="col-md-4">
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
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Status<span>*</span></label>
							<select class="select2" id="status" name="status" type="select">														
								<option value="0">Select Status</option>
								<option value="Active">Active</option>
								<option value="Inactive">Inactive</option>
							</select> 
					</div>
				</section>
			</div>
		</div>
  </form>
  <table id="tblMasterListIncomeDetail" class="table table-striped table-bordered mt30" width="100%">	
	<thead>		
		<tr>
			<th>Id</th>
			<th data-class="expand">Income Type</th>
			<th data-hide="phone,tablet">Income Amount</th>
			<th data-hide="phone,tablet">Currency</th>
			<th data-hide="phone,tablet">Exchange Rate</th>
			<th data-hide="phone,tablet">Frequency</th>
			<th data-hide="phone,tablet">Status</th>
			<th data-hide="phone" class="action">Action</th>
		</tr>
	</thead>							
	<tbody></tbody>							
</table>
	</section>
</div>
<script language="javascript">
	var gridDataIncomeDetail = [];
	var oTableIncomeDetail;
	var strActionModeIncomeDetail = 'ADD';
	var iActiveIncomeDetailID = 0;
	function fetch_grid_data_incomeDetail()
	{
		resetFormSimple('frmIncomeDetail');
		strActionModeIncomeDetail = 'ADD';
		iActiveIncomeDetailID = 0;
		
		var objFormData = { 
			beneficiaryID : beneficiaryID,
		}
		$.ajax({
		  type: "POST",
		  url: "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'listIncomeDetail'));?>",
		  data: objFormData,
		  dataType: "json",
		  success: function(data){
				gridDataIncomeDetail = data.aaData;
				$("#tblMasterListIncomeDetail").find("tbody").html("");
				oTableIncomeDetail.clear().draw();
				oTableIncomeDetail.rows.add(gridDataIncomeDetail); // Add new data
				oTableIncomeDetail.columns.adjust().draw(); // Redraw the DataTable
				
		  }
		});		
	}
	function incomeDetailJsFunctions()
	{
		var responsiveHelper_tblMasterListIncomeDetail = undefined;			
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		oTableIncomeDetail = $('#tblMasterListIncomeDetail').DataTable({
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
				if (!responsiveHelper_tblMasterListIncomeDetail) {
					responsiveHelper_tblMasterListIncomeDetail = new ResponsiveDatatablesHelper($('#tblMasterListIncomeDetail'), breakpointDefinition);
					
				}
			},				
			"createdRow": function( nRow, data, dataIndex ) {
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_tblMasterListIncomeDetail.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_tblMasterListIncomeDetail.respond();
			},	
			"aaData": gridDataIncomeDetail,
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
		$("#tblMasterListIncomeDetail").delegate('a.edit', 'click', function (e) {
			e.preventDefault();		
			strActionModeIncomeDetail = 'EDIT';
			iActiveIncomeDetailID = $(this).attr("row-id");
			resetFormSimple('frmIncomeDetail');
			populateEditEntriesDetail(iActiveIncomeDetailID,'frmIncomeDetail',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getrecIncomeDetail'));?>");					
		});
		fnDeleteDetail('tblMasterListIncomeDetail','income_detail',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'deleteIncomeDetail'));?>");
		
		$('#btnSaveIncomeDetail').click(function(e){
			 e.preventDefault();
			 $("#frmIncomeDetail").submit();			 			
		});
		$('#btnNextFromIncomeDetail').click(function(e){
			 e.preventDefault();
			 callNextTab('income_detail');			 			
		});
		
		$('#frmIncomeDetail').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				beneficiary_profile_income_type_id: {
                    validators: {
                       callback: {
                            message: 'Please select beneficiary profile income type',
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
							message : 'Please enter income amount'						
						},
						digits : {
							message : 'The income amount is not valid'
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
                },
				status: {
                    validators: {
                       callback: {
                            message: 'Please select status  ',
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
			savefrmIncomeDetailData();
		});
		
		var profile_profile_income=$("#frmIncomeDetail").find("#beneficiary_profile_income_type_id");
		var profile_profile_income_array=[profile_profile_income];	
		populateOptionValuesBulk(profile_profile_income_array,"<?php echo $this->url('adminpanel/income-types', array('action'=>'getprofileincome'));?>","Select Beneficiary Profile Income Type");
		var currency=$("#frmIncomeDetail").find("#currency");
		var currency_array=[currency];
		populateOptionValuesBulk(currency_array,"<?php echo $this->url('adminpanel/currencies', array('action'=>'getcurrency'));?>","Select Currency");
		currency.change(function()
		{
			var currency =$(this).val();
			
			if(currency > 0)
			{
				var objFormData = {
						from_currency    : currency
				}
				
				populateDependentOptionValues("currency_exchange_rate_id","<?php echo $this->url('adminpanel/currency-exchange-rate', array('action'=>'getexchangerate'));?>","Select Currency Exchange Rate",objFormData);
			}
		});

	}	
	function savefrmIncomeDetailData()
	{		
		//Validate  duplicate
		/*var objFormData = {
			ssn : $("#frmIncomeDetail").find("#ssn").val(),
		}
		var isDuplicate = fn_validate_duplicate_multiple('beneficiary_profile_income',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'validateduplicateDetail'));?>",iActiveIncomeDetailID,objFormData)
		if (isDuplicate) {
			mySmallAlert('Duplicate Error...!', 'Duplicate Found. SSN is Already exists !', 0);
			return false;
		}*/
				
		var $form = $('#frmIncomeDetail');
		var objMasterData = $form.serializeObject();
		
		if (strActionModeIncomeDetail == 'ADD')
			$.extend(objMasterData, { MASTER_KEY_ID: 0});
		else
			$.extend(objMasterData, { MASTER_KEY_ID: iActiveIncomeDetailID});
		
		objMasterData = JSON.stringify(objMasterData);

		var objFormData =
		{
			FORM_DATA: objMasterData,
			beneficiaryID : beneficiaryID,
			pAction : strActionModeIncomeDetail,
		};
		hideShowLoaderActive(true);
		var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'saveIncomeDetail'));?>", objFormData);
		if (objMyPost.ERR_NO === 0) {
			if (objMyPost.DATA.DBStatus === 'OK') {
				//resetFormSimple('frmIncomeDetail');
				strActionModeIncomeDetail = 'ADD';
				iActiveIncomeDetailID = 0;
				fetch_grid_data_incomeDetail();
				hideShowLoaderActive(false);
			}
		}
		else {
			hideShowLoaderActive(false);
			mySmallAlert('Error...!', 'There was an error', 0);
		}
	}
</script>