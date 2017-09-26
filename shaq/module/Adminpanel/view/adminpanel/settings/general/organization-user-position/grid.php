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
					<h2>Organization User Position Listing</h2>
							
						<div class="widget-toolbar">
							<a href="<?php echo $this->url('adminpanel/organization-user-position', array('action'=>'downloadtemplate'));?>" target="_blank">
							<button class="btn btnDownload" id="btnDownloadTemplate">Download Template
							</button>
							</a>
							<button class="btn btnExport" id="btnExport" data-filename="organization-user-position">Export 
							</button>
							<button class="btn btnImport" id="btnImport">Import
							</button>
							
							<?php /*?><button class="btn btnBulksave" id="btnBulkSave">
								<i class="fa fa-floppy-o"></i> &nbsp;Bulk Save
							</button><?php */?>
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
										<input type="text" class="form-control" placeholder="Title" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Description" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Qualifications" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Responsibilities" >
									</th>
																
								</tr>
					            <tr>
									<th>Id</th>
									 <th data-class="expand">Title</th>
				                    <th>Description</th>
				                    <th data-hide="phone">Qualifications</th>
				                   	<th data-hide="phone,tablet">Responsibilities</th>
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