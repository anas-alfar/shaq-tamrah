<section id="widGrid" class="">
	<!-- row -->
		<div class="row">
			<!-- a blank row to get started -->
			<div class="col-sm-12">
				<div class="jarviswidget listing" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" id="wid-id-0"data-widget-sortable="false">
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
				<header>
					<span class="widget-icon"> <i class="fa fa-list-ul"></i> </span>
					<h2>Beneficiary Profile Asset Required Listing</h2>
							
						<div class="widget-toolbar">
							<a href="<?php echo $this->url('adminpanel/beneficiary-profile-asset-required', array('action'=>'downloadtemplate'));?>" target="_blank">
							<button class="btn btnDownload" id="btnDownloadTemplate">Download Template
							</button>
							</a>
							<button class="btn btnExport" id="btnExport" data-filename="beneficiary-profile-asset-required">Export 
							</button>
							<button class="btn btnImport" id="btnImport">Import
							</button>
							
							
							<button class="btn btnNew addEventBtn" id="btnNew">
								<i class="fa fa-plus"></i> &nbsp;New
							</button>
						</div>

				</header>

				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body no-padding">
						<form name="bulkSaveForm" id="bulkSaveForm">
						<table id="tblMasterList" class="table table-striped table-bordered" width="100%">	
					        <thead>
								<tr>
									<th></th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Beneficiary" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Asset" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Asset Type" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Asset Unit" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Asset Quantity" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Asset Condition" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Status" />
									</th>
									
									<th>
									</th>
								</tr>
					            <tr>
									<th>Id</th>
				                    <th data-class="expand">Beneficiary</th>
									<th >Asset</th>
									<th data-hide="phone">Asset Type</th>
									<th data-hide="phone">Asset Unit</th>
									<th data-hide="phone">Asset Quantity</th>
									<th data-hide="phone,tablet">Asset Condition</th>
									<th data-hide="phone,tablet">Status</th>
									<th data-hide="phone" class="action">Action</th>
					            </tr>
					        </thead>							
					        <tbody></tbody>							
						</table>
						</form>	
					</div>
					<!-- end widget content -->
				</div>
				<!-- end widget div -->
			</div>
			</div>			
		</div>
	<!-- end row -->
	</section>