
var btnSave=$("#btnSave");
var btnBack=$("#btnBack");
var btnNew=$("#btnNew");

var widForm=$("#widForm");
var widGrid=$("#widGrid");
var clsLanguages=$(".clsLanguages");

var strActionMode="ADD";
var iActiveID;
var oTable;
var ckeditorvar;
var editor;
var reoderTable;
var is_single = false;

var gridTableId = 'tblMasterList';

//For Access Controls  1- true 0-false

var acl_ADD="0";
var acl_EDIT="0";
var acl_DELETE="0";
var acl_VIEW="1";
var acl_PRINT="0";


//Global Variables for Manage details records

var btnAddList=$("#btnAddList");
var cboProduct=$("#cboProduct");
var spanAddListTEXT=$("#AddListTEXT");
var txtQty=$("#txtQty");
var iEditDetailKeyID=0;
var objMyDetailRecords=[];
var bEditDetailRecord;
var pmDeleteLine=1;
var tblDetailsListBody=$("#tblDetailsListBody");

//Global Variables to store the calculation counts

var iGrossAmountTotal=0;
var iDiscountAmountTotal=0;
var iTAXAmountTotal=0;
var iTAX2AmountTotal=0;
var iNetAmountTotal=0;
var iExltaxAmount =0;

