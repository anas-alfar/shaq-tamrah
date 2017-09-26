<div class="tab-pane" id="family_detail">
	<div class="tabs-main-heading">	
	<span class="tabs-title">Family Detail Info </span>
	<button id="btnSaveFamilyDetail" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Save
	</button>
	<button id="btnNextFromFamilyDetail" type="button" class="right btn btn-sm waves-effect btn-success tabSaveBtn">
		   <i class="fa fa-floppy-o"></i> &nbsp; Next
	</button>
	</div>

	<ul id="langFormIDFamilyDetail" class="nav nav-tabs">
	  <li class="active"><a data-toggle="tab" href="#fmly-tabs-<?php echo $this->global_locale_id; ?>"><?php echo $this->globalLocalName;?><i class="fa"></i></a></li>
	 
	<?php 
		foreach($this->activeLocalesArray as $locale)
		{
			if($locale['id'] == $this->global_locale_id)
				continue;
			?>
			<li>
				<a data-toggle="tab" href="#fmly-tabs-<?php echo $locale['id']; ?>"><?php echo $locale['name'];?>&nbsp;<i class="fa"></i></a>
			</li>
			<?php 
		}
	?>
	 
	</ul>
	
 <form id="frmFamilyDetail"  enctype="multipart/form-data" name="frmFamilyDetail">
 <input type="hidden" name="photohidden" id="photohidden" value="" /> 
	<div class="tab-content mt20">
	  <div id="fmly-tabs-<?php echo $this->global_locale_id; ?>" class="tab-pane fade in active">
				<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">First Name<span>*</span></label>
							<input type="text" class="form-control" name="first_name_<?php echo $this->global_locale_id; ?>" id="first_name_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Second Name<span>*</span></label>
							<input type="text" class="form-control" name="second_name_<?php echo $this->global_locale_id; ?>" id="second_name_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Third Name<span>*</span></label>
							<input type="text" class="form-control" name="third_name_<?php echo $this->global_locale_id; ?>" id="third_name_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>
				</div>
				<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Last Name<span>*</span></label>
							<input type="text" class="form-control" name="last_name_<?php echo $this->global_locale_id; ?>" id="last_name_<?php echo $this->global_locale_id; ?>"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Ssn<span>*</span></label>
							<input type="text" class="form-control" name="ssn" id="ssn"/>
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Phone Number<span>*</span></label>
							<input type="text" class="form-control" name="phone_number" id="phone_number"/>
						</div>
					</section>
				</div>
				<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Mobile Number<span>*</span></label>
								<input type="text" class="form-control" name="mobile_number" id="mobile_number"/>
						</div>	
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Email<span>*</span></label>
								<input type="text" class="form-control" name="email" id="email"/>
						</div>	
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Nationality<span>*</span></label>
								<select class="select2" id="nationality_id" name="nationality_id" type="select">														
									<option value="0">Select Nationality</option>
								</select> 
						</div>
					</section>
				</div>
				<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Country<span>*</span></label>
								<select class="select2" id="country_id" name="country_id" type="select">														
									<option value="0">Select Country</option>
								</select> 
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">City<span>*</span></label>
								<select class="select2" id="city_id" name="city_id" type="select">														
									<option value="0">Select City</option>
								</select> 
						</div>
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Date of Birth<span></span></label>
								<input type="text" class="form-control" name="date_of_birth" id="date_of_birth"/>
						</div>	
					</section>
				</div>
				<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Beneficiary Relation<span>*</span></label>
								<select class="select2" id="beneficiary_relation_id" name="beneficiary_relation_id" type="select">														
									<option value="0">Select Beneficiary Relation</option>
								</select> 
						</div>	
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Marital Status<span>*</span></label>
								<select class="select2" id="marital_status_id" name="marital_status_id" type="select">														
									<option value="0">Select Marital Status</option>
								</select> 
						</div>	
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Education Level<span>*</span></label>
								<select class="select2" id="education_level_id" name="education_level_id" type="select">														
									<option value="0">Select Education Level</option>
								</select> 
						</div>	
					</section>
				</div>
				<div class="row">
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Medical Condition<span>*</span></label>
								<select class="select2" id="medical_condition_id" name="medical_condition_id" type="select">														
									<option value="0">Select Medical Condition</option>
								</select> 
						</div>	
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Beneficiary Profile Family Profession<span>*</span></label>
								<select class="select2" id="beneficiary_profile_family_profession_id" name="beneficiary_profile_family_profession_id" type="select">														
									<option value="0">Select Beneficiary Profile Family Profession</option>
								</select> 
						</div>	
					</section>
					<section class="col-md-4">
						<div class="form-group">
							<label class="control-label">Death Date<span></span></label>
								<input type="text" class="form-control" name="death_date" id="death_date"/>
						</div>
					</section>
				</div>
				<div class="row">
					<section class="col-md-6">
							<label class="control-label">Avatar</label>
							<div class="progress hide  progress-sm progress-striped active" style="height:40px;" id="customfileupload">
								<div class="progress-bar bg-color-darken"  role="progressbar" style="width:100%;line-height:21px;color:#FFFFFF;font-size:20px">Avatar Uploading</div>
							</div>
							  <div class="smart-form">
							  	<div class="input input-file">
									<span class="button"><input type="file" id="avatar" name="avatar" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly="">
								</div>
							  </div>
							  <div>
								<img id="display_img" name="display_img" height="80px" width="120px"  class="left " style="margin-top:5px;"/>
							  </div>
						
					</section>
					<section class="col-md-6">
					
						<div class="form-group">
							<label class="control-label">Address<span></span></label>
							<textarea type="text" id="address_<?php echo $this->global_locale_id; ?>" name="address_<?php echo $this->global_locale_id; ?>" class="description form-control"  ></textarea>
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
				<div id="fmly-tabs-<?php echo $locale['id']; ?>" class="tab-pane fade">
					<div class="row">
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">First Name<span>*</span></label>
						<input type="text" class="form-control" name="first_name_<?php echo $locale['id']; ?>" id="first_name_<?php echo $locale['id']; ?>"/>
					</div>
				</section>
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Second Name<span>*</span></label>
						<input type="text" class="form-control" name="second_name_<?php echo $locale['id']; ?>" id="second_name_<?php echo $locale['id']; ?>"/>
					</div>
				</section>
				<section class="col-md-4">
					<div class="form-group">
						<label class="control-label">Third Name<span>*</span></label>
						<input type="text" class="form-control" name="third_name_<?php echo $locale['id']; ?>" id="third_name_<?php echo $locale['id']; ?>"/>
					</div>
				</section>
			</div>
			<div class="row">
				<section class="col-md-6">
					<div class="form-group">
						<label class="control-label">Last Name<span>*</span></label>
						<input type="text" class="form-control" name="last_name_<?php echo $locale['id']; ?>" id="last_name_<?php echo $locale['id']; ?>"/>
					</div>
				</section>
				
				<section class="col-md-6">
					<div class="form-group">
						<label class="control-label">Address<span></span></label>
						<textarea type="text" id="address_<?php echo $locale['id']; ?>" name="address_<?php echo $locale['id']; ?>" class="description form-control"  ></textarea>
					</div>
				</section>
				
			</div>
				</div>
				<?php 
			}
		?>
	</div>															
</form>

<table id="tblMasterListFamilyDetail" class="table table-striped table-bordered mt30" width="100%">	
	<thead>		
		<tr>
			<th>Id</th>
			<th data-class="expand">Avatar</th>
			<th data-hide="phone,tablet">First Name</th>
			<th data-hide="phone,tablet">Second Name</th>
			<th data-hide="phone,tablet">Mobile Number</th>
			<th data-hide="phone,tablet">Email</th>
			<th data-hide="phone" class="action">Action</th>
		</tr>
	</thead>							
	<tbody></tbody>							
</table>
 
</div>
<script language="javascript">
	var gridDataFamilyDetail = [];
	var oTableFamilyDetail;
	var strActionModeFamilyDetail = 'ADD';
	var iActiveFamilyDetailID = 0;
	function fetch_grid_data_familyDetail()
	{
		resetFormLocales('frmFamilyDetail','langFormIDFamilyDetail');
		strActionModeFamilyDetail = 'ADD';
		iActiveFamilyDetailID = 0;
		
		var objFormData = { 
			beneficiaryID : beneficiaryID,
		}
		$.ajax({
		  type: "POST",
		  url: "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'listFamilyDetail'));?>",
		  data: objFormData,
		  dataType: "json",
		  success: function(data){
				gridDataFamilyDetail = data.aaData;
				$("#tblMasterListFamilyDetail").find("tbody").html("");
				oTableFamilyDetail.clear().draw();
				oTableFamilyDetail.rows.add(gridDataFamilyDetail); // Add new data
				oTableFamilyDetail.columns.adjust().draw(); // Redraw the DataTable
				
		  }
		});		
	}
	function familyDetailJsFunctions()
	{
		var responsiveHelper_tblMasterListFamilyDetail = undefined;			
		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};
		oTableFamilyDetail = $('#tblMasterListFamilyDetail').DataTable({
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
				if (!responsiveHelper_tblMasterListFamilyDetail) {
					responsiveHelper_tblMasterListFamilyDetail = new ResponsiveDatatablesHelper($('#tblMasterListFamilyDetail'), breakpointDefinition);
					
				}
			},				
			"createdRow": function( nRow, data, dataIndex ) {
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_tblMasterListFamilyDetail.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_tblMasterListFamilyDetail.respond();
			},	
			"aaData": gridDataFamilyDetail,
			"aoColumns": [
				{ "bSearchable": false, "bVisible": false },                  
				null,
				null,
				null,
				null,
				null,
				{"bSearchable": false, "bSortable": false,
					"mRender" : function (data, type, full) {
						return detail_grid_buttons(full[0]);
					}
				}
			],
			"columnDefs": [
				{ className: "hidden", "targets": [ 0 ] }
			]	
		});	
		$("#tblMasterListFamilyDetail").delegate('a.edit', 'click', function (e) {
			e.preventDefault();		
			strActionModeFamilyDetail = 'EDIT';
			iActiveFamilyDetailID = $(this).attr("row-id");
			resetFormLocales('frmFamilyDetail','langFormIDFamilyDetail');
			populateEditEntriesDetail(iActiveFamilyDetailID,'frmFamilyDetail',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'getrecFamilyDetail'));?>");
			$('ul#langFormIDFamilyDetail li').each(function(){
			   $(this).find('i').removeClass('fa-check').removeClass('fa-times');
			});			
		});
		fnDeleteDetail('tblMasterListFamilyDetail','family_detail',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'deleteFamilyDetail'));?>");
		
		$('#btnSaveFamilyDetail').click(function(e){
			 e.preventDefault();
			 $("#frmFamilyDetail").submit();			 			
		});
		$('#btnNextFromFamilyDetail').click(function(e){
			 e.preventDefault();
			 populateFamilyDP();
			 callNextTab('family_detail');			 			
		});
		
		$('#frmFamilyDetail').bootstrapValidator({
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
						first_name_<?php echo $locale['id']?> : {
							validators : {
								notEmpty : {
									message : 'Please enter first name'						
								}
							}
						},
						second_name_<?php echo $locale['id']?> : {
							validators: {
							   notEmpty : {
									message : 'Please enter second name'
								}
							}
						},
						third_name_<?php echo $locale['id']?> : {
							validators: {
							   notEmpty : {
									message : 'Please enter third name'
								}
							}
						},
						last_name_<?php echo $locale['id']?> : {
							validators: {
							   notEmpty : {
									message : 'Please enter last name'
								}
							}
						},
						<?php 
					} 
				?>
				ssn: {
					validators: {
					   notEmpty : {
							message : 'Please enter ssn'
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
				email : {
					validators : {
						notEmpty : {
							message : 'Please enter email'						
						},
						emailAddress: {
							message : 'Please enter valide email'						
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
				beneficiary_relation_id: {
                    validators: {
                       callback: {
                            message: 'Please select beneficiary relation',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				marital_status_id: {
                    validators: {
                       callback: {
                            message: 'Please select marital status',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				education_level_id: {
                    validators: {
                       callback: {
                            message: 'Please select education level',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				medical_condition_id: {
                    validators: {
                       callback: {
                            message: 'Please select medical condition',
                            callback: function (value, validator, $field) {
                               return (value != 0 && value != null && value != '');
                            }
                        }
                    }
                },
				beneficiary_profile_family_profession_id: {
                    validators: {
                       callback: {
                            message: 'Please select beneficiary profile family profession ',
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
			savefrmFamilyDetailData();
		});
		
		var family_country=$("#frmFamilyDetail").find("#country_id");
		family_country.change(function()
		{
			var country_id =$(this).val();
			if(country_id > 0)
			{
				var objFormData = {
						country_id    : country_id
				}
				populateDependentOptionValues("beneficiary_relation_id","<?php echo $this->url('adminpanel/beneficiary-relations', array('action'=>'getrelation'));?>","Select Beneficiary Relation",objFormData);
				populateDependentOptionValues("city_id","<?php echo $this->url('adminpanel/cities', array('action'=>'getcity'));?>","Select City",objFormData);
				populateDependentOptionValues("marital_status_id","<?php echo $this->url('adminpanel/marital-statuses', array('action'=>'getmaritalstatuspublished'));?>","Select Marital Status",objFormData);
				populateDependentOptionValues("education_level_id","<?php echo $this->url('adminpanel/education-levels', array('action'=>'geteducationlevelpublished'));?>","Select Education Level",objFormData);
				populateDependentOptionValues("medical_condition_id","<?php echo $this->url('adminpanel/medical-conditions', array('action'=>'getmedicalconditionpublished'));?>","Select Medical Condition",objFormData);
				populateDependentOptionValues("beneficiary_profile_family_profession_id","<?php echo $this->url('adminpanel/family-professions', array('action'=>'getfamilyprofessionspublished'));?>","Select Beneficiary Profile Family Profession",objFormData);
			}
		});	
		
		$("#death_date").datepicker();
		$("#date_of_birth").datepicker();

	}	
	function savefrmFamilyDetailData()
	{		
		//Validate  duplicate
		var objFormData = {
			ssn : $("#frmFamilyDetail").find("#ssn").val(),
		}
		var isDuplicate = fn_validate_duplicate_multiple('beneficiary_profile_family',"<?php echo $this->url('adminpanel/beneficiary', array('action'=>'validateduplicateDetail'));?>",iActiveFamilyDetailID,objFormData)
		if (isDuplicate) {
			mySmallAlert('Duplicate Error...!', 'Duplicate Found. SSN is Already exists !', 0);
			return false;
		}
				
		var $form = $('#frmFamilyDetail');
		var objMasterData = $form.serializeObject();
		
		if (strActionModeFamilyDetail == 'ADD')
			$.extend(objMasterData, { MASTER_KEY_ID: 0});
		else
			$.extend(objMasterData, { MASTER_KEY_ID: iActiveFamilyDetailID});
		
		objMasterData = JSON.stringify(objMasterData);

		var objFormData =
		{
			FORM_DATA: objMasterData,
			beneficiaryID : beneficiaryID,
			pAction : strActionModeFamilyDetail,
		};
		hideShowLoaderActive(true);
		var objMyPost = AJAX_Post("<?php echo $this->url('adminpanel/beneficiary', array('action'=>'saveFamilyDetail'));?>", objFormData);
		if (objMyPost.ERR_NO === 0) {
			if (objMyPost.DATA.DBStatus === 'OK') {
				//resetFormLocales('frmFamilyDetail','langFormIDFamilyDetail');
				strActionModeFamilyDetail = 'ADD';
				iActiveFamilyDetailID = 0;
				fetch_grid_data_familyDetail();
				hideShowLoaderActive(false);
			}
		}
		else {
			hideShowLoaderActive(false);
			mySmallAlert('Error...!', 'There was an error', 0);
		}
	}
  $("#avatar").change(function () {
  if (this.files && this.files[0]) {
  var reader = new FileReader();
   // reader.onload = imageIsLoadedLogo;
     reader.readAsDataURL(this.files[0]);
	  	
   //Save img

   var $form = $('#frmFamilyDetail');
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

    url: "<?php echo $this->url('adminpanel/beneficiary', array('action'=>'uploadavatar'));?>",
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
	$("#btnSaveFamilyDetail").addClass('hide');
	
   deferred.done(function (result) {
   
	$("#photohidden").val(result.avatar);
	$("#customfileupload").addClass('hide');
	$("#btnSaveFamilyDetail").removeClass('hide');
	$("#display_img").removeClass('hide');
	$("#display_img").attr("src", "<?php echo $this->public_dir_url; ?>uploads/localeicons/"+result.avatar);
   	mySmallAlert('Avatar','successfully uploaded.', 1);
}).fail(function (result) {
    alert("There was an error");
   });
  }

 });
</script>
