<section id="widForm" class="hide">	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Country Info </h2>
					<div class="widget-toolbar">
								
								<button id="btnBack" type="submit" class="right btn btnBack  addEventBtn ">
									   <i class="fa fa-angle-left"></i> &nbsp;Back
							    </button>
								<button id="btnSave" type="submit" class="right btn btnSave  addEventBtn ">
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
						 <form id="frmForm"  enctype="multipart/form-data" name="frmForm"> 
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
											<label class="control-label">Iso Code 2<span>*</span></label>
											  <input type="text" id="iso_code_2" name="iso_code_2" class="form-control " >
										   </div> 	  
										</section>
									</div>
									<div class="row">								
										<section class="col-md-6">
										   <div class="form-group">
											<label class="control-label">Iso Code 3<span>*</span></label>
											  <input type="text" id="iso_code_3" name="iso_code_3" class="form-control ">
										   </div>	  
										</section>
										<section class="col-md-6">
										   <div class="form-group">
											<label class="control-label">Default Currency<span>*</span></label>
											  <input type="text" id="default_currency" name="default_currency" class="form-control ">
											</div> 
										</section>
									 </div>
									 <div class="row">	
										<section class="col-md-6">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													Published
													<span class="onoffswitch">															
														<input name="published" class="onoffswitch-checkbox" id="published" type="checkbox">
														<label class="onoffswitch-label" for="published">
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
</section>	
								
