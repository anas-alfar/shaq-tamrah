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
					<h2>Beneficiary Message Email Listing</h2>
							
						<div class="widget-toolbar">
							<a href="<?php echo $this->url('adminpanel/gallery', array('action'=>'downloadtemplate'));?>" target="_blank">
							<button class="btn btnDownload" id="btnDownloadTemplate">Download Template
							</button>
							</a>
							<button class="btn btnExport" id="btnExport" data-filename="beneficiary_message_email">Export 
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
										<input type="text" class="form-control" placeholder="Filter Message Type" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter From Name" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter From Email" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter To Name" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter To Email" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Subject" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Locale" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Beneficiary" >
									</th>
									<th></th>
								</tr>
					            <tr>
									<th>Id</th>
									<th data-class="expand">Message Type</th>
				                    <th >From Name</th>
				                    <th data-hide="phone,tablet">From Email</th>
									<th data-hide="phone,tablet">To Name</th>
									<th data-hide="phone,tablet">To Email</th>
									<th data-hide="phone,tablet">Subject</th>
									<th data-hide="phone,tablet">Locale</th>
									<th data-hide="phone,tablet">Beneficiary</th>
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
					<h2>Beneficiary Message Sms Listing</h2>
							
						<div class="widget-toolbar">
							<a href="<?php echo $this->url('adminpanel/message', array('action'=>'downloadtemplatesms'));?>" target="_blank">
							<button class="btn btnDownload" id="btnDownloadTemplatesms">Download Template
							</button>
							</a>
							<button class="btn btnExport" id="btnsmsExport" data-filename="beneficiary_message_sms">Export 
							</button>
							<button class="btn btnImport" id="btnSmsImport">Import
							</button>
							
							<button class="btn btnNew addEventBtn" id="btnSmsNew">
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
						<form name="bulkSaveSmsForm" id="bulkSaveSmsForm">
						<table id="tblMasterSmsList" class="table table-striped table-bordered" width="100%">	
					        <thead>
								<tr>
									<th></th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Message Type" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter From Name" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter From Mobile Number" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter To Name" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter To Mobile Number" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Subject" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Locale" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Beneficiary" >
									</th>
									<th></th>
								</tr>
					            <tr>
									<th>Id</th>
									<th data-class="expand">Message Type</th>
				                    <th >From Name</th>
				                    <th data-hide="phone,tablet">From Mobile Number</th>
									<th data-hide="phone,tablet">To Name</th>
									<th data-hide="phone,tablet">To Mobile Number</th>
									<th data-hide="phone,tablet">Subject</th>
									<th data-hide="phone,tablet">Locale</th>
									<th data-hide="phone,tablet">Beneficiary</th>
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