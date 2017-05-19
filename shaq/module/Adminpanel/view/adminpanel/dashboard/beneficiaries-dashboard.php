<!-- RIBBON -->
<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		DASHBOARD &nbsp; &raquo; &nbsp; BENEFICIARIES DASHBOARD
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
	<!-- Bread crumb is created dynamically -->	
	<!-- row -->
	<div class="row">
		<div class="col-sm-6">
			<div class="col-sm-3">
				<div class="panel panel-default ">
					<div class="panel-heading bg-color-yellow txt-color-white text-center font-md txt-Dark">Total Beneficiaries</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-yellow">50</div>
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="panel panel-default ">
					<div class="panel-heading bg-color-yellow txt-color-white text-center font-md txt-Dark">Approved Visible</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-yellow">50</div>
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="panel panel-default ">
					<div class="panel-heading bg-color-yellow txt-color-white text-center font-md txt-Dark">Approved Invisible</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-yellow">50</div>
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="panel panel-default ">
					<div class="panel-heading bg-color-yellow txt-color-white text-center font-md txt-Dark">Moved Beneficiaries</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-yellow">50</div>
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="panel panel-default ">
					<div class="panel-heading bg-color-yellow txt-color-white text-center font-md txt-Dark">Pending Images</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-yellow">50</div>
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="panel panel-default ">
					<div class="panel-heading bg-color-yellow txt-color-white text-center font-md txt-Dark">Pending Videos</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-yellow">50</div>
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="panel panel-default ">
					<div class="panel-heading bg-color-yellow txt-color-white text-center font-md txt-Dark">Received Assets Value</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-yellow">50</div>
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="panel panel-default ">
					<div class="panel-heading bg-color-yellow txt-color-white text-center font-md txt-Dark">Received Assets Qty</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-yellow">50</div>
				</div>
			</div>
			<div class="col-sm-12 well">
				<table class="highchart hide" data-graph-container=".highchart-status-breakdown" data-graph-type="column">
				  <caption>Profile Breakdown</caption>
				  <thead>
					<tr>
					   <th>Beneficiaries Profile</th>
					   <th data-graph-color="#89A54E">Total number of beneficiaries</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td>Self Signup</td>
					  <td class="">10</td>
					</tr>
					<tr>
					  <td>Education</td>
					  <td class="">3</td>
					</tr>
					<tr>
					  <td>Orphan</td>
					  <td class="">8</td>
					</tr>
					<tr>
					  <td>Poor</td>
					  <td class="">1</td>
					</tr>
					<tr>
					  <td>Widow</td>
					  <td class="">5</td>
					</tr>
					<tr>
					  <td>Disabled</td>
					  <td class="">8</td>
					</tr>
					<tr>
					  <td>Teacher</td>
					  <td class="">9</td>
					</tr>
					<tr>
					  <td>Medical Care</td>
					  <td class="">2</td>
					</tr>
					<tr>
					  <td>Emergency</td>
					  <td class="">6</td>
					</tr>
					<tr>
					  <td>Asset</td>
					  <td class="">3</td>
					</tr>
					<tr>
					  <td>Refugees</td>
					  <td class="">4</td>
					</tr>
					<tr>
					  <td>Other</td>
					  <td class="">10</td>
					</tr>
				  </tbody>
				</table>
				<div class="highchart-status-breakdown"></div>				
			</div>
			<div class="col-sm-12 well">
				<table class="highchart table table-hover table-bordered hide" data-graph-container=".highchart-recieved-assets-breakdown" data-graph-type="column">
				  <caption>Received Assets per Status Breakdown</caption>
				  <thead>
					<tr>
					   <th>Beneficiaries Status</th>
					   <th data-graph-color="#7AA4BE">Total received assets</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td>Total</td>
					  <td class="">10</td>
					</tr>
					<tr>
					  <td>Waiting</td>
					  <td class="">0</td>
					</tr>
					<tr>
					  <td>Out For Delivery</td>
					  <td class="">8</td>
					</tr>
					<tr>
					  <td>Received</td>
					  <td class="">1</td>
					</tr>
				  </tbody>
				</table>
				<div class="highchart-recieved-assets-breakdown"></div>				
			</div>
		</div>	
		<div class="col-sm-6">
			<div class="col-sm-12 well"> 
				<table class="highchart table table-hover table-bordered hide" data-graph-container=".highchart-daily-registeration" data-graph-type="line">
				  <caption>Daily registrations</caption>
				  <thead>
					<tr>
					  <th>Date</th>
					  <th>Beneficiary 1</th>
					  <th>Beneficiary 2</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td>10th April</td>
					  <td>5</td>
					  <td>7</td>
					</tr>
					<tr>
					  <td>9th April</td>
					  <td>8</td>
					  <td>3</td>
					</tr>
					<tr>
					  <td>8th April</td>
					  <td>4</td>
					  <td>3</td>
					</tr>
					<tr>
					  <td>7th April</td>
					  <td>10</td>
					  <td>9</td>
					</tr>
					<tr>
					  <td>6th April</td>
					  <td>11</td>
					  <td>5</td>
					</tr>
					<tr>
					  <td>5th April</td>
					  <td>1</td>
					  <td>2</td>
					</tr>
					<tr>
					  <td>4th April</td>
					  <td>3</td>
					  <td>0</td>
					</tr>
					<tr>
					  <td>3rd April</td>
					  <td>11</td>
					  <td>12</td>
					</tr>
					<tr>
					  <td>2nd April</td>
					  <td>5</td>
					  <td>19</td>
					</tr>
					<tr>
					  <td>1st April</td>
					  <td>0</td>
					  <td>8</td>
					</tr>
				  </tbody>
				</table>
				<div class="highchart-daily-registeration"></div>
			</div>
			<div class="col-sm-12 well">
				<table class="highchart table table-hover table-bordered hide" data-graph-container=".highchart-profile-breakdown" data-graph-type="column">
				  <caption>Status Breakdown</caption>
				  <thead>
					<tr>
					   <th>Beneficiaries Status</th>
					   <th data-graph-color="#80699B">Total number of beneficiaries</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td>New</td>
					  <td class="">10</td>
					</tr>
					<tr>
					  <td>Review</td>
					  <td class="">0</td>
					</tr>
					<tr>
					  <td>Approved</td>
					  <td class="">8</td>
					</tr>
					<tr>
					  <td>Duplicate</td>
					  <td class="">1</td>
					</tr>
					<tr>
					  <td>Deleted</td>
					  <td class="">1</td>
					</tr>
				  </tbody>
				</table>
				<div class="highchart-profile-breakdown"></div>				
			</div>
		</div>	
	</div>
	<!-- end row -->
</div>
<!-- END #MAIN CONTENT -->
<script type="text/javascript">

	$(document).ready(function(){
		pageSetUp();
		
		var pagefunction = function() {
			// clears the variable if left blank
			$('table.highchart').highchartTable();
			//console.log("execute highchart")
		};
		
		var pagedestroy = function(){
		}
			
		loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/highChartCore/highcharts-custom.min.js", function(){
			loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/highchartTable/jquery.highchartTable.min.js", pagefunction); 
		});	
	});
</script>