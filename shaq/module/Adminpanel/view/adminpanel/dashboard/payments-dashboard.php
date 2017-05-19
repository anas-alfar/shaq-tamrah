<!-- RIBBON -->
<div id="ribbon">
	<!-- breadcrumb -->
	<ol class="breadcrumb">
		DASHBOARD &nbsp; &raquo; &nbsp; PAYMENTS DASHBOARD
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
				<div class="panel panel-info ">
					<div class="panel-heading text-center font-md txt-Dark">Payments Amount</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-blue">50</div>
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="panel panel-info ">
					<div class="panel-heading text-center font-md txt-Dark">Awaiting Collection Payments</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-blue">50</div>
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="panel panel-info ">
					<div class="panel-heading text-center font-md txt-Dark">Success Payments Amount</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-blue">50</div>
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="panel panel-info ">
					<div class="panel-heading text-center font-md txt-Dark">Failed Payments Amount</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-blue">50</div>
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="panel panel-info ">
					<div class="panel-heading text-center font-md txt-Dark">Number Of All Payments</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-blue">50</div>
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="panel panel-info ">
					<div class="panel-heading text-center font-md txt-Dark">Number Of Awaiting Collection</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-blue">50</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="panel panel-info ">
					<div class="panel-heading text-center font-md txt-Dark">Number Of Success Payments</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-blue">50</div>
				</div>
			</div>	
			<div class="col-sm-3">
				<div class="panel panel-info ">
					<div class="panel-heading text-center font-md txt-Dark">Number Of Failed Payments</div>
					<div class="panel-body font-xl text-center txt-Dark txt-color-blue">50</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">	
			<div class="col-sm-12 well"> 
				<table class="highchart hide"  data-graph-container=".highchart-number-of-collection-breakdown" data-graph-type="pie" data-graph-datalabels-enabled="1">
				<caption>Collection Breakdown by Number of Payments</caption>
					<thead>
						<tr>                                  
							<th>Description</th>
							<th>Number of success payments</th>
						</tr>
					 </thead>
					 <tbody>
						<tr>
							<td>Total collected</td>
							<td data-graph-item-color="#B09B5B" data-graph-name="Collected" >20</td>
						</tr>
						<tr>
							<td>Total pending</td>
							<td data-graph-item-color="#7AA4BE" data-graph-name="Pending">10</td>
						</tr>
					</tbody>
				</table>
				<div class="highchart-number-of-collection-breakdown"></div>
			</div>
			<div class="col-sm-12 well"> 
				<table class="highchart hide"  data-graph-container=".highchart-status-breakdown" data-graph-type="pie"  data-graph-datalabels-enabled="1">
				<caption>Status Breakdown by Amount</caption>
					<thead>
						<tr>                                  
							<th>Description</th>
							<th>Status</th>
						</tr>
					 </thead>
					 <tbody>
						<tr>
							<td>Total amount of success payments</td>
							<td data-graph-item-color="#B09B5B" data-graph-name="Success" >20</td>
						</tr>
						<tr>
							<td>Total amount of failed payments</td>
							<td data-graph-item-color="#7AA4BE" data-graph-name="Failed payments">10</td>
						</tr>
						<tr>
							<td>Total amount of initiated payments</td>
							<td data-graph-item-color="#89A54E" data-graph-name="Initiated payments">10</td>
						</tr>
						<tr>
							<td>Total amount of uncertain payments</td>
							<td data-graph-item-color="#80699B" data-graph-name="Uncertain payments">10</td>
						</tr>
					</tbody>
				</table>
				<div class="highchart-status-breakdown"></div>
			</div>
			<div class="col-sm-12 well">
				<table class="highchart" data-graph-container=".highchart-payment-amount-status-breakdown" data-graph-type="column" style="display:none" data-graph-yaxis-1-stacklabels-enabled="1">
					<caption>Payments Amount Per Status Breakdown for last 30 days</caption>
					<thead>
						<tr>                                  
							<th></th>
							<th data-graph-stack-group="1">Success</th>
							<th data-graph-stack-group="1">Failed</th>
							<th data-graph-stack-group="1">Initiated </th>
							<th data-graph-stack-group="1">Uncertain </th>
						</tr>
					 </thead>
					 <tbody>
						<tr>
							<td>1st April</td>
							<td>5</td>
							<td>2</td>
							<td>2</td>
							<td>8</td>
						</tr>
						<tr>
							<td>2nd April</td>
							<td>5</td>
							<td>8</td>
							<td>2</td>
							<td>3</td>
						</tr>
						<tr>
							<td>3rd April</td>
							<td>10</td>
							<td>2</td>
							<td>5</td>
							<td>8</td>
						</tr>
						<tr>
							<td>4th April</td>
							<td>15</td>
							<td>2</td>
							<td>1</td>
							<td>9</td>
						</tr>
						<tr>
							<td>5th April</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>5</td>
						</tr>
						<tr>
							<td>6th April</td>
							<td>6</td>
							<td>10</td>
							<td>12</td>
							<td>2</td>
						</tr>
						<tr>
							<td>7th April</td>
							<td>5</td>
							<td>2</td>
							<td>2</td>
							<td>8</td>
						</tr>
						<tr>
							<td>8th April</td>
							<td>5</td>
							<td>8</td>
							<td>2</td>
							<td>3</td>
						</tr>
						<tr>
							<td>9th April</td>
							<td>10</td>
							<td>2</td>
							<td>5</td>
							<td>8</td>
						</tr>
						<tr>
							<td>10th April</td>
							<td>15</td>
							<td>2</td>
							<td>1</td>
							<td>9</td>
						</tr>
						<tr>
							<td>11th April</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>5</td>
						</tr>
						<tr>
							<td>12th April</td>
							<td>6</td>
							<td>10</td>
							<td>12</td>
							<td>2</td>
						</tr>
						<tr>
							<td>13th April</td>
							<td>5</td>
							<td>2</td>
							<td>2</td>
							<td>8</td>
						</tr>
						<tr>
							<td>14th April</td>
							<td>5</td>
							<td>8</td>
							<td>2</td>
							<td>3</td>
						</tr>
						<tr>
							<td>15th April</td>
							<td>6</td>
							<td>10</td>
							<td>12</td>
							<td>2</td>
						</tr>
						<tr>
							<td>16th April</td>
							<td>10</td>
							<td>2</td>
							<td>5</td>
							<td>8</td>
						</tr>
						<tr>
							<td>17th April</td>
							<td>15</td>
							<td>2</td>
							<td>1</td>
							<td>9</td>
						</tr>
						<tr>
							<td>18th April</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>5</td>
						</tr>
						<tr>
							<td>19th April</td>
							<td>5</td>
							<td>2</td>
							<td>2</td>
							<td>8</td>
						</tr>
						<tr>
							<td>20th April</td>
							<td>5</td>
							<td>8</td>
							<td>2</td>
							<td>3</td>
						</tr>
						<tr>
							<td>21st April</td>
							<td>6</td>
							<td>10</td>
							<td>12</td>
							<td>2</td>
						</tr>
						<tr>
							<td>22nd April</td>
							<td>10</td>
							<td>2</td>
							<td>5</td>
							<td>8</td>
						</tr>
						<tr>
							<td>23rd April</td>
							<td>15</td>
							<td>2</td>
							<td>1</td>
							<td>9</td>
						</tr>
						<tr>
							<td>24th April</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>5</td>
						</tr>
						<tr>
							<td>25th April</td>
							<td>5</td>
							<td>2</td>
							<td>2</td>
							<td>8</td>
						</tr>
						<tr>
							<td>26th April</td>
							<td>5</td>
							<td>8</td>
							<td>2</td>
							<td>3</td>
						</tr>
						<tr>
							<td>27th April</td>
							<td>6</td>
							<td>10</td>
							<td>12</td>
							<td>2</td>
						</tr>
						<tr>
							<td>28th April</td>
							<td>10</td>
							<td>2</td>
							<td>5</td>
							<td>8</td>
						</tr>
						<tr>
							<td>29th April</td>
							<td>15</td>
							<td>2</td>
							<td>1</td>
							<td>9</td>
						</tr>
						<tr>
							<td>30th April</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>5</td>
						</tr>
					</tbody>
				</table>				
				<div class="highchart-payment-amount-status-breakdown"></div>				
			</div>
		</div>	
		<div class="col-sm-6">
			<div class="col-sm-12 well"> 
				<table class="highchart hide"  data-graph-container=".highchart-collection-breakdown" data-graph-type="pie" data-graph-datalabels-enabled="1">
				<caption>Collection Breakdown by Amount</caption>
					<thead>
						<tr>                                  
							<th>Description</th>
							<th>Success payments</th>
						</tr>
					 </thead>
					 <tbody>
						<tr>
							<td>Total collected amount</td>
							<td data-graph-item-color="#89A54E" data-graph-name="Collected Amount" >8000</td>
						</tr>
						<tr>
							<td>Total pending amount</td>
							<td data-graph-item-color="#80699B" data-graph-name="Pending Amount">12000</td>
						</tr>
					</tbody>
				</table>
				<div class="highchart-collection-breakdown"></div>
			</div>
			<div class="col-sm-12 well"> 
				<table class="highchart hide"  data-graph-container=".highchart-status-breakdown-number-of-payments" data-graph-type="pie"  data-graph-datalabels-enabled="1">
				<caption>Status Breakdown for Number of Payments</caption>
					<thead>
						<tr>                                  
							<th>Description</th>
							<th>Status</th>
						</tr>
					 </thead>
					 <tbody>
						<tr>
							<td>Number of success payments</td>
							<td data-graph-item-color="#B09B5B" data-graph-name="Success" >20</td>
						</tr>
						<tr>
							<td>Number of failed payments</td>
							<td data-graph-item-color="#7AA4BE" data-graph-name="Failed payments">10</td>
						</tr>
						<tr>
							<td>Number of initiated payments</td>
							<td data-graph-item-color="#89A54E" data-graph-name="Initiated payments">10</td>
						</tr>
						<tr>
							<td>Number of uncertain payments</td>
							<td data-graph-item-color="#80699B" data-graph-name="Uncertain payments">10</td>
						</tr>
					</tbody>
				</table>
				<div class="highchart-status-breakdown-number-of-payments"></div>
			</div>
			<div class="col-sm-12 well">
				<table class="highchart" data-graph-container=".highchart-payment-amount-payment-method" data-graph-type="column" style="display:none" data-graph-yaxis-1-stacklabels-enabled="1">
					<caption>Payments Amount Per Status Breakdown for last 30 days</caption>
					<thead>
						<tr>                                  
							<th></th>
							<th data-graph-stack-group="1">Payment Method 1</th>
							<th data-graph-stack-group="1">Payment Method 2</th>
							<th data-graph-stack-group="1">Payment Method 3 </th>
							<th data-graph-stack-group="1">Payment Method 4 </th>
						</tr>
					 </thead>
					 <tbody>
						<tr>
							<td>1st April</td>
							<td>5</td>
							<td>2</td>
							<td>2</td>
							<td>8</td>
						</tr>
						<tr>
							<td>2nd April</td>
							<td>5</td>
							<td>8</td>
							<td>2</td>
							<td>3</td>
						</tr>
						<tr>
							<td>3rd April</td>
							<td>10</td>
							<td>2</td>
							<td>5</td>
							<td>8</td>
						</tr>
						<tr>
							<td>4th April</td>
							<td>15</td>
							<td>2</td>
							<td>1</td>
							<td>9</td>
						</tr>
						<tr>
							<td>5th April</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>5</td>
						</tr>
						<tr>
							<td>6th April</td>
							<td>6</td>
							<td>10</td>
							<td>12</td>
							<td>2</td>
						</tr>
						<tr>
							<td>7th April</td>
							<td>5</td>
							<td>2</td>
							<td>2</td>
							<td>8</td>
						</tr>
						<tr>
							<td>8th April</td>
							<td>5</td>
							<td>8</td>
							<td>2</td>
							<td>3</td>
						</tr>
						<tr>
							<td>9th April</td>
							<td>10</td>
							<td>2</td>
							<td>5</td>
							<td>8</td>
						</tr>
						<tr>
							<td>10th April</td>
							<td>15</td>
							<td>2</td>
							<td>1</td>
							<td>9</td>
						</tr>
						<tr>
							<td>11th April</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>5</td>
						</tr>
						<tr>
							<td>12th April</td>
							<td>6</td>
							<td>10</td>
							<td>12</td>
							<td>2</td>
						</tr>
						<tr>
							<td>13th April</td>
							<td>5</td>
							<td>2</td>
							<td>2</td>
							<td>8</td>
						</tr>
						<tr>
							<td>14th April</td>
							<td>5</td>
							<td>8</td>
							<td>2</td>
							<td>3</td>
						</tr>
						<tr>
							<td>15th April</td>
							<td>6</td>
							<td>10</td>
							<td>12</td>
							<td>2</td>
						</tr>
						<tr>
							<td>16th April</td>
							<td>10</td>
							<td>2</td>
							<td>5</td>
							<td>8</td>
						</tr>
						<tr>
							<td>17th April</td>
							<td>15</td>
							<td>2</td>
							<td>1</td>
							<td>9</td>
						</tr>
						<tr>
							<td>18th April</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>5</td>
						</tr>
						<tr>
							<td>19th April</td>
							<td>5</td>
							<td>2</td>
							<td>2</td>
							<td>8</td>
						</tr>
						<tr>
							<td>20th April</td>
							<td>5</td>
							<td>8</td>
							<td>2</td>
							<td>3</td>
						</tr>
						<tr>
							<td>21st April</td>
							<td>6</td>
							<td>10</td>
							<td>12</td>
							<td>2</td>
						</tr>
						<tr>
							<td>22nd April</td>
							<td>10</td>
							<td>2</td>
							<td>5</td>
							<td>8</td>
						</tr>
						<tr>
							<td>23rd April</td>
							<td>15</td>
							<td>2</td>
							<td>1</td>
							<td>9</td>
						</tr>
						<tr>
							<td>24th April</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>5</td>
						</tr>
						<tr>
							<td>25th April</td>
							<td>5</td>
							<td>2</td>
							<td>2</td>
							<td>8</td>
						</tr>
						<tr>
							<td>26th April</td>
							<td>5</td>
							<td>8</td>
							<td>2</td>
							<td>3</td>
						</tr>
						<tr>
							<td>27th April</td>
							<td>6</td>
							<td>10</td>
							<td>12</td>
							<td>2</td>
						</tr>
						<tr>
							<td>28th April</td>
							<td>10</td>
							<td>2</td>
							<td>5</td>
							<td>8</td>
						</tr>
						<tr>
							<td>29th April</td>
							<td>15</td>
							<td>2</td>
							<td>1</td>
							<td>9</td>
						</tr>
						<tr>
							<td>30th April</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>5</td>
						</tr>
					</tbody>
				</table>				
				<div class="highchart-payment-amount-payment-method"></div>				
			</div>
		</div>	
	</div>
	<div class="row">
		<div class="col-sm-6">	
			<div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
				<!-- widget options:
				usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
				data-widget-colorbutton="false"
				data-widget-editbutton="false"
				data-widget-togglebutton="false"
				data-widget-deletebutton="false"
				data-widget-fullscreenbutton="false"
				data-widget-custombutton="false"
				data-widget-collapsed="true"
				data-widget-sortable="false"
				-->
				<!-- widget div-->
				<div>
					<div class="widget-body no-padding">
						<!-- content goes here -->
						<div id="vector-map" class="vector-map"></div>						
						<!-- end content -->
					</div>
				</div>
				<!-- end widget div -->
			</div>
		</div>
		<div>
			<div class="table-responsive no-margin">
							
							<table class="table table-striped table-hover table-condensed text-align-center">
								<thead>
									<tr>
										<th class="text-align-center">Country</th>
										<th class="text-align-center">Success Payments</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>United States Of America</td>
										<td>4,977 Success Payments</td>	
									</tr>							
									<tr>
										<td>Australia</td>
										<td>4,873 Success Payments</td>	
									</tr>
									<tr>
										<td>India</td>
										<td>3,671 Success Payments</td>	
									</tr>
									<tr>
										<td>Brazil</td>
										<td>2,476 Success Payments</td>	
									</tr>
									<tr>
										<td>Turkey</td>
										<td>1,476 Success Payments</td>	
									</tr>
									<tr>
										<td>China</td>
										<td>146 Success Payments</td>	
									</tr>
									<tr>
										<td>Canada</td>
										<td>134 Success Payments</td>	
									</tr>
									<tr>
										<td>Bangladesh</td>
										<td>100 Success Payments</td>	
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td colspan=5>
										<ul class="pagination pagination-xs no-margin">
											<li class="prev disabled">
												<a href="javascript:void(0);">Previous</a>
											</li>
											<li class="active">
												<a href="javascript:void(0);">1</a>
											</li>
											<li>
												<a href="javascript:void(0);">2</a>
											</li>
											<li>
												<a href="javascript:void(0);">3</a>
											</li>
											<li class="next">
												<a href="javascript:void(0);">Next</a>
											</li>
										</ul></td>
									</tr>
								</tfoot>
							</table>
							
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
			//console.log("execute highchart")
		};
		
		var pagedestroy = function(){
			// destroy vector map objects
			$('#vector-map').find('*').addBack().off().remove();
		}
			
		loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/highChartCore/highcharts-custom.min.js", function(){
			loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/highchartTable/jquery.highchartTable.min.js", pagefunction); 
		});			
		
		data_array = {
		    "US": 4977,
		    "AU": 4873,
		    "IN": 3671,
		    "BR": 2476,
		    "TR": 1476,
		    "CN": 146,
		    "CA": 134,
		    "BD": 100
		};
		function renderVectorMap() { 
		    $('#vector-map').vectorMap({
		        map: 'world_mill_en',
		        backgroundColor: '#fff',
		        regionStyle: {
		            initial: {
		                fill: '#c4c4c4'
		            },
		            hover: {
		                "fill-opacity": 1
		            }
		        },
		        series: {
		            regions: [{
		                values: data_array,
		                scale: ['#85a8b6', '#4d7686'],
		                normalizeFunction: 'polynomial'
		            }]
		        },
		        onRegionLabelShow: function (e, el, code) {
		            if (typeof data_array[code] == 'undefined') {
		                e.preventDefault();
		            } else {
		                var countrylbl = data_array[code];
		                el.html(el.html() + ': ' + countrylbl + ' success payments');
		            }
		        }
		    });
		}
		// Load Map dependency 1 then call for dependency 2 and then run renderVectorMap function
		loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js", function(){
			loadScript("<?php echo $this->basePath(); ?>/public/admin/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js", renderVectorMap);
		});
</script>