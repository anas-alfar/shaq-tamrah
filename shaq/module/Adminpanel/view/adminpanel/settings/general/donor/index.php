<!-- RIBBON -->
<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Beneficiaries</li>
		<li>Donor</li>
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
		function fetch_grid_data(objFormData)
		{
			hideShowLoader(true);
			$.ajax({
			  type: "POST",
			  url: "<?php echo $this->url('adminpanel/donor', array('action'=>'list'));?>",
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
			var isDuplicate = fn_validate_duplicate($("#first_name_<?php echo $this->global_locale_id; ?>").val(), 'donor_locale', "first_name", "<?php echo $this->url('adminpanel/donor', array('action'=>'validateduplicate'));?>",iActiveID);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found. First Name is Already exists !', 0);
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
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/donor', array('action'=>'save'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					strActionMode = "EDIT";
					hideShowLoader(false);							
					fullscreenModeChange('btnSave');
					mySmallAlert('Save Record', 'Organization User Entry Saved successfully', 1);
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
					
					$( nRow ).find('td:eq(7)').attr('data-search', data[10]);
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
                    {"bSearchable": false, "bSortable": false,
                        "mRender" : function (data, type, full) {
							return grid_buttons(full[0]);
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
				nationality_id: {
                    validators: {
                       callback: {
                            message: 'Please select nationality',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				
				title: {
                    validators: {
                       callback: {
                            message: 'Please select title',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				email : {
					validators : {
						notEmpty : {
							message : 'Please enter from email'						
						},
						emailAddress: {
							message : 'Please enter valide email'						
						}
					}
				},
				visibility: {
                    validators: {
                       callback: {
                            message: 'Please select visibility',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				ssn : {
					validators : {
						notEmpty : {
							message : 'Please enter ssn'						
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
						},
						callback: {
                            message: 'Minimum 12 digit and maximum 14 digit allowed ',
                            callback: function (value, validator, $field) {
                               return (value.length>=12&&value.length<=14);
                            }
                        }
					}
				},

				<?php
					foreach($this->activeLocalesArray as $locale)
					{
						?>
						first_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter first name'						
								}
							}
						},
						second_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter second name'						
								}
							}
						},
						third_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter third name'						
								}
							}
						},
						last_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter last name'						
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
		$("#avatar").change(function () {
			  if (this.files && this.files[0]) {
			  var reader = new FileReader();
			   // reader.onload = imageIsLoadedLogo;
				 reader.readAsDataURL(this.files[0]);
					
			   //Save img
			
			   var $form = $('#frmForm');
			   var oMyForm = new FormData($form.get(0));
			   //*============================image=====================================
			   file = document.getElementById("avatar").files[0];
			   if (file && file.size > 0) {
			   var fileInputProfile = document.getElementById("avatar");
				oMyForm.append("avatar", file);
			   } else {
				oMyForm.append("avatar", 0);
			   }
			
			
			   var deferred;
			   deferred = $.ajax({
			
				url: "<?php echo $this->url('adminpanel/donor', array('action'=>'uploadavatar'));?>",
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
			   
				$("#avatarhidden").val(result.avatar);
				$("#customfileupload").addClass('hide');
				$("#btnSave").removeClass('hide');
				$("#display_img").removeClass('hide');
				$("#display_img").attr("src", "<?php echo $this->public_dir_url; ?>uploads/localeicons/"+result.avatar);
				mySmallAlert('Avatar','successfully uploaded.', 1);
			}).fail(function (result) {
				alert("There was an error");
			   });
			  }
			
			 });
			
		fnBulkSave("<?php echo $this->url('adminpanel/donor', array('action'=>'bulksave'));?>");
		fnExport("<?php echo $this->url('adminpanel/donor', array('action'=>'exportcsv'));?>");
		fnImport("<?php echo $this->url('adminpanel/donor', array('action'=>'importcsv'));?>");
		fnEdit("<?php echo $this->url('adminpanel/donor', array('action'=>'getrec'));?>");
		fnView("<?php echo $this->url('adminpanel/donor', array('action'=>'getrec'));?>");
		fnDelete("<?php echo $this->url('adminpanel/donor', array('action'=>'delete'));?>"); 
			
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
              <h4 class="modal-title" id="ns_name_popup"><strong>Import Organization User</strong></h4>
         </div>
		 <form action="" class="smart-form" enctype="multipart/form-data" name="importcsvform" id="importcsvform">
			<fieldset>
				<section>
					<label for="file" class="input input-file custombrowse" id="importFileLabel">
								<div class="button"><input type="file" name="importfile" id="importfile" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Csv File" readonly="" name="import"id="import">
					</label>
					<div class="note note-error txt-color-red hide" id="importFileError">Please select csv file</div>
					<div class="note note-error">Please <a href="<?php echo $this->url('adminpanel/donor', array('action'=>'downloadtemplate'));?>" target="_blank">download template </a>first (if you don't have download yet!)
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
  
	
</script>

<script language="javascript">

	$(document).ready(function () {			
		populateOptionValues("nationality_id","<?php echo $this->url('adminpanel/countries', array('action'=>'getcountry'));?>","Select Nationality");
		$("#date_of_birth").datepicker();
	});


</script>