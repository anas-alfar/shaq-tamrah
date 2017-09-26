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
					<h2>Countries Listing</h2>
							
						<div class="widget-toolbar">
							<a href="<?php echo $this->url('adminpanel/configurations', array('action'=>'downloadtemplate'));?>" target="_blank">
							<button class="btn btnDownload" id="btnDownloadTemplate">
								<i class="fa fa-cloud-download"></i> &nbsp;Download Template
							</button>
							</a>
							<a href="<?php echo $this->url('adminpanel/configurations', array('action'=>'exportcsv'));?>" target="_blank">
								<button class="btn btnExport" id="btnExport">
									<i class="fa fa-cloud-upload"></i> &nbsp;Export 
								</button>
							</a>
							<button class="btn btnImport" id="btnImport">
								<i class="fa fa-cloud-download"></i> &nbsp;Import
							</button>
							
							<button class="btn btnBulksave" id="btnBulkSave">
								<i class="fa fa-floppy-o"></i> &nbsp;Bulk Save
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
										<input type="text" class="form-control" placeholder="Filter Config Key" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Config Value" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Config Type" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Environment" />
									</th>
									<th class="hasinput">
												<select id="override" name="override"class="searchdrop">
													<option value="">All</option>														
													<option value="<!--Yes-->">Yes</option>
													<option value="<!--No-->">No</option>
											   </select>	   
									</th>									
									<th class="hasinput">
												<select id="forcefilter" name="forcefilter"class="searchdrop">
													<option value="">All</option>														
													<option value="<!--Yes-->">Yes</option>
													<option value="<!--No-->">No</option>
											   </select>
									</th>									
									<th class="hasinput">
											<select id="publishedfilter" name="publishedfilter"class="searchdrop">
												<option value="">All</option>														
												<option value="<!--Yes-->">Yes</option>
												<option value="<!--No-->">No</option>
										   </select>   
									</th>
								</tr>
					            <tr>
									<th>Id</th>
				                    <th data-class="expand">Name</th>
				                    <th>Config Key</th>
				                    <th data-hide="phone">Config Value</th>
				                    <th data-hide="phone,tablet">Config Type</th>
				                    <th data-hide="phone,tablet">Environment</th>
									<th data-hide="phone,tablet">Allow Override</th>
									<th data-hide="phone,tablet">Force</th>
									<th data-hide="phone,tablet">Published</th>
									<th class="action">Action</th>
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