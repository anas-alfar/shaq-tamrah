<!-- RIBBON -->
<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		DASHBOARD &nbsp; &raquo; &nbsp; POSTS DASHBOARD
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
		<div class="col-sm-12">
			<div class="col-sm-3">
				<div class="panel panel-primary ">
					<div class="panel-heading text-center font-md txt-Dark">Total Posts</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-blue">50</div>
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="panel panel-primary ">
					<div class="panel-heading text-center font-md txt-Dark">Total Draft Posts</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-blue">50</div>
				</div>
			</div>		
			<div class="col-sm-3">
				<div class="panel panel-primary ">
					<div class="panel-heading text-center font-md txt-Dark">Total Active Posts</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-blue">50</div>
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="panel panel-primary ">
					<div class="panel-heading text-center font-md txt-Dark">Total Deleted Posts</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-blue">50</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">	
			<div class="col-sm-12 well"> 
				<table class="highchart table table-hover table-bordered hide" data-graph-container=".highchart-cat-type-breakdown" data-graph-type="pie" data-graph-datalabels-enabled="1">
				  <caption>Category and Type Breakdown</caption>
				  <thead>
					<tr>
					  <th></th>
					  <th>Total Active Posts</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
						<td>Category 1</td>
						<td data-graph-name="Category 1" >20</td>
					</tr>
					<tr>
						<td>Category 2</td>
						<td data-graph-name="Category 2">10</td>
					</tr>
					<tr>
						<td>Category 2</td>
						<td data-graph-name="Category 2">10</td>
					</tr>
					<tr>
						<td>Category 2</td>
						<td data-graph-name="Category 2">10</td>
					</tr>
				  </tbody>
				</table>
				<div class="highchart-cat-type-breakdown"></div>
			</div>			
		</div>	
		<div class="col-sm-6">				
			<div class="col-sm-12 well">
				<table class="highchart" data-graph-container=".highchart-value-type-breakdown" data-graph-type="column" style="display:none">
					<caption>Status Breakdown</caption>
					<thead>
						<tr>                                  
							<th></th>
							<th>Total Value </th>							
						</tr>
					 </thead>
					 <tbody>
						<tr>
							<td>All</td>
							<td>30</td>
						</tr>
						<tr>
							<td>Draft</td>
							<td>5</td>
						</tr>
						<tr>
							<td>Active</td>
							<td>10</td>
						</tr>
						<tr>
							<td>Deleted</td>
							<td>15</td>
						</tr>
					</tbody>
				</table>				
				<div class="highchart-value-type-breakdown"></div>				
			</div>
		</div>	
	</div>	
	<!-- end row -->
</div>
<!-- END #MAIN CONTENT -->
<script type="text/javascript">
		pageSetUp();
		
		var pagefunction = function() {
			// clears the variable if left blank
			$('table.highchart').highchartTable();
		};
		
		var pagedestroy = function(){
			// destroy vector map objects
		}
			
		loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/highChartCore/highcharts-custom.min.js", function(){
			loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/highchartTable/jquery.highchartTable.min.js", pagefunction);
		});		
		
		
</script>