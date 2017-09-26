<!-- RIBBON -->
<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Setting</li>
		<li>General Settings</li>
		<li>Locales</li>
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
			  url: "<?php echo $this->url('adminpanel/locales', array('action'=>'list'));?>",
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
			  url: "<?php echo $this->url('adminpanel/locales', array('action'=>'getorderlist'));?>",
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
		
		function savefrmFormData()  {
		

			/*if ($("#name").val() == '') {
				mySmallAlert('Error...!', 'Name is Required', 0);
				return;
			}
			if ($("#config_key").val() == '') {
				mySmallAlert('Error...!', 'Config Key is Required', 0);
				return;
			}
			if ($("#config_value").val() == '') {
				mySmallAlert('Error...!', 'Config Value is Required', 0);
				return;
			}
			if ($("#config_type").val() == '') {
				mySmallAlert('Error...!', 'Config Type is Required', 0);
				return;
			}
			if ($("#environment").val() == '') {
				mySmallAlert('Error...!', 'Environment is Required', 0);
				return;
			}
			*/
			 if(strActionMode=="ADD") {
			 	iActiveID = 0
			 }
			 					
			//Validate  duplicate
			var isDuplicate = fn_validate_duplicate($("#locale").val(), 'locale', "locale", "<?php echo $this->url('adminpanel/locales', array('action'=>'validateduplicate'));?>",iActiveID);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found. Locale is Already exists !', 0);
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
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/locales', array('action'=>'save'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					strActionMode = "EDIT";
					hideShowLoader(false);							
					fullscreenModeChange('btnSave');
					mySmallAlert('Save Record', 'Locale Entry Saved successfully', 1);
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
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/locales', array('action'=>'saveorder'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					mySmallAlert('Save Record', 'Locales Order Saved successfully', 1);
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
					$( nRow ).find('td:eq(6)').attr('data-search', data[6]);
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
					{ "bSearchable": true, "bSortable": true,
                        "mRender" : function (data, type, full) {							
							return grid_switch(full[0],'published',full[6],'Yes');							
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
					{ "type": "html-input", "targets": [6] }
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
				/*if(matchValue != '')
					matchValue = '<!--'+matchValue+'-->';*/
					    	    	
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
				status: {
                    validators: {
                       callback: {
                            message: 'Please select config type',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },			
				country_id: {
                    validators: {
                       callback: {
                            message: 'Please select environment',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				locale : {
					validators : {
						notEmpty : {
							message : 'Please enter locale'						
						},
						callback: {
                            message: 'Maximum six charactors allowed ',
                            callback: function (value, validator, $field) {
                               return (value.length<=6);
                            }
                        }
					}
				},
				name : {
					validators : {
						notEmpty : {
							message : 'Please enter name'
						}
					}
				},
				locale_title : {
					validators : {
						notEmpty : {
							message : 'Please enter locale title'
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
			}
		})        
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmFormData();
		});
		
		
 /*$("#image").change(function () {
  if (this.files && this.files[0]) {
   var reader = new FileReader();
   reader.onload = imageIsLoadedLogo;
   reader.readAsDataURL(this.files[0]);

   //Save img

   var $form = $('#frmForm');
   var oMyForm = new FormData($form.get(0));
   //*============================image=====================================
   file = document.getElementById("image").files[0];
   if (file && file.size > 0) {
    var fileInputProfile = document.getElementById("photo_file");
    oMyForm.append("image", file);
   } else {
    oMyForm.append("image", 0);
   }


   var deferred;
   deferred = $.ajax({

    url: "",
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
   
	$("#photohidden").val(result.image);
	$("#customfileupload").addClass('hide');
	$("#btnSave").removeClass('hide');
	$("#display_img").removeClass('hide');
	$("#display_img").attr("src", "public/uploads/"+result.image);
    alert("Product Image  successfully Uploaded.");
   }).fail(function (result) {
    alert("There was an error");
   });
  }

 });*/

 			
		fnBulkSave("<?php echo $this->url('adminpanel/locales', array('action'=>'bulksave'));?>");
		fnImport("<?php echo $this->url('adminpanel/locales', array('action'=>'importcsv'));?>");
		fnExport("<?php echo $this->url('adminpanel/locales', array('action'=>'exportcsv'));?>");
		fnEdit("<?php echo $this->url('adminpanel/locales', array('action'=>'getrec'));?>");
		fnView("<?php echo $this->url('adminpanel/locales', array('action'=>'getrec'));?>");
		fnDelete("<?php echo $this->url('adminpanel/locales', array('action'=>'delete'));?>"); 
			
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
              <h4 class="modal-title" id="ns_name_popup"><strong>Import Locale</strong></h4>
         </div>
		 <form action="" class="smart-form" enctype="multipart/form-data" name="importcsvform" id="importcsvform">
			<fieldset>
				<section>
					<label for="file" class="input input-file custombrowse" id="importFileLabel">
								<div class="button"><input type="file" name="importfile" id="importfile" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Csv File" readonly="" name="import"id="import">
					</label>
					<div class="note note-error txt-color-red hide" id="importFileError">Please select csv file</div>
					<div class="note note-error">Please <a href="<?php echo $this->url('adminpanel/locales', array('action'=>'downloadtemplate'));?>" target="_blank">download template </a>first (if you don't have download yet!)
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

	$(document).ready(function () {			
		populateOptionValues("country_id","<?php echo $this->url('adminpanel/countries', array('action'=>'getcountry'));?>","Select Country");
	});


</script>