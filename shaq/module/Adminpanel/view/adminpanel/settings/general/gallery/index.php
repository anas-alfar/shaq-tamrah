<!-- RIBBON -->
<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Beneficiary</li>
		<li>Gallery</li>
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
		var gridYoutubeData = [];
		var oTableYoutube;
		function fetch_grid_data(objFormData)
		{
			hideShowLoader(true);
			$.ajax({
			  type: "POST",
			  url: "<?php echo $this->url('adminpanel/gallery', array('action'=>'list'));?>",
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
		function fetch_grid_youtubedata(objFormData)
		{
			hideShowLoader(true);
			$.ajax({
			  type: "POST",
			  url: "<?php echo $this->url('adminpanel/gallery', array('action'=>'listyoutube'));?>",
			  data: objFormData,
			  dataType: "json",
			  success: function(data){
			  		hideShowLoader(false);
					gridYoutubeData = data.aaData;
					$("#tblMasterYoutubeList").find("tbody").html("");
					oTableYoutube.clear().draw();
					oTableYoutube.rows.add(gridYoutubeData); // Add new data
					oTableYoutube.columns.adjust().draw(); // Redraw the DataTable
					
			  }
			});
			
		}

		function savefrmFormData()  {
			 if(strActionMode=="ADD") {
			 	iActiveID = 0
			 }
			 					
			//Validate  duplicate
			<?php /*?>var isDuplicate = fn_validate_duplicate($("#alias_<?php echo $this->global_locale_id; ?>").val(), 'beneficiary_media_gallery_locale', "alias", "<?php echo $this->url('adminpanel/gallery', array('action'=>'validateduplicate'));?>",iActiveID);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found. Alias is Already exists !', 0);
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
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/gallery', array('action'=>'save'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					strActionMode = "EDIT";
					hideShowLoader(false);							
					fullscreenModeChange('btnSave');
					mySmallAlert('Save Record', 'Beneficiary Media Gallery Entry Saved successfully', 1);
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
		
		function savefrmFormMediaYoutubeGalleryData()  {
			 if(strActionMode=="ADD") {
			 	iActiveID = 0
			 }
			 					
			//Validate  duplicate
			<?php /*?>var isDuplicate = fn_validate_duplicate($("#alias_<?php echo $this->global_locale_id; ?>").val(), 'beneficiary_media_youtube_gallery_locale', "alias", "<?php echo $this->url('adminpanel/gallery', array('action'=>'validateduplicateyoutube'));?>",iActiveID);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found. Alias is Already exists !', 0);
				return false;
			}<?php */?>
			
			var $form = $('#frmFormMediaYoutubeGallery');
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
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/gallery', array('action'=>'savemediayoutubegallery'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					strActionMode = "EDIT";
					hideShowLoader(false);							
					fullscreenModeChange('btnSave');
					mySmallAlert('Save Record', 'Beneficiary Media Youtube Gallery Entry Saved successfully', 1);
					iActiveID = objMyPost.DATA.MY_ID;
					$("#youtube_form").addClass('hide');
					visibleControl('widGrid', true);
					fetch_grid_youtubedata();
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
			var responsiveHelper_tblMasterYoutubeList = undefined;			
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
					grid_tooltip();
					responsiveHelper_tblMasterList.respond();
				},	
				"aaData": gridData,
                "aoColumns": [
                    { "bSearchable": false, "bVisible": false },                  
					{
						"bSortable": 	false, 
						"data": 		null,  
						"bSearchable": 	false,
						"render" : function ( url, type, full) {
							return '<img height="75px" width="75px" src="../public/uploads/localeicons/'+full[1]+'" />';
						}	
					},
                    null,
					null,
					null,
					null,
					null,
					 
					{ "bSearchable": true, "bSortable": true,
                        "mRender" : function (data, type, full) {							
							return grid_switch(full[0],'published',full[7],'Yes');							
						}
					},
                    {"bSearchable": false, "bSortable": false,
                        "mRender" : function (data, type, full) {
							
								return grid_buttons_gallery(full[0],full[7]);
							
                        }
                    }
                ],
                "columnDefs": [
                    { className: "hidden", "targets": [ 0 ] },
					{ "type": "html-input", "targets": [7] }
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
			
			oTableYoutube = $('#tblMasterYoutubeList').DataTable({
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
					if (!responsiveHelper_tblMasterYoutubeList) {
						responsiveHelper_tblMasterYoutubeList = new ResponsiveDatatablesHelper($('#tblMasterYoutubeList'), breakpointDefinition);
						
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_tblMasterYoutubeList.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					grid_tooltip();
					responsiveHelper_tblMasterYoutubeList.respond();
				},	
				"aaData": gridYoutubeData,
                "aoColumns": [
                    { "bSearchable": false, "bVisible": false },                  
                    null,
                    null,
					null,
					null,
					null,
					 
					{ "bSearchable": true, "bSortable": true,
                        "mRender" : function (data, type, full) {							
							return grid_switch(full[0],'published_youtube',full[6],'Yes');							
						}
					},
                    {"bSearchable": false, "bSortable": false,
                        "mRender" : function (data, type, full) {
							return grid_youtube_buttons(full[0],full[6]);
                        }
                    }
                ],
                "columnDefs": [
                    { className: "hidden", "targets": [ 0 ] },
					{ "type": "html-input", "targets": [6] }
                ]	
			});			
			$("#tblMasterYoutubeList thead th input[type=text]").on( 'keyup change', function () {	    	
				oTableYoutube
					.column( $(this).parent().index()+':visible' )
					.search( this.value )
					.draw();	            
			} );
			$("#tblMasterYoutubeList thead th select").on( 'change', function () {				
				var matchValue = this.value					    	    	
				oTableYoutube
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
					<?php
					foreach($this->activeLocalesArray as $locale)
					{
						?>
						alias_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter alias '						
								}
							}
						},
						
						<?php 
					} 
				?>
				media_type_id: {
					validators: {
					   callback: {
							message: 'Please select media type',
							callback: function (value, validator, $field) {
							   return (value != 0 && value != null && value != '');
							}
						}
					}
				},
				media_filetype_id: {
					validators: {
					   callback: {
							message: 'Please select media file type  ',
							callback: function (value, validator, $field) {
							   return (value != 0 && value != null && value != '');
							}
						}
					}
				},
				media_status_id: {
					validators: {
					   callback: {
							message: 'Please select media status  ',
							callback: function (value, validator, $field) {
							   return (value != 0 && value != null && value != '');
							}
						}
					}
				},
				beneficiary_profile_family_id: {
					validators: {
					   callback: {
							message: 'Please select beneficiary profile family  ',
							callback: function (value, validator, $field) {
							   return (value != 0 && value != null && value != '');
							}
						}
					}
				},
				beneficiary_id: {
					validators: {
					   callback: {
							message: 'Please select beneficiary  ',
							callback: function (value, validator, $field) {
							   return (value != 0 && value != null && value != '');
							}
						}
					}
				}
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
			
			$('#frmFormMediaYoutubeGallery').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
					<?php
						foreach($this->activeLocalesArray as $locale)
						{
							?>
							alias_<?php echo $locale['id']?> : {
								validators : {
									notEmpty : {
										message : 'Please enter alias '						
									}
								}
							},
							
							<?php 
						} 
					?>
					youtube_link : {
						validators : {
							notEmpty : {
								message : 'Please enter youtube link '						
							}
						}
					},
					media_status_id: {
						validators: {
						   callback: {
								message: 'Please select media status  ',
								callback: function (value, validator, $field) {
								   return (value != 0 && value != null && value != '');
								}
							}
						}
					},
					beneficiary_profile_family_id: {
						validators: {
						   callback: {
								message: 'Please select beneficiary profile family  ',
								callback: function (value, validator, $field) {
								   return (value != 0 && value != null && value != '');
								}
							}
						}
					},
					beneficiary_id: {
						validators: {
						   callback: {
								message: 'Please select beneficiary  ',
								callback: function (value, validator, $field) {
								   return (value != 0 && value != null && value != '');
								}
							}
						}
					}
					
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
				savefrmFormMediaYoutubeGalleryData();
			});
		
			$("#path").change(function () {
			  if (this.files && this.files[0]) {
			  var reader = new FileReader();
			   // reader.onload = imageIsLoadedLogo;
				 reader.readAsDataURL(this.files[0]);
					
			   //Save img
			
			   var $form = $('#frmForm');
			   var oMyForm = new FormData($form.get(0));
			   //*============================image=====================================
			   file = document.getElementById("path").files[0];
			   if (file && file.size > 0) {
			   var fileInputProfile = document.getElementById("path");
				oMyForm.append("media", file);
			   } else {
				oMyForm.append("media", 0);
			   }
			
			
			   var deferred;
			   deferred = $.ajax({
			
				url: "<?php echo $this->url('adminpanel/gallery', array('action'=>'uploadlogo'));?>",
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
			
				$("#customfileupload").removeClass('hide');
				$("#btnSave").addClass('hide');
				
			   deferred.done(function (result) {
			   
				$("#pathhidden").val(result.media);
				$("#customfileupload").addClass('hide');
				$("#btnSave").removeClass('hide');
				$("#display_img").removeClass('hide');
				$("#display_img").attr("src", "<?php echo $this->public_dir_url; ?>uploads/localeicons/"+result.media);
				mySmallAlert('Media','successfully uploaded.', 1);
			}).fail(function (result) {
				alert("There was an error");
			   });
			  }
			
			 });

		fnBulkSave("<?php echo $this->url('adminpanel/gallery', array('action'=>'bulksave'));?>");
		fnExport("<?php echo $this->url('adminpanel/gallery', array('action'=>'exportcsv'));?>");
		fnImport("<?php echo $this->url('adminpanel/gallery', array('action'=>'importcsv'));?>");
		fnEdit("<?php echo $this->url('adminpanel/gallery', array('action'=>'getrec'));?>");
		fnView("<?php echo $this->url('adminpanel/gallery', array('action'=>'getrec'));?>");
		fnDelete("<?php echo $this->url('adminpanel/gallery', array('action'=>'delete'));?>"); 
		fnGalleryPublished("<?php echo $this->url('adminpanel/gallery', array('action'=>'publishedgallery'));?>"); 
			
		fetch_grid_data();
		
		fnYoutubeBulkSave("<?php echo $this->url('adminpanel/gallery', array('action'=>'bulksaveyoutube'));?>");
		fnYoutubeView("<?php echo $this->url('adminpanel/gallery', array('action'=>'getrecyoutube'));?>");
		fnYoutubeEdit("<?php echo $this->url('adminpanel/gallery', array('action'=>'getrecyoutube'));?>");
		fnYoutubeDelete("<?php echo $this->url('adminpanel/gallery', array('action'=>'deleteyoutube'));?>");
		fnYoutubeExport("<?php echo $this->url('adminpanel/gallery', array('action'=>'youtubeexportcsv'));?>");
		fnYoutubePublished("<?php echo $this->url('adminpanel/gallery', array('action'=>'publishedyoutube'));?>"); 
		fnYoutubeImport("<?php echo $this->url('adminpanel/gallery', array('action'=>'youtubeimportcsv'));?>");
		fetch_grid_youtubedata();	
			
				
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
              <h4 class="modal-title" id="ns_name_popup"><strong>Import Beneficiary Media Gallery</strong></h4>
         </div>
		 <form action="" class="smart-form" enctype="multipart/form-data" name="importcsvform" id="importcsvform">
			<fieldset>
				<section>
					<label for="file" class="input input-file custombrowse" id="importFileLabel">
								<div class="button"><input type="file" name="importfile" id="importfile" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Csv File" readonly="" name="import"id="import">
					</label>
					<div class="note note-error txt-color-red hide" id="importFileError">Please select csv file</div>
					<div class="note note-error">Please <a href="<?php echo $this->url('adminpanel/gallery', array('action'=>'downloadtemplate'));?>" target="_blank">download template </a>first (if you don't have download yet!)
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

<div id="ImportYoutubeCsvFileModal" class="modal fade bs-example-modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="ns_name_popup"><strong>Import Beneficiary Media Youtube Gallery</strong></h4>
         </div>
		 <form action="" class="smart-form" enctype="multipart/form-data" name="importyoutubecsvform" id="importyoutubecsvform">
			<fieldset>
				<section>
					<label for="file" class="input input-file custombrowse" id="importFileLabel1">
								<div class="button"><input type="file" name="importyoutubefile" id="importyoutubefile" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Csv File" readonly="" name="importyoutube"id="importyoutube">
					</label>
					<div class="note note-error txt-color-red hide" id="importFileError1">Please select csv file</div>
					<div class="note note-error">Please <a href="<?php echo $this->url('adminpanel/gallery', array('action'=>'downloadyoutubetemplate'));?>" target="_blank">download template </a>first (if you don't have download yet!)
					</div>
				</section>
			</fieldset>			
		 </form>
		 
		 <div class="modal-footer">
                    <button type="button" class="btn btn-default" name="importyoutubesavebutton" id="importyoutubesavebutton"><i class="fa fa-cloud-download"></i>&nbsp;Import</button>	
         </div>
      </div>
   </div>
</div>


<!----------------------------------------------------Media Youtube Gallery function start----------------------------------------->
<script>

function fnYoutubeBulkSave(strUrl)
{

    $("#btnYoutubeBulkSave").click(function (e) {
        e.preventDefault();       
      
        $.SmartMessageBox({
            title  : "Alert!",
            content: "Are you sure you want to save all?",
            buttons: '[Yes][No]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
               var $form = $('#bulkSaveYoutubeForm');
				var objMasterData = $form.serializeObject();
				objMasterData = JSON.stringify(objMasterData);

				var objFormData =
				{
					FORM_DATA: objMasterData
				};
				hideShowLoader(true);
                var objMyPost = AJAX_Post(strUrl, objFormData);
                if (objMyPost.ERR_NO === 0) {
                    if (objMyPost.DATA.DBStatus === 'OK') {   
						fetch_grid_youtubedata();							
						hideShowLoader(false);
                        mySmallAlert('Success', 'All records updated successfully', 1);
                    }
                    else {
                        mySmallAlert('Error...!', 'There was an error', 0);
                    }
                }
            }
            if (ButtonPressed === "No") {
            }
        });
    });

}
function grid_youtube_buttons(id,published)
{
    var strAction = "";
	strAction += '<input type="hidden" name="gridHiddenIdArray[]" value="'+id+'" />';
    strAction += '<div class="btn-group" style="width:140px;" >';
   		if(acl_VIEW == 1) {
			strAction += '<a href="#" title="View" rel="tooltip" data-placement="bottom" data-original-title ="View" class="btn btn-primary fa fa-eye btn-sm view_youtube" row-id="' + id + '">';
			strAction += '</a>';
		}
    
        strAction += '<a href="#" title="Edit" rel="tooltip" data-placement="bottom" data-original-title ="Edit" class="btn btn-success fa fa-pencil-square-o btn-sm edit_youtube" row-id="' + id + '">';
        strAction += '</a>';
    
        strAction += '<a href="#" title="Delete" rel="tooltip" data-placement="bottom" data-original-title ="Delete" class="btn btn-info fa fa-trash-o btn-sm delete_youtube" row-id="' + id + '" >';
        strAction += '</a>';
		
   	 if(published == 'No') {
		strAction += '<a href="#" title="Published" rel="tooltip" data-placement="bottom" data-original-title ="Published" class="btn btn-warning fa fa-calendar btn-sm published_youtube" row-id="' + id + '" >';
        strAction += '</a>';
	}	
    strAction += '</div>';

    return strAction;

}
function fnYoutubeEdit(strUrl)
{	
    $("#tblMasterYoutubeList").delegate('a.edit_youtube', 'click', function (e) {
        e.preventDefault();		
		$('#frmFormMediaYoutubeGallery').bootstrapValidator("resetForm",true);    
        iActiveID = $(this).attr("row-id");
        clearForm("frmFormMediaYoutubeGallery");
		$("#display_img").removeClass('hide');
		$("#type_id").removeClass('hide');
		$("#sh").removeClass('hide');
		$('#langFormTabs a:first').tab('show').trigger('click');
        populateYoutubeEditEntries(iActiveID, strUrl);
		$("#youtube_form").removeClass('hide');
		$("#widForm").addClass('hide');
		$("#widForm").removeClass('show');
		$("#frmFormMediaYoutubeGallery").find("input, button, textarea, select").attr("disabled", false);
        $("#frmFormMediaYoutubeGallery").find("input, textarea").removeClass("bg-color-lighten");
        $("#btnYoutubeSave").show();
		$('ul#langFormTabs li').each(function(){
		   $(this).find('i').removeClass('fa-check').removeClass('fa-times');
		});
		
    });

}
function fnYoutubeView(strUrl)
{
    $("#tblMasterYoutubeList").delegate('a.view_youtube', 'click', function (e) {
        e.preventDefault();		
		$('#frmFormMediaYoutubeGallery').bootstrapValidator("resetForm",true);
        iActiveID=$(this).attr("row-id");
        clearForm("frmFormMediaYoutubeGallery");
		$("#display_img").removeClass('hide');
		$('#langFormTabs a:first').tab('show').trigger('click');
		$("#langFormTabs").find('i.fa-times').hide()
        populateYoutubeEditEntries(iActiveID,strUrl);
		$("#youtube_form").removeClass('hide');
		$("#widForm").addClass('hide');
		$("#widForm").removeClass('show');
		$("#frmFormMediaYoutubeGallery").find("input, button, textarea, select").attr("disabled", true);
        $("#frmFormMediaYoutubeGallery").find("input, textarea").addClass("bg-color-lighten");
        $("#btnYoutubeSave").hide();
    });
}
function fnYoutubeDelete(strUrl)
{

    $("#tblMasterYoutubeList").delegate('a.delete_youtube', 'click', function (e) {
        e.preventDefault();
        intID=$(this).attr("row-id");
        var url = "pAction=DELETE&ID=" + intID;
        $.SmartMessageBox({
            title  : "Alert!",
            content: "Are you sure you want to delete?",
            buttons: '[Yes][No]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                var objFormData =
                {
                    pAction: 'DELETE',
                    KEY_ID : intID
                };
				hideShowLoader(true);
                var objMyPost = AJAX_Post(strUrl, objFormData);
                if (objMyPost.ERR_NO === 0) {
                    if (objMyPost.DATA.DBStatus === 'OK') {   
						if(is_single == false) {
							fetch_grid_youtubedata();
						}
						else {
							reorderTable.ajax.reload( null, false );    		
						}							
						hideShowLoader(false);
                        mySmallAlert('Success', 'Record  Deleted successfully', 1);
                    }
                    else {
                        mySmallAlert('Error...!', 'There was an error', 0);
                    }
                }
            }
            if (ButtonPressed === "No") {
            }
        });
    });

}
function populateYoutubeEditEntries(iID,strURL) {
    iActiveID = iID;

    var arrForms=[]; // Keep Form Values
    var strElementType; // Keep element type

    var objFormData =
    {
        pAction: 'GETREC',
        KEY_ID : iActiveID
    };
	hideShowLoader(true);
    var objMyPost = AJAX_Post(strURL, objFormData);
	hideShowLoader(false);
    if (objMyPost.ERR_NO === 0) {
        if (objMyPost.DATA.DBStatus === 'OK') {
			if(is_single == false) {
				visibleControl('widForm', true);
				visibleControl('widGrid', false);
			}
            strActionMode = 'EDIT';
			$("#filediv").html('');
            arrForms=objMyPost.DATA.data[0];
			var gender="";
			var additional_image = 1;
			
			
			if (typeof funCallBeforeEdit == 'function') { 
					funCallBeforeEdit(arrForms);	
			}
            $.each( arrForms, function( key, value ) {
				var count = 0;
				var keyObject = $("#frmFormMediaYoutubeGallery").find("#"+key);
                if (keyObject.length > 0 || key == ckeditorvar || key == "hobby" ) {  // check if exists or not
                    strElementType= keyObject.attr("type");

                    if(strElementType == "text") {  // if textbox
                        keyObject.val(value);
                    }
					if(strElementType == "number") {  // if number
                        keyObject.val(value);
                    }					
					else if(strElementType == "email") {  // if email
                        keyObject.val(value);
                    }
					
					else if(strElementType == "password") {  // if password
                        keyObject.val(value);
                    }
					else if(strElementType == "select") {  // if Select Box
						
                        //$("#" + key).select2("val",value);
						keyObject.val(value); // Select the option with a value of 'US'
						keyObject.trigger('change'); // Notify any JS components that the value changed 
						
						
                    }					
					else if(strElementType == "textarea") { 
                       keyObject.html(value);
                    }					
					else if(strElementType == "checkbox"){	
						if(value=="1" || value == "Yes")
							keyObject.prop("checked", true);							
					}
					else {
					  	keyObject.val(value);	
					}
                }
            });
			
			if (typeof funCallAfterEdit == 'function') { 
					funCallAfterEdit(arrForms);	
			}
			
			
        }
    }
    else {
        mySmallAlert('Error...!', 'There was an error', 0);
    }
}
function fnYoutubeExport(strUrl)
{

    $("#btnYoutubeExport").click(function (e) {
        e.preventDefault();  
		var exportfilename = $(this).attr('data-filename');
      
        $.SmartMessageBox({
            title  : "Alert!",
            content: "How you want to export data !",
            buttons: '[ALL][Current Showing Only][No]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "ALL") {
				var export_data = "ALL";
			}
            if (ButtonPressed === "Current Showing Only") {
				var export_data = "SEARCHED";
            }
			if (ButtonPressed === "No") {
				return false;
            }
		    var $form = $('#bulkSaveYoutubeForm');
			var objMasterData = $form.serializeObject();
			objMasterData = JSON.stringify(objMasterData);

			var objFormData =
			{
				FORM_DATA: objMasterData,
				export_data: export_data,
				exportfilename:exportfilename,
			};
			hideShowLoader(true);
			var objMyPost = AJAX_Post(strUrl, objFormData);
			if (objMyPost.ERR_NO === 0) {				
				//downloadCSV(objMyPost.DATA.CSVDATA,exportfilename);
				window.open(objMyPost.DATA.EXPORTURL);
			}
			else
			{
				mySmallAlert('Error...!', 'There was an error', 0);	
			}
           
        });
    });

}
function fnYoutubePublished(strUrl)
{

   $("#tblMasterYoutubeList").delegate('a.published_youtube', 'click', function (e) {
        e.preventDefault();       
       var intID=$(this).attr("row-id");
        $.SmartMessageBox({
            title  : "Alert!",
            content: "Are you sure you want to published?",
            buttons: '[Yes][No]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
               	var $form = $('#bulkSaveYoutubeForm');
				var published='Yes';
					var objFormData =
					{
						published: published,
						gridID:intID
					};
					hideShowLoader(true);
					var objMyPost = AJAX_Post(strUrl, objFormData);
					if (objMyPost.ERR_NO === 0) {
						if (objMyPost.DATA.DBStatus === 'OK') {   
							fetch_grid_youtubedata();						
							hideShowLoader(false);
							mySmallAlert('Success', 'Record updated successfully', 1);
						}
						else {
							mySmallAlert('Error...!', 'There was an error', 0);
						}
					}
				
            }
            if (ButtonPressed === "No") {
				
            }
        });
    });

}

function fnYoutubeImport(strUrl)
{	
	$("#btnYoutubeImport").click(function(){
		$('#ImportYoutubeCsvFileModal').modal({backdrop: 'static', keyboard: false});	
		$("#importFileError1").addClass("hide");	
		$("#importFileLabel1").removeClass("has-error");	
		$('#importyoutubecsvform').find('input:text, input:file').val('');
	});

	$("#importyoutubesavebutton").click(function (e) {
		e.stopPropagation();
		$("#importFileError1").addClass("hide");	
		$("#importFileLabel1").removeClass("has-error");	
		var this1 = document.getElementById("importyoutubefile");			
	
		if (this1.files && this1.files[0]) {
	   
			//Save img
			
			var $form = $('#importyoutubecsvform');
			var oMyForm = new FormData($form.get(0));
			//*============================image=====================================
			file = document.getElementById("importyoutubefile").files[0];
			if (file && file.size > 0) {
				var fileInputProfile = document.getElementById("importyoutubefile");
				oMyForm.append("importyoutubefile", file);
			} else {
				//oMyForm.append("importfile", 0);
				$("#importFileError1").removeClass("hide");					
				$("#importFileLabel1").addClass("has-error");		
				return false;
			}					
			
			var deferred;
			deferred = $.ajax({
			
				url: strUrl,
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
			
			deferred.done(function (result) {
			
				mySmallAlert('Success', result.message1, 1);
				fetch_grid_youtubedata();
				$('#importyoutube').val(null);
				if (result.status === 'OK') {
					$('#ImportYoutubeCsvFileModal').modal('hide')
				}
				else
				{
					$('#ImportYoutubeCsvFileModal').modal('show')
			}
			}).fail(function (result) {
				mySmallAlert('Error', 'Unable to open file!', 0);
			});			   
	  }
	  	else
		{
			$("#importFileError1").removeClass("hide");						
			$("#importFileLabel1").addClass("has-error");
		}
		return false; 										 
	});

}


</script>
<!----------------------------------------------------Media Youtube Gallery function end----------------------------------------->

<?php include($this->admin_layout_dir_path."global_include.php");?>
<script language="javascript">

	$(document).ready(function () {	
		$("#btnNew").click(function ()
		{
			$("#youtube_form").addClass('hide');
			  $("#widForm").removeClass('hide');
		});
		$("#btnYoutubeNew").click(function ()
		{
			 
			 $("#youtube_form").removeClass('hide');
			  $("#widForm").addClass('hide');
			 visibleControl('widGrid', false);
			objMyDetailRecords.length=0;
			tblDetailsListBody.html('');
			
			
			clearForm("frmFormMediaYoutubeGallery");
			strActionMode="ADD";
			glbControlEnable(true);		
			$('#frmFormMediaYoutubeGallery').bootstrapValidator("resetForm",true); 
			$('#langFormTabs a:first').tab('show').trigger('click');
			//alert($('ul#langFormTabs li:first-child').html());
			// $('.nav-tabs a[href="#tabs-1"]').tab('show');
			$('ul#langFormTabs li').each(function(){
			   $(this).find('i').removeClass('fa-check').removeClass('fa-times');
			});

		});
		$("#btnYoutubeSave").click(function(){
			$("#frmFormMediaYoutubeGallery").submit();
		});	
		$("#btnYoutubeBack").click(function (e) {
			e.stopPropagation();
			fullscreenModeChange('btnBack');
			$("#youtube_form").addClass('hide');
			visibleControl('widGrid', true);
	
		});
		
		var media_type=$("#frmForm").find("#media_type_id");
		var media_type_array=[media_type];	
		populateOptionValuesBulk(media_type_array,"<?php echo $this->url('adminpanel/media-types', array('action'=>'getmediatype'));?>","Select Media Type");
		
		var media_filetype1=$("#frmForm").find("#media_filetype_id");
		var media_filetype_array=[media_filetype1];	
		populateOptionValuesBulk(media_filetype_array,"<?php echo $this->url('adminpanel/media-files-types', array('action'=>'getmediafiletype'));?>","Select Media File Type ");
		
		var media_status1=$("#frmForm").find("#media_status_id");
		var media_status2=$("#frmFormMediaYoutubeGallery").find("#media_status_id");
		var media_status_array=[media_status1,media_status2];	
		populateOptionValuesBulk(media_status_array,"<?php echo $this->url('adminpanel/media-statuses', array('action'=>'getmediastatus'));?>","Select Media Status ");		
		
		var beneficiary1=$("#frmForm").find("#beneficiary_id");
		var beneficiary2=$("#frmFormMediaYoutubeGallery").find("#beneficiary_id");
		var beneficiary_array=[beneficiary1,beneficiary2];	
		populateOptionValuesBulk(beneficiary_array,"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getbeneficiary'));?>","Select Beneficiary");
				
		var beneficiary_profile_family1=$("#frmForm").find("#beneficiary_profile_family_id");
		var beneficiary_profile_family_array1=[beneficiary_profile_family1];
		beneficiary1.change(function()
		{
			var beneficiary_id =$(this).val();
			if(beneficiary_id > 0)
			{
				var objFormData = {
						beneficiaryID    : beneficiary_id
				}
				populateDependentOptionValuesObjectBulk(beneficiary_profile_family_array1,"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getFamilyDetail'));?>","Select Beneficiary Profile Family",objFormData);
				
			}
		});
		
		var beneficiary_profile_family2=$("#frmFormMediaYoutubeGallery").find("#beneficiary_profile_family_id");
		var beneficiary_profile_family_array2=[beneficiary_profile_family2];
		beneficiary2.change(function()
		{
			var beneficiary_id =$(this).val();
			if(beneficiary_id > 0)
			{
				var objFormData = {
						beneficiaryID    : beneficiary_id
				}
				populateDependentOptionValuesObjectBulk(beneficiary_profile_family_array2,"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getFamilyDetail'));?>","Select Beneficiary Profile Family",objFormData);
				
			}
		});	
	});


</script>