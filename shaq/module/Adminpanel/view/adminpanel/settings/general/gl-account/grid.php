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
					<h2>Accounts Listing</h2>
							
						<div class="widget-toolbar">
							<button class="btn btnExport" id="btnReorder" >Reorder 
							</button>
							<a href="<?php echo $this->url('adminpanel/gl-account', array('action'=>'downloadtemplate'));?>" target="_blank">
							<button class="btn btnDownload" id="btnDownloadTemplate">Download Template
							</button>
							</a>
							<button class="btn btnExport" id="btnExport" data-filename="gl-account">Export 
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
					<div class="tree">
							<ul role="tree">
								<li class="parent_li" role="treeitem">
									<span title="Collapse this branch"><i class="fa fa-lg fa-calendar icon-minus-sign"></i> 2013, Week 2</span>
									<ul role="group">
										<li class="parent_li" role="treeitem" style="display: list-item;">
											<span class="label label-success" title="Collapse this branch"><i class="fa fa-lg fa-plus-circle icon-minus-sign"></i> Monday, January 7: 8.00 hours</span>
											<ul role="group">
												<li style="display: list-item;">
													<span><i class="fa fa-clock-o"></i> 8.00</span> &ndash; <a href="javascript:void(0);">Changed CSS to accomodate...</a>
												</li>
											</ul>
										</li>
										<li class="parent_li" role="treeitem" style="display: list-item;">
											<span class="label label-success" title="Collapse this branch"><i class="fa fa-lg fa-minus-circle icon-minus-sign"></i> Tuesday, January 8: 8.00 hours</span>
											<ul role="group">
												<li style="display: list-item;">
													<span><i class="fa fa-clock-o"></i> 6.00</span> &ndash; <a href="javascript:void(0);">Altered code...</a>
												</li>
												<li style="display: list-item;">
													<span><i class="fa fa-clock-o"></i> 2.00</span> &ndash; <a href="javascript:void(0);">Simplified our approach to...</a>
												</li>
											</ul>
										</li>
										<li class="parent_li" role="treeitem" style="display: list-item;">
											<span class="label label-warning" title="Collapse this branch"><i class="fa fa-lg fa-minus-circle icon-minus-sign"></i> Wednesday, January 9: 6.00 hours</span>
											<ul role="group">
												<li style="display: list-item;">
													<span><i class="fa fa-clock-o"></i> 3.00</span> &ndash; <a href="javascript:void(0);">Fixed bug caused by...</a>
												</li>
												<li style="display: list-item;">
													<span><i class="fa fa-clock-o"></i> 3.00</span> &ndash; <a href="javascript:void(0);">Comitting latest code to Git...</a>
												</li>
											</ul>
										</li>
										<li class="parent_li" role="treeitem" style="display: list-item;">
											<span class="label label-danger" title="Collapse this branch"><i class="fa fa-lg fa-minus-circle icon-minus-sign"></i> Wednesday, January 9: 4.00 hours</span>
											<ul role="group">
												<li style="display: list-item;">
													<span><i class="fa fa-clock-o"></i> 2.00</span> &ndash; <a href="javascript:void(0);">Create component that...</a>
												</li>
											</ul>
										</li>
									</ul>
								</li>
								<li class="parent_li" role="treeitem">
									<span title="Collapse this branch"><i class="fa fa-lg fa-calendar icon-minus-sign"></i> 2013, Week 3</span>
									<ul role="group">
										<li class="parent_li" role="treeitem" style="display: list-item;">
											<span class="label label-success" title="Expand this branch"><i class="fa fa-lg fa-minus-circle icon-plus-sign"></i> Monday, January 14: 8.00 hours</span>
											<ul role="group">
												<li style="display: none;">
													<span><i class="fa fa-clock-o"></i> 7.75</span> &ndash; <a href="javascript:void(0);">Writing documentation...</a>
												</li>
												<li style="display: none;">
													<span><i class="fa fa-clock-o"></i> 0.25</span> &ndash; <a href="javascript:void(0);">Reverting code back to...</a>
												</li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</div>
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
										<input type="text" class="form-control" placeholder="Filter Sequence" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Account Types" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Transaction Types" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Current Balance" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Is Main" >
									</th>
									<th class="hasinput">
										<input type="text" class="form-control" placeholder="Filter Is Leaf" >
									</th>
									
								</tr>
					            <tr>
									<th>Id</th>
				                    <th data-class="expand">Name</th>
				                    <th>Sequence</th>
									<th data-hide="phone,tablet">Account Types</th>
									<th data-hide="phone,tablet">Transaction Types</th>
									<th data-hide="phone,tablet">Current Balance</th>
									<th data-hide="phone,tablet">Is Main</th>
									<th data-hide="phone,tablet">Is Leaf</th>
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