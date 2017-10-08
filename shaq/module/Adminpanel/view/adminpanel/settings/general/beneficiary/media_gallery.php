<div class="tab-pane" id="media_gallery">
<div class="tabs-main-heading">	
	<span class="tabs-title">Media Gallery Info </span>
	<button id="btnSaveMediaGallery" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Save
	</button>
	<button id="btnNextFromMediaGallery" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Next
	</button>
	</div>
	<div id="tabs">
		<ul class="nav nav-tabs" id="langFormIDMediaGallery">
			<li class="active">
				<a href="#gallery-tabs-<?php echo $this->global_locale_id; ?>" data-toggle="tab"><?php echo $this->globalLocalName;?>&nbsp;<i class="fa"></i></a>
			</li>
			<?php 
				foreach($this->activeLocalesArray as $locale)
				{
					if($locale['id'] == $this->global_locale_id)
						continue;
					?>
					<li>
						<a href="#gallery-tabs-<?php echo $locale['id']; ?>" data-toggle="tab"><?php echo $locale['name'];?>&nbsp;<i class="fa"></i></a>
					</li>
					<?php 
				}
			?>
		</ul>
		<section>

	 <form id="frmMediaGallery" name="frmMediaGallery">
		<input type="hidden" name="pathhidden" id="pathhidden" value="" /> 
		<div class="tab-content mt20">
			<div id="gallery-tabs-<?php echo $this->global_locale_id; ?>" class="tab-pane fade in active">
				<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Alias<span>*</span></label>
							<input type="text" class="form-control" name="alias_<?php echo $this->global_locale_id; ?>" id="alias_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>	
					<section class="col-md-4">			
						<div class="form-group">
							<label class="control-label">Media Type<span>*</span></label>
								<select class="select2" id="media_type_id" name="media_type_id" type="select">														
									<option value="0">Select Media Type</option>
								</select> 
						</div>
					</section>
					<section class="col-md-4">			
						<div class="form-group">
							<label class="control-label">Media File Type<span>*</span></label>
								<select class="select2" id="media_filetype_id" name="media_filetype_id" type="select">														
									<option value="0">Select Media File Type</option>
								</select> 
						</div>
					</section>
				</div>
				<div class="row">
					<section class="col-md-4">			
						<div class="form-group">
							<label class="control-label">Media Status<span>*</span></label>
								<select class="select2" id="media_status_id" name="media_status_id" type="select">														
									<option value="0">Select Media Status</option>
								</select> 
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label>&nbsp;</label>
							<label class="customwidth">
								<span class="onoffswitch">															
									<input name="published_gallery" class="onoffswitch-checkbox" id="published_gallery" type="checkbox"/>
									<label class="onoffswitch-label" for="published_gallery">
										<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
										<span class="onoffswitch-switch"></span>
									</label>
								</span>
									Published
							</label>
						</div>
					</section>
					<section class="col-md-4">			
						<div class="form-group">
							<label class="control-label">Beneficiary Profile Family<span>*</span></label>
								<select class="select2" id="beneficiary_profile_family_id" name="beneficiary_profile_family_id" type="select">														
									<option value="0">Select Beneficiary Profile Family</option>
								</select> 
						</div>
					</section>
					
					</div>
					<div class="row">
				</div>
				<div class="row">
					<section class="col-md-6">
						<label class="control-label">Media File<span>*</span></label>
						<div class="progress hide  progress-sm progress-striped active" style="height:40px;" id="customfileupload">
									<div class="progress-bar bg-color-darken"  role="progressbar" style="width:100%;line-height:21px;color:#FFFFFF;font-size:20px">Media Uploading</div>
						</div>	
						<div class="smart-form">
							  <label for="file" class="input input-file custombrowse">
								<div class="button"><input type="file" name="path" id="path" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Select File" readonly="" name="browseicon" id="browseicon">
							  </label>
						</div>
						 <div>
							<img id="display_path" name="display_path" height="80px" width="120px"  class="left hide"/>
						  </div>
					</section>
					<section class="col-md-6">
						<div class="form-group">
							<label class="control-label">Intro Text<span></span></label>
							<textarea type="text" class="description form-control" name="intro_text_<?php echo $this->global_locale_id; ?>" id="intro_text_<?php echo $this->global_locale_id; ?>"/></textarea>
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
					<div id="gallery-tabs-<?php echo $locale['id']; ?>" class="tab-pane fade">
						<div class="row">
							
							<section class="col-md-6">
								<div class="form-group">
									<label class="control-label">Alias<span>*</span></label>
									<input type="text" class="form-control" name="alias_<?php echo $locale['id']; ?>" id="alias_<?php echo $locale['id']; ?>"/>
								</div>
							</section>
							<section class="col-md-6">
								<div class="form-group">
									<label class="control-label">Intro Text<span></span></label>
									<textarea type="text" class="description form-control" name="intro_text_<?php echo $locale['id']; ?>" id="intro_text_<?php echo $locale['id']; ?>"></textarea>
								</div>
							</section>
						</div>
					</div>
					<?php 
				}
			?>
		</div>
	 </form>
	 <table id="tblMasterListMediaGallery" class="table table-striped table-bordered mt30" width="100%">	
	<thead>		
		<tr>
			<th>Id</th>
			<th data-class="expand">Media File</th>
			<th >Alias</th>
			<th data-hide="phone,tablet">Beneficiary</th>
			<th data-hide="phone,tablet">Beneficiary Profile Family</th>
			<th data-hide="phone,tablet">Mime Type</th>
			<th data-hide="phone,tablet">Media Status</th>
			<th data-hide="phone,tablet">Published</th>
			<th data-hide="phone" class="action">Action</th>
		</tr>
	</thead>							
	<tbody></tbody>							
</table>
		</section>
	</div>
	
	<div class="tabs-main-heading">	
		<span class="tabs-title">Media Youtube Gallery Info </span>
		<button id="btnSaveMediaYoutubeGallery" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Save
		</button>	
	</div>

	<div id="tabs">
		<ul class="nav nav-tabs" id="langFormIDMediaYoutubeGallery">
			<li class="active">
				<a href="#youtube-gallery-tabs-<?php echo $this->global_locale_id; ?>" data-toggle="tab"><?php echo $this->globalLocalName;?>&nbsp;<i class="fa"></i></a>
			</li>
			<?php 
				foreach($this->activeLocalesArray as $locale)
				{
					if($locale['id'] == $this->global_locale_id)
						continue;
					?>
					<li>
						<a href="#youtube-gallery-tabs-<?php echo $locale['id']; ?>" data-toggle="tab"><?php echo $locale['name'];?>&nbsp;<i class="fa"></i></a>
					</li>
					<?php 
				}
			?>
		</ul>
		<section>

	 <form id="frmMediaYoutubeGallery" name="frmMediaYoutubeGallery">
		<div class="tab-content mt20">
			<div id="youtube-gallery-tabs-<?php echo $this->global_locale_id; ?>" class="tab-pane fade in active">
				<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Alias<span>*</span></label>
							<input type="text" class="form-control" name="alias_<?php echo $this->global_locale_id; ?>" id="alias_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>	
					<section class="col-md-4">	
						<div class="form-group">
							<label class="control-label">Youtube Link<span>*</span></label>
							<input type="text" class="form-control" name="youtube_link" id="youtube_link"/>
						</div>
					</section>
					<section class="col-md-4">			
						<div class="form-group">
							<label class="control-label">Media Status<span>*</span></label>
								<select class="select2" id="media_status_id" name="media_status_id" type="select">														
									<option value="0">Select Media Status</option>
								</select> 
						</div>
					</section>
				</div>
				<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label>&nbsp;</label>
							<label class="customwidth">
								<span class="onoffswitch">															
									<input name="published_youtube" class="onoffswitch-checkbox" id="published_youtube" type="checkbox"/>
									<label class="onoffswitch-label" for="published_youtube">
										<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
										<span class="onoffswitch-switch"></span>
									</label>
								</span>
									Published
							</label>
						</div>
					</section>
					<section class="col-md-4">			
						<div class="form-group">
							<label class="control-label">Beneficiary Profile Family<span>*</span></label>
								<select class="select2" id="beneficiary_profile_family_id" name="beneficiary_profile_family_id" type="select">														
									<option value="0">Select Beneficiary Profile Family</option>
								</select> 
						</div>
					</section>	
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Intro Text<span></span></label>
							<textarea type="text" class="description form-control" name="intro_text_<?php echo $this->global_locale_id; ?>" id="intro_text_<?php echo $this->global_locale_id; ?>"/></textarea>
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
					<div id="youtube-gallery-tabs-<?php echo $locale['id']; ?>" class="tab-pane fade">
						<div class="row">
							
							<section class="col-md-6">
								<div class="form-group">
									<label class="control-label">Alias<span>*</span></label>
									<input type="text" class="form-control" name="alias_<?php echo $locale['id']; ?>" id="alias_<?php echo $locale['id']; ?>"/>
								</div>
							</section>
							<section class="col-md-6">
								<div class="form-group">
									<label class="control-label">Intro Text<span></span></label>
									<textarea type="text" class="description form-control" name="intro_text_<?php echo $locale['id']; ?>" id="intro_text_<?php echo $locale['id']; ?>"></textarea>
								</div>
							</section>
						</div>
					</div>
					<?php 
				}
			?>
		</div>
	 </form>
	 	 <table id="tblMasterListMediaYoutubeGallery" class="table table-striped table-bordered mt30" width="100%">	
			<thead>		
				<tr>
					<th>Id</th>
					<th data-class="expand">Alias</th>
					<th >Beneficiary</th>
					<th data-hide="phone,tablet">Beneficiary Profile Family</th>
					<th data-hide="phone,tablet">Youtube Link</th>
					<th data-hide="phone,tablet">Media Status</th>
					<th data-hide="phone,tablet">Published</th>
					<th data-hide="phone" class="action">Action</th>
				</tr>
			</thead>							
			<tbody></tbody>							
		</table>

		</section>
	</div>
	
</div>
<script language="javascript">
	var gridDataMediaGallery = [];
	var oTableMediaGallery;
	var strActionModeMediaGallery = 'ADD';
	var iActiveMediaGalleryID = 0;
	
	var gridDataMediaYoutubeGallery = [];
	var oTableMediaYoutubeGallery;
	var strActionModeMediaYoutubeGallery = 'ADD';
	var iActiveMediaYoutubeGalleryID = 0;
	
	function fetch_grid_data_mediaGallery()
	{
		resetFormLocales('frmMediaGallery','langFormIDMediaGallery');
		strActionModeMediaGallery = 'ADD';
		iActiveMediaGalleryID = 0;
		
		var objFormData = { 
			beneficiaryID : beneficiaryID,
		}
		$.ajax({
		  type: "POST",
		  url: "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'listMediaGallery'));?>",
		  data: objFormData,
		  dataType: "json",
		  success: function(data){
				gridDataMediaGallery = data.aaData;
				$("#tblMasterListMediaGallery").find("tbody").html("");
				oTableMediaGallery.clear().draw();
				oTableMediaGallery.rows.add(gridDataMediaGallery); // Add new data
				oTableMediaGallery.columns.adjust().draw(); // Redraw the DataTable
				
		  }
		});		
	}
	function mediaGalleryJsFunctions()
	{
		
		var responsiveHelper_tblMasterListMediaGallery = undefined;			
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		oTableMediaGallery = $('#tblMasterListMediaGallery').DataTable({
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
				if (!responsiveHelper_tblMasterListMediaGallery) {
					responsiveHelper_tblMasterListMediaGallery = new ResponsiveDatatablesHelper($('#tblMasterListMediaGallery'), breakpointDefinition);
					
				}
			},				
			"createdRow": function( nRow, data, dataIndex ) {
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_tblMasterListMediaGallery.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_tblMasterListMediaGallery.respond();
			},	
			"aaData": gridDataMediaGallery,
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
						return grid_switch(full[0],'published_gallery',full[7],'Yes');							
					}
				},
				{"bSearchable": false, "bSortable": false,
					"mRender" : function (data, type, full) {
						
							return detail_grid_buttons(full[0]);
						
					}
				}
			],
			"columnDefs": [
				{ className: "hidden", "targets": [ 0 ] },
				{ "type": "html-input", "targets": [7] }
			]	
		});		
		$("#tblMasterListMediaGallery").delegate('a.edit', 'click', function (e) {
			e.preventDefault();		
			strActionModeMediaGallery = 'EDIT';
			iActiveMediaGalleryID = $(this).attr("row-id");
			resetFormLocales('frmMediaGallery','langFormIDMediaGallery');
			$("#display_path").removeClass('hide');
			$("frmMediaGallery").show();
			populateEditEntriesDetail(iActiveMediaGalleryID,'frmMediaGallery',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getrecMediaGallery'));?>");
			$('ul#langFormIDMediaGallery li').each(function(){
			   $(this).find('i').removeClass('fa-check').removeClass('fa-times');
			});			
		});
		fnDeleteDetail('tblMasterListMediaGallery','media_gallery',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'deleteMediaGallery'));?>");
		
		$('#btnSaveMediaGallery').click(function(e){
			 e.preventDefault();
			 $("#frmMediaGallery").submit();			 			
		});
		$('#btnNextFromMediaGallery').click(function(e){
			 e.preventDefault();
			 callNextTab('media_gallery');			 			
		});
		
		$('#frmMediaGallery').bootstrapValidator({
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
				}
				
			}
		}) 
		.on('success.form.bv', function(e) {
			// Prevent form submission
			e.preventDefault();
			savefrmMediaGalleryData();
		});
		
		$('#frmMediaYoutubeGallery').bootstrapValidator({
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
				}
				
			}
		}) 
		.on('success.form.bv', function(e) {
			// Prevent form submission
			e.preventDefault();
			savefrmMediaYoutubeGalleryData();
		});
		mediaYoutubeGalleryJsFunctions();
		
		var media_type=$("#frmMediaGallery").find("#media_type_id");
		var media_type_array=[media_type];	
		populateOptionValuesBulk(media_type_array,"<?php echo $this->url('adminpanel/media-types', array('action'=>'getmediatype'));?>","Select Media Type");
		
		var media_filetype1=$("#frmMediaGallery").find("#media_filetype_id");
		var media_filetype_array=[media_filetype1];	
		populateOptionValuesBulk(media_filetype_array,"<?php echo $this->url('adminpanel/media-files-types', array('action'=>'getmediafiletype'));?>","Select Media File Type ");
		
		var media_status1=$("#frmMediaGallery").find("#media_status_id");
		var media_status2=$("#frmMediaYoutubeGallery").find("#media_status_id");
		var media_status_array=[media_status1,media_status2];	
		populateOptionValuesBulk(media_status_array,"<?php echo $this->url('adminpanel/media-statuses', array('action'=>'getmediastatus'));?>","Select Media Status ");	
		
	}	
	function savefrmMediaGalleryData()
	{		
		//Validate  duplicate
		/*var objFormData = {
			ssn : $("#frmMediaGallery").find("#ssn").val(),
		}
		var isDuplicate = fn_validate_duplicate_multiple('beneficiary_profile_family',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'validateduplicateDetail'));?>",iActiveMediaGalleryID,objFormData)
		if (isDuplicate) {
			mySmallAlert('Duplicate Error...!', 'Duplicate Found. SSN is Already exists !', 0);
			return false;
		}*/
				
		var $form = $('#frmMediaGallery');
		var objMasterData = $form.serializeObject();
		
		if (strActionModeMediaGallery == 'ADD')
			$.extend(objMasterData, { MASTER_KEY_ID: 0});
		else
			$.extend(objMasterData, { MASTER_KEY_ID: iActiveMediaGalleryID});
		
		objMasterData = JSON.stringify(objMasterData);

		var objFormData =
		{
			FORM_DATA: objMasterData,
			beneficiaryID : beneficiaryID,
			pAction : strActionModeMediaGallery
		};
		hideShowLoaderActive(true);
		var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'saveMediaGallery'));?>", objFormData);
		if (objMyPost.ERR_NO === 0) {
			if (objMyPost.DATA.DBStatus === 'OK') {
				//resetFormLocales('frmMediaGallery','langFormIDMediaGallery');
				strActionModeMediaGallery = 'ADD';
				iActiveMediaGalleryID = 0;
				fetch_grid_data_mediaGallery();
				hideShowLoaderActive(false);
			}
		}
		else {
			hideShowLoaderActive(false);
			mySmallAlert('Error...!', 'There was an error', 0);
		}
	}
	function fetch_grid_data_mediaYoutubeGallery()
	{
		resetFormLocales('frmMediaYoutubeGallery','langFormIDMediaYoutubeGallery');
		strActionModeMediaYoutubeGallery = 'ADD';
		iActiveMediaYoutubeGalleryID = 0;
		
		var objFormData = { 
			beneficiaryID : beneficiaryID,
		}
		$.ajax({
		  type: "POST",
		  url: "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'listMediaYoutubeGallery'));?>",
		  data: objFormData,
		  dataType: "json",
		  success: function(data){
				gridDataMediaYoutubeGallery = data.aaData;
				$("#tblMasterListMediaYoutubeGallery").find("tbody").html("");
				oTableMediaYoutubeGallery.clear().draw();
				oTableMediaYoutubeGallery.rows.add(gridDataMediaYoutubeGallery); // Add new data
				oTableMediaYoutubeGallery.columns.adjust().draw(); // Redraw the DataTable
				
		  }
		});		
	}
	function mediaYoutubeGalleryJsFunctions()
	{
		var responsiveHelper_tblMasterListMediaYoutubeGallery = undefined;			
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		oTableMediaYoutubeGallery = $('#tblMasterListMediaYoutubeGallery').DataTable({
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
				if (!responsiveHelper_tblMasterListMediaYoutubeGallery) {
					responsiveHelper_tblMasterListMediaYoutubeGallery = new ResponsiveDatatablesHelper($('#tblMasterListMediaYoutubeGallery'), breakpointDefinition);
					
				}
			},				
			"createdRow": function( nRow, data, dataIndex ) {
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_tblMasterListMediaYoutubeGallery.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_tblMasterListMediaYoutubeGallery.respond();
			},	
			"aaData": gridDataMediaYoutubeGallery,
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
						return detail_grid_buttons(full[0]);
					}
				}
			],
			"columnDefs": [
				{ className: "hidden", "targets": [ 0 ] },
				{ "type": "html-input", "targets": [6] }
			]	
		});	
		$('#btnSaveMediaYoutubeGallery').click(function(e){
			 e.preventDefault();
			 $("#frmMediaYoutubeGallery").submit();			 			
		});
		$("#tblMasterListMediaYoutubeGallery").delegate('a.edit', 'click', function (e) {
			e.preventDefault();		
			strActionModeMediaYoutubeGallery = 'EDIT';
			
			iActiveMediaYoutubeGalleryID = $(this).attr("row-id");
			resetFormLocales('frmMediaYoutubeGallery','langFormIDMediaYoutubeGallery');
			populateEditEntriesDetail(iActiveMediaYoutubeGalleryID,'frmMediaYoutubeGallery',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getrecMediaYoutubeGallery'));?>");
			$('ul#langFormIDMediaYoutubeGallery li').each(function(){
			   $(this).find('i').removeClass('fa-check').removeClass('fa-times');
			});			
		});
		fnDeleteDetail('tblMasterListMediaYoutubeGallery','media_youtube_gallery',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'deleteMediaYoutubeGallery'));?>");
		
		
		
	}	
	function savefrmMediaYoutubeGalleryData()
	{		
		//Validate  duplicate
		/*var objFormData = {
			ssn : $("#frmMediaYoutubeGallery").find("#ssn").val(),
		}
		var isDuplicate = fn_validate_duplicate_multiple('beneficiary_profile_family',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'validateduplicateDetail'));?>",iActiveMediaYoutubeGalleryID,objFormData)
		if (isDuplicate) {
			mySmallAlert('Duplicate Error...!', 'Duplicate Found. SSN is Already exists !', 0);
			return false;
		}*/
				
		var $form = $('#frmMediaYoutubeGallery');
		var objMasterData = $form.serializeObject();
		
		if (strActionModeMediaYoutubeGallery == 'ADD')
			$.extend(objMasterData, { MASTER_KEY_ID: 0});
		else
			$.extend(objMasterData, { MASTER_KEY_ID: iActiveMediaYoutubeGalleryID});
		
		objMasterData = JSON.stringify(objMasterData);

		var objFormData =
		{
			FORM_DATA: objMasterData,
			beneficiaryID : beneficiaryID,
			pAction : strActionModeMediaYoutubeGallery,
		};
		hideShowLoaderActive(true);
		var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'saveMediaYoutubeGallery'));?>", objFormData);
		if (objMyPost.ERR_NO === 0) {
			if (objMyPost.DATA.DBStatus === 'OK') {
				//resetFormLocales('frmMediaYoutubeGallery','langFormIDMediaYoutubeGallery');
				strActionModeMediaYoutubeGallery = 'ADD';
				iActiveMediaYoutubeGalleryID = 0;
				fetch_grid_data_mediaYoutubeGallery();
				hideShowLoaderActive(false);
			}
		}
		else {
			hideShowLoaderActive(false);
			mySmallAlert('Error...!', 'There was an error', 0);
		}
	}
	/**** media gallery upload **/
	 $('#frmMediaGallery').find("#path").change(function () {
		  if (this.files && this.files[0]) {
		  var reader = new FileReader();
		   // reader.onload = imageIsLoadedLogo;
			 reader.readAsDataURL(this.files[0]);
				
		   //Save img
		
		   var $form = $('#frmMediaGallery');
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
			$("#display_path").removeClass('hide');
			$("#display_path").attr("src", "<?php echo $this->public_dir_url; ?>uploads/localeicons/"+result.media);
			mySmallAlert('Media','successfully uploaded.', 1);
		}).fail(function (result) {
			alert("There was an error");
		   });
		  }
		
 });
</script>
