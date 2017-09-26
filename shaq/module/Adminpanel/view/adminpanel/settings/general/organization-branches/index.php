<!-- RIBBON -->
<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Setting</li>
		<li>Organization Settings</li>
		<li>Organization Branches</li>
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
			  url: "<?php echo $this->url('adminpanel/organization-branches', array('action'=>'list'));?>",
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
		$("#tblMasterList tbody").on('click','#btnBranchCommitee', function(e){
				e.preventDefault();
				$('#BranchCommiteeForm').bootstrapValidator("resetForm",true);
				var organization_branch_id = $(this).attr('row-id')
				$('#organization_branch_id').val(organization_branch_id) ;
				
				$('#BranchCommiteeForm').trigger("reset");
				$('#country_id').select2('val','0');
				$('#BranchCommiteeModal').modal('show')

				
				$('ul#langFormTabs li').each(function(){
				   $(this).find('i').removeClass('fa-check').removeClass('fa-times');
				});
				
				$('#langFormTabs a:first').tab('show').trigger('click');
				
				$("#BranchCommiteeSave").click(function(){
					$("#BranchCommiteeForm").submit();
				});
				$("#BranchCommiteeBack").click(function(){
					$('#BranchCommiteeModal').modal('hide')
				});
		});

		function savefrmFormData()  {
			 if(strActionMode=="ADD") {
			 	iActiveID = 0
			 }
			 					
			//Validate  duplicate
			var isDuplicate = fn_validate_duplicate($("#name_<?php echo $this->global_locale_id; ?>").val(), 'organization_branch_locale', "name", "<?php echo $this->url('adminpanel/organization-branches', array('action'=>'validateduplicate'));?>",iActiveID);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found. Name is Already exists !', 0);
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
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/organization-branches', array('action'=>'save'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					strActionMode = "EDIT";
					hideShowLoader(false);							
					fullscreenModeChange('btnSave');
					mySmallAlert('Save Record', 'Organization Branch Entry Saved successfully', 1);
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
		
		function saveBranchCommiteeFormData()  {
		

			 if(strActionMode=="ADD") {
			 	iActiveID = 0
			 }
			 					
			//Validate  duplicate
			var isDuplicate = fn_validate_duplicate($("#name_<?php echo $this->global_locale_id; ?>").val(), 'organization_branch_committee_locale', "name", "<?php echo $this->url('adminpanel/branch-committee', array('action'=>'validateduplicate'));?>",iActiveID);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found. name is Already exists !', 0);
				return false;
			}
			
			var $form = $('#BranchCommiteeForm');
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
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/branch-committee', array('action'=>'save'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					strActionMode = "EDIT";
					hideShowLoader(false);							
					fullscreenModeChange('btnSave');
					mySmallAlert('Save Record', 'Branch Committee Entry Saved successfully', 1);
					iActiveID = objMyPost.DATA.MY_ID;
					$('#BranchCommiteeModal').modal('hide')
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
		$('#tabs2').tabs();
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
					null,
					{ "bSearchable": true, "bSortable": true,
                        "mRender" : function (data, type, full) {							
							return grid_switch(full[0],'is_main_branch',full[8],'Yes');							
						}
					},
					{ "bSearchable": true, "bSortable": true,
                        "mRender" : function (data, type, full) {							
							return grid_switch(full[0],'published',full[9],'Yes');							
						}
					},
                    {"bSearchable": false, "bSortable": false,
                        "mRender" : function (data, type, full) {
							return grid_buttons(full[0]);
                        }
                    }
                ],
                "columnDefs": [
                    { className: "hidden", "targets": [ 0 ] },
					{ "type": "html-input", "targets": [8,9] }
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
					  url: "<?php echo $this->url('adminpanel/organization-branches', array('action'=>'getgriddetailslist'));?>",
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
				city_id: {
                    validators: {
                       callback: {
                            message: 'Please select city',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				manager_id: {
                    validators: {
                       callback: {
                            message: 'Please select manager',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				mobile_number : {
					validators : {
						notEmpty : {
							message : 'Please enter mobile number'						
						},
						digits : {
							message : 'The mobile number is not valid'
						}
					}
				},
				mobile_number_2 : {
					validators : {
						notEmpty : {
							message : 'Please enter mobile number 2'						
						},
						digits : {
							message : 'The mobile number 2 is not valid'
						},
						callback: {
                            message: 'Minimum 12 digit and maximum 14 digit allowed ',
                            callback: function (value, validator, $field) {
                               return (value.length>=12&&value.length<=14);
                            }
                        }
					}
				},
				phone_number : {
					validators : {
						notEmpty : {
							message : 'Please enter phone number'						
						},
						digits : {
							message : 'The phone number is not valid'
						}
					}
				},
				fax : {
					validators : {
						notEmpty : {
							message : 'Please enter fax'						
						},
						digits : {
							message : 'The fax is not valid'
						},
						callback: {
                            message: 'Minimum 12 digit and maximum 14 digit allowed ',
                            callback: function (value, validator, $field) {
                               return (value.length>=12&&value.length<=14);
                            }
                        }
					}
				},
				work_days : {
					validators : {
						notEmpty : {
							message : 'Please enter work days'						
						},
						digits : {
							message : 'The work days is not valid'
						}
					}
				},
				work_hours : {
					validators : {
						notEmpty : {
							message : 'Please enter work hours'						
						},
						digits : {
							message : 'The work hours is not valid'
						}
					}
				},
				break_hours : {
					validators : {
						notEmpty : {
							message : 'Please enter break hours'						
						},
						digits : {
							message : 'The break hours is not valid'
						}
					}
				},
				geo_location : {
					validators : {
						notEmpty : {
							message : 'Please enter geo location'						
						}
					}
				},
				<?php
					foreach($this->activeLocalesArray as $locale)
					{
						?>
						name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter name'						
								}
							}
						},
						website_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter website'						
								},
								uri : {
									message : 'The website is not valid'
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
		
		
		$('#BranchCommiteeForm').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				
				organization_branch_id: {
                    validators: {
                       callback: {
                            message: 'Please select organization branch',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				
				organization_user_id: {
                    validators: {
                       callback: {
                            message: 'Please select organization user',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				organization_id: {
                    validators: {
                       callback: {
                            message: 'Please select organization',
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
						name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter name'						
								}
							}
						},
						
						<?php 
					} 
				?>
								
			}
		})  
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			saveBranchCommiteeFormData();
		});

			
		fnBulkSave("<?php echo $this->url('adminpanel/organization-branches', array('action'=>'bulksave'));?>");
		fnExport("<?php echo $this->url('adminpanel/organization-branches', array('action'=>'exportcsv'));?>");
		fnImport("<?php echo $this->url('adminpanel/organization-branches', array('action'=>'importcsv'));?>");
		fnEdit("<?php echo $this->url('adminpanel/organization-branches', array('action'=>'getrec'));?>");
		fnView("<?php echo $this->url('adminpanel/organization-branches', array('action'=>'getrec'));?>");
		fnDelete("<?php echo $this->url('adminpanel/organization-branches', array('action'=>'delete'));?>"); 
			
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
              <h4 class="modal-title" id="ns_name_popup"><strong>Import Organization Branch</strong></h4>
         </div>
		 <form action="" class="smart-form" enctype="multipart/form-data" name="importcsvform" id="importcsvform">
			<fieldset>
				<section>
					<label for="file" class="input input-file custombrowse" id="importFileLabel">
								<div class="button"><input type="file" name="importfile" id="importfile" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Csv File" readonly="" name="import"id="import">
					</label>
					<div class="note note-error txt-color-red hide" id="importFileError">Please select csv file</div>
					<div class="note note-error">Please <a href="<?php echo $this->url('adminpanel/organization-branches', array('action'=>'downloadtemplate'));?>" target="_blank">download template </a>first (if you don't have download yet!)
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
<div id="BranchCommiteeModal" class="modal fade bs-example-modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>   
         </div>
			<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Branch Committee Info </h2>
					<div class="widget-toolbar">
								
								<button id="BranchCommiteeBack" type="submit" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<button id="BranchCommiteeSave" type="submit" class="right btn btnSave  addEventBtn ">
									   <i class="fa fa-floppy-o"></i> &nbsp;Save
							    </button>
					</div>
				</header>
				
				<div>
					<div class="widget-body">
						<div id="tabs2">
							<ul class="nav-tabs" id="langFormTabs">
								<li class="active">
									<a href="#tabs-<?php echo $this->global_locale_id; ?>" data-toggle="tab"><?php echo $this->globalLocalName;?>&nbsp;<i class="fa"></i></a>
								</li>
								<?php 
									foreach($this->activeLocalesArray as $locale)
									{
										if($locale['id'] == $this->global_locale_id)
											continue;
										?>
										<li>
											<a href="#tabs-<?php echo $locale['id']; ?>" data-toggle="tab"><?php echo $locale['name'];?>&nbsp;<i class="fa"></i></a>
										</li>
										<?php 
									}
								?>
							</ul>
						 <form id="BranchCommiteeForm"  enctype="multipart/form-data" name="BranchCommiteeForm"> 
						   <div class="tab-content">	
							<div class="tab-pane active panel panel-hovered panel-stacked mb30">
								<div id="tabs-<?php echo $this->global_locale_id; ?>">
								
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Name<span>*</span></label>
												<input type="text" class="form-control" name="name_<?php echo $this->global_locale_id; ?>" id="name_<?php echo $this->global_locale_id; ?>"/>
											</div>
											
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label textarea textarea-resizable">Description</label>
												<textarea type="text" id="description_<?php echo $this->global_locale_id; ?>" name="description_<?php echo $this->global_locale_id; ?>" class="description form-control"></textarea>
											</div>
										</section>
									</div>
								
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label textarea textarea-resizable">Agenda</label>
												<textarea type="text" id="agenda_<?php echo $this->global_locale_id; ?>" name="agenda_<?php echo $this->global_locale_id; ?>" class="description form-control"></textarea>
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label textarea textarea-resizable">Annual Plan</label>
												<textarea type="text" id="annual_plan_<?php echo $this->global_locale_id; ?>" name="annual_plan_<?php echo $this->global_locale_id; ?>" class="description form-control"></textarea>
											</div>
											<input type="hidden" id="organization_branch_id" name="organization_branch_id" />
											
										</section>
									</div>
									
									<div class="row">
										
										<section class="col-md-6">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													Published
													<span class="onoffswitch">															
														<input name="published" class="onoffswitch-checkbox" id="published" type="checkbox">
														<label class="onoffswitch-label" for="published">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
												</label>
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
										<div id="tabs-<?php echo $locale['id']; ?>">
										
											<div class="row">
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Name<span>*</span></label>
														<input type="text" class="form-control" name="name_<?php echo $locale['id']; ?>" id="name_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
												
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label textarea textarea-resizable">Description</label>
														<textarea type="text" id="description_<?php echo $locale['id']; ?>" name="description_<?php echo $locale['id']; ?>" class="description form-control"  placeholder=""></textarea>
													</div>
												</section>
											</div>
										
											<div class="row">
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label textarea textarea-resizable">Agenda</label>
														<textarea type="text" id="agenda_<?php echo $locale['id']; ?>" name="agenda_<?php echo $locale['id']; ?>" class="description form-control"  placeholder=""></textarea>
													</div>
												</section>

												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label textarea textarea-resizable">Annual Plan</label>
														<textarea type="text" id="annual_plan_<?php echo $locale['id']; ?>" name="annual_plan_<?php echo $locale['id']; ?>" class="description form-control"  placeholder=""></textarea>
													</div>
												</section>

											</div>
										 
										</div>
										<?php 
									}
								?>
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
<?php include($this->admin_layout_dir_path."global_include.php");?>
<script language="javascript">

	$(document).ready(function () {
		populateOptionValues("organization_id","<?php echo $this->url('adminpanel/organization', array('action'=>'getorganization'));?>","Select Organization");
		populateOptionValues("organization_user_id","<?php echo $this->url('adminpanel/organization-user', array('action'=>'getuser'));?>","Select Organization User");			
		populateOptionValues("country_id","<?php echo $this->url('adminpanel/countries', array('action'=>'getcountry'));?>","Select Country");
		populateOptionValues("city_id","<?php echo $this->url('adminpanel/cities', array('action'=>'getcity'));?>","Select City");
	});


</script>