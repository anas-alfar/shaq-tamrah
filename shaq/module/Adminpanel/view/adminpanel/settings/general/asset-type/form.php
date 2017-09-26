<section id="widForm" class="hide">	
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
		     <div class="jarviswidget infocolor" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">  
				<header>
				    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
					<h2>Asset Type Info </h2>
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
							<div class="tab-pane active panel panel-hovered panel-stacked mb20">
								<div id="tabs-<?php echo $this->global_locale_id; ?>">
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Name<span>*</span></label>
												<input type="text" class="form-control" name="name_<?php echo $this->global_locale_id; ?>" id="name_<?php echo $this->global_locale_id; ?>"/>
											</div>
											<div class="form-group">
												<label class="control-label">Country<span>*</span></label>
													<select class="select2" id="country_id" name="country_id" type="select">														
														<option value="0">Select Country</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Description<span></span></label>
												<textarea type="text" id="description_<?php echo $this->global_locale_id; ?>" name="description_<?php echo $this->global_locale_id; ?>" class="description form-control" ></textarea>
											</div>
										</section>
										
									</div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Storage Types<span>*</span></label>
													<select class="select2" id="asset_storage_type_id" name="asset_storage_type_id" type="select">														
														<option value="0">Storage Types</option>
													</select> 
											</div>
										</section>
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Unit Types<span>*</span></label>
													<select class="select2" id="asset_unit_type_id" name="asset_unit_type_id" type="select">														
														<option value="0">Unit Types</option>
													</select> 
											</div>
										</section>
									 </div>
									<div class="row">
										<section class="col-md-6">
											<div class="form-group">
												<label class="control-label">Condition<span>*</span></label>
													<select class="select2" id="asset_condition_id" name="asset_condition_id" type="select">														
														<option value="0">Condition</option>
													</select> 
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="has_tax" class="onoffswitch-checkbox" id="has_tax" type="checkbox">
														<label class="onoffswitch-label" for="has_tax">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Has Tax
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="has_sku" class="onoffswitch-checkbox" id="has_sku" type="checkbox">
														<label class="onoffswitch-label" for="has_sku">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Has Sku
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="has_serial" class="onoffswitch-checkbox" id="has_serial" type="checkbox">
														<label class="onoffswitch-label" for="has_serial">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Has Serial
												</label>
											</div>
										</section>
									</div>											
									<div class="row">
										
										<section class="col-md-3">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="has_expiry_date" class="onoffswitch-checkbox" id="has_expiry_date" type="checkbox">
														<label class="onoffswitch-label" for="has_expiry_date">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Has Expiry Date
												</label>
											</div>
										</section>
										<section class="col-md-2">
											<div class="form-group">
												<label>&nbsp;</label>
												<label class="customwidth">
													<span class="onoffswitch">															
														<input name="published" class="onoffswitch-checkbox" id="published" type="checkbox">
														<label class="onoffswitch-label" for="published">
															<span class="onoffswitch-inner" data-swchon-text="Yes" data-swchoff-text="No"></span> 
															<span class="onoffswitch-switch"></span>
														</label>
													</span>
													Published
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
														<label class="control-label">Description<span></span></label>
														<textarea type="text" id="description_<?php echo $locale['id']; ?>" name="description_<?php echo $locale['id']; ?>" class="description form-control" ></textarea>
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
								
