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
					<h2>Organization Branches Listing</h2>
							
						<div class="widget-toolbar">
							<a href="<?php echo $this->url('adminpanel/organization-branches', array('action'=>'downloadtemplate'));?>" target="_blank">
							<button class="btn btnDownload" id="btnDownloadTemplate">Download Template
							</button>
							</a>
							<button class="btn btnExport" id="btnExport" data-filename="organization-branches">Export 
							</button>
							<button class="btn btnImport" id="btnImport">Import
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
						<table id="tblMasterList" class="display projects-table table table-striped table-bordered table-hover" cellspacing="0" width="100%">	
					        <thead>
								<tr>
									<th></th>
									<th></th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Name" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Website" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Mobile Number" >
									</th>
									
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Phone Number" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Country" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter City" >
									</th>
									<th class="hasinput">
											<select id="branchfilter" name="branchfilter"class="searchdrop">
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
									<th></th>
				                    <th data-class="expand">Name</th>
				                    <th>Website</th>
									<th data-hide="phone,tablet">Mobile Number</th>
									<th data-hide="phone,tablet">Phone Number</th>
									<th data-hide="phone,tablet">Country</th>
									<th data-hide="phone,tablet">City</th>
									<th data-hide="phone,tablet">Is Main Branch</th>
									<th data-hide="phone,tablet">Published</th>
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