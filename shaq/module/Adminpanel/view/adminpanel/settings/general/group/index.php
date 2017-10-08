<!-- RIBBON -->
<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Setting</li>
		<li>General Settings</li>
		<li>Groups</li>
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
		var gridGroupMemberData	=	[];
		var oTablegroupmember;
		function fetch_grid_data(objFormData)
		{
			hideShowLoader(true);
			$.ajax({
			  type: "POST",
			  url: "<?php echo $this->url('adminpanel/group', array('action'=>'list'));?>",
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
		
		function fetch_grid_data_group_member()
		{
			var beneficiary_group_id = $("#beneficiary_group_id").val()
			var objFormData =
			{
				beneficiary_group_id:beneficiary_group_id
			};
			hideShowLoader(true);
			$.ajax({
			  type: "POST",
			  url: "<?php echo $this->url('adminpanel/group', array('action'=>'listgroupmember'));?>",
			  data: objFormData,
			  dataType: "json",
			  success: function(data){
			  		hideShowLoader(false);
					gridGroupMemberData = data.aaData;
					$("#tblMasterGroupMemberList").find("tbody").html("");
					oTablegroupmember.clear().draw();
					oTablegroupmember.rows.add(gridGroupMemberData); // Add new data
					oTablegroupmember.columns.adjust().draw(); // Redraw the DataTable
					
			  }
			});
			
		}

		function savefrmFormData()  {
			 if(strActionMode=="ADD") {
			 	iActiveID = 0
			 }
			 					
			//Validate  duplicate
			var isDuplicate = fn_validate_duplicate($("#name").val(), 'beneficiary_group', "name", "<?php echo $this->url('adminpanel/group', array('action'=>'validateduplicate'));?>",iActiveID);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found. name is Already exists !', 0);
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
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/group', array('action'=>'save'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					strActionMode = "EDIT";
					hideShowLoader(false);							
					fullscreenModeChange('btnSave');
					mySmallAlert('Save Record', 'Groups Entry Saved successfully', 1);
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
		function savefrmFormGroupMemberData()  {
		
			 					
			//Validate  duplicate
			<?php /*?>var isDuplicate = fn_validate_duplicate($("#name").val(), 'beneficiary_group', "name", "<?php echo $this->url('adminpanel/group', array('action'=>'validateduplicate'));?>",iActiveID);
			if (isDuplicate) {
				mySmallAlert('Duplicate Error...!', 'Duplicate Found. name is Already exists !', 0);
				return false;
			}<?php */?>
			
			var $form = $('#frmFormGroupMember');
			var objMasterData = $form.serializeObject();
				$.extend(objMasterData, { MASTER_KEY_ID: 0});
			objMasterData = JSON.stringify(objMasterData);

			var objFormData =
			{
				FORM_DATA: objMasterData

			};
			hideShowLoader(true);
			var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/group', array('action'=>'savegroupmember'));?>", objFormData);
			if (objMyPost.ERR_NO === 0) {
				if (objMyPost.DATA.DBStatus === 'OK') {
					mySmallAlert('Save Record', 'Group Member Entry Saved successfully', 1);
					iActiveID = objMyPost.DATA.MY_ID;
					visibleControl('widGroupMemberGrid', true);
					var beneficiary_group_id = $("#beneficiary_group_id").val()
					var objFormData1 =
					{
						beneficiary_group_id:beneficiary_group_id
					};
					
					var beneficiary_id=$("#frmFormGroupMember").find("#beneficiary_id");
					var beneficiary_id_array=[beneficiary_id];
					populateDependentOptionValuesObjectBulk(beneficiary_id_array,"<?php echo $this->url('adminpanel/group', array('action'=>'getbeneficiary'));?>","Select Beneficiary",objFormData1);
					fetch_grid_data_group_member();
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
			var responsiveHelper_tblMasterGroupMemberList = undefined;			
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
                    {"bSearchable": false, "bSortable": false,
                        "mRender" : function (data, type, full) {
							return grid_buttons_group(full[0]);
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
			
			oTablegroupmember = $('#tblMasterGroupMemberList').DataTable({
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
					if (!responsiveHelper_tblMasterGroupMemberList) {
						responsiveHelper_tblMasterGroupMemberList = new ResponsiveDatatablesHelper($('#tblMasterGroupMemberList'), breakpointDefinition);
						
					}
				},				
				
				"rowCallback" : function(nRow) {
					responsiveHelper_tblMasterGroupMemberList.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					grid_tooltip();
					responsiveHelper_tblMasterGroupMemberList.respond();
				},	
				"aaData": gridGroupMemberData,
                "aoColumns": [
                    { "bSearchable": false, "bVisible": false },                  
                    null,
					null,
					null,
                    {"bSearchable": false, "bSortable": false,
                        "mRender" : function (data, type, full) {
							return grid_buttons_groupmember(full[0]);
							
                        }
                    }
                ],
			});			
			$("#tblMasterGroupMemberList thead th input[type=text]").on( 'keyup change', function () {	    	
				oTablegroupmember
					.column( $(this).parent().index()+':visible' )
					.search( this.value )
					.draw();	            
			} );
			$("#tblMasterGroupMemberList thead th select").on( 'change', function () {				
				var matchValue = this.value					    	    	
				oTablegroupmember
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
				name : {
					validators : {
						notEmpty : {
							message : 'Please enter name'						
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
		$('#frmFormGroupMember').bootstrapValidator({
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
                }
			}
		})
		.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();
			savefrmFormGroupMemberData();
		});
		
			
		fnBulkSave("<?php echo $this->url('adminpanel/group', array('action'=>'bulksave'));?>");
		fnExport("<?php echo $this->url('adminpanel/group', array('action'=>'exportcsv'));?>");
		fnImport("<?php echo $this->url('adminpanel/group', array('action'=>'importcsv'));?>");
		fnEdit("<?php echo $this->url('adminpanel/group', array('action'=>'getrec'));?>");
		fnView("<?php echo $this->url('adminpanel/group', array('action'=>'getrec'));?>");
		fnDelete("<?php echo $this->url('adminpanel/group', array('action'=>'delete'));?>"); 
		 
		fetch_grid_data();
		fnGroupMember("<?php echo $this->url('adminpanel/group', array('action'=>'getbeneficiary'));?>");
		fnGroupMemberDelete("<?php echo $this->url('adminpanel/group', array('action'=>'deletegroupmember'));?>");	
		fetch_grid_data_group_member();	
				
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
              <h4 class="modal-title" id="ns_name_popup"><strong>Import Message Type</strong></h4>
         </div>
		 <form action="" class="smart-form" enctype="multipart/form-data" name="importcsvform" id="importcsvform">
			<fieldset>
				<section>
					<label for="file" class="input input-file custombrowse" id="importFileLabel">
								<div class="button"><input type="file" name="importfile" id="importfile" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select Csv File" readonly="" name="import"id="import">
					</label>
					<div class="note note-error txt-color-red hide" id="importFileError">Please select csv file</div>
					<div class="note note-error">Please <a href="<?php echo $this->url('adminpanel/group', array('action'=>'downloadtemplate'));?>" target="_blank">download template </a>first (if you don't have download yet!)
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

</div>

<?php include($this->admin_layout_dir_path."global_include.php");?>
<script language="javascript">
	$("#btnBackGroupMember").click(function (e) {
        e.stopPropagation();
		fullscreenModeChange('btnBack');
        visibleControl("widGrid", true);
        visibleControl("widGroupMemberGrid", false);

    });
	$("#btnSaveGroupMember").click(function(){
		$("#frmFormGroupMember").submit();
	});
	function grid_buttons_groupmember(id)
	{
		var strAction = "";
		strAction += '<input type="hidden" name="gridHiddenIdArray[]" value="'+id+'" />';
		strAction += '<div class="btn-group" style="width:140px;" >';
		
		
			
			strAction += '<a href="#" title="Delete" rel="tooltip" data-placement="bottom" data-original-title ="Delete" class="btn btn-info fa fa-trash-o btn-sm delete_group" row-id="' + id + '" >';
			strAction += '</a>';
			
			
		strAction += '</div>';
	
		return strAction;
	
	}

	function fnGroupMemberDelete(strUrl)
	{
	
		$("#tblMasterGroupMemberList").delegate('a.delete_group', 'click', function (e) {
			e.preventDefault();
			intID=$(this).attr("row-id");
			var url = "pAction=DELETE&ID=" + intID;
			$.SmartMessageBox({
				title  : "Alert!",
				content: "Are you sure you want to delete?",
				buttons: '[Yes][No]'
			}, function (ButtonPressed) {
				if (ButtonPressed === "Yes") {
					var beneficiary_group_id=$("#beneficiary_group_id").val();
					var objFormData =
					{
						pAction: 'DELETE',
						KEY_ID : intID,
						beneficiary_group_id:beneficiary_group_id
					};
					hideShowLoader(true);
					var objMyPost = AJAX_Post(strUrl, objFormData);
					if (objMyPost.ERR_NO === 0) {
						if (objMyPost.DATA.DBStatus === 'OK') {   
							if(is_single == false) {
								fetch_grid_data_group_member();
							}
							else {
								reorderTable.ajax.reload( null, false );    		
							}
							var beneficiary_id=$("#frmFormGroupMember").find("#beneficiary_id");
							var beneficiary_id_array=[beneficiary_id];
							populateDependentOptionValuesObjectBulk(beneficiary_id_array,"<?php echo $this->url('adminpanel/group', array('action'=>'getbeneficiary'));?>","Select Beneficiary",objFormData);							
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


</script>