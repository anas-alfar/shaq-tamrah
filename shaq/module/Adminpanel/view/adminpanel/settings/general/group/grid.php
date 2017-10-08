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
					<h2>Groups Listing</h2>
							
						<div class="widget-toolbar">
							<a href="<?php echo $this->url('adminpanel/group', array('action'=>'downloadtemplate'));?>" target="_blank">
							<button class="btn btnDownload" id="btnDownloadTemplate">Download Template
							</button>
							</a>
							<button class="btn btnExport" id="btnExport" data-filename="groups">Export 
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
										<input type="text" class="form-control" placeholder="Filter Name" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Description" />
									</th>
									<th>
									</th>
								</tr>
					            <tr>
									<th>Id</th>
				                    <th data-class="expand">Name</th>
									<th >Description</th>
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
	<section id="widGroupMemberGrid" class="hide">
				<div class="row">
					<div class="col-sm-12">
						<div class="jarviswidget listing" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" id="wid-id-0"data-widget-sortable="false">
						<header>
							<span class="widget-icon"> <i class="fa fa-list-ul"></i> </span>
							<h2>Groups Listing</h2>
									
								<div class="widget-toolbar">
									<button id="btnBackGroupMember" type="submit" class="right btn btnBack  addEventBtn ">
										   <i class="fa fa-angle-left"></i> &nbsp;Back
									</button>
									<button id="btnSaveGroupMember" type="submit" class="right btn btnSave  addEventBtn ">
										   <i class="fa fa-floppy-o"></i> &nbsp;Save
									</button>
								</div>
		
						</header>
		
						<!-- widget div-->
						<div>
							<div>
								<div class="widget-body">
									
									 <form id="frmFormGroupMember"  enctype="multipart/form-data" name="frmFormGroupMember">
									 <input type="hidden" name="beneficiary_group_id" id="beneficiary_group_id" /> 
									   <div class="tab-content">	
										<div class="tab-pane active panel panel-hovered panel-stacked mb30">
												<div class="row">
													<section class="col-md-6">
														<div class="form-group">
															<label class="control-label">Beneficiary<span>*</span></label>
																<select class="select2" id="beneficiary_id" name="beneficiary_id" type="select">														
																	<option value="0">Select Beneficiary</option>
																</select> 
														</div>
													</section>
												</div> 
											</div>
										</div>
									</form>
							   </div>
							</div>
							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
								<!-- This area used as dropdown edit box -->
		
							</div>
							<!-- end widget edit box -->
		
							<!-- widget content -->
							<div class="widget-body no-padding">
								<table id="tblMasterGroupMemberList" class="table table-striped table-bordered" width="100%">	
									<thead>
										<tr>
											<th></th>
											<th class="hasinput">
												<input type="text" class="form-control" placeholder="Filter Beneficiary" />
											</th>
											<th class="hasinput">
												<input type="text" class="form-control" placeholder="Filter Family Book Number" />
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
											<th >Family Book Number</th>
											<th data-hide="phone,tablet">Status</th>
											<th data-hide="phone,tablet" class="action">Action</th>
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