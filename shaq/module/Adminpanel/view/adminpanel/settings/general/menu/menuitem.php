<section id="widForm1" class="hide">	
		<div class="row">
			<div class="col-sm-12">				
				<div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">	
					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h2><span id="tblname"></span> : Menu Item Info </h2>
						<div class="widget-toolbar">
						
								<button id="btnCancle" type="submit" class="right btn btnExport  addEventBtn ">
									   <i class=""></i> &nbsp;Cancle
							    </button>
								<button id="btnBack1" type="submit" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<button id="btnSave1" type="submit" class="right btn btnSave  addEventBtn ">
									   <i class="fa fa-floppy-o"></i> &nbsp;Save
							    </button>
						</div>					
					</header>
					<div>
					<div class="widget-body">
						<div id="tabs">
							<ul class="nav-tabs" id="langFormTabs">
								<li class="active">
									<a href="#tabs-<?php echo $this->global_locale_id; ?>" data-toggle="tab"><?php echo $this->globalLocalName;?>&nbsp;<i class="fa"></i></a>
								</li>
								<?php 
									foreach($this->activeLocalesArray as $locale)
									{
										if($locale['id'] == $this->global_locale_id)
											continue;
										?>
										<li>
											<a href="#tabs-<?php echo $locale['id']; ?>" data-toggle="tab"><?php echo $locale['name'];?>&nbsp;<i class="fa"></i></a>
										</li>
										<?php 
									}
								?>
							</ul>
						 <form id="frmForm1"  enctype="multipart/form-data" name="frmForm1"> 
							<input type="hidden" name="menu_id" id="menu_id" value=""/>
						   <div class="tab-content">	
							<div class="tab-pane active panel panel-hovered panel-stacked mb30">
								<div id="tabs-<?php echo $this->global_locale_id; ?>">
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Name<span>*</span></label>
												<input type="text" class="form-control" name="name_<?php echo $this->global_locale_id; ?>" id="name_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>	
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Link<span>*</span></label>
												<input type="text" class="form-control" name="link_<?php echo $this->global_locale_id; ?>" id="link_<?php echo $this->global_locale_id; ?>"/>
											</div>
										</section>
									</div>
									<div class="row">
										  <section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Parent<span></span></label>
													<select class="select2" name="parent_id" id="parent_id" type="select" data-validate="true">
														<option value="0">Select Parent</option>
													</select>
											</div>	
										 </section>
										 <section class="col-md-2">
											<div class="form-group">
											 <label>&nbsp;</label>
											  <label class="customwidth">
												Published
												<span class="onoffswitch">															
													<input name="published1" class="onoffswitch-checkbox" id="published1" type="checkbox">
													<label class="onoffswitch-label" for="published1">
														<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
														<span class="onoffswitch-switch"></span>
													</label>
												</span>
												</label>
											</div>
										 </section>
									</div>
									
								</div>
								<?php 
									foreach($this->activeLocalesArray as $locale)
									{
										if($locale['id'] == $this->global_locale_id)
											continue;
										?>
										<div id="tabs-<?php echo $locale['id']; ?>">
											<div class="row">
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Name<span>*</span></label>
														<input type="text" class="form-control" name="name_<?php echo $locale['id']; ?>" id="name_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
												
												<section class="col-md-6">
													<div class="form-group">
														<label class="control-label">Link<span>*</span></label>
														<input type="text" class="form-control" name="link_<?php echo $locale['id']; ?>" id="link_<?php echo $locale['id']; ?>"/>
													</div>
												</section>
											</div>
										</div>
										<?php 
									}
								?>
							</div>
						</div>
					  </div>	
					</form>
				   </div>
				</div>
				</div>
			</div>
		</div>
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
					<h2><span id="tblname1"></span> : Menu Item Listing</h2>
							
						<div class="widget-toolbar">
							<a href="<?php echo $this->url('adminpanel/menu', array('action'=>'downloadtemplate1'));?>" target="_blank">
							<button class="btn btnDownload" id="btnDownloadTemplate">Download Template
							</button>
							</a>
							<button class="btn btnExport" id="btnExport1">Export 
							</button>
							<button class="btn btnImport" id="btnImport1">Import
							</button>
							<button class="btn btnBulksave" id="btnSaveOrder1">
								<i class="fa fa-floppy-o"></i> &nbsp;Save Order
							</button>
						</div>

				</header>

				<!-- widget div-->
				<div>
				<div class="widGrid1" id="widGrid1">

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body no-padding">
						<textarea id="menu-item-output" rows="3" class="form-control font-md" style="display:none;"></textarea>		
							<div class="col-sm-12 col-lg-12">
								<div class="dd" id="menuItemListId">
									
								</div>

							</div>
					</div>
					<!-- end widget content -->
				</div>
				<!-- end widget div -->
				</div>
			</div>
			</div>			
		</div>
	<!-- end row -->
	</section>							
											
