<!-- RIBBON -->
<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Setting</li>
		<li>General Settings</li>
		<li>Assets</li>
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
		function funCallAfterNew()
		{
			$("#asset_type_id").html('<option value="0">Select Asset Type</option>');
		}
		function funCallBeforePopup(intID,name,typeID)
		{
			 $('#asset_type_title').html(name);
			
		}
		function funCallAfterPopup(intID,name,typeID)
		{
				  populateEditEntries_view(typeID,"<?php echo $this->url('adminpanel/asset-type', array('action'=>'getrec'));?>")
		}
			
		var gridData;
		function fetch_grid_data(objFormData)
		{
			hideShowLoader(true);
			$.ajax({
			  type: "POST",
			  url: "<?php echo $this->url('adminpanel/asset', array('action'=>'list'));?>",
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
		$("#btnAssetType").click(function(){
			$('#AssetTypeModal').modal('show')
		});
		function savefrmFormData()  {
			 if(strActionMode=="ADD") {
			 	iActiveID = 0
			 }
			 					
			//Validate  duplicate
			var isDuplicate = fn_validate_duplicate($("#name_<?php echo $this->global_locale_id; ?>").val(), 'asset_locale', "name", "<?php echo $this->url('adminpanel/asset', array('action'=>'validateduplicate'));?>",iActiveID);
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
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/asset', array('action'=>'save'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					strActionMode = "EDIT";
					hideShowLoader(false);							
					fullscreenModeChange('btnSave');
					mySmallAlert('Save Record', 'Asset Entry Saved successfully', 1);
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
		function savefrmFormTypeData()  {
			 if(strActionMode=="ADD") {
			 	iActiveID = 0
			 }
			 					
			//Validate  duplicate
			var objFormData =
			{
				name    			: $("#name_<?php echo $this->global_locale_id; ?>").val(),
				country_id			: $("#country_id").val()

			};
			var isDuplicate = fn_validate_duplicate_multiple('view_asset_type',"<?php echo $this->url('adminpanel/asset-type', array('action'=>'validateduplicate'));?>",iActiveID,objFormData);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found.Asset Type for Selected Country is Already exists !', 0);
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
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/asset-type', array('action'=>'save'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					strActionMode = "EDIT";
					hideShowLoader(false);							
					fullscreenModeChange('btnSave');
					mySmallAlert('Save Record', 'Asset Type Entry Saved successfully', 1);
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
		$('#tabs1').tabs();
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
                    null,
                    null,
					null,
					null,
					null,
					null,
					null,
					null,
									
					{ "bSearchable": true, "bSortable": true,
                        "mRender" : function (data, type, full) {							
							return grid_switch(full[0],'published',full[9],'Yes');							
						}
					},
					{"bSearchable": false, "bSortable": false,
                        "mRender" : function (data, type, full) {
							return grid_buttons_popup(full[0],full[1],full[10]);
                        }
                    }
                ],
                "columnDefs": [
                    { className: "hidden", "targets": [ 0 ] },
					{ "type": "html-input", "targets": [9] }
                ]	
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
				tax_type: {
                    validators: {
                       callback: {
                            message: 'Please select Tax Type',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				currency: {
                    validators: {
                       callback: {
                            message: 'Please select Currency',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				
				currency_exchange_rate : {
							validators : {
								notEmpty : {
									message : 'Please enter currency exchange rate'						
								}
							}
						},
				
				tax_value : {
					 validators: {
							greaterThan: {
								value: 0.1,
								message: 'The Tax Value rate min value must be 0.1'
							}
						}
				},
				cost : {
					validators : {
						notEmpty : {
							message : 'Please enter Cost'						
						},
						digits : {
							message : 'The Cost is not valid'
						}
					}
				},
				
				asset_type_id : {
					validators : {
						notEmpty : {
							message : 'Please enter Asset Type'						
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
		
		$('#frmFormType').bootstrapValidator({
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
			savefrmFormDataType();
		});
		
		<?php
	foreach($this->activeLocalesArray as $locale)
	{
?>	
  $("#photo_<?php echo $locale['id']; ?>").change(function () {
  if (this.files && this.files[0]) {
  var reader = new FileReader();
   // reader.onload = imageIsLoadedLogo;
     reader.readAsDataURL(this.files[0]);
	  	
   //Save img

   var $form = $('#frmForm');
   var oMyForm = new FormData($form.get(0));
   //*============================image=====================================
   file = document.getElementById("photo_<?php echo $locale['id']; ?>").files[0];
   if (file && file.size > 0) {
   var fileInputProfile = document.getElementById("photo_<?php echo $locale['id']; ?>");
    oMyForm.append("photo", file);
   } else {
    oMyForm.append("photo", 0);
   }


   var deferred;
   deferred = $.ajax({

    url: "<?php echo $this->url('adminpanel/asset', array('action'=>'uploadlogo'));?>",
    type: "POST",
    processData: false,
    contentType: false,
    dataType: 'json',
    data: oMyForm,
    beforeSend: function () {

    },
    success: function () {
		
    }

   });

	$("#customfileupload_<?php echo $locale['id'];?>").removeClass('hide');
	$("#btnSave").addClass('hide');
	
   deferred.done(function (result) {
   
	$("#photohidden_<?php echo $locale['id'];?>").val(result.photo);
	$("#customfileupload_<?php echo $locale['id'];?>").addClass('hide');
	$("#btnSave").removeClass('hide');
	$("#display_img_<?php echo $locale['id']; ?>").removeClass('hide');
	$("#display_img_<?php echo $locale['id']; ?>").attr("src", "<?php echo $this->public_dir_url; ?>uploads/localeicons/"+result.photo);
   	mySmallAlert('Assets photo','successfully uploaded.', 1);
}).fail(function (result) {
    alert("There was an error");
   });
  }

 });
<?php 
	} 
?>

			
		fnBulkSave("<?php echo $this->url('adminpanel/asset', array('action'=>'bulksave'));?>");
		fnExport("<?php echo $this->url('adminpanel/asset', array('action'=>'exportcsv'));?>");
		fnImport("<?php echo $this->url('adminpanel/asset', array('action'=>'importcsv'));?>");
		fnEdit("<?php echo $this->url('adminpanel/asset', array('action'=>'getrec'));?>");
		fnView("<?php echo $this->url('adminpanel/asset', array('action'=>'getrec'));?>");
		fnDelete("<?php echo $this->url('adminpanel/asset', array('action'=>'delete'));?>"); 
		fnPopup("<?php echo $this->url('adminpanel/asset', array('action'=>'popup'));?>");
			
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
              <h4 class="modal-title" id="ns_name_popup"><strong>Import Asset</strong></h4>
         </div>
		 <form action="" class="smart-form" enctype="multipart/form-data" name="importcsvform" id="importcsvform">
			<fieldset>
				<section>
					<label for="file" class="input input-file custombrowse" id="importFileLabel">
								<div class="button"><input type="file" name="importfile" id="importfile" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Csv File" readonly="" name="import"id="import">
					</label>
					<div class="note note-error txt-color-red hide" id="importFileError">Please select csv file</div>
					<div class="note note-error">Please <a href="<?php echo $this->url('adminpanel/asset', array('action'=>'downloadtemplate'));?>" target="_blank">download template </a>first (if you don't have download yet!)
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
<div id="PopupGridModal" class="modal fade bs-example-modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="ns_name_popup"><strong>Asset Types : <span id="asset_type_title"></span></strong></h4>
         </div>
				<div class="widget-body">
										<div id="tabs1">
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
										 <form id="frmForm"  enctype="multipart/form-data" name="frmForm"> 
										   <div class="tab-content">	
											<div class="tab-pane active panel panel-hovered panel-stacked mb20">
												<div id="tabs-<?php echo $this->global_locale_id; ?>">
													<div class="row">
														<section class="col-md-6">
															<div class="form-group">
																<label class="control-label" >Name<span>*</span></label>
																<input type="text" class="form-control" name="view_name_<?php echo $this->global_locale_id; ?>" id="view_name_<?php echo $this->global_locale_id; ?>" readonly=""/>
															</div>
															<div class="form-group">
																<label class="control-label" style="float:left;">Country<span>*</span></label>
																	<input type="text" class="form-control" name="view_country" id="view_country" readonly=""/> 
															</div>
														</section>
														<section class="col-md-6">
															<div class="form-group">
																<label class="control-label" >Description<span></span></label>
																<textarea type="text" id="view_description_<?php echo $this->global_locale_id; ?>" name="view_description_<?php echo $this->global_locale_id; ?>" class="description form-control" readonly=""></textarea>
															</div>
														</section>
														
													</div>
													<div class="row">
														<section class="col-md-2">
															<div class="form-group">
																<label>&nbsp;</label>
																<label class="customwidth">
																	<span class="onoffswitch">															
																		<input name="view_has_tax" class="onoffswitch-checkbox" id="view_has_tax" type="checkbox" readonly="">
																		<label class="onoffswitch-label" for="view_has_tax">
																			<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
																			<span class="onoffswitch-switch"></span>
																		</label>
																	</span>
																	Has Tax
																</label>
															</div>
														</section>
														<section class="col-md-2">
															<div class="form-group">
																<label>&nbsp;</label>
																<label class="customwidth">
																	<span class="onoffswitch">															
																		<input name="view_has_sku" class="onoffswitch-checkbox" id="view_has_sku" type="checkbox" readonly="">
																		<label class="onoffswitch-label" for="view_has_sku">
																			<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
																			<span class="onoffswitch-switch"></span>
																		</label>
																	</span>
																	Has Sku
																</label>
															</div>
														</section>
														<section class="col-md-2">
															<div class="form-group">
																<label>&nbsp;</label>
																<label class="customwidth">
																	<span class="onoffswitch">															
																		<input name="view_has_serial" class="onoffswitch-checkbox" id="view_has_serial" type="checkbox" readonly="">
																		<label class="onoffswitch-label" for="view_has_serial">
																			<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
																			<span class="onoffswitch-switch"></span>
																		</label>
																	</span>
																	Has Serial
																</label>
															</div>
														</section>
														<section class="col-md-3">
															<div class="form-group">
																<label>&nbsp;</label>
																<label class="customwidth">
																	<span class="onoffswitch">															
																		<input name="view_has_expiry_date" class="onoffswitch-checkbox" id="view_has_expiry_date" type="checkbox" readonly="">
																		<label class="onoffswitch-label" for="view_has_expiry_date">
																			<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
																			<span class="onoffswitch-switch"></span>
																		</label>
																	</span>
																	Has Expiry Date
																</label>
															</div>
														</section>
														<section class="col-md-2">
															<div class="form-group">
																<label>&nbsp;</label>
																<label class="customwidth">
																	<span class="onoffswitch">															
																		<input name="view_published" class="onoffswitch-checkbox" id="view_published" type="checkbox" readonly="">
																		<label class="onoffswitch-label" for="view_published">
																			<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
																			<span class="onoffswitch-switch"></span>
																		</label>
																	</span>
																	Published
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
																		<label class="control-label" >Name<span>*</span></label>
																		<input type="text" class="form-control" name="view_name_<?php echo $locale['id']; ?>" id="view_name_<?php echo $locale['id']; ?>" readonly=""/>
																	</div>
																</section>
																<section class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Description<span></span></label>
																		<textarea type="text" id="view_description_<?php echo $locale['id']; ?>" name="view_description_<?php echo $locale['id']; ?>" class="description form-control" readonly=""></textarea>
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
		 <div class="modal-footer">
         </div>
      </div>
   </div>
</div>
<div id="AssetTypeModal" class="modal fade bs-example-modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="ns_name_popup"><strong>Asset Type</strong></h4>
         </div>
				<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Asset Type Info </h2>
					<div class="widget-toolbar">
								
								<button id="btnBackType" type="submit" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<button id="btnSaveType" type="submit" class="right btn btnSave addEventBtn ">
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
						 <form id="frmFormType"  enctype="multipart/form-data" name="frmFormType"> 
						   <div class="tab-content">	
							<div class="tab-pane active panel panel-hovered panel-stacked mb20">
								<div id="tabs-<?php echo $this->global_locale_id; ?>">
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Name<span>*</span></label>
												<input type="text" class="form-control" name="name_<?php echo $this->global_locale_id; ?>" id="name_<?php echo $this->global_locale_id; ?>"/>
											</div>
											<div class="form-group">
												<label class="control-label">Country<span>*</span></label>
													<select class="select2" id="countrytype_id" name="country_id" type="select">														
														<option value="0">Select Country</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Description<span></span></label>
												<textarea type="text" id="description_<?php echo $this->global_locale_id; ?>" name="description_<?php echo $this->global_locale_id; ?>" class="description form-control" ></textarea>
											</div>
										</section>
										
									</div>
									<div class="row">
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="has_tax" class="onoffswitch-checkbox" id="has_tax" type="checkbox">
														<label class="onoffswitch-label" for="has_tax">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Has Tax
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="has_sku" class="onoffswitch-checkbox" id="has_sku" type="checkbox">
														<label class="onoffswitch-label" for="has_sku">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Has Sku
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="has_serial" class="onoffswitch-checkbox" id="has_serial" type="checkbox">
														<label class="onoffswitch-label" for="has_serial">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Has Serial
												</label>
											</div>
										</section>
										<section class="col-md-3">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="has_expiry_date" class="onoffswitch-checkbox" id="has_expiry_date" type="checkbox">
														<label class="onoffswitch-label" for="has_expiry_date">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Has Expiry Date
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="published" class="onoffswitch-checkbox" id="published" type="checkbox">
														<label class="onoffswitch-label" for="published">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Published
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
														<label class="control-label">Description<span></span></label>
														<textarea type="text" id="description_<?php echo $locale['id']; ?>" name="description_<?php echo $locale['id']; ?>" class="description form-control" ></textarea>
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
		 <div class="modal-footer">
         </div>
      </div>
   </div>
</div>
<?php include($this->admin_layout_dir_path."global_include.php");?>
<script language="javascript">  
  
	$("#country_id").change(function()
	{
		var country_id =$(this).val();
		if(country_id > 0)
		{
			var objFormData = {
					country_id    : country_id
			}
			populateDependentOptionValues("asset_type_id","<?php echo $this->url('adminpanel/asset-type', array('action'=>'getassettype'));?>","Select Asset Type",objFormData);
		}
	});
	
</script>

<script language="javascript">  
  
	$("#currency").change(function()
	{
		var from_currency =$(this).val();
		if(from_currency > 0)
		{
			var objFormData = {
					fc    : from_currency
			}
			populateDependentOptionValues("currency_exchange_rate_id","<?php echo $this->url('adminpanel/currency-exchange-rate', array('action'=>'getexchangerate'));?>","Select Currency Exchange Rate",objFormData);
		}
	});
	
</script>

<script language="javascript">

	$(document).ready(function () {			
		populateOptionValues("country_id","<?php echo $this->url('adminpanel/countries', array('action'=>'getcountry'));?>","Select Country");
		populateOptionValues("countrytype_id","<?php echo $this->url('adminpanel/countries', array('action'=>'getcountry'));?>","Select Country");
		
		populateOptionValues("currency","<?php echo $this->url('adminpanel/currencies', array('action'=>'getcurrency'));?>","Select Currency");	
	});


</script>