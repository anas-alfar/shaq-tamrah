<!-- RIBBON -->
<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Beneficiary</li>
		<li>Messages</li>
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
		var gridSmsData = [];
		var oTableSms;
		function fetch_grid_data(objFormData)
		{
			hideShowLoader(true);
			$.ajax({
			  type: "POST",
			  url: "<?php echo $this->url('adminpanel/message', array('action'=>'list'));?>",
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
		function fetch_grid_smsdata(objFormData)
		{
			hideShowLoader(true);
			$.ajax({
			  type: "POST",
			  url: "<?php echo $this->url('adminpanel/message', array('action'=>'listsms'));?>",
			  data: objFormData,
			  dataType: "json",
			  success: function(data){
			  		hideShowLoader(false);
					gridSmsData = data.aaData;
					$("#tblMasterSmsList").find("tbody").html("");
					oTableSms.clear().draw();
					oTableSms.rows.add(gridSmsData); // Add new data
					oTableSms.columns.adjust().draw(); // Redraw the DataTable
					
			  }
			});
			
		}

		function savefrmFormData()  {
			 if(strActionMode=="ADD") {
			 	iActiveID = 0
			 }
			 					
			//Validate  duplicate
			var isDuplicate = fn_validate_duplicate($("#from_name").val(), 'beneficiary_message_email', "from_name", "<?php echo $this->url('adminpanel/message', array('action'=>'validateduplicate'));?>",iActiveID);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found. From Name is Already exists !', 0);
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
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/message', array('action'=>'save'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					strActionMode = "EDIT";
					hideShowLoader(false);							
					fullscreenModeChange('btnSave');
					mySmallAlert('Save Record', 'Beneficiary Message Email Entry Saved successfully', 1);
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
		
		function savefrmFormSmsData()  {
			 if(strActionMode=="ADD") {
			 	iActiveID = 0
			 }
			 					
			//Validate  duplicate
			var isDuplicate = fn_validate_duplicate($("#from_name").val(), 'beneficiary_message_sms', "from_name", "<?php echo $this->url('adminpanel/message', array('action'=>'validateduplicate'));?>",iActiveID);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found. Alias is Already exists !', 0);
				return false;
			}
			
			var $form = $('#frmFormSms');
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
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/message', array('action'=>'savesms'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					strActionMode = "EDIT";
					hideShowLoader(false);							
					fullscreenModeChange('btnSave');
					mySmallAlert('Save Record', 'Beneficiary Message  Sms Entry Saved successfully', 1);
					iActiveID = objMyPost.DATA.MY_ID;
					$("#sms_form").addClass('hide');
					visibleControl('widGrid', true);
					fetch_grid_smsdata();
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
			var responsiveHelper_tblMasterSmsList = undefined;			
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
                    null,
                    null,
					null,
					null,
					null,
					null,
					null,
					null,
                    {"bSearchable": false, "bSortable": false,
                        "mRender" : function (data, type, full) {
								return grid_viewedit_buttons(full[0]);
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
			
			oTableSms = $('#tblMasterSmsList').DataTable({
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
					if (!responsiveHelper_tblMasterSmsList) {
						responsiveHelper_tblMasterSmsList = new ResponsiveDatatablesHelper($('#tblMasterSmsList'), breakpointDefinition);
						
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_tblMasterSmsList.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					grid_tooltip();
					responsiveHelper_tblMasterSmsList.respond();
				},	
				"aaData": gridSmsData,
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
                    {"bSearchable": false, "bSortable": false,
                        "mRender" : function (data, type, full) {
							return grid_sms_buttons(full[0]);
                        }
                    }
                ],
			});			
			$("#tblMasterSmsList thead th input[type=text]").on( 'keyup change', function () {	    	
				oTableSms
					.column( $(this).parent().index()+':visible' )
					.search( this.value )
					.draw();	            
			} );
			$("#tblMasterSmsList thead th select").on( 'change', function () {				
				var matchValue = this.value					    	    	
				oTableSms
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
					message_type_id: {
						validators: {
						   callback: {
								message: 'Please select message type ',
								callback: function (value, validator, $field) {
								   return (value != 0 && value != null && value != '');
								}
							}
						}
					},
					from_name: {
						validators : {
							notEmpty : {
								message : 'Please enter from name '						
							}
						}
					},
					from_email : {
						validators : {
							notEmpty : {
								message : 'Please enter from email'						
							},
							emailAddress: {
								message : 'Please enter valide from email'						
							}
						}
					},
					to_name: {
						validators : {
							notEmpty : {
								message : 'Please enter to name '						
							}
						}
					},
					to_email : {
						validators : {
							notEmpty : {
								message : 'Please enter to email'						
							},
							emailAddress: {
								message : 'Please enter valide to email'						
							}
						}
					},
					locale_id: {
						validators: {
						   callback: {
								message: 'Please select locale',
								callback: function (value, validator, $field) {
								   return (value != 0 && value != null && value != '');
								}
							}
						}
					},
					message_template_id: {
						validators: {
						   callback: {
								message: 'Please select message template ',
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
		.on('success.form.bv', function(e) {
			// Prevent form submission
			e.preventDefault();
			savefrmFormData();
		});
			
			$('#frmFormSms').bootstrapValidator({
			message: 'This value is not valid',
			excluded: [':disabled'],
			feedbackIcons : {
				valid : 'glyphicon glyphicon-ok',
				invalid : 'glyphicon glyphicon-remove',
				validating : 'glyphicon glyphicon-refresh'
			},
			fields : {
					message_type_id: {
						validators: {
						   callback: {
								message: 'Please select message type ',
								callback: function (value, validator, $field) {
								   return (value != 0 && value != null && value != '');
								}
							}
						}
					},
					from_name: {
						validators : {
							notEmpty : {
								message : 'Please enter from name '						
							}
						}
					},
					from_mobile_number: {
						validators: {
							notEmpty : {
								message : 'Please enter from mobile number'						
							},
							numeric: {
								message: 'The from mobile number is not valid'
							}
						}
					},
					to_name: {
						validators : {
							notEmpty : {
								message : 'Please enter to name '						
							}
						}
					},
					to_mobile_number: {
						validators: {
							notEmpty : {
								message : 'Please enter to mobile number'						
							},
							numeric: {
								message: 'The to mobile number is not valid'
							}
						}
					},
					locale_id: {
						validators: {
						   callback: {
								message: 'Please select locale',
								callback: function (value, validator, $field) {
								   return (value != 0 && value != null && value != '');
								}
							}
						}
					},
					message_template_id: {
						validators: {
						   callback: {
								message: 'Please select message template ',
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
			.on('success.form.bv', function(e) {
				// Prevent form submission
				e.preventDefault();
				savefrmFormSmsData();
			});
		

		
		fnExport("<?php echo $this->url('adminpanel/message', array('action'=>'exportcsv'));?>");
		fnImport("<?php echo $this->url('adminpanel/message', array('action'=>'importcsv'));?>");
		fnEdit("<?php echo $this->url('adminpanel/message', array('action'=>'getrec'));?>");
		fnView("<?php echo $this->url('adminpanel/message', array('action'=>'getrec'));?>");
		fetch_grid_data();
		
		fnSmsView("<?php echo $this->url('adminpanel/message', array('action'=>'getrecsms'));?>");
		fnSmsEdit("<?php echo $this->url('adminpanel/message', array('action'=>'getrecsms'));?>");
		fnSmsExport("<?php echo $this->url('adminpanel/message', array('action'=>'smsexportcsv'));?>");
		fnSmsImport("<?php echo $this->url('adminpanel/message', array('action'=>'smsimportcsv'));?>")
		fetch_grid_smsdata();	
			
				
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
              <h4 class="modal-title" id="ns_name_popup"><strong>Import Beneficiary Message Email</strong></h4>
         </div>
		 <form action="" class="smart-form" enctype="multipart/form-data" name="importcsvform" id="importcsvform">
			<fieldset>
				<section>
					<label for="file" class="input input-file custombrowse" id="importFileLabel">
								<div class="button"><input type="file" name="importfile" id="importfile" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Csv File" readonly="" name="import"id="import">
					</label>
					<div class="note note-error txt-color-red hide" id="importFileError">Please select csv file</div>
					<div class="note note-error">Please <a href="<?php echo $this->url('adminpanel/message', array('action'=>'downloadtemplate'));?>" target="_blank">download template </a>first (if you don't have download yet!)
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
<div id="ImportCsvSmsFileModal" class="modal fade bs-example-modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="ns_name_popup"><strong>Import Beneficiary Message Sms</strong></h4>
         </div>
		 <form action="" class="smart-form" enctype="multipart/form-data" name="importcsvsmsform" id="importcsvsmsform">
			<fieldset>
				<section>
					<label for="file" class="input input-file custombrowse" id="importFileLabelSms">
								<div class="button"><input type="file" name="importfilesms" id="importfilesms" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Csv File" readonly="" name="importsms"id="importsms">
					</label>
					<div class="note note-error txt-color-red hide" id="importFileErrorSms">Please select csv file</div>
					<div class="note note-error">Please <a href="<?php echo $this->url('adminpanel/message', array('action'=>'downloadtemplatesms'));?>" target="_blank">download template </a>first (if you don't have download yet!)
					</div>
				</section>
			</fieldset>			
		 </form>
		 
		 <div class="modal-footer">
                    <button type="button" class="btn btn-default" name="importsmssavebutton" id="importsmssavebutton"><i class="fa fa-cloud-download"></i>&nbsp;Import</button>	
         </div>
      </div>
   </div>
</div>


<!----------------------------------------------------Media Youtube message function start----------------------------------------->
<script>

function grid_sms_buttons(id)
{
    var strAction = "";
	strAction += '<input type="hidden" name="gridHiddenIdArray[]" value="'+id+'" />';
    strAction += '<div class="btn-group" style="width:140px;" >';
   		if(acl_VIEW == 1) {
			strAction += '<a href="#" title="View" rel="tooltip" data-placement="bottom" data-original-title ="View" class="btn btn-primary fa fa-eye btn-sm view_sms" row-id="' + id + '">';
			strAction += '</a>';
		}
    
        strAction += '<a href="#" title="Edit" rel="tooltip" data-placement="bottom" data-original-title ="Edit" class="btn btn-success fa fa-pencil-square-o btn-sm edit_sms" row-id="' + id + '">';
        strAction += '</a>';
    strAction += '</div>';

    return strAction;

}
function fnSmsEdit(strUrl)
{	
    $("#tblMasterSmsList").delegate('a.edit_sms', 'click', function (e) {
        e.preventDefault();		
		$('#frmFormSms').bootstrapValidator("resetForm",true);    
        iActiveID = $(this).attr("row-id");
        clearForm("frmFormSms");
		$("#display_img").removeClass('hide');
		$("#type_id").removeClass('hide');
		$("#sh").removeClass('hide');
		$('#langFormTabs a:first').tab('show').trigger('click');
        populateSmsEditEntries(iActiveID, strUrl);
		$("#sms_form").removeClass('hide');
		$("#widForm").addClass('hide');
		$("#widForm").removeClass('show');
		$("#frmFormSms").find("input, button, textarea, select").attr("disabled", false);
        $("#frmFormSms").find("input, textarea").removeClass("bg-color-lighten");
        $("#btnSmsSave").show();
		$('ul#langFormTabs li').each(function(){
		   $(this).find('i').removeClass('fa-check').removeClass('fa-times');
		});
		
    });

}
function fnSmsView(strUrl)
{
    $("#tblMasterSmsList").delegate('a.view_sms', 'click', function (e) {
        e.preventDefault();		
		$('#frmFormSms').bootstrapValidator("resetForm",true);
        iActiveID=$(this).attr("row-id");
        clearForm("frmFormSms");
		$("#display_img").removeClass('hide');
		$('#langFormTabs a:first').tab('show').trigger('click');
		$("#langFormTabs").find('i.fa-times').hide()
        populateSmsEditEntries(iActiveID,strUrl);
		$("#sms_form").removeClass('hide');
		$("#widForm").addClass('hide');
		$("#widForm").removeClass('show');
		$("#frmFormSms").find("input, button, textarea, select").attr("disabled", true);
        $("#frmFormSms").find("input, textarea").addClass("bg-color-lighten");
        $("#btnSmsSave").hide();
    });
}
function populateSmsEditEntries(iID,strURL) {
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
				var keyObject = $("#frmFormSms").find("#"+key);
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
function fnSmsExport(strUrl)
{

    $("#btnsmsExport").click(function (e) {
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
		    var $form = $('#bulkSaveSmsForm');
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
function fnSmsImport(strUrl)
{	
	$("#btnSmsImport").click(function(){
		$('#ImportCsvSmsFileModal').modal({backdrop: 'static', keyboard: false});	
		$("#importFileErrorSms").addClass("hide");	
		$("#importFileLabelSms").removeClass("has-error");	
		$('#importcsvsmsform').find('input:text, input:file').val('');
	});

	$("#importsmssavebutton").click(function (e) {
		e.stopPropagation();
		$("#importFileErrorSms").addClass("hide");	
		$("#importFileLabelSms").removeClass("has-error");	
		var this1 = document.getElementById("importfilesms");			
	
		if (this1.files && this1.files[0]) {
	   
			//Save img
			
			var $form = $('#importcsvsmsform');
			var oMyForm = new FormData($form.get(0));
			//*============================image=====================================
			file = document.getElementById("importfilesms").files[0];
			if (file && file.size > 0) {
				var fileInputProfile = document.getElementById("importfilesms");
				oMyForm.append("importfilesms", file);
			} else {
				//oMyForm.append("importfile", 0);
				$("#importFileErrorSms").removeClass("hide");					
				$("#importFileLabelSms").addClass("has-error");		
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
				fetch_grid_smsdata();	
				$('#importsms').val(null);
				if (result.status === 'OK') {
					$('#ImportCsvSmsFileModal').modal('hide')
				}
				else
				{
					$('#ImportCsvSmsFileModal').modal('show')
			}
			}).fail(function (result) {
				mySmallAlert('Error', 'Unable to open file!', 0);
			});			   
	  }
	  	else
		{
			$("#importFileErrorSms").removeClass("hide");						
			$("#importFileLabelSms").addClass("has-error");
		}
		return false; 										 
	});

}



</script>
<!----------------------------------------------------Media Youtube message function end----------------------------------------->

<?php include($this->admin_layout_dir_path."global_include.php");?>
<script language="javascript">

	$(document).ready(function () {	
		$("#btnNew").click(function ()
		{
			$("#sms_form").addClass('hide');
			  $("#widForm").removeClass('hide');
		});
		$("#btnSmsNew").click(function ()
		{
			 
			 $("#sms_form").removeClass('hide');
			  $("#widForm").addClass('hide');
			 visibleControl('widGrid', false);
			objMyDetailRecords.length=0;
			tblDetailsListBody.html('');
			
			
			clearForm("frmFormSms");
			strActionMode="ADD";
			glbControlEnable(true);		
			$('#frmFormSms').bootstrapValidator("resetForm",true); 
			$('#langFormTabs a:first').tab('show').trigger('click');
			//alert($('ul#langFormTabs li:first-child').html());
			// $('.nav-tabs a[href="#tabs-1"]').tab('show');
			$('ul#langFormTabs li').each(function(){
			   $(this).find('i').removeClass('fa-check').removeClass('fa-times');
			});

		});
		$("#btnSmsSave").click(function(){
			$("#frmFormSms").submit();
		});	
		$("#btnSmsBack").click(function (e) {
			e.stopPropagation();
			fullscreenModeChange('btnBack');
			$("#sms_form").addClass('hide');
			visibleControl('widGrid', true);
	
		});
		
		
		var message_type1=$("#frmForm").find("#message_type_id");
		var message_type2=$("#frmFormSms").find("#message_type_id");
		var message_type_array=[message_type1,message_type2];	
		populateOptionValuesBulk(message_type_array,"<?php echo $this->url('adminpanel/message-types', array('action'=>'getmessage'));?>","Select Message Type");
		
		var locale1=$("#frmForm").find("#locale_id");
		var locale2=$("#frmFormSms").find("#locale_id");
		var locale_array=[locale1,locale2];	
		populateOptionValuesBulk(locale_array,"<?php echo $this->url('adminpanel/locales', array('action'=>'getlocale'));?>","Select Locale");
		
		var message_template1=$("#frmForm").find("#message_template_id");
		var message_template2=$("#frmFormSms").find("#message_template_id");
		var message_template_array=[message_template1,message_template2];	
		populateOptionValuesBulk(message_template_array,"<?php echo $this->url('adminpanel/message-templates', array('action'=>'getmessagetemplates'));?>","Select Message Template");		
		
		var beneficiary1=$("#frmForm").find("#beneficiary_id");
		var beneficiary2=$("#frmFormSms").find("#beneficiary_id");
		var beneficiary_array=[beneficiary1,beneficiary2];	
		populateOptionValuesBulk(beneficiary_array,"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getbeneficiary'));?>","Select Beneficiary");
	});


</script>