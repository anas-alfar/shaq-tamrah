<!-- RIBBON -->
<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Setting</li>
		<li>General Settings</li>
		<li>Menus</li>
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
				<?php include("menuitem.php");?> 
			</article>
		</div>
	</section>
</div>					
<!-- END #MAIN CONTENT -->
<script type="text/javascript">
		var gridData = [];
		var gridTableId1 = 'tblMasterList1';
		var parentId = 0;
		var parentName = '';
		var parentIdFieldName = 'menu_id';
		var gridData;
		function fetch_grid_data(objFormData)
		{
			hideShowLoader(true);
			$.ajax({
			  type: "POST",
			  url: "<?php echo $this->url('adminpanel/menu', array('action'=>'list'));?>",
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
		var gridData1;
		function fetch_grid_data1()
		{
			hideShowLoader(true);
			var objFormData ={
				menu_id : parentId
			};
			$.ajax({
			  type: "POST",
			  url: "<?php echo $this->url('adminpanel/menu', array('action'=>'list1'));?>",
			  data: objFormData,
			  dataType: "json",
			  success: function(data){
			  		hideShowLoader(false);
					gridData1 = data.aaData;
					$("#tblMasterList1").find("tbody").html("");
					oTable1.clear().draw();
					oTable1.rows.add(gridData1); // Add new data
					oTable1.columns.adjust().draw(); // Redraw the DataTable
					
			  }
			});
			
		}
		function cllBeforefnNew(parentId,name)
		{
			var objData = {
				'menu_id' : parentId
			};
			populateDependentOptionValues("parent_id","<?php echo $this->url('adminpanel/menu', array('action'=>'getmenuitem'));?>","Select Parent",objData);	
			fetch_grid_data1();
		}

		function savefrmFormData()  {
		
			$("#"+parentIdFieldName).val(parentId);
			 if(strActionMode=="ADD") {
			 	iActiveID = 0
			 }
			 					
			//Validate  duplicate
			var objFormData =
			{
				menu_category_id    : $("#menu_category_id").val(),
				country_id			: $("#country_id").val(),
				organization_id		: $("#organization_id").val(),

			};
			var isDuplicate = fn_validate_duplicate_multiple('menu',"<?php echo $this->url('adminpanel/menu', array('action'=>'validateduplicate'));?>",iActiveID,objFormData);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found. Menu is Already exists !', 0);
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
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/menu', array('action'=>'save'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					strActionMode = "EDIT";
					hideShowLoader(false);							
					fullscreenModeChange('btnSave');
					mySmallAlert('Save Record', 'Menu Entry Saved successfully', 1);
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
		function savefrmFormData1()  {
		
		
			 if(strActionMode=="ADD1") {
			 	iActiveID = 0
			 }
			 					
			//Validate  duplicate
			/*var isDuplicate = fn_validate_duplicate($("#name_<?php echo $this->global_locale_id; ?>").val(), 'menu_item_locale', "name", "<?php echo $this->url('adminpanel/menu', array('action'=>'validateduplicate1'));?>",iActiveID);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found. name is Already exists !', 0);
				return false;
			}*/
			
			var $form = $('#frmForm1');
			var objMasterData = $form.serializeObject();
			if (strActionMode == 'ADD1')
				$.extend(objMasterData, { MASTER_KEY_ID: 0});
			else
				$.extend(objMasterData, { MASTER_KEY_ID: iActiveID});

			objMasterData = JSON.stringify(objMasterData);

			var objFormData =
			{
				pAction    : strActionMode,
				FORM_DATA1: objMasterData

			};
			hideShowLoader(true);
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/menu', array('action'=>'save1'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					$('#langFormTabs a:first').tab('show').trigger('click');
					 $(this).find('i').removeClass('fa-check').addClass('fa-folder-open');
					   $(".fa.fa-check").hide();
					strActionMode = "EDIT1";
					hideShowLoader(false);
					clearForm('frmForm1');
					$('#frmForm1').bootstrapValidator("resetForm",true); 
					mySmallAlert('Save Record', 'Menu Item Saved successfully', 1);
					iActiveID = objMyPost.DATA.MY_ID;	
					fetch_grid_data1();
				}
			}
			else {
				hideShowLoader(false);
				mySmallAlert('Error...!', 'There was an error', 0);
			}

		}	
		
		var pagefunction = function() { 
			var updateOutput = function(e) {
				var list = e.length ? e : $(e.target), output = list.data('output');
				if (window.JSON) {
					output.val(window.JSON.stringify(list.nestable('serialize')));
					//, null, 2));
				} else {
					output.val('JSON browser support required for this demo.');
				}
			};
			updateOutput($('#nestable3').data('output', $('#nestable3-output')));
	
			$('#nestable-menu').on('click', function(e) {
				var target = $(e.target), action = target.data('action');
				if (action === 'expand-all') {
					$('.dd').nestable('expandAll');
				}
				if (action === 'collapse-all') {
					$('.dd').nestable('collapseAll');
				}
			});
	
			$('#nestable3').nestable().on('change', updateOutput);
			
			$('#tabs').tabs();
			var responsiveHelper_tblMasterList = undefined;	
			var responsiveHelper_tblMasterList1 = undefined;			
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
													
					{ "bSearchable": true, "bSortable": true,
                        "mRender" : function (data, type, full) {							
							return grid_switch(full[0],'published',full[8],'Yes');							
						}
					},
                    {"bSearchable": false, "bSortable": false,
                        "mRender" : function (data, type, full) {
							return grid_buttons_new(full[0],full[1]);
                        }
                    }
                ],
                "columnDefs": [
                    { className: "hidden", "targets": [ 0 ] },
					{ "type": "html-input", "targets": [8] }
                ]	
			});	
			oTable1 = $('#tblMasterList1').DataTable({
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
					if (!responsiveHelper_tblMasterList1) {
						responsiveHelper_tblMasterList1 = new ResponsiveDatatablesHelper($('#tblMasterList1'), breakpointDefinition);
						
					}
				},				
				"rowCallback" : function(nRow) {
					responsiveHelper_tblMasterList1.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_tblMasterList1.respond();
				},	
				"aaData": gridData1,
                "aoColumns": [
                    { "bSearchable": false, "bVisible": false },                  
                    null,
                    null,
					null,
					null,							
					{ "bSearchable": true, "bSortable": true,
                        "mRender" : function (data, type, full) {							
							return grid_switch(full[0],'published1',full[5],'Yes');							
						}
					},
					null,
					 {"bSearchable": false, "bSortable": false,
                        "mRender" : function (data, type, full) {
							return grid_buttons(full[0],full[1]);
                        }
                    }
                ],
                "columnDefs": [
                    { className: "hidden", "targets": [ 0 ] },
					{ "type": "html-input", "targets": [5] }
                ]	
			});			
			$("#tblMasterList1 thead th input[type=text]").on( 'keyup change', function () {	    	
				oTable1
					.column( $(this).parent().index()+':visible' )
					.search( this.value )
					.draw();	            
			} );	
			$("#tblMasterList1 thead th select").on( 'change', function () {
				
				var matchValue = this.value
				/*if(matchValue != '')
					matchValue = '<!--'+matchValue+'-->';*/
					    	    	
				oTable1
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
				menu_category_id: {
                    validators: {
                       callback: {
                            message: 'Please select Menu Category',
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
				sequence : {
					validators : {
						notEmpty : {
							message : 'Please enter sequence'						
						},
						digits : {
							message : 'The sequence is not valid'
						}
					}
				},
				 fees : {
						validators: {
							greaterThan: {
								value: 0.1,
									message: 'The fees min value must be 0.1'
										 }
									}
								},
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
		
		$('#frmForm1').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				sequence : {
					validators : {
						notEmpty : {
							message : 'Please enter sequence'						
						},
						digits : {
							message : 'The sequence is not valid'
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
						link_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter link'						
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
			savefrmFormData1();
		});
			
		fnBulkSave("<?php echo $this->url('adminpanel/menu', array('action'=>'bulksave'));?>");
		
		fnImport("<?php echo $this->url('adminpanel/menu', array('action'=>'importcsv'));?>");
		fnExport("<?php echo $this->url('adminpanel/menu', array('action'=>'exportcsv'));?>");
		fnEdit("<?php echo $this->url('adminpanel/menu', array('action'=>'getrec'));?>");
		fnView("<?php echo $this->url('adminpanel/menu', array('action'=>'getrec'));?>");
		fnDelete("<?php echo $this->url('adminpanel/menu', array('action'=>'delete'));?>"); 
			
		fetch_grid_data();
		
		fnBulkSave1("<?php echo $this->url('adminpanel/menu', array('action'=>'bulksave1'));?>");
		fnNew("<?php echo $this->url('adminpanel/menu', array('action'=>'new'));?>");
		fnEdit1("<?php echo $this->url('adminpanel/menu', array('action'=>'getrec1'));?>");
		fnView1("<?php echo $this->url('adminpanel/menu', array('action'=>'getrec1'));?>");
		fnDelete1("<?php echo $this->url('adminpanel/menu', array('action'=>'delete1'));?>");
		fnExport1("<?php echo $this->url('adminpanel/menu', array('action'=>'exportcsv1'));?>"); 
		fnImport1("<?php echo $this->url('adminpanel/menu', array('action'=>'importcsv1'));?>");
		}
		

		loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/datatables/jquery.dataTables.min.js", function(){
			loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/datatables/dataTables.colVis.min.js", function(){
				loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/datatables/dataTables.tableTools.min.js", function(){
					loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/datatables/dataTables.bootstrap.min.js", function(){
						loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/datatable-responsive/datatables.responsive.min.js", function(){
							loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/bootstrapvalidator/bootstrapValidator.min.js", function(){
								loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/jquery-nestable/jquery.nestable.min.js", pagefunction);
							});
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
              <h4 class="modal-title" id="ns_name_popup"><strong>Import menu</strong></h4>
         </div>
		 <form action="" class="smart-form" enctype="multipart/form-data" name="importcsvform" id="importcsvform">
			<fieldset>
				<section>
					<label for="file" class="input input-file custombrowse" id="importFileLabel">
								<div class="button"><input type="file" name="importfile" id="importfile" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Csv File" readonly="" name="import"id="import">
					</label>
					<div class="note note-error txt-color-red hide" id="importFileError">Please select csv file</div>
					<div class="note note-error">Please <a href="<?php echo $this->url('adminpanel/menu', array('action'=>'downloadtemplate'));?>" target="_blank">download template </a>first (if you don't have download yet!)
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
<div id="ImportCsvFileModal1" class="modal fade bs-example-modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="ns_name_popup1"><strong>Import <span id="popup_titles_span"></span></strong></h4>
         </div>
		 <form action="" class="smart-form" enctype="multipart/form-data" name="importcsvform1" id="importcsvform1">
			<fieldset>
				<section>
					<label for="file" class="input input-file custombrowse" id="importFileLabel1">
								<div class="button"><input type="file" name="importfile1" id="importfile1" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Csv File" readonly="" name="import1"id="import1">
					</label>
					<div class="note note-error txt-color-red hide" id="importFileError1">Please select csv file</div>
					<div class="note note-error">Please <a href="<?php echo $this->url('adminpanel/menu', array('action'=>'downloadtemplate1'));?>" target="_blank">download template </a>first (if you don't have download yet!)
					</div>
				</section>
			</fieldset>			
		 </form>
		 
		 <div class="modal-footer">
                    <button type="button" class="btn btn-default" name="importsavebutton1" id="importsavebutton1"><i class="fa fa-cloud-download"></i>&nbsp;Import</button>	
         </div>
      </div>
   </div>
</div>


<?php include($this->admin_layout_dir_path."global_include.php");?>
<script language="javascript">
	$(document).ready(function () {			
		populateOptionValues("menu_category_id","<?php echo $this->url('adminpanel/menu-categories', array('action'=>'getmenucategory'));?>","Select Menu Category");
		populateOptionValues("country_id","<?php echo $this->url('adminpanel/countries', array('action'=>'getcountry'));?>","Select Country");
		populateOptionValues("organization_id","<?php echo $this->url('adminpanel/organization', array('action'=>'getorganization'));?>","Select Organization");
		populateOptionValues("organization_branch_id","<?php echo $this->url('adminpanel/organization-branches', array('action'=>'getbranch'));?>","Select Organization Branch");
		
		
});

</script>