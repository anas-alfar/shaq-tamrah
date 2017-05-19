/**
 * Created by mahendran on 6/27/15.
 */
$(document).ready(function () {	
			
	$("#btnSave").click(function(){
		$("#frmForm").submit();
	});	    

    btnBack.click(function (e) {
        e.stopPropagation();
		fullscreenModeChange('btnBack');
        visibleControl("widForm", false);
        visibleControl("widGrid", true);

    });
	
    btnNew.click(function (e) {
        e.stopPropagation();   
		fullscreenModeChange('btnNew');
        objMyDetailRecords.length=0;
        tblDetailsListBody.html('');
		
        visibleControl("widForm", true);
        visibleControl("widGrid", false);
        clearForm("frmForm");
        strActionMode="ADD";
        glbControlEnable(true);		
		$('#frmForm').bootstrapValidator("resetForm",true); 
		//alert($('ul#langFormTabs li:first-child').html());
		// $('.nav-tabs a[href="#tabs-1"]').tab('show');
		$('ul#langFormTabs li').each(function(){
		   $(this).find('i').removeClass('fa-check').removeClass('fa-times');
		});
		
		//ckeditorData1.setData();
		
    });

    clsLanguages.click(function () {
        document.cookie = "SMS_LANG" + '=' + $(this).attr("value")+';';
        $(this).addClass("active");
        location.reload();
    });
	
    //Scripts are used to manage the transaction entries globally.
    btnAddList.click(function (e) {

            e.stopPropagation();


            //Read All form elements
            var input="";
            var iType="";
            var iId="";
            var iVal="";
            var objMyAddItem={};
            var flagValidate=true;


            //Initially set the detail id
            objMyAddItem.DETAIL_KEY_ID=iEditDetailKeyID;


            //Fetch Details Form Values
            $('#frmDetailsForm input, #frmDetailsForm select,#frmDetailsForm textarea').each( function(index) {

                input = $(this);
                iType=input.attr("type");
                iId=input.attr("id");
                iVal=input.val();

                //validate the required fields
                if(input.attr("validate"))
                {
                    //validate the select boxes
                    if(iType == "select") {
                        if (iVal == '0')
                        {
                            mySmallAlert('Error...!', input.attr("validate-msg"), 0);
                            flagValidate=false;
                            return false;
                        }
                    }
                    if(iType == "text") {
                        if (iVal == '')
                        {
                            mySmallAlert('Error...!', input.attr("validate-msg"), 0);
                            flagValidate=false;
                            return false;
                        }
                    }
                }

                if(input.attr("name")) // if input name exists parse values and store to array
                {

                    if(iType == "select")  //if only select we parse the text and val
                    {
                        objMyAddItem[iId] = iVal;
                        objMyAddItem[iId + "_desc"] = $("#"+iId+" option:selected").text();
                    }
                    else if(iType == "checkbox")  //if checkbox
                    {
                        if(input.prop("checked"))
                            objMyAddItem[iId] = 1;
                        else
                            objMyAddItem[iId] = 0;
                    }
                    else
                        objMyAddItem[iId]=iVal;
                }

            }
            );



            if(flagValidate) {
                var intIsExist = 0;
                intIsExist = IsProductExist($("#product_id").val());

                if (intIsExist == 0 || 1) {
                    if (bEditDetailRecord) {
                        visibleControl('idCancelEditDetails', false);
                        editDetailArray(objMyAddItem, iEditIndex);
                        $("#AddListTEXT").html("Add List");
                    }
                    else {
                        objMyDetailRecords.push(objMyAddItem);
                        populateDetailRecords(objMyDetailRecords);
                    }
                } else {
                    mySmallAlert('Warning...!', 'This item already exit in the list, please edit and make changes', 2);

                }

                bEditDetailRecord = false;

                $("#AddListTEXT").html("Add to List");
                $("#idCancelEditDetails").html("Cancel Add");
                visibleControl('idCancelEditDetails', false);

                //Clear Form Fields
                $('#frmDetailsForm input, #frmDetailsForm select,#frmDetailsForm textarea').each(function (index) {

                    input = $(this);
                    iType = input.attr("type");
                    iId = input.attr("id");
                    iVal = input.val();
                    if (input.attr("name")) // if input name exists
                    {
                        if (iType == "text")  // if textbox
                            $("#" + iId).val("");

                        else if (iType == "select")   // if Select Box
                            $("#" + iId).val("0");

                        else if (iType == "checkbox")   // if Select Box
                            $("#" + iId).prop("checked", false);

                        else if (iType == "multiselect")   // if Select Box with multi select
                            $("#" + iId).select2("val", "0");

                        else if (iType == "textarea")   // if Select Box with multi select
                            $("#" + iId).val("");

                    }

                });
            }
        });

        //when click delete on transaction
        tblDetailsListBody.delegate('a.delete', 'click', function (e) {
            e.preventDefault();
            var iMyDelIndex = $(this).attr('data-row-index');
            if (parseInt(objMyDetailRecords[iMyDelIndex].DETAIL_KEY_ID) == 0) {
                deleteDetailArray(iMyDelIndex);
                document.getElementById("tblDetailsListBody").deleteRow(iMyDelIndex);
                populateDetailRecords(objMyDetailRecords);
            }
            else {
                alert("Delete not allowed");
            }
        });
        //when click edit transaction
        tblDetailsListBody.delegate('a.edit', 'click', function (e) {
            e.preventDefault();
            if (bEditDetailRecord) {
                mySmallAlert('Warning...!', 'Already in Edit Mode!', 2);
                return;
            }
            bEditDetailRecord = true;
            spanAddListTEXT.html("Update List");
            iEditIndex = $(this).attr('data-row-index');
            iEditDetailKeyID = parseInt(objMyDetailRecords[iEditIndex].DETAIL_KEY_ID);

            //Fill Form Values
            var iId;

            $('#frmDetailsForm input, #frmDetailsForm select,#frmDetailsForm textarea').each(function (index) {

                input = $(this);
                iType = input.attr("type");
                iId = input.attr("id");

                //alert(iType);

                if (input.attr("name")) // if input name exists
                {

                    if (iType == "text")  // if textbox
                        $("#" + iId).val(objMyDetailRecords[iEditIndex][iId]).trigger("change");

                    else if (iType == "select") // if Select Box
                        $("#" + iId).val(objMyDetailRecords[iEditIndex][iId]).trigger("change");

                    else if(iType == "checkbox")  //if checkbox
                    {
                        if(objMyDetailRecords[iEditIndex][iId]==1)
                            $("#" + iId).prop("checked",true);
                        else
                            $("#" + iId).prop("checked",false);
                    }
                    else if (iType == "multiselect")  // if Select Box with multi select
                        $("#" + iId).select2("val", objMyDetailRecords[iEditIndex][iId]);

                    else if (iType == "textarea") // if Select Box with multi select
                        $("#" + iId).val(objMyDetailRecords[iEditIndex][iId]);

                }

            });

            //control cancel
            $("#idCancelEditDetails").html("Cancel Edit");
            visibleControl('idCancelEditDetails', true);


        });

        //when click cancel
        $("#idCancelEditDetails").click(function (e)
        {
            bEditDetailRecord = false;
            visibleControl('idCancelEditDetails', false);
            spanAddListTEXT.html('Add Line');
            $("#idCancelEditDetails").html("Cancel Add");

            //Clear Form Fields
            $('#frmDetailsForm input, #frmDetailsForm select,#frmDetailsForm textarea').each(function (index) {

                input = $(this);
                iType = input.attr("type");
                iId = input.attr("id");
                iVal = input.val();
                if (input.attr("name")) // if input name exists
                {
                    if (iType == "text")  // if textbox
                        $("#" + iId).val("");

                    else if (iType == "select")   // if Select Box
                        $("#" + iId).select2("val", "0");

                    else if (iType == "checkbox")   // if Select Box
                        $("#" + iId).prop("checked", false);

                    else if (iType == "multiselect")   // if Select Box with multi select
                        $("#" + iId).select2("val", "0");

                    else if (iType == "textarea")   // if Select Box with multi select
                        $("#" + iId).val("");
                }
            });
        });


});//end doc ready

