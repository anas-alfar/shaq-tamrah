<!-- RIBBON -->
<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Setting</li>
		<li>Post Settings</li>
		<li>Categories</li>
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
				<?php include("reorder.php");?>
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
			  url: "<?php echo $this->url('adminpanel/post-categories', array('action'=>'list'));?>",
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
		function fetch_grid_data_draggable(objFormData)
		{
			
			$("#draggable-output").val('');
			hideShowLoader(true);
			$.ajax({
			  type: "POST",
			  url: "<?php echo $this->url('adminpanel/post-categories', array('action'=>'getorderlist'));?>",
			  data: objFormData,
			  dataType: "json",
			  success: function(data){
			  		hideShowLoader(false);
					$('#draggableListId').html(data.draggable_list);
					$('#draggableListId').sortable({
					   update: function(event, ui) {
						  var draggableOrder = $(this).sortable('toArray').toString();
						  $("#draggable-output").val(draggableOrder);
					   }
					});									
			  }
			});
			
		}
		$("#tblMasterList tbody").on('click','#btnPostType', function(e){
				e.preventDefault();
				$('#PosttypeModal').modal('show')
				$('#posttypeForm').bootstrapValidator("resetForm",true);
				var post_category_id = $(this).attr('row-id')
				$('#post_category_id').val(post_category_id) ;
				
				$('#PosttypeModal').trigger("reset");
				$('#country_id').select2('val','0');
				

				
				$('ul#langFormTabs li').each(function(){
				   $(this).find('i').removeClass('fa-check').removeClass('fa-times');
				});
				
				$('#langFormTabs a:first').tab('show').trigger('click');
				
				$("#PostTypeSave").click(function(){
					$("#posttypeForm").submit();
				});
				$("#PostTypeBack").click(function(){
					$('#PosttypeModal').modal('hide')
				});
		});

		function savefrmFormData()  {
			 if(strActionMode=="ADD") {
			 	iActiveID = 0
			 }
			 					
			//Validate  duplicate
			var isDuplicate = fn_validate_duplicate($("#name_<?php echo $this->global_locale_id; ?>").val(), 'post_category_locale', "name", "<?php echo $this->url('adminpanel/post-categories', array('action'=>'validateduplicate'));?>",iActiveID);
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
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/post-categories', array('action'=>'save'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					strActionMode = "EDIT";
					hideShowLoader(false);							
					fullscreenModeChange('btnSave');
					mySmallAlert('Save Record', 'Post Category Entry Saved successfully', 1);
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
		function saveposttypeFormData()  {
			 if(strActionMode=="ADD") {
			 	iActiveID = 0
			 }
			 					
			//Validate  duplicate
			var objFormData =
			{
				name						: $("#name_<?php echo $this->global_locale_id; ?>").val(),
				post_category_id			: $("#post_category_id").val(),
				country_id					: $("#country_id").val(),
			};
			var isDuplicate = fn_validate_duplicate_multiple('view_post_type',"<?php echo $this->url('adminpanel/post-types', array('action'=>'validateduplicate'));?>",iActiveID,objFormData);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found. Post Type for Selected Category and Country Already exists !', 0);
				return false;
			}
			
			var $form = $('#posttypeForm');
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
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/post-types', array('action'=>'save'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					strActionMode = "EDIT";
					hideShowLoader(false);							
					fullscreenModeChange('btnSave');
					mySmallAlert('Save Record', 'Type Entry Saved successfully', 1);
					iActiveID = objMyPost.DATA.MY_ID;
					$('#PosttypeModal').modal('hide')
					fetch_grid_data();
				}
			}
			else {
				hideShowLoader(false);
				mySmallAlert('Error...!', 'There was an error', 0);
			}

		}		
		
		function saveorderData()  {
			var postorder=$("#post-categories-output").val();
			if(postorder=='')
			{
				mySmallAlert('Error...!', 'You did not change anything', 0);
			}
			hideShowLoader(true);
			var $form = $('#reorderGrid');
			var objMasterData = $form.serializeObject();
			var objFormData =
			{
				
				postorder: postorder

			};
			hideShowLoader(true);
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/post-categories', array('action'=>'saveorder'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					mySmallAlert('Save Record', 'Post Categories Order Saved successfully', 1);
					iActiveID = objMyPost.DATA.MY_ID;
					
				}
			}
			else {
				hideShowLoader(false);
				mySmallAlert('Error...!', 'There was an error', 0);
			}

		}	
		
		function saveorderData()  {
			var dragorder=$("#draggable-output").val();
			
			if(dragorder=='')
			{
				mySmallAlert('Error...!', 'You did not change anything', 0);
			}
			hideShowLoader(true);
			var $form = $('#reorderGrid');
			var objMasterData = $form.serializeObject();
			var objFormData =
			{
				
				dragorder: dragorder

			};
			hideShowLoader(true);
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/post-categories', array('action'=>'saveorder'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					mySmallAlert('Save Record', 'Post Categories Order Saved successfully', 1);
					iActiveID = objMyPost.DATA.MY_ID;
					fetch_grid_data_draggable();
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
				"createdRow": function( nRow, data, dataIndex ) {
					// Set the data-status attribute, and add a class
					
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
                    { "bSearchable": true, "bSortable": true,
                        "mRender" : function (data, type, full) {
							return grid_switch(full[0],'published',full[4],'Yes');		
										
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
					{ "type": "html-input", "targets": [4] }
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
					  url: "<?php echo $this->url('adminpanel/post-categories', array('action'=>'getgriddetailslist'));?>",
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
		$('#posttypeForm').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
				post_category_id: {
                    validators: {
                       callback: {
                            message: 'Please select post categories',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				country_id: {
                    validators: {
                       callback: {
                            message: 'Please select Country',
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
			saveposttypeFormData();
		});
		
		<?php 
	foreach($this->activeLocalesArray as $locale)
	{
						
	  ?>									

	$("#logo_<?php echo $locale['id']; ?>").change(function () {
  if (this.files && this.files[0]) {
   var reader = new FileReader();
   reader.readAsDataURL(this.files[0]);

   //Save img

   var $form = $('#frmForm');
   var oMyForm = new FormData($form.get(0));
   //*============================image=====================================
   file = document.getElementById("logo_<?php echo $locale['id']; ?>").files[0];
   
   if (file && file.size > 0) {
    var fileInputProfile = document.getElementById("logo_<?php echo $locale['id']; ?>");
	
    oMyForm.append("logo_<?php echo $locale['id']; ?>", file);
   } else {
    oMyForm.append("logo_<?php echo $locale['id']; ?>", 0);
   }
   oMyForm.append("field_name","logo_<?php echo $locale['id']; ?>")


   var deferred;
   deferred = $.ajax({

    url: "<?php echo $this->url('adminpanel/post-categories', array('action'=>'uploadimage'));?>",
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

	$("#customfileupload_<?php echo $locale['id']; ?>").removeClass('hide');
	$("#btnSave").addClass('hide');
	
   deferred.done(function (result) {
   
	$("#imagehidden_<?php echo $locale['id']; ?>").val(result.image);
	$("#customfileupload_<?php echo $locale['id']; ?>").addClass('hide');
	$("#btnSave").removeClass('hide');
	$("#display_img_<?php echo $locale['id']; ?>").attr("src", "<?php echo $this->public_dir_url;?>uploads/localeicons/"+result.image);
    mySmallAlert('Success!', 'Logo uploaded successfully.', 1);
   }).fail(function (result) {
    mySmallAlert('Error...!', 'There was an error', 0);
   });
  }

 });
 <?php
 
 }
 
 ?>

			
		fnBulkSave("<?php echo $this->url('adminpanel/post-categories', array('action'=>'bulksave'));?>");
		fnExport("<?php echo $this->url('adminpanel/post-categories', array('action'=>'exportcsv'));?>");
		fnImport("<?php echo $this->url('adminpanel/post-categories', array('action'=>'importcsv'));?>");
		fnEdit("<?php echo $this->url('adminpanel/post-categories', array('action'=>'getrec'));?>");
		fnView("<?php echo $this->url('adminpanel/post-categories', array('action'=>'getrec'));?>");
		fnDelete("<?php echo $this->url('adminpanel/post-categories', array('action'=>'delete'));?>"); 
			
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
              <h4 class="modal-title" id="ns_name_popup"><strong>Import Post Category</strong></h4>
         </div>
		 <form action="" class="smart-form" enctype="multipart/form-data" name="importcsvform" id="importcsvform">
			<fieldset>
				<section>
					<label for="file" class="input input-file custombrowse" id="importFileLabel">
								<div class="button"><input type="file" name="importfile" id="importfile" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Csv File" readonly="" name="import"id="import">
					</label>
					<div class="note note-error txt-color-red hide" id="importFileError">Please select csv file</div>
					<div class="note note-error">Please <a href="<?php echo $this->url('adminpanel/post-categories', array('action'=>'downloadtemplate'));?>" target="_blank">download template </a>first (if you don't have download yet!)
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
<div id="PosttypeModal" class="modal fade bs-example-modal-lg">
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
							<h2>Post Type Info </h2>
							<div class="widget-toolbar">
										
										<button id="PostTypeBack" type="submit" class="right btn btnBack  addEventBtn ">
											   <i class="fa fa-angle-left"></i> &nbsp;Back
										</button>
										<button id="PostTypeSave" type="submit" class="right btn btnSave  addEventBtn ">
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
								 <form id="posttypeForm"  enctype="multipart/form-data" name="frmForm"> 
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
														<label class="control-label textarea textarea-resizable">Description</label>
														<textarea type="text" id="description_<?php echo $this->global_locale_id; ?>" name="description_<?php echo $this->global_locale_id; ?>" class="description form-control"></textarea>
													</div>
												</section>
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
													 <input id="post_category_id" name="post_category_id" type="hidden">
													
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
																<textarea type="text" id="description_<?php echo $locale['id']; ?>" name="description_<?php echo $locale['id']; ?>" class="description form-control"></textarea>
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

populateOptionValues("country_id","<?php echo $this->url('adminpanel/countries', array('action'=>'getcountry'));?>","Select Country");

</script>