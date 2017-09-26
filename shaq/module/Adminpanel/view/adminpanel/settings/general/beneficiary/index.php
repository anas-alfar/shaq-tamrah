<!-- RIBBON -->
<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Setting</li>
		<li>Beneficiary Settings</li>
		<li>Beneficiaries</li>
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
			
		var gridData;
		var beneficiaryID;
		function fetch_grid_data(objFormData)
		{
			hideShowLoader(true);
			$.ajax({
			  type: "POST",
			  url: "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'list'));?>",
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
			var isDuplicate = fn_validate_duplicate($("#family_name_<?php echo $this->global_locale_id; ?>").val(), 'beneficiary_locale', "family_name", "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'validateduplicate'));?>",iActiveID);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found.Family Name is Already exists !', 0);
				return false;
			}
			
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
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'save'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					strActionMode = "EDIT";
					hideShowLoader(false);							
					fullscreenModeChange('btnSave');
					mySmallAlert('Save Record', 'beneficiary Entry Saved successfully', 1);
					iActiveID = objMyPost.DATA.MY_ID;
					beneficiaryID =  objMyPost.DATA.MY_ID;
					visibleControl('widForm', false);
					showProfileDetailTabs(objMyPost.DATA.ALLOWED_PROFILE_LIST);
					visibleControl('widFormDetail', true);
					//fetch_grid_data();
				}
			}
			else {
				hideShowLoader(false);
				mySmallAlert('Error...!', 'There was an error', 0);
			}

		}
		/************************************Donation Save Start*****************************************/
		function savefrmFormDonationData()  {
			
			
			var $form = $('#frmFormDonation');
			var objMasterData = $form.serializeObject();
				$.extend(objMasterData, { MASTER_KEY_ID: 0});

			objMasterData = JSON.stringify(objMasterData);

			var objFormData =
			{
				pAction    : strActionMode,
				FORM_DATA: objMasterData

			};
			hideShowLoader(true);
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'savedonation'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					mySmallAlert('Save Record', 'Donation Entry Saved successfully', 1);
					$('#DonationModal').modal('hide');
				}
			}	
		}		
		/************************************Donation Save End*****************************************/
		/************************************Sponsorship Save Start*****************************************/
		function savefrmFormSponsorshipData()  {
			
			
			var $form = $('#frmFormSponsorship');
			var objMasterData = $form.serializeObject();
				$.extend(objMasterData, { MASTER_KEY_ID: 0});

			objMasterData = JSON.stringify(objMasterData);

			var objFormData =
			{
				pAction    : strActionMode,
				FORM_DATA: objMasterData

			};
			hideShowLoader(true);
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'savesponsorship'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					mySmallAlert('Save Record', 'Sponsorship Entry Saved successfully', 1);
					$('#SponsorshipModal').modal('hide');
				}
			}	
		}		
		/************************************Sponsorship Save End*****************************************/
		/************************************Manage Groups Save Start*****************************************/
		function savefrmFormManageGroupsData()  {
			
			
			var $form = $('#frmFormManageGroups');
			var objMasterData = $form.serializeObject();
				$.extend(objMasterData, { MASTER_KEY_ID: 0});

			objMasterData = JSON.stringify(objMasterData);

			var objFormData =
			{
				pAction    : strActionMode,
				FORM_DATA: objMasterData

			};
			hideShowLoader(true);
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'savemanagegroups'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					mySmallAlert('Save Record', 'Manage Groups Entry Saved successfully', 1);
					$('#ManageGroupsModal').modal('hide');
				}
			}	
		}		
		/************************************Manage Groups Save End*****************************************/
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
					"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
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
				"createdRow": function( nRow, data, dataIndex ) {
					// Set the data-status attribute, and add a class
					
					$( nRow ).find('td:eq(7)').attr('data-search', data[6]);
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_tblMasterList.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_tblMasterList.respond();
				},	
				"aaData": gridData,
                "aoColumns": [
                    { "bSearchable": false, "bVisible": false }, 
					{
						"class":          'details-control',
						"orderable":      false,
						"data":           null,
						"defaultContent": ''
					},                   
                    null,
                    null,
					null,
					null,
					null,
					{ "bSearchable": true, "bSortable": true,
                        "mRender" : function (data, type, full) {							
							return grid_switch(full[0],'visibility',full[7],'Yes');							
						}
					},
                    {"bSearchable": false, "bSortable": false,
                        "mRender" : function (data, type, full) {
							return grid_buttons_beneficiary(full[0]);
                        }
                    }
                ],
                "columnDefs": [
                    { className: "hidden", "targets": [ 0 ] },
					{ "type": "html-input", "targets": [7] }
                ]	
			});
			$('#tblMasterList tbody').on('click', 'td.details-control', function () {
				var tr = $(this).closest('tr');
				var row = oTable.row( tr );
				
				if ( row.child.isShown() ) {
					// This row is already open - close it
					row.child.hide();
					tr.removeClass('shown');
				}
				else if(tr.hasClass('loaded'))
				{
					row.child.show();
					tr.addClass('shown');
				}				
				else {
					tr.addClass('loading');
					var KEY_ID = $(this).parent().find('input[name="gridHiddenIdArray[]"]').val();
					var returnData;
					hideShowLoader(true);
					$.ajax({
					  type: "POST",
					  url: "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getgriddetailslist'));?>",
					  data:{'KEY_ID':KEY_ID},
					  dataType: "json",
					  success: function(data){
							hideShowLoader(false);
							row.child(data.grid_list).show();
							tr.addClass('loaded');
							tr.removeClass('loading');
							tr.addClass('shown');
					  }
					});
					
				}
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
				beneficiary_profile_id: {
                    validators: {
                       callback: {
                            message: 'Please select beneficiary profile',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				sequence : {
					validators : {
						notEmpty : {
							message : 'Please enter sequence'
						}
					}
				},
				family_book_number : {
					validators : {
						notEmpty : {
							message : 'Please enter family book number'
						}
					}
				},
				<?php
					foreach($this->activeLocalesArray as $locale)
					{
						?>
						family_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter family name'						
								}
							}
						},
						<?php 
					} 
				?>
				
				
			}
		}) 
		 .on('status.field.bv', function(e, data) {
            console.log('error.field.bv -->', data);
			var $form     = $(e.target),
                validator = data.bv,
                $tabPane  = data.element.parents('.ui-tabs-panel'),
                tabId     = $tabPane.attr('id');
			//$tabPane.attr('id','232323');
            
            if (tabId) {				
                var $icon = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
                // Add custom class to tab containing the field
                if (data.status == validator.STATUS_INVALID) {
                    $icon.removeClass('fa-check').addClass('fa-times');
                } else if (data.status == validator.STATUS_VALID) {
                    var isValidTab = validator.isValidContainer($tabPane);
                    $icon.removeClass('fa-check fa-times')
                         .addClass(isValidTab ? 'fa-check' : 'fa-times');
                }
            }
			
        })
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmFormData();
		});
		/************************************Donation Validation Start*****************************************/
		$('#frmFormDonation').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
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
				currency_exchange_rate_id: {
                    validators: {
                       callback: {
                            message: 'Please select currency exchange rate ',
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
				collection_currency : {
					validators : {
						notEmpty : {
							message : 'Please enter collection currency'						
						},
						callback: {
                            message: 'Maximum three charactors allowed ',
                            callback: function (value, validator, $field) {
                               return (value.length<=3);
                            }
                        }
					}
				}
				
			}
		}) 
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmFormDonationData();
		});
		/************************************Donation Validation End*****************************************/
		
		/************************************Sponsorship Validation Start*****************************************/
		$('#frmFormSponsorship').bootstrapValidator({
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
                            message: 'Please select beneficiary profile family',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				frequency: {
                    validators: {
                       callback: {
                            message: 'Please select frequency',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
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
				currency_exchange_rate_id: {
                    validators: {
                       callback: {
                            message: 'Please select currency exchange rate ',
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
                }
				
			}
		}) 
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmFormSponsorshipData();
		});
		/************************************Sponsorship Validation End*****************************************/
		/************************************Manage Groups Validation Start*****************************************/
		$('#frmFormManageGroups').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				beneficiary_group_id: {
                    validators: {
                       callback: {
                            message: 'Please select beneficiary group ',
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
			savefrmFormManageGroupsData();
		});
		/************************************Manage Groups Validation End*****************************************/	
		fnBulkSave("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'bulksave'));?>");
		fnExport("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'exportcsv'));?>");
		fnImport("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'importcsv'));?>");
		fnEdit("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getrec'));?>");
		fnView("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getrec'));?>");
		fnDelete("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'delete'));?>");
		fnDonation(); 
		fnSponsorship("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getFamilyDetail'));?>"); 
		fnManageGroups();	
		fetch_grid_data();	
			
		loadJsForDetailForm();		
		
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
              <h4 class="modal-title" id="ns_name_popup"><strong>Import beneficiary</strong></h4>
         </div>
		 <form action="" class="smart-form" enctype="multipart/form-data" name="importcsvform" id="importcsvform">
			<fieldset>
				<section>
					<label for="file" class="input input-file custombrowse" id="importFileLabel">
								<div class="button"><input type="file" name="importfile" id="importfile" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Csv File" readonly="" name="import"id="import">
					</label>
					<div class="note note-error txt-color-red hide" id="importFileError">Please select csv file</div>
					<div class="note note-error">Please <a href="<?php echo $this->url('adminpanel/beneficiary', array('action'=>'downloadtemplate'));?>" target="_blank">download template </a>first (if you don't have download yet!)
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

<!---------------------------------Donation Form Start-------------------------------------------------------->

<div id="DonationModal" class="modal fade bs-example-modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="ns_name_popup"><strong></strong></h4>
         </div>
		<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>New Donation</h2>
					<div class="widget-toolbar">
								
								<button id="btnDonationBack" type="submit" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<button id="btnDonationSave" type="submit" class="right btn btnSave  addEventBtn ">
									   <i class="fa fa-floppy-o"></i> &nbsp;Save
							    </button>
					</div>
				</header>
				<div>
					<div class="jarviswidget-editbox"></div>
					  <div class="widget-body no-padding">
						 <form id="frmFormDonation"  enctype="multipart/form-data" name="frmFormDonation"> 
						 
						 <input type="hidden" name="beneficiary_id" id="beneficiary_id" />
						   <div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									  <div class="panel-body">
										<div class="jarviswidget jarviswidget-color-greenLight" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
											<header>
												<h2>Beneficiary Profile Asset Received</h2>
											</header>
											<div>
												<div class="jarviswidget-editbox"></div>
												<div class="widget-body padding_10"> 
													<div class="panel panel-hovered panel-stacked mb30">
														<div class="panel-body">
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset<span>*</span></label>
																			<select class="select2" id="asset_id" name="asset_id" type="select">														
																				<option value="0">Select Asset</option>
																			</select> 
																	</div>
																</section>
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Type<span>*</span></label>
																			<select class="select2" id="asset_type_id" name="asset_type_id" type="select">														
																				<option value="0">Select Asset Type</option>
																			</select> 
																	</div>
																</section>
															</div>
															<div class="row">		
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Unit<span>*</span></label>
																			<select class="select2" id="asset_unit_id" name="asset_unit_id" type="select">														
																				<option value="0">Select Asset Unit</option>
																			</select> 
																	</div>
																</section>
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Quantity<span>*</span></label>
																		<input type="text" class="form-control" name="asset_quantity" id="asset_quantity"/>
																	</div>
																 </section>
															</div>
															<div class="row">		
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Condition<span>*</span></label>
																			<select class="select2" id="asset_condition_id" name="asset_condition_id" type="select">														
																				<option value="0">Select Asset Condition</option>
																			</select> 
																	</div>
																</section>
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Asset Value<span>*</span></label>
																		<input type="text" class="form-control" name="asset_value" id="asset_value"/>
																	</div>
																 </section>
															</div>
															<div class="row">
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Receipt Number<span>*</span></label>
																		<input type="text" class="form-control" name="receipt_number" id="receipt_number"/>
																	</div>
																 </section>
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Donor<span>*</span></label>
																			<select class="select2" id="donor_id" name="donor_id" type="select">														
																				<option value="0">Select Donor</option>
																			</select> 
																	</div>
																</section>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						   <div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									  <div class="panel-body">
										<div class="jarviswidget jarviswidget-color-greenLight" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
											<header>
												<h2>Payment</h2>
											</header>
											<div>
												<div class="jarviswidget-editbox"></div>
												<div class="widget-body padding_10"> 
													<div class="panel panel-hovered panel-stacked mb30">
														<div class="panel-body">
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Hash ID<span>*</span></label>
																			<select class="select2" id="hash_id" name="hash_id" type="select">														
																				<option value="0">Select Hash ID</option>
																			</select> 
																	</div>
																</section>
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Currency<span>*</span></label>
																			<select class="select2" id="currency" name="currency" type="select">														
																				<option value="0">Select currency</option>
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
																		<label class="control-label">Amount<span>*</span></label>
																		<input type="text" class="form-control" name="amount" id="amount"/>
																	</div>
																 </section>
															</div>
															<div class="row">		
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Status<span>*</span></label>
																			<select class="select2" id="status" name="status" type="select">														
																				<option value="0">Select Status</option>
																				<option value="Initiated">Initiated</option>
																				<option value="success">Success</option>
																				<option value="failed">Failed</option>
																				<option value="uncertain">Uncertain</option>
																			</select> 
																	</div>
																</section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Country<span>*</span></label>
																			<select class="select2" id="country_id" name="country_id" type="select">														
																				<option value="0">Select Country</option>
																			</select> 
																	</div>
																</section>
															</div>
															<div class="row">
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Payment Method<span>*</span></label>
																			<select class="select2" id="payment_method_id" name="payment_method_id" type="select">														
																				<option value="0">Select Payment Method</option>
																			</select> 
																	</div>
																</section>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						   <div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									  <div class="panel-body">
										<div class="jarviswidget jarviswidget-color-greenLight" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
											<header>
												<h2>Payment Offline Details</h2>
											</header>
											<div>
												<div class="jarviswidget-editbox"></div>
												<div class="widget-body padding_10"> 
													<div class="panel panel-hovered panel-stacked mb30">
														<div class="panel-body">
															<div class="row">
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Received By<span>*</span></label>
																		<input type="text" class="form-control" name="received_by" id="received_by"/>
																	</div>
																 </section>
																 <section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Collection Currency<span>*</span></label>
																		<input type="text" class="form-control" name="collection_currency" id="collection_currency"/>
																	</div>
																 </section>
															</div>
															<div class="row">		
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Date of Collection<span></span></label>
																		<input type="text" class="form-control" name="date_of_collection" id="date_of_collection"/>
																	</div>
																 </section>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> 	
					  	</form>
					</div>
				   </div>
				</div>
			  </div>
		</div>
	  </div>
    </div>
</div>

<!---------------------------------Donation Form End-------------------------------------------------------->

<!---------------------------------Sponsorship Form Start-------------------------------------------------------->

<div id="SponsorshipModal" class="modal fade bs-example-modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="ns_name_popup"><strong></strong></h4>
         </div>
		<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Sponsorship</h2>
					<div class="widget-toolbar">
								
								<button id="btnSponsorshipnBack" type="submit" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<button id="btnSponsorshipSave" type="submit" class="right btn btnSave  addEventBtn ">
									   <i class="fa fa-floppy-o"></i> &nbsp;Save
							    </button>
					</div>
				</header>
				<div>
					<div class="jarviswidget-editbox"></div>
					  <div class="widget-body no-padding">
						 <form id="frmFormSponsorship"  enctype="multipart/form-data" name="frmFormSponsorship">
						 <input type="hidden" name="beneficiary_id" id="beneficiary_id" />
							<div class="panel panel-hovered panel-stacked mb30">
								<div class="panel-body">
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Beneficiary Profile Family<span>*</span></label>
													<select class="select2" id="beneficiary_profile_family_id" name="beneficiary_profile_family_id" type="select">														
														<option value="0">Select Beneficiary Profile Family</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Donor<span>*</span></label>
													<select class="select2" id="donor_id" name="donor_id" type="select">														
														<option value="0">Select Donor</option>
													</select> 
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Frequency<span>*</span></label>
													<select class="select2" id="frequency" name="frequency" type="select">														
														<option value="0">Select Frequency</option>
														<option value="One Time">One Time</option>
														<option value="Daily">Daily</option>
														<option value="Weekly">Weekly</option>
														<option value="Monthly">Monthly</option>
														<option value="Quarterly">Quarterly</option>
														<option value="Annual">Annual</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Amount<span>*</span></label>
												<input type="text" class="form-control" name="amount" id="amount"/>
											</div>
										 </section>
									</div>
									<div class="row">
										  <section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Currency<span>*</span></label>
													<select class="select2" id="currency" name="currency" type="select">														
														<option value="0">Select currency</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Currency Exchange Rate<span>*</span></label>
													<select class="select2" id="currency_exchange_rate_id" name="currency_exchange_rate_id" type="select">														
														<option value="0">Select Currency Exchange Rate</option>
													</select> 
											</div>
										</section>
									</div>
									<div class="row">
										 <section class="col-md-6">
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
							</div>
					  	</form>
					</div>
				   </div>
				</div>
			  </div>
		</div>
	  </div>
    </div>
</div>

<!---------------------------------Sponsorship Form End-------------------------------------------------------->

<!---------------------------------Manage Groups Form Start-------------------------------------------------------->

<div id="ManageGroupsModal" class="modal fade bs-example-modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="ns_name_popup"><strong></strong></h4>
         </div>
		<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Manage Groups</h2>
					<div class="widget-toolbar">
								
								<button id="btnManageGroupsBack" type="submit" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<button id="btnManageGroupsSave" type="submit" class="right btn btnSave  addEventBtn ">
									   <i class="fa fa-floppy-o"></i> &nbsp;Save
							    </button>
					</div>
				</header>
				<div>
					<div class="jarviswidget-editbox"></div>
					  <div class="widget-body no-padding">
						 <form id="frmFormManageGroups"  enctype="multipart/form-data" name="frmFormManageGroups">
						 <input type="hidden" name="beneficiary_id" id="beneficiary_id" />
							<div class="panel panel-hovered panel-stacked mb30">
								<div class="panel-body">
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Beneficiary Group<span>*</span></label>
													<select class="select2" id="beneficiary_group_id" name="beneficiary_group_id" type="select">														
														<option value="0">Select Beneficiary Group</option>
													</select> 
											</div>
										</section>
									</div>
								</div>
							</div>
					  	</form>
					</div>
				   </div>
				</div>
			  </div>
		</div>
	  </div>
    </div>
</div>

<!---------------------------------Manage Groups Form End-------------------------------------------------------->

<?php include($this->admin_layout_dir_path."global_include.php");?>
<script language="javascript">

	$(document).ready(function () {
	
		/*********************************Donation Click Event Start*******************************************/
		 $("#btnDonationSave").click(function(){
				$("#frmFormDonation").submit();
		});	
		/*********************************Donation Click Event End*******************************************/   
		/*********************************Sponsorship Click Event Start*******************************************/
		 $("#btnSponsorshipSave").click(function(){
				$("#frmFormSponsorship").submit();
		});	
		/*********************************Sponsorship Click Event End*******************************************/
		/*********************************Manage Groups Click Event Start*******************************************/
		 $("#btnManageGroupsSave").click(function(){
				$("#frmFormManageGroups").submit();
		});	
		/*********************************Manage Groups Click Event End*******************************************/   
		
		var donation_country=$("#frmFormDonation").find("#country_id");
		var family_country=$("#frmFamilyDetail").find("#country_id");
		var frmForm_country=$("#frmForm").find("#country_id");
		var country_array=[frmForm_country,family_country,donation_country];		
		populateOptionValuesBulk(country_array,"<?php echo $this->url('adminpanel/countries', array('action'=>'getcountry'));?>","Select Country");
		frmForm_country.change(function()
		{
			var country_id =$(this).val();
			
			if(country_id > 0)
			{
				var objFormData = {
						country_id    : country_id
				}
				
				populateDependentOptionValues("beneficiary_profile_id","<?php echo $this->url('adminpanel/beneficiary-profile', array('action'=>'getprofilefamily'));?>","Select Beneficiary Profile",objFormData);
			}
		});
		
		$("#ra_beneficiary_profile_asset_received_date").datepicker();
		$("#edu_start_at").datepicker();
		
		$("#fmly_date_of_birth").datepicker();
		
/*********************************Donation Click populate Start*******************************************/
		$("#date_of_collection").datepicker();
		var asset=$("#frmFormDonation").find("#asset_id");
		var asset_array=[asset];		
		populateOptionValuesBulk(asset_array,"<?php echo $this->url('adminpanel/asset', array('action'=>'getasset'));?>","Select Asset");
		
		var asset_type=$("#frmFormDonation").find("#asset_type_id");
		var asset_type_array=[asset_type];		
		populateOptionValuesBulk(asset_type_array,"<?php echo $this->url('adminpanel/asset-type', array('action'=>'getassettype'));?>","Select Asset Type");
		
		var asset_unit=$("#frmFormDonation").find("#asset_unit_id");
		var asset_unit_array=[asset_unit];		
		populateOptionValuesBulk(asset_unit_array,"<?php echo $this->url('adminpanel/asset-unit-types', array('action'=>'getassetunit'));?>","Select Asset Unit");
		
		var asset_condition=$("#frmFormDonation").find("#asset_condition_id");
		var asset_condition_array=[asset_condition];		
		populateOptionValuesBulk(asset_condition_array,"<?php echo $this->url('adminpanel/asset-conditions', array('action'=>'getcondition'));?>","Select Asset Condition");
		
		var currency=$("#frmFormDonation").find("#currency");
		var currency_exchange_rate=$("#frmFormDonation").find("#currency_exchange_rate_id");
		var currency_exchange_rate_array=[currency_exchange_rate];
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
				
				populateDependentOptionValuesObjectBulk(currency_exchange_rate_array,"<?php echo $this->url('adminpanel/currency-exchange-rate', array('action'=>'getexchangerate'));?>","Select Currency Exchange Rate",objFormData);
			}
		});
		
		var payment_method=$("#frmFormDonation").find("#payment_method_id");
		var payment_method_array=[payment_method];
		donation_country.change(function()
		{
			var country_id =$(this).val();
			if(country_id > 0)
			{
				var objFormData = {
						country_id    : country_id
				}
				populateDependentOptionValuesObjectBulk(payment_method_array,"<?php echo $this->url('adminpanel/payment-method', array('action'=>'getpayment'));?>","Select Payment Method",objFormData);
				
			}
		});	
		
/*********************************Donation Click populate End*******************************************/

/*********************************Sponsorship Click populate Start*******************************************/
		
		var currency1=$("#frmFormSponsorship").find("#currency");
		var currency_exchange_rate1=$("#frmFormSponsorship").find("#currency_exchange_rate_id");
		var currency_exchange_rate_array1=[currency_exchange_rate1];
		var currency_array1=[currency1];
		populateOptionValuesBulk(currency_array1,"<?php echo $this->url('adminpanel/currencies', array('action'=>'getcurrency'));?>","Select Currency");
		currency1.change(function()
		{
			var currency1 =$(this).val();
			
			if(currency1 > 0)
			{
				var objFormData = {
						from_currency    : currency1
				}
				
				populateDependentOptionValuesObjectBulk(currency_exchange_rate_array1,"<?php echo $this->url('adminpanel/currency-exchange-rate', array('action'=>'getexchangerate'));?>","Select Currency Exchange Rate",objFormData);
			}
		});
		
/*********************************Sponsorship Click populate End*******************************************/
/*********************************Manage Groups Click populate Start*******************************************/
		
		
		var beneficiary_group=$("#frmFormManageGroups").find("#beneficiary_group_id");
		var beneficiary_group_array=[beneficiary_group];
		populateOptionValuesBulk(beneficiary_group_array,"<?php echo $this->url('adminpanel/group', array('action'=>'getgroup'));?>","Select Beneficiary Group");
		
/*********************************Manage Groups Click populate End*******************************************/
	});

</script>
