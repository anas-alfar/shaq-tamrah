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
					<h2>Gallery Listing</h2>
							
						<div class="widget-toolbar">
							<a href="<?php echo $this->url('adminpanel/gallery', array('action'=>'downloadtemplate'));?>" target="_blank">
							<button class="btn btnDownload" id="btnDownloadTemplate">Download Template
							</button>
							</a>
							<button class="btn btnExport" id="btnExport" data-filename="gallery">Export 
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
						<table id="tblMasterList" class="table table-striped table-bordered" width="100%">	
					        <thead>
								<tr>
									<th></th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Media File" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Beneficiary" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Beneficiary Profile Family" >
									</th>
									
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Alias" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Mime Type" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Media Status" >
									</th>								
									<th class="hasinput">
											<select id="publishedfilter" name="publishedfilter"class="searchdrop">
												<option value="">All</option>														
												<option value="<!--Yes-->">Yes</option>
												<option value="<!--No-->">No</option>
										   </select>   
									</th>
									<th></th>
								</tr>
					            <tr>
									<th>Id</th>
									<th data-class="expand">Media File</th>
				                    <th >Alias</th>
				                    <th data-hide="phone,tablet">Beneficiary</th>
									<th data-hide="phone,tablet">Beneficiary Profile Family</th>
									<th data-hide="phone,tablet">Mime Type</th>
									<th data-hide="phone,tablet">Media Status</th>
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
					<h2>Gallery Youtube Listing</h2>
							
						<div class="widget-toolbar">
							<a href="<?php echo $this->url('adminpanel/gallery', array('action'=>'downloadyoutubetemplate'));?>" target="_blank">
							<button class="btn btnDownload" id="btnYoutubeDownloadTemplate">Download Template
							</button>
							</a>
							<button class="btn btnExport" id="btnYoutubeExport" data-filename="youtube_gallery">Export 
							</button>
							<button class="btn btnImport" id="btnYoutubeImport">Import
							</button>
							
							<button class="btn btnBulksave" id="btnYoutubeBulkSave">
								<i class="fa fa-floppy-o"></i> &nbsp;Bulk Save
							</button>
							<button class="btn btnNew addEventBtn" id="btnYoutubeNew">
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
						<form name="bulkSaveYoutubeForm" id="bulkSaveYoutubeForm">
						<table id="tblMasterYoutubeList" class="table table-striped table-bordered" width="100%">	
					        <thead>
								<tr>
									<th></th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Alais" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Beneficiary" />
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Beneficiary Profile Family" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Youtube Link" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Media Status" >
									</th>								
									<th class="hasinput">
											<select id="publishedfilter" name="publishedfilter"class="searchdrop">
												<option value="">All</option>														
												<option value="<!--Yes-->">Yes</option>
												<option value="<!--No-->">No</option>
										   </select>   
									</th>
									<th></th>
								</tr>
					            <tr>
									<th>Id</th>
									<th data-class="expand">Alias</th>
				                    <th >Beneficiary</th>
				                    <th data-hide="phone,tablet">Beneficiary Profile Family</th>
									<th data-hide="phone,tablet">Youtube Link</th>
									<th data-hide="phone,tablet">Media Status</th>
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