<!-- RIBBON -->
<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Beneficiaries</li>
		<li>Donations</li>
	</ol>
	<!-- end breadcrumb -->
	<!--<span class="ribbon-button-alignment pull-right" style="margin-right:25px">
		<a href="#" id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa fa-grid"></i> Change Grid</a>
		<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa fa-plus"></i> Add</span>
		<button id="search" class="btn btn-ribbon" data-title="search"><i class="fa fa-search"></i> <span class="hidden-mobile">Search</span></button>
	</span> -->
</div>
<!-- END RIBBON -->
<!-- #MAIN CONTENT -->
<div id="content">
	<section id="widget-grid" class="">
		<div class="row">
			<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
				<?php include("grid.php");?> 
				<?php include("form.php");?> 
			</article>
		</div>
	</section>
</div>					
<!-- END #MAIN CONTENT -->
<script type="text/javascript">
			
		var gridData = [];
		function fetch_grid_data(objFormData)
		{
			hideShowLoader(true);
			$.ajax({
			  type: "POST",
			  url: "<?php echo $this->url('adminpanel/donation', array('action'=>'list'));?>",
			  data: objFormData,
			  dataType: "json",
			  success: function(data){
			  		hideShowLoader(false);
					gridData = data.aaData;
					$("#tblMasterList").find("tbody").html("");
					oTable.clear().draw();
					oTable.rows.add(gridData); // Add new data
					oTable.columns.adjust().draw(); // Redraw the DataTable
					
			  }
			});
			
		}

		function savefrmFormData()  {
			 if(strActionMode=="ADD") {
			 	iActiveID = 0
			 }
			 					
			//Validate  duplicate
			<?php /*?>var isDuplicate = fn_validate_duplicate($("#name").val(), 'beneficiary_donation', "name", "<?php echo $this->url('adminpanel/donation', array('action'=>'validateduplicate'));?>",iActiveID);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found. name is Already exists !', 0);
				return false;
			}<?php */?>
			
			var $form = $('#frmForm');
			var objMasterData = $form.serializeObject();
			if (strActionMode == 'ADD')
				$.extend(objMasterData, { MASTER_KEY_ID: 0});
			else
				$.extend(objMasterData, { MASTER_KEY_ID: iActiveID});

			objMasterData = JSON.stringify(objMasterData);

			var objFormData =
			{
				pAction    : strActionMode,
				FORM_DATA: objMasterData

			};
			hideShowLoader(true);
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/donation', array('action'=>'save'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					strActionMode = "EDIT";
					hideShowLoader(false);							
					fullscreenModeChange('btnSave');
					mySmallAlert('Save Record', 'donations Entry Saved successfully', 1);
					iActiveID = objMyPost.DATA.MY_ID;
					visibleControl('widForm', false);
					visibleControl('widGrid', true);
					fetch_grid_data();
				}
			}
			else {
				hideShowLoader(false);
				mySmallAlert('Error...!', 'There was an error', 0);
			}

		}		
		
		var pagefunction = function() { 
		$('#tabs').tabs();
			var responsiveHelper_tblMasterList = undefined;			
			var breakpointDefinition = {
				tablet : 1024,
				phone : 480
			};
			oTable = $('#tblMasterList').DataTable({
				"bLengthChange": true,
				"bAutoWidth": true,
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>l>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"oLanguage": {
					"sSearch": '<span class="input-donation-addon"><i class="glyphicon glyphicon-search"></i></span>'
				},
				"bProcessing": false,
                "bServerSide": false,
				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "autoWidth" : true,		
				"autoWidth" : true,
				"preDrawCallback" : function() {
					if (!responsiveHelper_tblMasterList) {
						responsiveHelper_tblMasterList = new ResponsiveDatatablesHelper($('#tblMasterList'), breakpointDefinition);
						
					}
				},				
				
				"rowCallback" : function(nRow) {
					responsiveHelper_tblMasterList.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					grid_tooltip();
					responsiveHelper_tblMasterList.respond();
				},	
				"aaData": gridData,
                "aoColumns": [
                    { "bSearchable": false, "bVisible": false },                  
                    null,
					null,
					null,
					null,
					null,
					null,
					null,
                    {"bSearchable": false, "bSortable": false,
                        "mRender" : function (data, type, full) {
							return grid_buttons_donation(full[0]);
                        }
                    }
                ],
			});			
			$("#tblMasterList thead th input[type=text]").on( 'keyup change', function () {	    	
				oTable
					.column( $(this).parent().index()+':visible' )
					.search( this.value )
					.draw();	            
			} );
			$("#tblMasterList thead th select").on( 'change', function () {				
				var matchValue = this.value					    	    	
				oTable
					.column( $(this).parent().index()+':visible' )
					.search(matchValue)
					.draw();	            
			} );	
			
			$('#frmForm').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				beneficiary_id: {
                    validators: {
                       callback: {
                            message: 'Please select beneficiary',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				asset_id: {
                    validators: {
                       callback: {
                            message: 'Please select asset',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
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
				asset_quantity: {
					validators: {
						notEmpty : {
							message : 'Please enter asset quantity'						
						},
						numeric: {
							message: 'The asset quantityr is not valid',
							decimalSeparator: '.'
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
				asset_value: {
					validators: {
						notEmpty : {
							message : 'Please enter asset value'						
						},
						numeric: {
							message: 'The asset value is not valid',
							decimalSeparator: '.'
						}
					}
				},
				receipt_number : {
					validators : {
						notEmpty : {
							message : 'Please enter receipt number'
						}
					}
				},
				currency: {
                    validators: {
                       callback: {
                            message: 'Please select currency',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				donor_id: {
                    validators: {
                       callback: {
                            message: 'Please select donor ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				amount: {
					validators: {
						notEmpty : {
							message : 'Please enter amount'						
						},
						numeric: {
							message: 'The amount is not valid',
							decimalSeparator: '.'
						}
					}
				},
				status: {
                    validators: {
                       callback: {
                            message: 'Please select status',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				payment_method_id: {

                    validators: {
                       callback: {
                            message: 'Please select payment method ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				country_id: {
                    validators: {
                       callback: {
                            message: 'Please select country',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				received_by : {
					validators : {
						notEmpty : {
							message : 'Please enter received by'
						}
					}
				},
				collection_currency: {
                    validators: {
                       callback: {
                            message: 'Please select collection currency',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				collection_type: {
                    validators: {
                       callback: {
                            message: 'Please select collection type',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				transaction_type_id: {
                    validators: {
                       callback: {
                            message: 'Please select transaction type ',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				transaction_entry_seq: {
					validators: {
						notEmpty : {
							message : 'Please enter transaction entry seq'						
						},
						numeric: {
							message: 'The transaction entry seq is not valid',
						}
					}
				},
				debit_credit_flag: {
                    validators: {
                       callback: {
                            message: 'Please select debit credit flag',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				transaction_amount: {
					validators: {
						notEmpty : {
							message : 'Please enter transaction amount'						
						},
						numeric: {
							message: 'The transaction amount is not valid',
						}
					}
				},
				gl_account_id: {
                    validators: {
                       callback: {
                            message: 'Please select gl account ',
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
			savefrmFormData();
		});
		
			
		fnBulkSave("<?php echo $this->url('adminpanel/donation', array('action'=>'bulksave'));?>");
		fnExport("<?php echo $this->url('adminpanel/donation', array('action'=>'exportcsv'));?>");
		fnImport("<?php echo $this->url('adminpanel/donation', array('action'=>'importcsv'));?>");
		fnEdit("<?php echo $this->url('adminpanel/donation', array('action'=>'getrec'));?>");
		fnView("<?php echo $this->url('adminpanel/donation', array('action'=>'getrec'));?>");
		fnDelete("<?php echo $this->url('adminpanel/donation', array('action'=>'delete'));?>"); 
			
		fetch_grid_data();	
			
				
		}
		

		loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/datatables/jquery.dataTables.min.js", function(){
			loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/datatables/dataTables.colVis.min.js", function(){
				loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/datatables/dataTables.tableTools.min.js", function(){
					loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/datatables/dataTables.bootstrap.min.js", function(){
						loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/datatable-responsive/datatables.responsive.min.js", function(){
							loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/bootstrapvalidator/bootstrapValidator.min.js", pagefunction)
						});	
					});
				});
			});
		});
</script>

<div id="ImportCsvFileModal" class="modal fade bs-example-modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="ns_name_popup"><strong>Import Donation</strong></h4>
         </div>
		 <form action="" class="smart-form" enctype="multipart/form-data" name="importcsvform" id="importcsvform">
			<fieldset>
				<section>
					<label for="file" class="input input-file custombrowse" id="importFileLabel">
								<div class="button"><input type="file" name="importfile" id="importfile" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Csv File" readonly="" name="import"id="import">
					</label>
					<div class="note note-error txt-color-red hide" id="importFileError">Please select csv file</div>
					<div class="note note-error">Please <a href="<?php echo $this->url('adminpanel/donation', array('action'=>'downloadtemplate'));?>" target="_blank">download template </a>first (if you don't have download yet!)
					</div>
				</section>
			</fieldset>			
		 </form>
		 
		 <div class="modal-footer">
                    <button type="button" class="btn btn-default" name="importsavebutton" id="importsavebutton"><i class="fa fa-cloud-download"></i>&nbsp;Import</button>	
         </div>
      </div>
   </div>
</div>

<?php include($this->admin_layout_dir_path."global_include.php");?>
<script language="javascript">
		$("#date_of_collection").datepicker();
		$("#insertion_date").datepicker();
		$("#transaction_date").datepicker();
		$("#posting_date").datepicker();
		populateOptionValues("beneficiary_id","<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getbeneficiary'));?>","Select Beneficiary");
		populateOptionValues("asset_id","<?php echo $this->url('adminpanel/asset', array('action'=>'getasset'));?>","Select Asset");
		populateOptionValues("asset_type_id","<?php echo $this->url('adminpanel/asset-type', array('action'=>'getassettype'));?>","Select Asset Type");
		populateOptionValues("asset_unit_id","<?php echo $this->url('adminpanel/asset-unit-types', array('action'=>'getassetunit'));?>","Select Asset Unit");
		populateOptionValues("asset_condition_id","<?php echo $this->url('adminpanel/asset-conditions', array('action'=>'getcondition'));?>","Select Asset Condition");
		var currency=$("#frmForm").find("#currency");
		var collection_currency=$("#frmForm").find("#collection_currency");
		var currency_array=[currency,collection_currency];
		populateOptionValuesBulk(currency_array,"<?php echo $this->url('adminpanel/currencies', array('action'=>'getcurrency'));?>","Select Currency");
		populateDonor("donor_id","<?php echo $this->url('adminpanel/donor', array('action'=>'getdonor'));?>","Select Donor");
		populateOptionValues("transaction_type_id","<?php echo $this->url('adminpanel/transaction-type', array('action'=>'gettransactiontype'));?>","Select Transaction Type");
		populateOptionValues("gl_account_id","<?php echo $this->url('adminpanel/gl-account', array('action'=>'getglaccount'));?>","Select Gl Account");
		populateOptionValues("country_id","<?php echo $this->url('adminpanel/countries', array('action'=>'getcountry'));?>","Select Country");
		$("#country_id").change(function()
		{
			var country_id =$(this).val();
			if(country_id > 0)
			{
				var objFormData = {
						country_id    : country_id
				}
				populateDependentOptionValues("payment_method_id","<?php echo $this->url('adminpanel/payment-method', array('action'=>'getpayment'));?>","Select Payment Method",objFormData);
				
			}
		});	
</script>