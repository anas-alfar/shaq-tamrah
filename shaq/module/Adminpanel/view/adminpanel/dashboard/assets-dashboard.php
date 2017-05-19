<!-- RIBBON -->
<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		DASHBOARD &nbsp; &raquo; &nbsp; ASSETS DASHBOARD
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
			<div class="col-sm-6">
				<div class="panel panel-primary ">
					<div class="panel-heading text-center font-md txt-Dark">Received Assets Value</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-blue">50</div>
				</div>
			</div>	
			<div class="col-sm-6">
				<div class="panel panel-primary ">
					<div class="panel-heading text-center font-md txt-Dark">Liability Assets Value</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-blue">50</div>
				</div>
			</div>	
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">	
			<div class="col-sm-12 well"> 
				<table class="highchart table table-hover table-bordered hide" data-graph-container=".highchart-daily-assets-value" data-graph-type="line">
				  <caption>Daily Assets Value</caption>
				  <thead>
					<tr>
					  <th>Day</th>
					  <th>Total value for assets received</th>
					  <th>Total value for assets liability</th>
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
				<div class="highchart-daily-assets-value"></div>
			</div>
			<div class="col-sm-12 well">
				<table class="highchart" data-graph-container=".highchart-quantity-type-breakdown" data-graph-type="column" style="display:none">
					<caption>Quantity Per Type Breakdown</caption>
					<thead>
						<tr>                                  
							<th>Total Quantity</th>
							<th>Received assets</th>
							<th>Liability assets</th>
							<th>Required assets </th>
						</tr>
					 </thead>
					 <tbody>
						<tr>
							<td>Type 1</td>
							<td>5</td>
							<td>2</td>
							<td>2</td>
						</tr>
						<tr>
							<td>Type 2</td>
							<td>5</td>
							<td>8</td>
							<td>2</td>
						</tr>
						<tr>
							<td>Type 3</td>
							<td>10</td>
							<td>2</td>
							<td>5</td>
						</tr>
						<tr>
							<td>Type 4</td>
							<td>15</td>
							<td>2</td>
							<td>1</td>
						</tr>
						<tr>
							<td>Type 5</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
						</tr>
					</tbody>
				</table>				
				<div class="highchart-quantity-type-breakdown"></div>				
			</div>
			
			
		</div>	
		<div class="col-sm-6">	
			<div class="col-sm-12 well"> 
				<table class="highchart table table-hover table-bordered hide" data-graph-container=".highchart-daily-assets-quantity" data-graph-type="line">
				  <caption>Daily Assets Quantity</caption>
				  <thead>
					<tr>
					  <th>Day</th>
					  <th>Total quantity for assets received</th>
					  <th>Total quantity for assets liability</th>
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
				<div class="highchart-daily-assets-quantity"></div>
			</div>
			<div class="col-sm-12 well">
				<table class="highchart" data-graph-container=".highchart-value-type-breakdown" data-graph-type="column" style="display:none">
					<caption>Value Per Type Breakdown</caption>
					<thead>
						<tr>                                  
							<th>Total Value </th>
							<th>Received assets</th>
							<th>Liability assets</th>
						</tr>
					 </thead>
					 <tbody>
						<tr>
							<td>Type 1</td>
							<td>5</td>
							<td>2</td>
						</tr>
						<tr>
							<td>Type 2</td>
							<td>5</td>
							<td>8</td>
						</tr>
						<tr>
							<td>Type 3</td>
							<td>10</td>
							<td>2</td>
						</tr>
						<tr>
							<td>Type 4</td>
							<td>15</td>
							<td>2</td>
						</tr>
						<tr>
							<td>Type 5</td>
							<td>1</td>
							<td>2</td>
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