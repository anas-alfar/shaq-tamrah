function hideShowLoader(action)
{
	/*if(action) {
		$(".body_overlay_dark").removeClass('hide');	
		$(".common_loader").removeClass('hide');	}
	else {
		$(".body_overlay_dark").addClass('hide');	
		$(".common_loader").addClass('hide');		}*/
}
function hideShowLoaderActive(action)
{
	if(action) {
		$(".body_overlay_dark").removeClass('hide');	
		$(".common_loader").removeClass('hide');	}
	else {
		$(".body_overlay_dark").addClass('hide');	
		$(".common_loader").addClass('hide');		}
}
function fullscreenModeChange(objId)
{
	$('#'+objId).parent().parent().find('.fa-compress').parent('a').trigger('click');
}
function visibleControl(IDofObject, flag) {
    var item = $('#' + IDofObject);
    if (flag) {
        item.removeClass("hide");
        item.addClass("show");
    }
    else {
        item.removeClass("show");
        item.addClass("hide");
    }
}

//My Small Alert
function mySmallAlert(sTitle, sText, sSuccess) {


    var iColor = '#296191';
    var sIcon = 'fa fa-save swing animated';
    if (sSuccess == 0) {
        sIcon = 'fa fa-times swing animated';
        iColor = '#C46A69';
    }
    else if (sSuccess == 1) {
        sIcon = 'fa fa-save swing animated';
        iColor = '#739E73';
    }
    else if (sSuccess == 2) {
        sIcon = 'fa fa-warning swing animated';
        iColor = '#C79121';
    }
    else if (sSuccess == 3) {
        sIcon = 'fa fa-info-circle swing animated';
        iColor = '#296191';
    }
    $.smallBox({
        title  : '<h1>' + sTitle + '</h1>',
        content: sText,
        color  : iColor,
        timeout: 4000,
        icon   : sIcon
    });
}

$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function AJAX_Post(sURL, sData) {
    var sArray = [];
    var iError = 0;
    var strError = "";
    $.ajax({
        type      : "POST",
        url       : sURL,
        dataType  : 'json',
        async     : false,
        data      : sData,
        beforeSend: function () {
        },
        success   : function (result) {
            sArray = result;
            iError = 0;
        },
        error     : function (xhr, status, error) {
            iError = 1;
            strError = xhr.responseText;
        }
    });
    return ({ERR_NO: iError, DATA: sArray, ERR_TEXT: strError});
}

function AJAX_Post_Image(sURL, sData) {
    var sArray = [];
    var iError = 0;
    var strError = "";
    var deferred;
    deferred= $.ajax({
        type      : "POST",
        url       : sURL,
        dataType  : 'json',
        processData: false,
        contentType: false,
        data      : sData,
        beforeSend: function () {
        },
        success   : function (result) {
            sArray = result;
            iError = 0;
        },
        error     : function (xhr, status, error) {
            iError = 1;
            strError = xhr.responseText;
        }
    });

    return ({ERR_NO: iError, DATA:sArray, ERR_TEXT: strError});

}

function AJAX_Get(sURL) {
    var sArray = [];
    var iError = 0;
    var strError = "";
    var asSync = false;

    $.ajax({
        type      : "GET",
        url       : sURL,
        dataType  : 'json',
        async     : asSync,
        beforeSend: function () {
        },
        success   : function (result) {
            sArray = result;
            iError = 0;
        },
        error     : function (xhr, status, error) {
            iError = 1;
            strError = xhr.responseText;
        }
    });
    return ({ERR_NO: iError, DATA: sArray, ERR_TEXT: strError});
}
//----------------------------- Action Buttons -----------------------------------------------------------------------
function grid_buttons(id)
{
    var strAction = "";
	strAction += '<input type="hidden" name="gridHiddenIdArray[]" value="'+id+'" />';
    strAction += '<div class="btn-group" style="width:140px;" >';
   		if(acl_VIEW == 1) {
			strAction += '<a href="#" title="View" rel="tooltip" data-placement="bottom" data-original-title ="View" class="btn btn-primary fa fa-eye btn-sm view" row-id="' + id + '">';
			strAction += '</a>';
		}
			strAction += '<a href="#" title="Edit" rel="tooltip" data-placement="bottom" data-original-title ="Edit" class="btn btn-success fa fa-pencil-square-o btn-sm edit" row-id="' + id + '">';
			strAction += '</a>';
			
			strAction += '<a href="#" title="Delete" rel="tooltip" data-placement="bottom" data-original-title ="Delete" class="btn btn-info fa fa-trash-o btn-sm delete" row-id="' + id + '" >';
			strAction += '</a>';
		
    strAction += '</div>';

    return strAction;

}

function grid_buttons_gallery(id,published)
{
    var strAction = "";
	strAction += '<input type="hidden" name="gridHiddenIdArray[]" value="'+id+'" />';
    strAction += '<div class="btn-group" style="width:140px;" >';
   		if(acl_VIEW == 1) {
			strAction += '<a href="#" title="View" rel="tooltip" data-placement="bottom" data-original-title ="View" class="btn btn-primary fa fa-eye btn-sm view" row-id="' + id + '">';
			strAction += '</a>';
		}
    
        strAction += '<a href="#" title="Edit" rel="tooltip" data-placement="bottom" data-original-title ="Edit" class="btn btn-success fa fa-pencil-square-o btn-sm edit" row-id="' + id + '">';
        strAction += '</a>';
    
        strAction += '<a href="#" title="Delete" rel="tooltip" data-placement="bottom" data-original-title ="Delete" class="btn btn-info fa fa-trash-o btn-sm delete" row-id="' + id + '" >';
        strAction += '</a>';
	  if(published == 'No') {
		strAction += '<a href="#" title="Published" rel="tooltip" data-placement="bottom" data-original-title ="Published" class="btn btn-warning fa fa-calendar btn-sm published" row-id="' + id + '" >';
        strAction += '</a>';
	  }
    strAction += '</div>';

    return strAction;

}
function grid_viewedit_buttons(id)
{
    var strAction = "";
	strAction += '<input type="hidden" name="gridHiddenIdArray[]" value="'+id+'" />';
    strAction += '<div class="btn-group" style="width:140px;" >';
   		if(acl_VIEW == 1) {
			strAction += '<a href="#" title="View" rel="tooltip" data-placement="bottom" data-original-title ="View" class="btn btn-primary fa fa-eye btn-sm view" row-id="' + id + '">';
			strAction += '</a>';
		}
    
        strAction += '<a href="#" title="Edit" rel="tooltip" data-placement="bottom" data-original-title ="Edit" class="btn btn-success fa fa-pencil-square-o btn-sm edit" row-id="' + id + '">';
        strAction += '</a>';
    strAction += '</div>';

    return strAction;

}
function grid_buttons_donation(id)
{
    var strAction = "";
	strAction += '<input type="hidden" name="gridHiddenIdArray[]" value="'+id+'" />';
    strAction += '<div class="btn-group" style="width:140px;" >';
   		if(acl_VIEW == 1) {
			strAction += '<a href="#" title="View" rel="tooltip" data-placement="bottom" data-original-title ="View" class="btn btn-primary fa fa-eye btn-sm view" row-id="' + id + '">';
			strAction += '</a>';
		}
    
        /*strAction += '<a href="#" title="Edit" rel="tooltip" data-placement="bottom" data-original-title ="Edit" class="btn btn-success fa fa-pencil-square-o btn-sm edit" row-id="' + id + '">';
        strAction += '</a>';*/
    
        strAction += '<a href="#" title="Delete" rel="tooltip" data-placement="bottom" data-original-title ="Delete" class="btn btn-info fa fa-trash-o btn-sm delete" row-id="' + id + '" >';
        strAction += '</a>';
    
    strAction += '</div>';

    return strAction;

}

function grid_buttons_group(id)
{
    var strAction = "";
	strAction += '<input type="hidden" name="gridHiddenIdArray[]" value="'+id+'" />';
    strAction += '<div class="btn-group" style="width:140px;" >';
   		if(acl_VIEW == 1) {
			strAction += '<a href="#" title="View" rel="tooltip" data-placement="bottom" data-original-title ="View" class="btn btn-primary fa fa-eye btn-sm view" row-id="' + id + '">';
			strAction += '</a>';
		}
    
        strAction += '<a href="#" title="Edit" rel="tooltip" data-placement="bottom" data-original-title ="Edit" class="btn btn-success fa fa-pencil-square-o btn-sm edit" row-id="' + id + '">';
        strAction += '</a>';
		
		strAction += '<a href="#" title="View Group" rel="tooltip" data-placement="bottom" data-original-title ="View Group" class="btn btn-warning fa fa-users btn-sm view_group" row-id="' + id + '">';
        strAction += '</a>';
		
    strAction += '</div>';

    return strAction;

}
function grid_buttons_beneficiary(id,name)
{
    var strAction = "";
	strAction += '<input type="hidden" name="gridHiddenIdArray[]" value="'+id+'" />';
    strAction += '<div class="btn-group" style="width:279px;" >';
   		if(acl_VIEW == 1) {
			strAction += '<a href="#" title="View" rel="tooltip" data-placement="bottom" data-original-title ="View" class="btn btn-primary fa fa-eye btn-sm viewbeneficiary" row-id="' + id + '">';
			strAction += '</a>';
		}
    
        strAction += '<a href="#" title="Edit" rel="tooltip" data-placement="bottom" data-original-title ="Edit" class="btn btn-success fa fa-pencil-square-o btn-sm edit" row-id="' + id + '">';
        strAction += '</a>';
    
        strAction += '<a href="#" title="Delete" rel="tooltip" data-placement="bottom" data-original-title ="Delete" class="btn btn-info fa fa-trash-o btn-sm delete" row-id="' + id + '" >';
        strAction += '</a>';
		
		 strAction += '<a href="#" title="New Donation" rel="tooltip" data-placement="bottom" data-original-title ="New Donation" class="btn btn-warning fa fa-gift btn-sm newdonation" row-id="' + id + '" row-name="' + name + '" >';
        strAction += '</a>';
		
		strAction += '<a href="#" title="Sponsorship" rel="tooltip" data-placement="bottom" data-original-title ="Sponsorship" class="btn btn-danger fa fa-thumbs-o-up btn-sm sponsorship" row-id="' + id + '" row-name="' + name + '">';
        strAction += '</a>';
		
		strAction += '<a href="#" title="Manage Groups" rel="tooltip" data-placement="bottom" data-original-title ="Manage Groups" class="btn btn-primary fa fa-users btn-sm manage_groups" row-id="' + id + '" row-name="' + name + '">';
        strAction += '</a>';
		
		strAction += '<a href="#" title="Manage Assets" rel="tooltip" data-placement="bottom" data-original-title ="Manage Assets" class="btn btn-success fa fa-font btn-sm manage_asset" row-id="' + id + '" row-name="' + name + '">';
        strAction += '</a>';
		
		strAction += '<a href="#" title="Change Organization" rel="tooltip" data-placement="bottom" data-original-title ="Change Organization" class="btn btn-warning fa fa-sitemap btn-sm change_organization" row-id="' + id + '" row-name="' + name + '">';
        strAction += '</a>';
    strAction += '</div>';
    return strAction;

}
function detail_grid_buttons(id)
{
    var strAction = "";
    strAction += '<div class="btn-group" style="width:140px;" >';
    
        strAction += '<a href="#" title="Edit" rel="tooltip" data-placement="bottom" data-original-title ="Edit" class="btn btn-success fa fa-pencil-square-o btn-sm edit" row-id="' + id + '">';
        strAction += '</a>';
    
        strAction += '<a href="#" title="Delete" rel="tooltip" data-placement="bottom" data-original-title ="Delete" class="btn btn-info fa fa-trash-o btn-sm delete" row-id="' + id + '" >';
        strAction += '</a>';
    
    strAction += '</div>';

    return strAction;

}
function grid_buttons_popup(id,name,type)
{
    var strAction = "";
	strAction += '<input type="hidden" name="gridHiddenIdArray[]" value="'+id+'" />';
    strAction += '<div class="btn-group" style="width:140px;" >';
   		if(acl_VIEW == 1) {
			strAction += '<a href="#" title="View" rel="tooltip" data-placement="bottom" data-original-title ="View" class="btn btn-primary fa fa-eye btn-sm view" row-id="' + id + '">';
			strAction += '</a>';
		}
    
        strAction += '<a href="#" title="Edit" rel="tooltip" data-placement="bottom" data-original-title ="Edit"  class="btn btn-success fa fa-pencil-square-o btn-sm edit" row-id="' + id + '">';
        strAction += '</a>';
    
        strAction += '<a href="#" title="Delete" rel="tooltip" data-placement="bottom" data-original-title ="Delete" class="btn btn-info fa fa-trash-o btn-sm delete" row-id="' + id + '" >';
        strAction += '</a>';
		
		strAction += '<a href="#" title="Popup" rel="tooltip" data-placement="bottom" data-original-title ="Popup" class="btn btn-warning fa fa-plus btn-sm popup" row-id="' + id +  '" row-name="' + name +  '" row-type-id="' + type +  '">';
        strAction += '</a>';
    
    strAction += '</div>';

    return strAction;

}
function grid_buttons_plus(id)
{
    var strAction = "";
	strAction += '<input type="hidden" name="gridHiddenIdArray[]" value="'+id+'" />';
    strAction += '<div class="btn-group" style="width:100px;" >';
    
        strAction += '<a href="#" title="Plus" rel="tooltip" data-placement="bottom" data-original-title ="Delete" class="btn btn-warning fa fa-plus btn-sm plus" row-id="' + id + '" >';
        strAction += '</a>';
    
    strAction += '</div>';

    return strAction;

}


function grid_buttons_new(id,name)
{
    var strAction = "";
	strAction += '<input type="hidden" name="gridHiddenIdArray[]" value="'+id+'" />';
    strAction += '<div class="btn-group" style="width:140px;" >';
   		if(acl_VIEW == 1) {
			strAction += '<a href="#" title="View" rel="tooltip" data-placement="bottom" data-original-title ="View" class="btn btn-primary fa fa-eye btn-sm view" row-id="' + id + '">';
			strAction += '</a>';
		}
    
        strAction += '<a href="#" title="Edit" rel="tooltip" data-placement="bottom" data-original-title ="Edit"  class="btn btn-success fa fa-pencil-square-o btn-sm edit" row-id="' + id + '">';
        strAction += '</a>';
    
        strAction += '<a href="#" title="Delete" rel="tooltip" data-placement="bottom" data-original-title ="Delete"  class="btn btn-info fa fa-trash-o btn-sm delete" row-id="' + id + '" >';
        strAction += '</a>';
		
		strAction += '<a href="#" title="New" rel="tooltip" data-placement="bottom" data-original-title ="New"  class="btn btn-warning fa fa-plus btn-sm new" row-id="' + id +  '" row-name="' + name +  '" >';
        strAction += '</a>';
    
    strAction += '</div>';

    return strAction;

}

function grid_tooltip()
{
	
	if ($("[rel=tooltip]").length) 
	{
		$("[rel=tooltip]").tooltip();
	}
	
}


/// ------------------- grid switch -----------------------
function grid_switch(id,fieldName,fieldValue,MatchValue)
{
	var checked = '';
	if(fieldValue == MatchValue)
		checked = 'checked="checked"';
	var returnString = '<!--'+fieldValue+'-->';
	returnString += '<span class="onoffswitch"><input name="'+fieldName+id+'" class="onoffswitch-checkbox" id="'+fieldName+id+'" '+checked+' type="checkbox"><label class="onoffswitch-label" for="'+fieldName+id+'"><span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> <span class="onoffswitch-switch"></span></label></span>';							
	return returnString;
}
function grid_switch_active(id,fieldName,fieldValue,MatchValue)
{
	var checked = '';
	if(fieldValue == MatchValue)
		checked = 'checked="checked"';
	var returnString = '<!--'+fieldValue+'-->';
	returnString += '<span class="onoffswitch"><input name="'+fieldName+id+'" class="onoffswitch-checkbox" id="'+fieldName+id+'" '+checked+' type="checkbox"><label class="onoffswitch-label" for="'+fieldName+id+'"><span class="onoffswitch-inner" data-swchon-text="Active" data-swchoff-text="Inactive"></span> <span class="onoffswitch-switch"></span></label></span>';							
	return returnString;
}
function hiddenIdArray(id)
{
	var returnString = '<input type="hidden" name="gridHiddenIdArray[]" value="'+id+'" />';
	return returnString;
}
//-------------------------- Clear the Form ----------------------------------------------------------------------------
function clearForm(frmName) {
    $('#' + frmName)[0].reset();
    $("#" + frmName + " select").each(function () {
        $(this).val(0);
		$(this).val("0").trigger("change");
		//$(this).val(0).trigger("change");
       // $(this).select2("val", 0);
		
    });
	 $("#" + frmName + " textarea").each(function () {
        $(this).html('');
		
    });
	 $("#" + frmName + " img").each(function () {
        $(this).html('');
		 $(this).val(0);
		  $(this).attr("src","");
    });
	$('#additional_img_main_wrap').html('');
	$('#filedivedit').html('');
	$('#display_img').addClass('hide');
	$('#type_id').addClass('hide');
	$('#link_title').addClass('hide');
	$('#link_url').addClass('hide');
	$('#lu').addClass('hide');
	$('#lt').addClass('hide');
	$('#sh').addClass('hide');
	
}

//------------------------------------ Enable Disable  Form Elements ---------------------------------------------------

function glbControlEnable(bolFlag) {

    if (bolFlag) {

        $("#frmForm").find("input, button, textarea, select").attr("disabled", false);
        $("#frmForm").find("input, textarea").removeClass("bg-color-lighten");
		$(".customAddNewClientVendor").attr("disabled", false);
		$(".customAddNewProduct").attr("disabled", false);
		$(".customDisableDiv").removeClass("hide");
        $("#btnSave").show();
    }
    else {
        $("#frmForm").find("input, button, textarea, select").attr("disabled", true);
        $("#frmForm").find("input, textarea").addClass("bg-color-lighten");
        $(".editRecord ").attr("disabled", true);
		$(".customAddNewClientVendor").attr("disabled", true);
		$(".customAddNewProduct").attr("disabled", true);
		$(".customDisableDiv").addClass("hide");
        $("#btnSave").hide();
    }
}

//------------------- populate edit entries-----------------------------------------------------------------------------
function populateEditEntries(iID,strURL) {
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
				if(key == "gender")   //radio button
				{
					key = key+"1";
				}
				
				if(key == "map_location")
						maploc = value;
		   
				var count = 0;

				if(key == "additional_images")
				{
						$("#additionalimageshidden").val(value);
						
						if(value != "")
						{
						$("#additional_img_main_wrap").html("");
                   		var img = value.split(',');
						var imgData = '';
						$.each(img, function(index, val) {
							count++;
							
							imgData += '<div  style="float:left;margin-right:20px; margin-top:10px;"><img id="allimg" src="public/uploads/'+val+'" height="100px" width="130px"/> <img src="public/img/x.png" height="20px" width="20px" class="cimgclick" row-id="'+val+'" onClick="deleteImageEditMode(\''+val+'\',iActiveID,this)" /></div>';
							
						});
						
						$('#filedivedit').html(imgData);
						
						}	         
                    }
 					if(key == "status"){
				
						if(value == "Active")
							$("#frmForm").find("#"+key).prop("checked", true);
						else
							$("#frmForm").find("#"+key).prop("checked", false);
                   }
                if ($("#"+key).length > 0 || key == ckeditorvar || key == "hobby" ) {  // check if exists or not
                    strElementType= $("#"+key).attr("type");
                    if(strElementType == "text") {  // if textbox
                        $("#" + key).val(value);
                    }
					if(strElementType == "number") {  // if number
                        $("#" + key).val(value);
                    }					
					else if(strElementType == "email") {  // if email
                        $("#" + key).val(value);
                    }
					
					else if(strElementType == "password") {  // if password
                        $("#" + key).val(value);
                    }
					else if($("#"+key).attr("name") == "map_location"){
								$("#" + key).val(value);
						}
					/*else if(key == ckeditorvar ) {  // if textarea 
                        $("#description_ckeditor").text(value);
                    }*/					 
					else if(strElementType == "select") {  // if Select Box
						
                        //$("#" + key).select2("val",value);
						$("#" + key).val(value); // Select the option with a value of 'US'
						$("#" + key).trigger('change'); // Notify any JS components that the value changed 
						
						
                    }					
				  	else if($("#"+key).attr("name") == "image") {  // if textbox   
						$("#display_img").attr("src", "../public/uploads/localeicons/"+value);	
                    }
					else if($("#"+key).attr("name") == "avatar") {  // if textbox   
						$('#browseicon').val(value);
						$("#display_img").attr("src", "../public/uploads/localeicons/"+value);
						
                    }
					else if($("#"+key).attr("name") == "path") {  // if textbox
						$('#browseicon').val(value);
						$('#pathhidden').val(value);
						$("#display_img").attr("src", "../public/uploads/localeicons/"+value);	
                    }
                    else if(strElementType == "multiselect") {  // if Select Box with multi select
                        var arrValues = $.parseJSON(stripslashes(value));
                        $("#" + key).select2("val", arrValues);
                    }					
                    else if(strElementType == "image") {  // if Image
                        $("#" + key).attr("src",value);
                    }	
					
						
					else if(strElementType == "textarea") { 
                       $("#" + key).html(value);
                    }					
					else if(strElementType == "checkbox"){	
						if(value=="1" || value == "Yes")
							$("#" + key).prop("checked", true);							
					}
					else if($("#"+key).attr("name") == "gender"){	
													
							if(value=="Male")
								$("#gender1").prop("checked", true);
							else if(value=="Female")
                            	$("#gender2").prop("checked", true);
                   }
				    
					else {
					  	$("#" + key).val(value);	
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
function populateEditEntries_view(iID,strURL) {
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
/*			if(is_single == false) {
				visibleControl('widForm', true);
				visibleControl('widGrid', false);
			}
*/            strActionMode = 'EDIT';
			$("#filediv").html('');
            arrForms=objMyPost.DATA.data[0];
			var gender="";
			var additional_image = 1;
			
			
			if (typeof funCallBeforeEdit == 'function') { 
					funCallBeforeEdit(arrForms);	
			}
            $.each( arrForms, function( key, value ) {
				key='view_'+key;					   
		   
				var count = 0;

                if ($("#"+key).length > 0 || key == ckeditorvar || key == "hobby") {  // check if exists or not
					
                    strElementType= $("#"+key).attr("type");

                    if(strElementType == "text") {  // if textbox
                        $("#" + key).val(value);
                    }
					if(strElementType == "number") {  // if number
                        $("#" + key).val(value);
                    }					
					else if(strElementType == "email") {  // if email
                        $("#" + key).val(value);
                    }
					
					else if(strElementType == "password") {  // if password
                        $("#" + key).val(value);
                    }					
					/*else if(key == ckeditorvar ) {  // if textarea 
                        $("#description_ckeditor").text(value);
                    }*/					 
					else if(strElementType == "select") {  // if Select Box
						
                        //$("#" + key).select2("val",value);
						$("#" + key).val(value); // Select the option with a value of 'US'
						$("#" + key).trigger('change'); // Notify any JS components that the value changed 

						
                    }					
				  	else if($("#"+key).attr("name") == "image") {  // if textbox   
						$("#display_img").attr("src", "public/uploads/localeicons/"+value);	
                    }					
                    else if(strElementType == "multiselect") {  // if Select Box with multi select
                        var arrValues = $.parseJSON(stripslashes(value));
                        $("#" + key).select2("val", arrValues);
                    }					
                    else if(strElementType == "image") {  // if Image
                        $("#" + key).attr("src",value);
                    }					
					else if(strElementType == "textarea") { 
                       $("#" + key).html(value);
                    }					
					else if(strElementType == "checkbox"){	
						if(value=="1" || value == "Yes")
							$("#" + key).prop("checked", true);							
					}
					else if($("#"+key).attr("name") == "gender"){	
													
							if(value=="Male")
								$("#gender1").prop("checked", true);
							else if(value=="Female")
                            	$("#gender2").prop("checked", true);
                   }
					else {

					  	$("#" + key).val(value);	
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

//-------------Strip Slashed -------------------------
function stripslashes(str) {
    str = str.replace(/\\'/g, '\'');
    str = str.replace(/\\"/g, '"');
    str = str.replace(/\\0/g, '\0');
    str = str.replace(/\\\\/g, '\\');
    return str;
}

//Function Used for Edit
function fnEdit(strUrl)
{	
    $("#"+gridTableId).delegate('a.edit', 'click', function (e) {
        e.preventDefault();		
		$('#frmForm').bootstrapValidator("resetForm",true);    
        iActiveID = $(this).attr("row-id");
        clearForm("frmForm");
		$("#display_img").removeClass('hide');
		$("#type_id").removeClass('hide');
		$("#sh").removeClass('hide');
		$('#langFormTabs a:first').tab('show').trigger('click');
		$("#youtube_form").addClass('hide');
		$("#sms_form").addClass('hide');
        populateEditEntries(iActiveID, strUrl);
        glbControlEnable(true);
		$('ul#langFormTabs li').each(function(){
		   $(this).find('i').removeClass('fa-check').removeClass('fa-times');
		});
		
    });

}

function fnImport(strUrl)
{	
	$("#btnImport").click(function(){
		$('#ImportCsvFileModal').modal({backdrop: 'static', keyboard: false});	
		$("#importFileError").addClass("hide");	
		$("#importFileLabel").removeClass("has-error");	
		$('#importcsvform').find('input:text, input:file').val('');
	});

	$("#importsavebutton").click(function (e) {
		e.stopPropagation();
		$("#importFileError").addClass("hide");	
		$("#importFileLabel").removeClass("has-error");	
		var this1 = document.getElementById("importfile");			
	
		if (this1.files && this1.files[0]) {
	   
			//Save img
			
			var $form = $('#importcsvform');
			var oMyForm = new FormData($form.get(0));
			//*============================image=====================================
			file = document.getElementById("importfile").files[0];
			if (file && file.size > 0) {
				var fileInputProfile = document.getElementById("importfile");
				oMyForm.append("importfile", file);
			} else {
				//oMyForm.append("importfile", 0);
				$("#importFileError").removeClass("hide");					
				$("#importFileLabel").addClass("has-error");		
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
				fetch_grid_data();
				$('#import').val(null);
				if (result.status === 'OK') {
					$('#ImportCsvFileModal').modal('hide')
				}
				else
				{
					$('#ImportCsvFileModal').modal('show')
			}
			}).fail(function (result) {
				mySmallAlert('Error', 'Unable to open file!', 0);
			});			   
	  }
	  	else
		{
			$("#importFileError").removeClass("hide");						
			$("#importFileLabel").addClass("has-error");
		}
		return false; 										 
	});

}
//Function Used for View
function fnView(strUrl)
{
    $("#"+gridTableId).delegate('a.view', 'click', function (e) {
        e.preventDefault();		
		$('#frmForm').bootstrapValidator("resetForm",true);
        iActiveID=$(this).attr("row-id");
        clearForm("frmForm");
		$("#display_img").removeClass('hide');
		$('#langFormTabs a:first').tab('show').trigger('click');
		$("#langFormTabs").find('i.fa-times').hide()
		$("#youtube_form").addClass('hide');
		$("#sms_form").addClass('hide');
        populateEditEntries(iActiveID,strUrl);
        glbControlEnable(false);
    });
}
//Function Used for View
function fnViewOrder(strUrl)
{
    $("#"+gridTableId).delegate('a.view', 'click', function (e) {
        e.preventDefault();
        iActiveID=$(this).attr("row-id");
        clearForm("frmForm");
		$("#display_img").removeClass('hide');
        populateEditEntriesOrder(iActiveID,strUrl);
        glbControlEnable(false);
    });
}
//Function Used for Delete
function fnDelete(strUrl)
{

    $("#"+gridTableId).delegate('a.delete', 'click', function (e) {
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
							fetch_grid_data();
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

//Function Used for bulk save
function fnBulkSave(strUrl)
{

    $("#btnBulkSave").click(function (e) {
        e.preventDefault();       
      
        $.SmartMessageBox({
            title  : "Alert!",
            content: "Are you sure you want to save all?",
            buttons: '[Yes][No]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
               var $form = $('#bulkSaveForm');
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
						fetch_grid_data();							
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
function fnExport(strUrl)
{

    $("#btnExport").click(function (e) {
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
		    var $form = $('#bulkSaveForm');
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
function downloadCSV(CSVDATA,exportfilename) {  
	csv = CSVDATA;
	if (csv == null) return;

	filename = exportfilename;

	if (!csv.match(/^data:text\/csv/i)) {
		csv = 'data:text/csv;charset=utf-8,' + csv;
	}
	data = encodeURI(csv);

	link = document.createElement('a');
	link.setAttribute('href', data);
	link.setAttribute('download', filename);
	link.click();
}

//Function Used for Restore
function fnRestore(strUrl)
{

    $("#tblMasterList").delegate('a.restore', 'click', function (e) {
        e.preventDefault();
        intID=$(this).attr("row-id");
        var url = "pAction=RESTORE&ID=" + intID;
        $.SmartMessageBox({
            title  : "Alert!",
            content: "Are you sure you want to restore?",
            buttons: '[Yes][No]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                var objFormData =
                {
                    pAction: 'RESTORE',
                    KEY_ID : intID
                };
				hideShowLoader(true);
                var objMyPost = AJAX_Post(strUrl, objFormData);
                if (objMyPost.ERR_NO === 0) {
                    if (objMyPost.DATA.DBStatus === 'OK') {   
						var objFormData = { deleted_flag    : '1' };
						fetch_grid_data(objFormData);
						hideShowLoader(false);
                        mySmallAlert('Success', 'Record  Restored successfully', 1);
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

//Function Used for Restore
function fnDeletePermenant(strUrl)
{

    $("#tblMasterList").delegate('a.deletePermenant', 'click', function (e) {
        e.preventDefault();
        intID=$(this).attr("row-id");
        var url = "pAction=DELETEPERMENANT&ID=" + intID;
        $.SmartMessageBox({
            title  : "Alert!",
            content: "Are you sure you want to delete Permenantly?",
            buttons: '[Yes][No]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                var objFormData =
                {
                    pAction: 'DELETEPERMENANT',
                    KEY_ID : intID
                };
				hideShowLoader(true);
                var objMyPost = AJAX_Post(strUrl, objFormData);
                if (objMyPost.ERR_NO === 0) {
                    if (objMyPost.DATA.DBStatus === 'OK') {   
						var objFormData = { deleted_flag    : '1' };
						fetch_grid_data(objFormData);
						hideShowLoader(false);
                        mySmallAlert('Success', 'Record  Deleted Permenantly', 1);
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
function fnPopup(strUrl)
{	 
	$("#tblMasterList").delegate('a.popup', 'click', function (e) {
        e.preventDefault();
		var intID=$(this).attr("row-id");
       var	name=$(this).attr("row-name");
	   var	typeID=$(this).attr("row-type-id");
	   if (typeof funCallBeforePopup == 'function') { 
					funCallBeforePopup(intID,name,typeID);	
		}
		$('#PopupGridModal').modal('show');	
		 if (typeof funCallAfterPopup == 'function') { 
					funCallAfterPopup(intID,name,typeID);	
		}
		return false; 										 
	});

}
function fnDonation()
{	 
	$("#tblMasterList").delegate('a.newdonation', 'click', function (e) {
        e.preventDefault();
		var intID=$(this).attr("row-id");
		var ben_name=$(this).attr("row-name");
		$("#frmFormDonation").find('#beneficiary_id').val(intID);
		$('#DonationModal').modal('show');
		clearForm('frmFormDonation');
		$('#frmFormDonation').bootstrapValidator("resetForm",true);
		$("#beneficiary_name").html(ben_name);
		return false; 										 
	});

}
function fnViewBeneficiary()
{	
    $("#"+gridTableId).delegate('a.viewbeneficiary', 'click', function (e) {
        e.preventDefault();	
		visibleControl("widForm", false);
        visibleControl("widGrid", false);
		visibleControl("widViewBeneficiary", true);
		iActiveID = $(this).attr("row-id");
		var objFormData = {
			beneficiaryID    : iActiveID
		}
		fetch_beneficiary_profile_family(objFormData);
		$('#langBeneficiaryFormTabs a:first').tab('show').trigger('click');
    });

}

function fnSponsorship(strUrl)
{	 
	$("#tblMasterList").delegate('a.sponsorship', 'click', function (e) {
        e.preventDefault();
		var intID=$(this).attr("row-id");
		var ben_name=$(this).attr("row-name");
		$("#btnNewDonation").attr("row-id",intID,ben_name);
		$("#btnNewDonation").attr("row-name",ben_name);
		var beneficiary_profile_family=$("#frmFormSponsorship").find("#beneficiary_profile_family_id");
		var beneficiary_profile_family_array=[beneficiary_profile_family];
		var objFormData = {
			beneficiaryID    : intID
		}
				
				populateDependentOptionValuesObjectBulk(beneficiary_profile_family_array,strUrl,"Select Beneficiary Profile Family",objFormData);
		$("#frmFormSponsorship").find('#beneficiary_id').val(intID);		
		$('#SponsorshipModal').modal('show');
		$("#beneficiary_spon").html(ben_name);
		clearForm('frmFormSponsorship');
		$('#frmFormSponsorship').bootstrapValidator("resetForm",true);
		return false; 										 
	});

}
function fnManageGroups(strUrl)
{	 
	
	$("#tblMasterList").delegate('a.manage_groups', 'click', function (e) {
        e.preventDefault();
		var intID=$(this).attr("row-id");
		var ben_name=$(this).attr("row-name");
		$("#frmFormManageGroups").find('#beneficiary_id').val(intID);
		var objFormData = {
			beneficiaryID    : intID
		}
		var objMyPost = AJAX_Post(strUrl, objFormData);
		if (objMyPost.ERR_NO === 0) {
			if (objMyPost.DATA.DBStatus === 'OK') {   
				$("#frmFormGroupMember").find("#beneficiary_group_id").val(objMyPost.DATA.beneficiary_group_id).trigger('change');
			}
			else {
				mySmallAlert('Error...!', 'There was an error', 0);
			}
		}
		$('#ManageGroupsModal').modal('show');	
		$("#beneficiary_manage").html(ben_name);
		clearForm('frmFormManageGroups');
		$('#frmFormManageGroups').bootstrapValidator("resetForm",true);
		return false; 										 
	});

}

function fnManageAsset(strUrl)
{	 
	$("#tblMasterList").delegate('a.manage_asset', 'click', function (e) {
        e.preventDefault();
		var intID=$(this).attr("row-id");
		var ben_name=$(this).attr("row-name");
		var beneficiary_profile_asset_received=$("#frmFormManageAsset").find("#beneficiary_profile_asset_received_id");
		var beneficiary_profile_asset_received_array=[beneficiary_profile_asset_received];
		var objFormData = {
			beneficiary_id    : intID
		}
				
				populateDependentOptionValuesObjectBulk(beneficiary_profile_asset_received_array,strUrl,"Select Beneficiary Profile Asset Received",objFormData);
		$("#frmFormManageAsset").find('#beneficiary_id').val(intID);
		$('#ManageAssetModal').modal('show');	
		$("#beneficiary_asset").html(ben_name);
		clearForm('frmFormManageAsset');
		$('#frmFormManageAsset').bootstrapValidator("resetForm",true);
		return false; 										 
	});

}

function fnChangeOrganization()
{	 
	$("#tblMasterList").delegate('a.change_organization', 'click', function (e) {
        e.preventDefault();
		var intID=$(this).attr("row-id");
		var ben_name=$(this).attr("row-name");
		$("#frmFormChangeOrganization").find('#beneficiary_id').val(intID);
		$('#ChangeOrganizationModal').modal('show');	
		$("#beneficiary_organization").html(ben_name);
		clearForm('frmFormChangeOrganization');
		$('#frmFormChangeOrganization').bootstrapValidator("resetForm",true);
		return false; 										 
	});

}
function fnGroupMember(strUrl)
{	 
	$("#tblMasterList").delegate('a.view_group', 'click', function (e) {
        e.preventDefault();
		var intID=$(this).attr("row-id");
		var beneficiary_id=$("#frmFormGroupMember").find("#beneficiary_id");
		var beneficiary_id_array=[beneficiary_id];
		var objFormData = {
			beneficiary_group_id    : intID
		}
		populateDependentOptionValuesObjectBulk(beneficiary_id_array,strUrl,"Select Beneficiary",objFormData);
		
		
        visibleControl("widGroupMemberGrid", true);
		visibleControl("widGrid", false);
		$("#frmFormGroupMember").find('#beneficiary_group_id').val(intID);
		clearForm('frmFormGroupMember');
		$('#frmFormGroupMember').bootstrapValidator("resetForm",true);
		fetch_grid_data_group_member();
		return false; 										 
	});

}

function fnGalleryPublished(strUrl)
{

   $("#tblMasterList").delegate('a.published', 'click', function (e) {
        e.preventDefault();       
       var intID=$(this).attr("row-id");
        $.SmartMessageBox({
            title  : "Alert!",
            content: "Are you sure you want to published?",
            buttons: '[Yes][No]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
               	var $form = $('#bulkSaveForm');
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
							fetch_grid_data();							
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


/******************************************************NEW SCREEN***************************************************************/
function glbControlEnable1(bolFlag) {

    if (bolFlag) {

        $("#frmForm1").find("input, button, textarea, select").attr("disabled", false);
        $("#frmForm1").find("input, textarea").removeClass("bg-color-lighten");
		$(".customAddNewClientVendor").attr("disabled", false);
		$(".customAddNewProduct").attr("disabled", false);
		$(".customDisableDiv").removeClass("hide");
        $("#btnSave1").show();
    }
    else {
        $("#frmForm1").find("input, button, textarea, select").attr("disabled", true);
        $("#frmForm1").find("input, textarea").addClass("bg-color-lighten");
        $(".editRecord ").attr("disabled", true);
		$(".customAddNewClientVendor").attr("disabled", true);
		$(".customAddNewProduct").attr("disabled", true);
		$(".customDisableDiv").addClass("hide");
        $("#btnSave1").hide();
    }
}

function populateEditEntries1(iID,strURL) {
    iActiveID = iID;
    var arrForms=[]; // Keep Form Values
    var strElementType; // Keep element type

    var objFormData =
    {
        pAction: 'GETREC1',
        KEY_ID : iActiveID
    };
	hideShowLoader(true);
    var objMyPost = AJAX_Post(strURL, objFormData);
	hideShowLoader(false);
    if (objMyPost.ERR_NO === 0) {
        if (objMyPost.DATA.DBStatus === 'OK') {
			
            strActionMode = 'EDIT1';
			$("#filediv").html('');
            arrForms=objMyPost.DATA.data[0];
			var gender="";
			var additional_image = 1;
			
			
			if (typeof funCallBeforeEdit == 'function') { 
					funCallBeforeEdit(arrForms);	
			}
            $.each( arrForms, function( key, value ) {
				if(key == "gender")   //radio button
				{
					key = key+"1";
				}
		   
				var count = 0;

				if(key == "additional_images")
				{
						$("#additionalimageshidden").val(value);
						
						if(value != "")
						{
						$("#additional_img_main_wrap").html("");
                   		var img = value.split(',');
						var imgData = '';
						$.each(img, function(index, val) {
							count++;
							
							imgData += '<div  style="float:left;margin-right:20px; margin-top:10px;"><img id="allimg" src="public/uploads/'+val+'" height="100px" width="130px"/> <img src="public/img/x.png" height="20px" width="20px" class="cimgclick" row-id="'+val+'" onClick="deleteImageEditMode(\''+val+'\',iActiveID,this)" /></div>';
							
						});
						
						$('#filedivedit').html(imgData);
						
						}	         
                    }
				var keyObject = $("#frmForm1").find("#"+key);
                if (keyObject.length > 0 || key == ckeditorvar || key == "hobby"  || key == "published") {  // check if exists or not
					
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
						keyObject.val(value); // Select the option with a value of 'US'
						keyObject.trigger('change'); // Notify any JS components that the value changed 						
                    }					
				  	else if(keyObject.attr("name") == "image") {  // if textbox   
						$("#display_img").attr("src", "public/uploads/localeicons/"+value);	
                    }					
                    else if(strElementType == "multiselect") {  // if Select Box with multi select
                        var arrValues = $.parseJSON(stripslashes(value));
                        keyObject.select2("val", arrValues);
                    }					
                    else if(strElementType == "image") {  // if Image
                        keyObject.attr("src",value);
                    }					
					else if(strElementType == "textarea") { 
                       keyObject.html(value);
                    }					
					else if(strElementType == "checkbox"){	
						if(value=="1" || value == "Yes")
							keyObject.prop("checked", true);							
					}
					else if(keyObject.attr("name") == "gender"){	
													
							if(value=="Male")
								$("#gender1").prop("checked", true);
							else if(value=="Female")
                            	$("#gender2").prop("checked", true);
                   }
				   else if(key == "published"){			
						if(value == "Yes")
							$("#frmForm1").find("#"+key+"1").prop("checked", true);
						else
							$("#frmForm1").find("#"+key+"1").prop("checked", false);
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


function fnNew(strUrl)
{	 
	$("#tblMasterList").delegate('a.new', 'click', function (e) {
        e.preventDefault();
		strActionMode = "ADD1";
		intID=$(this).attr("row-id");
		parentId = intID;
      	var	name=$(this).attr("row-name");
		parentName=name;
		if(typeof cllBeforefnNew === "function")
		{
			cllBeforefnNew(parentId,name);	
		}

		fullscreenModeChange('new');
        objMyDetailRecords.length=0;
        tblDetailsListBody.html('');
		
        visibleControl("widForm1", true);
        visibleControl("widGrid", false);
        clearForm("frmForm1");
        strActionMode="ADD1";
        glbControlEnable1(true);		
		$('#frmForm1').bootstrapValidator("resetForm",true); 
		$("#"+parentIdFieldName).val(parentId);
		$('#tblname').html(parentName);
		$('#tblname1').html(parentName);
		
		//alert($('ul#langFormTabs li:first-child').html());
		// $('.nav-tabs a[href="#tabs-1"]').tab('show');
		$('ul#langFormTabs li').each(function(){
		   $(this).find('i').removeClass('fa-check').removeClass('fa-times');
		});
	});
}
function fnEdit1(strUrl)
{	
    $("#widGrid1").delegate('a.edit_drag', 'click', function (e) {
        e.preventDefault();
		strActionMode = "EDIT1";
		$('html,body').animate({ scrollTop: 0 }, 1000);
		$("#"+parentIdFieldName).val(parentId);
		$('#frmForm1').bootstrapValidator("resetForm",true);    
        iActiveID = $(this).attr("row-id");
        clearForm("frmForm1");
		$("#display_img").removeClass('hide');
		$("#type_id").removeClass('hide');
		$("#sh").removeClass('hide');
		$('#langFormTabs a:first').tab('show').trigger('click');
		//$('.nav-tabs a:first').tab('show');
        populateEditEntries1(iActiveID, strUrl);
        glbControlEnable1(true);
		
    });

}

function fnView1(strUrl)
{
    $("#widGrid1").delegate('a.view_drag', 'click', function (e) {
        e.preventDefault();	
		 $('html,body').animate({ scrollTop: 0 }, 1000);
		$('#frmForm1').bootstrapValidator("resetForm",true);
        iActiveID=$(this).attr("row-id");
        clearForm("frmForm1");
		$("#display_img").removeClass('hide');
		$('#langFormTabs a:first').tab('show').trigger('click');
        populateEditEntries1(iActiveID,strUrl);
        glbControlEnable1(false);
    });
}
function fnDelete1(strUrl)
{

    $("#widGrid1").delegate('a.delete_drag', 'click', function (e) {
        e.preventDefault();
        intID=$(this).attr("row-id");
        var url = "pAction=DELETE1&ID=" + intID;
        $.SmartMessageBox({
            title  : "Alert!",
            content: "Are you sure you want to delete?",
            buttons: '[Yes][No]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
                var objFormData =
                {
                    pAction: 'DELETE1',
                    KEY_ID : intID
                };
				hideShowLoader(true);
                var objMyPost = AJAX_Post(strUrl, objFormData);
                if (objMyPost.ERR_NO === 0) {
                    if (objMyPost.DATA.DBStatus === 'OK') {   
						if(is_single == false) {
							fetch_grid_data_draggable();
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
function fnExport1(strUrl)
{

    $("#btnExport1").click(function (e) {
        e.preventDefault();  
		var exportfilename = parentName;
      
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
		    var $form = $('#bulkSaveForm1');
			var objMasterData = $form.serializeObject();
			objMasterData = JSON.stringify(objMasterData);

			var objFormData =
			{
				FORM_DATA1: objMasterData,
				export_data: export_data,
				exportfilename:exportfilename,
				parentId : parentId
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


function fnBulkSave1(strUrl)
{

    $("#btnBulkSave1").click(function (e) {
        e.preventDefault();       
      $("#"+parentIdFieldName).val(parentId);
        $.SmartMessageBox({
            title  : "Alert!",
            content: "Are you sure you want to save all?",
            buttons: '[Yes][No]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Yes") {
               var $form = $('#bulkSaveForm1');
				var objMasterData = $form.serializeObject();
				objMasterData = JSON.stringify(objMasterData);

				var objFormData =
				{
					FORM_DATA1: objMasterData,
					parentId : parentId
				};
				hideShowLoader(true);
                var objMyPost = AJAX_Post(strUrl, objFormData);
                if (objMyPost.ERR_NO === 0) {
                    if (objMyPost.DATA.DBStatus === 'OK') {   
						fetch_grid_data1();							
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
function fnImport1(strUrl)
{	
	$("#btnImport1").click(function(){
		$('#ImportCsvFileModal1').modal({backdrop: 'static', keyboard: false});	
		$("#importFileError1").addClass("hide");	
		$("#importFileLabel1").removeClass("has-error");	
		$('#importcsvform1').find('input:text, input:file').val('');
		$('#popup_titles_span').html(parentName);
	});

	$("#importsavebutton1").click(function (e) {
		e.stopPropagation();
		$("#importFileError1").addClass("hide");	
		$("#importFileLabel1").removeClass("has-error");	
		var this1 = document.getElementById("importfile1");			
	
		if (this1.files && this1.files[0]) {
	   
			//Save img
			
			var $form = $('#importcsvform1');
			var oMyForm = new FormData($form.get(0));
			//*============================image=====================================
			file = document.getElementById("importfile1").files[0];
			if (file && file.size > 0) {
				var fileInputProfile = document.getElementById("importfile1");
				oMyForm.append("importfile", file);
			} else {
				//oMyForm.append("importfile", 0);
				$("#importFileError1").removeClass("hide");					
				$("#importFileLabel1").addClass("has-error");		
				return false;
			}					
			oMyForm.append("parentId", parentId);
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
				fetch_grid_data();
				$('#import1').val(null);
				if (result.status === 'OK') {
					$('#ImportCsvFileModal1').modal('hide')
				}
				else
				{
					$('#ImportCsvFileModal1').modal('show')
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




/******************************************************END NEW SCREEN***************************************************************/


//function used to find the duplicate
function fn_validate_duplicate(iID,tableName,fieldName,strURL,iActiveID)
{

    var objFormData =
    {
        tableName: tableName,
        fieldName: fieldName,
        KEY_ID : iID,
		iActiveID : iActiveID,
    };
    var objMyPost = AJAX_Post(strURL, objFormData);

        if (objMyPost.DATA.DBStatus === 'ERR') {
            return true;
        }

}


//function used to find the duplicate for two fields
function fn_validate_duplicate_two(iVal1,iVal2,field1,field2,tableName,strURL,iActiveID)
{

    var objFormData =
    {
        tableName: tableName,
        field1: field1,
        field2: field2,
        value1: iVal1,
        value2: iVal2,
		

    };
    var objMyPost = AJAX_Post(strURL, objFormData);

        if (objMyPost.DATA.DBStatus === 'ERR') {
            return true;
        }

}

function fn_validate_duplicate_multiple(tableName,strURL,iActiveID,objFormData)
{

    var objFormData1 =
    {
        tableName: tableName,
		fnameValPair:objFormData,
		iActiveID:iActiveID

    };
    var objMyPost = AJAX_Post(strURL, objFormData1);

        if (objMyPost.DATA.DBStatus === 'ERR') {
            return true;
        }

}

//--------------------populate Category--------------------------------------------------------------------------------

//--------------------populate Vendors--------------------------------------------------------------------------------
function populateOptionValues(strObjectName,Url,Select_heading) {

    var cboObject = $('#' + strObjectName);
    var objGet = AJAX_Get(Url);
    var items = "";
    var iVal = "";		
    if (objGet.DATA.DBStatus === 'OK') {
        var arrMyData = objGet.DATA.DBData;
        items += "<option value='0'><column>"+Select_heading+"</column></option>";
        $.each(arrMyData, function (index, item) {
            items += "<option value='" + item.id + "'><column>" + item.name + "</column></option>";
        });
    }
    cboObject.html(items);
	cboObject.val("0").trigger("change");
}
function populateOptionValuesBulk(strObjectName,Url,Select_heading) {
	var objectcount=strObjectName.length;
    var objGet = AJAX_Get(Url);
    var items = "";
    var iVal = "";		
    if (objGet.DATA.DBStatus === 'OK') {
        var arrMyData = objGet.DATA.DBData;
        items += "<option value='0'><column>"+Select_heading+"</column></option>";
        $.each(arrMyData, function (index, item) {
            items += "<option value='" + item.id + "'><column>" + item.name + "</column></option>";
        });
    }
    for(var i=0 ; i<objectcount ;i++)
	{
		var cboObject = strObjectName[i];
	
		cboObject.html(items);
	
		cboObject.select2("val", "0");
	}
}

function populateOptionValues2(cboObject,Url,Select_heading) {

    //var cboObject = $('#' + strObjectName);
    var objGet = AJAX_Get(Url);
    var items = "";
    var iVal = "";		
    if (objGet.DATA.DBStatus === 'OK') {
        var arrMyData = objGet.DATA.DBData;
        items += "<option value='0'><column>"+Select_heading+"</column></option>";
        $.each(arrMyData, function (index, item) {
            items += "<option value='" + item.id + "'><column>" + item.name + "</column></option>";
        });
    }
    cboObject.html(items);
	cboObject.val("0").trigger("change");
}
function populateDonor(strObjectName,Url,Select_heading) {

    var cboObject = $('#' + strObjectName);
    var objGet = AJAX_Get(Url);
    var items = "";
    var iVal = "";		
    if (objGet.DATA.DBStatus === 'OK') {
        var arrMyData = objGet.DATA.DBData;
        items += "<option value='0'><column>"+Select_heading+"</column></option>";
        $.each(arrMyData, function (index, item) {
            items += "<option value='" + item.id + "'><column>" + item.name + "</column></option>";
        });
    }
    cboObject.html(items);
    cboObject.select2({

   		 minimumInputLength: 3

	});


}
function populateOptionValuesDonorBulk(strObjectName,Url,Select_heading) {
	var objectcount=strObjectName.length;
    var objGet = AJAX_Get(Url);
    var items = "";
    var iVal = "";		
    if (objGet.DATA.DBStatus === 'OK') {
        var arrMyData = objGet.DATA.DBData;
        items += "<option value='0'><column>"+Select_heading+"</column></option>";
        $.each(arrMyData, function (index, item) {
            items += "<option value='" + item.id + "'><column>" + item.name + "</column></option>";
        });
    }
    for(var i=0 ; i<objectcount ;i++)
	{
		var cboObject = strObjectName[i];
	
		cboObject.html(items);
	
		cboObject.select2({

			 minimumInputLength: 3
	
		});
	}
}

function populateMultiSelectOptionValues(strObjectName,Url) {

    var cboObject = $('#' + strObjectName);
    var objGet = AJAX_Get(Url);
    var items = "";
    var iVal = "";		
    if (objGet.DATA.DBStatus === 'OK') {
        var arrMyData = objGet.DATA.DBData;
        
        $.each(arrMyData, function (index, item) {
            items += "<option value='" + item.id + "'><column>" + item.name + "</column></option>";
        });
    }
    cboObject.html(items);
   
}

function populateDependentOptionValues(strObjectName,Url,Select_heading,dataObject) {

    var cboObject = $('#' + strObjectName);
    var objGet = AJAX_Post(Url, dataObject);
    var items = "";
    var iVal = "";		
    if (objGet.DATA.DBStatus === 'OK') {
        var arrMyData = objGet.DATA.DBData;
        items += "<option value='0'><column>"+Select_heading+"</column></option>";
        $.each(arrMyData, function (index, item) {
            items += "<option value='" + item.id + "'><column>" + item.name + "</column></option>";
        });
    }
    cboObject.html(items);
    cboObject.select2("val", "0");
}

function populateDependentOptionValuesObject(strObjectName,Url,Select_heading,dataObject) {

    var cboObject = strObjectName;
    var objGet = AJAX_Post(Url, dataObject);
    var items = "";
    var iVal = "";		
    if (objGet.DATA.DBStatus === 'OK') {
        var arrMyData = objGet.DATA.DBData;
        items += "<option value='0'><column>"+Select_heading+"</column></option>";
        $.each(arrMyData, function (index, item) {
            items += "<option value='" + item.id + "'><column>" + item.name + "</column></option>";
        });
    }
    cboObject.html(items);
    cboObject.select2("val", "0");
}

function populateDependentOptionValuesObjectBulk(strObjectName,Url,Select_heading,dataObject) {

	var objectcount=strObjectName.length;
    var objGet = AJAX_Post(Url, dataObject);
    var items = "";
    var iVal = "";		
    if (objGet.DATA.DBStatus === 'OK') {
        var arrMyData = objGet.DATA.DBData;
        items += "<option value='0'><column>"+Select_heading+"</column></option>";
        $.each(arrMyData, function (index, item) {
            items += "<option value='" + item.id + "'><column>" + item.name + "</column></option>";
        });
    }
    for(var i=0 ; i<objectcount ;i++)
	{
		var cboObject = strObjectName[i];
	
		cboObject.html(items);
	
		cboObject.select2("val", "0");
	}
}

function populateOptionValuesSortable(strObjectName,Url,Select_heading) {

    var cboObject = $('#' + strObjectName);
    var objGet = AJAX_Get(Url);
    var items = "";
    var iVal = "";		
    if (objGet.DATA.DBStatus === 'OK') {
        var arrMyData = objGet.DATA.DBData;
            $.each(arrMyData, function (index, item) {
            items += "<li id='" + item.id + "'><column>" + item.name + "</column></li>";
        });
    }
    cboObject.html(items);
	cboObject.val("0").trigger("change");
}


/*function fnEditDetail(detailGridTableId,formID,tabUlID,strUrl)
{	
    $("#"+detailGridTableId).delegate('a.edit', 'click', function (e) {
        e.preventDefault();		
		strActionModeFamilyDetail = 'EDIT';
		$('#'+formID).bootstrapValidator("resetForm",true);    
        iActiveDetailID = $(this).attr("row-id");
        clearForm(formID);
		$('#'+tabUlID+' a:first').tab('show').trigger('click');
        populateEditEntriesDetail(iActiveDetailID,formID,strUrl);
		$('ul#'+tabUlID+' li').each(function(){
		   $(this).find('i').removeClass('fa-check').removeClass('fa-times');
		});
		
    });

}*/
function populateEditEntriesDetail(iID,formID,strURL) {
    //iActiveDetailID = iID;
	
    var arrForms=[]; // Keep Form Values
    var strElementType; // Keep element type

    var objFormData =
    {
        pAction: 'GETREC',
        KEY_ID : iID
    };
	hideShowLoaderActive(true);
    var objMyPost = AJAX_Post(strURL, objFormData);
    if (objMyPost.ERR_NO === 0) {
        if (objMyPost.DATA.DBStatus === 'OK') {
            strActionMode = 'EDIT';
			//$("#filediv").html('');
            arrForms=objMyPost.DATA.data[0];
			var gender="";
			var additional_image = 1;
			
            $.each( arrForms, function( key, value ) {	
				var count = 0;
				/*if(key == "additional_images")
				{
					$("#additionalimageshidden").val(value);
					
					if(value != "")
					{
					$("#additional_img_main_wrap").html("");
					var img = value.split(',');
					var imgData = '';
					$.each(img, function(index, val) {
						count++;
						
						imgData += '<div  style="float:left;margin-right:20px; margin-top:10px;"><img id="allimg" src="public/uploads/'+val+'" height="100px" width="130px"/> <img src="public/img/x.png" height="20px" width="20px" class="cimgclick" row-id="'+val+'" onClick="deleteImageEditMode(\''+val+'\',iActiveID,this)" /></div>';
						
					});
					
					$('#filedivedit').html(imgData);
					
					}	         
				}*/
                if ($("#"+formID).find("#"+key).length > 0) {  // check if exists or not
					
                    strElementType= $("#"+formID).find("#"+key).attr("type");

                    if(strElementType == "text") {  // if textbox
                        $("#"+formID).find("#" + key).val(value);
                    }
					if(strElementType == "number") {  // if number
                        $("#"+formID).find("#" + key).val(value);
                    }					
					else if(strElementType == "email") {  // if email
                        $("#"+formID).find("#" + key).val(value);
                    }
					
					else if(strElementType == "password") {  // if password
                        $("#"+formID).find("#" + key).val(value);
                    }
					else if($("#"+formID).find("#"+key).attr("name") == "map_location"){
								$("#"+formID).find("#" + key).val(value);
						}				 
					else if(strElementType == "select") {  // if Select Box
						
                        //$("#" + key).select2("val",value);
						$("#"+formID).find("#" + key).val(value); // Select the option with a value of 'US'
						$("#"+formID).find("#" + key).trigger('change'); // Notify any JS components that the value changed 
						
						
                    }					
				  	else if($("#"+formID).find("#"+key).attr("name") == "image") {  // if textbox   
						$("#"+formID).find("#display_img").attr("src", "public/uploads/localeicons/"+value);	
                    }
					else if($("#"+formID).find("#"+key).attr("name") == "path") {  // if textbox   
						$("#"+formID).find("#display_path").attr("src", "../public/uploads/localeicons/"+value);
						$("#"+formID).find('#browseicon').val(value);
						$("#"+formID).find('#pathhidden').val(value);
                    }
                    else if(strElementType == "multiselect") {  // if Select Box with multi select
                        var arrValues = $.parseJSON(stripslashes(value));
                        $("#"+formID).find("#" + key).select2("val", arrValues);
                    }					
                    else if(strElementType == "image") {  // if Image
                        $("#"+formID).find("#" + key).attr("src",value);
                    }					
					else if(strElementType == "textarea") { 
                       $("#"+formID).find("#" + key).html(value);
                    }					
					else if(strElementType == "checkbox"){	
						if(value=="1" || value == "Yes")
							$("#"+formID).find("#" + key).prop("checked", true);							
					}
					else if($("#"+key).attr("name") == "gender"){	
													
							if(value=="Male")
								$("#"+formID).find("#gender1").prop("checked", true);
							else if(value=="Female")
                            	$("#"+formID).find("#gender2").prop("checked", true);
                   }
				    
					else {
					  	$("#"+formID).find("#" + key).val(value);	
					}
                }
            });			
			
        }
    }
    else {
        mySmallAlert('Error...!', 'There was an error', 0);
    }
	
	hideShowLoaderActive(false);
}

//Function Used for Delete
function fnDeleteDetail(detailGridTableId,type,strUrl)
{

    $("#"+detailGridTableId).delegate('a.delete', 'click', function (e) {
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
				hideShowLoaderActive(true);
                var objMyPost = AJAX_Post(strUrl, objFormData);
                if (objMyPost.ERR_NO === 0) {
                    if (objMyPost.DATA.DBStatus === 'OK') {   
						reloadGridByType(type);						
						hideShowLoaderActive(false);
                        mySmallAlert('Success', 'Record  Deleted successfully', 1);
                    }
                    else {						
						hideShowLoaderActive(false);
                        mySmallAlert('Error...!', 'There was an error', 0);
                    }
                }
            }
            if (ButtonPressed === "No") {
            }
        });
    });

}
function reloadGridByType(type)
{
	switch(type)
	{
		case 'family_detail' :
			fetch_grid_data_familyDetail();
			break;
		case 'family_extra_detail' :
			fetch_grid_data_familyExtraDetail();
			break;
		case 'income_detail' :
			fetch_grid_data_incomeDetail();
			break;
		case 'spending_detail' :
			fetch_grid_data_spendingDetail();
			break;
		case 'all_owned_assets' :
			fetch_grid_data_allOwnedDetail();
			break;
		case 'all_required_assets' :
			fetch_grid_data_allRequiredAssets();
			break;
		case 'disabled_detail' :
			fetch_grid_data_disabledDetail();
			break;
		case 'medical_condition' :
			fetch_grid_data_medicalCondition();
			break;
		case 'medical_extra_detail' :
			fetch_grid_data_medicalExtraDetail();
			break;
		case 'education_detail' :
			fetch_grid_data_educationDetail();
			break;
		case 'media_gallery' :
			fetch_grid_data_mediaGallery();
			break;
		case 'media_youtube_gallery' :
			fetch_grid_data_mediaYoutubeGallery();
			break;	
		default :
			return;
	}
}


//------------------- populate edit entries-----------------------------------------------------------------------------
function setStepFormData(formID,strURL) {
   
	var objFormData = { beneficiaryID : beneficiaryID };

    var arrForms=[]; // Keep Form Values
    var strElementType; // Keep element type
	
	hideShowLoader(true);
    var objMyPost = AJAX_Post(strURL, objFormData);
	hideShowLoader(false);
    if (objMyPost.ERR_NO === 0) {
        if (objMyPost.DATA.DBStatus === 'OK') {
			
			arrForms=objMyPost.DATA.data[0];			
			if(arrForms!=null)
			{
            	$.each( arrForms, function( key, value ) {			
		   
				var count = 0;
				
                if ($("#"+formID).find("#"+key).length > 0) {  // check if exists or not
                    strElementType= $("#"+formID).find("#"+key).attr("type");
                    if(strElementType == "text") {  // if textbox
                        $("#"+formID).find("#" + key).val(value);
                    }
					if(strElementType == "number") {  // if number
                        $("#"+formID).find("#" + key).val(value);
                    }					
					else if(strElementType == "email") {  // if email
                        $("#"+formID).find("#" + key).val(value);
                    }		 
					else if(strElementType == "select") {  // if Select Box
						$("#"+formID).find("#" + key).val(value); // Select the option with a value of 'US'
						$("#"+formID).find("#" + key).trigger('change'); // Notify any JS components that the value changed 
                    }	
                    else if(strElementType == "multiselect") {  // if Select Box with multi select
                        var arrValues = $.parseJSON(stripslashes(value));
                        $("#"+formID).find("#" + key).select2("val", arrValues);
                    }					
                    else if(strElementType == "image") {  // if Image
                        $("#"+formID).find("#" + key).attr("src",value);
                    }	
					else if(strElementType == "textarea") { 
                       $("#"+formID).find("#" + key).html(value);
                    }					
					else if(strElementType == "checkbox"){	
						if(value=="1" || value == "Yes")
							$("#"+formID).find("#" + key).prop("checked", true);							
					}				    
					else {
					  	$("#"+formID).find("#" + key).val(value);	
					}
                }
            });
			}
        }
    }
    else {
        mySmallAlert('Error...!', 'There was an error', 0);
    }
}